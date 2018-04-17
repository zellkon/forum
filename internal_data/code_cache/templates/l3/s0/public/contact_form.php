<?php
// FROM HASH: c8415f33699f3abf769344d4014860ad
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Liên hệ');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if (!$__vars['xf']['visitor']['user_id']) {
		$__compilerTemp1 .= '
				' . $__templater->formTextBoxRow(array(
			'name' => 'username',
			'autofocus' => 'autofocus',
			'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'username', ), false),
		), array(
			'label' => 'Tên bạn',
		)) . '

				' . $__templater->formTextBoxRow(array(
			'name' => 'email',
			'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'email', ), false),
			'type' => 'email',
		), array(
			'label' => 'Địa chỉ email của bạn',
		)) . '
			';
	} else {
		$__compilerTemp1 .= '
				' . $__templater->formRow($__templater->escape($__vars['xf']['visitor']['username']), array(
			'label' => 'Tên bạn',
		)) . '
				';
		if ($__vars['xf']['visitor']['email']) {
			$__compilerTemp1 .= '

					' . $__templater->formRow($__templater->escape($__vars['xf']['visitor']['email']), array(
				'label' => 'Địa chỉ email của bạn',
			)) . '

				';
		} else {
			$__compilerTemp1 .= '

					' . $__templater->formTextBoxRow(array(
				'name' => 'email',
				'type' => 'email',
			), array(
				'label' => 'Địa chỉ email của bạn',
			)) . '

				';
		}
		$__compilerTemp1 .= '
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__compilerTemp1 . '

			' . $__templater->formRowIfContent($__templater->fn('captcha', array(false)), array(
		'label' => 'Mã xác nhận',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'subject',
	), array(
		'label' => 'Tiêu đề',
	)) . '

			' . $__templater->formTextAreaRow(array(
		'name' => 'message',
		'rows' => '5',
		'autosize' => 'true',
	), array(
		'label' => 'Nội dung',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Send',
	), array(
	)) . '
	</div>
	' . $__templater->fn('redirect_input', array(null, null, true)) . '
', array(
		'action' => $__templater->fn('link', array('misc/contact', ), false),
		'class' => 'block',
		'ajax' => 'true',
		'data-force-flash-message' => 'true',
	));
	return $__finalCompiled;
});