<?php

namespace Siropu\Chat\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Room extends Entity
{
     public static function getStructure(Structure $structure)
	{
          $structure->table      = 'xf_siropu_chat_room';
          $structure->shortName  = 'Chat:Room';
          $structure->primaryKey = 'room_id';

          $structure->columns = [
               'room_id'            => ['type' => self::UINT, 'autoIncrement' => true],
               'room_user_id'       => ['type' => self::UINT, 'default' => \XF::visitor()->user_id],
               'room_name'          => ['type' => self::STR, 'maxLength' => 100, 'required' => 'siropu_chat_room_name_required', 'unique' => 'siropu_chat_room_name_must_be_unique'],
               'room_description'   => ['type' => self::STR, 'maxLength' => 255, 'required' => 'siropu_chat_room_description_required'],
               'room_password'      => ['type' => self::STR, 'maxLength' => 15, 'default' => ''],
               'room_user_groups'   => ['type' => self::SERIALIZED_ARRAY, 'default' => []],
               'room_readonly'      => ['type' => self::UINT, 'default' => 0],
               'room_locked'        => ['type' => self::UINT, 'default' => 0],
               'room_prune'         => ['type' => self::UINT, 'default' => 0],
               'room_thread_id'     => ['type' => self::UINT, 'default' => 0],
               'room_date'          => ['type' => self::UINT, 'default' => \XF::$time],
               'room_user_count'    => ['type' => self::UINT, 'default' => 0],
               'room_last_activity' => ['type' => self::UINT, 'default' => 0],
               'room_last_prune'    => ['type' => self::UINT, 'default' => 0],
               'room_state'         => ['type' => self::STR, 'default' => 'visible', 'allowedValues' => ['visible', 'deleted']]
          ];

          $structure->getters   = [];
          $structure->relations = [
               'User' => [
                    'entity'     => 'XF:User',
                    'type'       => self::TO_ONE,
                    'conditions' => [['user_id', '=', '$room_user_id']]
               ]
          ];

          return $structure;
     }
     public function isMain()
     {
          return $this->room_id == 1;
     }
     public function isActive()
     {
          $visitor = \XF::visitor();

          return $this->room_id == $visitor->getLastRoomIdSiropuChat();
     }
     public function canJoin($password = null)
     {
          $visitor = \XF::visitor();

          if ($visitor->canJoinAnyRoomSiropuChat())
          {
               return true;
          }

          if ($visitor->user_id == $this->room_user_id)
          {
               return true;
          }

          if ($this->isLocked())
          {
               return false;
          }

          if ($this->room_password && !($this->room_password == $password || $visitor->hasPermission('siropuChat', 'bypassRoomPassword')))
          {
               return false;
          }

          if ($this->room_user_groups && !$visitor->isMemberOf($this->room_user_groups))
          {
               return false;
          }

          return true;
     }
     public function canJoinMore(&$error = null)
     {
          $visitor   = \XF::visitor();
          $joinLimit = $visitor->canJoinSiropuChatRooms();

          if ($joinLimit >= 1 && count($visitor->siropu_chat_rooms) >= $joinLimit)
          {
               if ($joinLimit > 1)
               {
                    $error = \XF::phraseDeferred('siropu_chat_you_cannot_join_more_than_x_rooms', ['limit' => $joinLimit]);
               }
               else
               {
                    $error = \XF::phraseDeferred('siropu_chat_you_cannot_join_more_than_one_room');
               }

               return false;
          }

          return true;
     }
     public function canEdit()
     {
          $visitor = \XF::visitor();

          if ($visitor->user_id == $this->room_user_id || $visitor->hasPermission('siropuChat', 'editAnyRoom'))
          {
               return true;
          }
     }
     public function canDelete()
     {
          $visitor = \XF::visitor();

          if ($this->isMain())
          {
               return false;
          }

          if ($visitor->user_id == $this->room_user_id || $visitor->hasPermission('siropuChatModerator', 'deleteAnyRoom'))
          {
               return true;
          }
     }
     public function isJoined()
     {
          $visitor = \XF::visitor();

          return $visitor->hasJoinedRoomSiropuChat($this->room_id);
     }
     public function isReadOnly()
     {
          return $this->room_readonly == 1;
     }
     public function isLocked(&$error = null)
     {
          if ($this->room_locked && $this->room_locked > \XF::$time)
          {
               $error = \XF::phraseDeferred('siropu_chat_room_is_locked_until', [
                    'date' => \XF::language()->date($this->room_locked, 'M d, Y')
               ]);

               return true;
          }
     }
     public function isSanctionNotice()
     {
          $visitor = \XF::visitor();

          if ($visitor->isSanctionedSiropuChat() && ($sanction = $visitor->siropuChatGetRoomSanction($this->room_id)))
          {
               return $sanction->getNotice();
          }
     }
     public function getUserCount($users)
     {
          return !empty($users[$this->room_id]) ? count($users[$this->room_id]) : 0;
     }
     public function getActiveUsers()
     {
          return $this->app()->repository('Siropu\Chat:User')
               ->findActiveUsers()
               ->where('siropu_chat_room_id', $this->room_id)
               ->fetch();
     }
     protected function _postSave()
	{
          \XF::repository('Siropu\Chat:Room')->rebuildRoomCache();
	}
	protected function _postDelete()
	{
          \XF::repository('Siropu\Chat:Room')->rebuildRoomCache();
          \XF::repository('Siropu\Chat:Message')->pruneRoomMessages($this->room_id);
          \XF::repository('Siropu\Chat:Sanction')->deleteRoomSanctions($this->room_id);
	}
}
