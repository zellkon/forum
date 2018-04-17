<?php
// FROM HASH: 041d2412e51c5ff3154d92bffbb10b58
return array('macros' => array('addon_list_filter' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="block">
		<div class="block-outer">
			';
	$__templater->includeJs(array(
		'src' => 'xf/filter.js',
		'min' => '1',
	));
	$__finalCompiled .= '
			<div class="block-outer-opposite quickFilter u-jsOnly"
				data-xf-init="filter"
				data-key="addOns"
				data-search-target=".addOnList"
				data-search-row=".addOnList-row"
				data-search-row-group=".block"
				data-search-limit=".js-filterSearchable"
				data-no-results-format="<div class=&quot;blockMessage js-filterNoResults&quot;>%s</div>">

				<div class="inputGroup inputGroup--inline inputGroup--joined">
					<input type="text" class="input js-filterInput" placeholder="' . 'Lọc' . $__vars['xf']['language']['ellipsis'] . '" />
					' . $__templater->formCheckBox(array(
		'standalone' => 'true',
	), array(array(
		'labelclass' => 'inputGroup-text',
		'class' => 'js-filterPrefix',
		'label' => 'Tiền tố',
		'_type' => 'option',
	))) . '
					<i class="inputGroup-text js-filterClear is-disabled" aria-hidden="true"></i>
				</div>
			</div>
		</div>
	</div>
';
	return $__finalCompiled;
},
'addon_list_block' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'addOns' => '!',
		'heading' => '!',
		'desc' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if (!$__templater->test($__vars['addOns'], 'empty', array())) {
		$__finalCompiled .= '
		<div class="block">
			<div class="block-container">
				<h3 class="block-header">
					' . $__templater->escape($__vars['heading']) . '
					';
		if ($__vars['desc']) {
			$__finalCompiled .= '
						<span class="block-desc">
							' . $__templater->escape($__vars['desc']) . '
						</span>
					';
		}
		$__finalCompiled .= '
				</h3>
				<ol class="block-body">
					';
		if ($__templater->isTraversable($__vars['addOns'])) {
			foreach ($__vars['addOns'] AS $__vars['addOn']) {
				$__finalCompiled .= '
						' . $__templater->callMacro(null, 'addon_list_item', array(
					'addOn' => $__vars['addOn'],
				), $__vars) . '
					';
			}
		}
		$__finalCompiled .= '
				</ol>
			</div>
		</div>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'addon_list_item' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'addOn' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__templater->includeCss('addon_list.less');
	$__finalCompiled .= '

	<li class="block-row block-row--separated addOnList-row' . (($__templater->method($__vars['addOn'], 'isInstalled', array()) AND (!$__vars['addOn']['active'])) ? ' is-disabled' : '') . '">
		<div class="contentRow">
			' . $__templater->callMacro(null, 'addon_list_item_icon', array(
		'addOn' => $__vars['addOn'],
	), $__vars) . '
			<div class="contentRow-main">
				' . $__templater->callMacro(null, 'addon_list_item_menu', array(
		'addOn' => $__vars['addOn'],
	), $__vars) . '
				<h3 class="contentRow-header js-filterSearchable">
					' . $__templater->escape($__vars['addOn']['title']) . ' <span class="contentRow-muted">' . $__templater->escape($__vars['addOn']['version_string']) . '</span>
				</h3>
				<div class="contentRow-lesser js-filterSearchable' . ((!$__vars['addOn']['description']) ? ' no-description' : '') . '">
					' . ($__vars['addOn']['description'] ? $__templater->filter($__templater->fn('snippet', array($__vars['addOn']['description'], 200, ), false), array(array('nl2br', array()),), true) : '&nbsp;') . '
				</div>
				' . $__templater->callMacro(null, 'addon_list_item_footer', array(
		'addOn' => $__vars['addOn'],
	), $__vars) . '
			</div>
		</div>
	</li>
