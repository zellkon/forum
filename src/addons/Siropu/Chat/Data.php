<?php

namespace Siropu\Chat;

class Data
{
     public function __construct()
     {
          $this->getUserRepo()->joinDefaultRooms();
          $this->getUserRepo()->autoLoginJoinedRooms();
     }
     public function getViewParams(array $extraParams = [])
     {
          $isChatPage = !empty($extraParams['isChatPage']) ?: false;
          $cssClass   = $this->getCssClass($isChatPage);

          if (!empty($extraParams['messageDisplayLimit']))
          {
               $messageDisplayLimit = $extraParams['messageDisplayLimit'];
          }
          else
          {
               $messageDisplayLimit = \XF::options()->siropuChatMessageDisplayLimit;
          }

          $viewParams = [
               'channel'             => $this->getChannel(),
               'cssClass'            => $cssClass,
               'settings'            => $this->getSettings(),
               'roomId'              => \XF::visitor()->getLastRoomIdSiropuChat(),
               'convId'              => \XF::visitor()->getLastConvIdSiropuChat(),
               'notice'              => $this->getNotice(),
               'ads'                 => $this->getAds(),
               'disabledButtons'     => $this->getDisabledButtons(),
               'messageDisplayLimit' => $messageDisplayLimit,
               'isResponsive'        => (\Siropu\Chat\Criteria\Device::isMobile() || strpos($cssClass, 'Sidebar')),
               'isChatPage'          => $isChatPage,
               'commands'            => [
                    'join'    => $this->getCommandRepo()->getDefaultCommandFromCache('join'),
                    'whisper' => $this->getCommandRepo()->getDefaultCommandFromCache('whisper')
               ],
               'rooms'               => [],
               'users'               => [],
               'userCount'           => 0,
               'messages'            => [],
               'lastMessage'         => [],
               'lastRoomIds'         => [],
               'convContacts'        => [],
               'convMessages'        => [],
               'convUnread'          => [],
               'convOnline'          => 0
          ];

          $this->setRoomParams($viewParams);
          $this->setConverationParams($viewParams);

          return array_merge($viewParams, $extraParams);
     }
     public function setRoomParams(array &$viewParams)
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          if (!($options->siropuChatRooms && $visitor->hasJoinedRoomsSiropuChat()))
          {
               return;
          }

          $messageSorter   = \XF::app()->service('Siropu\Chat:Message\Sorter');
          $userRoomIds     = $visitor->siropuChatGetRoomIds();
          $updateUserRooms = false;

          $rooms = \XF::app()->finder('Siropu\Chat:Room')
               ->fromRoom($userRoomIds)
               ->visible()
               ->fetch();

          foreach ($userRoomIds AS $roomId)
          {
               if (!isset($rooms[$roomId]) && $visitor->user_id)
               {
                    $visitor->siropuChatLeaveRoom($roomId, false);
                    $updateUserRooms = true;

                    continue;
               }

               $messageFinder = $this->getMessageRepo()
                    ->findMessages()
                    ->fromRoom($roomId)
                    ->limit($viewParams['messageDisplayLimit']);

               if (!$visitor->canSanctionSiropuChat())
               {
                    $messageFinder->notIgnored();
               }

               if (!$this->getSettings()['show_ignored'])
               {
                    $messageFinder->notFromIgnoredUsers();
               }

               $roomMessages = $messageFinder->fetch()->filter(function(\Siropu\Chat\Entity\Message $message)
               {
                    return ($message->canView());
               });

               $messageSorter->prepareForDisplay($roomMessages);
          }

          if ($updateUserRooms)
          {
               $visitor->save();
          }

          $users = $this->getUserRepo()
               ->findActiveUsers()
               ->fetch();

