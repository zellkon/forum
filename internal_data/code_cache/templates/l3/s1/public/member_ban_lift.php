<?php
// FROM HASH: f4ffc4ffe5ca3f3dad495b42db47d55d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Xác nhận bỏ cấm túc' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['user']['username']));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['userBan']['end_date']) {
		$__compilerTemp1 .= '
					' . $__templater->fn('date', array($__vars['userBan']['end_date'], ), true) . '
				';
	} else {
		$__compilerTemp1 .= '
					' . 'Không bao giờ' . '
				';
	}
	$__compilerTemp2 = '';
	if ($__vars['userBan']['user_reason']) {
		$__compilerTemp2 .= '
				' . $__templater->formRow($__templater->escape($__vars['userBan']['user_reason']), array(
			'label' => 'Lý do cấm túc',
		)) . '
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Bạn có chắc chắn là muốn hủy bỏ sự cấm với các thành viên sau' . $__vars['xf']['language']['label_separator'] . '
				<strong><a href="' . $__templater->fn('link', array('members/ban', $__vars['user'], ), true) . '">' . $__templater->escape($__vars['user']['username']) . '</a></strong>
			', array(
		'rowtype' => 'confirm',
	)) . '

			' . $__templater->formRow($__templater->escape($__vars['userBan']['BanUser']['username']), array(
		'label' => 'Bị cấm túc bởi',
	)) . '

			' . $__templater->formRow($__templater->fn('date', array($__vars['userBan']['ban_date'], ), true), array(
		'label' => 'Bắn đầu cấm',
	)) . '

			' . $__templater->formRow('
				' . $__compilerTemp1 . '
			', array(
		'label' => 'Kết thúc cấm',
	)) . '

			' . $__compilerTemp2 . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Bỏ cấm túc',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('members/ban/lift', $__vars['user'], ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});