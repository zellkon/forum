<?php

namespace Siropu\Chat\Pub\View\Message;

class Edit extends \XF\Mvc\View
{
	public function renderJson()
	{
		return ['message_html' => $this->renderTemplate($this->getTemplateName(), $this->getParams())];
	}
}
