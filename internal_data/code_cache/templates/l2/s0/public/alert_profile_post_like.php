<?php
// FROM HASH: d69fc6cea04b1bc3716e5144035898a5
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['xf']['visitor']['user_id'] == $__vars['content']['ProfileUser']['user_id']) {
		$__finalCompiled .= '
	' . '' . $__templater->fn('username_link', array($__vars['user'], false, array('defaultname' => $__vars['alert']['username'], ), ), true) . ' thích <a ' . (('href="' . $__templater->fn('link', array('profile-posts', $__vars['content'], ), true)) . '" class="fauxBlockLink-blockLink"') . '>trạng thái của bạn</a>.' . '
';
	} else {
		$__finalCompiled .= '
	' . '' . $__templater->fn('username_link', array($__vars['user'], false, array('defaultname' => $__vars['alert']['username'], ), ), true) . ' thích <a ' . (('href="' . $__templater->fn('link', array('profile-posts', $__vars['content'], ), true)) . '" class="fauxBlockLink-blockLink"') . '>bài viết của bạn</a> trong hồ sơ của ' . $__templater->escape($__vars['content']['ProfileUser']['username']) . '.' . '
';
	}
	return $__finalCompiled;
});