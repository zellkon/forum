<?php
// FROM HASH: 443d286ddd1be5c08020a8a35b8623f6
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Cập nhật chủ đề hàng loạt');
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
			' . $__templater->includeTemplate('helper_thread_search_criteria', $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'search',
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('threads/batch-update/confirm', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});