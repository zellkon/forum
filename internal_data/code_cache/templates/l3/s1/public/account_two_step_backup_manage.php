<?php
// FROM HASH: 6aff868b6e6f08e5c0ddd662a30a99f2
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thiết lập Xác minh Hai bước' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['provider']['title']));
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->isTraversable($__vars['usedCodes'])) {
		foreach ($__vars['usedCodes'] AS $__vars['code']) {
			$__compilerTemp1 .= '
					<li><div style="text-decoration: line-through">' . $__templater->escape($__vars['code']) . '</div></li>
				';
		}
	}
	$__compilerTemp2 = '';
	if ($__templater->isTraversable($__vars['availableCodes'])) {
		foreach ($__vars['availableCodes'] AS $__vars['code']) {
			$__compilerTemp2 .= '
					<li><div>' . $__templater->escape($__vars['code']) . '</div></li>
				';
		}
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRow('

				<ul class="listColumns listColumns--spaced listPlain">
				' . $__compilerTemp1 . '
				' . $__compilerTemp2 . '
				</ul>
			', array(
		'label' => 'Mã dự phòng',
		'explain' => 'Mỗi mã này có thể được sử dụng một lần trong trường hợp bạn không có quyền truy cập vào các phương tiện xác minh khác. Các mã này phải được lưu ở một vị trí an toàn.',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'regen',
		'value' => '1',
		'label' => 'Tạo mã dự phòng mới',
		'hint' => 'Thao tác này sẽ tạo mã dự phòng mới. Tất cả mã sao lưu trước đó sẽ không còn hoạt động.',
		'_type' => 'option',
	)), array(
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Xác nhận tạo lại',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('account/two-step/manage', $__vars['provider'], ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});