<?php
// FROM HASH: 886c71a5ff231c820e6a96a8d134aee6
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => $__vars['formBaseKey'] . '[register_date]',
		'selected' => $__vars['property']['property_value']['register_date'],
		'label' => '
		' . 'Registration date' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[message_count]',
		'selected' => $__vars['property']['property_value']['message_count'],
		'label' => '
		' . 'Total messages' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[like_count]',
		'selected' => $__vars['property']['property_value']['like_count'],
		'label' => '
		' . 'Total likes' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[trophy_points]',
		'selected' => $__vars['property']['property_value']['trophy_points'],
		'label' => '
		' . 'Điểm thành tích' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[age]',
		'selected' => $__vars['property']['property_value']['age'],
		'label' => '
		' . 'Tuổi' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[location]',
		'selected' => $__vars['property']['property_value']['location'],
		'label' => '
		' . 'Nơi ở' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[website]',
		'selected' => $__vars['property']['property_value']['website'],
		'label' => '
		' . 'Website' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[custom_fields]',
		'selected' => $__vars['property']['property_value']['custom_fields'],
		'label' => '
		' . 'Custom fields' . '
	',
		'_type' => 'option',
	)), array(
		'rowclass' => $__vars['rowClass'],
		'label' => $__templater->escape($__vars['titleHtml']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['property']['description']),
	));
	return $__finalCompiled;
});