<?php
// FROM HASH: 717a9209a18d63f13ccd4622c05a06ff
return array('macros' => array('privacy_select' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'name' => '!',
		'label' => '!',
		'user' => '!',
		'hideEveryone' => false,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = array(array(
		'value' => 'none',
		'label' => 'Không một ai',
		'_type' => 'option',
	));
	if (!$__vars['hideEveryone']) {
		$__compilerTemp1[] = array(
			'value' => 'everyone',
			'label' => 'Tất cả khách thăm',
			'_type' => 'option',
		);
	}
	$__compilerTemp1[] = array(
		'value' => 'members',
		'label' => 'Chỉ từ thành viên',
		'_type' => 'option',
	);
	$__compilerTemp1[] = array(
		'value' => 'followed',
		'label' => 'Người theo dõi ' . ($__vars['user']['username'] ? $__templater->escape($__vars['user']['username']) : (('[' . 'Thành viên') . ']')) . '',
		'_type' => 'option',
	);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'privacy[' . $__vars['name'] . ']',
		'value' => $__vars['user']['Privacy'][$__vars['name']],
	), $__compilerTemp1, array(
		'label' => $__templater->escape($__vars['label']),
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['user'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm thành viên');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa thành viên' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['user']['username']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['user'], 'isUpdate', array())) {
		$__compilerTemp1 = '';
		if ($__vars['user']['is_banned']) {
			$__compilerTemp1 .= '
					<a href="' . $__templater->fn('link', array('banning/users/lift', $__vars['user'], ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Bỏ cấm túc' . '</a>
				';
		} else if ((!$__vars['user']['is_moderator']) AND (!$__vars['user']['is_admin'])) {
			$__compilerTemp1 .= '
					<a href="' . $__templater->fn('link', array('banning/users/add', $__vars['user'], ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Cấm thành viên' . '</a>
				';
		}
		$__compilerTemp2 = '';
		if ((!$__vars['user']['is_moderator']) AND (!$__vars['user']['is_admin'])) {
			$__compilerTemp2 .= '
					<a href="' . $__templater->fn('link', array('users/merge', $__vars['user'], ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Merge with User' . '</a>
					<a href="' . $__templater->fn('link', array('users/delete-conversations', $__vars['user'], ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Xóa cuộc trò chuyện' . '</a>
				';
		}
		$__compilerTemp3 = '';
		if ((!$__vars['user']['is_super_admin']) AND $__vars['xf']['options']['editHistory']['enabled']) {
			$__compilerTemp3 .= '
					<a href="' . $__templater->fn('link', array('users/revert-message-edit', $__vars['user'], ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Revert Message Edits' . '</a>
				';
		}
		$__compilerTemp4 = '';
		if (!$__vars['user']['is_super_admin']) {
			$__compilerTemp4 .= '
					<a href="' . $__templater->fn('link', array('users/remove-likes', $__vars['user'], ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Xóa lượt thích' . '</a>
				';
		}
		$__compilerTemp5 = '';
		if ($__templater->method($__vars['user'], 'isAwaitingEmailConfirmation', array())) {
			$__compilerTemp5 .= '
					<a href="' . $__templater->fn('link', array('users/resend-confirmation', $__vars['user'], ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Gửi lại xác nhận tài khoản' . '</a>
				';
		}
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	<div>
		' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('users/delete', $__vars['user'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '

		' . $__templater->button('Hành động', array(
			'class' => 'menuTrigger',
			'data-xf-click' => 'menu',
			'aria-expanded' => 'false',
			'aria-haspopup' => 'true',
		), '', array(
		)) . '
		<div class="menu" data-menu="menu" aria-hidden="true">
			<div class="menu-content">
				<h3 class="menu-header">' . 'Hành động' . '</h3>
				' . '
				<a href="' . $__templater->fn('link_type', array('public', 'members', $__vars['user'], ), true) . '" class="menu-linkRow" target="_blank">' . 'Xem hồ sơ' . '</a>

				' . $__compilerTemp1 . '

				' . $__compilerTemp2 . '

				' . $__compilerTemp3 . '

				' . $__compilerTemp4 . '

				<a href="' . $__templater->fn('link', array('users/manage-watched-threads', $__vars['user'], ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Quản lý các chủ để quan tâm' . '</a>

				' . $__compilerTemp5 . '
				' . '
			</div>
		</div>
	</div>
');
	}
	$__finalCompiled .= '

