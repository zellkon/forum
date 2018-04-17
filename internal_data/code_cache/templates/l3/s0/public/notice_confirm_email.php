<?php
// FROM HASH: 87a6f0c0240a3db368a5ab20e6291660
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= 'Tài khoản của bạn đang chờ xác nhận từ email. Xác nhận đã được gửi đến ' . $__templater->escape($__vars['xf']['visitor']['email']) . '.' . '<br />
<a href="' . $__templater->fn('link', array('account-confirmation/resend', ), true) . '" data-xf-click="overlay">' . 'Gửi lại email xác nhận' . '</a>';
	return $__finalCompiled;
});