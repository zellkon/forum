<?php
// FROM HASH: 3f42b3918f28ed3c500b0fcdeed80d0a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tiện ích');
	$__finalCompiled .= '

';
	$__templater->includeCss('addon_list.less');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['disabled']) {
		$__compilerTemp1 .= '
		' . $__templater->button('
			' . 'Kích hoạt' . '
		', array(
			'href' => $__templater->fn('link', array('add-ons/mass-toggle', null, array('enable' => 1, ), ), false),
			'overlay' => 'true',
			'data-cache' => '0',
		), '', array(
		)) . '
	';
	}
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__compilerTemp1 . '
	' . $__templater->button('
		' . 'Vô hiệu hóa tất cả' . '
	', array(
		'href' => $__templater->fn('link', array('add-ons/mass-toggle', null, array('enable' => 0, ), ), false),
		'overlay' => 'true',
		'data-cache' => '0',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

' . $__templater->callMacro('addon_list_macros', 'addon_list_filter', array(), $__vars) . '

';
	if ($__vars['total']) {
		$__finalCompiled .= '
	<div class="addOnList">
		' . '
		' . $__templater->callMacro('addon_list_macros', 'addon_list_block', array(
			'addOns' => $__vars['upgradeable'],
			'heading' => 'Upgradeable add-ons',
		), $__vars) . '
		' . '
		' . $__templater->callMacro('addon_list_macros', 'addon_list_block', array(
			'addOns' => $__vars['installable'],
			'heading' => 'Tiện ích có thể cài đặt',
		), $__vars) . '
		' . '
		' . $__templater->callMacro('addon_list_macros', 'addon_list_block', array(
			'addOns' => $__vars['installed'],
			'heading' => 'Tiện ích đã cài đặt',
		), $__vars) . '
		' . '
		' . $__templater->callMacro('addon_list_macros', 'addon_list_block', array(
			'addOns' => $__vars['legacy'],
			'heading' => 'Tiện ích cũ',
			'desc' => 'Tiện ích bổ sung cũ chỉ tương thích với các phiên bản cũ hơn của XenForo. Chúng đang ở trạng thái không hoạt động và sẽ không được kích hoạt lại cho đến khi chúng được nâng cấp. Việc gỡ cài đặt các tiện ích cũ sẽ để lại dữ liệu rác.',
		), $__vars) . '
		' . '
	</div>
';
	} else {
		$__finalCompiled .= '
	<div class="blockMessage">' . 'Không có tiện ích nào được cài đặt hoặc sẵn sàng để cài đặt.' . '</div>
';
	}
	return $__finalCompiled;
});