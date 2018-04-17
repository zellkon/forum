<?php
// FROM HASH: 174761e6b460b0c7607f180c78b12200
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Mật khẩu và bảo mật');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['xf']['visitor']['Option']['use_tfa']) {
		$__compilerTemp1 .= '
					' . 'Đã bật (' . $__templater->filter($__vars['enabledTfaProviders'], array(array('join', array(', ', )),), true) . ')' . '
				';
	} else {
		$__compilerTemp1 .= '
					' . 'Tắt' . '
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
			'label' => 'Mật khẩu hiện tại của bạn',
			'explain' => 'Vì lý do bảo mật, bạn phải xác minh mật khẩu hiện tại trước khi đặt mật khẩu mới.',
		)) . '

				' . $__templater->formTextBoxRow(array(
			'name' => 'password',
			'type' => 'password',
		), array(
			'label' => 'Mật khẩu mới',
		)) . '

				' . $__templater->formTextBoxRow(array(
			'name' => 'password_confirm',
			'type' => 'password',
		), array(
			'label' => 'Nhập lại mật khẩu mới',
		)) . '
			';
	} else {
		$__compilerTemp2 .= '
				' . $__templater->formRow('
					' . 'Tài khoản của bạn hiện không có mật khẩu.' . ' <a href="' . $__templater->fn('link', array('account/request-password', ), true) . '" data-xf-click="overlay">' . 'Yêu cầu khôi phục mật khẩu đã được gửi qua email cho bạn' . '</a>
				', array(
			'label' => 'Mật khẩu',
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
				' . $__templater->button('Thay đổi', array(
		'href' => $__templater->fn('link', array('account/two-step', ), false),
		'class' => 'button--link',
	), '', array(
	)) . '
			', array(
		'rowtype' => 'button',
		'label' => 'Xác minh 2 bước',
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