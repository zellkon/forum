<?php
// FROM HASH: 2c24107c2dab78a6d83dcec3a2c45fe5
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['smilie'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Thêm mặt cười');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Chỉnh sửa mặt cười' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['smilie']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['smilie'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('smilies/delete', $__vars['smilie'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

';
	$__compilerTemp1 = array(array(
		'value' => '0',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'Không có' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	$__compilerTemp1 = $__templater->mergeChoiceOptions($__compilerTemp1, $__vars['smilieCategories']);
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['smilie']['title'],
		'maxlength' => $__templater->fn('max_length', array($__vars['smilie'], 'title', ), false),
	), array(
		'label' => 'Tiêu đề',
	)) . '
			' . $__templater->formTextAreaRow(array(
		'name' => 'smilie_text',
		'value' => $__vars['smilie']['smilie_text'],
		'autosize' => 'true',
	), array(
		'label' => 'Văn bản thay thế',
		'explain' => 'Bạn có thể nhập nhiều giá trị văn bản để thay thế bằng cách đặt chúng trên các dòng riêng biệt.',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'image_url',
		'value' => $__vars['smilie']['image_url'],
		'maxlength' => $__templater->fn('max_length', array($__vars['smilie'], 'image_url', ), false),
		'dir' => 'ltr',
	), array(
		'label' => 'URL hình ảnh thay thế',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'image_url_2x',
		'value' => $__vars['smilie']['image_url_2x'],
		'maxlength' => $__templater->fn('max_length', array($__vars['smilie'], 'image_url_2x', ), false),
		'dir' => 'ltr',
	), array(
		'label' => 'URL 2x hình ảnh thay thế',
		'hint' => 'Tùy chọn (không bắt buộc)',
		'explain' => 'Nếu được cung cấp, hình ảnh 2x sẽ được tự động hiển thị thay vì URL hình ảnh ở trên trên các thiết bị có khả năng hiển thị độ phân giải pixel cao hơn.<br />
<br />
<strong>Lưu ý: Tùy chọn này không có hiệu lực khi kích hoạt chế độ sprite.</strong>',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formSelectRow(array(
		'name' => 'smilie_category_id',
		'value' => $__vars['smilie']['smilie_category_id'],
	), $__compilerTemp1, array(
		'label' => 'Chuyên mục mặt cười',
	)) . '

			' . $__templater->callMacro('display_order_macros', 'row', array(
		'value' => $__vars['smilie']['display_order'],
	), $__vars) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'display_in_editor',
		'selected' => $__vars['smilie']['display_in_editor'],
		'label' => 'Hiển thị mặt cười này trong trình soạn thảo văn bản',
		'explain' => 'Hidden smilies are not shown as clickable items in the text editor, but are displayed on the smilie help page, and will still convert smilie text to a smilie image if typed manually into the editor.',
		'_type' => 'option',
	)), array(
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'sprite_mode',
		'selected' => $__vars['smilie']['sprite_mode'],
		'label' => 'Bật chế độ sprite CSS với các thông số sau:',
		'_type' => 'option',
	)), array(
		'label' => 'Chế độ Sprite',
	)) . '

			' . $__templater->formRow('

				<div class="inputGroup">
					' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[w]',
		'value' => $__vars['smilie']['sprite_params']['w'],
		'min' => '1',
		'title' => $__templater->filter('Width', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
					<span class="inputGroup-text">x</span>
					' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[h]',
		'value' => $__vars['smilie']['sprite_params']['h'],
		'min' => '1',
		'title' => $__templater->filter('Height', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
					<span class="inputGroup-text">' . 'Pixels' . '</span>
				</div>
			', array(
		'rowtype' => 'input',
		'label' => 'Kích thước Sprite',
	)) . '

			' . $__templater->formRow('

				<div class="inputGroup">
					' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[x]',
		'value' => $__vars['smilie']['sprite_params']['x'],
		'title' => $__templater->filter('Background Position X', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
					<span class="inputGroup-text">x</span>
					' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[y]',
		'value' => $__vars['smilie']['sprite_params']['y'],
		'title' => $__templater->filter('Background Position Y', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
					<span class="inputGroup-text">' . 'Pixels' . '</span>
				</div>
			', array(
		'rowtype' => 'input',
		'label' => 'Vị trí Sprite',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'sprite_params[bs]',
		'value' => $__vars['smilie']['sprite_params']['bs'],
		'dir' => 'ltr',
	), array(
		'label' => 'Kích thước nền',
		'explain' => 'Nếu cần, nhập giá trị cho thuộc tính <code>background-size</code> CSS cho ảnh này.',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '

	</div>
', array(
		'action' => $__templater->fn('link', array('smilies/save', $__vars['smilie'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});