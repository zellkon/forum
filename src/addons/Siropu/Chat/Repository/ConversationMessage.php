<?php

namespace Siropu\Chat\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class ConversationMessage extends Repository
{
     public function findMessages()
     {
          return $this->finder('Siropu\Chat:ConversationMessage')
               ->order('message_id', 'DESC')
               ->limit(\XF::options()->siropuChatMessageDisplayLimit);
     }
     public function markAsRead($convId, $messageIds)
     {
          $this->db()->update(
               'xf_siropu_chat_conversation_message',
               ['message_read' => 1],
               'message_id IN (' . $this->db()->quote($messageIds) . ') AND message_conversation_id = ' . $this->db()->quote($convId)
          );
     }
}
