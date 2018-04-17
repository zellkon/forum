<?php
// FROM HASH: 05a4f07c972a5f57f9251d64edefe66e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Đang theo dõi');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<ol class="block-body">
			';
	$__compilerTemp1 = true;
	if ($__templater->isTraversable($__vars['following'])) {
		foreach ($__vars['following'] AS $__vars['user']) {
			$__compilerTemp1 = false;
			$__finalCompiled .= '
				<li class="block-row block-row--separated">
					';
			$__compilerTemp2 = '';
			if ($__templater->method($__vars['xf']['visitor'], 'canFollowUser', array($__vars['user'], ))) {
				$__compilerTemp2 .= '
							' . $__templater->button('
								' . ($__templater->method($__vars['xf']['visitor'], 'isFollowing', array($__vars['user'], )) ? 'Bỏ theo dõi' : 'Theo dõi') . '
							', array(
					'href' => $__templater->fn('link', array('members/follow', $__vars['user'], ), false),
					'class' => 'button--link',
					'data-xf-click' => 'switch',
					'data-sk-follow' => 'Theo dõi',
					'data-sk-unfollow' => 'Bỏ theo dõi',
				), '', array(
				)) . '
						';
			}
			$__vars['switchLink'] = $__templater->preEscaped('
						' . $__compilerTemp2 . '
					');
			$__finalCompiled .= '
					' . $__templater->callMacro('member_list_macros', 'item', array(
				'user' => $__vars['user'],
				'extraData' => $__vars['switchLink'],
			), $__vars) . '
				</li>
			';
		}
	}
	if ($__compilerTemp1) {
		$__finalCompiled .= '
				<div class="block-row">' . 'Bạn hiện không theo dõi bất kỳ thành viên nào.' . '</div>
			';
	}
	$__finalCompiled .= '
		</ol>
	</div>
</div>';
	return $__finalCompiled;
});