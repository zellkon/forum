<?php

namespace Siropu\Chat\Command;

class Prune
{
     public static function run(\XF\Mvc\Controller $controller, \Siropu\Chat\Entity\Command $command, $messageEntity, $input)
     {
          if ($controller->channel == 'conv')
          {
               return $controller->message(\XF::phrase('siropu_chat_command_cannot_be_used_in_private_conversations'));
          }

          $visitor = \XF::visitor();

          if (!$visitor->canPruneSiropuChatMessages())
          {
               return $controller->message(\XF::phrase('siropu_chat_no_permission_to_use_command'));
          }

          $phraseParams = ['user' => $visitor->siropuChatGetUserWrapper()];

          $messageEntity->message_type = 'prune';
          $messageRepo = \XF::app()->repository('Siropu\Chat:Message');

          switch ($input)
          {
               case '':
                    $messageRepo->pruneRoomMessages($messageEntity->message_room_id);
                    $messageEntity->message_text = \XF::phrase('siropu_chat_x_has_deleted_all_the_messages', $phraseParams);
                    $prune['prune'] = 'room';
                    break;
               case 'all':
                    $messageRepo->pruneAll();
                    $messageEntity->message_text = \XF::phrase('siropu_chat_x_has_deleted_all_the_messages', $phraseParams);

                    \XF::service('Siropu\Chat:Room\ActionLogger')->emptyLog();

                    $rooms = \XF::finder('Siropu\Chat:Room')
                         ->visible()
                         ->notFromRoom($controller->roomId)
                         ->fetch();

                    foreach ($rooms as $room)
                    {
                         $notifier = \XF::app()->service('Siropu\Chat:Room\Notifier', $visitor, $room->room_id);
     		          $notifier->notify('prune_all');
                    }

                    $prune['prune'] = 'all';
                    break;
               case 'forum':
                    $messageRepo->pruneTypeMessages('forum');
                    $prune['prune'] = 'forum';
                    break;
               case 'media':
                    $messageRepo->pruneTypeMessages('media');
                    $prune['prune'] = 'media';
                    break;
               case 'resource':
                    $messageRepo->pruneTypeMessages('resource');
                    $prune['prune'] = 'resource';
                    break;
               default:
                    if ($user = \XF::em()->findOne('XF:User', ['username' => $input]))
                    {
                         $phraseParams['author'] = $user->siropuChatGetUserWrapper();

                         $messageRepo->pruneRoomUserMessages($messageEntity->message_room_id, $user->user_id);
                         $messageEntity->message_user_id = $user->user_id;
                         $messageEntity->message_username = $user->username;
                         $messageEntity->message_type_id = $user->user_id;
                         $messageEntity->message_text = \XF::phrase('siropu_chat_x_has_deleted_all_messages_by_x', $phraseParams);

                         $prune['prune'] = ['user_id' => $user->user_id];
                    }
                    else
                    {
                         return $controller->message(\XF::phrase('siropu_chat_unknown_prune_option'));
                    }
                    break;
          }

          return $prune;
     }
}
