<?php
// FROM HASH: 80205a50dec1a0ed4e011788e99726d6
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formTextBoxRow(array(
		'name' => 'options[primary_account]',
		'value' => $__vars['profile']['options']['primary_account'],
		'type' => 'email',
	), array(
		'label' => 'Tài khoản email PayPal chính',
		'hint' => 'Cần thiết',
		'explain' => '
		' . 'Đây là địa chỉ email chính trên tài khoản PayPal của bạn. Nếu không chính xác, thanh toán có thể không được xử lý thành công. Lưu ý đây phải là tài khoản Premier hoặc Business của PayPal và phải bật IPNs. Xin vui lòng xem' . '
	',
	)) . '

' . $__templater->formTextAreaRow(array(
		'name' => 'options[alternate_accounts]',
		'value' => $__vars['profile']['options']['alternate_accounts'],
		'autosize' => 'true',
	), array(
		'label' => 'Tài khoản PayPal thay thế',
		'explain' => 'Nhập địa chỉ email của bất kỳ tài khoản PayPal nào khác với địa chỉ email chính mà có thể nhận khoản thanh toán cho việc nâng cấp thành viên. Điều này có thể hữu ích nếu tài khoản chính bị thay đổi và các khoản thanh toán định kỳ vẫn đến từ tài khoản cũ. Nếu tài khoản cũ không được liệt kê như là một lựa chọn hợp lệ, thanh toán sẽ không được chấp nhận cho tài khoản này. Nhập một tài khoản trên mỗi dòng.',
	)) . '

' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'options[require_address]',
		'selected' => $__vars['profile']['options']['require_address'],
		'label' => 'Require address',
		'hint' => 'If enabled, the payment provider will collect the payee\'s address while taking the payment.',
		'_type' => 'option',
	)), array(
	)) . '

' . $__templater->formHiddenVal('options[legacy]', ($__vars['profile']['options']['legacy'] ? 1 : 0), array(
	));
	return $__finalCompiled;
});