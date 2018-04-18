<?php

namespace Siropu\Chat\Service\Conversation;

use XF\Mvc\Reply;

class Preparer extends \Siropu\Chat\Service\Message\Sorter
{
	protected $field = 'message_conversation_id';

	public function getOnlineCount($contacts)
	{
		$online = $contacts->filter(function(\Siropu\Chat\Entity\Conversation $conversation)
		{
			return ($conversation->isOnline());
		});

		return $online->count();
	}
	public function getUnread()
	{
		$unreadMessages = $this->messages->filter(function(\Siropu\Chat\Entity\ConversationMessage $message)
		{
			return ($message->isUnread());
		});

		$list = [];

		foreach ($unreadMessages as $message)
		{
			$list[$message->message_conversation_id][] = $message->message_id;
		}

		return $list;
	}
}
