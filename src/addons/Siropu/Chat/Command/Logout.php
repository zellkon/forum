<?php

namespace Siropu\Chat\Command;

class Logout
{
     public static function run(\XF\Mvc\Controller $controller, \Siropu\Chat\Entity\Command $command, $messageEntity, $input)
     {
          if (!$controller->isLoggedIn())
          {
               return $controller->message(\XF::phrase('siropu_chat_you_are_not_logged_in'));
          }

          $visitor = \XF::visitor();
          $visitor->siropuChatLogout($input);
          $visitor->save();

          $reply = $controller->view();
          $reply->setJsonParams(['logout' => true]);

          return $reply;
     }
}
