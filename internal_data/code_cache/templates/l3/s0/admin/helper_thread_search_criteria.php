<?php
// FROM HASH: 7c9bf0f19ee85403a51fa10ef39a10c5
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<hr class="formRowSep" />

' . $__templater->formTextBoxRow(array(
		'name' => 'criteria[title]',
		'value' => $__vars['criteria']['title'],
		'type' => 'search',
	), array(
		'label' => 'Tiêu đề',
	)) . '

' . $__templater->callMacro('public:prefix_macros', 'row', array(
		'includeAny' => true,
		'prefixes' => $__vars['prefixes']['prefixesGrouped'],
		'selected' => $__vars['criteria']['prefix_id'],
		'name' => 'criteria[prefix_id]',
		'type' => 'thread',
		'multiple' => true,
	), $__vars) . '

';
	$__compilerTemp1 = array(array(
		'value' => '0',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'Tất cả' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['forums'])) {
		foreach ($__vars['forums'] AS $__vars['forum']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['forum']['value'],
				'disabled' => $__vars['forum']['disabled'],
				'label' => $__templater->escape($__vars['forum']['label']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'criteria[node_id]',
		'value' => $__vars['criteria']['node_id'],
		'multiple' => 'true',
	), $__compilerTemp1, array(
		'label' => 'Diễn đàn',
	)) . '

' . $__templater->formTextBoxRow(array(
		'name' => 'criteria[username]',
		'value' => $__vars['criteria']['username'],
		'type' => 'search',
	), array(
		'label' => 'Tạo bởi',
	)) . '

<hr class="formRowSep" />

' . $__templater->formRow('
	<div class="inputGroup">
		' . $__templater->formDateInput(array(
		'name' => 'criteria[post_date][start]',
		'value' => $__vars['criteria']['post_date']['start'],
		'size' => '15',
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formDateInput(array(
		'name' => 'criteria[post_date][end]',
		'value' => $__vars['criteria']['post_date']['end'],
		'size' => '15',
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Ngày tạo',
	)) . '

' . $__templater->formRow('
	<div class="inputGroup">
		' . $__templater->formDateInput(array(
		'name' => 'criteria[last_post_date][start]',
		'value' => $__vars['criteria']['last_post_date']['start'],
		'size' => '15',
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formDateInput(array(
		'name' => 'criteria[last_post_date][end]',
		'value' => $__vars['criteria']['last_post_date']['end'],
		'size' => '15',
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Bình luận cuối',
	)) . '

' . $__templater->formRow('
	<div class="inputGroup">
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[reply_count][start]',
		'value' => $__vars['criteria']['reply_count']['start'],
		'size' => '5',
		'min' => '0',
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[reply_count][end]',
		'value' => $__vars['criteria']['reply_count']['end'],
		'size' => '5',
		'min' => '-1',
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Số lượng bình luận',
		'explain' => 'Sử dụng -1 để chỉ định không có tối đa.',
	)) . '

' . $__templater->formRow('
	<div class="inputGroup">
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[first_post_likes][start]',
		'value' => $__vars['criteria']['first_post_likes']['start'],
		'size' => '5',
		'min' => '0',
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[first_post_likes][end]',
		'value' => $__vars['criteria']['first_post_likes']['end'],
		'size' => '5',
		'min' => '-1',
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Lợt thích bài đầu tiên',
		'explain' => 'Sử dụng -1 để chỉ định không có tối đa.',
	)) . '

' . $__templater->formRow('
	<div class="inputGroup">
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[view_count][start]',
		'value' => $__vars['criteria']['view_count']['start'],
		'size' => '5',
		'min' => '0',
	)) . '
		<span class="inputGroup-text">-</span>
		' . $__templater->formNumberBox(array(
		'name' => 'criteria[view_count][end]',
		'value' => $__vars['criteria']['view_count']['end'],
		'size' => '5',
		'min' => '-1',
	)) . '
	</div>
', array(
		'rowtype' => 'input',
		'label' => 'Lượt xem',
		'explain' => 'Sử dụng -1 để chỉ định không có tối đa.',
	)) . '

<hr class="formRowSep" />

' . $__templater->formCheckBoxRow(array(
		'name' => 'criteria[discussion_state]',
	), array(array(
		'value' => 'visible',
		'selected' => $__templater->fn('in_array', array('visible', $__vars['criteria']['discussion_state'], ), false),
		'label' => 'Hiển thị',
		'_type' => 'option',
	),
	array(
		'value' => 'deleted',
		'selected' => $__templater->fn('in_array', array('deleted', $__vars['criteria']['discussion_state'], ), false),
		'label' => 'Bị xóa',
		'_type' => 'option',
	),
	array(
		'value' => 'moderated',
		'selected' => $__templater->fn('in_array', array('moderated', $__vars['criteria']['discussion_state'], ), false),
		'label' => 'Cần kiểm duyệt',
		'_type' => 'option',
	)), array(
		'label' => 'Tình trạng',
	)) . '

