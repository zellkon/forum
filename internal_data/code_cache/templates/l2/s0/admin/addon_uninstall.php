<?php
// FROM HASH: 3cca502c783f29af106c25142fff16da
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Xác nhận hành động');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['addOn'], 'isLegacy', array())) {
		$__compilerTemp1 .= '
					<div class="blockMessage blockMessage--warning blockMessage--iconic">
						' . 'Gỡ cài đặt các tiện ích cũ có thể để lại dữ liệu rác. Nâng cấp tiện ích lên phiên bản tương thích trước khi gỡ cài đặt nếu có thể.' . '
					</div>
				';
	} else {
		$__compilerTemp1 .= '
					<div class="blockMessage blockMessage--important blockMessage--iconic">
						' . 'This will remove any data created by the add-on.' . '
					</div>
				';
	}
	$__finalCompiled .= $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Vui lòng xác nhận rằng bạn muốn gỡ cài đặt tiện ích sau đây' . $__vars['xf']['language']['label_separator'] . '
				<strong>' . $__templater->escape($__vars['addOn']['title']) . ' ' . $__templater->escape($__vars['addOn']['version_string']) . '</strong>
				' . $__compilerTemp1 . '
			', array(
		'rowtype' => 'confirm',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'submit' => 'Gỡ cài đặt',
		'icon' => 'delete',
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>

	' . $__templater->fn('redirect_input', array(null, null, true)) . '

', array(
		'action' => $__templater->fn('link', array('add-ons/uninstall', $__vars['addOn'], ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});