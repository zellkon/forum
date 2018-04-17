<?php
// FROM HASH: 9662a76dcc406b717b7a68d0e9b97881
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Cập nhật thành viên hàng loạt');
	$__finalCompiled .= '

';
	if ($__vars['success']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--success blockMessage--iconic">' . 'Bản cập nhật hàng loạt đã được hoàn thành.' . '</div>
';
	}
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->includeTemplate('helper_user_search_criteria', $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Tiến hành' . $__vars['xf']['language']['ellipsis'],
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('users/batch-update/confirm', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});