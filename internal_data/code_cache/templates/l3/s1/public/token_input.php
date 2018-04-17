<?php
// FROM HASH: c3d804ee798dd56f74cbc272faa97504
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('select2.less');
	$__finalCompiled .= '

';
	$__templater->includeJs(array(
		'prod' => 'xf/token_input-compiled.js',
		'dev' => 'vendor/select2/select2.full.min.js, xf/token_input.js',
	));
	$__finalCompiled .= '

<input type="text" name="' . $__templater->escape($__vars['name']) . '" value="' . $__templater->escape($__vars['value']) . '" class="input" data-xf-init="token-input" data-ac-url="' . $__templater->escape($__vars['hrefAttr']) . '" style="' . $__templater->escape($__vars['styleAttr']) . '"' . ($__vars['minLength'] ? ((' data-min-length="' . $__templater->escape($__vars['minLength'])) . '"') : '') . ($__vars['maxLength'] ? ((' data-max-length="' . $__templater->escape($__vars['maxLength'])) . '"') : '') . ($__vars['maxTokens'] ? ((' data-max-tokens="' . $__templater->escape($__vars['maxTokens'])) . '"') : '') . ' ' . $__templater->filter($__vars['attrsHtml'], array(array('raw', array()),), true) . ' />

';
	$__templater->inlineJs('
jQuery.extend(XF.phrases, {
	s2_error_loading: "' . $__templater->filter('The results could not be loaded.', array(array('escape', array('js', )),), false) . '",
	s2_input_too_long: "' . $__templater->filter('Please delete {count} character/s.', array(array('escape', array('js', )),), false) . '",
	s2_input_too_short: "' . $__templater->filter('Vui lòng nhập {count} ký tự trở lên.', array(array('escape', array('js', )),), false) . '",
	s2_loading_more: "' . $__templater->filter('Loading more results...', array(array('escape', array('js', )),), false) . '",
	s2_maximum_selected: "' . $__templater->filter('You can only select {count} item/s.', array(array('escape', array('js', )),), false) . '",
	s2_no_results: "' . $__templater->filter('No results found.', array(array('escape', array('js', )),), false) . '",
	s2_searching: "' . $__templater->filter('Đang tìm...', array(array('escape', array('js', )),), false) . '"
});
');
	return $__finalCompiled;
});