<?php
// FROM HASH: a08cf322c8b26fc8de63dbcae3d8b33a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tìm từ khóa');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped('Từ khóa'), $__templater->fn('link', array('tags', ), false), array(
	));
	$__finalCompiled .= '

';
	$__templater->includeCss('tag.less');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->isTraversable($__vars['tabs'])) {
		foreach ($__vars['tabs'] AS $__vars['tabType'] => $__vars['tab']) {
			$__compilerTemp1 .= '
					<a href="' . $__templater->fn('link', array('search', null, array('type' => $__vars['tabType'], ), ), true) . '" class="tabs-tab' . (($__vars['type'] == $__vars['tabType']) ? ' is-active' : '') . '">' . $__templater->escape($__vars['tab']['title']) . '</a>
				';
		}
	}
	$__compilerTemp2 = '';
	if ($__vars['xf']['options']['enableTagging']) {
		$__compilerTemp2 .= '
					<a href="' . $__templater->fn('link', array('tags', ), true) . '" class="tabs-tab is-active">' . 'Tìm từ khóa' . '</a>
				';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<h2 class="block-tabHeader tabs hScroller" data-xf-init="h-scroller">
			<span class="hScroller-scroll">
				<a href="' . $__templater->fn('link', array('search', ), true) . '" class="tabs-tab">' . 'Tìm tất cả' . '</a>
				' . $__compilerTemp1 . '
				' . $__compilerTemp2 . '
			</span>
		</h2>
		<div class="block-body">
			' . $__templater->formTokenInputRow(array(
		'name' => 'tags',
		'value' => $__vars['tags'],
		'href' => $__templater->fn('link', array('misc/tag-auto-complete', ), false),
	), array(
		'label' => 'Từ khóa',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'search',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('tags', ), false),
		'class' => 'block',
		'ajax' => 'true',
	)) . '

';
	if ($__vars['tagCloud']) {
		$__finalCompiled .= '
	<div class="block">
		<div class="block-container">
			<h3 class="block-header">' . 'Từ khóa phổ biến' . '</h3>
			<div class="block-body block-row tagCloud">
			';
		if ($__templater->isTraversable($__vars['tagCloud'])) {
			foreach ($__vars['tagCloud'] AS $__vars['cloudEntry']) {
				$__finalCompiled .= '
				<a href="' . $__templater->fn('link', array('tags', $__vars['cloudEntry']['tag'], ), true) . '" class="tagCloud-tag tagCloud-tagLevel' . $__templater->escape($__vars['cloudEntry']['level']) . '">' . $__templater->escape($__vars['cloudEntry']['tag']['tag']) . '</a></li>
			';
			}
		}
		$__finalCompiled .= '
			</div>
		</div>
	</div>
';
	}
	return $__finalCompiled;
});