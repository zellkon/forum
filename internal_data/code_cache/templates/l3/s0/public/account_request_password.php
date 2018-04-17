<?php
// FROM HASH: b4053615a564df33a527fcc72f9a80bb
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Khôi phục mật khẩu');
	$__finalCompiled .= '

' . $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Tài khoản của bạn hiện không có mật khẩu. Bạn có chắc chắn muốn tạo một mật khẩu mới? Nó sẽ được gửi qua email tới ' . $__templater->escape($__vars['xf']['visitor']['email']) . '.' . '
			', array(
		'rowtype' => 'confirm',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'submit' => 'Khôi phục mật khẩu',
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>

', array(
		'action' => $__templater->fn('link', array('account/request-password', ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});