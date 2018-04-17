<?php
// FROM HASH: 37f677d2f5c1851600da8831f057b03e
return array('macros' => array('file_check_list' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'fileChecks' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = '';
	$__vars['i'] = 0;
	if ($__templater->isTraversable($__vars['fileChecks'])) {
		foreach ($__vars['fileChecks'] AS $__vars['fileCheck']) {
			$__vars['i']++;
			$__compilerTemp1 .= '
			';
			$__compilerTemp2 = '';
			if ($__vars['fileCheck']['check_state'] == 'success') {
				$__compilerTemp2 .= '
						' . 'Hoàn thành' . '
					';
			} else if ($__vars['fileCheck']['check_state'] == 'failure') {
				$__compilerTemp2 .= '
						' . 'Failed' . '
					';
			} else if ($__vars['fileCheck']['check_state'] == 'pending') {
				$__compilerTemp2 .= '
						' . 'Chờ xử lý' . '
					';
			}
			$__compilerTemp3 = array(array(
				'_type' => 'cell',
				'html' => '
					' . $__templater->fn('date_dynamic', array($__vars['fileCheck']['check_date'], array(
			))) . '
				',
			)
,array(
				'_type' => 'cell',
				'html' => '
					' . $__compilerTemp2 . '
				',
			));
			if ($__vars['fileCheck']['check_state'] == 'pending') {
				$__compilerTemp3[] = array(
					'_type' => 'cell',
					'html' => 'N/A',
				);
				$__compilerTemp3[] = array(
					'_type' => 'cell',
					'html' => 'N/A',
				);
				$__compilerTemp3[] = array(
					'_type' => 'cell',
					'html' => 'N/A',
				);
				$__compilerTemp3[] = array(
					'_type' => 'action',
					'html' => '',
				);
			} else {
				$__compilerTemp3[] = array(
					'_type' => 'cell',
					'html' => $__templater->filter($__vars['fileCheck']['total_missing'], array(array('number', array()),), true),
				);
				$__compilerTemp3[] = array(
					'_type' => 'cell',
					'html' => $__templater->filter($__vars['fileCheck']['total_inconsistent'], array(array('number', array()),), true),
				);
				$__compilerTemp3[] = array(
					'_type' => 'cell',
					'html' => $__templater->filter($__vars['fileCheck']['total_checked'], array(array('number', array()),), true),
				);
				$__compilerTemp3[] = array(
					'href' => $__templater->fn('link', array('tools/file-check/results', $__vars['fileCheck'], ), false),
					'_type' => 'action',
					'html' => 'Xem',
				);
			}
			$__compilerTemp1 .= $__templater->dataRow(array(
				'rowclass' => (($__vars['i'] == 1) ? 'dataList-row--highlighted' : ''),
			), $__compilerTemp3) . '
		';
		}
	}
	$__finalCompiled .= $__templater->dataList('
		' . $__templater->dataRow(array(
		'rowtype' => 'header',
	), array(array(
		'_type' => 'cell',
		'html' => 'Ngày kiểm tra',
	),
	array(
		'_type' => 'cell',
		'html' => 'Tình trạng kiểm tra',
	),
	array(
		'_type' => 'cell',
		'html' => 'Lỗi',
	),
	array(
		'_type' => 'cell',
		'html' => 'Nội dung không mong muốn',
	),
	array(
		'_type' => 'cell',
		'html' => 'Tổng số đã kiểm tra',
	),
	array(
		'_type' => 'cell',
		'html' => ' ',
	))) . '

		' . $__compilerTemp1 . '
	', array(
		'data-xf-init' => 'responsive-data-list',
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Kiểm tra độ an toàn của tập tin');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('<p>Hệ thống này sẽ quét các tệp của cài đặt XenForo của bạn
và xác định bất kỳ tệp nào bị thiếu hoặc có nội dung
không khớp với các nội dung dự kiến cho tệp đó.</p>
				
<p>Có thể hữu ích để kiểm tra nhanh chóng rằng tất cả các tệp đã được tải lên đúng.</p>
			
<p>Nhấp vào nút <b>' . 'Tiến hành' . '</b> dưới đây để chạy thử nghiệm.</p>', array(
		'rowtype' => 'close',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Tiến hành' . $__vars['xf']['language']['ellipsis'],
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('tools/file-check', ), false),
		'class' => 'block',
	)) . '

';
	if (!$__templater->test($__vars['fileChecks'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block">
		<div class="block-container">
			<h3 class="block-header">' . 'Kết quả kiểm tra tập tin' . '</h3>
			<div class="block-body">
				' . $__templater->callMacro(null, 'file_check_list', array(
			'fileChecks' => $__vars['fileChecks'],
		), $__vars) . '
			</div>
			<div class="block-footer">
				<span class="block-footer-counter">' . $__templater->fn('display_totals', array($__vars['fileChecks'], $__vars['total'], ), true) . '</span>
			</div>
		</div>
		' . $__templater->fn('page_nav', array(array(
			'page' => $__vars['page'],
			'total' => $__vars['total'],
			'link' => 'tools/file-check',
			'wrapperclass' => 'block-outer block-outer--after',
			'perPage' => $__vars['perPage'],
		))) . '
	</div>
';
	}
	$__finalCompiled .= '

';
	return $__finalCompiled;
});