<?php

namespace Siropu\Chat\XF\Entity;

class User extends XFCP_User
{
     public function canViewSiropuChat()
	{
          return $this->hasPermission('siropuChat', 'viewChat');
     }
     public function canUseSiropuChat()
	{
          return $this->hasPermission('siropuChat', 'useChat');
     }
     public function canJoinAnyRoomSiropuChat()
     {
          return $this->hasPermission('siropuChatModerator', 'joinAnyRoom');
     }
     public function canJoinSiropuChatRooms()
     {
          $joinRooms = $this->hasPermission('siropuChat', 'joinRooms');

          if ($joinRooms != 0)
          {
               return $joinRooms;
          }
     }
     public function canCreateSiropuChatRooms()
     {
          return $this->hasPermission('siropuChat', 'createRooms');
     }
     public function canPasswordProtectSiropuChatRooms()
     {
          return $this->hasPermission('siropuChat', 'passwordProtectRooms');
     }
     public function canViewSiropuChatArchive()
     {
          return $this->hasPermission('siropuChat', 'viewArchive');
     }
     public function canSearchSiropuChatArchive()
     {
          return $this->hasPermission('siropuChat', 'searchArchive');
     }
     public function canViewSiropuChatTopChatters()
     {
          return $this->hasPermission('siropuChat', 'viewTopChatters');
     }
     public function canViewSiropuChatSanctions()
     {
          return $this->hasPermission('siropuChat', 'viewSanctioned');
     }
     public function canEditSiropuChatRules()
     {
          return $this->hasPermission('siropuChatAdmin', 'editRules');
     }
     public function canEditSiropuChatNotice()
     {
          return $this->hasPermission('siropuChatAdmin', 'editNotice');
     }
     public function canEditSiropuChatAds()
     {
          return $this->hasPermission('siropuChatAdmin', 'editAds');
     }
     public function canWhisperSiropuChat()
     {
          return $this->hasPermission('siropuChat', 'whisper');
     }
     public function canChatInPrivateSiropuChat()
     {
          return $this->hasPermission('siropuChat', 'chatInPrivate');
     }
     public function canSetMessageColorSiropuChat()
     {
          return $this->hasPermission('siropuChat', 'setColor');
     }
     public function canChangeDisplayModeSiropuChat()
     {
          return $this->hasPermission('siropuChat', 'changeDisplayMode');
     }
     public function canReportSiropuChatMessages()
     {
          return $this->hasPermission('siropuChat', 'reportMessages');
     }
     public function canBypassSiropuChatFloodCheck()
     {
          return $this->hasPermission('siropuChat', 'bypassFloodCheck');
     }
     public function canPruneSiropuChatMessages()
     {
          return $this->hasPermission('siropuChatModerator', 'prune');
     }
     public function canSetSiropuChatStatus()
     {
          return \XF::options()->siropuChatStatus && $this->hasPermission('siropuChat', 'setStatus');
     }
     public function canUploadSiropuChatImages()
     {
          $uploadLimit = $this->hasPermission('siropuChat', 'uploadImages');

          if ($uploadLimit == 0)
          {
               return false;
          }

          if ($uploadLimit >= 1)
          {
               return $uploadLimit;
          }

          return 1000;
     }
     public function canAlertMentionSiropuChatUser($user)
     {
          return !$user->isIgnoring($this->user_id)
               && $user->getSiropuChatSettings()['mention_alert']
               && !$user->isBannedSiropuChat()
               && $this->user_id != $user->user_id;
     }
     public function canMessageSiropuChatUser($user)
     {
          return $this->canChatInPrivateSiropuChat()
               && $user->canChatInPrivateSiropuChat()
               && !$user->isIgnoring($this->user_id)
               && !$user->isBannedSiropuChat()
               && $this->user_id != $user->user_id;
     }
     public function isInConversationWithSiropuChatUser($user)
     {
          return in_array($user->user_id, $this->siropuChatGetConversations());
     }
     public function canSanctionSiropuChat()
     {
          return $this->hasPermission('siropuChatModerator', 'sanction');
     }
     public function canSanctionSiropuChatUser($user)
     {
          return $this->canSanctionSiropuChat() && $user->canBeSanctionedSiropuChat() && $this->user_id != $user->user_id;
     }
     public function canBeSanctionedSiropuChat()
     {
          return !($this->is_admin || $this->is_staff);
     }
     public function isSanctionedSiropuChat()
     {
          return $this->siropu_chat_is_sanctioned > 0;
     }
     public function isMutedSiropuChat()
     {
          return $this->siropu_chat_is_sanctioned == 2;
     }
     public function isBannedSiropuChat()
     {
          return $this->siropu_chat_is_sanctioned == 3;
     }
     public function canRoomAuthorSanctionSiropuChat()
     {
          return $this->hasPermission('siropuChat', 'roomAuthorSanction');
     }
     public function canRoomAuthorSanctionSiropuChatUser($user, $roomUserId)
     {
          return $this->canRoomAuthorSanctionSiropuChat()
               && $user->canBeSanctionedSiropuChat()
               && $this->user_id == $roomUserId
               && $this->user_id != $user->user_id;
     }
     public function hasJoinedRoomsSiropuChat()
     {
          $joinedRooms = $this->siropuChatGetJoinedRooms();
          return !empty($joinedRooms);
     }
     public function hasJoinedRoomSiropuChat($roomId)
     {
          return isset($this->siropuChatGetJoinedRooms()[$roomId]);
     }
     public function hasConversationsSiropuChat()
     {
          $conversations = $this->siropuChatGetConversations();
          return !empty($conversations);
     }
     public function hasConversationSiropuChat($convId)
     {
          return isset($this->siropuChatGetConversations()[$convId]);
     }
     public function getLastRoomIdSiropuChat()
     {
          $roomId = $this->app()->request()->getCookie('siropu_chat_room_id', $this->siropu_chat_room_id);
          return $roomId ?: \XF::options()->siropuChatGuestRoom;
     }
     public function getLastConvIdSiropuChat()
     {
          return $this->app()->request()->getCookie('siropu_chat_conv_id', $this->siropu_chat_conv_id);
     }
     public function getSiropuChatActivityStatus($roomId = null)
     {
          if ($roomId)
          {
               $lastActivity = $this->siropu_chat_rooms[$roomId];
          }
          else
          {
               $lastActivity = $this->siropu_chat_last_activity;
          }

          $lastActivityDiff = \XF::$time - $lastActivity;

          if ($lastActivityDiff <= \XF::options()->siropuChatActiveStatusTimeout * 60)
          {
               return 'active';
          }
          else
          {
               return 'idle';
          }
     }
     public function isActiveSiropuChat($lastActivity = 0)
     {
          if (!$this->user_id && \XF::options()->siropuChatGuestRoom)
          {
               $guestService = $this->app()->service('Siropu\Chat:Guest\Manager');

               if ($guest = $guestService->getGuest())
               {
                    $lastActivity = $guest['lastActivity'];
               }
          }

          $lastActivity = $lastActivity ?: $this->siropu_chat_last_activity;

          return $lastActivity >= $this->repository('Siropu\Chat:User')->getActivityTimeout();
     }
     public function siropuChatIncrementMessageCount()
     {
          $this->siropu_chat_message_count++;
     }
     public function siropuChatDecrementMessageCount()
     {
          $this->siropu_chat_message_count--;
     }
     public function siropuChatSetLastActivity($time = null)
     {
          $this->siropu_chat_last_activity = $time ?: \XF::$time;
     }
     public function siropuChatSetActiveRoom($roomId)
     {
          $this->siropu_chat_room_id = $roomId;

          if ($this->getLastRoomIdSiropuChat() != $roomId)
          {
               $this->app()->response()->setCookie('siropu_chat_room_id', $roomId);
          }
     }
     public function siropuChatUpdateRooms($roomId, $lastActivity = true)
     {
          if (empty($roomId))
          {
               return;
          }

          $rooms = $this->siropu_chat_rooms ?: [];

          if ($lastActivity)
          {
               $time = \XF::$time;
          }
          else
          {
               $time = 0;
          }

          $this->siropu_chat_rooms = array_replace($rooms, [$roomId => $time]);

          if (!isset($rooms[$roomId]) && $lastActivity)
          {
               $notifier = $this->app()->service('Siropu\Chat:Room\Notifier', $this, $roomId);
               $notifier->notify('join');
          }
     }
     public function siropuChatLeaveRoom($roomId, $notify = true, $message = '')
     {
          $rooms = $this->siropu_chat_rooms;
          unset($rooms[$roomId]);

          $this->siropu_chat_rooms = $rooms;

          if (empty($rooms))
          {
               $this->siropu_chat_last_activity = 0;
          }

          $this->siropu_chat_room_id = empty($rooms) ? 0 : current(array_keys($rooms));

          if ($notify)
          {
               $notifier = $this->app()->service('Siropu\Chat:Room\Notifier', $this, $roomId, ['message' => $message]);
               $notifier->notify('leave');
          }
     }
     public function siropuChatLogout($message = '')
     {
          foreach ($this->siropuChatGetRoomIds() as $roomId)
          {
               $this->siropuChatLeaveRoom($roomId, true, $message);
          }

          $this->siropu_chat_last_activity = 0;
          $this->siropu_chat_room_id = 0;

          $this->app()->response()->setCookie('siropu_chat_room_id', false);
     }
     public function siropuChatGetJoinedRooms()
     {
          $rooms = $this->siropu_chat_rooms ?: [];

          if (!$this->user_id && ($roomId = \XF::options()->siropuChatGuestRoom))
          {
               $rooms[$roomId] = \XF::$time;
          }

          return $rooms;
     }
     public function siropuChatGetRoomIds()
     {
          return array_keys($this->siropuChatGetJoinedRooms());
     }
     public function siropuChatGetConversations()
     {
          return $this->siropu_chat_conversations ?: [];
     }
     public function siropuChatGetConvIds()
     {
          return array_keys($this->siropuChatGetConversations());
     }
     public function siropuChatSetStatus($status, &$reply = null)
     {
          $status = $this->app()->stringFormatter()->wholeWordTrim($status, \XF::options()->siropuChatStatusMaxLength);
          $this->siropu_chat_status = $status;

          if ($status)
          {
               $reply = \XF::phrase('siropu_chat_your_status_has_beed_set_to_x', ['status' => $status]);
          }
          else
          {
               $reply = \XF::phrase('siropu_chat_your_status_has_beed_removed');
          }
     }
     public function siropuChatGetUserSanctions()
     {
          return $this->repository('Siropu\Chat:Sanction')->findUserSanctions($this->user_id);
     }
     public function siropuChatGetRoomSanction($roomId)
     {
          return $this->repository('Siropu\Chat:Sanction')->findRoomUserSanction($roomId, $this->user_id);
     }
     public function siropuChatGetUserWrapper($at = null)
	{
          return '[USER=' . $this->user_id . ']' . ($at ? '@' : '') . $this->username . '[/USER]';
     }
     public function siropuChatLeaveConversation($convId)
     {
          $conversations = $this->siropu_chat_conversations;
          unset($conversations[$convId]);

          $this->siropu_chat_conversations = $conversations;
          $this->siropu_chat_conv_id = empty($conversations) ? 0 : current(array_keys($conversations));
     }
     public function siropuChatJoinConversation($convId, $userId)
     {
          $this->siropu_chat_conversations = array_replace($this->siropuChatGetConversations(), [$convId => $userId]);
     }
     public function getSiropuChatSettings()
     {
          $options = \XF::options();

          return array_replace_recursive([
                    'sound'         => $options->siropuChatDefaultSoundSettings,
                    'notification'  => $options->siropuChatDefaultNotificationSettings,
                    'display_mode'  => $options->siropuChatDisplayMode,
                    'message_color' => ''
               ],
               $options->siropuChatDefaultMiscSettings,
               $this->siropu_chat_settings ?: []
          );
     }
}
