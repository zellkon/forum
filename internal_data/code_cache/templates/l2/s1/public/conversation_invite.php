<?php
// FROM HASH: 0dd7c63f65298b6ea0e1ded9aba58d74
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Mời thành viên tham gia cuộc trò chuyện');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped('Trò chuyện'), $__templater->fn('link', array('conversations', ), false), array(
	));
	$__finalCompiled .= '
';
	$__templater->breadcrumb($__templater->preEscaped($__templater->escape($__vars['conversation']['title'])), $__templater->fn('link', array('conversations', $__vars['conversation'], ), false), array(
	));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['conversation'], 'getRemainingRecipientsCount', array()) > 0) {
		$__compilerTemp1 .= 'Bạn có thể mời ' . $__templater->filter($__templater->method($__vars['conversation'], 'getRemainingRecipientsCount', array()), array(array('number', array()),), true) . ' thành viên(s).';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTokenInputRow(array(
		'name' => 'recipients',
		'href' => $__templater->fn('link', array('members/find', ), false),
	), array(
		'label' => 'Mời thành viên',
		'explain' => '
					' . 'Phân tách các tên bằng dấu (,).' . ' ' . 'Thành viên được mời có thể xem toàn bộ cuộc trò chuyện từ khi bắt đầu.
' . '
					' . $__compilerTemp1 . '
				',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Mời',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('conversations/invite', $__vars['conversation'], ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});