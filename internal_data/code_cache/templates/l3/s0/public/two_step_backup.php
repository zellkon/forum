<?php
// FROM HASH: ec95d434b8fea7139d641fa5546c3ec6
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formInfoRow('Mã dự phòng có thể được sử dụng khi bạn không có quyền truy cập vào phương pháp xác minh thay thế. Khi mã dự phòng được sử dụng, nó sẽ không còn được sử dụng nữa. Bạn sẽ nhận được một email khi bạn đăng nhập bằng mã dự phòng.', array(
	)) . '

' . $__templater->formTextBoxRow(array(
		'name' => 'code',
		'autofocus' => 'autofocus',
	), array(
		'label' => 'Mã dự phòng',
	));
	return $__finalCompiled;
});