';
	return $__finalCompiled;
},
'addon_list_item_icon' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'addOn' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="contentRow-figure">
		<div class="contentRow-figureIcon">
			';
	if ($__templater->method($__vars['addOn'], 'hasFaIcon', array())) {
		$__finalCompiled .= '
				<i class="fa ' . $__templater->escape($__vars['addOn']['icon']) . ' fa-3x" aria-hidden="true"></i>
			';
	} else if ($__templater->method($__vars['addOn'], 'hasIcon', array())) {
		$__finalCompiled .= '
				<img src="' . $__templater->fn('link', array('add-ons/icon', $__vars['addOn'], ), true) . '" alt="' . $__templater->escape($__vars['addOn']['title']) . '" />
			';
	} else if ($__templater->method($__vars['addOn'], 'isLegacy', array())) {
		$__finalCompiled .= '
				<i class="fa fa-question-circle fa-3x" aria-hidden="true"></i>
			';
	} else {
		$__finalCompiled .= '
				<i class="fa fa-puzzle-piece fa-3x" aria-hidden="true"></i>
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
';
	return $__finalCompiled;
},
'addon_list_item_menu' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'addOn' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="contentRow-extra">
		';
	if ($__templater->method($__vars['addOn'], 'canUpgrade', array())) {
		$__finalCompiled .= '
			' . $__templater->button('
				' . 'Upgrade' . '
			', array(
			'href' => $__templater->fn('link', array('add-ons/upgrade', $__vars['addOn'], ), false),
			'overlay' => 'true',
		), '', array(
		)) . '
		';
	} else if ($__templater->method($__vars['addOn'], 'canInstall', array())) {
		$__finalCompiled .= '
			' . $__templater->button('
				' . 'Cài đặt' . '
			', array(
			'href' => $__templater->fn('link', array('add-ons/install', $__vars['addOn'], ), false),
			'overlay' => 'true',
		), '', array(
		)) . '
		';
	}
	$__finalCompiled .= '
		';
	if ($__templater->method($__vars['addOn'], 'isInstalled', array())) {
		$__finalCompiled .= '
			' . $__templater->button('
				<i class="fa fa-cog" aria-hidden="true"></i>
			', array(
			'class' => 'button--link menuTrigger',
			'data-xf-click' => 'menu',
			'aria-label' => 'Thêm tùy chọn',
			'aria-expanded' => 'false',
			'aria-haspopup' => 'true',
		), '', array(
		)) . '
			<div class="menu" data-menu="menu" aria-hidden="true"
				data-href="' . $__templater->fn('link', array('add-ons/controls', $__vars['addOn'], ), true) . '"
				data-load-target=".js-controlsMenuBody">
				<div class="menu-content">
					<div class="js-controlsMenuBody">
						<div class="menu-row">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
					</div>
				</div>
			</div>
		';
	}
	$__finalCompiled .= '
	</div>
