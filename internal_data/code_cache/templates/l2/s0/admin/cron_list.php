<?php
// FROM HASH: 1f6fd7672e97e87d81bc679c09023d6b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Cron Entries');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Thêm mục nhập cron', array(
		'href' => $__templater->fn('link', array('cron/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['entries'], 'empty', array())) {
		$__finalCompiled .= '
	';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['entries'])) {
			foreach ($__vars['entries'] AS $__vars['cron']) {
				$__compilerTemp1 .= '
						';
				$__compilerTemp2 = '';
				if ($__vars['cron']['active']) {
					$__compilerTemp2 .= '
										';
					if (((!$__vars['cron']['addon_id']) OR $__vars['cron']['AddOn']['active'])) {
						$__compilerTemp2 .= '
											' . (('Next Run' . ': ') . $__templater->fn('date_time', array($__vars['cron']['next_run'], ), true)) . '
										';
					} else {
						$__compilerTemp2 .= '
											' . 'This cron entry is associated with an inactive add-on. It cannot be run unless the add-on is activated.' . '
										';
					}
					$__compilerTemp2 .= '
									';
				}
				$__compilerTemp3 = array(array(
					'hash' => $__vars['cron']['entry_id'],
					'href' => $__templater->fn('link', array('cron/edit', $__vars['cron'], ), false),
					'label' => $__templater->escape($__vars['cron']['title']),
					'hint' => (($__vars['cron']['addon_id'] != 'XF') ? $__templater->escape($__vars['cron']['AddOn']['title']) : ''),
					'explain' => '
									' . $__compilerTemp2 . '
								',
					'_type' => 'main',
					'html' => '',
				)
,array(
					'name' => 'active[' . $__vars['cron']['entry_id'] . ']',
					'selected' => $__vars['cron']['active'],
					'class' => 'dataList-cell--separated',
					'submit' => 'true',
					'tooltip' => 'Enable / Disable \'' . $__vars['cron']['title'] . '\'',
					'_type' => 'toggle',
					'html' => '',
				));
				if (((!$__vars['cron']['addon_id']) OR $__vars['cron']['AddOn']['active'])) {
					$__compilerTemp3[] = array(
						'href' => $__templater->fn('link', array('cron/run', $__vars['cron'], ), false),
						'overlay' => 'true',
						'data-xf-init' => 'tooltip',
						'title' => $__templater->filter('Run now', array(array('for_attr', array()),), false),
						'class' => 'dataList-cell--iconic',
						'_type' => 'action',
						'html' => '
									<i class="fa fa-refresh"></i>',
					);
				} else {
					$__compilerTemp3[] = array(
						'_type' => 'action',
						'html' => '',
					);
				}
				$__compilerTemp3[] = array(
					'href' => $__templater->fn('link', array('cron/delete', $__vars['cron'], ), false),
					'_type' => 'delete',
					'html' => '',
				);
				$__compilerTemp1 .= $__templater->dataRow(array(
				), $__compilerTemp3) . '
					';
			}
		}
		$__finalCompiled .= $__templater->form('
		<div class="block-outer">
			' . $__templater->callMacro('filter_macros', 'quick_filter', array(
			'key' => 'cron',
			'class' => 'block-outer-opposite',
		), $__vars) . '
		</div>
		<div class="block-container">
			<div class="block-body">
				' . $__templater->dataList('
					' . $__compilerTemp1 . '
				', array(
		)) . '
			</div>
			<div class="block-footer">
				<span class="block-footer-counter">' . $__templater->fn('display_totals', array($__vars['entries'], ), true) . '</span>
			</div>
		</div>
	', array(
			'action' => $__templater->fn('link', array('cron/toggle', ), false),
			'class' => 'block',
			'ajax' => 'true',
		)) . '
';
	} else {
		$__finalCompiled .= '
	<div class="blockMessage">' . 'Chưa có mục nào được tạo ra.' . '</div>
';
	}
	return $__finalCompiled;
});