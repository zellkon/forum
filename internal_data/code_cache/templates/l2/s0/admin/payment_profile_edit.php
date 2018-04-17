<?php
// FROM HASH: a309057a94c4b7f2dfc26b0a0b2d4f2c
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['profile'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm tài khoản thanh toán' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['provider']['title']));
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa tài khoản thanh toán' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['provider']['title']) . ' - ' . $__templater->escape($__vars['profile']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['profile'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('payment-profiles/delete', $__vars['profile'], ), false),
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
		'name' => 'title',
		'value' => $__vars['profile']['title'],
		'maxlength' => $__templater->fn('max_length', array($__vars['profile'], 'title', ), false),
	), array(
		'label' => 'Tiêu đề',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'display_title',
		'value' => $__vars['profile']['display_title'],
		'maxlength' => $__templater->fn('max_length', array($__vars['profile'], 'display_title', ), false),
	), array(
		'label' => 'Tiêu đề hiển thị',
		'explain' => 'Nhập tên cho tài khoản thanh toán này để được hiển thị cho thành viên khi thanh toán với tài khoản này. Nếu không nhập tiêu đề, tiêu đề tài khoản ở trên sẽ được sử dụng thay thế.',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->filter($__templater->method($__vars['provider'], 'renderConfig', array($__vars['profile'], )), array(array('raw', array()),), true) . '

			' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
		</div>
	</div>

	' . $__templater->formHiddenVal('provider_id', $__vars['provider']['provider_id'], array(
	)) . '
', array(
		'action' => $__templater->fn('link', array('payment-profiles/save', $__vars['profile'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});