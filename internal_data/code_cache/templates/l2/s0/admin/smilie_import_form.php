<?php
// FROM HASH: 37fa2ffb5f4c5776c57342132358dc50
return array('macros' => array('smilie' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, true);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'smilie' => '!',
		'i' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = '';
	if ($__vars['smilie']['sprite_mode']) {
		$__compilerTemp1 .= '
				<img src="' . $__templater->fn('transparent_img', array(), true) . '" alt="" class="smilie smilie--sprite" style="' . $__templater->escape($__templater->method($__vars['smilie'], 'getSpriteCss', array())) . '" />
			';
	} else {
		$__compilerTemp1 .= '
				<img src="' . $__templater->escape($__vars['smilie']['image_url']) . '" class="smilie" alt="" />
			';
	}
	$__finalCompiled .= $__templater->formRow('
		<div>
			' . $__compilerTemp1 . '
		</div>
		' . $__templater->formCheckBox(array(
		'standalone' => 'true',
	), array(array(
		'name' => 'import[]',
		'value' => $__vars['i'],
		'selected' => true,
		'data-xf-init' => 'disabler',
		'data-hide' => 'true',
		'data-container' => '.js-importSmilie' . $__vars['i'],
		'label' => '
				' . 'Import this Smilie' . '
			',
		'_type' => 'option',
	))) . '
	', array(
	)) . '

	<div class="js-importSmilie' . $__templater->escape($__vars['i']) . '">
		<hr class="formRowSep" />

		' . $__templater->formTextBoxRow(array(
		'name' => 'smilies[' . $__vars['i'] . '][title]',
		'value' => $__vars['smilie']['title'],
	), array(
		'label' => 'Tiêu đề',
	)) . '

		' . $__templater->formTextAreaRow(array(
		'name' => 'smilies[' . $__vars['i'] . '][smilie_text]',
		'value' => $__vars['smilie']['smilie_text'],
		'autosize' => 'true',
	), array(
		'label' => 'Văn bản thay thế',
	)) . '

		';
	if ($__vars['uploadMode']) {
		$__finalCompiled .= '
			<h3 class="block-formSectionHeader">
				<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target=".js-importSmilie' . $__templater->escape($__vars['i']) . 'Advanced">
					<span class="block-formSectionHeader-aligner">' . 'Thêm tùy chọn' . '</span>
				</span>
			</h3>
		';
	}
	$__finalCompiled .= '

		<div class="js-importSmilie' . $__templater->escape($__vars['i']) . 'Advanced ' . ($__vars['uploadMode'] ? 'u-hidden u-hidden--transition' : '') . '">

			';
	if (!$__vars['uploadMode']) {
		$__finalCompiled .= '
				<hr class="formRowSep" />
			';
	}
	$__finalCompiled .= '

			' . $__templater->formTextBoxRow(array(
		'name' => 'smilies[' . $__vars['i'] . '][image_url]',
		'value' => $__vars['smilie']['image_url'],
	), array(
		'label' => 'URL hình ảnh thay thế',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'smilies[' . $__vars['i'] . '][image_url_2x]',
		'value' => $__vars['smilie']['image_url_2x'],
	), array(
		'label' => 'URL 2x hình ảnh thay thế',
		'hint' => 'Tùy chọn (không bắt buộc)',
		'explain' => 'Nếu được cung cấp, hình ảnh 2x sẽ được tự động hiển thị thay vì URL hình ảnh ở trên trên các thiết bị có khả năng hiển thị độ phân giải pixel cao hơn.<br />
<br />
<strong>Lưu ý: Tùy chọn này không có hiệu lực khi kích hoạt chế độ sprite.</strong>',
	)) . '

			';
	if ($__vars['uploadMode']) {
		$__finalCompiled .= '
				' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => 'smilies[' . $__vars['i'] . '][sprite_mode]',
			'selected' => $__vars['smilie']['sprite_mode'],
			'label' => '
						' . 'Bật chế độ sprite CSS với các thông số sau:' . '
					',
			'_type' => 'option',
		)), array(
			'label' => 'Chế độ Sprite',
		)) . '

				' . $__templater->formRow('

					<div class="inputGroup">
						' . $__templater->formNumberBox(array(
			'name' => 'smilies[' . $__vars['i'] . '][sprite_params][w]',
			'value' => $__vars['smilie']['sprite_params']['w'],
			'min' => '1',
			'title' => $__templater->filter('Width', array(array('for_attr', array()),), false),
			'data-xf-init' => 'tooltip',
		)) . '
						<span class="inputGroup-splitter"></span>
						' . $__templater->formNumberBox(array(
			'name' => 'smilies[' . $__vars['i'] . '][sprite_params][h]',
			'value' => $__vars['smilie']['sprite_params']['h'],
			'min' => '1',
			'title' => $__templater->filter('Height', array(array('for_attr', array()),), false),
			'data-xf-init' => 'tooltip',
		)) . '
						<span class="inputGroup-text">px</span>
					</div>
				', array(
			'rowtype' => 'input',
			'label' => 'Kích thước Sprite',
		)) . '

				' . $__templater->formRow('

					<div class="inputGroup">
						' . $__templater->formNumberBox(array(
			'name' => 'smilies[' . $__vars['i'] . '][sprite_params][x]',
			'value' => $__vars['smilie']['sprite_params']['x'],
			'title' => $__templater->filter('Background Position X', array(array('for_attr', array()),), false),
			'data-xf-init' => 'tooltip',
		)) . '
						<span class="inputGroup-splitter"></span>
						' . $__templater->formNumberBox(array(
			'name' => 'smilies[' . $__vars['i'] . '][sprite_params][y]',
			'value' => $__vars['smilie']['sprite_params']['y'],
			'title' => $__templater->filter('Background Position Y', array(array('for_attr', array()),), false),
			'data-xf-init' => 'tooltip',
		)) . '
						<span class="inputGroup-text">px</span>
					</div>
				', array(
			'rowtype' => 'input',
			'label' => 'Vị trí Sprite',
		)) . '

				' . $__templater->formTextBoxRow(array(
			'name' => 'smilies[' . $__vars['i'] . '][sprite_params][bs]',
			'value' => $__vars['smilie']['sprite_params']['bs'],
		), array(
			'label' => 'Kích thước nền',
			'explain' => 'Nếu cần, nhập giá trị cho thuộc tính <code>background-size</code> CSS cho ảnh này.',
		)) . '
			';
	}
	$__finalCompiled .= '

			<hr class="formRowSep" />

			';
	$__compilerTemp2 = array(array(
		'value' => '0',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'Không có' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	$__compilerTemp2[] = array(
		'label' => 'Mới',
		'_type' => 'optgroup',
		'options' => array(),
	);
	end($__compilerTemp2); $__compilerTemp3 = key($__compilerTemp2);
	$__compilerTemp2[$__compilerTemp3]['options'] = $__templater->mergeChoiceOptions($__compilerTemp2[$__compilerTemp3]['options'], $__vars['newCategoryPairs']);
	$__compilerTemp2[] = array(
		'label' => 'Existing',
		'_type' => 'optgroup',
		'options' => array(),
	);
	end($__compilerTemp2); $__compilerTemp4 = key($__compilerTemp2);
	$__compilerTemp2[$__compilerTemp4]['options'] = $__templater->mergeChoiceOptions($__compilerTemp2[$__compilerTemp4]['options'], $__vars['categoryPairs']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'smilies[' . $__vars['i'] . '][smilie_category_id]',
		'value' => ($__vars['smilieCategoryMap'][$__vars['i']] ?: 0),
	), $__compilerTemp2, array(
		'label' => 'Chuyên mục mặt cười',
	)) . '

			' . $__templater->callMacro('display_order_macros', 'row', array(
		'name' => 'smilies[' . $__vars['i'] . '][display_order]',
		'value' => $__vars['smilie']['display_order'],
	), $__vars) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'smilies[' . $__vars['i'] . '][display_in_editor]',
		'selected' => $__vars['smilie']['display_in_editor'],
		'label' => '
					' . 'Hiển thị mặt cười này trong trình soạn thảo văn bản' . '
				',
		'_type' => 'option',
	)), array(
	)) . '

		</div>
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Import Smilies');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->isTraversable($__vars['smilies'])) {
		foreach ($__vars['smilies'] AS $__vars['i'] => $__vars['smilie']) {
			$__compilerTemp1 .= '
		<div class="block">
			<div class="block-container">
				<div class="block-body">
					' . $__templater->callMacro(null, 'smilie', array(
				'smilie' => $__vars['smilie'],
				'i' => $__vars['i'],
			), $__vars) . '
				</div>
			</div>
		</div>
	';
		}
	}
	$__compilerTemp2 = '';
	if ($__templater->isTraversable($__vars['newCategories'])) {
		foreach ($__vars['newCategories'] AS $__vars['newCategoryId'] => $__vars['newCategory']) {
			$__compilerTemp2 .= '
		' . $__templater->formHiddenVal('categories[' . $__vars['newCategoryId'] . '][title]', $__vars['newCategory']['title'], array(
			)) . '
		' . $__templater->formHiddenVal('categories[' . $__vars['newCategoryId'] . '][display_order]', $__vars['newCategory']['display_order'], array(
			)) . '
	';
		}
	}
	$__finalCompiled .= $__templater->form('
	' . $__compilerTemp1 . '

	<div class="block">
		<div class="block-container">
			' . $__templater->formSubmitRow(array(
		'icon' => 'import',
	), array(
	)) . '
		</div>
	</div>

	' . $__compilerTemp2 . '
', array(
		'action' => $__templater->fn('link', array('smilies/import', ), false),
		'ajax' => 'true',
		'data-json-name' => 'json',
		'class' => 'js-stickyParent',
	)) . '

';
	return $__finalCompiled;
});