';
	return $__finalCompiled;
},
'addon_list_item_footer' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'addOn' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="contentRow-minor">
		<ul class="listInline listInline--bullet">
			';
	if ($__templater->method($__vars['addOn'], 'isInstalled', array()) AND (!$__templater->method($__vars['addOn'], 'canUpgrade', array()))) {
		$__finalCompiled .= '
				';
		if ($__templater->method($__vars['addOn'], 'isLegacy', array())) {
			$__finalCompiled .= '
					<li class="addOnList-row-noSearch">
						<span class="label label--red" data-xf-init="tooltip"
							title="' . $__templater->filter('Tiện ích lỗi thời không thể kích hoạt', array(array('for_attr', array()),), true) . '">
							' . 'Tích ích lỗi thời' . '
						</span>
					</li>
				';
		} else if ($__templater->method($__vars['addOn'], 'hasMissingFiles', array())) {
			$__finalCompiled .= '
					<li class="addOnList-row-noSearch">
						<span class="label label--red" data-xf-init="tooltip"
							title="' . $__templater->filter('Some files or directories for this add-on are missing (' . $__templater->filter($__vars['addOn']['missing_files'], array(array('join', array(', ', )),), false) . '). Please re-upload all add-on files.', array(array('for_attr', array()),), true) . '">
							' . 'Missing files' . '
						</span>
					</li>
				';
		} else if (!$__templater->method($__vars['addOn'], 'isFileVersionValid', array())) {
			$__finalCompiled .= '
					<li class="addOnList-row-noSearch">
						<span class="label label--primary" data-xf-init="tooltip"
							title="' . $__templater->filter('Các tập tin tiện ích dường như không đúng phiên bản. Vui lòng tải lại các tập tin chính xác.', array(array('for_attr', array()),), true) . '">
							' . 'Version mismatch' . '
						</span>
					</li>
				';
		} else if ($__templater->method($__vars['addOn'], 'hasPendingChanges', array())) {
			$__finalCompiled .= '
					<li class="addOnList-row-noSearch">
						<span class="label label--primary" data-xf-init="tooltip"
							title="' . $__templater->filter('This add-on has pending metadata changes. Please sync or rebuild to import these changes.', array(array('for_attr', array()),), true) . '">
							' . 'Pending changes' . '
						</span>
					</li>
				';
		}
		$__finalCompiled .= '
			';
	}
	$__finalCompiled .= '
			';
	if ($__vars['addOn']['dev'] OR $__vars['addOn']['dev_url']) {
		$__finalCompiled .= '
				<li>
					';
		if ($__vars['addOn']['dev'] AND $__vars['addOn']['dev_url']) {
			$__finalCompiled .= '
						<span class="addOnList-row-noSearch">' . 'Developer' . $__vars['xf']['language']['label_separator'] . '</span> <a href="' . $__templater->escape($__vars['addOn']['dev_url']) . '" target="_blank">' . $__templater->escape($__vars['addOn']['dev']) . '</a>
					';
		} else if ($__vars['addOn']['dev']) {
			$__finalCompiled .= '
						<span class="addOnList-row-noSearch">' . 'Developer' . $__vars['xf']['language']['label_separator'] . '</span> ' . $__templater->escape($__vars['addOn']['dev']) . '
					';
		} else if ($__vars['addOn']['dev_url']) {
			$__finalCompiled .= '
						<span class="addOnList-row-noSearch">' . 'Developer' . $__vars['xf']['language']['label_separator'] . '</span> <a href="' . $__templater->escape($__vars['addOn']['dev_url']) . '" target="_blank">' . $__templater->escape($__vars['addOn']['dev_url']) . '</a>
					';
		}
		$__finalCompiled .= '
				</li>
			';
	}
	$__finalCompiled .= '
			';
	if ($__vars['addOn']['faq_url']) {
		$__finalCompiled .= '
				<li><a href="' . $__templater->escape($__vars['addOn']['faq_url']) . '" target="_blank">' . 'FAQ' . '</a></li>
			';
	}
	$__finalCompiled .= '
			';
	if ($__vars['addOn']['support_url']) {
		$__finalCompiled .= '
				<li><a href="' . $__templater->escape($__vars['addOn']['support_url']) . '" target="_blank">' . 'Support' . '</a></li>
			';
	}
	$__finalCompiled .= '
			';
	if (!$__templater->test($__vars['addOn']['extra_urls'], 'empty', array())) {
		$__finalCompiled .= '
				';
		if ($__templater->isTraversable($__vars['addOn']['extra_urls'])) {
			foreach ($__vars['addOn']['extra_urls'] AS $__vars['text'] => $__vars['url']) {
				$__finalCompiled .= '
					<li><a href="' . $__templater->escape($__vars['url']) . '" target="_blank">' . $__templater->escape($__vars['text']) . '</a></li>
				';
			}
		}
		$__finalCompiled .= '
			';
	}
	$__finalCompiled .= '
		</ul>
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

' . '

' . '

' . '

';
	return $__finalCompiled;
});