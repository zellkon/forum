<?php
// FROM HASH: e17487ece59d861034565630df87e429
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Cảnh cáo thành viên' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['user']['username']));
	$__finalCompiled .= '

';
	if ($__vars['breadcrumbs']) {
		$__finalCompiled .= '
	';
		$__templater->breadcrumbs($__vars['breadcrumbs']);
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	$__templater->includeJs(array(
		'src' => 'xf/form_fill.js',
		'min' => '1',
	));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['contentUrl']) {
		$__compilerTemp1 .= '
					<a href="' . $__templater->escape($__vars['contentUrl']) . '">' . $__templater->escape($__vars['title']) . '</a>
				';
	} else {
		$__compilerTemp1 .= '
					' . $__templater->escape($__vars['title']) . '
				';
	}
	$__compilerTemp2 = array();
	if ($__templater->isTraversable($__vars['warnings'])) {
		foreach ($__vars['warnings'] AS $__vars['warning']) {
			$__compilerTemp2[] = array(
				'value' => $__vars['warning']['warning_definition_id'],
				'class' => 'js-FormFiller',
				'label' => $__templater->escape($__vars['warning']['title']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp2[] = array(
		'value' => '0',
		'class' => 'js-FormFiller',
		'label' => 'Cảnh cáo khác' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'custom_title',
		'maxlength' => $__templater->fn('max_length', array($__vars['warning'], 'title', ), false),
	))),
		'_type' => 'option',
	);
	$__compilerTemp3 = '';
	if ($__vars['contentActions']['delete'] OR $__vars['contentActions']['public']) {
		$__compilerTemp3 .= '
			<h2 class="block-formSectionHeader"><span class="block-formSectionHeader-aligner">' . 'Thực hiện với nội dung này' . '</span></h2>
			<div class="block-body">
				';
		$__compilerTemp4 = array(array(
			'value' => '',
			'label' => 'Không làm gì',
			'_type' => 'option',
		));
		if ($__vars['contentActions']['delete']) {
			$__compilerTemp4[] = array(
				'value' => 'delete',
				'label' => 'Xóa nội dung',
				'hint' => 'Bài viết sẽ vẫn xem được bởi quản lý và có thể khôi phục sau này.',
				'_dependent' => array($__templater->formTextBox(array(
				'name' => 'action_options[delete_reason]',
				'placeholder' => 'Lý do xóa bỏ' . $__vars['xf']['language']['ellipsis'],
				'maxlength' => $__templater->fn('max_length', array('XF:DeletionLog', 'delete_reason', ), false),
			))),
				'_type' => 'option',
			);
		}
		if ($__vars['contentActions']['public']) {
			$__compilerTemp4[] = array(
				'value' => 'public',
				'label' => 'Cảnh cáo công khai',
				'hint' => 'Điều này sẽ hiện với tất cả mọi người có thể thấy nội dung này.',
				'_dependent' => array($__templater->formTextBox(array(
				'name' => 'action_options[public_message]',
				'maxlength' => '255',
				'placeholder' => 'Nội dung cảnh cáo công khai' . $__vars['xf']['language']['ellipsis'],
			))),
				'_type' => 'option',
			);
		}
		$__compilerTemp3 .= $__templater->formRadioRow(array(
			'name' => 'content_action',
			'value' => '',
		), $__compilerTemp4, array(
			'label' => 'Thực hiện với nội dung này',
		)) . '
			</div>
		';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRow($__templater->fn('username_link', array($__vars['user'], false, array(
	))), array(
		'label' => 'Thành viên',
	)) . '

			' . $__templater->formRow('
				' . $__compilerTemp1 . '
			', array(
		'label' => 'Nội dung',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'warning_definition_id',
		'value' => '0',
	), $__compilerTemp2, array(
		'label' => 'Kiểu cảnh cáo',
	)) . '

			<div id="WarningEditableContainer">
				' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'points_enable',
		'value' => '1',
		'selected' => true,
		'label' => 'Kèm điểm cảnh cáo' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'points',
		'value' => '1',
		'min' => '0',
	))),
		'_type' => 'option',
	)), array(
		'label' => 'Điểm cảnh cáo',
	)) . '

				' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'expiry_enable',
		'value' => '1',
		'selected' => true,
		'label' => 'Điểm hết hạn sau' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array('
							<div class="inputGroup">
								' . $__templater->formNumberBox(array(
		'name' => 'expiry_value',
		'value' => '1',
		'min' => '0',
	)) . '
								<span class="inputGroup-splitter"></span>
								' . $__templater->formSelect(array(
		'name' => 'expiry_unit',
		'value' => 'months',
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
		'label' => 'Điểm hết hạn vào',
	)) . '
			</div>

			' . $__templater->formTextAreaRow(array(
		'name' => 'notes',
		'autosize' => 'true',
	), array(
		'label' => 'Lưu ý',
		'explain' => 'Mục này sẽ không hiển thị với thành viên bị cảnh cáo.',
	)) . '
		</div>

		<h2 class="block-formSectionHeader"><span class="block-formSectionHeader-aligner">' . 'Nhắc nhở thành viên' . '</span></h2>
		<div class="block-body">
			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'start_conversation',
		'value' => '1',
		'data-xf-init' => 'disabler',
		'data-container' => '#WarningConversation',
		'data-hide' => 'true',
		'label' => 'Bắt đầu đối thoại với ' . $__templater->escape($__vars['user']['username']) . '',
		'_type' => 'option',
	)), array(
	)) . '

			<div id="WarningConversation">
				' . $__templater->formTextBoxRow(array(
		'name' => 'conversation_title',
		'maxlength' => $__templater->fn('max_length', array('XF:ConversationMaster', 'title', ), false),
	), array(
		'label' => 'Tiêu đề',
	)) . '

				' . $__templater->formTextAreaRow(array(
		'name' => 'conversation_message',
		'rows' => '6',
		'autosize' => 'true',
		'maxlength' => $__vars['xf']['options']['messageMaxLength'],
	), array(
		'label' => 'Nội dung',
	)) . '

				' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'open_invite',
		'value' => '1',
		'label' => '
						' . 'Cho phép ' . $__templater->escape($__vars['user']['username']) . ' mời người khác tham gia cuộc trò chuyện này' . '
					',
		'_type' => 'option',
	),
	array(
		'name' => 'conversation_locked',
		'value' => '1',
		'label' => '
						' . 'Khóa cuộc trò chuyện (không cho phép trả lời)' . '
					',
		'_type' => 'option',
	)), array(
	)) . '
			</div>
		</div>

		' . $__compilerTemp3 . '

		' . $__templater->formSubmitRow(array(
		'submit' => 'Cảnh cáo',
		'sticky' => 'true',
	), array(
	)) . '
	</div>

	' . $__templater->fn('redirect_input', array(null, null, true)) . '
	' . $__templater->formHiddenVal('filled_warning_definition_id', '0', array(
	)) . '
	<input type="checkbox" id="WarningEditableInput"
		data-xf-init="disabler" data-container="#WarningEditableContainer"
		checked="checked" style="display: none" />
', array(
		'action' => $__vars['warnUrl'],
		'ajax' => 'true',
		'class' => 'block',
		'data-xf-init' => 'form-fill',
	));
	return $__finalCompiled;
});