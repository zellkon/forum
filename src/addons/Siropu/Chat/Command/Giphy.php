<?php

namespace Siropu\Chat\Command;

class Giphy
{
     public static function run(\XF\Mvc\Controller $controller, \Siropu\Chat\Entity\Command $command, $messageEntity, $input)
     {
          if ($input)
          {
               $giphyUrl = 'https://api.giphy.com/v1/gifs/search?q=' . urlencode($input) . '&api_key=dc6zaTOxFJmzC&limit=100';
          }
          else
          {
               $giphyUrl = 'https://api.giphy.com/v1/gifs/trending?api_key=dc6zaTOxFJmzC&limit=100';
          }

          $gifs = @json_decode(@file_get_contents($giphyUrl), true);

          if (!empty($gifs['data']))
          {
               shuffle($gifs['data']);

               $messageEntity->message_text = '[IMG]' . $gifs['data'][0]['images']['original']['url'] . '[/IMG]';
          }
     }
}