          $viewParams['rooms']       = $rooms;
          $viewParams['users']       = $this->getUserRepo()->groupUsersByRoom($users);
          $viewParams['userCount']   = $users->count();
          $viewParams['messages']    = $messageSorter->getGroupedMessages();
          $viewParams['lastMessage'] = $messageSorter->getLastMessage();
          $viewParams['lastRoomIds'] = $messageSorter->getLastIds();
     }
     public function setConverationParams(array &$viewParams)
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          if (!($options->siropuChatPrivateConversations
               && $visitor->canChatInPrivateSiropuChat()
               && $visitor->hasConversationsSiropuChat()))
          {
               return;
          }

          $messages             = [];
          $unreadConversations  = [];

          $conversationPreparer = \XF::app()->service('Siropu\Chat:Conversation\Preparer');

          if ($this->getChannel() == 'conv')
          {
               $conversationsMessages = $this->getConversationMessageRepo()
                    ->findMessages()
                    ->forConversation($visitor->getLastConvIdSiropuChat())
                    ->fetch()
                    ->filter(function(\Siropu\Chat\Entity\ConversationMessage $message)
                    {
                         return ($message->canView());
                    });

               $conversationPreparer->prepareForDisplay($conversationsMessages);
               $messages = $conversationPreparer->getGroupedMessages();
          }

          $conversations = $this->getConversationRepo()->getUserConversations();

          $unreadMessages = $this->getConversationMessageRepo()
               ->findMessages()
               ->forConversation($visitor->siropuChatGetConvIds())
               ->unread()
               ->fetch();

          foreach ($unreadMessages as $message)
          {
               $unreadConversations[$message->message_conversation_id][] = $message->message_id;
          }

          $viewParams['convContacts'] = $conversations;
          $viewParams['convMessages'] = $messages;
          $viewParams['convUnread']   = $unreadConversations;
          $viewParams['convOnline']   = $conversationPreparer->getOnlineCount($conversations);
     }
     public function getChannel()
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          $channel = \XF::app()->request()->getCookie('siropu_chat_channel', 'room');

          if ($channel == 'conv' && !($options->siropuChatPrivateConversations && $visitor->canChatInPrivateSiropuChat()))
          {
               return 'room';
          }

          return $channel;
     }
     public function getSettings()
     {
          return \XF::visitor()->getSiropuChatSettings();
     }
     public function getCssClass($isChatPage = false)
     {
          $settings    = $this->getSettings();
          $displayMode = $settings['display_mode'];

          if ($isChatPage)
          {
               $displayMode = 'chat_page';
          }

          switch ($displayMode)
          {
               case 'chat_page':
                    $cssClass = 'siropuChatPage';
                    break;
               case 'all_pages':
                    $cssClass = 'siropuChatAllPages';
                    break;
               case 'above_forum_list':
                    $cssClass = 'siropuChatAboveForumList';
                    break;
               case 'below_forum_list':
                    $cssClass = 'siropuChatBelowForumList';
                    break;
               case 'above_content':
                    $cssClass = 'siropuChatAboveContent';
                    break;
               case 'below_content':
                    $cssClass = 'siropuChatBelowContent';
                    break;
               case 'sidebar_top':
                    $cssClass = 'siropuChatSidebar siropuChatSidebarTop';
                    break;
               case 'sidebar_bottom':
                    $cssClass = 'siropuChatSidebar siropuChatSidebarBottom';
                    break;
               default:
                    $cssClass = 'siropuChatCustom';
                    break;
          }

          if ($settings['maximized'])
          {
               $cssClass .= ' siropuChatMaximized';
          }

          if ($settings['editor_on_top'])
          {
               $cssClass .= ' siropuChatEditorTop';
          }

          if ($settings['hide_chatters'])
          {
               $cssClass .= ' siropuChatHideUserList';
          }

          return $cssClass;
     }
     public function getDisabledBbCodes()
     {
          $options  = \XF::options();
          $disabled = [];

          foreach ($options->siropuChatEnabledBBCodes as $tag => $val)
          {
               if (!$val)
               {
                    $disabled[] = $tag;
               }
          }

          foreach ($options->siropuChatDisallowedCustomBbCodes as $tag)
          {
               $disabled[] = $tag;
          }

          return $disabled;
     }
     public function getDisabledButtons()
     {
          $buttons = ['_align', '_indent', '_list', 'undo', 'redo'];

          if ($disabled = $this->getDisabledBbCodes())
          {
               foreach ($disabled as $tag)
               {
                    switch ($tag)
                    {
                         case 'b':
                              $buttons[] = 'bold';
                              break;
                         case 'i':
                              $buttons[] = 'italic';
                              break;
                         case 'u':
                              $buttons[] = 'underline';
                              break;
                         case 's':
                              $buttons[] = 'strikeThrough';
                              break;
                         case 'url':
                              $buttons[] = '_link';
                              break;
                         case 'img':
                              $buttons[] = '_image';
                              break;
                         case 'color':
                              $buttons[] = 'color';
                              break;
                         case 'font':
                              $buttons[] = 'fontFamily';
                              break;
                         case 'size':
                              $buttons[] = 'fontSize';
                              break;
                         case 'media':
                              $buttons[] = '_media';
                              break;
                         case 'quote':
                              $buttons[] = 'xfQuote';
                              break;
                         case 'spoiler':
                              $buttons[] = 'xfSpoiler';
                              break;
                         case 'code':
                              $buttons[] = 'xfCode';
                              break;
                         case 'icode':
                              $buttons[] = 'xfInlineCode';
                              break;
                         default:
                              $buttons[] = 'xfCustom_' . $tag;
                              break;
                    }
               }
          }

          $options = \XF::options();

          if ($options->siropuChatDisableSmilieButton)
          {
               $buttons[] = 'xfSmilie';
          }

          if (!$options->siropuChatEditorToggleBbcode)
          {
               $buttons[] = 'xfBbCode';
          }

          return $buttons;
     }
     public function getAds()
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          $ads = [
               'aboveEditor' => '',
               'belowEditor' => ''
          ];

		if (!$visitor->hasPermission('siropuChat', 'viewAds'))
		{
			return $ads;
		}

          if ($aboveEditor = $options->siropuChatAdsAboveEditor)
		{
			shuffle($aboveEditor);
			$ads['aboveEditor'] = $aboveEditor[0];
		}

		if ($belowEditor = $options->siropuChatAdsBelowEditor)
		{
			shuffle($belowEditor);
			$ads['belowEditor'] = $belowEditor[0];
		}

		return $ads;
     }
     public function getNotice(array $notices = [])
	{
          $options = \XF::options();
          $notices = $notices ?: $options->siropuChatNotice;

		if ($notices)
		{
			shuffle($notices);
			return $notices[0];
		}
	}
     /**
	 * @return \Siropu\Chat\Repository\User
	 */
     public function getUserRepo()
     {
          return \XF::app()->repository('Siropu\Chat:User');
     }
     /**
	 * @return \Siropu\Chat\Repository\Room
	 */
     public function getRoomRepo()
     {
          return\XF::app()->repository('Siropu\Chat:Room');
     }
     /**
	 * @return \Siropu\Chat\Repository\Message
	 */
     public function getMessageRepo()
     {
          return \XF::app()->repository('Siropu\Chat:Message');
     }
     /**
	 * @return \Siropu\Chat\Repository\Conversation
	 */
     public function getConversationRepo()
     {
          return \XF::app()->repository('Siropu\Chat:Conversation');
     }
     /**
	 * @return \Siropu\Chat\Repository\ConversationMessage
	 */
     public function getConversationMessageRepo()
     {
          return \XF::app()->repository('Siropu\Chat:ConversationMessage');
     }
     /**
	 * @return \Siropu\Chat\Repository\Command
	 */
     public function getCommandRepo()
     {
          return \XF::app()->repository('Siropu\Chat:Command');
     }
}
