<?php
// FROM HASH: 942d5489c3d5282569d1545959d97c06
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if (!$__vars['noSpecificUser']) {
		$__finalCompiled .= '
	' . $__templater->formTextBoxRow(array(
			'name' => 'criteria[username]',
			'value' => $__vars['criteria']['username'],
			'readonly' => $__vars['readOnly'],
		), array(
			'label' => 'Tên thành viên',
		)) . '

	' . $__templater->formTextBoxRow(array(
			'name' => 'criteria[email]',
			'value' => $__vars['criteria']['email'],
		), array(
			'label' => 'Email',
		)) . '
';
	}
	$__finalCompiled .= '

<hr class="formRowSep" />

';
	if (!$__vars['readOnly']) {
		$__finalCompiled .= '
	';
		$__compilerTemp1 = array(array(
			'label' => $__vars['xf']['language']['parenthesis_open'] . 'Tất cả' . $__vars['xf']['language']['parenthesis_close'],
			'_type' => 'option',
		));
		if ($__templater->isTraversable($__vars['userGroups'])) {
			foreach ($__vars['userGroups'] AS $__vars['userGroup']) {
				$__compilerTemp1[] = array(
					'value' => $__vars['userGroup']['user_group_id'],
					'label' => $__templater->escape($__vars['userGroup']['title']),
					'_type' => 'option',
				);
			}
		}
		$__finalCompiled .= $__templater->formSelectRow(array(
			'name' => 'criteria[user_group_id]',
			'value' => $__vars['criteria']['user_group_id'],
		), $__compilerTemp1, array(
			'label' => 'Nhóm thành viên chính',
		)) . '
';
	} else {
		$__finalCompiled .= '
	';
		$__compilerTemp2 = '';
		if ($__vars['userGroups'][$__vars['criteria_user_group_id']]['title']) {
			$__compilerTemp2 .= '
			' . $__templater->escape($__vars['userGroups'][$__vars['criteria_user_group_id']]['title']) . '
		';
		} else {
			$__compilerTemp2 .= '
			' . $__vars['xf']['language']['parenthesis_open'] . 'Tất cả' . $__vars['xf']['language']['parenthesis_close'] . '
		';
		}
		$__finalCompiled .= $__templater->formRow('

		' . $__compilerTemp2 . '
	', array(
			'label' => 'Nhóm thành viên chính',
		)) . '
	' . $__templater->formHiddenVal('criteria[user_group_id]', $__vars['criteria']['user_group_id'], array(
		)) . '
';
	}
	$__finalCompiled .= '

