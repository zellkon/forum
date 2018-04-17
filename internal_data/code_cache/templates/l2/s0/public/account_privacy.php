<?php
// FROM HASH: fad33792e0905efbafc70f895eaa5e7d
return array('macros' => array('privacy_option' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
		'name' => '!',
		'label' => '!',
		'hideEveryone' => false,
		'hideFollowed' => false,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<dl class="inputLabelPair">
		<dt>' . $__templater->escape($__vars['label']) . '</dt>
		<dd>
			';
	$__compilerTemp1 = array();
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
	if (!$__vars['hideFollowed']) {
		$__compilerTemp1[] = array(
			'value' => 'followed',
			'label' => 'Theo dõi',
			'_type' => 'option',
		);
	}
	$__compilerTemp1[] = array(
		'value' => 'none',
		'label' => 'Không một ai',
		'_type' => 'option',
	);
	$__finalCompiled .= $__templater->formSelect(array(
		'name' => 'privacy[' . $__vars['name'] . ']',
		'value' => $__vars['user']['Privacy'][$__vars['name']],
	), $__compilerTemp1) . '
		</dd>
	</dl>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Bảo mật cá nhân');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewProfilePosts', array())) {
		$__compilerTemp1 .= '
					' . $__templater->callMacro(null, 'privacy_option', array(
			'user' => $__vars['xf']['visitor'],
			'name' => 'allow_post_profile',
			'label' => 'Đăng tin nhắn trong trang hồ sơ cá nhân' . $__vars['xf']['language']['label_separator'],
			'hideEveryone' => true,
		), $__vars) . '
				';
	}
	$__compilerTemp2 = '';
	if ($__vars['xf']['options']['enableNewsFeed']) {
		$__compilerTemp2 .= '
					' . $__templater->callMacro(null, 'privacy_option', array(
			'user' => $__vars['xf']['visitor'],
			'name' => 'allow_receive_news_feed',
			'label' => 'Nhận luồng tin của bạn' . $__vars['xf']['language']['label_separator'],
		), $__vars) . '
				';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->callMacro('helper_account', 'activity_privacy_row', array(), $__vars) . '
			' . $__templater->callMacro('helper_account', 'dob_privacy_row', array(), $__vars) . '

			' . $__templater->formRow('

				' . $__templater->callMacro(null, 'privacy_option', array(
		'user' => $__vars['xf']['visitor'],
		'name' => 'allow_view_profile',
		'label' => 'Xem chi tiết của bạn trong trang hồ sơ' . $__vars['xf']['language']['label_separator'],
	), $__vars) . '

				' . $__compilerTemp1 . '

				' . $__compilerTemp2 . '

				' . $__templater->callMacro(null, 'privacy_option', array(
		'user' => $__vars['xf']['visitor'],
		'name' => 'allow_send_personal_conversation',
		'label' => 'Bắt đầu đối thoại với bạn' . $__vars['xf']['language']['label_separator'],
		'hideEveryone' => true,
	), $__vars) . '

				' . $__templater->callMacro(null, 'privacy_option', array(
		'user' => $__vars['xf']['visitor'],
		'name' => 'allow_view_identities',
		'label' => 'Xem danh tính của bạn' . $__vars['xf']['language']['label_separator'],
	), $__vars) . '
			', array(
		'rowtype' => 'inputLabelPair noColon',
		'label' => 'Cho phép thành viên' . $__vars['xf']['language']['ellipsis'],
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('account/privacy', ), false),
		'ajax' => 'true',
		'class' => 'block',
		'data-force-flash-message' => 'true',
	)) . '

';
	return $__finalCompiled;
});