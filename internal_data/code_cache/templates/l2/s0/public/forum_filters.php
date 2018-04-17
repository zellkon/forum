<?php
// FROM HASH: e78bc4c52721d1e8a26e5b1e0d1d4f12
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__compilerTemp1 = '';
	if (!$__templater->test($__vars['prefixes'], 'empty', array())) {
		$__compilerTemp1 .= '
		<div class="menu-row menu-row--separated">
			' . 'Tiền tố' . $__vars['xf']['language']['label_separator'] . '
			<div class="u-inputSpacer">
				' . $__templater->callMacro('prefix_macros', 'select', array(
			'prefixes' => $__vars['prefixes'],
			'type' => 'thread',
			'selected' => ($__vars['filters']['prefix_id'] ? $__vars['filters']['prefix_id'] : 0),
			'name' => 'prefix_id',
			'noneLabel' => $__vars['xf']['language']['parenthesis_open'] . 'Tất cả' . $__vars['xf']['language']['parenthesis_close'],
		), $__vars) . '
			</div>
		</div>
	';
	}
	$__compilerTemp2 = '';
	if ($__vars['filters']['no_date_limit']) {
		$__compilerTemp2 .= '
				';
		$__vars['lastDays'] = '';
		$__compilerTemp2 .= '
			';
	} else {
		$__compilerTemp2 .= '
				';
		$__vars['lastDays'] = ($__vars['filters']['last_days'] ?: $__vars['forum']['list_date_limit_days']);
		$__compilerTemp2 .= '
			';
	}
	$__finalCompiled .= $__templater->form('
	' . '
	' . $__compilerTemp1 . '

	' . '
	<div class="menu-row menu-row--separated">
		' . 'Bắt đầu bởi' . $__vars['xf']['language']['label_separator'] . '
		<div class="u-inputSpacer">
			' . $__templater->formTextBox(array(
		'name' => 'starter',
		'value' => ($__vars['starterFilter'] ? $__vars['starterFilter']['username'] : ''),
		'ac' => 'single',
		'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'username', ), false),
	)) . '
		</div>
	</div>

	' . '
	<div class="menu-row menu-row--separated">
		' . 'Cập nhật mới nhất' . $__vars['xf']['language']['label_separator'] . '
		<div class="u-inputSpacer">
			' . $__compilerTemp2 . '
			' . $__templater->formSelect(array(
		'name' => 'last_days',
		'value' => $__vars['lastDays'],
	), array(array(
		'value' => '-1',
		'label' => 'Tất cả thời gian',
		'_type' => 'option',
	),
	array(
		'value' => '7',
		'label' => '' . '7' . ' Ngày',
		'_type' => 'option',
	),
	array(
		'value' => '14',
		'label' => '' . '14' . ' Ngày',
		'_type' => 'option',
	),
	array(
		'value' => '30',
		'label' => '' . '30' . ' Ngày',
		'_type' => 'option',
	),
	array(
		'value' => '60',
		'label' => '' . '2' . ' tháng',
		'_type' => 'option',
	),
	array(
		'value' => '90',
		'label' => '' . '3' . ' tháng',
		'_type' => 'option',
	),
	array(
		'value' => '182',
		'label' => '' . '6' . ' tháng',
		'_type' => 'option',
	),
	array(
		'value' => '365',
		'label' => '1 Năm',
		'_type' => 'option',
	))) . '
		</div>
	</div>

	' . '
	<div class="menu-row menu-row--separated">
		' . 'Phân loại' . $__vars['xf']['language']['label_separator'] . '
		<div class="inputGroup u-inputSpacer">
			' . $__templater->formSelect(array(
		'name' => 'order',
		'value' => ($__vars['filters']['order'] ?: $__vars['forum']['default_sort_order']),
	), array(array(
		'value' => 'last_post_date',
		'label' => 'Bài viết cuối',
		'_type' => 'option',
	),
	array(
		'value' => 'post_date',
		'label' => 'Bài viết đầu tiên',
		'_type' => 'option',
	),
	array(
		'value' => 'title',
		'label' => 'Tiêu đề',
		'_type' => 'option',
	),
	array(
		'value' => 'reply_count',
		'label' => 'Trả lời',
		'_type' => 'option',
	),
	array(
		'value' => 'view_count',
		'label' => 'Lượt xem',
		'_type' => 'option',
	),
	array(
		'value' => 'first_post_likes',
		'label' => 'Bài viết đầu được yêu thích',
		'_type' => 'option',
	))) . '
			<span class="inputGroup-splitter"></span>
			' . $__templater->formSelect(array(
		'name' => 'direction',
		'value' => ($__vars['filters']['direction'] ?: $__vars['forum']['default_sort_direction']),
	), array(array(
		'value' => 'desc',
		'label' => 'Giảm dần',
		'_type' => 'option',
	),
	array(
		'value' => 'asc',
		'label' => 'Tăng dần',
		'_type' => 'option',
	))) . '
		</div>
	</div>

	<div class="menu-footer">
		<span class="menu-footer-controls">
			' . $__templater->button('Lọc', array(
		'type' => 'submit',
		'class' => 'button--primary',
	), '', array(
	)) . '
		</span>
	</div>
	' . $__templater->formHiddenVal('apply', '1', array(
	)) . '
', array(
		'action' => $__templater->fn('link', array('forums/filters', $__vars['forum'], ), false),
	));
	return $__finalCompiled;
});