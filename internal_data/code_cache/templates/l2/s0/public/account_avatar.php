<?php
// FROM HASH: c6ab63717e0569141359e05ca4401a02
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Ảnh đại diện');
	$__finalCompiled .= '

';
	$__templater->includeCss('account_avatar.less');
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'prod' => 'xf/avatar-compiled.js',
		'dev' => 'vendor/cropbox/jquery.cropbox.js, xf/avatar.js',
	));
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['xf']['options']['gravatarEnable']) {
		$__compilerTemp1 .= '
				<li class="block-row block-row--separated avatarControl">
					<div class="avatarControl-preview">
						<span class="avatar avatar--m">
							<img src="' . $__templater->fn('gravatar_url', array($__vars['xf']['visitor'], 'm', ), true) . '" class="js-gravatarPreview" />
						</span>
					</div>
					<div class="avatarControl-inputs">
						' . $__templater->formRadio(array(
			'name' => 'use_custom',
		), array(array(
			'value' => '0',
			'selected' => $__vars['xf']['visitor']['gravatar'],
			'label' => 'Sử dụng Gravatar',
			'_dependent' => array('
									<div class="inputGroup">
										' . $__templater->formTextBox(array(
			'name' => 'gravatar',
			'value' => ($__vars['xf']['visitor']['gravatar'] ?: $__vars['xf']['visitor']['email']),
			'type' => 'email',
			'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'gravatar', ), false),
			'class' => 'js-gravatar',
		)) . '
										<div class="inputGroup-text u-jsOnly">
											' . $__templater->button('
												' . 'Kiểm tra' . '
											', array(
			'type' => 'submit',
			'name' => 'test_gravatar',
			'value' => '1',
		), '', array(
		)) . '
										</div>
									</div>
									<dfn class="inputChoices-explain">
										' . 'Nhập vào email bạn đã đăng ký tại Gravatar để lấy avatar.' . '
										<div><a href="https://gravatar.com" rel="nofollow" target="_blank">' . 'Gravatar là gì?' . '</a></div>
									</dfn>
								'),
			'_type' => 'option',
		))) . '
					</div>
				</li>
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<ul class="block-body">
			<li class="block-row block-row--separated avatarControl">
				<div class="avatarControl-preview">
					<div class="avatarCropper" style="width: ' . $__templater->escape($__vars['maxSize']) . 'px; height: ' . $__templater->escape($__vars['maxSize']) . 'px;">
						' . $__templater->fn('avatar', array($__vars['xf']['visitor'], 'o', false, array(
		'href' => '',
		'style' => $__vars['maxDimension'] . ': ' . $__vars['maxSize'] . 'px; left: -' . $__vars['x'] . 'px; top: -' . $__vars['y'] . 'px;',
		'data-x' => $__vars['x'],
		'data-y' => $__vars['y'],
		'data-size' => $__vars['maxSize'],
		'class' => 'js-avatar js-avatarCropper',
		'innerclass' => 'js-croppedAvatar',
		'forcetype' => 'custom',
		'data-xf-init' => 'avatar-cropper',
	))) . '
						' . $__templater->formHiddenVal('avatar_crop_x', $__vars['x'], array(
		'class' => 'js-avatarX',
	)) . '
						' . $__templater->formHiddenVal('avatar_crop_y', $__vars['y'], array(
		'class' => 'js-avatarY',
	)) . '
					</div>
				</div>
				<div class="avatarControl-inputs">
					' . $__templater->formRadio(array(
		'name' => 'use_custom',
		'id' => 'useCustom',
	), array(array(
		'value' => '1',
		'selected' => !$__vars['xf']['visitor']['gravatar'],
		'label' => 'Sử dụng avatar riêng',
		'hint' => 'Kéo thả ảnh để cắt, sau đó nhấp <i>Cập nhật ảnh đại diện</i> để xác nhận hoặc tải lên hình đại diện mới bên dưới.',
		'_dependent' => array('
								<label>' . 'Tải lên avatar riêng mới' . $__vars['xf']['language']['label_separator'] . '</label>
								' . $__templater->formUpload(array(
		'name' => 'upload',
		'class' => 'js-uploadAvatar',
		'accept' => '.gif,.jpeg,.jpg,.jpe,.png',
	)) . '
								<dfn class="inputChoices-explain">
									' . 'Bạn nên sử dụng hình ảnh có kích thước tối thiểu ' . 400 . 'x' . 400 . ' pixels.' . '
								</dfn>
							'),
		'_type' => 'option',
	))) . '
				</div>
			</li>
			' . $__compilerTemp1 . '
		</ul>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Đồng ý',
		'class' => 'js-overlayClose',
	), array(
		'rowtype' => 'simple',
		'html' => '
				' . $__templater->button('', array(
		'type' => 'submit',
		'name' => 'delete_avatar',
		'value' => '1',
		'class' => 'js-deleteAvatar',
		'icon' => 'delete',
	), '', array(
	)) . '
			',
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('account/avatar', ), false),
		'upload' => 'true',
		'ajax' => 'true',
		'class' => 'block',
		'data-xf-init' => 'avatar-upload',
	));
	return $__finalCompiled;
});