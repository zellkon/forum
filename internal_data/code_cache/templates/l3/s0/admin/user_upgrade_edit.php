<?php
// FROM HASH: 5baf87bbf357d73573db05e68be8d0e8
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['upgrade'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm nâng cấp thành viên');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa nâng cấp thành viên' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['upgrade']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['upgrade'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('user-upgrades/delete', $__vars['upgrade'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['profiles'])) {
		foreach ($__vars['profiles'] AS $__vars['profileId'] => $__vars['profile']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['profileId'],
				'label' => (($__vars['profile']['Provider']['title'] !== $__vars['profile']['title']) ? (($__templater->escape($__vars['profile']['Provider']['title']) . ' - ') . $__templater->escape($__vars['profile']['title'])) : $__templater->escape($__vars['profile']['Provider']['title'])),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp2 = $__templater->mergeChoiceOptions(array(), $__vars['userGroups']);
	$__compilerTemp3 = '';
	if (!$__templater->test($__vars['upgrades'], 'empty', array())) {
		$__compilerTemp3 .= '
				';
		$__compilerTemp4 = $__templater->mergeChoiceOptions(array(), $__vars['upgrades']);
		$__compilerTemp3 .= $__templater->formCheckBoxRow(array(
			'name' => 'disabled_upgrade_ids',
			'value' => $__vars['upgrade']['disabled_upgrade_ids'],
			'listclass' => 'listColumns',
		), $__compilerTemp4, array(
			'label' => 'Disabled User Upgrades',
			'explain' => 'Disables the selected user upgrades while this upgrade is active. This is helpful if you have tiers of the same upgrade and don\'t want people to buy multiple levels.',
		)) . '
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['upgrade']['title'],
		'maxlength' => $__templater->fn('max_length', array($__vars['upgrade'], 'title', ), false),
	), array(
		'label' => 'Tiêu đề',
	)) . '

			' . $__templater->formTextAreaRow(array(
		'name' => 'description',
		'value' => $__vars['upgrade']['description'],
		'autosize' => 'true',
	), array(
		'label' => 'Mô tả',
		'hint' => 'Bạn có thể sử dụng HTML',
	)) . '

			' . $__templater->callMacro('display_order_macros', 'row', array(
		'value' => ($__vars['upgrade']['display_order'] ?: 1),
	), $__vars) . '

			' . $__templater->formRow('

				' . $__templater->formTextBox(array(
		'name' => 'cost_amount',
		'value' => ($__vars['upgrade']['cost_amount'] ?: 5),
		'class' => 'input--inline',
		'size' => '5',
	)) . '
				' . $__templater->callMacro('public:currency_macros', 'currency_list', array(
		'value' => ($__vars['upgrade']['cost_currency'] ?: 'USD'),
		'class' => 'input--inline',
	), $__vars) . '
				<div class="formRow-explain">' . '<strong>Ghi chú:</strong> Đảm bảo tài khoản người bán của bạn với các tài khoản thanh toán đã chọn hỗ trợ các loại tiền tệ ở trên. Hỗ trợ tiền tệ có thể thay đổi theo vùng.' . '</div>
			', array(
		'rowtype' => 'input',
		'label' => 'Chi phí',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'length_type',
	), array(array(
		'value' => 'permanent',
		'selected' => $__vars['upgrade']['length_unit'] == '',
		'label' => 'Vĩnh viễn',
		'_type' => 'option',
	),
	array(
		'value' => 'timed',
		'selected' => $__vars['upgrade']['length_unit'] != '',
		'label' => 'Theo thời gian' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array('
						<div class="inputGroup">
							' . $__templater->formNumberBox(array(
		'name' => 'length_amount',
		'value' => ($__vars['upgrade']['length_amount'] ?: 1),
		'min' => '1',
		'max' => '255',
	)) . '
							<span class="inputGroup-splitter"></span>
							' . $__templater->formSelect(array(
		'name' => 'length_unit',
		'value' => ((($__vars['upgrade']['length_unit'] == 'permanent') OR (!$__vars['upgrade']['length_amount'])) ? 'months' : $__vars['upgrade']['length_unit']),
		'class' => 'input--inline',
	), array(array(
		'value' => 'day',
		'label' => 'Ngày',
		'_type' => 'option',
	),
	array(
		'value' => 'month',
		'label' => 'Tháng',
		'_type' => 'option',
	),
	array(
		'value' => 'year',
		'label' => 'Năm',
		'_type' => 'option',
	))) . '
						</div>

					', '
						' . $__templater->formCheckBox(array(
	), array(array(
		'name' => 'recurring',
		'value' => '1',
		'selected' => $__vars['upgrade']['recurring'],
		'label' => 'Thanh toán định kỳ',
		'hint' => 'Thanh toán sẽ tự động được thực hiện theo từng khoảng thời gian để nâng cấp được kích hoạt.<br />
<br />
<strong>Ghi chú:</strong> Nếu được bật, tất cả cấu hình thanh toán được chỉ định cho nâng cấp này phải hỗ trợ thanh toán định kỳ.',
		'_type' => 'option',
	))) . '
					'),
		'_type' => 'option',
	)), array(
		'label' => 'Thời gian nâng cấp',
	)) . '

			' . $__templater->formCheckBoxRow(array(
		'name' => 'payment_profile_ids',
		'value' => $__vars['upgrade']['payment_profile_ids'],
	), $__compilerTemp1, array(
		'label' => 'Tài khoản thanh toán',
	)) . '

			' . $__templater->formCheckBoxRow(array(
		'name' => 'extra_group_ids',
		'value' => $__vars['upgrade']['extra_group_ids'],
		'listclass' => 'listColumns',
	), $__compilerTemp2, array(
		'label' => 'Nhóm thành viên bổ sung',
		'explain' => 'Đặt thành viên trong các nhóm được chọn trong khi nâng cấp đang hoạt động.',
	)) . '

			' . $__compilerTemp3 . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'can_purchase',
		'selected' => $__vars['upgrade']['can_purchase'],
		'label' => 'Không thể mua',
		'_type' => 'option',
	)), array(
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('user-upgrades/save', $__vars['upgrade'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});