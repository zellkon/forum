<?php
// FROM HASH: 5129e5be2662a25b963897333fdd01cb
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<mail:subject>' . '' . $__templater->escape($__vars['xf']['options']['boardTitle']) . ': Đăng nhập qua mã dự phòng' . '</mail:subject>

' . '' . $__templater->escape($__vars['user']['username']) . ',<br />
<br />
Gần đây, bạn đã đăng nhập vào tài khoản của mình tại ' . (((('<a href="' . $__templater->fn('link', array('canonical:index', ), true)) . '">') . $__templater->escape($__vars['xf']['options']['boardTitle'])) . '</a>') . ' và hoàn thành xác minh hai bước qua một mã dự phòng. Mã dự phòng chỉ nên được sử dụng khi bạn không có quyền truy cập vào một phương pháp xác minh khác.<br />
<br />
Đăng nhập đã được yêu cầu thông qua IP ' . $__templater->escape($__vars['ip']) . '. Nếu bạn không yêu cầu, bạn nên thay đổi mật khẩu khẩn cấp.</p>';
	return $__finalCompiled;
});