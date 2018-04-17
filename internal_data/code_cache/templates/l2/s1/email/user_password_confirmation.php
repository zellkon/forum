<?php
// FROM HASH: b8ec508479884757180b293697d0c019
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<mail:subject>
	' . '' . $__templater->escape($__vars['xf']['options']['boardTitle']) . ' Yêu cầu đặt lại mật khẩu' . '
</mail:subject>

' . '' . $__templater->escape($__vars['user']['username']) . ', theo thủ tục đặt lại mật khẩu của bện trên ' . (((('<a href="' . $__templater->fn('link', array('canonical:index', ), true)) . '">') . $__templater->escape($__vars['xf']['options']['boardTitle'])) . '</a>') . ', bạn cần phải nhấn vào đường dẫn dưới đây. Thao tác này sẽ tạo một mật khẩu mới và sẽ được gửi lại bằng email cho bạn.' . '

<p><a href="' . $__templater->fn('link', array('canonical:lost-password/confirm', $__vars['user'], array('c' => $__vars['confirmation']['confirmation_key'], ), ), true) . '" class="button">' . 'Lấy lại mật khẩu' . '</a></p>

';
	if ($__vars['isAdminReset']) {
		$__finalCompiled .= '
	<p>' . 'Đặt lại mật khẩu đã được yêu cầu bởi quản trị viên của ' . $__templater->escape($__vars['xf']['options']['boardTitle']) . ' nhân danh bạn.' . '</p>
';
	} else {
		$__finalCompiled .= '
	<p>' . 'Nếu bạn không yêu cầu email này, bạn có thể bỏ qua nó.' . '</p>
';
	}
	return $__finalCompiled;
});