';
	if ($__vars['success']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--success blockMessage--iconic">' . 'Thay đổi của bạn đã được lưu.' . '</div>
';
	}
	$__finalCompiled .= '

<div class="block">
	';
	if ($__vars['user']['user_id']) {
		$__finalCompiled .= '
	';
		$__compilerTemp6 = '';
		$__compilerTemp6 .= '
				' . '
				';
		if ($__vars['user']['is_admin']) {
			$__compilerTemp6 .= '
					<li><a href="' . $__templater->fn('link', array('admins/edit', $__vars['user'], ), true) . '">' . ($__vars['user']['is_super_admin'] ? 'Quản trị viên cấp cao' : 'Administrator') . '</a></li>
				';
		}
		$__compilerTemp6 .= '
				';
		if ($__vars['user']['is_moderator']) {
			$__compilerTemp6 .= '
					<li><a href="' . $__templater->fn('link', array('moderators', ), true) . '">' . 'Quản trị' . '</a></li>
				';
		}
		$__compilerTemp6 .= '
				';
		if ($__vars['user']['Option']['is_discouraged']) {
			$__compilerTemp6 .= '
					<li>' . 'Discouraged' . '</li>
				';
		}
		$__compilerTemp6 .= '
				';
		if ($__vars['user']['is_banned']) {
			$__compilerTemp6 .= '
					<li><a href="' . $__templater->fn('link', array('banning/users/lift', $__vars['user'], ), true) . '" data-xf-click="overlay">' . 'Đã bị cấm túc' . '</a></li>
				';
		}
		$__compilerTemp6 .= '
				' . '
			';
		if (strlen(trim($__compilerTemp6)) > 0) {
			$__finalCompiled .= '
		<div class="block-outer">
			<ul class="listInline listInline--bullet">
			' . $__compilerTemp6 . '
			</ul>
		</div>
	';
		}
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

	';
	$__compilerTemp7 = '';
	if ($__vars['user']['is_super_admin']) {
		$__compilerTemp7 .= '
			<div class="block-body">
				' . $__templater->formTextBoxRow(array(
			'name' => 'visitor_password',
			'type' => 'password',
		), array(
			'label' => 'Mật khẩu của bạn',
			'explain' => 'Bạn phải nhập mật khẩu hiện tại để hợp thức hóa yêu cầu này.',
		)) . '
			</div>
		';
	}
	$__compilerTemp8 = '';
	if ($__vars['user']['user_id']) {
		$__compilerTemp8 .= '
					<a class="tabs-tab" role="tab" tabindex="0" aria-controls="user-extras">' . 'Thêm' . '</a>
					<a class="tabs-tab" role="tab" tabindex="0" aria-controls="user-ips">' . 'Địa chỉ IP' . '</a>
					<a class="tabs-tab" role="tab" tabindex="0" aria-controls="user-changes">' . 'Lịch sử thay đổi' . '</a>
				';
	}
	$__compilerTemp9 = '';
	if ($__templater->method($__vars['user'], 'exists', array())) {
		$__compilerTemp9 .= '
						' . $__templater->formRadioRow(array(
			'name' => 'change_password',
		), array(array(
			'value' => '',
			'checked' => 'checked',
			'label' => 'Không thay đổi',
			'_type' => 'option',
		),
		array(
			'value' => 'generate',
			'label' => 'Gửi khôi phục mật khẩu',
			'hint' => 'Xác nhận khôi phục mật khẩu sẽ được gửi qua email tới thành viên và họ sẽ không thể đăng nhập cho đến khi họ đặt mật khẩu mới.',
			'_type' => 'option',
		),
		array(
			'value' => 'change',
			'label' => 'Đặt mật khẩu mới' . $__vars['xf']['language']['label_separator'],
			'_dependent' => array($__templater->formTextBox(array(
			'name' => 'password',
			'autocomplete' => 'off',
		))),
			'_type' => 'option',
		)), array(
			'label' => 'Mật khẩu',
		)) . '
					';
	} else {
		$__compilerTemp9 .= '
						' . $__templater->formTextBoxRow(array(
			'name' => 'password',
			'autocomplete' => 'off',
		), array(
			'label' => 'Mật khẩu',
		)) . '
					';
	}
	$__compilerTemp10 = '';
	if ($__vars['user']['user_id']) {
		$__compilerTemp10 .= '
						';
		$__compilerTemp11 = '';
		if ($__vars['user']['Option']['use_tfa']) {
			$__compilerTemp11 .= '
								<ul class="inputChoices">
									<li class="inputChoices-choice inputChoices-plainChoice">' . 'Đã bật' . '</li>
									<li class="inputChoices-choice">' . $__templater->formCheckBox(array(
				'standalone' => 'true',
			), array(array(
				'name' => 'disable_tfa',
				'label' => 'Vô hiệu hóa xác minh hai bước',
				'_type' => 'option',
			))) . '</li>
								</ul>
							';
		} else {
			$__compilerTemp11 .= '
								' . 'Tắt' . '
							';
		}
		$__compilerTemp10 .= $__templater->formRow('
							' . $__compilerTemp11 . '
						', array(
			'label' => 'Xác minh 2 bước',
		)) . '

						' . $__templater->formRow('
							' . $__templater->fn('avatar', array($__vars['user'], 's', false, array(
			'href' => $__templater->fn('link', array('users/avatar', $__vars['user'], ), false),
			'data-xf-click' => 'overlay',
		))) . '
							<a href="' . $__templater->fn('link', array('users/avatar', $__vars['user'], ), true) . '" data-xf-click="overlay">' . 'Sửa ảnh đại diện' . '</a>
						', array(
			'label' => 'Ảnh đại diện',
		)) . '
						' . $__templater->formRow('
							' . $__templater->fn('date_dynamic', array($__vars['user']['register_date'], array(
		))) . '
						', array(
			'label' => 'Tham gia',
		)) . '
						';
		if ($__vars['user']['last_activity']) {
			$__compilerTemp10 .= '
							' . $__templater->formRow('
								' . $__templater->fn('date_dynamic', array($__vars['user']['last_activity'], array(
			))) . '
							', array(
				'label' => 'Hoạt động cuối',
			)) . '
						';
		}
		$__compilerTemp10 .= '
					';
	}
	$__compilerTemp12 = '';
	if ($__vars['user']['user_id']) {
		$__compilerTemp12 .= '
							';
		if (!$__vars['user']['is_moderator']) {
			$__compilerTemp12 .= '<a href="' . $__templater->fn('link', array('moderators', ), true) . '">' . 'Đặt thành viên này làm kiểm duyệt viên' . '</a>';
		}
		$__compilerTemp12 .= '
							';
		if ((!$__vars['user']['is_admin']) AND (!$__vars['user']['is_moderator'])) {
			$__compilerTemp12 .= '/';
		}
		$__compilerTemp12 .= '
							';
		if (!$__vars['user']['is_admin']) {
			$__compilerTemp12 .= '<a href="' . $__templater->fn('link', array('admins', ), true) . '">' . 'Đặt thành viên này làm quản trị viên' . '</a>';
		}
		$__compilerTemp12 .= '
						';
	}
	$__vars['_userChangesHtml'] = $__templater->preEscaped('
						' . $__compilerTemp12 . '
					');
	$__compilerTemp13 = $__templater->mergeChoiceOptions(array(), $__vars['userGroups']);
	$__compilerTemp14 = $__templater->mergeChoiceOptions(array(), $__vars['userGroups']);
	$__compilerTemp15 = array(array(
		'value' => '0',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'Dùng giao diện mặc định' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	$__compilerTemp16 = $__templater->method($__vars['styleTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp16)) {
		foreach ($__compilerTemp16 AS $__vars['treeEntry']) {
			$__compilerTemp15[] = array(
				'value' => $__vars['treeEntry']['record']['style_id'],
				'label' => $__templater->fn('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp17 = array();
	$__compilerTemp18 = $__templater->method($__vars['languageTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp18)) {
		foreach ($__compilerTemp18 AS $__vars['treeEntry']) {
			$__compilerTemp17[] = array(
				'value' => $__vars['treeEntry']['record']['language_id'],
				'label' => $__templater->fn('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . '
								' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp19 = $__templater->mergeChoiceOptions(array(), $__vars['timeZones']);
	$__compilerTemp20 = '';
	if ($__vars['user']['user_id']) {
		$__compilerTemp20 .= '
				<li data-href="' . $__templater->fn('link', array('users/extra', $__vars['user'], ), true) . '" role="tabpanel" id="user-extras">
					<div class="block-body block-row">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
				</li>
			';
	}
	$__compilerTemp21 = '';
	if ($__vars['user']['user_id']) {
		$__compilerTemp21 .= '
				<li data-href="' . $__templater->fn('link', array('users/user-ips', $__vars['user'], ), true) . '" role="tabpanel" id="user-ips">
					<div class="block-body block-row">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
				</li>
			';
	}
	$__compilerTemp22 = '';
	if ($__vars['user']['user_id']) {
		$__compilerTemp22 .= '
				<li data-href="' . $__templater->fn('link', array('users/change-log', $__vars['user'], ), true) . '" role="tabpanel" id="user-changes">
					<div class="block-body block-row">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
				</li>
			';
	}
	$__finalCompiled .= $__templater->form('
		' . $__compilerTemp7 . '

		<h2 class="block-tabHeader tabs hScroller" data-xf-init="tabs h-scroller" role="tablist">
			<span class="hScroller-scroll">
				' . '
				<a class="tabs-tab is-active" role="tab" tabindex="0" aria-controls="user-details">' . 'Chi tiết thành viên' . '</a>
				' . $__compilerTemp8 . '
				' . '
			</span>
		</h2>

		<ul class="tabPanes">
			' . '
			<li class="is-active" role="tabpanel" id="user-details">
				<div class="block-body">
					' . $__templater->formTextBoxRow(array(
		'name' => 'user[username]',
		'value' => $__vars['user']['username'],
		'maxlength' => $__templater->fn('max_length', array($__vars['user'], 'username', ), false),
	), array(
		'label' => 'Tên thành viên',
	)) . '

					' . $__templater->formTextBoxRow(array(
		'name' => 'user[email]',
		'value' => $__vars['user']['email'],
		'type' => 'email',
		'dir' => 'ltr',
		'maxlength' => $__templater->fn('max_length', array($__vars['user'], 'email', ), false),
	), array(
		'label' => 'Email',
	)) . '

					' . $__compilerTemp9 . '

					' . $__compilerTemp10 . '

					<hr class="formRowSep" />

					' . '' . '

					' . $__templater->formSelectRow(array(
		'name' => 'user[user_group_id]',
		'value' => $__vars['user']['user_group_id'],
	), $__compilerTemp13, array(
		'label' => 'Nhóm thành viên',
		'explain' => $__templater->filter($__vars['_userChangesHtml'], array(array('raw', array()),), true),
	)) . '

					' . $__templater->formCheckBoxRow(array(
		'name' => 'user[secondary_group_ids]',
		'value' => $__vars['user']['secondary_group_ids'],
		'listclass' => 'listColumns',
	), $__compilerTemp14, array(
		'label' => 'Nhóm thành viên phụ',
	)) . '

					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user[is_staff]',
		'selected' => $__vars['user']['is_staff'],
		'label' => 'Hiển thị thành viên là BQT',
		'hint' => 'Nếu chọn, thành viên này sẽ được liệt kê công khai như một quản trị viên.',
		'_type' => 'option',
	)), array(
	)) . '

					' . $__templater->formSelectRow(array(
		'name' => 'user[user_state]',
		'value' => $__vars['user']['user_state'],
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
	)), array(
		'label' => 'Trạng thái thành viên',
	)) . '

					<hr class="formRowSep" />

					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'option[is_discouraged]',
		'selected' => $__vars['user']['Option']['is_discouraged'],
		'explain' => 'Discouraged users are subjected to annoying random delays and failures in system behavior, designed to \'encourage\' them to go away and troll some other site.',
		'label' => 'Discouraged',
		'_type' => 'option',
	)), array(
		'explain' => '<a href="' . $__templater->fn('link', array('banning/discouraged-ips', ), true) . '">' . 'Alternatively, you may use IP-based discouragement.' . '</a>',
	)) . '
				</div>

				<h3 class="block-formSectionHeader">
					<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
						<span class="block-formSectionHeader-aligner">' . 'Chi tiết cá nhân' . '</span>
					</span>
				</h3>
				<div class="block-body block-body--collapsible">
					' . $__templater->callMacro('public:helper_user_dob_edit', 'dob_edit', array(
		'dobData' => $__vars['user']['Profile'],
	), $__vars) . '

					<hr class="formRowSep" />

					' . $__templater->formTextBoxRow(array(
		'name' => 'profile[location]',
		'value' => $__vars['user']['Profile']['location_'],
	), array(
		'label' => 'Nơi ở',
	)) . '
					' . $__templater->formTextBoxRow(array(
		'name' => 'profile[website]',
		'value' => $__vars['user']['Profile']['website_'],
		'type' => 'url',
		'dir' => 'ltr',
	), array(
		'label' => 'Website',
	)) . '
					' . $__templater->callMacro('public:custom_fields_macros', 'custom_fields_edit', array(
		'type' => 'users',
		'group' => 'personal',
		'set' => $__vars['user']['Profile']['custom_fields'],
		'editMode' => 'admin',
	), $__vars) . '
					' . $__templater->formTextAreaRow(array(
		'name' => 'profile[about]',
		'value' => $__vars['user']['Profile']['about_'],
		'autosize' => 'true',
	), array(
		'label' => 'Giới thiệu',
		'hint' => 'Bạn có thể sử dụng BBCode',
	)) . '
				</div>

				<h3 class="block-formSectionHeader">
					<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
						<span class="block-formSectionHeader-aligner">' . 'Thông tin hồ sơ' . '</span>
					</span>
				</h3>
				<div class="block-body block-body--collapsible">
					' . $__templater->formTextBoxRow(array(
		'name' => 'user[custom_title]',
		'value' => $__vars['user']['custom_title_'],
		'maxlength' => $__templater->fn('max_length', array($__vars['user'], 'custom_title', ), false),
	), array(
		'label' => 'Tiêu đề riêng',
	)) . '
					' . $__templater->formTextAreaRow(array(
		'name' => 'profile[signature]',
		'value' => $__vars['user']['Profile']['signature_'],
		'autosize' => 'true',
	), array(
		'label' => 'Chữ ký',
		'hint' => 'Bạn có thể sử dụng BBCode',
	)) . '

					<hr class="formRowSep" />

					' . $__templater->formNumberBoxRow(array(
		'name' => 'user[message_count]',
		'value' => $__vars['user']['message_count'],
		'min' => '0',
	), array(
		'label' => 'Bài viết',
	)) . '
					' . $__templater->formNumberBoxRow(array(
		'name' => 'user[like_count]',
		'value' => $__vars['user']['like_count'],
		'min' => '0',
	), array(
		'label' => 'Đã được thích',
	)) . '
					' . $__templater->formNumberBoxRow(array(
		'name' => 'user[trophy_points]',
		'value' => $__vars['user']['trophy_points'],
		'min' => '0',
	), array(
		'label' => 'Điểm thành tích',
	)) . '
				</div>

				<h3 class="block-formSectionHeader">
					<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
						<span class="block-formSectionHeader-aligner">' . 'Liên hệ bổ sung' . '</span>
					</span>
				</h3>
				<div class="block-body block-body--collapsible">
					' . $__templater->callMacro('public:custom_fields_macros', 'custom_fields_edit', array(
		'type' => 'users',
		'group' => 'contact',
		'set' => $__vars['user']['Profile']['custom_fields'],
		'editMode' => 'admin',
	), $__vars) . '
				</div>

				<h3 class="block-formSectionHeader">
					<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
						<span class="block-formSectionHeader-aligner">' . 'Tùy chọn' . '</span>
					</span>
				</h3>
				<div class="block-body block-body--collapsible">
					' . $__templater->formSelectRow(array(
		'name' => 'user[style_id]',
		'value' => $__vars['user']['style_id'],
	), $__compilerTemp15, array(
		'label' => 'Giao diện',
	)) . '

					<hr class="formRowSep" />

					' . $__templater->formSelectRow(array(
		'name' => 'user[language_id]',
		'value' => $__vars['user']['language_id'],
	), $__compilerTemp17, array(
		'label' => 'Ngôn ngữ',
	)) . '

					' . $__templater->formSelectRow(array(
		'name' => 'user[timezone]',
		'value' => $__vars['user']['timezone'],
	), $__compilerTemp19, array(
		'label' => 'Múi giờ',
	)) . '

					<hr class="formRowSep" />

					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'option[content_show_signature]',
		'selected' => $__vars['user']['Option']['content_show_signature'],
		'label' => '
							' . 'Hiển thị chữ ký với tin nhắn',
		'_type' => 'option',
	),
	array(
		'name' => 'option[email_on_conversation]',
		'selected' => $__vars['user']['Option']['email_on_conversation'],
		'label' => '
							' . 'Nhận email khi có tin nhắn đối thoại mới',
		'_type' => 'option',
	)), array(
	)) . '

					' . $__templater->formSelectRow(array(
		'name' => 'option[creation_watch_state]',
		'value' => $__vars['user']['Option']['creation_watch_state'],
	), array(array(
		'value' => 'watch_no_email',
		'label' => 'Có',
		'_type' => 'option',
	),
	array(
		'value' => 'watch_email',
		'label' => 'Có, với email',
		'_type' => 'option',
	),
	array(
		'value' => '',
		'label' => 'Không',
		'_type' => 'option',
	)), array(
		'label' => 'Theo dõi chủ đề đã tạo',
	)) . '

					' . $__templater->formSelectRow(array(
		'name' => 'option[interaction_watch_state]',
		'value' => $__vars['user']['Option']['interaction_watch_state'],
	), array(array(
		'value' => 'watch_no_email',
		'label' => 'Có',
		'_type' => 'option',
	),
	array(
		'value' => 'watch_email',
		'label' => 'Có, với email',
		'_type' => 'option',
	),
	array(
		'value' => '',
		'label' => 'Không',
		'_type' => 'option',
	)), array(
		'label' => 'Theo dõi chủ đề đã tương tác',
	)) . '

					' . $__templater->callMacro('public:custom_fields_macros', 'custom_fields_edit', array(
		'type' => 'users',
		'group' => 'preferences',
		'set' => $__vars['user']['Profile']['custom_fields'],
		'editMode' => 'admin',
	), $__vars) . '
				</div>

				<h3 class="block-formSectionHeader">
					<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
						<span class="block-formSectionHeader-aligner">' . 'Bảo mật cá nhân' . '</span>
					</span>
				</h3>
				<div class="block-body block-body--collapsible">
					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user[visible]',
		'selected' => $__vars['user']['visible'],
		'label' => '
							' . 'Trạng thái online' . '
						',
		'_type' => 'option',
	),
	array(
		'name' => 'user[activity_visible]',
		'selected' => $__vars['user']['activity_visible'],
		'label' => '
							' . 'Hiển thị hoạt động hiện tại' . '
						',
		'_type' => 'option',
	),
	array(
		'name' => 'option[receive_admin_email]',
		'selected' => $__vars['user']['Option']['receive_admin_email'],
		'label' => '
							' . 'Nhận thông báo từ diễn đàn' . '
						',
		'_type' => 'option',
	),
	array(
		'name' => 'option[show_dob_date]',
		'selected' => $__vars['user']['Option']['show_dob_date'],
		'label' => '
							' . 'Hiển thị ngày và tháng sinh' . '
						',
		'_type' => 'option',
	),
	array(
		'name' => 'option[show_dob_year]',
		'selected' => $__vars['user']['Option']['show_dob_year'],
		'label' => '
							' . 'Hiển thị năm sinh' . '
						',
		'_type' => 'option',
	)), array(
		'label' => 'Bảo mật chung',
	)) . '

					<hr class="formRowSep" />

					' . '
					' . $__templater->callMacro(null, 'privacy_select', array(
		'name' => 'allow_view_profile',
		'label' => 'Xem chi tiết trang tiểu sử của thành viên này',
		'user' => $__vars['user'],
	), $__vars) . '

					' . '
					' . $__templater->callMacro(null, 'privacy_select', array(
		'name' => 'allow_post_profile',
		'label' => 'Đăng nội dung trên trang hồ sơ của thành viên này',
		'user' => $__vars['user'],
		'hideEveryone' => true,
	), $__vars) . '

					' . '
					' . $__templater->callMacro(null, 'privacy_select', array(
		'name' => 'allow_receive_news_feed',
		'label' => 'Nhận luồng tin của thành viên này',
		'user' => $__vars['user'],
	), $__vars) . '

					<hr class="formRowSep" />

					' . '
					' . $__templater->callMacro(null, 'privacy_select', array(
		'name' => 'allow_send_personal_conversation',
		'label' => 'Tạo các cuộc trò chuyện với thành viên này',
		'user' => $__vars['user'],
		'hideEveryone' => true,
	), $__vars) . '

					' . '
					' . $__templater->callMacro(null, 'privacy_select', array(
		'name' => 'allow_view_identities',
		'label' => 'Xem thông tin nhận dạng của thành viên này',
		'user' => $__vars['user'],
	), $__vars) . '
				</div>

				' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
			</li>

			' . $__compilerTemp20 . '

			' . $__compilerTemp21 . '

			' . $__compilerTemp22 . '
			' . '
		</ul>
	', array(
		'action' => $__templater->fn('link', array('users/save', $__vars['user'], ), false),
		'ajax' => 'true',
		'class' => 'block-container',
		'novalidate' => 'novalidate',
	)) . '
</div>

';
	return $__finalCompiled;
});