<?php
// FROM HASH: d29ea3b61e91b66c1a3ace99664a486b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Mã dự phòng xác minh hai bước');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<div class="block-body">
			<div class="block-row block-row--separated">
				' . 'Mã dự phòng xác minh hai bước đã được tạo tự động. Mỗi mã này có thể được sử dụng một lần trong trường hợp bạn không có quyền truy cập vào các phương tiện xác minh khác. Các mã này phải được lưu ở một vị trí an toàn.' . '
			</div>
			<div class="block-row block-row--separated">
				<ul class="listColumns listColumns--spaced listPlain">
				';
	if ($__templater->isTraversable($__vars['codes'])) {
		foreach ($__vars['codes'] AS $__vars['code']) {
			$__finalCompiled .= '
					<li><div>' . $__templater->escape($__vars['code']) . '</div></li>
				';
		}
	}
	$__finalCompiled .= '
				</ul>
			</div>
		</div>
		<div class="block-footer">
			<span class="block-footer-controls">
				' . $__templater->button('Tôi đã lưu mã dự phòng', array(
		'class' => 'button--primary js-overlayClose',
	), '', array(
	)) . '
			</span>
		</div>
	</div>
</div>';
	return $__finalCompiled;
});