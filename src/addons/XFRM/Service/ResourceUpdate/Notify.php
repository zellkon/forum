<?php

namespace XFRM\Service\ResourceUpdate;

use XFRM\Entity\ResourceUpdate;
use XF\Service\AbstractNotifier;

class Notify extends AbstractNotifier
{
	/**
	 * @var ResourceUpdate
	 */
	protected $update;

	protected $actionType;

	public function __construct(\XF\App $app, ResourceUpdate $update, $actionType)
	{
		parent::__construct($app);

		switch ($actionType)
		{
			case 'update':
			case 'resource':
				break;

			default:
				throw new \InvalidArgumentException("Unknown action type '$actionType'");
		}

		$this->actionType = $actionType;
		$this->update = $update;
	}

	public static function createForJob(array $extraData)
	{
		$update = \XF::app()->find('XFRM:ResourceUpdate', $extraData['updateId'], ['Resource', 'Resource.Category']);
		if (!$update)
		{
			return null;
		}

		return \XF::service('XFRM:ResourceUpdate\Notify', $update, $extraData['actionType']);
	}

	protected function getExtraJobData()
	{
		return [
			'updateId' => $this->update->resource_update_id,
			'actionType' => $this->actionType
		];
	}

	protected function loadNotifiers()
	{
		return [
			'mention' => $this->app->notifier('XFRM:ResourceUpdate\Mention', $this->update),
			'resourceWatch' => $this->app->notifier('XFRM:ResourceUpdate\ResourceWatch', $this->update, $this->actionType),
			'categoryWatch' => $this->app->notifier('XFRM:ResourceUpdate\CategoryWatch', $this->update, $this->actionType),
		];
	}

	protected function loadExtraUserData(array $users)
	{
		$permCombinationIds = [];
		foreach ($users AS $user)
		{
			$id = $user->permission_combination_id;
			$permCombinationIds[$id] = $id;
		}

		$this->app->permissionCache()->cacheMultipleContentPermsForContent(
			$permCombinationIds,
			'resource_category', $this->update->Resource->resource_category_id
		);
	}

	protected function canUserViewContent(\XF\Entity\User $user)
	{
		return \XF::asVisitor(
			$user,
			function() { return $this->update->canView(); }
		);
	}

	public function skipUsersWatchingCategory(\XFRM\Entity\Category $category)
	{
		$checkCategories = array_keys($category->breadcrumb_data);
		$checkCategories[] = $category->resource_category_id;

		$db = $this->db();

		$watchers = $db->fetchAll("
			SELECT user_id, send_alert, send_email
			FROM xf_rm_category_watch
			WHERE resource_category_id IN (" . $db->quote($checkCategories) . ")
				AND (resource_category_id = ? OR include_children > 0)
				AND (send_alert = 1 OR send_email = 1)
		", $category->resource_category_id);

		foreach ($watchers AS $watcher)
		{
			if ($watcher['send_alert'])
			{
				$this->setUserAsAlerted($watcher['user_id']);
			}
			if ($watcher['send_email'])
			{
				$this->setUserAsEmailed($watcher['user_id']);
			}
		}
	}
}