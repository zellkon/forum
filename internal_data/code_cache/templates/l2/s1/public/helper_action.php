<?php
// FROM HASH: 14ed92df14b43da25d62aaa5c6fb51ed
return array('macros' => array('edit_type' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'canEditSilently' => false,
		'silentName' => 'silent',
		'clearEditName' => 'clear_edit',
		'silentEdit' => false,
		'clearEdit' => false,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__vars['canEditSilently']) {
		$__finalCompiled .= '
		' . $__templater->formCheckBox(array(
		), array(array(
			'name' => $__vars['silentName'],
			'checked' => $__vars['silentEdit'],
			'label' => 'Chỉnh sửa thầm lặng',
			'hint' => 'Nếu được chọn, không có lưu ý "chỉnh sửa cuối" được thêm vào cho chỉnh sửa này.',
			'_dependent' => array($__templater->formCheckBox(array(
		), array(array(
			'name' => $__vars['clearEditName'],
			'checked' => $__vars['clearEdit'],
			'label' => 'Dọn dẹp các thông tin sửa mới nhất',
			'hint' => 'Nếu được chọn, bất kỳ "chỉnh sửa cuối" hiện tại sẽ được gỡ bỏ.',
			'_type' => 'option',
		)))),
			'_type' => 'option',
		))) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'delete_type' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'canHardDelete' => false,
		'typeName' => 'hard_delete',
		'reasonName' => 'reason',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__vars['canHardDelete']) {
		$__finalCompiled .= '
		' . $__templater->formRadioRow(array(
			'name' => $__vars['typeName'],
			'value' => '0',
		), array(array(
			'value' => '0',
			'label' => 'Không hiển thị công cộng',
			'_dependent' => array($__templater->formTextBox(array(
			'name' => $__vars['reasonName'],
			'placeholder' => 'Lý do' . $__vars['xf']['language']['ellipsis'],
			'maxlength' => $__templater->fn('max_length', array('XF:DeletionLog', 'delete_reason', ), false),
		))),
			'_type' => 'option',
		),
		array(
			'value' => '1',
			'label' => 'Xóa vĩnh viễn',
			'hint' => 'Tùy chọn này sẽ xóa vĩnh viễn bài viết này. (Không thể khôi phục được)',
			'_type' => 'option',
		)), array(
			'label' => 'Kiểu xóa',
		)) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->formTextBoxRow(array(
			'name' => $__vars['reasonName'],
			'maxlength' => $__templater->fn('max_length', array('XF:DeletionLog', 'delete_reason', ), false),
		), array(
			'label' => 'Lý do xóa bỏ',
		)) . '

		' . $__templater->formHiddenVal($__vars['typeName'], '0', array(
		)) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'author_alert' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'selected' => false,
		'alertName' => 'author_alert',
		'reasonName' => 'author_alert_reason',
		'row' => true,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__vars['checkbox'] = $__templater->preEscaped('
		' . $__templater->formCheckBox(array(
	), array(array(
		'name' => $__vars['alertName'],
		'selected' => $__vars['selected'],
		'label' => 'Thông báo đến tác giả hành động này.' . ' ' . 'Lý do' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => $__vars['reasonName'],
		'placeholder' => 'Tùy chọn (không bắt buộc)',
	))),
		'afterhint' => 'Lưu ý rằng tác giả sẽ thấy cảnh báo này ngay cả khi họ không còn có thể xem nội dung của họ.',
		'_type' => 'option',
	))) . '
	');
	$__finalCompiled .= '
	';
	if ($__vars['row']) {
		$__finalCompiled .= '
		' . $__templater->formRow('
			' . $__templater->filter($__vars['checkbox'], array(array('raw', array()),), true) . '
		', array(
		)) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['checkbox'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'thread_alert' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'selected' => false,
		'alertName' => 'starter_alert',
		'reasonName' => 'starter_alert_reason',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => $__vars['alertName'],
		'selected' => $__vars['selected'],
		'label' => 'Thông báo đến người khởi tạo chủ đề hành động này.
' . ' ' . 'Lý do' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => $__vars['reasonName'],
		'placeholder' => 'Tùy chọn (không bắt buộc)',
	))),
		'afterhint' => 'Lưu ý rằng người tạo chủ đề sẽ nhìn thấy cảnh báo ngay cả khi họ không còn xem được chủ đề của họ.',
		'_type' => 'option',
	)), array(
	)) . '
';
	return $__finalCompiled;
},
'thread_redirect' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'label' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formRadioRow(array(
		'name' => 'redirect_type',
		'value' => 'none',
	), array(array(
		'value' => 'none',
		'label' => 'Không để chuyển hướng',
		'_type' => 'option',
	),
	array(
		'value' => 'permanent',
		'label' => 'Để chuyển hướng vĩnh viễn',
		'_type' => 'option',
	),
	array(
		'value' => 'temporary',
		'label' => 'Để một chuyển hướng và sẽ hết hạn sau
' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array('
				<div class="inputGroup">
					' . $__templater->formNumberBox(array(
		'name' => 'redirect_length[amount]',
		'value' => '1',
		'min' => '0',
	)) . '
					<span class="inputGroup-splitter"></span>
					' . $__templater->formSelect(array(
		'name' => 'redirect_length[unit]',
		'value' => 'days',
		'class' => 'input--inline',
	), array(array(
		'value' => 'hours',
		'label' => 'Giờ',
		'_type' => 'option',
	),
	array(
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
	))) . '
				</div>
			'),
		'_type' => 'option',
	)), array(
		'label' => 'Chú thích chuyển hướng',
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

' . '

' . '

';
	return $__finalCompiled;
});