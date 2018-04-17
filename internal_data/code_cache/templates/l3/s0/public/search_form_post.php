<?php
// FROM HASH: cb9c6b1dbe8f933400e99f9a9adafdc7
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tìm chủ đề');
	$__finalCompiled .= '

' . $__templater->callMacro('search_form_macros', 'keywords', array(
		'input' => $__vars['input'],
	), $__vars) . '
' . $__templater->callMacro('search_form_macros', 'user', array(
		'input' => $__vars['input'],
	), $__vars) . '
' . $__templater->callMacro('search_form_macros', 'date', array(
		'input' => $__vars['input'],
	), $__vars) . '

' . $__templater->formNumberBoxRow(array(
		'name' => 'c[min_reply_count]',
		'value' => $__templater->filter($__vars['input']['c']['min_reply_count'], array(array('default', array(0, )),), false),
		'min' => '0',
	), array(
		'label' => 'Số lượt trả lời nhỏ nhất là',
	)) . '

';
	if (!$__templater->test($__vars['prefixesGrouped'], 'empty', array())) {
		$__finalCompiled .= '
	';
		$__compilerTemp1 = array(array(
			'value' => '',
			'label' => $__vars['xf']['language']['parenthesis_open'] . 'Tất cả' . $__vars['xf']['language']['parenthesis_close'],
			'_type' => 'option',
		));
		if ($__templater->isTraversable($__vars['prefixGroups'])) {
			foreach ($__vars['prefixGroups'] AS $__vars['groupId'] => $__vars['prefixGroup']) {
				if (($__templater->fn('count', array($__vars['prefixesGrouped'][$__vars['groupId']], ), false) > 0)) {
					$__compilerTemp1[] = array(
						'label' => $__templater->fn('prefix_group', array('thread', $__vars['groupId'], ), false),
						'_type' => 'optgroup',
						'options' => array(),
					);
					end($__compilerTemp1); $__compilerTemp2 = key($__compilerTemp1);
					if ($__templater->isTraversable($__vars['prefixesGrouped'][$__vars['groupId']])) {
						foreach ($__vars['prefixesGrouped'][$__vars['groupId']] AS $__vars['prefixId'] => $__vars['prefix']) {
							$__compilerTemp1[$__compilerTemp2]['options'][] = array(
								'value' => $__vars['prefixId'],
								'label' => $__templater->fn('prefix_title', array('thread', $__vars['prefixId'], ), true),
								'_type' => 'option',
							);
						}
					}
				}
			}
		}
		$__finalCompiled .= $__templater->formSelectRow(array(
			'name' => 'c[prefixes][]',
			'size' => '7',
			'multiple' => 'true',
			'value' => $__templater->filter($__vars['input']['c']['prefixes'], array(array('default', array(array(0, ), )),), false),
		), $__compilerTemp1, array(
			'label' => 'Tiền tố',
		)) . '
';
	}
	$__finalCompiled .= '

';
	$__compilerTemp3 = array(array(
		'value' => '',
		'label' => 'Tất cả diễn đàn',
		'_type' => 'option',
	));
	$__compilerTemp4 = $__templater->method($__vars['nodeTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp4)) {
		foreach ($__compilerTemp4 AS $__vars['treeEntry']) {
			$__compilerTemp3[] = array(
				'value' => $__vars['treeEntry']['record']['node_id'],
				'label' => $__templater->filter($__templater->fn('repeat', array('&nbsp;&nbsp;', $__vars['treeEntry']['depth'], ), false), array(array('raw', array()),), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formRow('

	<ul class="inputList">
		<li>' . $__templater->formSelect(array(
		'name' => 'c[nodes][]',
		'size' => '7',
		'multiple' => 'multiple',
		'value' => $__templater->filter($__vars['input']['c']['nodes'], array(array('default', array(array(0, ), )),), false),
	), $__compilerTemp3) . '</li>
		<li>' . $__templater->formCheckBox(array(
		'standalone' => 'true',
	), array(array(
		'name' => 'c[child_nodes]',
		'selected' => ((!$__vars['input']['c']) OR $__vars['input']['c']['child_nodes']),
		'label' => 'Tìm cả trong diễn đàn con',
		'_type' => 'option',
	))) . '</li>
	</ul>
', array(
		'rowtype' => 'input',
		'label' => 'Tìm trong diễn đàn',
	)) . '

' . $__templater->callMacro('search_form_macros', 'order', array(
		'isRelevanceSupported' => $__vars['isRelevanceSupported'],
		'options' => array('replies' => 'Nhiều trả lời nhất', ),
		'input' => $__vars['input'],
	), $__vars) . '

' . $__templater->callMacro('search_form_macros', 'grouped', array(
		'label' => 'Hiển thị kết quả dạng Chủ đề',
		'input' => $__vars['input'],
	), $__vars);
	return $__finalCompiled;
});