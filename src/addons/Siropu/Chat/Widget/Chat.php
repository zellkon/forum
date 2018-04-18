<?php

namespace Siropu\Chat\Widget;

class Chat extends \XF\Widget\AbstractWidget
{
	protected $defaultOptions = [
		'message_display_limit' => 25,
		'device'                => ['desktop' => 1, 'tablet' => 1, 'mobile' => 1],
		'days'                  => [1, 1, 1, 1, 1, 1, 1],
		'hours'                 => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
		'message'               => ''
	];

	protected function getDefaultTemplateParams($context)
	{
		$params = parent::getDefaultTemplateParams($context);

		if ($context == 'options')
		{
			$params['rooms'] = $this->app->repository('Siropu\Chat:Room')->findRoomsForList()->fetch();
		}

		return $params;
	}
	public function render()
	{
		$visitor = \XF::visitor();
		$options = \XF::options();

		if (!$options->siropuChatEnabled)
		{
			return;
		}

		if (!$visitor->canViewSiropuChat())
		{
			return;
		}

		if ($visitor->isBannedSiropuChat())
		{
			return;
		}

		if (!\Siropu\Chat\Criteria\Device::isMatched($this->options['device']))
		{
			return;
		}

		$contextParams  = $this->contextParams;
		$position       = isset($contextParams['position']) ? $contextParams['position'] : 'custom';
		$controllerName = $this->app->router()->routeToController($this->app->request()->getRoutePath())->getController();
		$controllerList = [
			'Siropu\Chat:Chat',
			'Siropu\Chat:Room',
			'Siropu\Chat:Conversation',
			'Siropu\Chat:Archive',
			'Siropu\AdsManager:Home',
			'Siropu\AdsManager:Package',
			'Siropu\AdsManager:Ad',
			'Siropu\AdsManager:Invoice'
		];

		$extraParams    = !empty($contextParams['params']) ? $contextParams['params'] : [];
		$isChatPage     = !empty($extraParams['chatpage']) ?: false;
		$isFullPage     = !empty($extraParams['fullpage']) ?: false;

		$settings       = $this->getChatData()->getSettings();
		$cssClass       = $this->getChatData()->getCssClass($isChatPage);

		$displayMode    = $settings['display_mode'];

		$positions      = [
			'all_pages',
			'above_forum_list',
			'below_forum_list',
			'above_content',
			'below_content',
			'sidebar_top',
			'sidebar_bottom',
			'custom'
		];

		if (in_array($position, $positions) && in_array($controllerName, $controllerList))
		{
			return;
		}

		if ($position == 'chat_page')
		{
			$displayMode = 'chat_page';
		}

		if ($displayMode != $position && $position != 'custom')
		{
			return;
		}

		if ($settings['disable'] && !$isChatPage)
		{
			return $this->renderer('siropu_chat_disabled', ['cssClass' => $cssClass]);
		}
		else if (!\Siropu\Chat\Criteria\Time::isTime($this->options))
		{
			if ($this->options['message'])
			{
				return $this->renderer('siropu_chat_closed', ['cssClass' => $cssClass, 'message' => $this->options['message']]);
			}
		}
		else
		{
			$extraParams['messageDisplayLimit'] = $this->options['message_display_limit'];

			return $this->renderer('siropu_chat', ['chat' => $this->getChatData()->getViewParams($extraParams)]);
		}
	}
	public function verifyOptions(\XF\Http\Request $request, array &$options, &$error = null)
	{
		$options = $request->filter([
			'message_display_limit' => 'uint',
			'device'                => 'array',
			'days'                  => 'array',
			'hours'                 => 'array',
			'message'               => 'str'
		]);

		return true;
	}
	public function getChatData()
	{
		$class = $this->app->extendClass('Siropu\Chat\Data');
		return new $class();
	}
}
