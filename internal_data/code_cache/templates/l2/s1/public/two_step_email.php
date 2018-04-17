<?php
// FROM HASH: 955310f0b4d6ae16de459bd1518f8a8b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formInfoRow('Một email đã được gửi tới <b>' . $__templater->escape($__vars['email']) . '</b> với một mã xác minh chỉ sử dụng được một lần. Vui lòng nhập mã đó để tiếp tục.', array(
	)) . '

' . $__templater->formTextBoxRow(array(
		'name' => 'code',
		'autofocus' => 'autofocus',
	), array(
		'label' => 'Mã xác nhận',
	));
	return $__finalCompiled;
});