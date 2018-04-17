<?php
// FROM HASH: a245de1990a2211a58f16415b9c5936d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Địa chỉ IP được dùng để đăng nhập tài khoản ' . $__templater->escape($__vars['user']['username']) . '');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['ips'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block">
		<div class="block-container">
			<div class="block-body">
				';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['ips'])) {
			foreach ($__vars['ips'] AS $__vars['ip']) {
				$__compilerTemp1 .= '
						' . $__templater->dataRow(array(
					'rowclass' => 'dataList-row--noHover',
				), array(array(
					'href' => $__templater->fn('link_type', array('public', 'misc/ip-info', null, array('ip' => $__templater->filter($__vars['ip']['ip'], array(array('ip', array()),), false), ), ), false),
					'target' => '_blank',
					'_type' => 'cell',
					'html' => $__templater->filter($__vars['ip']['ip'], array(array('ip', array()),), true),
				),
				array(
					'_type' => 'cell',
					'html' => $__templater->filter($__vars['ip']['total'], array(array('number', array()),), true),
				),
				array(
					'_type' => 'cell',
					'html' => $__templater->fn('date_dynamic', array($__vars['ip']['first_date'], array(
				))),
				),
				array(
					'_type' => 'cell',
					'html' => $__templater->fn('date_dynamic', array($__vars['ip']['last_date'], array(
				))),
				),
				array(
					'href' => $__templater->fn('link', array('users/ip-users', null, array('ip' => $__templater->filter($__vars['ip']['ip'], array(array('ip', array()),), false), ), ), false),
					'overlay' => 'true',
					'_type' => 'action',
					'html' => 'Xem thêm thành viên',
				),
				array(
					'label' => '&#8226;&#8226;&#8226;',
					'class' => 'dataList-cell--separated',
					'_type' => 'popup',
					'html' => '
								<div class="menu" data-menu="menu" aria-hidden="true" data-menu-builder="dataList">
									<div class="menu-content">
										<h3 class="menu-header">' . 'Thêm tùy chọn' . '</h3>
										<a href="' . $__templater->fn('link', array('banning/ips/add', null, array('ip' => $__templater->filter($__vars['ip']['ip'], array(array('ip', array()),), false), ), ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Cấm' . '</a>
										<a href="' . $__templater->fn('link', array('banning/discouraged-ips/add', null, array('ip' => $__templater->filter($__vars['ip']['ip'], array(array('ip', array()),), false), ), ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Discourage' . '</a>
										<div class="js-menuBuilderTarget u-showMediumBlock"></div>
									</div>
								</div>
							',
				))) . '
					';
			}
		}
		$__finalCompiled .= $__templater->dataList('
					' . $__templater->dataRow(array(
			'rowtype' => 'header',
		), array(array(
			'_type' => 'cell',
			'html' => 'IP',
		),
		array(
			'_type' => 'cell',
			'html' => 'Tổng',
		),
		array(
			'_type' => 'cell',
			'html' => 'Sớm nhất',
		),
		array(
			'_type' => 'cell',
			'html' => 'Mới nhất',
		),
		array(
			'_type' => 'cell',
			'html' => '&nbsp;',
		),
		array(
			'_type' => 'cell',
			'html' => '&nbsp;',
		))) . '
					' . $__compilerTemp1 . '
				', array(
			'data-xf-init' => 'responsive-data-list',
		)) . '
			</div>
		</div>
	</div>
';
	} else {
		$__finalCompiled .= '
	<div class="blockMessage">' . 'Không tìm thấy bản ghi IP cho thành viên được yêu cầu.' . '</div>
';
	}
	return $__finalCompiled;
});