<?php
// FROM HASH: 3610ecad1e77283a9fdae70ebea3831a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<strong class="subject">Bạn</strong> đã được thưởng điểm thành tích: ' . (((('<a href="' . $__templater->fn('link', array('members/trophies', $__vars['xf']['visitor'], ), true)) . '" class="fauxBlockLink-blockLink">') . $__templater->escape($__vars['trophy'])) . '</a>') . '';
	return $__finalCompiled;
});