<?php

namespace Siropu\Chat\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class User extends Repository
{
     public function findTopUsers($limit = 5)
     {
		return $this->repository('XF:User')
               ->findValidUsers()
               ->where('siropu_chat_message_count', '>', 0)
               ->order('siropu_chat_message_count', 'DESC')
               ->limit($limit);
     }
     public function findActiveUsers()
     {
          $options = \XF::options();

          switch ($options->siropuChatUsersOrder)
          {
               case 'most_active':
                    $field     = 'siropu_chat_last_activity';
                    $direction = 'DESC';
                    break;
               case 'alphabetically':
                    $field     = 'username';
                    $direction = 'ASC';
                    break;
          }

		return $this->finder('XF:User')
               ->where('siropu_chat_last_activity', '>=', $this->getActivityTimeout())
               ->order($field, $direction);
     }
     public function getActiveUserCount()
     {
          return $this->finder('XF:User')
               ->where('siropu_chat_last_activity', '>=', $this->getActivityTimeout())
               ->total();
     }
     public function getActivityTimeout()
     {
          $options         = \XF::options();
          $activityTimeout = $options->siropuChatActiveStatusTimeout + $options->siropuChatIdleStatusTimeout;

          return strtotime("-$activityTimeout Minutes");
     }
     public function groupUsersByRoom($users)
     {
          $group = [];

          foreach ($users AS $user)
          {
               foreach ($user->siropu_chat_rooms AS $roomId => $lastActivity)
               {
                    if ($user->isActiveSiropuChat($lastActivity))
                    {
                         $group[$roomId][] = $user;
                    }
               }
          }

          if ($guestRoomId = \XF::options()->siropuChatGuestRoom)
          {
               $guestServiceManager = \XF::service('Siropu\Chat:Guest\Manager');

               foreach ($guestServiceManager->getGuestsForDisplay() as $guest)
               {
                    $group[$guestRoomId][] = $guest;
               }
          }

          return $group;
     }
     public function joinDefaultRooms(array $defaultRooms = [])
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          $defaultRooms = $defaultRooms ?: $options->siropuChatDefaultJoinedRooms;

          if ($options->siropuChatRooms
               && $defaultRooms
               && $visitor->user_id
               && $visitor->canJoinSiropuChatRooms()
               && $visitor->siropu_chat_last_activity == -1)
          {
               foreach ($this->finder('Siropu\Chat:Room')->where('room_id', $defaultRooms)->fetch() as $room)
               {
                    if ($room->canJoin())
                    {
                         $visitor->siropuChatUpdateRooms($room->room_id, false);
                    }
               }

               $visitor->siropu_chat_last_activity = 0;
               $visitor->save();
          }
     }
     public function autoLoginJoinedRooms($isChatPage = false)
     {
          $visitor   = \XF::visitor();
          $options   = \XF::options();

          $userRooms = $visitor->siropu_chat_rooms;
          $autoLogin = $options->siropuChatAutoLoginUsers;

          if (!($visitor->user_id && !empty($userRooms)))
          {
               return;
          }

          if ($autoLogin == 'any' || $autoLogin == 'chat' && $isChatPage)
          {
               $updateRooms = false;

               foreach ($userRooms as $roomId => $lastActive)
               {
                    if (!$visitor->isActiveSiropuChat($lastActive))
                    {
                         $userRooms[$roomId] = \XF::$time;

                         $updateRooms = true;
                    }
               }

               if ($updateRooms)
               {
                    $visitor->siropuChatSetLastActivity();
                    $visitor->siropu_chat_rooms = $userRooms;
                    $visitor->save();
               }
          }
     }
}
