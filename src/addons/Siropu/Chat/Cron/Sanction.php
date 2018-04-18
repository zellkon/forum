<?php

namespace Siropu\Chat\Cron;

class Sanction
{
	public static function deleteExpiredSanctions()
	{
		\XF::app()->repository('Siropu\Chat:Sanction')->deleteExpiredSanctions();
     }
}
