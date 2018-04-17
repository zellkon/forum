<?php
// FROM HASH: fd73d72ed41d0e1fb7addbf2721170aa
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<mail:subject>
	' . '' . $__templater->escape($__vars['xf']['options']['boardTitle']) . ': Email Changed' . '
</mail:subject>

' . '' . $__templater->escape($__vars['user']['username']) . ',<br />
<br />
Email của bạn tại ' . (((('<a href="' . $__templater->fn('link', array('canonical:index', ), true)) . '">') . $__templater->escape($__vars['xf']['options']['boardTitle'])) . '</a>') . ' gần đây đã được thay đổi thành ' . $__templater->escape($__vars['newEmail']) . '. Nếu bạn thực hiện thay đổi này, bạn có thể bỏ qua thông báo này.br />
<br />
Nếu bạn không yêu cầu thay đổi này, hãy đăng nhập và thay đổi mật khẩu và địa chỉ email của bạn. Nếu bạn không thể làm được điều này, vui lòng liên hệ với quản trị viên.<br />
<br />
Email của bạn đã được thay đổi bởi địa chỉ IP ' . $__templater->escape($__vars['ip']) . '.';
	return $__finalCompiled;
});