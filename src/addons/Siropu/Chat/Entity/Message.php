<?php

namespace Siropu\Chat\Entity;

use XF\Entity\QuotableInterface;
use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Message extends Entity implements QuotableInterface, \XF\BbCode\RenderableContentInterface
{
     public static function getStructure(Structure $structure)
	{
          $structure->table      = 'xf_siropu_chat_message';
          $structure->shortName  = 'Chat:Message';
          $structure->primaryKey = 'message_id';

          $structure->columns = [
               'message_id'         => ['type' => self::UINT, 'autoIncrement' => true],
               'message_room_id'    => ['type' => self::UINT, 'default' => 1],
               'message_user_id'    => ['type' => self::UINT, 'default' => \XF::visitor()->user_id],
               'message_username'   => ['type' => self::STR, 'maxLength' => 50, 'default' => \XF::visitor()->username],
               'message_bot_name'   => ['type' => self::STR, 'maxLength' => 50, 'default' => ''],
               'message_type'       => ['type' => self::STR, 'maxLength' => 10, 'default' => 'chat',
                    'allowedValues' => ['chat', 'whisper', 'me', 'bot', 'forum', 'media', 'resource', 'error', 'prune']],
               'message_type_id'    => ['type' => self::UINT, 'default' => 0],
               'message_is_ignored' => ['type' => self::UINT, 'default' => 0],
               'message_text'       => ['type' => self::STR, 'required' => 'siropu_chat_cannot_submit_empty_message'],
               'message_recipients' => ['type' => self::SERIALIZED_ARRAY, 'default' => []],
               'message_mentions'   => ['type' => self::SERIALIZED_ARRAY, 'default' => []],
               'message_like_users' => ['type' => self::SERIALIZED_ARRAY, 'default' => []],
               'message_like_count' => ['type' => self::UINT, 'default' => 0],
               'message_date'       => ['type' => self::UINT, 'default' => \XF::$time],
               'message_edit_count' => ['type' => self::UINT, 'default' => 0],
          ];

          $structure->getters   = [
               'css_class'      => true,
               'message'        => true,
               'recipients'     => true
          ];

		$structure->relations = [
               'User' => [
				'entity'     => 'XF:User',
				'type'       => self::TO_ONE,
				'conditions' => [['user_id', '=', '$message_user_id']]
			],
               'Room' => [
                    'entity'     => 'Siropu\Chat:Room',
                    'type'       => self::TO_ONE,
                    'conditions' => [['room_id', '=', '$message_room_id']]
               ]
          ];

          $structure->defaultWith = ['User'];

          return $structure;
     }
     public function getCssClass()
     {
          $cssCLass = 'siropuChatMessageRow';

          switch ($this->message_type)
          {
               case 'whisper':
                    $cssCLass .= ' siropuChatWhisper';
                    break;
               case 'forum':
               case 'media':
               case 'resource':
                    $cssCLass .= ' siropuChatForumActivity';
                    break;
               case 'me':
                    $cssCLass .= ' siropuChatMe';
                    break;
               case 'bot':
                    $cssCLass .= ' siropuChatBot';
                    break;
               case 'quit':
                    $cssCLass .= ' siropuChatQuit';
                    break;
               case 'error':
                    $cssCLass .= ' siropuChatError';
                    break;
          }

          $visitor = \XF::visitor();

          if ($visitor->is_admin)
          {
               $cssCLass .= ' siropuChatIsAdmin';
          }
          else if ($visitor->is_moderator)
          {
               $cssCLass .= ' siropuChatIsModerator';
          }
          else if ($visitor->is_staff)
          {
               $cssCLass .= ' siropuChatIsStaff';
          }

          if ($this->isMentioned())
          {
               $cssCLass .= ' siropuChatMention';
          }

          if ($this->isIgnored())
          {
               $cssCLass .= ' siropuChatIgnored';
          }

          return $cssCLass;
     }
     public function getMessage()
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          if ($this->isBotNotification() && !$options->siropuChatActivityNotificationsBot)
          {
               return preg_replace('/^\[USER=[0-9]+\].*?\[\/USER\]/', '', $this->message_text);
          }

          if (!$this->canViewContent())
          {
               return preg_replace(
                    '/[^\s]/',
                    $options->siropuChatMessageContentReplacementCharacter,
                    $this->app()->stringFormatter()->stripBbCode($this->message_text)
               );
          }

          if ($visitor->getSiropuChatSettings()['image_as_link'])
          {
               return preg_replace('/\[IMG\](.*?)\[\/IMG\]/i', '[URL]$1[/URL]', $this->message_text);
          }

          return $this->message_text;
     }
     public function canView()
     {
          if ($this->isError() && !$this->isSelf())
          {
               return false;
          }

          if ($this->isWhisper() && !$this->canViewWhisper())
          {
               return false;
          }

          return true;
     }
     public function isIgnoredUser()
     {
          $visitor = \XF::visitor();

          return $visitor->isIgnoring($this->message_user_id);
     }
     public function isIgnored()
     {
          return $this->message_is_ignored && !$this->isSelf();
     }
     public function isWhisper()
     {
          return $this->message_type == 'whisper';
     }
     public function canViewWhisper()
     {
          $visitor = \XF::visitor();

          return $this->isRecipient() || $visitor->hasPermission('siropuChatModerator', 'viewWhispers');
     }
     public function isRecipient()
     {
          $visitor = \XF::visitor();

          return isset($this->message_recipients[$visitor->user_id]);
     }
     public function isMentioned()
     {
          $visitor = \XF::visitor();

          return isset($this->message_mentions[$visitor->user_id]);
     }
     public function hasLikes()
     {
          return $this->message_like_count > 0;
     }
     public function isLiked()
     {
          $visitor = \XF::visitor();

          return isset($this->message_like_users[$visitor->user_id]);
     }
     public function canLike()
     {
          $visitor = \XF::visitor();

          return !$this->isSelf() && $visitor->hasPermission('siropuChat', 'likeMessages');
     }
     public function canUnlike()
     {
          $visitor = \XF::visitor();

          if ($visitor->user_id == 0 && isset($this->message_like_users[0]) && $this->message_like_users[0] < \XF::$time - 60)
          {
               return false;
          }

          return $this->canLike();
     }
     public function isCounted()
     {
          return in_array($this->message_type, ['chat', 'me']);
     }
     public function canViewContent()
     {
          $hideFromUserGroups = \XF::options()->siropuChatHideMessageContentFromUserGroups;

          if (empty($hideFromUserGroups) || !\XF::visitor()->isMemberOf($hideFromUserGroups))
          {
               return true;
          }
     }
     public function incrementLikeCount()
     {
          $this->message_like_count++;
     }
     public function decrementLikeCount()
     {
          $this->message_like_count--;
     }
     public function like()
     {
          $visitor = \XF::visitor();

          $users = $this->message_like_users;
          $users[$visitor->user_id] = \XF::$time;

          $this->message_like_users = $users;
     }
     public function unlike()
     {
          $visitor = \XF::visitor();

          $users = $this->message_like_users;
          unset($users[$visitor->user_id]);

          $this->message_like_users = $users;
     }
     public function getLikes()
     {
          return $this->message_like_users;
     }
     public function getLikesUserIds()
     {
          return array_keys($this->message_like_users);
     }
     public function getUserLikeDate($userId)
     {
          return $this->getLikes()[$userId];
     }
     public function canQuote()
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          if ($this->isBot() || $this->isError())
          {
               return false;
          }

          if (!$visitor->canUseSiropuChat())
          {
               return false;
          }

          return !empty($options->siropuChatEnabledBBCodes['quote']);
     }
     public function canReport()
     {
          $visitor = \XF::visitor();

          return !$this->isBot() && !$this->isSelf() && $visitor->canReportSiropuChatMessages();
     }
     public function canEdit(&$error = null)
     {
          $visitor = \XF::visitor();

          if ($this->isBot() || $this->isError())
          {
               return false;
          }

          if ($visitor->hasPermission('siropuChatModerator', 'editAnyMessage'))
          {
               return true;
          }

          if ($this->isSelf() && $visitor->hasPermission('siropuChat', 'editOwnMessages'))
          {
               $editLimit = $visitor->hasPermission('siropuChat', 'editOwnMessagesTimeLimit');

               if ($editLimit != -1 && (!$editLimit || $this->message_date < \XF::$time - 60 * $editLimit))
			{
				$error = \XF::phraseDeferred('message_edit_time_limit_expired', ['minutes' => $editLimit]);
				return false;
			}

			return true;
          }
     }
     public function canDelete(&$error = null)
     {
          $visitor = \XF::visitor();

          if ($visitor->hasPermission('siropuChatModerator', 'deleteAnyMessage'))
          {
               return true;
          }

          if ($this->isSelf() && $visitor->hasPermission('siropuChat', 'deleteOwnMessages'))
          {
               $editLimit = $visitor->hasPermission('siropuChat', 'editOwnMessagesTimeLimit');

               if ($editLimit != -1 && (!$editLimit || $this->message_date < \XF::$time - 60 * $editLimit))
               {
                    $error = \XF::phraseDeferred('message_edit_time_limit_expired', ['minutes' => $editLimit]);
                    return false;
               }

               return true;
          }
     }
     public function canLink()
     {
          $visitor = \XF::visitor();

          return !$this->isBot() && $visitor->hasPermission('siropuChat', 'viewArchive');
     }
     public function canViewHistory()
     {
          $visitor = \XF::visitor();

          return $visitor->hasPermission('siropuChat', 'viewEditHistory');
     }
     public function isSelf()
     {
          $visitor = \XF::visitor();

          return $this->message_user_id == $visitor->user_id;
     }
     public function isChat()
     {
          return $this->message_type == 'chat';
     }
     public function isGuest()
     {
          return $this->message_user_id == 0;
     }
     public function isBot()
     {
          return $this->message_type == 'bot' || $this->message_type == 'prune' || $this->isBotNotification();
     }
     public function isError()
     {
          return $this->message_type == 'error';
     }
     public function isPrune()
     {
          return $this->message_type == 'prune';
     }
     public function isBotNotification()
     {
          return in_array($this->message_type, ['forum', 'media', 'resource']);
     }
     public function isEdited()
     {
          return $this->message_edit_count > 0;
     }
     public function isMe()
     {
          return $this->message_type == 'me';
     }
     public function mentionUser($user)
     {
          $mention = [$user->user_id => ['user_id'  => $user->user_id, 'username' => $user->username]];
          $this->message_mentions = $this->message_mentions + $mention;
     }
     public function ignoreMe()
     {
          $visitor = \XF::visitor();

          $this->message_is_ignored = $visitor->user_id;
     }
     public function getRecipients()
     {
          $visitor = \XF::visitor();

          $recipients = $this->message_recipients;
          unset($recipients[$visitor->user_id]);

          return implode(', ', $recipients);
     }
     public function getQuoteWrapper($inner)
	{
          return '[QUOTE="' . $this->message_username . '"]' . $inner . '[/QUOTE]';
     }
     public function getBbCodeRenderOptions($context, $type)
     {
          return [
               'entity' => $this,
               'user'   => $this->User
          ];
     }
     public function setError($error)
     {
          $this->message_text = $error;
          $this->message_type = 'error';
     }
     public function setRoomLeaveMessage($message)
     {
          $visitor = \XF::visitor();

          $phraseParams = [
               'user'    => $visitor->siropuChatGetUserWrapper(),
               'message' => $message
          ];

          if (empty($message))
          {
               $this->message_text = \XF::phrase('siropu_chat_x_has_left_the_room', $phraseParams);
          }
          else
          {
               $this->message_text = \XF::phrase('siropu_chat_x_has_left_the_room_message', $phraseParams);
          }

     }
     protected function _preSave()
	{
          //$this->message_text = preg_replace(''/\[(.*)\](*SKIP)(*F)|[\n\r\s]/gsu', ' ', $this->message_text);
	}
     protected function _postSave()
	{
          $minMessageLength = \XF::options()->siropuChatThreadMessageMinLength;

          if ($this->isChat() && $this->message_user_id && ($minMessageLength == 0 || strlen($this->app()->stringFormatter()->stripBbCode($this->message_text)) >= $minMessageLength))
          {
               $room = $this->app()->repository('Siropu\Chat:Room')->getRoomFromCache($this->message_room_id);

               if (!empty($room->room_thread_id))
               {
                    $replier = $this->app()->service('XF:Thread\Replier', $this->em()->find('XF:Thread', $room->room_thread_id));
                    $replier->setMessage($this->message_text);
                    $replier->setIsAutomated();
                    $replier->save();
               }
          }

          if ($this->isUpdate() || $this->isPrune())
          {
               if ($this->isPrune())
               {
                    $action = 'prune';
               }
               else if ($this->isChanged('message_like_count'))
               {
                    $action = 'like';
               }
               else
               {
                    $action = 'edit';
               }

               $this->app()->service('Siropu\Chat:Room\ActionLogger', $action)->logMessageAction($this);
          }
	}
	protected function _postDelete()
	{
          $this->db()->delete(
               'xf_edit_history',
               'content_type = ? AND content_id = ?',
               ['siropu_chat_room_message', $this->message_id]
          );

          $this->app()->service('Siropu\Chat:Room\ActionLogger', 'delete')->logMessageAction($this);
	}
}
