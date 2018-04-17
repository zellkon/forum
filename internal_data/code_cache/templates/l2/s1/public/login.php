<?php
// FROM HASH: d4a59cec96a65f4a0ef4e4aeaaace98e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeJs(array(
		'src' => 'xf/login_signup.js',
		'min' => '1',
	));
	$__finalCompiled .= '

';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Đăng nhập');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= $__templater->escape($__vars['error']);
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--error blockMessage--iconic">
		' . $__compilerTemp1 . '
	</div>
';
	}
	$__finalCompiled .= '

<div class="blocks">
	';
	$__compilerTemp2 = '';
	if ($__vars['captcha']) {
		$__compilerTemp2 .= '
					' . $__templater->formRowIfContent($__templater->fn('captcha', array(true)), array(
			'label' => 'Mã xác nhận',
			'force' => 'true',
		)) . '
				';
	}
	$__compilerTemp3 = '';
	if ($__vars['xf']['options']['registrationSetup']['enabled']) {
		$__compilerTemp3 .= '
			<div class="block-outer block-outer--after">
				<div class="block-outer-middle">
					' . 'Bạn chưa có tài khoản?' . ' ' . $__templater->button('Đăng ký ngay', array(
			'href' => $__templater->fn('link', array('register', ), false),
		), '', array(
		)) . '
				</div>
			</div>
		';
	}
	$__finalCompiled .= $__templater->form('
		<div class="block-container">
			<div class="block-body">
				' . $__templater->formTextBoxRow(array(
		'name' => 'login',
		'value' => $__vars['login'],
		'autofocus' => 'autofocus',
		'autocomplete' => 'username',
	), array(
		'label' => 'Tên tài khoản hoặc địa chỉ Email',
	)) . '

				' . $__templater->formTextBoxRow(array(
		'name' => 'password',
		'type' => 'password',
		'autocomplete' => 'current-password',
	), array(
		'label' => 'Mật khẩu',
		'html' => '
						<a href="' . $__templater->fn('link', array('lost-password', ), true) . '" data-xf-click="overlay">' . 'Bạn đã quên mật khẩu?' . '</a>
					',
	)) . '

				' . $__compilerTemp2 . '

				' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'remember',
		'selected' => true,
		'label' => 'Duy trì đăng nhập',
		'_type' => 'option',
	)), array(
	)) . '
			</div>
			' . $__templater->formSubmitRow(array(
		'icon' => 'login',
	), array(
	)) . '
		</div>
		' . $__compilerTemp3 . '
	', array(
		'action' => $__templater->fn('link', array('login/login', ), false),
		'class' => 'block',
	)) . '

	';
	if (!$__templater->test($__vars['providers'], 'empty', array())) {
		$__finalCompiled .= '
		<div class="blocks-textJoiner"><span></span><em>' . 'Hoặc' . '</em><span></span></div>

		<div class="block">
			<div class="block-container">
				<div class="block-body">
					';
		$__compilerTemp4 = '';
		if ($__templater->isTraversable($__vars['providers'])) {
			foreach ($__vars['providers'] AS $__vars['provider']) {
				$__compilerTemp4 .= '
								<li>
									' . $__templater->button('
										' . $__templater->escape($__vars['provider']['title']) . '
									', array(
					'href' => $__templater->fn('link', array('register/connected-accounts', $__vars['provider'], array('setup' => true, ), ), false),
					'class' => 'button--provider button--provider--' . $__vars['provider']['provider_id'],
				), '', array(
				)) . '
								</li>
							';
			}
		}
		$__finalCompiled .= $__templater->formRow('

						<ul class="listHeap">
							' . $__compilerTemp4 . '
						</ul>
					', array(
			'rowtype' => 'button',
			'label' => 'Đăng nhập sử dụng',
		)) . '
				</div>
			</div>
		</div>
	';
	}
	$__finalCompiled .= '
</div>';
	return $__finalCompiled;
});