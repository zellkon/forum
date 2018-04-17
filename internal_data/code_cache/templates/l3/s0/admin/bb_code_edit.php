<?php
// FROM HASH: 4f0abc6d0195928ff133bd7f93af26c2
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['bbCode'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm BB code');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit BB code' . $__vars['xf']['language']['label_separator'] . ' [' . $__templater->escape($__vars['bbCode']['bb_code_id']) . ']');
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['bbCode'], 'isUpdate', array()) AND $__templater->method($__vars['bbCode'], 'canEdit', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('bb-codes/delete', $__vars['bbCode'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

';
	if ((!$__templater->method($__vars['bbCode'], 'canEdit', array()))) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--important blockMessage--iconic">
		' . 'Only a limited number of fields in this item may be edited.' . '
	</div>
';
	}
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">

		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'name' => 'bb_code_id',
		'value' => $__vars['bbCode']['bb_code_id'],
		'maxlength' => $__templater->fn('max_length', array($__vars['bbCode'], 'bb_code_id', ), false),
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
		'dir' => 'ltr',
	), array(
		'label' => 'Thẻ BB Code',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => ($__templater->method($__vars['bbCode'], 'exists', array()) ? $__vars['bbCode']['MasterTitle']['phrase_text'] : ''),
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(
		'label' => 'Tiêu đề',
	)) . '
			' . $__templater->formTextAreaRow(array(
		'name' => 'desc',
		'value' => ($__templater->method($__vars['bbCode'], 'exists', array()) ? $__vars['bbCode']['MasterDesc']['phrase_text'] : ''),
		'autosize' => 'true',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(
		'label' => 'Mô tả',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'bb_code_mode',
		'value' => $__vars['bbCode']['bb_code_mode'],
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(array(
		'value' => 'replace',
		'label' => 'Thay thế đơn giản',
		'_type' => 'option',
	),
	array(
		'value' => 'callback',
		'label' => 'Hàm PHP',
		'_type' => 'option',
	)), array(
		'label' => 'Chế độ thay thế',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'has_option',
		'value' => $__vars['bbCode']['has_option'],
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(array(
		'value' => 'yes',
		'label' => 'Có',
		'_type' => 'option',
	),
	array(
		'value' => 'no',
		'label' => 'Không',
		'_type' => 'option',
	),
	array(
		'value' => 'optional',
		'explain' => 'This tag will work with and without the option provided. This is most commonly used with PHP callbacks.',
		'label' => '
					' . 'Tùy chọn (không bắt buộc)' . '
				',
		'_type' => 'option',
	)), array(
		'label' => 'Hỗ trợ thông số tùy chọn',
	)) . '

			' . $__templater->formCodeEditorRow(array(
		'name' => 'replace_html',
		'value' => $__vars['bbCode']['replace_html'],
		'mode' => 'html',
		'data-line-wrapping' => 'true',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
		'class' => 'codeEditor--autoSize',
	), array(
		'label' => 'HTML thay thế',
		'explain' => 'Sử dụng {option} để chỉ nội dung bên trong tùy chọn của thẻ (nếu được cung cấp) và {text} để chỉ nội dung bên trong thẻ.',
	)) . '

			' . $__templater->callMacro('helper_callback_fields', 'callback_row', array(
		'label' => 'Hàm PHP',
		'explain' => 'Hàm PHP này sẽ nhận được các thông số sau: array $tag, array $rendererStates, XenForo_BbCode_Formatter_Base $formatter.',
		'data' => $__vars['bbCode'],
		'readOnly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), $__vars) . '

			<hr class="formRowSep" />

			' . $__templater->formRadioRow(array(
		'name' => 'editor_icon_type',
		'value' => $__vars['bbCode']['editor_icon_type'],
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(array(
		'value' => '',
		'label' => 'Không có',
		'_type' => 'option',
	),
	array(
		'value' => 'fa',
		'label' => 'Font Awesome icon',
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'editor_icon_fa',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
		'value' => (($__vars['bbCode']['editor_icon_type'] == 'fa') ? $__vars['bbCode']['editor_icon_value'] : ''),
		'maxlength' => $__templater->fn('max_length', array($__vars['bbCode'], 'editor_icon_value', ), false),
		'dir' => 'ltr',
	))),
		'_type' => 'option',
	),
	array(
		'value' => 'image',
		'label' => 'Ảnh',
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'editor_icon_image',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
		'value' => (($__vars['bbCode']['editor_icon_type'] == 'image') ? $__vars['bbCode']['editor_icon_value'] : ''),
		'maxlength' => $__templater->fn('max_length', array($__vars['bbCode'], 'editor_icon_value', ), false),
		'dir' => 'ltr',
	))),
		'_type' => 'option',
	)), array(
		'label' => 'Ảnh hiển thị trong khung soạn thảo',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formTextAreaRow(array(
		'name' => 'example',
		'value' => ($__templater->method($__vars['bbCode'], 'exists', array()) ? $__vars['bbCode']['MasterExample']['phrase_text'] : ''),
		'autosize' => 'true',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(
		'label' => 'Ví dụ sử dụng',
		'explain' => 'Nếu bạn cung cấp một ví dụ, BB Code này sẽ xuất hiện trên trang trợ giúp.',
	)) . '

			' . $__templater->formTextAreaRow(array(
		'name' => 'output',
		'value' => ($__templater->method($__vars['bbCode'], 'exists', array()) ? $__vars['bbCode']['MasterOutput']['phrase_text'] : ''),
		'autosize' => 'true',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(
		'label' => 'Ví dụ xuất ra',
		'explain' => 'Kiểm soát cách ví dụ sẽ xuất hiện trên trang trợ giúp BB Code. Nếu một đầu ra không được nhập, ví dụ sẽ được kết xuất thay thế.',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formCheckBoxRow(array(
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(array(
		'name' => 'allow_signature',
		'value' => '1',
		'selected' => $__vars['bbCode']['allow_signature'],
		'label' => '
					' . 'Cho phép BB Code này trong chữ ký' . '
				',
		'_type' => 'option',
	)), array(
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'active',
		'value' => '1',
		'selected' => $__vars['bbCode']['active'],
		'hint' => (($__vars['xf']['debug'] AND $__vars['bbCode']['addon_id']) ? 'The value of this field will not be changed when this add-on is upgraded.' : ''),
		'label' => '
					' . 'Đã bật' . '
				',
		'_type' => 'option',
	)), array(
	)) . '

			' . $__templater->callMacro('addon_macros', 'addon_edit', array(
		'addOnId' => $__vars['bbCode']['addon_id'],
	), $__vars) . '
		</div>

		<h3 class="block-formSectionHeader">
			<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
				<span class="block-formSectionHeader-aligner">' . 'Tuỳ chọn Nâng cao' . '</span>
			</span>
		</h3>
		<div class="block-body block-body--collapsible">
			' . $__templater->formTextAreaRow(array(
		'name' => 'option_regex',
		'value' => $__vars['bbCode']['option_regex'],
		'code' => 'true',
		'autosize' => 'true',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(
		'label' => 'Option Match Regular Expression',
		'explain' => 'If provided, the tag will only be valid if the option matches this regular expression. This will be ignored if no option is provided. Please include the delimiters and pattern modifiers.',
	)) . '

			' . $__templater->formCheckBoxRow(array(
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(array(
		'name' => 'disable_smilies',
		'value' => '1',
		'selected' => $__vars['bbCode']['disable_smilies'],
		'label' => '
					' . 'Tắt mặt cười' . '
				',
		'_type' => 'option',
	),
	array(
		'name' => 'disable_nl2br',
		'value' => '1',
		'selected' => $__vars['bbCode']['disable_nl2br'],
		'label' => '
					' . 'Disable line break conversion' . '
				',
		'_type' => 'option',
	),
	array(
		'name' => 'disable_autolink',
		'value' => '1',
		'selected' => $__vars['bbCode']['disable_autolink'],
		'label' => '
					' . 'Disable auto-linking' . '
				',
		'_type' => 'option',
	),
	array(
		'name' => 'plain_children',
		'value' => '1',
		'selected' => $__vars['bbCode']['plain_children'],
		'label' => '
					' . 'Stop parsing BB code' . '
				',
		'_type' => 'option',
	)), array(
		'label' => 'Within This BB Code',
	)) . '

			' . $__templater->formCheckBoxRow(array(
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(array(
		'name' => 'allow_empty',
		'value' => '1',
		'selected' => $__vars['bbCode']['allow_empty'],
		'label' => 'Display HTML replacement when empty',
		'explain' => 'If selected, the replacement HTML will be displayed even if there is no text inside this BB code. Normally, empty BB code tags are silently ignored.',
		'_type' => 'option',
	)), array(
	)) . '

			' . $__templater->formNumberBoxRow(array(
		'name' => 'trim_lines_after',
		'value' => $__vars['bbCode']['trim_lines_after'],
		'min' => '0',
		'max' => '10',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
	), array(
		'label' => 'Trim Line Breaks After',
		'explain' => 'If this tag is a block-level tag, you may want to ignore 1 or 2 line breaks that come after this tag. This prevents the appearance of extra line breaks being inserted if users put this tag on its own line.',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formCodeEditorRow(array(
		'name' => 'replace_html_email',
		'value' => $__vars['bbCode']['replace_html_email'],
		'mode' => 'html',
		'data-line-wrapping' => 'true',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
		'class' => 'codeEditor--autoSize',
	), array(
		'label' => 'HTML Email Replacement',
		'explain' => 'If provided, this will override the HTML replacement when being rendered for an HTML email. If this is left empty, the default HTML replacement will be used.',
	)) . '

			' . $__templater->formCodeEditorRow(array(
		'name' => 'replace_text',
		'value' => $__vars['bbCode']['replace_text'],
		'mode' => 'text',
		'data-line-wrapping' => 'true',
		'readonly' => (!$__templater->method($__vars['bbCode'], 'canEdit', array())),
		'class' => 'codeEditor--autoSize',
	), array(
		'label' => 'Text Replacement',
		'explain' => 'If provided, this replacement will be used when rendering this tag to text. If this is left empty, the tag will effectively be ignored, leaving only the text inside it.',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>

', array(
		'action' => $__templater->fn('link', array('bb-codes/save', $__vars['bbCode'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});