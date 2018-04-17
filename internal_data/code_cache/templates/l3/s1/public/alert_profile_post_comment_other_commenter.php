<?php
// FROM HASH: 606513fcc888cba4951701bd529bbfee
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['content']['ProfilePost']['ProfileUser']['user_id'] == $__vars['content']['ProfilePost']['user_id']) {
		$__finalCompiled .= '
	' . '' . $__templater->fn('username_link', array($__vars['user'], false, array('defaultname' => $__vars['alert']['username'], ), ), true) . ' cũng bình luận trong <a ' . (('href="' . $__templater->fn('link', array('profile-posts/comments', $__vars['content'], ), true)) . '" class="fauxBlockLink-blockLink"') . '>trạng thái của ' . $__templater->escape($__vars['content']['ProfilePost']['username']) . '</a>' . '.
';
	} else {
		$__finalCompiled .= '
	' . '' . $__templater->fn('username_link', array($__vars['user'], false, array('defaultname' => $__vars['alert']['username'], ), ), true) . ' cũng bình luận trong <a ' . (('href="' . $__templater->fn('link', array('profile-posts/comments', $__vars['content'], ), true)) . '" class="fauxBlockLink-blockLink"') . '>hồ sơ của ' . $__templater->escape($__vars['content']['ProfilePost']['username']) . '</a>' . '.
';
	}
	return $__finalCompiled;
});