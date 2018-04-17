<?php
// FROM HASH: 43ec4b92920dda6466b4b374b8fd2bea
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thiết lập Xác minh Hai bước' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['provider']['title']));
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['newProviderData']) {
		$__compilerTemp1 .= '
				' . $__templater->filter($__templater->method($__vars['provider'], 'render', array('setup', $__vars['xf']['visitor'], $__vars['newProviderData'], $__vars['newTriggerData'], )), array(array('raw', array()),), true) . '

				' . $__templater->formHiddenVal('confirm', '1', array(
		)) . '
			';
	} else {
		$__compilerTemp1 .= '
				' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => 'regen',
			'value' => '1',
			'label' => 'Tạo lại mã bí mật cho thiết bị mới',
			'hint' => 'Điều này sẽ tạo lại mã bí mật và sẽ được sử dụng để xác minh chuyển dữ liệu đến một thiết bị mới. Khi hoàn thành, mã được tạo ra sẽ được sử dụng và mã bí mật cũ sẽ không còn hoạt động.',
			'_type' => 'option',
		)), array(
		)) . '
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__compilerTemp1 . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Xác nhận',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('account/two-step/manage', $__vars['provider'], ), false),
		'class' => 'block',
		'ajax' => ($__vars['newProviderData'] ? 'true' : ''),
	));
	return $__finalCompiled;
});