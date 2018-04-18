<?php

namespace Siropu\Chat\Pub\View\Conversation;

class Leave extends \XF\Mvc\View
{
	public function renderJson()
	{
		$contacts = \XF::app()->templater()->renderMacro('public:siropu_chat_user_list', 'conversation', [
			'conversations' => isset($this->getParams()['contacts']) ? $this->getParams()['contacts'] : []
		]);

		return [
			'convContacts' => $contacts,
			'convId'       => $this->getParams()['convId'],
		];
	}
}
