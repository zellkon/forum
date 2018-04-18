<?php

namespace Siropu\Chat\Service\Message;

class Sorter extends \XF\Service\AbstractService
{
     protected $message;
	protected $groupedMessages = [];
	protected $lastMessages = [];
	protected $inverse = false;
	protected $playSound;
     protected $field = 'message_room_id';

     public function __construct(\XF\App $app)
	{
		parent::__construct($app);

		$this->inverse = \XF::visitor()->getSiropuChatSettings()['inverse'];
	}
     public function setMessages($messages)
     {
          $this->messages = $messages;
     }
     public function prepareForDisplay($messages)
	{
		$this->messages = $this->inverse ? $messages : $messages->reverse();

		$this->groupByField();
		$this->setLastMessages();
	}
     public function groupByField()
     {
          foreach ($this->messages AS $message)
	     {
	          $this->groupedMessages[$message->{$this->field}][] = $message;

			if (!in_array($this->playSound, ['mention', 'whisper']))
			{
				if ($message->isBot())
				{
					$this->playSound = 'bot';
				}
				else if ($message->isError())
				{
					$this->playSound = 'error';
				}
				else if ($message->isMentioned())
				{
					$this->playSound = 'mention';
				}
				else if ($message->isRecipient())
				{
					$this->playSound = 'whisper';
				}
				else
				{
					$this->playSound = 'normal';
				}
			}
	     }
     }
     public function setLastMessages()
	{
		foreach ($this->groupedMessages as $key => $val)
		{
			$this->lastMessages[$key] = $this->inverse ? current($val) : end($val);
		}
	}
     public function getGroupedMessages()
	{
		return $this->groupedMessages;
	}
     public function getLastMessage()
	{
		$last = $this->lastMessages;

		usort($last, function($a, $b)
		{
			$_a = $a->message_id;
			$_b = $b->message_id;

			if ($_a == $_b)
			{
				return 0;
			}

			return ($_a < $_b) ? -1 : 1;
		});

		return $last ? end($last) : [];
	}
	public function getLastIds()
	{
		$ids = [];

		foreach ($this->lastMessages as $key => $val)
		{
			$ids[$key] = $val->message_id;
		}

		return $ids;
	}
	public function getPlaySound()
	{
		return $this->playSound;
	}
}
