<?php

namespace Siropu\Chat\Navigation;

class Tab
{
     public static function chat(array $navData, $context, $selected)
     {
          $options = \XF::options();
          $visitor = \XF::visitor();

          if ($options->siropuChatEnabled
               && $options->siropuChatPage
               && $visitor->canViewSiropuChat()
               && !$visitor->isBannedSiropuChat())
          {
               $params = [
                    'title' => \XF::phrase('nav.siropuChat'),
                    'href'  => \XF::app()->router()->buildLink('chat')
               ];

               if ($options->siropuChatNavUserCount)
               {
                    $activeUserCount = \XF::app()->repository('Siropu\Chat\Repository\User')->getActiveUserCount();

                    if ($options->siropuChatGuestRoom)
                    {
                         $guestServiceManager = \XF::service('Siropu\Chat:Guest\Manager');
                         $activeUserCount += $guestServiceManager->getActiveGuestCount();
                    }

                    $params['counter'] = ' ' . $activeUserCount;
               }

               if ($options->siropuChatNavIcon)
               {
                    $params['icon'] = $options->siropuChatNavIcon;
               }

               return $params;
          }
     }
}
