<?php
// FROM HASH: 9ec5f94203b3e39e24f05f647a0ce7f2
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tài khoản đã kết nối');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('Tài khoản đã kết nối cho phép bạn đăng nhập vào trang này dễ dàng hơn bằng cách sử dụng tài khoản bạn đã lưu trữ tại một trong các trang web dưới đây.', array(
	)) . '
			';
	$__compilerTemp1 = true;
	if ($__templater->isTraversable($__vars['providers'])) {
		foreach ($__vars['providers'] AS $__vars['provider']) {
			$__compilerTemp1 = false;
			$__finalCompiled .= '
				';
			if ($__templater->method($__vars['provider'], 'isAssociated', array($__vars['xf']['visitor'], ))) {
				$__finalCompiled .= '
					' . $__templater->callMacro('connected_account_macros', 'disassociate', array(
					'provider' => $__vars['provider'],
					'hasPassword' => $__vars['hasPassword'],
				), $__vars) . '
				';
			} else {
				$__finalCompiled .= '
					' . $__templater->callMacro('connected_account_macros', 'associate', array(
					'provider' => $__vars['provider'],
				), $__vars) . '
				';
			}
			$__finalCompiled .= '
			';
		}
	}
	if ($__compilerTemp1) {
		$__finalCompiled .= '
				<div class="block-row">' . 'There are currently no usable external account providers.' . '</div>
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
</div>';
	return $__finalCompiled;
});