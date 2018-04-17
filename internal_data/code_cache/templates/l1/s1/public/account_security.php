<?php
// FROM HASH: 174761e6b460b0c7607f180c78b12200
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Password and security');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['xf']['visitor']['Option']['use_tfa']) {
		$__compilerTemp1 .= '
					' . 'Enabled (' . $__templater->filter($__vars['enabledTfaProviders'], array(array('join', array(', ', )),), true) . ')' . '
				';
	} else {
		$__compilerTemp1 .= '
					' . 'Disabled' . '
				';
	}
	$__compilerTemp2 = '';
	if ($__vars['hasPassword']) {
		$__compilerTemp2 .= '
				' . $__templater->formTextBoxRow(array(
			'name' => 'old_password',
			'type' => 'password',
			'autofocus' => 'autofocus',
		), array(
			'label' => 'Your existing password',
			'explain' => 'For security reasons, you must verify your existing password before you may set a new password.',
		)) . '

				' . $__templater->formTextBoxRow(array(
			'name' => 'password',
			'type' => 'password',
		), array(
			'label' => 'New password',
		)) . '

				' . $__templater->formTextBoxRow(array(
			'name' => 'password_confirm',
			'type' => 'password',
		), array(
			'label' => 'Confirm new password',
		)) . '
			';
	} else {
		$__compilerTemp2 .= '
				' . $__templater->formRow('
					' . 'Your account does not currently have a password.' . ' <a href="' . $__templater->fn('link', array('account/request-password', ), true) . '" data-xf-click="overlay">' . 'Request a password be emailed to you' . '</a>
				', array(
			'label' => 'Password',
		)) . '
			';
	}
	$__compilerTemp3 = '';
	if ($__vars['hasPassword']) {
		$__compilerTemp3 .= '
			' . $__templater->formSubmitRow(array(
			'icon' => 'save',
		), array(
		)) . '
		';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRow('

				' . $__compilerTemp1 . '
				' . $__templater->button('Change', array(
		'href' => $__templater->fn('link', array('account/two-step', ), false),
		'class' => 'button--link',
	), '', array(
	)) . '
			', array(
		'rowtype' => 'button',
		'label' => 'Two-step verification',
	)) . '

			<hr class="formRowSep" />

			' . $__compilerTemp2 . '
		</div>
		' . $__compilerTemp3 . '
	</div>
', array(
		'action' => $__templater->fn('link', array('account/security', ), false),
		'ajax' => 'true',
		'class' => 'block',
		'data-force-flash-message' => 'true',
	));
	return $__finalCompiled;
});