' . $__templater->formCheckBoxRow(array(
		'name' => 'criteria[discussion_open]',
	), array(array(
		'value' => '1',
		'selected' => $__templater->fn('in_array', array(1, $__vars['criteria']['discussion_open'], ), false),
		'label' => 'Mở khóa',
		'_type' => 'option',
	),
	array(
		'value' => '0',
		'selected' => $__templater->fn('in_array', array(0, $__vars['criteria']['discussion_open'], ), false),
		'label' => 'Đã khóa',
		'_type' => 'option',
	)), array(
		'label' => 'Đã khóa',
	)) . '

' . $__templater->formCheckBoxRow(array(
		'name' => 'criteria[sticky]',
	), array(array(
		'value' => '0',
		'selected' => $__templater->fn('in_array', array(0, $__vars['criteria']['sticky'], ), false),
		'label' => 'Không ghim',
		'_type' => 'option',
	),
	array(
		'value' => '1',
		'selected' => $__templater->fn('in_array', array(1, $__vars['criteria']['sticky'], ), false),
		'label' => 'Ghim lại',
		'_type' => 'option',
	)), array(
		'label' => 'Ghim lại',
	)) . '

';
	$__compilerTemp2 = '';
	$__compilerTemp2 .= '
		';
	$__compilerTemp3 = $__templater->method($__templater->method($__vars['xf']['app']['em'], 'getRepository', array('XF:ThreadField', )), 'getDisplayGroups', array());
	if ($__templater->isTraversable($__compilerTemp3)) {
		foreach ($__compilerTemp3 AS $__vars['fieldGroup'] => $__vars['phrase']) {
			$__compilerTemp2 .= '
			';
			$__vars['customFields'] = $__templater->method($__vars['xf']['app'], 'getCustomFields', array('threads', $__vars['fieldGroup'], ));
			$__compilerTemp2 .= '
			';
			$__compilerTemp4 = '';
			$__compilerTemp4 .= '
					';
			if ($__templater->isTraversable($__vars['customFields'])) {
				foreach ($__vars['customFields'] AS $__vars['fieldId'] => $__vars['fieldDefinition']) {
					$__compilerTemp4 .= '
						';
					$__vars['choices'] = $__vars['fieldDefinition']['field_choices'];
					$__compilerTemp4 .= '
						';
					$__vars['fieldName'] = 'criteria[thread_field]' . (($__vars['choices'] AND ($__vars['fieldDefinition']['type_group'] != 'multiple')) ? '[exact]' : '') . '[' . $__vars['fieldId'] . ']';
					$__compilerTemp4 .= '
						';
					$__compilerTemp5 = '';
					if (!$__vars['choices']) {
						$__compilerTemp5 .= '
								' . $__templater->formTextBox(array(
							'name' => $__vars['fieldName'],
							'value' => $__vars['criteria'][$__vars['fieldName']]['text'],
						)) . '
							';
					} else {
						$__compilerTemp5 .= '
								';
						$__compilerTemp6 = array();
						if ($__templater->isTraversable($__vars['choices'])) {
							foreach ($__vars['choices'] AS $__vars['val'] => $__vars['choice']) {
								$__compilerTemp6[] = array(
									'value' => (($__vars['fieldDefinition']['type_group'] == 'multiple') ? (((('s:' . $__templater->fn('strlen', array($__vars['val'], ), false)) . ':"') . $__vars['val']) . '"') : $__vars['val']),
									'label' => $__templater->escape($__vars['choice']),
									'_type' => 'option',
								);
							}
						}
						$__compilerTemp5 .= $__templater->formCheckBox(array(
							'name' => $__vars['fieldName'],
							'value' => $__vars['criteria']['custom'][$__vars['fieldId']],
							'listclass' => 'listColumns',
						), $__compilerTemp6) . '
							';
					}
					$__compilerTemp4 .= $__templater->formRow('
							' . $__compilerTemp5 . '
						', array(
						'rowtype' => 'input',
						'label' => $__templater->escape($__vars['fieldDefinition']['title']),
					)) . '
					';
				}
			}
			$__compilerTemp4 .= '
				';
			if (strlen(trim($__compilerTemp4)) > 0) {
				$__compilerTemp2 .= '
				' . $__compilerTemp4 . '
			';
			}
			$__compilerTemp2 .= '
		';
		}
	}
	$__compilerTemp2 .= '
	';
	if (strlen(trim($__compilerTemp2)) > 0) {
		$__finalCompiled .= '
	<hr class="formRowSep" />
	' . $__compilerTemp2 . '
';
	}
	return $__finalCompiled;
});