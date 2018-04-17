<?php
// FROM HASH: 393a668ed7fd690e95336b5e4de34de1
return array('macros' => array('user_tabs' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'container' => '',
		'userTabTitle' => '',
		'active' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__vars['tabs'] = $__templater->preEscaped('
		<a class="tabs-tab' . (($__vars['active'] == 'user') ? ' is-active' : '') . '"
			role="tab" tabindex="0" aria-controls="' . $__templater->fn('unique_id', array('criteriaUser', ), true) . '">
			' . ($__vars['userTabTitle'] ? $__templater->escape($__vars['userTabTitle']) : 'User Criteria') . '</a>
		<a class="tabs-tab' . (($__vars['active'] == 'user_field') ? ' is-active' : '') . '"
			role="tab" tabindex="0" aria-controls="' . $__templater->fn('unique_id', array('criteriaUserField', ), true) . '">
			' . 'Tiêu chí trường' . '</a>
	');
	$__finalCompiled .= '
	';
	if ($__vars['container']) {
		$__finalCompiled .= '
		<div class="tabs" role="tablist">
			' . $__templater->filter($__vars['tabs'], array(array('raw', array()),), true) . '
		</div>
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['tabs'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'page_tabs' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'container' => '',
		'active' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__vars['tabs'] = $__templater->preEscaped('
		<a class="tabs-tab' . (($__vars['active'] == 'page') ? ' is-active' : '') . '"
			role="tab" tabindex="0" aria-controls="' . $__templater->fn('unique_id', array('criteriaPage', ), true) . '">' . 'Page Criteria' . '</a>
	');
	$__finalCompiled .= '
	';
	if ($__vars['container']) {
		$__finalCompiled .= '
		<div class="tabs" role="tablist">
			' . $__templater->filter($__vars['tabs'], array(array('raw', array()),), true) . '
		</div>
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['tabs'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'user_panes' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'container' => '',
		'active' => '',
		'criteria' => '!',
		'data' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '

	';
	$__vars['app'] = $__vars['xf']['app'];
	$__finalCompiled .= '
	';
	$__vars['visitor'] = $__vars['xf']['visitor'];
	$__finalCompiled .= '
	';
	$__vars['em'] = $__vars['app']['em'];
	$__finalCompiled .= '

	';
	$__compilerTemp1 = $__templater->mergeChoiceOptions(array(), $__vars['data']['connectedAccProviders']);
	$__compilerTemp2 = array();
	if ($__templater->isTraversable($__vars['data']['userGroups'])) {
		foreach ($__vars['data']['userGroups'] AS $__vars['userGroupId'] => $__vars['userGroupTitle']) {
			$__compilerTemp2[] = array(
				'value' => $__vars['userGroupId'],
				'label' => $__templater->escape($__vars['userGroupTitle']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp3 = array();
	if ($__templater->isTraversable($__vars['data']['userGroups'])) {
		foreach ($__vars['data']['userGroups'] AS $__vars['userGroupId'] => $__vars['userGroupTitle']) {
			$__compilerTemp3[] = array(
				'value' => $__vars['userGroupId'],
				'label' => $__templater->escape($__vars['userGroupTitle']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp4 = array();
	$__compilerTemp5 = $__templater->method($__vars['data']['languageTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp5)) {
		foreach ($__compilerTemp5 AS $__vars['treeEntry']) {
			$__compilerTemp4[] = array(
				'value' => $__vars['treeEntry']['record']['language_id'],
				'label' => $__templater->fn('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp6 = array(array(
		'name' => 'user_criteria[language][rule]',
		'value' => 'language',
		'selected' => $__vars['criteria']['language'],
		'label' => 'Thành viên đang sử dụng ngôn ngữ sau' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'user_criteria[language][data][language_id]',
		'value' => $__vars['criteria']['language']['language_id'],
	), $__compilerTemp4)),
		'_type' => 'option',
	));
	$__compilerTemp6[] = array(
		'label' => 'Ảnh đại diện' . $__vars['xf']['language']['label_separator'],
		'_type' => 'optgroup',
		'options' => array(),
	);
	end($__compilerTemp6); $__compilerTemp7 = key($__compilerTemp6);
	$__compilerTemp6[$__compilerTemp7]['options'][] = array(
		'name' => 'user_criteria[has_avatar][rule]',
		'value' => 'has_avatar',
		'selected' => $__vars['criteria']['has_avatar'],
		'label' => 'Thành viên có ảnh đại diện',
		'_type' => 'option',
	);
	$__compilerTemp6[$__compilerTemp7]['options'][] = array(
		'name' => 'user_criteria[no_avatar][rule]',
		'value' => 'no_avatar',
		'selected' => $__vars['criteria']['no_avatar'],
		'label' => 'Thành viên không có ảnh đại diện',
		'_type' => 'option',
	);
	$__compilerTemp6[] = array(
		'label' => 'Ảnh đại diện có độ phân giải cao' . $__vars['xf']['language']['label_separator'],
		'_type' => 'optgroup',
		'options' => array(),
	);
	end($__compilerTemp6); $__compilerTemp8 = key($__compilerTemp6);
	$__compilerTemp6[$__compilerTemp8]['options'][] = array(
		'name' => 'user_criteria[has_highdpi_avatar][rule]',
		'value' => 'has_highdpi_avatar',
		'selected' => $__vars['criteria']['has_highdpi_avatar'],
		'label' => 'Thành viên có ảnh đại diện có độ phân giải cao',
		'_type' => 'option',
	);
	$__compilerTemp6[$__compilerTemp8]['options'][] = array(
		'name' => 'user_criteria[no_highdpi_avatar][rule]',
		'value' => 'no_highdpi_avatar',
		'selected' => $__vars['criteria']['no_highdpi_avatar'],
		'label' => 'Thành viên không có ảnh đại diện độ phân giải cao',
		'_type' => 'option',
	);
	$__compilerTemp6[] = array(
		'label' => 'Xác minh 2 bước' . $__vars['xf']['language']['label_separator'],
		'_type' => 'optgroup',
		'options' => array(),
	);
	end($__compilerTemp6); $__compilerTemp9 = key($__compilerTemp6);
	$__compilerTemp6[$__compilerTemp9]['options'][] = array(
		'name' => 'user_criteria[with_tfa][rule]',
		'value' => 'with_tfa',
		'selected' => $__vars['criteria']['with_tfa'],
		'label' => 'Thành viên đã bật xác minh hai bước',
		'_type' => 'option',
	);
	$__compilerTemp6[$__compilerTemp9]['options'][] = array(
		'name' => 'user_criteria[without_tfa][rule]',
		'value' => 'without_tfa',
		'selected' => $__vars['criteria']['without_tfa'],
		'label' => 'Thành viên không bật xác minh hai bước',
		'_type' => 'option',
	);
	$__compilerTemp10 = '';
	$__compilerTemp11 = '';
	$__compilerTemp11 .= '
					';
	$__compilerTemp12 = $__templater->method($__templater->method($__vars['xf']['app']['em'], 'getRepository', array('XF:UserField', )), 'getDisplayGroups', array());
	if ($__templater->isTraversable($__compilerTemp12)) {
		foreach ($__compilerTemp12 AS $__vars['fieldGroup'] => $__vars['groupPhrase']) {
			$__compilerTemp11 .= '

						';
			$__vars['customFields'] = $__templater->method($__vars['app'], 'getCustomFields', array('users', $__vars['fieldGroup'], ));
			$__compilerTemp11 .= '
						';
			$__compilerTemp13 = '';
			$__compilerTemp13 .= '
								';
			if ($__templater->isTraversable($__vars['customFields'])) {
				foreach ($__vars['customFields'] AS $__vars['fieldId'] => $__vars['fieldDefinition']) {
					$__compilerTemp13 .= '
									';
					$__vars['fieldName'] = 'user_field_' . $__vars['fieldId'];
					$__compilerTemp13 .= '
									';
					$__vars['choices'] = $__vars['fieldDefinition']['field_choices'];
					$__compilerTemp13 .= '
									';
					$__compilerTemp14 = '';
					if (!$__vars['choices']) {
						$__compilerTemp14 .= '
													' . $__templater->formTextBox(array(
							'name' => 'user_criteria[' . $__vars['fieldName'] . '][data][text]',
							'value' => $__vars['criteria'][$__vars['fieldName']]['text'],
						)) . '
												';
					} else if ($__templater->fn('count', array($__vars['choices'], ), false) > 6) {
						$__compilerTemp14 .= '
													';
						$__compilerTemp15 = $__templater->mergeChoiceOptions(array(), $__vars['choices']);
						$__compilerTemp14 .= $__templater->formSelect(array(
							'name' => 'user_criteria[' . $__vars['fieldName'] . '][data][choices]',
							'value' => $__vars['criteria'][$__vars['fieldName']]['choices'],
							'multiple' => 'multiple',
							'size' => '5',
						), $__compilerTemp15) . '
												';
					} else {
						$__compilerTemp14 .= '
													';
						$__compilerTemp16 = $__templater->mergeChoiceOptions(array(), $__vars['choices']);
						$__compilerTemp14 .= $__templater->formCheckBox(array(
							'name' => 'user_criteria[' . $__vars['fieldName'] . '][data][choices]',
							'value' => $__vars['criteria'][$__vars['fieldName']]['choices'],
							'listclass' => 'listColumns',
						), $__compilerTemp16) . '
												';
					}
					$__compilerTemp13 .= $__templater->formCheckBoxRow(array(
					), array(array(
						'name' => 'user_criteria[' . $__vars['fieldName'] . '][rule]',
						'value' => $__vars['fieldName'],
						'selected' => $__vars['criteria'][$__vars['fieldName']],
						'label' => ($__vars['choices'] ? 'Sự lựa chọn của thành viên là' : 'Giá trị chứa văn bản' . $__vars['xf']['language']['label_separator']),
						'_dependent' => array('
												' . $__compilerTemp14 . '
											'),
						'_type' => 'option',
					)), array(
						'label' => $__templater->escape($__vars['fieldDefinition']['title']),
					)) . '
								';
				}
			}
			$__compilerTemp13 .= '
							';
			if (strlen(trim($__compilerTemp13)) > 0) {
				$__compilerTemp11 .= '
							<h2 class="block-formSectionHeader"><span class="block-formSectionHeader-aligner">' . $__templater->escape($__vars['groupPhrase']) . '</span></h2>
							' . $__compilerTemp13 . '
						';
			}
			$__compilerTemp11 .= '

					';
		}
	}
	$__compilerTemp11 .= '
				';
	if (strlen(trim($__compilerTemp11)) > 0) {
		$__compilerTemp10 .= '
				' . $__compilerTemp11 . '
			';
	} else {
		$__compilerTemp10 .= '
				' . 'No custom fields have been created yet.' . '
			';
	}
	$__vars['panes'] = $__templater->preEscaped('
		<li class="' . (($__vars['active'] == 'user') ? ' is-active' : '') . '" role="tabpanel" id="' . $__templater->fn('unique_id', array('criteriaUser', ), true) . '">
			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user_criteria[is_guest][rule]',
		'value' => 'is_guest',
		'selected' => $__vars['criteria']['is_guest'],
		'label' => 'Thành viên là khách',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[is_logged_in][rule]',
		'value' => 'is_logged_in',
		'selected' => $__vars['criteria']['is_logged_in'],
		'label' => 'Thành viên đã đăng nhập',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[is_moderator][rule]',
		'value' => 'is_moderator',
		'selected' => $__vars['criteria']['is_moderator'],
		'label' => 'Thành viên là Kiểm duyệt viên',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[is_admin][rule]',
		'value' => 'is_admin',
		'selected' => $__vars['criteria']['is_admin'],
		'label' => 'Thành viên là Quản trị viên',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[is_banned][rule]',
		'value' => 'is_banned',
		'selected' => $__vars['criteria']['is_banned'],
		'label' => 'Thành viên bị cấm',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[birthday][rule]',
		'value' => 'birthday',
		'selected' => $__vars['criteria']['birthday'],
		'label' => 'Thành viên có sinh nhật hôm nay',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[user_state][rule]',
		'value' => 'user_state',
		'selected' => $__vars['criteria']['user_state'],
		'label' => 'Trạng thái thành viên là' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array('
						' . $__templater->formSelect(array(
		'name' => 'user_criteria[user_state][data][state]',
		'value' => $__vars['criteria']['user_state']['state'],
	), array(array(
		'value' => 'valid',
		'label' => 'Valid',
		'_type' => 'option',
	),
	array(
		'value' => 'email_confirm',
		'label' => 'Đang chờ xác nhận email',
		'_type' => 'option',
	),
	array(
		'value' => 'email_confirm_edit',
		'label' => 'Awaiting email confirmation (from edit)',
		'_type' => 'option',
	),
	array(
		'value' => 'email_bounce',
		'label' => 'Email invalid (bounced)',
		'_type' => 'option',
	),
	array(
		'value' => 'moderated',
		'label' => 'Chờ phê duyệt',
		'_type' => 'option',
	),
	array(
		'value' => 'rejected',
		'label' => 'Đã từ chối',
		'_type' => 'option',
	),
	array(
		'value' => 'disabled',
		'label' => 'Tắt',
		'_type' => 'option',
	))) . '
					'),
		'_type' => 'option',
	)), array(
		'label' => 'Đặc quyền và Tình trạng
',
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user_criteria[connected_accounts][rule]',
		'value' => 'connected_accounts',
		'selected' => $__vars['criteria']['connected_accounts'],
		'label' => 'Thành viên được liên kết với bất kỳ nhà cung cấp tài khoản đã kết nối' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'user_criteria[connected_accounts][data][provider_ids]',
		'size' => '4',
		'multiple' => 'true',
		'value' => $__vars['criteria']['connected_accounts']['provider_ids'],
	), $__compilerTemp1)),
		'_type' => 'option',
	)), array(
		'label' => 'Tài khoản đã kết nối',
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user_criteria[user_groups][rule]',
		'value' => 'user_groups',
		'selected' => $__vars['criteria']['user_groups'],
		'label' => 'Thành viên là thành viên của bất kỳ nhóm người sử dụng nào đã chọn' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'user_criteria[user_groups][data][user_group_ids]',
		'size' => '4',
		'multiple' => 'true',
		'value' => $__vars['criteria']['user_groups']['user_group_ids'],
	), $__compilerTemp2)),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[not_user_groups][rule]',
		'value' => 'not_user_groups',
		'selected' => $__vars['criteria']['not_user_groups'],
		'label' => 'Thành viên KHÔNG là thành viên của bất kỳ nhóm người sử dụng nào đã chọn' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'user_criteria[not_user_groups][data][user_group_ids]',
		'size' => '4',
		'multiple' => 'true',
		'value' => $__vars['criteria']['not_user_groups']['user_group_ids'],
	), $__compilerTemp3)),
		'_type' => 'option',
	)), array(
		'label' => 'Nhóm thành viên',
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user_criteria[messages_posted][rule]',
		'value' => 'messages_posted',
		'selected' => $__vars['criteria']['messages_posted'],
		'label' => 'Thành viên đã đăng ít nhất X bài viết' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[messages_posted][data][messages]',
		'value' => $__vars['criteria']['messages_posted']['messages'],
		'size' => '5',
		'min' => '0',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[messages_maximum][rule]',
		'value' => 'messages_maximum',
		'selected' => $__vars['criteria']['messages_maximum'],
		'label' => 'Thành viên đã đăng nhiều nhất X bài viết' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[messages_maximum][data][messages]',
		'value' => $__vars['criteria']['messages_maximum']['messages'],
		'size' => '5',
		'min' => '0',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[like_count][rule]',
		'value' => 'like_count',
		'selected' => $__vars['criteria']['like_count'],
		'label' => 'Thành viên đã nhận được ít nhất X lượt thích' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[like_count][data][likes]',
		'value' => $__vars['criteria']['like_count']['likes'],
		'size' => '5',
		'min' => '0',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[like_ratio][rule]',
		'value' => 'like_ratio',
		'selected' => $__vars['criteria']['like_ratio'],
		'label' => 'Thành viên có tỉ lệ thích bài viết ít nhất' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[like_ratio][data][ratio]',
		'value' => $__vars['criteria']['like_ratio']['ratio'],
		'size' => '5',
		'min' => '0',
		'step' => '0.25',
	))),
		'afterhint' => 'Thành viên có 10 bài viết và 5 lượt thích sẽ có tỷ lệ 0.5.',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[trophy_points][rule]',
		'value' => 'trophy_points',
		'selected' => $__vars['criteria']['trophy_points'],
		'label' => 'Thành viên có ít nhất X điểm thành tích' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[trophy_points][data][points]',
		'value' => $__vars['criteria']['trophy_points']['points'],
		'size' => '5',
		'min' => '0',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[registered_days][rule]',
		'value' => 'registered_days',
		'selected' => $__vars['criteria']['registered_days'],
		'label' => 'Thành viên đã đăng ký ít nhất X ngày' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[registered_days][data][days]',
		'value' => $__vars['criteria']['registered_days']['days'],
		'size' => '5',
		'min' => '0',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[inactive_days][rule]',
		'value' => 'inactive_days',
		'selected' => $__vars['criteria']['inactive_days'],
		'label' => 'Thành viên đã không truy cập ít nhất X ngày' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[inactive_days][data][days]',
		'value' => $__vars['criteria']['inactive_days']['days'],
		'size' => '5',
		'min' => '0',
		'step' => '1',
	))),
		'_type' => 'option',
	)), array(
		'label' => 'Nội dung và Thành tích',
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), $__compilerTemp6, array(
		'label' => 'Hồ sơ thành viên và các tùy chọn',
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user_criteria[username][rule]',
		'value' => 'username',
		'selected' => $__vars['criteria']['username'],
		'label' => 'Tên thành viên là' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'user_criteria[username][data][names]',
		'value' => $__vars['criteria']['username']['names'],
		'ac' => 'true',
	))),
		'afterhint' => 'Nếu bạn muốn kết hợp những thành viên cụ thể, bạn có thể nhập tên thành viên của họ ở đây, cách nhau bằng dấu phẩy.',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[username_search][rule]',
		'value' => 'username_search',
		'selected' => $__vars['criteria']['username_search'],
		'label' => 'Tên thành viên có chứa' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'user_criteria[username_search][data][needles]',
		'value' => $__vars['criteria']['username_search']['needles'],
	))),
		'afterhint' => 'Bạn có thể nhập một hoặc nhiều đoạn văn bản được phân tách bằng dấu phẩy và thành viên có tên chứa bất kỳ đoạn nào sẽ khớp với tiêu chí.',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[email_search][rule]',
		'value' => 'email_search',
		'selected' => $__vars['criteria']['email_search'],
		'label' => 'Địa chỉ email của thành viên chứa' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'user_criteria[email_search][data][needles]',
		'value' => $__vars['criteria']['email_search']['needles'],
	))),
		'afterhint' => 'Bạn có thể nhập một hoặc nhiều đoạn văn bản được phân cách bằng dấu phẩy và thành viên có địa chỉ email chứa bất kỳ đoạn nào sẽ khớp với tiêu chí.',
		'_type' => 'option',
	)), array(
		'label' => 'Thành viên cụ thể',
	)) . '

			' . '
		</li>

		<li class="' . (($__vars['active'] == 'user_field') ? 'is-active' : '') . '" role="tabpanel" id="' . $__templater->fn('unique_id', array('criteriaUserField', ), true) . '">
			' . $__compilerTemp10 . '
		</li>
	');
	$__finalCompiled .= '

	';
	if ($__vars['container']) {
		$__finalCompiled .= '
		<ul class="tabPanes">
			' . $__templater->filter($__vars['panes'], array(array('raw', array()),), true) . '
		</ul>
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['panes'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'page_panes' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'container' => '',
		'active' => '',
		'criteria' => '!',
		'data' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '

	';
	$__vars['em'] = $__vars['xf']['app']['em'];
	$__finalCompiled .= '
	';
	$__vars['visitor'] = $__vars['xf']['visitor'];
	$__finalCompiled .= '

	';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['data']['hours'])) {
		foreach ($__vars['data']['hours'] AS $__vars['hour']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['hour'],
				'label' => $__templater->escape($__vars['hour']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp2 = array();
	if ($__templater->isTraversable($__vars['data']['minutes'])) {
		foreach ($__vars['data']['minutes'] AS $__vars['minute']) {
			$__compilerTemp2[] = array(
				'value' => $__vars['minute'],
				'label' => $__templater->escape($__vars['minute']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp3 = $__templater->mergeChoiceOptions(array(), $__vars['data']['timeZones']);
	$__compilerTemp4 = array();
	if ($__templater->isTraversable($__vars['data']['hours'])) {
		foreach ($__vars['data']['hours'] AS $__vars['hour']) {
			$__compilerTemp4[] = array(
				'value' => $__vars['hour'],
				'label' => $__templater->escape($__vars['hour']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp5 = array();
	if ($__templater->isTraversable($__vars['data']['minutes'])) {
		foreach ($__vars['data']['minutes'] AS $__vars['minute']) {
			$__compilerTemp5[] = array(
				'value' => $__vars['minute'],
				'label' => $__templater->escape($__vars['minute']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp6 = $__templater->mergeChoiceOptions(array(), $__vars['data']['timeZones']);
	$__compilerTemp7 = array();
	if ($__templater->isTraversable($__vars['data']['nodes'])) {
		foreach ($__vars['data']['nodes'] AS $__vars['option']) {
			$__compilerTemp7[] = array(
				'value' => $__vars['option']['value'],
				'label' => $__templater->escape($__vars['option']['label']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp8 = array();
	$__compilerTemp9 = $__templater->method($__vars['data']['styleTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp9)) {
		foreach ($__compilerTemp9 AS $__vars['treeEntry']) {
			$__compilerTemp8[] = array(
				'value' => $__vars['treeEntry']['record']['style_id'],
				'label' => $__templater->fn('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__vars['panes'] = $__templater->preEscaped('
		<li class="' . (($__vars['active'] == 'page') ? ' is-active' : '') . '" role="tabpanel" id="' . $__templater->fn('unique_id', array('criteriaPage', ), true) . '">

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'label' => 'User arrived on this site from a search engine',
		'name' => 'page_criteria[from_search][rule]',
		'value' => 'from_search',
		'selected' => $__vars['criteria']['from_search'],
		'_type' => 'option',
	)), array(
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'page_criteria[after][rule]',
		'value' => 'after',
		'selected' => $__vars['criteria']['after'],
		'label' => 'Current date and time is after' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array('
						<div class="inputGroup">
							' . $__templater->formDateInput(array(
		'name' => 'page_criteria[after][data][ymd]',
		'value' => $__vars['criteria']['after']['ymd'],
	)) . '
							<span class="inputGroup-text">
								' . 'Time' . $__vars['xf']['language']['label_separator'] . '
							</span>
							<span class="inputGroup" dir="ltr">
								' . $__templater->formSelect(array(
		'name' => 'page_criteria[after][data][hh]',
		'value' => $__vars['criteria']['after']['hh'],
		'class' => 'input--inline input--autoSize',
	), $__compilerTemp1) . '
								<span class="inputGroup-text">:</span>
								' . $__templater->formSelect(array(
		'name' => 'page_criteria[after][data][mm]',
		'value' => $__vars['criteria']['after']['mm'],
		'class' => 'input--inline input--autoSize',
	), $__compilerTemp2) . '
							</span>
						</div>
						<dfn class="inputChoices-explain inputChoices-explain--after">' . 'You may leave the date empty to have this criteria match at the same time every day.' . '</dfn>
					', $__templater->formRadio(array(
		'name' => 'page_criteria[after][data][user_tz]',
		'value' => ($__vars['criteria']['after']['user_tz'] ? $__vars['criteria']['after']['user_tz'] : 0),
	), array(array(
		'value' => '1',
		'label' => 'Trong múi giờ của khách truy cập',
		'_type' => 'option',
	),
	array(
		'value' => '0',
		'label' => 'In the selected timezone' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'page_criteria[after][data][timezone]',
		'value' => ($__vars['criteria']['after']['timezone'] ? $__vars['criteria']['after']['timezone'] : $__vars['visitor']['timezone']),
	), $__compilerTemp3)),
		'_type' => 'option',
	)))),
		'_type' => 'option',
	)), array(
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'page_criteria[before][rule]',
		'value' => 'before',
		'selected' => $__vars['criteria']['before'],
		'label' => 'Current date and time is before' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array('
						<div class="inputGroup">
							' . $__templater->formDateInput(array(
		'name' => 'page_criteria[before][data][ymd]',
		'value' => $__vars['criteria']['before']['ymd'],
	)) . '
							<span class="inputGroup-text">
								' . 'Time' . $__vars['xf']['language']['label_separator'] . '
							</span>
							<span class="inputGroup" dir="ltr">
								' . $__templater->formSelect(array(
		'name' => 'page_criteria[before][data][hh]',
		'value' => $__vars['criteria']['before']['hh'],
		'class' => 'input--inline input--autoSize',
	), $__compilerTemp4) . '
								<span class="inputGroup-text">:</span>
								' . $__templater->formSelect(array(
		'name' => 'page_criteria[before][data][mm]',
		'value' => $__vars['criteria']['before']['mm'],
		'class' => 'input--inline input--autoSize',
	), $__compilerTemp5) . '
							</span>
						</div>
						<dfn class="inputChoices-explain inputChoices-explain--before">' . 'You may leave the date empty to have this criteria match at the same time every day.' . '</dfn>
					', $__templater->formRadio(array(
		'name' => 'page_criteria[before][data][user_tz]',
		'value' => ($__vars['criteria']['before']['user_tz'] ? $__vars['criteria']['before']['user_tz'] : 0),
	), array(array(
		'value' => '1',
		'label' => 'Trong múi giờ của khách truy cập',
		'_type' => 'option',
	),
	array(
		'value' => '0',
		'label' => 'In the selected timezone' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'page_criteria[before][data][timezone]',
		'value' => ($__vars['criteria']['before']['timezone'] ? $__vars['criteria']['before']['timezone'] : $__vars['visitor']['timezone']),
	), $__compilerTemp6)),
		'_type' => 'option',
	)))),
		'_type' => 'option',
	)), array(
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'page_criteria[nodes][rule]',
		'value' => 'nodes',
		'selected' => $__vars['criteria']['nodes'],
		'label' => 'Page is Within Nodes' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'page_criteria[nodes][data][node_ids]',
		'multiple' => 'true',
		'value' => $__vars['criteria']['nodes']['node_ids'],
	), $__compilerTemp7), $__templater->formCheckBox(array(
	), array(array(
		'name' => 'page_criteria[nodes][data][node_only]',
		'value' => '1',
		'selected' => $__vars['criteria']['nodes']['node_only'],
		'label' => 'Only display within selected nodes (rather than including child nodes)',
		'_type' => 'option',
	)))),
		'_type' => 'option',
	)), array(
		'label' => 'Chuyên mục',
	)) . '

			<hr class="formRowSep" />

			' . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'page_criteria[style][rule]',
		'value' => 'style',
		'selected' => $__vars['criteria']['style'],
		'label' => 'User is browsing with the following style' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'page_criteria[style][data][style_id]',
		'value' => $__vars['criteria']['style']['style_id'],
	), $__compilerTemp8)),
		'_type' => 'option',
	),
	array(
		'name' => 'page_criteria[tab][rule]',
		'value' => 'tab',
		'selected' => $__vars['criteria']['tab'],
		'label' => 'Selected Navigation Tab is' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'page_criteria[tab][data][id]',
		'value' => $__vars['criteria']['tab']['id'],
		'dir' => 'ltr',
	))),
		'afterhint' => 'ID of selected navigation tab, such as <b>forums</b>, <b>members</b> or <b>help</b>.',
		'_type' => 'option',
	),
	array(
		'name' => 'page_criteria[controller][rule]',
		'value' => 'controller',
		'selected' => $__vars['criteria']['controller'],
		'label' => 'Controller and Action is' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->callMacro('helper_callback_fields', 'callback_fields', array(
		'className' => 'page_criteria[controller][data][name]',
		'methodName' => 'page_criteria[controller][data][action]',
		'classValue' => $__vars['criteria']['controller']['name'],
		'methodValue' => $__vars['criteria']['controller']['action'],
	), $__vars)),
		'afterhint' => 'Specify action name as <b>PersonalDetails</b>, not <b>actionPersonalDetails</b> or <b>personal-details</b>. You may leave the action blank to apply to all actions within the specified controller.',
		'_type' => 'option',
	),
	array(
		'name' => 'page_criteria[view][rule]',
		'value' => 'view',
		'selected' => $__vars['criteria']['view'],
		'label' => 'View Class is' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'page_criteria[view][data][name]',
		'value' => $__vars['criteria']['view']['name'],
		'dir' => 'ltr',
	))),
		'afterhint' => 'The name of the view class that rendered the current page.',
		'_type' => 'option',
	),
	array(
		'name' => 'page_criteria[template][rule]',
		'value' => 'template',
		'selected' => $__vars['criteria']['template'],
		'label' => 'Content Template is' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'page_criteria[template][data][name]',
		'value' => $__vars['criteria']['template']['name'],
		'dir' => 'ltr',
	))),
		'afterhint' => 'The name of the template specified in the controller response.',
		'_type' => 'option',
	)), array(
		'label' => 'Page Information',
	)) . '

			' . '
		</li>
	');
	$__finalCompiled .= '

	';
	if ($__vars['container']) {
		$__finalCompiled .= '
		<ul class="tabPanes">
			' . $__templater->filter($__vars['panes'], array(array('raw', array()),), true) . '
		</ul>
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['panes'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

' . '

';
	return $__finalCompiled;
});