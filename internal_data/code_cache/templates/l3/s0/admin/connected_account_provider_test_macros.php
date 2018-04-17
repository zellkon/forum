<?php
// FROM HASH: 80941aa6a76b969a5ae997037281e514
return array('macros' => array('explain' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'providerTitle' => '!',
		'keyName' => '!',
		'keyValue' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formInfoRow('
		' . 'Điều này sẽ kiểm tra ' . $__templater->escape($__vars['providerTitle']) . ' nhà cung cấp tài khoản được kết nối. Bạn phải có tài khoản ' . $__templater->escape($__vars['providerTitle']) . ' để thực hiện kiểm tra này.' . '
	', array(
	)) . '

	' . $__templater->formRow($__templater->escape($__vars['keyValue']), array(
		'label' => $__templater->escape($__vars['keyName']),
	)) . '
';
	return $__finalCompiled;
},
'success' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formInfoRow('
		<div class="blockMessage blockMessage--success">' . 'Kiểm tra thành công!' . '</div>
	', array(
		'rowtype' => 'confirm',
	)) . '
';
	return $__finalCompiled;
},
'display_name' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'name' => '!',
		'secondaryName' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = '';
	if ($__vars['secondaryName']) {
		$__compilerTemp1 .= '
			' . $__templater->escape($__vars['secondaryName']) . '
		';
	}
	$__finalCompiled .= $__templater->formRow('
		' . ($__templater->escape($__vars['name']) ?: 'N/A') . '
		' . $__compilerTemp1 . '
	', array(
		'label' => 'Tên',
	)) . '
';
	return $__finalCompiled;
},
'email' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'email' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formRow('
		' . ($__templater->escape($__vars['email']) ?: 'N/A') . '
	', array(
		'label' => 'Email',
	)) . '
';
	return $__finalCompiled;
},
'picture' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'url' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = '';
	if ($__vars['url']) {
		$__compilerTemp1 .= '
			<img src="' . $__templater->escape($__vars['url']) . '" width="48" />
		';
	} else {
		$__compilerTemp1 .= '
			' . 'N/A' . '
		';
	}
	$__finalCompiled .= $__templater->formRow('
		' . $__compilerTemp1 . '
	', array(
		'label' => 'Picture',
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

' . '

' . '

';
	return $__finalCompiled;
});