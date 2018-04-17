<?php
// FROM HASH: a90a80f25e64734a443fb3f35fa6c76e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['trophy'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm danh hiệu');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa danh hiệu' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['trophy']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['trophy'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('trophies/delete', $__vars['trophy'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<h2 class="block-tabHeader tabs hScroller" data-xf-init="h-scroller tabs" role="tablist">
			<span class="hScroller-scroll">
				<a class="tabs-tab is-active" role="tab" tabindex="0" aria-controls="trophy-options">' . 'Tùy chọn danh hiệu' . '</a>
				' . $__templater->callMacro('helper_criteria', 'user_tabs', array(
		'userTabTitle' => $__templater->filter('Nhận danh hiệu này nếu...', array(array('for_attr', array()),), false),
	), $__vars) . '
			</span>
		</h2>

		<ul class="block-body tabPanes">
			<li class="is-active" role="tabpanel" id="trophy-options">
				' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => ($__vars['trophy']['trophy_id'] ? $__vars['trophy']['MasterTitle']['phrase_text'] : ''),
	), array(
		'label' => 'Tiêu đề',
	)) . '

				' . $__templater->formNumberBoxRow(array(
		'name' => 'trophy_points',
		'value' => $__vars['trophy']['trophy_points'],
		'min' => '0',
	), array(
		'label' => 'Điểm thành tích',
		'explain' => 'Những điểm này có thể được sử dụng để theo dõi sự tiến triển và thay đổi cấp bậc của thành viên.',
	)) . '

				' . $__templater->formTextAreaRow(array(
		'name' => 'description',
		'value' => ($__vars['trophy']['trophy_id'] ? $__vars['trophy']['MasterDescription']['phrase_text'] : ''),
		'autosize' => 'true',
	), array(
		'label' => 'Mô tả',
		'hint' => 'Bạn có thể sử dụng HTML',
		'explain' => 'Tùy chọn mô tả danh hiệu và tiêu chí mà thành viên cần đáp ứng để được trao giải.',
	)) . '
			</li>

			' . $__templater->callMacro('helper_criteria', 'user_panes', array(
		'criteria' => $__templater->method($__vars['userCriteria'], 'getCriteriaForTemplate', array()),
		'data' => $__templater->method($__vars['userCriteria'], 'getExtraTemplateData', array()),
	), $__vars) . '
		</ul>

		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('trophies/save', $__vars['trophy'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});