<?php

namespace XF\BbCode\Helper;

class AppleMusic
{
	const URL_REGEX = '#\.com/(?P<country>[a-z-]+)/(?P<type>album|playlist|post)/([^/]+/)?id([a-z]{2}\.)?(?P<id>[a-z0-9-]+)(\?i=(?P<song>\d+))?#i';

	public static function matchCallback($url, $matchedId, \XF\Entity\BbCodeMediaSite $site, $siteId)
	{
		if (preg_match(self::URL_REGEX, $url, $media))
		{
			if (!empty($media['song']))
			{
				$media['type'] = 'song';
				$media['id'] = $media['song'];
			}
			$matchedId = $media['country'] . '/' . $media['type'] . '/' . self::getPrefix($media['type']) . $media['id'];

			return $matchedId;
		}

		return false;
	}

	protected static function getPrefix($type)
	{
		switch (strtolower($type))
		{
			case 'playlist':
				return 'pl.';

			case 'post':
				return 'idsa.';

			default:
				return '';
		}
	}

	public static function htmlCallback($mediaKey, array $site, $siteId)
	{
		$parts = explode('/', $mediaKey);
		if (count($parts) != 3)
		{
			return '';
		}

		list($country, $type, $id) = $parts;

		$country = rawurlencode($country);
		$type = rawurlencode($type);
		$id = rawurlencode($id);

		$url = "//tools.applemusic.com/embed/v1/{$type}/{$id}?country={$country}";
		$style = '';
		$scrolling = 'auto';

		switch ($type)
		{
			case 'post':
				$height = 104;
				$url = "//embed.itunes.apple.com/embedded-player/{$country}/{$type}/{$id}?mt=1&app=music&country={$country}";
				$style = 'max-width:760px;width:100%';
				$scrolling = 'no';
				break;

			case 'song':
				$height = 110;
				break;

			case 'album':
			case 'playlist':
			default:
				$height = 500;
		}

		return \XF::app()->templater()->renderTemplate('public:_media_site_embed_applemusic', [
			'country' => $country,
			'type' => $type,
			'id' => $id,
			'url' => $url,
			'height' => $height,
			'style' => $style,
			'scrolling' => $scrolling
		]);
	}
}