';
	$__compilerTemp3 = array();
	if ($__templater->isTraversable($__vars['userGroups'])) {
		foreach ($__vars['userGroups'] AS $__vars['userGroup']) {
			$__compilerTemp3[] = array(
				'value' => $__vars['userGroup']['user_group_id'],
				'label' => $__templater->escape($__vars['userGroup']['title']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formRadioRow(array(
		'name' => 'criteria[no_secondary_group_ids]',
		'value' => $__vars['criteria']['no_secondary_group_ids'],
		'readonly' => $__vars['readOnly'],
	), array(array(
		'value' => '1',
		'label' => 'Thành viên không có nhóm phụ',
		'_type' => 'option',
	),
	array(
		'value' => '0',
		'label' => 'Thành viên của bất kỳ nhóm phụ',
		'_dependent' => array($__templater->formCheckBox(array(
		'name' => 'criteria[secondary_group_ids]',
		'value' => $__vars['criteria']['secondary_group_ids'],
		'listclass' => 'listColumns',
		'readonly' => $__vars['readOnly'],
	), $__compilerTemp3)),
		'_type' => 'option',
	)), array(
		'label' => 'Nhóm thành viên phụ',
	)) . '

';
	$__compilerTemp4 = array();
	if ($__templater->isTraversable($__vars['userGroups'])) {
		foreach ($__vars['userGroups'] AS $__vars['userGroup']) {
			$__compilerTemp4[] = array(
				'value' => $__vars['userGroup']['user_group_id'],
				'label' => $__templater->escape($__vars['userGroup']['title']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
		'name' => 'criteria[not_secondary_group_ids]',
		'value' => $__vars['criteria']['not_secondary_group_ids'],
		'listclass' => 'listColumns',
		'readonly' => $__vars['readOnly'],
	), $__compilerTemp4, array(
		'label' => 'Không ở các nhóm phụ',
	)) . '

<hr class="formRowSep" />

' . $__templater->formRow('

	<div class="inputGroup">
		' . $__templater->formDateInput(array(
		'name' => 'criteria[register_date][start]',
		'value' => $__vars['criteria']['register_date']['start'],
		'size' => '15',
		'readonly' => $__vars['readOnly'],
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formDateInput(array(
		'name' => 'criteria[register_date][end]',
		'value' => $__vars['criteria']['register_date']['end'],
		'size' => '15',
		'readonly' => $__vars['readOnly'],
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Ngày đăng ký',
	)) . '

' . $__templater->formRow('

	<div class="inputGroup">
		' . $__templater->formDateInput(array(
		'name' => 'criteria[last_activity][start]',
		'value' => $__vars['criteria']['last_activity']['start'],
		'size' => '15',
		'readonly' => $__vars['readOnly'],
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formDateInput(array(
		'name' => 'criteria[last_activity][end]',
		'value' => $__vars['criteria']['last_activity']['end'],
		'size' => '15',
		'readonly' => $__vars['readOnly'],
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Lần truy cập cuối cùng',
		'explain' => 'Lượt truy cập trong giờ cuối cùng có thể không được xem xét.',
	)) . '

' . $__templater->formRow('

	<div class="inputGroup">
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[message_count][start]',
		'value' => $__vars['criteria']['message_count']['start'],
		'min' => '0',
		'readonly' => $__vars['readOnly'],
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[message_count][end]',
		'value' => $__vars['criteria']['message_count']['end'],
		'min' => '-1',
		'readonly' => $__vars['readOnly'],
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Số bài viết',
		'explain' => 'Sử dụng -1 để chỉ định không có tối đa.',
	)) . '

' . $__templater->formRow('

	<div class="inputGroup">
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[trophy_points][start]',
		'value' => $__vars['criteria']['trophy_points']['start'],
		'min' => '0',
		'readonly' => $__vars['readOnly'],
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[trophy_points][end]',
		'value' => $__vars['criteria']['trophy_points']['end'],
		'min' => '-1',
		'readonly' => $__vars['readOnly'],
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Trophy points between',
		'explain' => 'Sử dụng -1 để chỉ định không có tối đa.',
	)) . '

<hr class="formRowSep" />

' . $__templater->formCheckBoxRow(array(
		'name' => 'criteria[user_state]',
		'readonly' => $__vars['readOnly'],
	), array(array(
		'value' => 'valid',
		'selected' => $__templater->fn('in_array', array('valid', $__vars['criteria']['user_state'], ), false),
		'label' => 'Valid',
		'_type' => 'option',
	),
	array(
		'value' => 'email_confirm',
		'selected' => $__templater->fn('in_array', array('email_confirm', $__vars['criteria']['user_state'], ), false),
		'label' => 'Đang chờ xác nhận email',
		'_type' => 'option',
	),
	array(
		'value' => 'email_confirm_edit',
		'selected' => $__templater->fn('in_array', array('email_confirm_edit', $__vars['criteria']['user_state'], ), false),
		'label' => 'Awaiting email confirmation (from edit)',
		'_type' => 'option',
	),
	array(
		'value' => 'email_bounce',
		'selected' => $__templater->fn('in_array', array('email_bounce', $__vars['criteria']['user_state'], ), false),
		'label' => 'Email invalid (bounced)',
		'_type' => 'option',
	),
	array(
		'value' => 'moderated',
		'selected' => $__templater->fn('in_array', array('moderated', $__vars['criteria']['user_state'], ), false),
		'label' => 'Chờ kiểm duyệt',
		'_type' => 'option',
	),
	array(
		'value' => 'rejected',
		'selected' => $__templater->fn('in_array', array('rejected', $__vars['criteria']['user_state'], ), false),
		'label' => 'Đã từ chối',
		'_type' => 'option',
	),
	array(
		'value' => 'disabled',
		'selected' => $__templater->fn('in_array', array('disabled', $__vars['criteria']['user_state'], ), false),
		'label' => 'Tắt',
		'_type' => 'option',
	)), array(
		'label' => 'Trạng thái thành viên',
	)) . '

' . $__templater->formCheckBoxRow(array(
		'name' => 'criteria[is_banned]',
		'readonly' => $__vars['readOnly'],
	), array(array(
		'value' => '0',
		'selected' => $__templater->fn('in_array', array(0, $__vars['criteria']['is_banned'], ), false),
		'label' => 'Không bị cấm',
		'_type' => 'option',
	),
	array(
		'value' => '1',
		'selected' => $__templater->fn('in_array', array(1, $__vars['criteria']['is_banned'], ), false),
		'label' => 'Đã bị cấm túc',
		'_type' => 'option',
	)), array(
		'label' => 'Trạng thái cấm túc',
	)) . '

