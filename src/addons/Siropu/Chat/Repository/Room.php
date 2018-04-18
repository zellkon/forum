<?php

namespace Siropu\Chat\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class Room extends Repository
{
     public function findRooms()
     {
          return $this->finder('Siropu\Chat:Room');
     }
     public function findRoomsForSelect()
     {
          return $this->finder('Siropu\Chat:Room')->order('room_name', 'ASC');
     }
     public function findRoomsForList()
     {
          $options = \XF::options();

          switch ($options->siropuChatRoomsOrder)
          {
               case 'users':
                    $filed     = 'room_user_count';
                    $direction = 'DESC';
                    break;
               case 'newest':
                    $filed     = 'room_date';
                    $direction = 'DESC';
                    break;
               case 'oldest':
                    $filed     = 'room_date';
                    $direction = 'ASC';
                    break;
               case 'alphabetically':
                    $filed     = 'room_name';
                    $direction = 'ASC';
                    break;
          }

          return $this->finder('Siropu\Chat:Room')
               ->with('User')
               ->order($filed, $direction);
     }
     public function findAutoPrune()
     {
          return $this->finder('Siropu\Chat:Room')
               ->where('room_prune', '<>', 0)
               ->fetch();
     }
     public function getRoomOptionsData()
	{
          $choices = [];

          foreach ($this->findRoomsForSelect() as $room)
          {
               $choices[$room->room_id] = [
                    'value' => $room->room_id,
                    'label' => \XF::escapeString($room->room_name)
               ];
          }

          return $choices;
     }
     public function resetInactiveRoomsUserCount($roomIds)
     {
          if (empty($roomIds))
          {
               return;
          }

          $this->db()->update(
               'xf_siropu_chat_room',
               ['room_user_count' => 0],
               'room_id NOT IN (' . $this->db()->quote($roomIds) . ')'
          );
     }
     public function getRoomCacheData()
     {
          $cache = [];

          foreach ($this->finder('Siropu\Chat:Room')->fetch() AS $room)
          {
               $cache[$room->room_id] = $room->toArray();
          }

          return $cache;
     }
     public function rebuildRoomCache()
     {
          $simpleCache = $this->app()->simpleCache();
          $simpleCache['Siropu/Chat']['rooms'] = $this->getRoomCacheData();
     }
     public function getRoomFromCache($roomId, $entity = true)
     {
          if (isset($this->getRoomCache()[$roomId]))
          {
               $room = $this->getRoomCache()[$roomId];
               return $entity ? $this->instantiateRoomEntity($room) : $room;
          }
     }
     public function getRoomsFromCache()
     {
          $rooms = [];

          foreach ($this->getRoomCache() as $room)
          {
               $rooms[$room['room_id']] = $this->instantiateRoomEntity($room);
          }

          return $rooms;
     }
     public function instantiateRoomEntity(array $room)
     {
          return $this->em->instantiateEntity('Siropu\Chat:Room', $room);
     }
     public function getRoomCache()
     {
          $simpleCache = $this->app()->simpleCache();
          return $simpleCache['Siropu/Chat']['rooms'];
     }
}
