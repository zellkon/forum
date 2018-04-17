<?php
// FROM HASH: 6dde4a35a2396beb711aab710c35ba8e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<mail:subject>
	' . '' . ($__templater->fn('prefix', array('thread', $__vars['thread'], 'escaped', ), true) . $__templater->escape($__vars['thread']['title'])) . ' - Trả lời mới trên chủ đề bạn quan tâm' . '
</mail:subject>

' . 'Chào ' . $__templater->escape($__vars['receiver']['username']) . ', ' . $__templater->fn('username_link_email', array($__vars['post']['User'], $__vars['post']['username'], ), true) . ' đã trả lời vào chủ đề bạn đang quan tâm trên ' . (((('<a href="' . $__templater->fn('link', array('canonical:index', ), true)) . '">') . $__templater->escape($__vars['xf']['options']['boardTitle'])) . '</a>') . '.' . '

<h2><a href="' . $__templater->fn('link', array('canonical:posts', $__vars['post'], ), true) . '">' . $__templater->fn('prefix', array('thread', $__vars['thread'], 'escaped', ), true) . $__templater->escape($__vars['thread']['title']) . '</a></h2>

';
	if ($__vars['xf']['options']['emailWatchedThreadIncludeMessage']) {
		$__finalCompiled .= '
	<div class="message">' . $__templater->fn('bb_code_type', array('emailHtml', $__vars['post']['message'], 'post', $__vars['post'], ), true) . '</div>
';
	}
	$__finalCompiled .= '

' . $__templater->callMacro('thread_forum_macros', 'go_thread_bar', array(
		'thread' => $__vars['thread'],
		'watchType' => 'threads',
	), $__vars) . '

' . $__templater->callMacro('thread_forum_macros', 'watched_thread_footer', array(
		'thread' => $__vars['thread'],
	), $__vars);
	return $__finalCompiled;
});