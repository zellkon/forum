<?php

namespace Siropu\Chat\Pub\Controller;

use XF\Mvc\ParameterBag;

class Conversation extends AbstractController
{
     public function actionStart(ParameterBag $params)
     {
          $recipient = $this->filter('recipient', 'str');
          $message   = $this->filter('message', 'str');

          if (!$this->isLoggedIn())
          {
               return $this->noPermission();
          }

          if ($recipient)
          {
               $user = $this->em()->findOne('XF:User', ['username' => $recipient]);
          }
          else
          {
               $user = $this->em()->find('XF:User', $params->user_id);
          }

          if (!$user)
          {
               return $this->error(\XF::phrase('requested_user_not_found'));
          }

          return $this->service('Siropu\Chat:Conversation\Manager', $user, null, $message)->startConversation();
     }
     public function actionLeave(ParameterBag $params)
     {
          $conversation = $this->assertConversationExistsAndValid($params->conversation_id);

          if ($this->isPost())
          {
               return $this->service('Siropu\Chat:Conversation\Manager', null, $conversation, null)->leaveConversation();
          }

          $viewParams = [
               'conversation' => $conversation
          ];

          return $this->view('', 'siropu_chat_conversation_leave_confirm', $viewParams);
     }
     public function actionView(ParameterBag $params)
     {
          $conversation = $this->assertConversationExistsAndValid($params->conversation_id);

          $this->app()->response()->setCookie('siropu_chat_channel', 'conv');
          $this->app()->response()->setCookie('siropu_chat_conv_id', $params->conversation_id);

          if (\XF::visitor()->getLastConvIdSiropuChat() != $params->conversation_id)
          {
               return $this->redirect($this->buildLink('chat/conversation/view', $conversation));
          }

          $viewParams = [
               'channel'  => 'conv',
               'convId'   => $params->conversation_id,
               'convOnly' => true,
               'hideTabs' => true
          ];

          return $this->plugin('Siropu\Chat:Chat')->loadChat($viewParams);
     }
     public function actionMarkAsRead(ParameterBag $params)
     {
          $this->assertPostOnly();

          $convUnread = $this->filter('conv_unread', 'array-uint');

          if (!\XF::visitor()->hasConversationSiropuChat($params->conversation_id))
          {
               return $this->noPermission();
          }

          $this->getConversationMessageRepo()->markAsRead($params->conversation_id, array_values($convUnread));

          $reply = $this->view();
          $reply->setJsonParams(['convRead' => $params->conversation_id]);

          return $reply;
     }
     public function actionLoadMessages(ParameterBag $params)
     {
          $this->assertConversationExistsAndValid($params->conversation_id);

          if ($convUnread = $this->filter('conv_unread', 'array-uint'))
          {
               $this->getConversationMessageRepo()->markAsRead($params->conversation_id, $convUnread);
          }

          $messages = $this->getConversationMessageRepo()
               ->findMessages()
               ->forConversation($params->conversation_id)
               ->fetch();

          if (!\XF::visitor()->getSiropuChatSettings()['inverse'])
          {
               $messages = $messages->reverse();
          }

          $viewParams = [
               'messages' => $messages,
               'hasMore'  => '',
               'find'     => ''
          ];

          return $this->view('Siropu\Chat:Conversation\LoadMessages', '', $viewParams);
     }
     public function actionLoadMoreMessages(ParameterBag $params)
     {
          $this->assertConversationExistsAndValid($params->conversation_id);

          $finder = $this->getConversationMessageRepo()
               ->findMessages()
               ->forConversation($params->conversation_id)
               ->idSmallerThan($this->filter('message_id', 'uint'));

          if ($text = $this->filter('find', 'string'))
          {
               $finder->havingText($text);
          }

          $messages = $finder->fetch();

          if (!\XF::visitor()->getSiropuChatSettings()['inverse'])
          {
               $messages = $messages->reverse();
          }

          $viewParams = [
               'messages' => $messages,
               'hasMore'  => $messages->count() == \XF::options()->siropuChatMessageDisplayLimit,
               'find'     => ''
          ];

          return $this->view('Siropu\Chat:Conversation\LoadMessages', '', $viewParams);
     }
     public function actionLike(ParameterBag $params)
     {
          $message = $this->assertMessageExistsAndValid($params->message_id);

          if (!$message->canLike())
          {
               return $this->noPermission();
          }

          if (!$message->isLiked())
          {
               $message->like();
               $message->save();
          }

          return $this->view('Siropu\Chat:Conversation\Like', 'siropu_chat_conversation_message_row', ['message' => $message]);
     }
     public function actionUnlike(ParameterBag $params)
     {
          $message = $this->assertMessageExistsAndValid($params->message_id);

          if (!$message->canLike())
          {
               return $this->noPermission();
          }

          if ($message->isLiked())
          {
               $message->unlike();
               $message->save();
          }

          return $this->view('Siropu\Chat:Conversation\Unlike', 'siropu_chat_conversation_message_row', ['message' => $message]);
     }
     public function actionEdit(ParameterBag $params)
     {
          $message = $this->assertMessageExistsAndValid($params->message_id);

          if (!$message->canEditDelete())
          {
               return $this->message(\XF::phrase('siropu_chat_read_messages_cannot_be_edited_or_deleted'));
          }

          if ($this->isPost())
          {
               $messageText = $this->plugin('XF:Editor')->convertToBbCode($this->filter('message_html', 'str,no-clean'));

               $messagePreparerService = $this->service('Siropu\Chat:Message\Preparer');
               $messagePreparerService->prepare($messageText);

               if ($messagePreparerService->isValid())
               {
                    $messageText = $messagePreparerService->getMessage();
               }
               else
               {
                    return $this->error($messagePreparerService->getErrors());
               }

               $message->message_text = $messageText;
               $message->save();

               $reply = $this->view('Siropu\Chat:Message\Edit', 'siropu_chat_conversation_message_row', ['message' => $message]);
               $reply->setJsonParams([
                    'message'    => \XF::phrase('siropu_chat_message_edited'),
                    'message_id' => $message->message_id,
                    'channel'    => 'conv'
               ]);

               return $reply;
          }

          $viewParams = [
               'message'         => $message,
               'disabledButtons' => $this->getChatData()->getDisabledButtons()
          ];

          return $this->view('', 'siropu_chat_conversation_message_edit', $viewParams);
     }
     public function actionDelete(ParameterBag $params)
     {
          $message = $this->assertMessageExistsAndValid($params->message_id);

          if (!$message->canEditDelete())
          {
               return $this->message(\XF::phrase('siropu_chat_read_messages_cannot_be_edited_or_deleted'));
          }

          if ($this->isPost())
          {
               $message->delete();

               $reply = $this->message(\XF::phrase('siropu_chat_message_deleted'));
               $reply->setJsonParams([
                    'message_id' => $message->message_id,
                    'channel'    => 'conv'
               ]);

               return $reply;
          }

          $viewParams = [
               'message' => $message
          ];

          return $this->view('', 'siropu_chat_conversation_message_delete', $viewParams);
     }
     public function actionReport(ParameterBag $params)
     {
          $message = $this->assertMessageExistsAndValid($params->message_id);

          if (!$message->canReport())
          {
               return $this->noPermission();
          }

          $reportPlugin = $this->plugin('XF:Report');

		return $reportPlugin->actionReport(
			'siropu_chat_conv_message', $message,
			$this->buildLink('chat/conversation/report', $message),
			$this->buildLink('chat/conversation/view', $message)
		);
     }
     public function actionQuote(ParameterBag $params)
     {
          $message = $this->assertMessageExistsAndValid($params->message_id);

          if (!$message->canQuote())
          {
               return $this->noPermission();
          }

          return $this->plugin('XF:Quote')->actionQuote($message, 'siropu_chat_conv_message', 'message_text');
     }
     protected function assertConversationExistsAndValid($id = null, $with = null)
     {
		$conversation = $this->assertRecordExists('Siropu\Chat:Conversation', $id, $with, 'siropu_chat_requested_conversation_not_found');

          if (!$conversation->isContact())
          {
               throw $this->exception($this->noPermission(\XF::phrase('siropu_chat_not_part_of_the_conversation')));
          }

          return $conversation;
     }
     protected function assertMessageExistsAndValid($id = null, $with = null)
     {
		$message = $this->assertRecordExists('Siropu\Chat:ConversationMessage', $id, $with, 'siropu_chat_requested_message_not_found');

          if (!$message->Conversation->isContact())
          {
               throw $this->exception($this->noPermission());
          }

          return $message;
     }
}