' . $__templater->formCheckBoxRow(array(
		'name' => 'criteria[Option][is_discouraged]',
		'readonly' => $__vars['readOnly'],
	), array(array(
		'value' => '0',
		'selected' => $__templater->fn('in_array', array(0, $__vars['criteria']['Option']['is_discouraged'], ), false),
		'label' => 'Not Discouraged',
		'_type' => 'option',
	),
	array(
		'value' => '1',
		'selected' => $__templater->fn('in_array', array(1, $__vars['criteria']['Option']['is_discouraged'], ), false),
		'label' => 'Discouraged',
		'_type' => 'option',
	)), array(
		'label' => 'Discouragement State',
	)) . '

' . $__templater->formCheckBoxRow(array(
		'name' => 'criteria[is_staff]',
		'readonly' => $__vars['readOnly'],
	), array(array(
		'value' => '0',
		'selected' => $__templater->fn('in_array', array(0, $__vars['criteria']['is_staff'], ), false),
		'label' => 'Không phải là Thành viên BQT',
		'_type' => 'option',
	),
	array(
		'value' => '1',
		'selected' => $__templater->fn('in_array', array(1, $__vars['criteria']['is_staff'], ), false),
		'label' => 'Thành viên BQT',
		'_type' => 'option',
	)), array(
		'label' => 'Trạng thái BQT',
	)) . '

';
	$__compilerTemp5 = '';
	$__compilerTemp5 .= '
		';
	$__compilerTemp6 = $__templater->method($__templater->method($__vars['xf']['app']['em'], 'getRepository', array('XF:UserField', )), 'getDisplayGroups', array());
	if ($__templater->isTraversable($__compilerTemp6)) {
		foreach ($__compilerTemp6 AS $__vars['fieldGroup'] => $__vars['phrase']) {
			$__compilerTemp5 .= '
			';
			$__vars['customFields'] = $__templater->method($__vars['xf']['app'], 'getCustomFields', array('users', $__vars['fieldGroup'], ));
			$__compilerTemp5 .= '
			';
			$__compilerTemp7 = '';
			$__compilerTemp7 .= '
					';
			if ($__templater->isTraversable($__vars['customFields'])) {
				foreach ($__vars['customFields'] AS $__vars['fieldId'] => $__vars['fieldDefinition']) {
					$__compilerTemp7 .= '
						';
					$__vars['choices'] = $__vars['fieldDefinition']['field_choices'];
					$__compilerTemp7 .= '
						';
					$__vars['fieldName'] = 'criteria[user_field]' . (($__vars['choices'] AND ($__vars['fieldDefinition']['type_group'] != 'multiple')) ? '[exact]' : '') . '[' . $__vars['fieldId'] . ']';
					$__compilerTemp7 .= '
						';
					$__compilerTemp8 = '';
					if (!$__vars['choices']) {
						$__compilerTemp8 .= '
								' . $__templater->formTextBox(array(
							'name' => $__vars['fieldName'],
							'value' => $__vars['criteria']['user_field'][$__vars['fieldId']],
							'readonly' => $__vars['readOnly'],
						)) . '
							';
					} else {
						$__compilerTemp8 .= '
								';
						$__compilerTemp9 = array();
						if ($__templater->isTraversable($__vars['choices'])) {
							foreach ($__vars['choices'] AS $__vars['val'] => $__vars['choice']) {
								$__compilerTemp9[] = array(
									'value' => (($__vars['fieldDefinition']['type_group'] == 'multiple') ? (((('s:' . $__templater->fn('strlen', array($__vars['val'], ), false)) . ':"') . $__vars['val']) . '"') : $__vars['val']),
									'label' => $__templater->escape($__vars['choice']),
									'_type' => 'option',
								);
							}
						}
						$__compilerTemp8 .= $__templater->formCheckBox(array(
							'name' => $__vars['fieldName'],
							'value' => $__vars['criteria']['user_field']['exact'][$__vars['fieldId']],
							'listclass' => 'listColumns',
							'readonly' => $__vars['readOnly'],
						), $__compilerTemp9) . '
							';
					}
					$__compilerTemp7 .= $__templater->formRow('

							' . $__compilerTemp8 . '

						', array(
						'rowtype' => ($__vars['choices'] ? '' : 'input'),
						'label' => $__templater->escape($__vars['fieldDefinition']['title']),
					)) . '
					';
				}
			}
			$__compilerTemp7 .= '
				';
			if (strlen(trim($__compilerTemp7)) > 0) {
				$__compilerTemp5 .= '
				' . $__compilerTemp7 . '
			';
			}
			$__compilerTemp5 .= '
		';
		}
	}
	$__compilerTemp5 .= '
	';
	if (strlen(trim($__compilerTemp5)) > 0) {
		$__finalCompiled .= '
	<hr class="formRowSep" />
	' . $__compilerTemp5 . '
';
	}
	return $__finalCompiled;
});