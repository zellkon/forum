<?php
// FROM HASH: a1e14a2fa43a8f7536da52dada29d0ed
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['context'] == 'setup') {
		$__finalCompiled .= '
	';
		$__templater->includeJs(array(
			'src' => 'vendor/qrcode/jquery-qrcode.min.js',
		));
		$__finalCompiled .= '
	' . $__templater->formRow('
		' . 'Để nhận mã xác minh qua ứng dụng điện thoại, trước tiên bạn phải cài đặt một ứng dụng tạo mã, chẳng hạn như <a href="https://www.authy.com/users" target="_blank">Authy</a> hoặc <a href="https://support.google.com/accounts/answer/1066447?hl=en" target="_blank">Google Authenticator</a> trên điện thoại của bạn.<br />
			<br />
			Sau khi cài đặt xong, bạn cần phải quét mã QR dưới đây vào ứng dụng và nhập mã được tạo ra bên dưới để xác nhận.' . '
		<div style="text-align: center"><span id="js-totpQrCode" style="display: inline-block; background: white; padding: 12px"></span></div>
		' . 'Ngoài ra, bạn có thể nhập trực tiếp mã bí mật vào ứng dụng: ' . $__templater->escape($__vars['secret']) . '' . '
	', array(
			'label' => 'Thiết lập',
		)) . '
	';
		$__templater->inlineJs('
	jQuery(function($)
	{
		var $el = $(\'#js-totpQrCode\');
		$el.qrcode({
			text: \'' . $__templater->filter($__vars['otpUrl'], array(array('escape', array('js', )),), false) . '\'
		});
	});
	');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	' . $__templater->formInfoRow('Vui lòng nhập mã xác minh được tạo bởi ứng dụng trên điện thoại của bạn.', array(
		)) . '
';
	}
	$__finalCompiled .= '

' . $__templater->formTextBoxRow(array(
		'name' => 'code',
		'type' => 'number',
		'autofocus' => 'autofocus',
	), array(
		'label' => 'Mã xác nhận',
	));
	return $__finalCompiled;
});