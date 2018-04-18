<?php

namespace Siropu\Chat\Pub\View\Conversation;

class Start extends \XF\Mvc\View
{
	public function renderJson()
	{
		$visitor  = \XF::visitor();
		$options  = \XF::options();

		$params   = $this->getParams();
		$messages = [];

		$templater = \XF::app()->templater();

		$messages[$params['convId']] = $templater->renderMacro('public:siropu_chat_message_list', 'conversation', [
			'messages' => isset($params['messages']) ? $params['messages'] : []
		]);

		$contacts = $templater->renderMacro('public:siropu_chat_user_list', 'conversation', [
			'conversations' => isset($params['contacts']) ? $params['contacts'] : []
		]);

		return [
			'convMessages' => $messages,
			'convContacts' => $contacts,
			'convId'       => $params['convId'],
			'action'       => 'start'
		];
	}
}
