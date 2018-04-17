<?php
// FROM HASH: 7399f4b060d06d410e1bdd76c5348780
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<mail:subject>
	' . '' . $__templater->escape($__vars['xf']['options']['boardTitle']) . ': Mật khẩu đã thay đổi' . '
</mail:subject>

' . '' . $__templater->escape($__vars['user']['username']) . ',<br />
<br />
Mật khẩu của bạn tại ' . (((('<a href="' . $__templater->fn('link', array('canonical:index', ), true)) . '">') . $__templater->escape($__vars['xf']['options']['boardTitle'])) . '</a>') . ' gần đây đã thay đổi. Nếu bạn thực hiện thay đổi này, bạn có thể bỏ qua thông báo này.<br />
<br />
Nếu bạn không yêu cầu thay đổi này, vui lòng sử dụng quá trình mật khẩu bị mất để tạo mật khẩu mới. Nếu bạn không thể làm được điều này, vui lòng liên hệ với quản trị viên.<br />
<br />
Mật khẩu của bạn đã được thay đổi bởi IP ' . $__templater->escape($__vars['ip']) . '.';
	return $__finalCompiled;
});