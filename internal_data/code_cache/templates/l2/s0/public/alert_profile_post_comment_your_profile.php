<?php
// FROM HASH: fff22a450f95c94136173edf41b2960b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['xf']['visitor']['user_id'] == $__vars['content']['ProfilePost']['user_id']) {
		$__finalCompiled .= '
	' . '' . $__templater->fn('username_link', array($__vars['user'], false, array('defaultname' => $__vars['alert']['username'], ), ), true) . ' bình luậ <a ' . (('href="' . $__templater->fn('link', array('profile-posts/comments', $__vars['content'], ), true)) . '" class="fauxBlockLink-blockLink"') . '>trạng thái của bạn</a>.' . '
';
	} else {
		$__finalCompiled .= '
	' . '' . $__templater->fn('username_link', array($__vars['user'], false, array('defaultname' => $__vars['alert']['username'], ), ), true) . ' bình luận trong <a ' . (('href="' . $__templater->fn('link', array('profile-posts/comments', $__vars['content'], ), true)) . '" class="fauxBlockLink-blockLink"') . '>bài viết của ' . $__templater->escape($__vars['content']['ProfilePost']['username']) . '</a> trong hồ sơ của bạn.' . '
';
	}
	return $__finalCompiled;
});