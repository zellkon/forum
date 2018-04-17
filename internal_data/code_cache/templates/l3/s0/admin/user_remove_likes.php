<?php
// FROM HASH: b500d1e028129839298242b4f5454426
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Xóa lượt thích');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRow($__templater->escape($__vars['user']['username']), array(
		'label' => 'Thành viên',
	)) . '
			' . $__templater->formRow('

				<div class="inputGroup">
					' . $__templater->formNumberBox(array(
		'name' => 'cutoff[amount]',
		'value' => '1',
		'min' => '0',
	)) . '
					<span class="inputGroup-splitter"></span>
					' . $__templater->formSelect(array(
		'name' => 'cutoff[unit]',
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
			', array(
		'rowtype' => 'input',
		'label' => 'Xóa lượt thích trong vòng',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'delete',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('users/remove-likes', $__vars['user'], ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});