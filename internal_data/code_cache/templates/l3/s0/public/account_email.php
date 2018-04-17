<?php
// FROM HASH: 73dbec0103bccf2cd2bffdd47ad68583
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Change email');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['hasPassword']) {
		$__compilerTemp1 .= '

				' . $__templater->formTextBoxRow(array(
			'name' => 'email',
			'value' => $__vars['xf']['visitor']['email'],
			'type' => 'email',
			'dir' => 'ltr',
			'autofocus' => 'autofocus',
			'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'email', ), false),
		), array(
			'label' => 'Email',
			'explain' => 'Nếu bạn đổi địa chỉ Email, bạn sẽ phải xác nhận lại tài khoản của bạn.',
		)) . '

				' . $__templater->formTextBoxRow(array(
			'name' => 'password',
			'type' => 'password',
		), array(
			'label' => 'Mật khẩu hiện tại',
		)) . '

			';
	} else {
		$__compilerTemp1 .= '

				' . $__templater->formRow('

					' . $__templater->escape($__vars['xf']['visitor']['email']) . '
				', array(
			'label' => 'Email',
			'explain' => 'Không thể thay đổi email của bạn trong khi tài khoản của bạn không có mật khẩu.',
		)) . '

			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__compilerTemp1 . '
		</div>

		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('account/email', ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});