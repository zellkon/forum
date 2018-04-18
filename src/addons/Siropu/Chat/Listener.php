<?php

namespace Siropu\Chat;

use XF\Mvc\Entity\Entity;

class Listener
{
     public static function appSetup(\XF\App $app)
     {
          \XF::$autoLoader->addClassMap([
               'Mobile_Detect' => \XF::getAddOnDirectory() . '/Siropu/Chat/Vendor/MobileDetect/Mobile_Detect.php'
          ]);
     }
     public static function userEntityStructure(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
     {
           $structure->columns['siropu_chat_room_id'] = [
                'type'      => Entity::UINT,
                'default'   => 0,
                'changeLog' => false
           ];
           $structure->columns['siropu_chat_conv_id'] = [
                'type'      => Entity::UINT,
                'default'   => 0,
                'changeLog' => false
           ];
           $structure->columns['siropu_chat_rooms'] = [
               'type'      => Entity::SERIALIZED_ARRAY,
               'default'   => [],
               'nullable' => true,
               'changeLog' => false
           ];
           $structure->columns['siropu_chat_conversations'] = [
               'type'      => Entity::SERIALIZED_ARRAY,
               'default'   => [],
               'nullable' => true,
               'changeLog' => false
           ];
           $structure->columns['siropu_chat_settings'] = [
               'type'      => Entity::SERIALIZED_ARRAY,
               'default'   => [],
               'nullable' => true,
               'changeLog' => false
           ];
           $structure->columns['siropu_chat_status'] = [
                'type'      => Entity::STR,
                'default'   => '',
                'maxLength' => 255,
                'changeLog' => false
           ];
           $structure->columns['siropu_chat_is_sanctioned'] = [
                'type'      => Entity::UINT,
                'default'   => 0,
                'changeLog' => false
           ];
           $structure->columns['siropu_chat_message_count'] = [
                'type'      => Entity::UINT,
                'default'   => 0,
                'changeLog' => false
           ];
           $structure->columns['siropu_chat_last_activity'] = [
                'type'      => Entity::UINT,
                'default'   => -1,
                'changeLog' => false
           ];
     }
     public static function templaterTemplatePreRenderEditor(\XF\Template\Templater $templater, &$type, &$template, array &$params)
	{
		if (\XF::visitor()->canUploadSiropuChatImages())
		{
			$params['customIcons']['chat'] = [
                    'title'  => \XF::phrase('siropu_chat_image_uploads'),
                    'type'   => 'fa',
                    'value'  => 'upload',
                    'option' => 'yes'
               ];
		}
	}
     public static function userEntityPostSave(\XF\Mvc\Entity\Entity $entity)
     {
          $options = \XF::options();

          if (($activityRoomId = $options->siropuChatForumActivityRoom)
               && $options->siropuChatForumActivityUsers
               && ($entity->isInsert()
                    && $entity->user_state == 'valid'
                         || ($entity->isUpdate()
                              && $entity->isChanged('user_state')
                              && in_array($entity->getExistingValue('user_state'), ['email_confirm', 'moderated'])
                              && $entity->user_state == 'valid')))
          {
               $message = \XF::app()->service('Siropu\Chat:Message\Creator', $entity, $activityRoomId, 'forum');
     		$message->setText(\XF::phrase('siropu_chat_new_user_notification', [
                    'user' => new \XF\PreEscaped($entity->siropuChatGetUserWrapper())
               ]));
     		$message->save();
          }
     }
     public static function postEntityPostSave(\XF\Mvc\Entity\Entity $entity)
     {
          $options = \XF::options();
          $router  = \XF::app()->router('public');

          if (($activityRoomId = $options->siropuChatForumActivityRoom) && self::assertValidForum($entity->Thread->node_id))
          {
               $messageText = '';
               $excerpt     = '';

               if ($options->siropuChatForumActivityPostsExcept['enabled'])
               {
                    if ($limit = $options->siropuChatForumActivityPostsExcept['limit'])
                    {
                         $excerptText = \XF::app()->stringFormatter()->snippetString($entity->message, $limit);
                    }
                    else
                    {
                         $excerptText = $entity->message;
                    }

                    $excerpt = '[QUOTE="' . $entity->username . ', post: ' . $entity->post_id . ', member: ' . $entity->user_id . '"]' . $excerptText . '[/QUOTE]';
               }

               if ($options->siropuChatForumActivityThreads
                    && $entity->isFirstPost()
                    && (($entity->isInsert()
                              && $entity->Thread->discussion_state == 'visible'
                              && $entity->Thread->discussion_type != 'redirect')
                         || ($entity->isUpdate()
                              && $entity->Thread->discussion_state == 'visible'
                              && $entity->Thread->getExistingValue('discussion_state') == 'moderated')))
               {
                    $messageText = \XF::phrase('siropu_chat_new_thread_notification', [
                         'user'   => new \XF\PreEscaped('[USER=' . $entity->user_id . ']' . $entity->username . '[/USER]'),
                         'thread' => new \XF\PreEscaped('[URL=' . $router->buildLink('full:threads', $entity->Thread) . ']' . $entity->Thread->title . '[/URL]'),
                         'forum'  => new \XF\PreEscaped('[URL=' . $router->buildLink('full:forums', $entity->Thread->Forum) . ']' . $entity->Thread->Forum->title . '[/URL]')
                    ]) . $excerpt;
               }

               if ($options->siropuChatForumActivityPosts
                    && !$entity->isFirstPost()
                    && ($entity->isInsert()
                         || $entity->getExistingValue('message_state') == 'moderated'))
               {
                    $messageText = \XF::phrase('siropu_chat_new_post_notification', [
                         'user'   => new \XF\PreEscaped('[USER=' . $entity->user_id . ']' . $entity->username . '[/USER]'),
                         'url'    => $router->buildLink('full:posts', $entity),
                         'thread' => new \XF\PreEscaped('[URL=' . $router->buildLink('full:threads/unread', $entity->Thread) . ']' . $entity->Thread->title . '[/URL]')
                    ]) . $excerpt;
               }

               if ($messageText)
               {
                    $message = \XF::app()->service('Siropu\Chat:Message\Creator', $entity, $activityRoomId, 'forum');
          		$message->setText($messageText);
          		$message->save();
               }
          }
     }
     public static function XFMGMediaItemEntityPostSave(\XF\Mvc\Entity\Entity $entity)
     {
          $options = \XF::options();

          if (($activityRoomId = $options->siropuChatXFMGActivityRoom) && $options->siropuChatXFMGActivityMediaItem)
          {
               $canPost     = true;
               $messageText = '';

               $phraseParams = [
                    'user'     => '[USER=' . $entity->user_id . ']' . $entity->username . '[/USER]',
                    'mediaURL' => \XF::app()->router()->buildLink('full:media', $entity)
               ];

               if ($entity->Album)
               {
                    if (!in_array($entity->Album->view_privacy, ['public', 'members']))
                    {
                         $canPost = false;
                    }

                    $phraseParams['album'] = new \XF\PreEscaped('[URL=' . \XF::app()->router()->buildLink('full:media/albums', $entity->Album) . ']' . $entity->Album->title . '[/URL]');

                    $messageText = \XF::phrase('siropu_chat_new_media_album_item_notification', $phraseParams);
               }
               else if ($entity->Category)
               {
                    $phraseParams['category'] = new \XF\PreEscaped('[URL=' . \XF::app()->router()->buildLink('full:media/categories', $entity->Category) . ']' . $entity->Category->title . '[/URL]');

                    $messageText = \XF::phrase('siropu_chat_new_media_category_item_notification', $phraseParams);
               }

               if ($canPost
                    && $messageText
                    && ($entity->isInsert()
                              && $entity->media_state == 'visible'
                         || ($entity->isUpdate()
                              && $entity->media_state == 'visible'
                              && $entity->getExistingValue('media_state') == 'moderated')))
               {
                    $message = \XF::app()->service('Siropu\Chat:Message\Creator', $entity, $activityRoomId, 'media');
          		$message->setText($messageText);
                    $message->setBotName($options->siropuChatXFMGActivityBotName);
          		$message->save();
               }
          }
     }
     public static function XFMGAlbumEntityPostSave(\XF\Mvc\Entity\Entity $entity)
     {
          $options = \XF::options();

          if (($activityRoomId = $options->siropuChatXFMGActivityRoom)
               && $options->siropuChatXFMGActivityMediaAlbum
               && (($entity->isInsert()
                         && $entity->album_state == 'visible'
                         && in_array($entity->view_privacy, ['public', 'members']))
                    || ($entity->isUpdate()
                         && $entity->album_state == 'visible'
                         && $entity->getExistingValue('album_state') == 'moderated')))
          {
               $message = \XF::app()->service('Siropu\Chat:Message\Creator', $entity, $activityRoomId, 'media');
               $message->setText(\XF::phrase('siropu_chat_new_media_album_notification', [
                    'user'  => new \XF\PreEscaped('[USER=' . $entity->user_id . ']' . $entity->username . '[/USER]'),
                    'album' => new \XF\PreEscaped('[URL=' . \XF::app()->router()->buildLink('full:media/albums', $entity) . ']' . $entity->title . '[/URL]')
               ]));
               $message->setBotName($options->siropuChatXFMGActivityBotName);
               $message->save();
          }
     }
     public static function XFMGCommentEntityPostSave(\XF\Mvc\Entity\Entity $entity)
     {
          $options = \XF::options();

          if (($activityRoomId = $options->siropuChatXFMGActivityRoom) && $options->siropuChatXFMGActivityComment)
          {
               $canPost = true;

               $phraseParams = [
                    'user' => new \XF\PreEscaped('[USER=' . $entity->user_id . ']' . $entity->username . '[/USER]')
               ];

               if ($entity->content_type == 'xfmg_media')
               {
                    $phraseParams['media'] = new \XF\PreEscaped('[URL=' . \XF::app()->router()->buildLink('full:media', $entity->Media) . ']' . $entity->Media->title . '[/URL]');

                    $messageText = \XF::phrase('siropu_chat_new_media_comment_notification', $phraseParams);
               }
               else
               {
                    if (!in_array($entity->Album->view_privacy, ['public', 'members']))
                    {
                         $canPost = false;
                    }

                    $phraseParams['album'] = new \XF\PreEscaped('[URL=' . \XF::app()->router()->buildLink('full:media/albums', $entity->Album) . ']' . $entity->Album->title . '[/URL]');

                    $messageText = \XF::phrase('siropu_chat_new_media_album_comment_notification', $phraseParams);
               }

               if ($canPost
                    && (($entity->isInsert()
                              && $entity->comment_state == 'visible')
                         || ($entity->isUpdate()
                              && $entity->comment_state == 'visible'
                              && $entity->getExistingValue('comment_state') == 'moderated')))
               {
                    $message = \XF::app()->service('Siropu\Chat:Message\Creator', $entity, $activityRoomId, 'media');
          		$message->setText($messageText);
                    $message->setBotName($options->siropuChatXFMGActivityBotName);
          		$message->save();
               }
          }
     }
     public static function RMResourceItemEntityPostSave(\XF\Mvc\Entity\Entity $entity)
     {
          $options = \XF::options();

          if (($activityRoomId = $options->siropuChatXFRMActivityRoom)
               && (($entity->isInsert()
                         && $entity->resource_state == 'visible')
                    || ($entity->isUpdate()
                         && $entity->resource_state == 'visible'
                         && $entity->getExistingValue('resource_state') == 'moderated')))
          {
               $message = \XF::app()->service('Siropu\Chat:Message\Creator', $entity, $activityRoomId, 'resource');
               $message->setText(\XF::phrase('siropu_chat_new_resource_notification', [
                    'user'     => new \XF\PreEscaped('[USER=' . $entity->user_id . ']' . $entity->username . '[/USER]'),
                    'resource' => new \XF\PreEscaped('[URL=' . \XF::app()->router()->buildLink('full:resources', $entity)  . ']' . $entity->title . '[/URL]'),
                    'category' => new \XF\PreEscaped('[URL=' . \XF::app()->router()->buildLink('full:resources/categories', $entity->Category)  . ']' . $entity->Category->title . '[/URL]')
               ]));
               $message->setBotName($options->siropuChatXFRMActivityBotName);
               $message->save();
          }
     }
     public static function editorDialog(array &$data, \XF\Mvc\Controller $controller)
	{
          $attachmentRepo = \XF::repository('XF:Attachment');
		$attachmentData = $attachmentRepo->getEditorData('siropu_chat', \XF::visitor());

          $attachmentList = $attachmentRepo->findAttachmentsForList()
               ->where('content_type', 'siropu_chat')
               ->where('content_id', \XF::visitor()->user_id)
               ->fetch();

		$data['template'] = 'siropu_chat_editor_dialog_chat';
          $data['params']   = [
               'attachmentData' => $attachmentData,
               'attachmentList' => $attachmentList
          ];
	}
     public static function criteriaUser($rule, array $data, \XF\Entity\User $user, &$returnValue)
	{
		switch ($rule)
		{
			case 'siropu_chat_messages_posted':
				if (isset($user->siropu_chat_message_count) && $user->siropu_chat_message_count >= $data['messages_posted'])
				{
					$returnValue = true;
				}
				break;
               case 'siropu_chat_messages_maximum':
				if (isset($user->siropu_chat_message_count) && $user->siropu_chat_message_count <= $data['messages_maximum'])
				{
					$returnValue = true;
				}
				break;
		}
	}
     private static function assertValidForum($id)
     {
          $forums = \XF::options()->siropuChatForumActivityForums;

		if (empty($forums) || in_array($id, $forums))
		{
			return true;
		}
     }
}
