<?php
// FROM HASH: 43e6cfccc8d207ff97c6c5031feee8dd
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Quản trị phản hổi về cấm túc' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->fn('prefix', array('thread', $__vars['thread'], 'escaped', ), true) . $__templater->escape($__vars['thread']['title']));
	$__finalCompiled .= '
';
	$__templater->pageParams['pageH1'] = $__templater->preEscaped('Quản trị phản hổi về cấm túc' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->fn('prefix', array('thread', $__vars['thread'], ), true) . $__templater->escape($__vars['thread']['title']));
	$__finalCompiled .= '

';
	$__templater->breadcrumbs($__templater->method($__vars['thread'], 'getBreadcrumbs', array()));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if (!$__templater->test($__vars['bans'], 'empty', array())) {
		$__compilerTemp1 .= '
				';
		$__compilerTemp2 = '';
		if ($__templater->isTraversable($__vars['bans'])) {
			foreach ($__vars['bans'] AS $__vars['ban']) {
				$__compilerTemp2 .= '
						';
				$__compilerTemp3 = '';
				if ($__vars['ban']['reason']) {
					$__compilerTemp3 .= '
									' . $__templater->escape($__vars['ban']['reason']) . '
								';
				} else {
					$__compilerTemp3 .= '
									' . 'N/A' . '
								';
				}
				$__compilerTemp4 = '';
				if ($__vars['ban']['expiry_date']) {
					$__compilerTemp4 .= '
									' . $__templater->fn('date_dynamic', array($__vars['ban']['expiry_date'], array(
					))) . '
								';
				} else {
					$__compilerTemp4 .= '
									' . 'Vĩnh viễn' . '
								';
				}
				$__compilerTemp2 .= $__templater->dataRow(array(
					'rowclass' => 'dataList-row--noHover',
				), array(array(
					'_type' => 'cell',
					'html' => $__templater->fn('username_link', array($__vars['ban']['User'], false, array(
				))),
				),
				array(
					'_type' => 'cell',
					'html' => '
								' . $__compilerTemp3 . '
							',
				),
				array(
					'_type' => 'cell',
					'html' => '
								' . $__compilerTemp4 . '
							',
				),
				array(
					'name' => 'delete[' . $__vars['ban']['user_id'] . ']',
					'class' => 'dataList-cell--separated dataList-cell--alt',
					'_type' => 'toggle',
					'html' => '',
				))) . '
					';
			}
		}
		$__compilerTemp1 .= $__templater->dataList('
					' . $__templater->dataRow(array(
			'rowtype' => 'header',
		), array(array(
			'_type' => 'cell',
			'html' => 'Thành viên',
		),
		array(
			'_type' => 'cell',
			'html' => 'Lý do',
		),
		array(
			'_type' => 'cell',
			'html' => 'End Date',
		),
		array(
			'class' => 'dataList-cell--min',
			'_type' => 'cell',
			'html' => 'Xóa',
		))) . '
					' . $__compilerTemp2 . '
				', array(
			'data-xf-init' => 'responsive-data-list',
		)) . '
			</div>
			<h2 class="block-formSectionHeader">' . 'New Reply Ban' . '</h2>
			<div class="block-body">
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__compilerTemp1 . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'username',
		'ac' => 'single',
		'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'username', ), false),
	), array(
		'label' => 'Tên thành viên',
		'explain' => 'Thành viên này vẫn có thể xem nội dung chủ để, nhưng không thể trả lời cho đến khi hết hạn cấm túc.',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'ban_length',
	), array(array(
		'value' => 'permanent',
		'label' => 'Vĩnh viễn',
		'_type' => 'option',
	),
	array(
		'value' => 'temporary',
		'selected' => true,
		'label' => 'Tạm thời' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array('
						<div class="inputGroup inputGroup--auto">
							' . $__templater->formTextBox(array(
		'name' => 'ban_length_value',
		'value' => '7',
	)) . '
							<span class="inputGroup-splitter"></span>
							' . $__templater->formSelect(array(
		'name' => 'ban_length_unit',
	), array(array(
		'value' => 'hours',
		'label' => 'Giờ',
		'_type' => 'option',
	),
	array(
		'value' => 'days',
		'selected' => true,
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
	))) . '
						</div>
					'),
		'_type' => 'option',
	)), array(
		'label' => 'Thời hạn cấm túc',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'reason',
		'maxlength' => $__templater->fn('max_length', array('XF:ThreadReplyBan', 'reason', ), false),
	), array(
		'label' => 'Lý do',
		'explain' => 'Sẽ được hiển thị cho thành viên nếu bạn chọn để thông báo đến họ.',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'send_alert',
		'label' => 'Thông báo đến thành viên hành động này.',
		'_type' => 'option',
	)), array(
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('threads/reply-bans', $__vars['thread'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});