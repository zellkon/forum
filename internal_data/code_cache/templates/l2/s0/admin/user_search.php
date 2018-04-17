<?php
// FROM HASH: 2ae695f07f4ef827154f35cbb92d79eb
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Tìm thành viên');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Thêm thành viên', array(
		'href' => $__templater->fn('link', array('users/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

';
	if ($__vars['lastUser']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--highlight">
		<div class="contentRow">
			<span class="contentRow-figure">
				' . $__templater->fn('avatar', array($__vars['lastUser'], 's', false, array(
		))) . '
			</span>
			<div class="contentRow-main">
				<h2 class="contentRow-title">' . 'Thay đổi đã lưu' . '</h2>
				<a href="' . $__templater->fn('link', array('users/edit', $__vars['lastUser'], ), true) . '">' . 'Edit ' . $__templater->escape($__vars['lastUser']['username']) . ' again.' . '</a>
			</div>
		</div>
	</div>
';
	}
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<h2 class="block-tabHeader tabs" data-xf-init="tabs" role="tablist">
			<a class="tabs-tab is-active" role="tab" tabindex="0" aria-controls="user-search">' . 'Tìm kiếm chuẩn' . '</a>
			<a class="tabs-tab" role="tab" tabindex="0" aria-controls="ip-search">' . 'Tìm theo địa chỉ IP' . '</a>
		</h2>

		<ul class="tabPanes">
			<li class="is-active" role="tabpanel" id="user-search">
				';
	$__compilerTemp1 = $__templater->mergeChoiceOptions(array(), $__vars['sortOrders']);
	$__finalCompiled .= $__templater->form('
					<div class="block-body">
						' . $__templater->includeTemplate('helper_user_search_criteria', $__vars) . '

						<hr class="formRowSep" />

						' . $__templater->formRow('

							<div class="inputPair">
								' . $__templater->formSelect(array(
		'name' => 'order',
	), $__compilerTemp1) . '
								' . $__templater->formSelect(array(
		'name' => 'direction',
	), array(array(
		'value' => 'asc',
		'label' => 'Tăng dần',
		'_type' => 'option',
	),
	array(
		'value' => 'desc',
		'label' => 'Giảm dần',
		'_type' => 'option',
	))) . '
							</div>
						', array(
		'rowtype' => 'input',
		'label' => 'Sắp xếp',
	)) . '
					</div>
					' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'search',
	), array(
	)) . '
				', array(
		'action' => $__templater->fn('link', array('users/list', ), false),
	)) . '
			</li>
			<li role="tabpanel" id="ip-search">
				' . $__templater->form('
					<div class="block-body">
						' . $__templater->formTextBoxRow(array(
		'name' => 'ip',
	), array(
		'label' => 'Địa chỉ IP',
		'explain' => 'Nhập địa chỉ IP để xem danh sách tất cả thành viên đã đăng nhập và đã đăng nội dung bằng IP đó. Bạn có thể nhập địa chỉ IP một phần như 192.168.*, 192.168.0.0/16 hoặc 2001:db8::/32.',
	)) . '
					</div>
					' . $__templater->formSubmitRow(array(
		'icon' => 'search',
	), array(
	)) . '
				', array(
		'action' => $__templater->fn('link', array('users/ip-users', ), false),
	)) . '
			</li>
		</ul>
	</div>
</div>';
	return $__finalCompiled;
});