<?php

namespace Siropu\Chat\Alert;

use XF\Mvc\Entity\Entity;

class Mention extends \XF\Alert\AbstractHandler
{
     public function canViewContent(Entity $entity, &$error = null)
	{
          return true;
     }
}
