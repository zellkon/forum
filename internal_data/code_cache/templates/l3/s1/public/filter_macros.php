<?php
// FROM HASH: fdd9ccc614631b047373c1ec32d17c59
return array('macros' => array('find_new_filter_footer' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	<hr class="menu-separator" />
	<div class="menu-row">
		' . $__templater->formCheckBox(array(
	), array(array(
		'name' => 'save',
		'label' => 'Lưu mặc định',
		'hint' => 'Các bộ lọc này sẽ được sử dụng theo mặc định bất cứ khi nào bạn trở lại.',
		'_type' => 'option',
	))) . '
	</div>
	<div class="menu-footer">
		<span class="menu-footer-controls">
			' . $__templater->button('Lọc', array(
		'type' => 'submit',
		'class' => 'button--primary',
	), '', array(
	)) . '
		</span>
		' . $__templater->formHiddenVal('skip', '1', array(
	)) . '
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});