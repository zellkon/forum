<?php
// FROM HASH: 687d7dc712cf5768cb97be56467b5859
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Kiểm tra nhà cung cấp' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['provider']['title']));
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<div class="block-body">

			' . $__templater->filter($__templater->method($__vars['handler'], 'renderTest', array($__vars['provider'], $__vars['providerData'], )), array(array('raw', array()),), true) . '

			';
	if (!$__vars['providerData']) {
		$__finalCompiled .= '
				' . $__templater->formRow('
					' . $__templater->button('
						' . 'Kiểm tra' . '
					', array(
			'href' => $__templater->fn('link', array('connected-accounts/perform-test', $__vars['provider'], array('test' => 1, ), ), false),
		), '', array(
		)) . '
				', array(
		)) . '
				' . $__templater->formInfoRow('
					' . 'Lưu ý: Để thực hiện kiểm tra này, nhà cung cấp phải hỗ trợ chuyển hướng tới URL sau' . $__vars['xf']['language']['label_separator'] . '
					<div><code>' . $__templater->escape($__vars['redirectUri']) . '</code></div>
				', array(
		)) . '
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
</div>';
	return $__finalCompiled;
});