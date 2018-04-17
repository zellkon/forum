<?php
// FROM HASH: 7099a2b6eabf5e663c1f1c5635ef1aa5
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['tag'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm từ khóa');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa từ khóa' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['tag']['tag']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['tag'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('tags/delete', $__vars['tag'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'name' => 'tag',
		'value' => $__vars['tag']['tag'],
		'maxlength' => $__templater->fn('max_length', array($__vars['tag'], 'tag', ), false),
	), array(
		'label' => 'Từ khóa',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'tag_url',
		'value' => $__vars['tag']['tag_url'],
		'maxlength' => $__templater->fn('max_length', array($__vars['tag'], 'tag_url', ), false),
		'dir' => 'ltr',
	), array(
		'label' => 'Phiên bản URL',
		'explain' => 'Điều này sẽ được sử dụng để xác định từ khóa này trong một URL. Nó chỉ có thể chứa a-z, 0-9, - và _. Để trống để tự động tạo ra nó.',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'permanent',
		'selected' => $__vars['tag']['permanent'],
		'label' => 'Vĩnh viễn',
		'hint' => 'Đặt từ khóa vĩnh viễn để ngăn nó khỏi bị xóa khi không còn sử dụng nữa.',
		'_type' => 'option',
	)), array(
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('tags/save', $__vars['tag'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});