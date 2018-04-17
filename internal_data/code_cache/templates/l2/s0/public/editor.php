<?php
// FROM HASH: dd26b243aeb0dc362efe26d4766f0ad7
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->fn('is_editor_capable', array(), false)) {
		$__finalCompiled .= '

	';
		$__templater->includeCss('editor.less');
		$__finalCompiled .= '

	';
		if ($__vars['fullEditorJs']) {
			$__finalCompiled .= '
		';
			$__templater->includeJs(array(
				'src' => 'vendor/froala/froala-compiled.full.js, xf/editor.js',
			));
			$__finalCompiled .= '
	';
		} else {
			$__finalCompiled .= '
		';
			$__templater->includeJs(array(
				'prod' => 'xf/editor-compiled.js',
				'dev' => 'vendor/froala/froala-compiled.js, xf/editor.js',
			));
			$__finalCompiled .= '
	';
		}
		$__finalCompiled .= '
	' . '

	<script class="js-editorLanguage" type="application/json">
		{
			"Align Center": "' . $__templater->filter('Căn giữa', array(array('escape', array('json', )),), true) . '",
			"Align Left": "' . $__templater->filter('Căn trái', array(array('escape', array('json', )),), true) . '",
			"Align Right": "' . $__templater->filter('Căn phải', array(array('escape', array('json', )),), true) . '",
			"Align": "' . $__templater->filter('Căn lề', array(array('escape', array('json', )),), true) . '",
			"Back": "' . $__templater->filter('Back', array(array('escape', array('json', )),), true) . '",
			"Bold": "' . $__templater->filter('Bold', array(array('escape', array('json', )),), true) . '",
			"By URL": "' . $__templater->filter('By URL', array(array('escape', array('json', )),), true) . '",
			"Clear Formatting": "' . $__templater->filter('Xóa định dạng', array(array('escape', array('json', )),), true) . '",
			"Code": "' . $__templater->filter('Mã', array(array('escape', array('json', )),), true) . '",
			"Colors": "' . $__templater->filter('Màu chữ', array(array('escape', array('json', )),), true) . '",
			"Decrease Indent": "' . $__templater->filter('Tăng lề', array(array('escape', array('json', )),), true) . '",
			"Delete Draft": "' . $__templater->filter('Xóa bản thảo', array(array('escape', array('json', )),), true) . '",
			"Drafts": "' . $__templater->filter('Bản thảo', array(array('escape', array('json', )),), true) . '",
			"Drop image": "' . $__templater->filter('Drop image', array(array('escape', array('json', )),), true) . '",
			"Edit Link": "' . $__templater->filter('Edit link', array(array('escape', array('json', )),), true) . '",
			"Font Family": "' . $__templater->filter('Phông chữ', array(array('escape', array('json', )),), true) . '",
			"Font Size": "' . $__templater->filter('Kích thước', array(array('escape', array('json', )),), true) . '",
			"Increase Indent": "' . $__templater->filter('Thụt lề', array(array('escape', array('json', )),), true) . '",
			"Inline Code": "' . $__templater->filter('Inline code', array(array('escape', array('json', )),), true) . '",
			"Insert Image": "' . $__templater->filter('Chèn hình ảnh', array(array('escape', array('json', )),), true) . '",
			"Insert Link": "' . $__templater->filter('Chèn liên kết', array(array('escape', array('json', )),), true) . '",
			"Insert": "' . $__templater->filter('Chèn', array(array('escape', array('json', )),), true) . '",
			"Italic": "' . $__templater->filter('In nghiêng', array(array('escape', array('json', )),), true) . '",
			"List": "' . $__templater->filter('Danh sách', array(array('escape', array('json', )),), true) . '",
			"Loading image": "' . $__templater->filter('Loading image', array(array('escape', array('json', )),), true) . '",
			"Media": "' . $__templater->filter('Media', array(array('escape', array('json', )),), true) . '",
			"Open Link": "' . $__templater->filter('Open link', array(array('escape', array('json', )),), true) . '",
			"or click": "' . $__templater->filter('Or click here', array(array('escape', array('json', )),), true) . '",
			"Ordered List": "' . $__templater->filter('Danh sách có thứ tự', array(array('escape', array('json', )),), true) . '",
			"Quote": "' . $__templater->filter('Trích dẫn', array(array('escape', array('json', )),), true) . '",
			"Redo": "' . $__templater->filter('Redo', array(array('escape', array('json', )),), true) . '",
			"Remove": "' . $__templater->filter('Xóa', array(array('escape', array('json', )),), true) . '",
			"Replace": "' . $__templater->filter('Replace', array(array('escape', array('json', )),), true) . '",
			"Save Draft": "' . $__templater->filter('Lưu nháp', array(array('escape', array('json', )),), true) . '",
			"Smilies": "' . $__templater->filter('Mặt cười', array(array('escape', array('json', )),), true) . '",
			"Something went wrong. Please try again.": "' . $__templater->filter('Something went wrong. Please try again or contact the administrator.', array(array('escape', array('json', )),), true) . '",
			"Spoiler": "' . $__templater->filter('Spoiler', array(array('escape', array('json', )),), true) . '",
			"Strikethrough": "' . $__templater->filter('Gạch ngang', array(array('escape', array('json', )),), true) . '",
			"Text": "' . $__templater->filter('Ký tự', array(array('escape', array('json', )),), true) . '",
			"Toggle BB Code": "' . $__templater->filter('Toggle BB code', array(array('escape', array('json', )),), true) . '",
			"Underline": "' . $__templater->filter('Gạch chân', array(array('escape', array('json', )),), true) . '",
			"Undo": "' . $__templater->filter('Undo', array(array('escape', array('json', )),), true) . '",
			"Unlink": "' . $__templater->filter('Bỏ liên kết', array(array('escape', array('json', )),), true) . '",
			"Unordered List": "' . $__templater->filter('Danh sách không có thứ tự', array(array('escape', array('json', )),), true) . '",
			"Update": "' . $__templater->filter('Cập nhật', array(array('escape', array('json', )),), true) . '",
			"Upload Image": "' . $__templater->filter('Upload image', array(array('escape', array('json', )),), true) . '",
			"Uploading": "' . $__templater->filter('Uploading', array(array('escape', array('json', )),), true) . '",
			"URL": "' . $__templater->filter('URL', array(array('escape', array('json', )),), true) . '",
			"__lang end__": ""
		}
	</script>

	<script class="js-editorCustom" type="application/json">
		' . $__templater->filter($__vars['customIcons'], array(array('json', array()),array('raw', array()),), true) . '
	</script>

	<textarea name="' . $__templater->escape($__vars['htmlName']) . '"
		class="input js-editor u-jsOnly"
		data-xf-init="editor"
		data-original-name="' . $__templater->escape($__vars['name']) . '"
		data-buttons-remove="' . $__templater->filter($__vars['removeButtons'], array(array('join', array(',', )),), true) . '"
		style="visibility: hidden; height: ' . ($__vars['height'] + 37) . 'px; ' . $__templater->escape($__vars['styleAttr']) . '"
		' . $__templater->filter($__vars['attrsHtml'], array(array('raw', array()),), true) . '>' . $__templater->escape($__vars['htmlValue']) . '</textarea>

	' . '

	<input type="hidden" value="' . $__templater->escape($__vars['value']) . '" data-bb-code="' . $__templater->escape($__vars['name']) . '" />

	<noscript>
		<textarea name="' . $__templater->escape($__vars['name']) . '" class="input">' . $__templater->escape($__vars['value']) . '</textarea>
	</noscript>

';
	} else {
		$__finalCompiled .= '

	<textarea name="' . $__templater->escape($__vars['name']) . '" class="input js-editor" data-xf-init="user-mentioner" ' . $__templater->filter($__vars['attrsHtml'], array(array('raw', array()),), true) . '>' . $__templater->escape($__vars['value']) . '</textarea>

';
	}
	$__finalCompiled .= '
';
	if ($__vars['previewable']) {
		$__finalCompiled .= '
	<div class="js-previewContainer"></div>
';
	}
	return $__finalCompiled;
});