<?php

namespace Siropu\Chat\ControllerPlugin;

class Room extends \XF\ControllerPlugin\AbstractPlugin
{
	public function checkPermissionsAndJoin(\Siropu\Chat\Entity\Room $room)
	{
		$visitor = \XF::visitor();

		if (!$room->canJoin($this->filter('password', 'str')))
          {
			return $this->message(\XF::phrase('siropu_chat_room_permission_denied'));
          }

		if (!$room->canJoinMore($error))
		{
			return $this->message($error);
		}

          if ($notice = $room->isSanctionNotice())
          {
			return $this->message($notice);
          }

          if ($room->isLocked($error) && !$visitor->canJoinAnyRoomSiropuChat())
          {
               return $this->message($error);
          }

          if ($room->isJoined())
          {
               return $this->message(\XF::phrase('siropu_chat_room_already_joined'));
          }

		return $this->joinRoom($room);
	}
	public function joinRoom(\Siropu\Chat\Entity\Room $room)
	{
		$visitor = \XF::visitor();
          $visitor->siropuChatUpdateRooms($room->room_id);
          $visitor->siropuChatSetActiveRoom($room->room_id);
          $visitor->siropuChatSetLastActivity(\XF::$time - \XF::options()->siropuChatFloodCheckLength);
          $visitor->save();

          return $this->controller->plugin('Siropu\Chat:Update')->getUpdates([
               'action'   => 'join',
               'roomId'   => $room->room_id,
               'roomName' => $room->room_name,
               'roomTab'  => $this->app->templater()->renderTemplate('public:siropu_chat_room_tab', ['room' => $room])
          ]);
	}
}
