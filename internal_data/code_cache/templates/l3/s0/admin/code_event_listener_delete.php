<?php
// FROM HASH: b4f1de46613449181a2b6fbb1a1a7401
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Xác nhận hành động');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['listener']['AddOn']) {
		$__compilerTemp1 .= '
						' . $__templater->fn('parens', array(('Tiện ích' . $__vars['xf']['language']['label_separator'] . ' ') . $__vars['listener']['AddOn']['title'], ), true) . '
					';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Vui lòng xác nhận rằng bạn muốn xóa những điều sau' . $__vars['xf']['language']['label_separator'] . '
				<strong><a href="' . $__templater->fn('link', array('code-events/listeners/edit', $__vars['listener'], ), true) . '">' . $__templater->escape($__vars['listener']['event_id']) . '</a>
					' . $__compilerTemp1 . '
				</strong>
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
		'action' => $__templater->fn('link', array('code-events/listeners/delete', $__vars['listener'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});