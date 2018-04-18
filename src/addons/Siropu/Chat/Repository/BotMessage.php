<?php

namespace Siropu\Chat\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class BotMessage extends Repository
{
     public function findBotMessagesForList()
     {
          return $this->finder('Siropu\Chat:BotMessage');
     }
     public function getBotMessageEnabledCount()
     {
          return $this->findBotMessagesForList()
               ->isEnabled()
               ->total();
     }
     public function getCacheBotMessageCount()
     {
          $simpleCache = $this->app()->simpleCache();
          return $simpleCache['Siropu/Chat']['botMessageCount'];
     }
     public function rebuildBotMessageCache()
     {
          $simpleCache = $this->app()->simpleCache();
          $simpleCache['Siropu/Chat']['botMessageCount'] = $this->getBotMessageEnabledCount();
     }
}
