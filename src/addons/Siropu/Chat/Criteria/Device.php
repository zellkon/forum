<?php

namespace Siropu\Chat\Criteria;

class Device
{
     public static function isMatched($criteria)
     {
          if (empty($criteria))
          {
               return true;
          }

          $deviceType = self::getDeviceType();

          if (!empty($criteria[$deviceType]))
          {
               return true;
          }
     }
     public static function getDeviceType()
	{
          $mobileDetect = new \Mobile_Detect();

		return ($mobileDetect->isMobile() ? ($mobileDetect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
	}
     public static function isMobile()
	{
          return self::getDeviceType() == 'mobile';
     }
}
