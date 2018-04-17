<?php
// FROM HASH: fa1a8f3a59e3124e5134f560ef52208c
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['page'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm trang');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit Page' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['node']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['page'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('pages/delete', $__vars['node'], ), false),
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
			' . $__templater->callMacro('node_edit_macros', 'node_name', array(
		'node' => $__vars['node'],
		'optional' => false,
	), $__vars) . '

			' . $__templater->callMacro('node_edit_macros', 'title', array(
		'node' => $__vars['node'],
	), $__vars) . '
			' . $__templater->callMacro('node_edit_macros', 'description', array(
		'node' => $__vars['node'],
	), $__vars) . '
			' . $__templater->callMacro('node_edit_macros', 'position', array(
		'node' => $__vars['node'],
		'nodeTree' => $__vars['nodeTree'],
	), $__vars) . '
			' . $__templater->callMacro('node_edit_macros', 'navigation', array(
		'node' => $__vars['node'],
		'navChoices' => $__vars['navChoices'],
	), $__vars) . '

			' . $__templater->formCodeEditorRow(array(
		'name' => 'template',
		'value' => ($__templater->method($__vars['page'], 'isUpdate', array()) ? $__vars['page']['MasterTemplate']['template'] : ''),
		'mode' => 'html',
		'class' => 'codeEditor--short',
	), array(
		'hint' => ($__templater->method($__vars['page'], 'isUpdate', array()) ? $__templater->escape($__templater->method($__vars['page'], 'getTemplateName', array())) : ''),
		'label' => 'Template HTML',
		'explain' => 'Bạn có thể sử dụng cú pháp mẫu XenForo ở đây',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'log_visits',
		'selected' => $__vars['page']['log_visits'],
		'label' => 'Đăng nhập và đếm lượt truy cập vào trang này',
		'_type' => 'option',
	),
	array(
		'name' => 'list_siblings',
		'selected' => $__vars['page']['list_siblings'],
		'label' => 'List Sibling Nodes',
		'_type' => 'option',
	),
	array(
		'name' => 'list_children',
		'selected' => $__vars['page']['list_children'],
		'label' => 'List Child Nodes',
		'_type' => 'option',
	)), array(
		'rowclass' => 'surplusLabel',
		'label' => 'Optional Components',
	)) . '

			' . $__templater->formRow('

				' . $__templater->callMacro('helper_callback_fields', 'callback_fields', array(
		'data' => $__vars['page'],
	), $__vars) . '
			', array(
		'rowtype' => 'input',
		'label' => 'Hàm PHP',
		'explain' => 'You may optionally specify a PHP callback here in order to fetch more data or alter the controller response for your page.<br />
<br />
Callback arguments:
<ol>
	<li><code>XenForo_ControllerPublic_Abstract $controller</code><br />The controller instance. From this you can inspect the request, response etc.</li>
	<li><code>XenForo_ControllerResponse_Abstract &$response</code><br />The standard response from the page controller.</li>
</ol>',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'advanced_mode',
		'value' => '1',
		'selected' => $__vars['page']['advanced_mode'],
		'label' => 'Advanced mode',
		'hint' => 'If enabled, the HTML for your page will not be contained within a block.',
		'_type' => 'option',
	)), array(
	)) . '

			' . $__templater->callMacro('node_edit_macros', 'style', array(
		'node' => $__vars['node'],
		'styleTree' => $__vars['styleTree'],
	), $__vars) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>

', array(
		'action' => $__templater->fn('link', array('pages/save', $__vars['node'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});