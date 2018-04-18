<?php

namespace Siropu\Chat\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class Message extends Repository
{
     public function findRoomMessages($roomId)
     {
          return $this->finder('Siropu\Chat:Message')->fromRoom($roomId);
     }
     public function findMessages($order = null, $direction = 'DESC')
     {
		$finder = $this->finder('Siropu\Chat:Message')->with('User');

          if ($order)
          {
               $finder->order($order, $direction);
          }
          else
          {
               $finder->order('message_id', 'DESC');
          }

          return $finder;
     }
     public function getTopChatters($from = 'today', $limit = 10)
     {
          $simpleCache = $this->app()->simpleCache();
          $topChatters = $simpleCache['Siropu/Chat']['topChatters'];

          switch ($from)
		{
			case 'today':
				$start = strtotime('-' . date('G') . ' Hours');
				$end   = time();
				break;
			case 'yesterday':
				$start = strtotime('-1 Day 00:00');
				$end   = strtotime('-1 Day 23:59');
				break;
			case 'thisWeek':
				$start = strtotime('This Week Monday');
				$end   = time();
				break;
			case 'thisMonth':
				$start = strtotime('first day of this month 00:00');
				$end   = time();
				break;
			case 'lastWeek':
				$start = strtotime('-1 Week Last Monday');
				$end   = strtotime('-1 Week Sunday 23:59');
				break;
			case 'lastMonth':
				$start = strtotime('first day of last month 00:00');
				$end   = strtotime('last day of last month 23:59');
				break;
		}

          if (isset($topChatters[$from]))
          {
               $cache = $topChatters[$from];

               if ($cache['lastUpdate'] >= \XF::$time - 3600)
               {
                    return $this->populateTopChattersResults($cache['results']);
               }
          }

          $results = $this->db()->fetchAllKeyed('
			SELECT
                    u.user_id,
                    COUNT(*) AS messageCount
			FROM xf_siropu_chat_message AS m
			LEFT JOIN xf_user AS u ON u.user_id = m.message_user_id
			WHERE m.message_date BETWEEN ? AND ?
			AND m.message_type IN ("chat", "me")
			GROUP BY m.message_user_id
			ORDER BY messageCount DESC
			LIMIT ?', 'user_id', [$start, $end, $limit]
          );

          if ($results)
          {
               $topChatters[$from] = [
                    'results'    => $results,
                    'lastUpdate' => \XF::$time
               ];

               $simpleCache['Siropu/Chat']['topChatters'] = $topChatters;
          }

          return $this->populateTopChattersResults($results);
     }
     public function populateTopChattersResults(array $results = [])
     {
          $users = $this->finder('XF:User')
               ->where('user_id', array_keys($results))
               ->fetch();

          foreach ($users as &$user)
          {
               $user->siropu_chat_message_count = $results[$user->user_id]['messageCount'];
          }

          return $users;
     }
     public function pruneAll()
     {
          $this->db()->emptyTable('xf_siropu_chat_message');
          $this->db()->delete('xf_edit_history', 'content_type = ?', 'siropu_chat_room_message');
     }
     public function pruneRoomMessages($roomId)
     {
          $this->db()->delete('xf_siropu_chat_message', 'message_room_id = ?', $roomId);
     }
     public function pruneRoomUserMessages($roomId, $userId)
     {
          $this->db()->delete('xf_siropu_chat_message', 'message_room_id = ? AND message_user_id = ?', [$roomId, $userId]);
     }
     public function pruneUserMessages($userId)
     {
          $this->db()->delete('xf_siropu_chat_message', 'message_user_id = ?', $userId);
     }
     public function pruneTypeMessages($type)
     {
          $this->db()->delete('xf_siropu_chat_message', 'message_type = ?', $type);
     }
     public function deleteMessagesOlderThan($timeFrame)
     {
          $this->db()->delete('xf_siropu_chat_message', 'message_date <= ?', $timeFrame);
     }
     public function deleteIgnoredMessages()
     {
          $this->db()->delete('xf_siropu_chat_message', 'message_is_ignored = 1');
     }
}
