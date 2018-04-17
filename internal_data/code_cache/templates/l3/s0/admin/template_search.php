<?php
// FROM HASH: 216a301a8f9225e441e1d89b6a3eb93f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tìm kiếm mẫu');
	$__finalCompiled .= '

';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['types'])) {
		foreach ($__vars['types'] AS $__vars['typeId'] => $__vars['type']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['typeId'],
				'label' => $__templater->escape($__vars['type']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . $__templater->callMacro('style_macros', 'style_select', array(
		'styleTree' => $__vars['styleTree'],
		'styleId' => $__vars['styleId'],
	), $__vars) . '

			' . $__templater->formSelectRow(array(
		'name' => 'type',
		'selected' => 'public',
	), $__compilerTemp1, array(
		'label' => 'Loại mẫu',
	)) . '

			' . $__templater->callMacro('addon_macros', 'addon_select', array(
		'addOnId' => '_any',
		'includeAny' => true,
	), $__vars) . '

			<hr class="formRowSep" />

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'dir' => 'ltr',
	), array(
		'label' => 'Tiêu đề chứa',
	)) . '

			' . $__templater->formRow('

				<ul class="inputList">
					<li>' . $__templater->formTextArea(array(
		'name' => 'template',
		'autosize' => 'true',
		'code' => 'true',
	)) . '</li>
					<li>' . $__templater->formCheckBox(array(
		'standalone' => 'true',
	), array(array(
		'name' => 'template_cs',
		'label' => 'Phân biệt dạng chữ (chữ hoa và chữ thường)',
		'_type' => 'option',
	))) . '</li>
				</ul>
			', array(
		'rowtype' => 'input',
		'label' => 'Template Contains',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formCheckBoxRow(array(
		'name' => 'state[]',
	), array(array(
		'value' => 'default',
		'selected' => 1,
		'label' => 'Chưa thay đổi',
		'_type' => 'option',
	),
	array(
		'value' => 'inherited',
		'selected' => 1,
		'label' => 'Được sửa đổi theo giao diện gốc',
		'_type' => 'option',
	),
	array(
		'value' => 'custom',
		'selected' => 1,
		'label' => 'Được chỉnh sửa trong giao diện này',
		'_type' => 'option',
	)), array(
		'label' => 'Trạng thái mẫu',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'search',
	), array(
	)) . '
	</div>
	' . $__templater->formHiddenVal('search', '1', array(
	)) . '

', array(
		'action' => $__templater->fn('link', array('templates/search', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});