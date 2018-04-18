<?php

namespace Siropu\Chat\Pub\Controller;

use XF\Mvc\ParameterBag;

class Room extends AbstractController
{
     public function actionIndex(ParameterBag $params)
     {
          if (!$this->isLoggedIn())
          {
               return $this->noPermission();
          }

          $room = $this->assertRoomExists($params->room_id);

          if (!$room->isJoined())
          {
               if (!$room->canJoin($this->filter('password', 'str')))
               {
                    return $this->view('', 'siropu_chat_room_join', ['room' => $room]);
               }
          }

          $this->app()->response()->setCookie('siropu_chat_room_id', $room->room_id);

          $visitor = \XF::visitor();
          $visitor->siropuChatUpdateRooms($room->room_id);
          $visitor->siropuChatSetActiveRoom($room->room_id);
          $visitor->siropuChatSetLastActivity();
          $visitor->save();

          if ($visitor->getLastRoomIdSiropuChat() != $room->room_id)
          {
               return $this->redirect($this->buildLink('chat/room', $room));
          }

          $viewParams = [
               'channel'    => 'room',
               'isFullPage' => $this->filter('fullpage', 'bool')
          ];

          return $this->plugin('Siropu\Chat:Chat')->loadChat($viewParams);
     }
     public function actionCreate()
     {
          $visitor = \XF::visitor();

          if (!$visitor->canCreateSiropuChatRooms())
          {
               throw $this->exception($this->noPermission());
          }

          $room = $this->em()->create('Siropu\Chat:Room');
          return $this->roomAddEdit($room);
     }
     public function actionLink(ParameterBag $params)
     {
          $room = $this->assertRoomExists($params->room_id);

          $viewParams = [
               'room' => $room
          ];

          return $this->view('', 'siropu_chat_room_link', $viewParams);
     }
     protected function roomAddEdit(\Siropu\Chat\Entity\Room $room)
     {
          $viewParams = [
               'room'       => $room,
               'userGroups' => $this->repository('XF:UserGroup')->findUserGroupsForList()->fetch()
          ];

          return $this->view('', 'siropu_chat_room_edit', $viewParams);
     }
     public function actionEdit(ParameterBag $params)
     {
          $room = $this->assertRoomExistsAndCanEdit($params->room_id);
          return $this->roomAddEdit($room);
     }
     public function actionSave(ParameterBag $params)
     {
          $this->assertPostOnly();

          $visitor = \XF::visitor();

          if (!$visitor->canCreateSiropuChatRooms())
          {
               return $this->noPermission();
          }

          if ($params->room_id)
          {
               $room = $this->assertRoomExistsAndCanEdit($params->room_id);
          }
          else
          {
               $room = $this->em()->create('Siropu\Chat:Room');
          }

          if ($visitor->canPasswordProtectSiropuChatRooms())
          {
               $room->room_password = $this->filter('room_password', 'str');
          }

          if ($visitor->is_admin)
          {
               $room->room_user_groups = $this->filter('room_user_groups', 'array-uint');
               $room->room_readonly = $this->filter('room_readonly', 'bool');
               $room->room_locked = $this->filter('room_locked', 'datetime');
               $room->room_prune = $this->filter('room_prune', 'uint');
               $room->room_thread_id = $this->filter('room_thread_id', 'uint');

               if ($room->room_prune)
               {
                    if (!$room->room_last_prune)
                    {
                         $room->room_last_prune = \XF::$time;
                    }
               }
               else
               {
                    $room->room_last_prune = 0;
               }
          }

          $input = $this->filter([
			'room_name'        => 'str',
			'room_description' => 'str'
		]);

          $room->bulkSet($input);
          $room->save();

          if ($this->filter('join_room', 'bool'))
          {
               return $this->plugin('Siropu\Chat:Room')->joinRoom($room);
          }

          if ($room->isUpdate())
          {
               return $this->view();
          }

          $reply = $this->view('Siropu\Chat:RoomList', 'siropu_chat_room_list');
          $reply->setJsonParams(['room_id' => $room->room_id]);

          return $reply;
     }
     public function actionDelete(ParameterBag $params)
     {
          $room = $this->assertRoomExists($params->room_id);

          if ($room->isMain())
          {
               return $this->error(\XF::phrase('siropu_chat_room_cannot_be_deleted'));
          }

          if (!$room->canDelete())
          {
               return $this->noPermission();
          }

          if ($this->isPost())
          {
               $room->delete();

               if ($room->isJoined())
               {
                    $visitor = \XF::visitor();
                    $visitor->siropuChatLeaveRoom($room->room_id);
                    $visitor->save();
               }

               $reply = $this->view();
               $reply->setJsonParams(['room_id' => $room->room_id]);

               return $reply;
          }

          $viewParams = [
               'room' => $room
          ];

          return $this->view('', 'siropu_chat_room_delete', $viewParams);
     }
     public function actionList()
     {
          $viewParams = [
               'rooms' => $this->getRoomRepo()->findRoomsForList()->fetch(),
               'users' => $this->getUserRepo()->groupUsersByRoom($this->getUserRepo()->findActiveUsers()->fetch())
          ];

          return $this->view('Siropu\Chat:RoomList', 'siropu_chat_room_list', $viewParams);
     }
     public function actionJoin(ParameterBag $params)
     {
          $this->assertPostOnly();

          if (!$this->isLoggedIn())
          {
               return $this->noPermission();
          }

          return $this->plugin('Siropu\Chat:Room')->checkPermissionsAndJoin($this->assertRoomExists($params->room_id));
     }
     public function actionLeave(ParameterBag $params)
     {
          $room = $this->assertRoomExists($params->room_id);

          if (!$this->isLoggedIn())
          {
               return $this->view();
          }

          if (!$room->isJoined())
          {
               return $this->noPermission();
          }

          $visitor = \XF::visitor();
          $visitor->siropuChatLeaveRoom($params->room_id);
          $visitor->save();

          $jsonParams = [
               'roomId' => $params->room_id,
               'action' => 'leave'
          ];

          if ($this->filter('widget', 'bool'))
          {
               $jsonParams['message'] = \XF::phrase('siropu_chat_you_have_left_the_room_x', ['name' => $room->room_name]);
          }

          $reply = $this->view();
          $reply->setJsonParams($jsonParams);

          return $reply;
     }
     public function actionSanctions(ParameterBag $params)
     {
          $room    = $this->assertRoomExists($params->room_id);
          $page    = $this->filterPage($params->page);
          $perPage = 25;

          $sanctionFinder = $this->getSanctionRepo()
               ->findSanctions()
               ->forRoom($room->room_id)
               ->limitByPage($page, $perPage, 1);

          $sanctions      = $sanctionFinder->fetch();
          $hasMore        = $sanctions->count() > $perPage;
		$sanctions      = $sanctions->slice(0, $perPage);
		$sanctionsCount = $sanctionFinder->total();

          $viewParams = [
               'room'      => $room,
               'sanctions' => $sanctions,
               'perPage'   => $perPage,
			'total'     => $sanctionsCount,
               'page'      => $page,
			'hasMore'   => $hasMore
          ];

          return $this->view('', 'siropu_chat_room_sanctions', $viewParams);
     }
     public function actionFind()
     {
          $q = ltrim($this->filter('q', 'str', ['no-trim']));

          if ($q !== '' && utf8_strlen($q) >= 2)
		{
			$roomFinder = $this->finder('Siropu\Chat:Room');
			$rooms = $roomFinder->where('room_name', 'like', $roomFinder->escapeLike($q, '?%'))->fetch(10);
		}
		else
		{
			$rooms = [];
			$q     = '';
		}

          $viewParams = [
			'rooms' => $rooms,
               'q'     => $q
		];

		return $this->view('Siropu\Chat:Room\Find', '', $viewParams);
     }
     public function actionLoadMoreMessages(ParameterBag $params)
     {
          $room = $this->assertRoomExists($params->room_id);

          if (!$room->isJoined())
          {
               return $this->noPermission();
          }

          $finder = $this->getMessageRepo()
               ->findMessages()
               ->fromRoom($room->room_id)
               ->idSmallerThan($this->filter('message_id', 'uint'))
               ->defaultLimit();

          if ($this->getChatSettings()['hide_bot'])
		{
			$finder->notFromType('bot');
		}

          if (!$this->getChatSettings()['show_ignored'])
          {
               $finder->notFromIgnoredUsers();
          }

          if ($text = $this->filter('find', 'string'))
          {
               $finder->havingText($text);
          }

          $messages = $finder->fetch()->filter(function(\Siropu\Chat\Entity\Message $message)
          {
               return ($message->canView());
          });

          if (!$this->getChatSettings()['inverse'])
          {
               $messages = $messages->reverse();
          }

          $viewParams = [
               'messages' => $messages,
               'hasMore'  => $messages->count() == \XF::options()->siropuChatMessageDisplayLimit,
               'find'     => ''
          ];

          return $this->view('Siropu\Chat:Message\Find', '', $viewParams);
     }
     public function actionSanction(ParameterBag $params)
     {
          $room = $this->assertRoomExists($params->room_id);
          $user = $this->assertUserExists($params->user_id);
          $type = $this->filter('sanction_type', 'str');

          $visitor = \XF::visitor();

          if (!($visitor->canRoomAuthorSanctionSiropuChatUser($user, $room->room_user_id)))
          {
               return $this->noPermission();
          }

          if ($this->isPost())
          {
               $length = $this->filter('length', 'uint');
               $reason = $this->filter('reason', 'str');

               if ($length > 24)
               {
                    $length = 24;
               }

               $data = [
                    'room_id'  => $room->room_id,
                    'end_date' => strtotime("+$length Hours"),
                    'reason'   => $reason
               ];

               $sanctionService = $this->service('Siropu\Chat:Sanction\Manager', $user, null, $data);
               $sanctionService->bypassPermissionCheck();
               $sanctionService->applySanction($type);

               $reply = $this->message(\XF::phrase('siropu_chat_x_has_been_sanctioned_for_x_hours', [
                    'user'   => $user->username,
                    'length' => $length
               ]));

               $reply->setJsonParams([
                    'user_id'       => $user->user_id,
                    'sanction_type' => $type
               ]);

               return $reply;
          }

          $viewParams = [
               'room' => $room,
               'user' => $user
          ];

          return $this->view('Siropu\Chat:Room\Sanction', 'siropu_chat_room_sanction', $viewParams);
     }
     protected function assertRoomExistsAndCanEdit($id, $with = null)
	{
		$room = $this->assertRoomExists($id, $with);

          if (!$room->canEdit())
          {
               throw $this->exception($this->noPermission());
          }

          return $room;
	}
}
