<?php

namespace Siropu\Chat\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class BotResponse extends Repository
{
     public function findBotResponsesForList()
     {
          return $this->finder('Siropu\Chat:BotResponse');
     }
     public function getBotResponseEnabledCount()
     {
          return $this->findBotResponsesForList()
               ->isEnabled()
               ->total();
     }
     public function getCacheBotResponseCount()
     {
          $simpleCache = $this->app()->simpleCache();
          return $simpleCache['Siropu/Chat']['botResponseCount'];
     }
     public function rebuildBotResponseCache()
     {
          $simpleCache = $this->app()->simpleCache();
          $simpleCache['Siropu/Chat']['botResponseCount'] = $this->getBotResponseEnabledCount();
     }
}
