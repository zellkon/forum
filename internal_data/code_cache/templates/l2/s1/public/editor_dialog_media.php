<?php
// FROM HASH: e9e4d6fe9f3ca34be62fd370f8efe88f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chèn video');
	$__finalCompiled .= '

<form class="block" id="editor_media_form">
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'id' => 'editor_media_url',
		'type' => 'url',
	), array(
		'label' => 'Nhập vào đường dẫn',
	)) . '

			';
	$__compilerTemp1 = '';
	if ($__templater->isTraversable($__vars['sites'])) {
		foreach ($__vars['sites'] AS $__vars['siteId'] => $__vars['site']) {
			$__compilerTemp1 .= '
						<li><a href="' . $__templater->escape($__vars['site']['site_url']) . '" target="_blank">' . $__templater->escape($__vars['site']['site_title']) . '</a></li>
					';
		}
	}
	$__finalCompiled .= $__templater->formRow('

				<ul class="listInline listInline--comma u-smaller">
					' . $__compilerTemp1 . '
				</ul>
				<div class="formRow-explain">
					<a href="' . $__templater->fn('link', array('help', array('page_name' => 'bb-codes', ), ), true) . '#media" target="_blank">' . 'Trợ giúp' . '</a>
				</div>
			', array(
		'label' => 'Trang web được chấp thuận',
		'hint' => 'Bạn có thể chèn đa phương tiện từ những nguồn này',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Xem tiếp',
		'id' => 'editor_media_submit',
	), array(
	)) . '
	</div>
</form>
';
	return $__finalCompiled;
});