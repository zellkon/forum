<?php

namespace Siropu\Chat\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class Conversation extends Repository
{
     public function findConversations()
     {
          return $this->finder('Siropu\Chat:Conversation');
     }
     public function findConversationsForUser($userId)
     {
          return $this->findConversations()
               ->with(['User1', 'User2'])
               ->whereOr([['user_1', $userId], ['user_2', $userId]]);
     }
     public function findConversationWithUser($userId)
     {
          $visitor = \XF::visitor();

          return $this->findConversations()
               ->whereOr([
                    [
                         ['user_1', $visitor->user_id],
                         ['user_2', $userId]
                    ],
                    [
                         ['user_2', $visitor->user_id],
                         ['user_1', $userId]
                    ]
               ])
               ->fetchOne();
     }
     public function deleteConversationMessages($id)
     {
          $this->db()->delete('xf_siropu_chat_conversation_message', 'message_conversation_id = ?', $id);
     }
     public function getUserConversations()
     {
          $visitor = \XF::visitor();

          return $this->findConversations()
			->withId($visitor->siropuChatGetConvIds())
			->fetch();
     }
}
