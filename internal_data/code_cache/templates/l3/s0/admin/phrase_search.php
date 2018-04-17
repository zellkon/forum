<?php
// FROM HASH: b4949b79f723b7f4f231a583003c810d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tìm kiếm cụm từ');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->callMacro('language_macros', 'language_select', array(
		'languageTree' => $__vars['languageTree'],
		'languageId' => $__vars['languageId'],
	), $__vars) . '

			' . $__templater->callMacro('addon_macros', 'addon_select', array(
		'addOnId' => '_any',
		'includeAny' => true,
	), $__vars) . '

			<hr class="formRowSep" />

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'type' => 'search',
		'dir' => 'ltr',
	), array(
		'label' => 'Tiêu đề chứa',
	)) . '

			' . $__templater->formRow('

				<ul class="inputList">
					<li>' . $__templater->formTextArea(array(
		'name' => 'text',
		'autosize' => 'true',
	)) . '</li>
					<li>' . $__templater->formCheckBox(array(
		'standalone' => 'true',
	), array(array(
		'name' => 'text_cs',
		'label' => 'Phân biệt dạng chữ (chữ hoa và chữ thường)',
		'_type' => 'option',
	))) . '</li>
				</ul>
			', array(
		'rowtype' => 'input',
		'label' => 'Văn bản Chứa',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formCheckBoxRow(array(
		'name' => 'state[]',
	), array(array(
		'value' => 'default',
		'selected' => true,
		'label' => 'Chưa thay đổi',
		'_type' => 'option',
	),
	array(
		'value' => 'inherited',
		'selected' => true,
		'label' => 'Sửa đổi bằng ngôn ngữ mẹ',
		'_type' => 'option',
	),
	array(
		'value' => 'custom',
		'selected' => true,
		'label' => 'Sửa đổi bằng ngôn ngữ này',
		'_type' => 'option',
	)), array(
		'label' => 'Trạng thái của cụm từ',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'search',
	), array(
		'html' => $__templater->button('', array(
		'type' => 'submit',
		'icon' => 'translate',
		'name' => 'translate',
	), '', array(
	)),
	)) . '
	</div>

	' . $__templater->formHiddenVal('search', '1', array(
	)) . '
', array(
		'action' => $__templater->fn('link', array('phrases/search', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});