<?php

namespace Siropu\Chat\ControllerPlugin;

class Update extends \XF\ControllerPlugin\AbstractPlugin
{
	public function getUpdates(array $params)
	{
		$visitor  = \XF::visitor();
          $options  = \XF::options();

		$settings = $visitor->getSiropuChatSettings();
		$whereOr  = [];

		if (!empty($params['lastId']))
		{
			foreach ($params['lastId'] as $roomId => $lastId)
			{
				if (isset($visitor->siropuChatGetJoinedRooms()[$roomId]))
				{
					$whereOr[] = [
						['message_room_id', $roomId],
						['message_id', '>', $lastId]
					];
				}
			}
		}

          $finder = $this->getMessageRepo()
			->findMessages()
			->defaultLimit();

		if (!$visitor->canSanctionSiropuChat())
		{
			$finder->notIgnored();
		}

          if (!empty($params['roomId']))
          {
               $finder->fromRoom($params['roomId']);
          }
          else if ($whereOr)
          {
			$finder->whereOr($whereOr);
          }
		else
		{
			$finder->fromRoom($visitor->siropuChatGetRoomIds());
		}

		if ($settings['hide_bot'] && empty($params['roomId']))
		{
			$finder->notFromType('bot');
		}

		if (!$settings['show_ignored'])
          {
               $finder->notFromIgnoredUsers();
          }

          $messages = $finder->fetch()->filter(function(\Siropu\Chat\Entity\Message $message)
		{
			return ($message->canView());
		});

		if ($params['action'] != 'submit')
		{
			$users = $this->repository('Siropu\Chat:User')->findActiveUsers()->fetch();
		}
		else
		{
			$users = [];
		}

		$messageSorterService = $this->service('Siropu\Chat:Message\Sorter');
		$messageSorterService->prepareForDisplay($messages);

		$userCount = count($users);

		if ($options->siropuChatGuestRoom)
		{
			$guestServiceManager = \XF::service('Siropu\Chat:Guest\Manager');
			$userCount += $guestServiceManager->getActiveGuestCount();
		}

          $viewParams = [
               'users'       => $this->getUserRepo()->groupUsersByRoom($users),
			'userCount'   => $userCount,
			'messages'    => $messageSorterService->getGroupedMessages(),
			'lastMessage' => $messageSorterService->getLastMessage(),
               'lastRoomIds' => $messageSorterService->getLastIds(),
			'playSound'   => $messageSorterService->getPlaySound(),
               'params'      => $params
          ];

		if ($params['action'] == 'update')
		{
			$viewParams = array_merge($viewParams, $this->getConvData($params));
		}

          return $this->view('Siropu\Chat:Chat', '', $viewParams);
	}
	public function getConvUpdates(array $params = [])
	{
		return $this->view('Siropu\Chat:Chat', '', $this->getConvData($params));
	}
	public function getConvData(array $params)
	{
		$visitor = \XF::visitor();
		$options = \XF::options();

		if (!($options->siropuChatPrivateConversations
               && $visitor->canChatInPrivateSiropuChat()
               && $visitor->hasConversationsSiropuChat()))
          {
			return [];
		}

		$contacts = $this->getConversationRepo()->getUserConversations();

		$finder = $this->getConversationMessageRepo()
			->findMessages()
			->forConversation($visitor->siropuChatGetConvIds());

		if (!empty($params['insert_id']))
		{
			$finder->where('message_id', '>=', $params['insert_id']);
		}
		else
		{
			$finder->unread();
		}

		$messages = $finder->fetch()->filter(function(\Siropu\Chat\Entity\ConversationMessage $message)
		{
			return ($message->canView());
		});

		$conversationPreparerService = $this->service('Siropu\Chat:Conversation\Preparer');
		$conversationPreparerService->prepareForDisplay($messages);

		return [
			'convContacts'    => $contacts->count() ? $contacts : [],
			'convMessages'    => $conversationPreparerService->getGroupedMessages(),
			'convLastMessage' => $conversationPreparerService->getLastMessage(),
			'convOnline'      => $conversationPreparerService->getOnlineCount($contacts),
			'convUnread'      => $conversationPreparerService->getUnread(),
			'params'          => $params
		];
	}
	protected function getMessageRepo()
	{
		return $this->repository('Siropu\Chat:Message');
	}
	protected function getUserRepo()
	{
		return $this->repository('Siropu\Chat:User');
	}
	protected function getConversationRepo()
	{
		return $this->repository('Siropu\Chat:Conversation');
	}
	protected function getConversationMessageRepo()
	{
		return $this->repository('Siropu\Chat:ConversationMessage');
	}
}
