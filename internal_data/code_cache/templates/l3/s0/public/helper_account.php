<?php
// FROM HASH: 39b8370092bfcb0dbb4ba1faef33e637
return array('macros' => array('dob_privacy_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'hint' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'value' => '1',
		'name' => 'option[show_dob_date]',
		'checked' => $__vars['xf']['visitor']['Option']['show_dob_date'],
		'label' => 'Hiển thị ngày và tháng sinh',
		'_dependent' => array($__templater->formCheckBox(array(
	), array(array(
		'value' => '1',
		'name' => 'option[show_dob_year]',
		'checked' => $__vars['xf']['visitor']['Option']['show_dob_year'],
		'label' => 'Hiển thị năm sinh',
		'hint' => 'Điều này sẽ cho phép mọi người nhìn thấy tuổi của bạn.',
		'_type' => 'option',
	)))),
		'_type' => 'option',
	)), array(
		'hint' => ($__vars['hint'] ? $__templater->escape($__vars['hint']) : ''),
	)) . '
';
	return $__finalCompiled;
},
'activity_privacy_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user[visible]',
		'checked' => $__vars['xf']['visitor']['visible'],
		'label' => 'Hiển thị trạng thái trực tuyến',
		'hint' => 'Điều này sẽ cho phép người khác nhìn thấy khi bạn đang online.',
		'_dependent' => array($__templater->formCheckBox(array(
	), array(array(
		'name' => 'user[activity_visible]',
		'checked' => $__vars['xf']['visitor']['activity_visible'],
		'label' => 'Hiển thị hoạt động hiện tại của bạn',
		'hint' => 'Điều này sẽ cho phép tất cả mọi người nhìn thấy trang nào bạn đang xem.',
		'_type' => 'option',
	)))),
		'_type' => 'option',
	)), array(
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
});