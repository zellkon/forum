<?php
// FROM HASH: 1b96fb1a84ad330de40c8610f4cbcb7f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__compilerTemp1 = $__vars;
	$__compilerTemp1['extraOptions'] = $__templater->preEscaped('
		' . $__templater->callMacro('base_custom_field_macros', 'common_options', array(
		'field' => $__vars['field'],
		'supportsUserEditable' => true,
		'supportsEditableOnce' => true,
		'supportsModeratorEditable' => true,
	), $__vars) . '

		' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'show_registration',
		'selected' => $__vars['field']['show_registration'],
		'label' => 'Hiển thị trong quá trình đăng ký',
		'hint' => 'Các trường bắt buộc sẽ luôn được hiển thị trong quá trình đăng ký.',
		'_type' => 'option',
	),
	array(
		'name' => 'viewable_profile',
		'selected' => $__vars['field']['viewable_profile'],
		'label' => 'Có thể xem được trên trang hồ sơ',
		'hint' => 'Điều này không áp dụng cho các trường được hiển thị trong trang sở thích.',
		'_type' => 'option',
	),
	array(
		'name' => 'viewable_message',
		'selected' => $__vars['field']['viewable_message'],
		'label' => 'Có thể xem được trong thông tin thành viên',
		'hint' => 'Trường này sẽ chỉ được hiển thị trên thông tin thành viên nếu thuộc tính \'Hiển thị các trường tùy chỉnh\' được bật trong nhóm \'Các yếu tố tin nhắn\'',
		'_type' => 'option',
	)), array(
	)) . '
	');
	$__finalCompiled .= $__templater->includeTemplate('base_custom_field_edit', $__compilerTemp1);
	return $__finalCompiled;
});