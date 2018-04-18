<?php

namespace Siropu\Chat\Service\Room;

class ActionLogger extends \XF\Service\AbstractService
{
     private $cache;
     private $actions;
     private $action;
     private $roomId;

	public function __construct(\XF\App $app, $action = '')
	{
		parent::__construct($app);

          $this->cache   = $this->app->simpleCache();
          $this->actions = $this->cache['Siropu/Chat']['actions'] ?: [];
          $this->action  = $action;
	}
     public function logMessageAction(\Siropu\Chat\Entity\Message $message)
     {
          $params = [
               'action' => [$this->action => \XF::$time],
          ];

          switch ($this->action)
          {
               case 'edit':
                    $params['html'] = $this->app->bbCode()->render($message->message_text, 'html', 'siropu_chat', $message);
                    break;
               case 'like':
                    $params['likes'] = $message->message_like_count ? ' <a href="' . \XF::app()->router()->buildLink('chat/message/likes', $message) . '" class="siropuChatMessageLikes" data-xf-click="overlay">+' . $message->message_like_count . '</a>' : '';
                    break;
               case 'prune':
                    $params['prune'] = $message->message_type_id;
                    break;
          }

          $roomId    = $message->message_room_id;
          $messageId = $message->message_id;

          if (isset($this->actions[$roomId][$messageId]))
          {
               $params = array_replace_recursive($this->actions[$roomId][$messageId], $params);
          }

          $this->actions[$roomId][$messageId] = $params;
          $this->cache['Siropu/Chat']['actions'] = $this->actions;
     }
     public function cleanLog()
     {
          $clean = false;

          foreach ($this->actions as $roomId => $actions)
          {
               foreach ($actions as $messageId => $action)
               {
                    foreach ($action['action'] as $type => $date)
                    {
                         if ($date <= \XF::$time - 60)
                         {
                              unset($this->actions[$roomId][$messageId]['action'][$type]);

                              if (empty($this->actions[$roomId][$messageId]['action']))
                              {
                                   unset($this->actions[$roomId][$messageId]);

                                   if (empty($this->actions[$roomId]))
                                   {
                                        unset($this->actions[$roomId]);
                                   }
                              }

                              $clean = true;
                         }
                    }
               }
          }

          if ($clean)
          {
               $this->cache['Siropu/Chat']['actions'] = $this->actions;
          }
     }
     public function emptyLog()
     {
          $this->cache['Siropu/Chat']['actions'] = [];
     }
     public function getActions()
     {
          return $this->actions;
     }
}
