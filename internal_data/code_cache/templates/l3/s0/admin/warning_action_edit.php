<?php
// FROM HASH: b57cba9c4677fbe0a7e8450a59981939
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['action'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm hành động cảnh báo');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa hành động cảnh báo' . $__vars['xf']['language']['label_separator'] . ' ' . 'Điểm' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['action']['points']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['action'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('warnings/actions/delete', $__vars['action'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

';
	$__compilerTemp1 = $__templater->mergeChoiceOptions(array(), $__vars['userGroups']);
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formNumberBoxRow(array(
		'name' => 'points',
		'value' => $__vars['action']['points'],
		'min' => '1',
	), array(
		'label' => 'Ngưỡng điểm',
		'explain' => 'Tác vụ cảnh báo này sẽ chỉ được áp dụng khi thành viên vượt qua ngưỡng điểm. Do đó, thành viên có nhiều điểm này trở lên sẽ không áp dụng hành động này cho đến khi tổng điểm cảnh báo của họ giảm xuống dưới ngưỡng này và sau đó lại vượt qua.',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'action',
		'value' => $__vars['action']['action'],
	), array(array(
		'value' => 'ban',
		'label' => 'Cấm',
		'_type' => 'option',
	),
	array(
		'value' => 'discourage',
		'label' => 'Discourage',
		'_type' => 'option',
	),
	array(
		'value' => 'groups',
		'label' => 'Thêm vào các nhóm được chọn',
		'_dependent' => array($__templater->formCheckBox(array(
		'name' => 'extra_user_group_ids',
		'value' => $__vars['action']['extra_user_group_ids'],
	), $__compilerTemp1)),
		'_type' => 'option',
	)), array(
		'label' => 'Hành động để áp dụng',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'action_length_type_base',
		'value' => $__vars['action']['action_length_type'],
	), array(array(
		'value' => 'points',
		'label' => 'Trong khi bằng hoặc ở trên ngưỡng điểm',
		'_type' => 'option',
	),
	array(
		'value' => 'permanent',
		'label' => 'Vĩnh viễn',
		'_type' => 'option',
	),
	array(
		'value' => 'temporary',
		'selected' => ($__vars['action']['action_length_type'] != 'permanent') AND ($__vars['action']['action_length_type'] != 'points'),
		'label' => 'Tạm thời',
		'_dependent' => array('
						<div class="inputGroup">
							' . $__templater->formNumberBox(array(
		'name' => 'action_length',
		'value' => ($__vars['action']['action_length'] ?: 1),
		'min' => '1',
	)) . '
							<span class="inputGroup-splitter"></span>
							' . $__templater->formSelect(array(
		'name' => 'action_length_type',
		'value' => ((($__vars['action']['action_length_type'] == 'permanent') OR ($__vars['action']['action_length_type'] == 'points')) ? 'months' : $__vars['action']['action_length_type']),
		'class' => 'input--inline',
	), array(array(
		'value' => 'days',
		'label' => 'Ngày',
		'_type' => 'option',
	),
	array(
		'value' => 'weeks',
		'label' => 'Tuần',
		'_type' => 'option',
	),
	array(
		'value' => 'months',
		'label' => 'Tháng',
		'_type' => 'option',
	),
	array(
		'value' => 'years',
		'label' => 'Năm',
		'_type' => 'option',
	))) . '
						</div>
					'),
		'_type' => 'option',
	)), array(
		'label' => 'Đối với khoảng thời gian',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('warnings/actions/save', $__vars['action'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});