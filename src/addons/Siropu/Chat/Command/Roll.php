<?php

namespace Siropu\Chat\Command;

class Roll
{
     protected static $defaultOptions = [
          'default_dice_count' => 1,
          'default_dice_sides' => 6,
          'max_dice_count'     => 1,
          'max_dice_sides'     => 6
     ];

     public static function run(\XF\Mvc\Controller $controller, \Siropu\Chat\Entity\Command $command, $messageEntity, $input)
     {
          if ($controller->channel == 'room' && $controller->getChatSettings()['hide_bot'])
          {
               return $controller->message(\XF::phrase('siropu_chat_bot_hidden_error'));
          }

          $roll = $input ? array_map('trim', preg_split('/[\s,]/', $input, null, PREG_SPLIT_NO_EMPTY)) : [];

          $diceCount = isset($command->command_options['default_dice_count'])
               ? $command->command_options['default_dice_count']
               : self::$defaultOptions['default_dice_count'];

          $diceSides = isset($command->command_options['default_dice_sides'])
               ? $command->command_options['default_dice_sides']
               : self::$defaultOptions['default_dice_sides'];

          $diceMaxCount = isset($command->command_options['max_dice_count'])
               ? $command->command_options['max_dice_count']
               : self::$defaultOptions['max_dice_count'];

          $diceMaxSides = isset($command->command_options['max_dice_sides'])
               ? $command->command_options['max_dice_sides']
               : self::$defaultOptions['max_dice_sides'];

          $dice   = $diceCount . 'd' . $diceSides;
          $result = [];

          if (isset($roll[0]) && preg_match('/([0-9]+)d([0-9]+)/i', $roll[0], $match))
          {
               $dice      = $match[0];
               $diceCount = (int) $match[1];
               $diceSides = (int) $match[2];

               if ($diceCount > $diceMaxCount || $diceSides > $diceMaxSides)
               {
                    return $controller->error(\XF::phrase('siropu_chat_roll_command_limit_error',
                         ['dice' => "{$diceMaxCount}d{$diceMaxSides}"]));
               }
          }

          for ($i = 0; $i < $diceCount; $i++)
          {
               if (count($roll) >= 1)
               {
                    $modPlus  = 0;
                    $modMinus = 0;

                    foreach ($roll as $modifier)
                    {
                         if (strpos($modifier, '+') !== false)
                         {
                              $modPlus = (int) $modifier;
                         }
                         if (strpos($modifier, '-') !== false)
                         {
                              $modMinus = (int) $modifier;
                         }
                    }

                    $result[] = rand(1, $diceSides + $modPlus) - $modMinus;
               }
               else
               {
                    $result[] = rand(1, $diceSides);
               }
          }

          if (!empty($modPlus))
          {
               $dice .= ' +' . $modPlus;
          }
          if (!empty($modMinus))
          {
               $dice .= ' -' . $modMinus;
          }

          $userId   = $messageEntity->message_user_id;
          $username = $messageEntity->message_username;

          if ($userId)
          {
               $user = '[USER=' . $userId . ']' . $username . '[/USER]';
          }
          else
          {
               $user = '(' . \XF::phrase('guest') . ') [B]' . $username . '[/B]';
          }

          $messageEntity->message_type = 'bot';
          $messageEntity->message_text = \XF::phrase('siropu_chat_roll_command_result', [
               'user'   => new \XF\PreEscaped($user),
               'dice'   => $dice,
               'result' => implode(',', $result)
          ]);
     }
}
