<?php
// FROM HASH: abfa3f7eb8f176ac9a97bd58caf576c7
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Template Modification Log');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['modification']['Logs'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block">
		<div class="block-container">
			<div class="block-body">
				';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['modification']['Logs'])) {
			foreach ($__vars['modification']['Logs'] AS $__vars['log']) {
				$__compilerTemp1 .= '
						';
				$__compilerTemp2 = '';
				if ($__vars['log']['Template']['style_id']) {
					$__compilerTemp2 .= $__templater->escape($__vars['log']['Template']['Style']['title']);
				} else {
					$__compilerTemp2 .= 'Master Style';
				}
				$__compilerTemp3 = array(array(
					'_type' => 'cell',
					'html' => $__templater->escape($__vars['log']['Template']['title']),
				)
,array(
					'_type' => 'cell',
					'html' => $__compilerTemp2,
				));
				if ($__vars['log']['status'] == 'ok') {
					$__compilerTemp3[] = array(
						'_type' => 'cell',
						'html' => 'OK',
					);
					$__compilerTemp3[] = array(
						'_type' => 'cell',
						'html' => $__templater->escape($__vars['log']['apply_count']),
					);
				} else {
					$__compilerTemp4 = '';
					if ($__vars['log']['status'] == 'error_compile') {
						$__compilerTemp4 .= 'Compiler error (may be from another template modification)' . '
										';
						if ($__vars['log']['status'] == 'error_invalid_regex') {
						}
						$__compilerTemp4 .= 'Invalid regular expression' . '
										';
						if ($__vars['log']['status'] == 'error_unknown_action') {
						}
						$__compilerTemp4 .= 'Unknown action' . '
										';
						if ($__vars['log']['status'] == 'error_invalid_callback') {
						}
						$__compilerTemp4 .= 'Invalid callback' . '
										';
						if ($__vars['log']['status'] == 'error_callback_failed') {
						}
						$__compilerTemp4 .= 'Callback failed' . '
									';
					}
					$__compilerTemp3[] = array(
						'_type' => 'cell',
						'html' => '
									' . $__compilerTemp4 . '
								',
					);
					$__compilerTemp3[] = array(
						'_type' => 'cell',
						'html' => '-',
					);
				}
				$__compilerTemp1 .= $__templater->dataRow(array(
				), $__compilerTemp3) . '
					';
			}
		}
		$__finalCompiled .= $__templater->dataList('
					' . $__templater->dataRow(array(
			'rowtype' => 'header',
		), array(array(
			'_type' => 'cell',
			'html' => 'Template',
		),
		array(
			'_type' => 'cell',
			'html' => 'Giao diện',
		),
		array(
			'_type' => 'cell',
			'html' => 'Trạng thái',
		),
		array(
			'_type' => 'cell',
			'html' => 'Apply Count',
		))) . '
					' . $__compilerTemp1 . '
				', array(
			'data-xf-init' => 'responsive-data-list',
		)) . '
			</div>
		</div>
	</div>
';
	} else {
		$__finalCompiled .= '
	<div class="blockMessage">' . 'This template modification does not match any templates.' . '</div>
';
	}
	return $__finalCompiled;
});