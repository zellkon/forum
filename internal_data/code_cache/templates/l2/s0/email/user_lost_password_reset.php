<?php
// FROM HASH: 6a6e960870eceea8d4ad7ada1ec3800b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<mail:subject>
	' . '' . $__templater->escape($__vars['xf']['options']['boardTitle']) . ' Đặt lại Mật khẩu' . '
</mail:subject>

' . '' . $__templater->escape($__vars['user']['username']) . ', mật khẩu của bạn trên ' . (((('<a href="' . $__templater->fn('link', array('canonical:index', ), true)) . '">') . $__templater->escape($__vars['xf']['options']['boardTitle'])) . '</a>') . ' đã được đặt lại. Bạn sử dụng mật khẩu bên dưới để đăng nhập.' . '

<p><a href="' . $__templater->fn('link', array('canonical:index', ), true) . '" class="button">' . 'Đăng nhập' . '</a></p>';
	return $__finalCompiled;
});