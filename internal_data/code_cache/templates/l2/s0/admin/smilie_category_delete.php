<?php
// FROM HASH: a1a517b60a21fae8433f7a5e1e9177ae
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Xác nhận hành động');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Vui lòng xác nhận rằng bạn muốn xóa những điều sau' . $__vars['xf']['language']['label_separator'] . '
				<strong><a href="' . $__templater->fn('link', array('smilie-categories/edit', $__vars['smilieCategory'], ), true) . '">' . $__templater->escape($__vars['smilieCategory']['title']) . '</a></strong>
				<div class="blockMessage blockMessage--important blockMessage--iconic">' . 'Bất kỳ biểu tượng mặt cười nào thuộc loại này sẽ không được phân loại sau khi xóa.' . '</div>
			', array(
		'rowtype' => 'confirm',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'delete',
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('smilie-categories/delete', $__vars['smilieCategory'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});