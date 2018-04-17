<?php
// FROM HASH: 16ecf247420cc1304c76c54d3af6906d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['userBan'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Cấm thành viên');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa thành viên bị cấm' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['userBan']['User']['username']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['userBan'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Bỏ cấm túc', array(
			'href' => $__templater->fn('link', array('banning/users/lift', $__vars['userBan'], ), false),
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if (!$__vars['userBan']['user_id']) {
		$__compilerTemp1 .= '
				' . $__templater->formTextBoxRow(array(
			'name' => 'username',
			'ac' => 'single',
			'value' => $__vars['addName'],
		), array(
			'label' => 'Tên thành viên',
		)) . '
			';
	} else {
		$__compilerTemp1 .= '
				' . $__templater->formRow($__templater->escape($__vars['userBan']['User']['username']), array(
			'label' => 'Tên thành viên',
		)) . '

				' . $__templater->formRow($__templater->escape($__vars['userBan']['BanUser']['username']), array(
			'label' => 'Bị cấm túc bởi',
		)) . '

				' . $__templater->formRow($__templater->fn('date', array($__vars['userBan']['ban_date'], ), true), array(
			'label' => 'Bắn đầu cấm',
		)) . '

				';
		$__compilerTemp2 = '';
		if ($__vars['userBan']['end_date']) {
			$__compilerTemp2 .= '
						' . $__templater->fn('date', array($__vars['userBan']['end_date'], ), true) . '
					';
		} else {
			$__compilerTemp2 .= '
						' . 'Không bao giờ' . '
					';
		}
		$__compilerTemp1 .= $__templater->formRow('
					' . $__compilerTemp2 . '
				', array(
			'label' => 'Kết thúc cấm',
		)) . '
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__compilerTemp1 . '

			' . $__templater->formRadioRow(array(
		'name' => 'ban_length',
		'value' => ((!$__vars['userBan']['end_date']) ? 'permanent' : 'temporary'),
	), array(array(
		'label' => 'Vĩnh viễn',
		'value' => 'permanent',
		'_type' => 'option',
	),
	array(
		'label' => 'Đến ngày' . $__vars['xf']['language']['label_separator'],
		'value' => 'temporary',
		'_dependent' => array($__templater->formDateInput(array(
		'name' => 'end_date',
		'value' => ($__vars['userBan']['end_date'] ? $__templater->fn('date', array($__vars['userBan']['end_date'], 'Y-m-d', ), false) : ''),
	))),
		'_type' => 'option',
	)), array(
		'label' => 'Thời hạn cấm túc',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'user_reason',
		'value' => $__vars['userBan']['user_reason'],
		'maxlength' => $__templater->fn('max_length', array($__vars['userBan'], 'user_reason', ), false),
	), array(
		'label' => 'Lý do cấm túc',
		'explain' => 'Sẽ được hiển thị cho thành viên nếu được cung cấp.',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('banning/users/save', $__vars['userBan'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});