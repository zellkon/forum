<?php
// FROM HASH: d5f4f8080a7e3385c31dfb958207104a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tìm trong hồ sơ cá nhân');
	$__finalCompiled .= '

' . $__templater->callMacro('search_form_macros', 'keywords', array(
		'input' => $__vars['input'],
		'canTitleLimit' => false,
	), $__vars) . '

' . $__templater->callMacro('search_form_macros', 'user', array(
		'input' => $__vars['input'],
	), $__vars) . '

' . $__templater->formTextBoxRow(array(
		'name' => 'c[profile_users]',
		'value' => $__vars['input']['c']['profile_users'],
		'ac' => 'true',
	), array(
		'label' => 'Đăng trong hồ sơ của thành viên',
		'explain' => 'Phân tách các tên bằng dấu (,).',
	)) . '

' . $__templater->callMacro('search_form_macros', 'date', array(
		'input' => $__vars['input'],
	), $__vars);
	return $__finalCompiled;
});