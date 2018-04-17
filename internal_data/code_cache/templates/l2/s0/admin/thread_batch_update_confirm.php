<?php
// FROM HASH: ffef22d9e3bff03241a00bd3c2efe8b0
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Cập nhật chủ đề hàng loạt');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if (!$__vars['threadIds']) {
		$__compilerTemp1 .= '
					<span role="presentation" aria-hidden="true">&middot;</span>
					<a href="' . $__templater->fn('link', array('threads/list', null, array('criteria' => $__vars['criteria'], 'all' => true, ), ), true) . '">' . 'Xem hoặc lọc lại' . '</a>
				';
	}
	$__compilerTemp2 = '';
	if ($__vars['prefixes']['prefixesGrouped']) {
		$__compilerTemp2 .= '
				' . $__templater->formRow('

					' . $__templater->callMacro('public:prefix_macros', 'select', array(
			'noneLabel' => '',
			'prefixes' => $__vars['prefixes']['prefixesGrouped'],
			'name' => 'actions[prefix_id]',
			'type' => 'thread',
		), $__vars) . '
				', array(
			'rowtype' => 'input',
			'label' => 'Đặt tiền tố',
			'explain' => 'Tiền tố sẽ chỉ được áp dụng nếu nó là hợp lệ cho diễn đàn mà các chủ đề ở trong hoặc đang được chuyển đến.',
		)) . '
			';
	}
	$__compilerTemp3 = array(array(
		'value' => '0',
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['forums'])) {
		foreach ($__vars['forums'] AS $__vars['forum']) {
			$__compilerTemp3[] = array(
				'value' => $__vars['forum']['value'],
				'label' => $__templater->escape($__vars['forum']['label']),
				'disabled' => $__vars['forum']['disabled'],
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp4 = '';
	if ($__vars['hasPrefixes']) {
		$__compilerTemp4 .= '
					' . 'If the selected thread(s) have any prefixes applied which are not valid in the selected forum, those prefixes will be removed.' . '
				';
	}
	$__compilerTemp5 = '';
	if ($__vars['threadIds']) {
		$__compilerTemp5 .= '
		' . $__templater->formHiddenVal('thread_ids', $__templater->filter($__vars['threadIds'], array(array('json', array()),), false), array(
		)) . '
	';
	} else {
		$__compilerTemp5 .= '
		' . $__templater->formHiddenVal('criteria', $__templater->filter($__vars['criteria'], array(array('json', array()),), false), array(
		)) . '
	';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<h2 class="block-header">' . 'Cập nhật chủ đề' . '</h2>
		<div class="block-body">
			' . $__templater->formRow('
				' . $__templater->filter($__vars['total'], array(array('number', array()),), true) . '
				' . $__compilerTemp1 . '
			', array(
		'label' => 'Đã xem chủ đề',
	)) . '

			<hr class="formRowSep" />

			' . $__compilerTemp2 . '


			' . $__templater->formSelectRow(array(
		'name' => 'actions[node_id]',
	), $__compilerTemp3, array(
		'label' => 'Chuyển đến chuyên mục',
		'explain' => $__compilerTemp4,
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'actions[stick]',
		'value' => 'stick',
		'label' => 'Ghim chủ đề',
		'_type' => 'option',
	),
	array(
		'name' => 'actions[unstick]',
		'value' => 'unstick',
		'label' => 'Bỏ ghim Chủ đề',
		'_type' => 'option',
	),
	array(
		'name' => 'actions[lock]',
		'value' => 'lock',
		'label' => 'Khóa chủ đề',
		'_type' => 'option',
	),
	array(
		'name' => 'actions[unlock]',
		'value' => 'unlock',
		'label' => 'Bỏ khóa chủ đề',
		'_type' => 'option',
	),
	array(
		'name' => 'actions[approve]',
		'value' => 'approve',
		'label' => 'Duyệt chủ đề',
		'_type' => 'option',
	),
	array(
		'name' => 'actions[unapprove]',
		'value' => 'unapprove',
		'label' => 'Bỏ duyệt chủ đề',
		'_type' => 'option',
	),
	array(
		'name' => 'actions[soft_delete]',
		'value' => 'soft_delete',
		'label' => 'Xóa tạm chủ đề',
		'_type' => 'option',
	)), array(
	)) . '

		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Cập nhật chủ đề',
		'icon' => 'save',
	), array(
	)) . '
	</div>

	' . $__compilerTemp5 . '
', array(
		'action' => $__templater->fn('link', array('threads/batch-update/action', ), false),
		'class' => 'block',
	)) . '

';
	$__compilerTemp6 = '';
	if ($__vars['threadIds']) {
		$__compilerTemp6 .= '
		' . $__templater->formHiddenVal('thread_ids', $__templater->filter($__vars['threadIds'], array(array('json', array()),), false), array(
		)) . '
	';
	} else {
		$__compilerTemp6 .= '
		' . $__templater->formHiddenVal('criteria', $__templater->filter($__vars['criteria'], array(array('json', array()),), false), array(
		)) . '
	';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<h2 class="block-header">' . 'Xóa các chủ đề' . '</h2>
		<div class="block-body">
			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'actions[delete]',
		'label' => '
					' . 'Xác nhận xóa ' . $__templater->filter($__vars['total'], array(array('number', array()),), true) . ' chủ đề' . '
				',
		'_type' => 'option',
	)), array(
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'name' => 'confirm_delete',
		'icon' => 'delete',
	), array(
	)) . '
	</div>

	' . $__compilerTemp6 . '
', array(
		'action' => $__templater->fn('link', array('threads/batch-update/action', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});