<?php
// FROM HASH: c9744ef07adc62276d0d626a03092192
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['phrase'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm cụm từ');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa cụm từ' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['phrase']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	$__templater->setPageParam('breadcrumbPath', 'languages');
	$__finalCompiled .= '
';
	$__templater->breadcrumb($__templater->preEscaped($__templater->escape($__vars['language']['title']) . ' - ' . 'Cụm từ'), $__templater->fn('link', array('languages/phrases', $__vars['language'], ), false), array(
	));
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['phrase'], 'isUpdate', array()) AND ($__vars['phrase']['language_id'] == $__vars['language']['language_id'])) {
		$__compilerTemp1 = '';
		if ($__vars['language']['language_id']) {
			$__compilerTemp1 .= '
		' . $__templater->button('Khôi phục', array(
				'href' => $__templater->fn('link', array('phrases/delete', $__vars['phrase'], array('_xfRedirect' => $__vars['redirect'], ), ), false),
				'overlay' => 'true',
			), '', array(
			)) . '
	';
		} else {
			$__compilerTemp1 .= '
		' . $__templater->button('', array(
				'href' => $__templater->fn('link', array('phrases/delete', $__vars['phrase'], array('_xfRedirect' => $__vars['redirect'], ), ), false),
				'icon' => 'delete',
				'overlay' => 'true',
			), '', array(
			)) . '
	';
		}
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__compilerTemp1 . '
');
	}
	$__finalCompiled .= '

';
	$__compilerTemp2 = '';
	if ($__templater->method($__vars['phrase'], 'isUpdate', array()) AND ($__vars['language']['language_id'] > 0)) {
		$__compilerTemp2 .= '
				' . $__templater->formRow('
					<div class="u-ltr">
						' . (($__vars['phrase']['language_id'] == 0) ? $__templater->filter($__vars['phrase']['phrase_text'], array(array('nl2br', array()),), true) : $__templater->filter($__vars['phrase']['Master']['phrase_text'], array(array('nl2br', array()),), true)) . '
					</div>
				', array(
			'label' => 'Giá trị chính',
		)) . '
			';
	}
	$__compilerTemp3 = '';
	if ($__vars['language']['text_direction'] == 'RTL') {
		$__compilerTemp3 .= '
				' . $__templater->formTextAreaRow(array(
			'name' => 'phrase_text',
			'value' => $__vars['phrase']['phrase_text'],
			'dir' => 'rtl',
			'style' => 'text-align: right',
		), array(
			'label' => 'Nội dung cụm từ',
			'explain' => 'Bạn có thể sử dụng HTML ở đây, nhưng lý tưởng là đánh dấu nên được thực hiện trong các mẫu, chứ không phải là cụm từ.',
		)) . '
			';
	} else {
		$__compilerTemp3 .= '
				' . $__templater->formCodeEditorRow(array(
			'name' => 'phrase_text',
			'value' => $__vars['phrase']['phrase_text'],
			'mode' => 'html',
			'data-line-wrapping' => 'true',
			'data-line-numbers' => 'false',
			'class' => 'codeEditor--autoSize codeEditor--proportional',
		), array(
			'label' => 'Nội dung cụm từ',
			'explain' => 'Bạn có thể sử dụng HTML ở đây, nhưng lý tưởng là đánh dấu nên được thực hiện trong các mẫu, chứ không phải là cụm từ.',
		)) . '
			';
	}
	$__compilerTemp4 = '';
	if (!$__vars['language']['language_id']) {
		$__compilerTemp4 .= '
				' . $__templater->callMacro('addon_macros', 'addon_edit', array(
			'addOnId' => $__vars['phrase']['addon_id'],
		), $__vars) . '
			';
	} else {
		$__compilerTemp4 .= '
				' . $__templater->formHiddenVal('addon_id', $__vars['phrase']['addon_id'], array(
		)) . '
			';
	}
	$__compilerTemp5 = '';
	if (!$__vars['language']['language_id']) {
		$__compilerTemp5 .= '
				' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => 'global_cache',
			'selected' => $__vars['phrase']['global_cache'],
			'label' => 'Cache this phrase globally',
			'_type' => 'option',
		)), array(
		)) . '
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRow('
				' . $__templater->escape($__vars['language']['title']) . '
				' . $__templater->formHiddenVal('language_id', $__vars['language']['language_id'], array(
	)) . '
			', array(
		'label' => 'Ngôn ngữ',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['phrase']['title'],
		'maxlength' => $__templater->fn('max_length', array($__vars['phrase'], 'title', ), false),
		'dir' => 'ltr',
	), array(
		'label' => 'Tiêu đề',
		'hint' => 'Phải là duy nhất',
	)) . '

			' . $__compilerTemp2 . '

			' . $__compilerTemp3 . '

			' . $__compilerTemp4 . '

			' . $__compilerTemp5 . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
		'html' => '
				' . $__templater->button('Lưu và thoát', array(
		'type' => 'submit',
		'icon' => 'save',
		'name' => 'exit',
	), '', array(
	)) . '
				<input type="hidden" name="_page" value="' . $__templater->escape($__vars['_page']) . '" />
			',
	)) . '
	</div>
	' . $__templater->fn('redirect_input', array(null, null, true)) . '
', array(
		'action' => $__templater->fn('link', array('phrases/save', $__vars['phrase'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});