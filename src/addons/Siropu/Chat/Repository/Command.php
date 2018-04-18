<?php

namespace Siropu\Chat\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class Command extends Repository
{
     public function findCommandsForList()
     {
          return $this->finder('Siropu\Chat:Command')
               ->order('command_name', 'ASC');
     }
     public function findActiveCommands()
     {
          return $this->findCommandsForList()
               ->where('command_enabled', 1);
     }
     public function findActiveCommand($command)
     {
          return $this->finder('Siropu\Chat:Command')
               ->where('command_name', $command)
               ->where('command_enabled', 1)
               ->fetchOne();
     }
     public function findCommandByDefaultName($command)
     {
          return $this->finder('Siropu\Chat:Command')
               ->where('command_name_default', $command)
               ->fetchOne();
     }
     public function getCommandCacheData()
     {
          $cache = [];

          foreach ($this->finder('Siropu\Chat:Command')->where('command_enabled', 1)->fetch() AS $command)
          {
               $cache[$command->command_name] = $command->toArray();
          }

          return $cache;
     }
     public function getDefaultCommandCacheData()
     {
          $cache = [];

          foreach ($this->finder('Siropu\Chat:Command')->where('command_enabled', 1)->fetch() AS $command)
          {
               $cache[$command->command_name_default] = $command->command_name;
          }

          return $cache;
     }
     public function rebuildCommandCache()
     {
          $simpleCache = $this->app()->simpleCache();
          $simpleCache['Siropu/Chat']['commands'] = $this->getCommandCacheData();
          $simpleCache['Siropu/Chat']['commandsDefault'] = $this->getDefaultCommandCacheData();
     }
     public function getCommandFromCache($commandName)
     {
          $cache = $this->getCommandCache();

          return isset($cache[$commandName]) ? $this->instantiateCommandEntity($cache[$commandName]) : null;
     }
     public function getDefaultCommandFromCache($commandName)
     {
          $cache = $this->getDefaultCommandCache();

          return isset($cache[$commandName]) ? $cache[$commandName] : $commandName;
     }
     public function instantiateCommandEntity(array $command)
     {
          return $this->em->instantiateEntity('Siropu\Chat:Command', $command);
     }
     public function getCommandCache()
     {
          $simpleCache = $this->app()->simpleCache();
          return $simpleCache['Siropu/Chat']['commands'];
     }
     public function getDefaultCommandCache()
     {
          $simpleCache = $this->app()->simpleCache();
          return $simpleCache['Siropu/Chat']['commandsDefault'];
     }
}
