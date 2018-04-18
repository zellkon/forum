<?php

namespace Siropu\Chat\Pub\View;

class Chat extends \XF\Mvc\View
{
	public function renderJson()
	{
		$visitor     = \XF::visitor();

		$params      = $this->getParams();

		$rooms       = [];
		$roomCache   = \XF::app()->repository('Siropu\Chat:Room')->getRoomCache();
		$joinedRooms = $visitor->siropuChatGetRoomIds();

		$class       = \XF::app()->extendClass('Siropu\Chat\Data');
		$chatData    = new $class();

		$templater   = \XF::app()->templater();

		foreach ($joinedRooms AS $roomId)
		{
			$rooms[$roomId] = [
				'messages' => $templater->renderMacro('public:siropu_chat_message_list', 'room', [
					'messages' => !empty($params['messages'][$roomId]) ? $params['messages'][$roomId] : []
				]),
				'users' =>  $templater->renderMacro('public:siropu_chat_user_list', 'room', [
					'users'      => !empty($params['users'][$roomId]) ? $params['users'][$roomId] : [],
					'roomId'     => $roomId,
					'roomUserId' => $roomCache[$roomId]['room_user_id']
				]),
				'userCount' => !empty($params['users'][$roomId]) ? count($params['users'][$roomId]) : 0
			];
		}

		$lastRow = [];

		if (!empty($params['lastMessage']))
		{
			$lm = $params['lastMessage'];
			$avatar = $lm->User ? $lm->User->getAvatarUrl('l', null, true) : '';

			$lastRow = [
				'id'      => $lm->message_id,
				'roomId'  => $lm->message_room_id,
				'type'    => $lm->message_type,
				'message' => $templater->renderMacro('public:siropu_chat_room_message_helper', 'message_content', ['message' => $lm, 'lastRow' => true]) . $templater->fn('date_dynamic', [$lm->message_date, ['class' => 'siropuChatDateTime']]),
				'text'    => \XF::app()->stringFormatter()->stripBbCode($lm->message_text),
				'avatar'  => $avatar ?: '',
				'date'    => $lm->message_date
			];
		}

		$convContacts  = [];
		$convMessages  = [];

		if (!empty($params['convContacts']))
		{
			$convContacts = $templater->renderMacro('public:siropu_chat_user_list', 'conversation', [
				'conversations' => $params['convContacts']
			]);
		}

		if (!empty($params['convMessages']))
		{
			foreach ($params['convMessages'] AS $convId => $messages)
			{
				$convMessages[$convId] = $templater->renderMacro('public:siropu_chat_message_list', 'conversation', [
					'messages' => $messages
				]);
			}
		}

		$convLastRow = [];

		if (!empty($params['convLastMessage']))
		{
			$lm = $params['convLastMessage'];
			$avatar = $lm->User ? $lm->User->getAvatarUrl('l', null, true) : '';

			$convLastRow = [
				'id'     => $lm->message_id,
				'convId' => $lm->message_conversation_id,
				'type'   => 'private',
				'text'   => \XF::app()->stringFormatter()->stripBbCode($lm->message_text),
				'avatar' => $avatar ?: '',
				'date'   => $lm->message_date
			];
		}

		$noticeHtml = '';

		if ($notice = $chatData->getNotice())
		{
			$noticeHtml = $templater->renderMacro('public:siropu_chat_notice_macros', 'notice', ['notice' => $notice]);
		}

		if ($chatData->getChannel() == 'conv')
		{
			$convLastActive = \XF::app()->request()->filter('conv_last_active', 'uint');
		}
		else
		{
			$convLastActive = 0;
		}

		return [
			'active'        => $visitor->isActiveSiropuChat($convLastActive),
			'rooms'         => $rooms,
			'joinedRooms'   => $joinedRooms ?: 0,
			'lastRow'       => $lastRow,
			'lastId'        => !empty($params['lastRoomIds']) ? $params['lastRoomIds'] : [],
			'userCount'     => !empty($params['userCount']) ? $params['userCount'] : 0,
			'playSound'     => !empty($params['playSound']) ? $params['playSound'] : '',
			'convContacts'  => $convContacts,
			'convMessages'  => $convMessages,
			'convLastRow'   => $convLastRow,
			'convUnread'    => !empty($params['convUnread']) ? $params['convUnread'] : '',
			'convOnline'    => !empty($params['convOnline']) ? $params['convOnline'] : 0,
			'convPlaySound' => !empty($convMessages) ? 'private' : '',
			'actions'       => \XF::app()->service('Siropu\Chat:Room\ActionLogger')->getActions(),
			'notice'        => $noticeHtml,
			'serverTime'    => \XF::$time
		] + (isset($params['params']) ? $params['params'] : []);
	}
}
