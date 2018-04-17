<?php
// FROM HASH: 8ceecf10c4fbbbe7b6a654eb2e807634
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tùy chọn');
	$__finalCompiled .= '

';
	if ($__vars['canAdd']) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Thêm Nhóm Tùy chọn', array(
			'href' => $__templater->fn('link', array('options/groups/add', ), false),
			'icon' => 'add',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

<div class="block">
	<div class="block-outer">
		' . $__templater->callMacro('filter_macros', 'quick_filter', array(
		'key' => 'options',
		'class' => 'block-outer-opposite',
	), $__vars) . '
	</div>
	<div class="block-container">
		<div class="block-body">
			';
	$__compilerTemp1 = '';
	if ($__templater->isTraversable($__vars['groups'])) {
		foreach ($__vars['groups'] AS $__vars['group']) {
			$__compilerTemp1 .= '
					';
			$__compilerTemp2 = array();
			if ($__templater->method($__vars['group'], 'canEdit', array())) {
				$__compilerTemp2[] = array(
					'href' => $__templater->fn('link', array('options/groups/edit', $__vars['group'], ), false),
					'_type' => 'action',
					'html' => 'Sửa',
				);
			}
			$__compilerTemp1 .= $__templater->dataRow(array(
				'label' => $__templater->escape($__vars['group']['title']),
				'href' => $__templater->fn('link', array('options/groups', $__vars['group'], ), false),
				'explain' => $__templater->escape($__vars['group']['description']),
				'delete' => ($__templater->method($__vars['group'], 'canEdit', array()) ? $__templater->fn('link', array('options/groups/delete', $__vars['group'], ), false) : false),
				'hash' => $__vars['group']['group_id'],
			), $__compilerTemp2) . '
				';
		}
	}
	$__finalCompiled .= $__templater->dataList('
				' . $__compilerTemp1 . '
			', array(
	)) . '
		</div>
		<div class="block-footer">
			<span class="block-footer-counter">' . $__templater->fn('display_totals', array($__vars['groups'], ), true) . '</span>
		</div>
	</div>
</div>';
	return $__finalCompiled;
});