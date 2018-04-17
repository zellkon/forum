<?php
// FROM HASH: 93b078b2ccc6552eb3f3583d82a97f2c
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm Kiểm duyệt viên');
	$__finalCompiled .= '

';
	$__compilerTemp1 = array(array(
		'value' => '_super',
		'selected' => true,
		'label' => 'Kiểm duyệt cấp cao',
		'hint' => 'Kiểm duyệt viên có thể kiểm soát toàn bộ diễn đàn.',
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['typeChoices'])) {
		foreach ($__vars['typeChoices'] AS $__vars['contentType'] => $__vars['options']) {
			$__compilerTemp2 = array();
			if ($__templater->isTraversable($__vars['options']['choices'])) {
				foreach ($__vars['options']['choices'] AS $__vars['choice']) {
					$__compilerTemp2[] = array(
						'value' => $__vars['choice']['value'],
						'label' => $__templater->escape($__vars['choice']['label']),
						'disabled' => $__vars['choice']['disabled'],
						'_type' => 'option',
					);
				}
			}
			$__compilerTemp1[] = array(
				'value' => $__vars['contentType'],
				'label' => $__templater->escape($__vars['options']['label']),
				'_dependent' => array($__templater->formSelect(array(
				'name' => $__vars['options']['name'],
				'value' => $__vars['options']['value'],
			), $__compilerTemp2)),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'name' => 'username',
		'value' => $__vars['username'],
		'type' => 'search',
		'ac' => 'single',
		'placeholder' => 'Tên thành viên' . $__vars['xf']['language']['ellipsis'],
	), array(
		'label' => 'Tên kiểm duyệt viên',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'type',
		'value' => $__vars['type'],
	), $__compilerTemp1, array(
		'label' => 'Loại kiểm duyệt',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Thêm Kiểm duyệt viên' . $__vars['xf']['language']['ellipsis'],
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('moderators/add', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});