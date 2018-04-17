<?php
// FROM HASH: a642ff6d40652c574575aa06d4c03be4
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped($__templater->escape($__vars['user']['username']));
	$__templater->pageParams['pageNumber'] = $__vars['page'];
	$__finalCompiled .= '
';
	$__templater->pageParams['noH1'] = true;
	$__finalCompiled .= '

' . $__templater->callMacro('metadata_macros', 'metadata', array(
		'shareUrl' => $__templater->fn('link', array('canonical:members', $__vars['user'], ), false),
		'canonicalUrl' => $__templater->fn('link', array('canonical:members', $__vars['user'], array('page' => $__vars['page'], ), ), false),
		'imageUrl' => $__templater->method($__vars['user'], 'getAvatarUrl', array('o', null, true, )),
	), $__vars) . '

';
	$__templater->setPageParam('ldJsonHtml', '
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Person",
		"name": "' . $__templater->filter($__vars['user']['username'], array(array('escape', array('json', )),), true) . '",
		"image": "' . $__templater->filter($__templater->method($__vars['user'], 'getAvatarUrl', array('o', null, true, )), array(array('escape', array('json', )),), true) . '"
	}
	</script>
');
	$__finalCompiled .= '

';
	$__templater->includeCss('member.less');
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<div class="block-body">
			<div class="memberHeader">

				<div class="memberHeader-main">
					<span class="memberHeader-avatar">
						' . $__templater->fn('avatar', array($__vars['user'], 'l', false, array(
		'href' => '',
		'update' => $__templater->fn('link', array('account/avatar', $__vars['user'], ), false),
	))) . '
					</span>
					<div class="memberHeader-content memberHeader-content--info">
						';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
									';
	if ($__templater->method($__vars['user'], 'canBeReported', array())) {
		$__compilerTemp1 .= '
										' . $__templater->button('
											' . 'Báo cáo' . '
										', array(
			'href' => $__templater->fn('link', array('members/report', $__vars['user'], ), false),
			'class' => 'button--link',
			'overlay' => 'true',
		), '', array(
		)) . '
									';
	}
	$__compilerTemp1 .= '
									';
	$__compilerTemp2 = '';
	$__compilerTemp2 .= '
														' . $__templater->callMacro('member_macros', 'moderator_menu_actions', array(
		'user' => $__vars['user'],
		'context' => 'profile',
	), $__vars) . '
													';
	if (strlen(trim($__compilerTemp2)) > 0) {
		$__compilerTemp1 .= '
										<div class="buttonGroup-buttonWrapper">
											' . $__templater->button('Công cụ quản trị', array(
			'class' => 'button--link menuTrigger',
			'data-xf-click' => 'menu',
			'aria-expanded' => 'false',
			'aria-haspopup' => 'true',
		), '', array(
		)) . '
											<div class="menu" data-menu="menu" aria-hidden="true">
												<div class="menu-content">
													<h3 class="menu-header">' . 'Công cụ quản trị' . '</h3>
													' . $__compilerTemp2 . '
												</div>
											</div>
										</div>
									';
	}
	$__compilerTemp1 .= '
								';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
							<div class="memberHeader-actionTop">
								<div class="buttonGroup">
								' . $__compilerTemp1 . '
								</div>
							</div>
						';
	}
	$__finalCompiled .= '

						<h1 class="memberHeader-name">' . $__templater->fn('username_link', array($__vars['user'], true, array(
		'href' => '',
	))) . '</h1>

						';
	$__compilerTemp3 = '';
	$__compilerTemp3 .= $__templater->fn('user_banners', array($__vars['user'], array(
	)));
	if (strlen(trim($__compilerTemp3)) > 0) {
		$__finalCompiled .= '
							<div class="memberHeader-banners">
								' . $__compilerTemp3 . '
							</div>
						';
	}
	$__finalCompiled .= '

						' . $__templater->fn('user_blurb', array($__vars['user'], array(
		'tag' => 'div',
		'class' => 'memberHeader-blurb',
	))) . '

						';
	$__compilerTemp4 = '';
	$__compilerTemp4 .= $__templater->fn('user_activity', array($__vars['user']));
	if (strlen(trim($__compilerTemp4)) > 0) {
		$__finalCompiled .= '
							<dl class="pairs pairs--inline memberHeader-blurb">
								<dt>' . 'Nhìn thấy lần cuối' . '</dt>
								<dd dir="auto">
									' . $__compilerTemp4 . '
								</dd>
							</dl>
						';
	}
	$__finalCompiled .= '
					</div>
				</div>

				<div class="memberHeader-content">
					<div class="memberHeader-stats">
						<div class="pairJustifier">
							' . $__templater->callMacro('member_macros', 'member_stat_pairs', array(
		'user' => $__vars['user'],
		'context' => 'profile',
	), $__vars) . '
						</div>
					</div>

					';
	$__compilerTemp5 = '';
	$__compilerTemp5 .= '
								' . $__templater->callMacro('member_macros', 'member_action_buttons', array(
		'user' => $__vars['user'],
		'context' => 'profile',
	), $__vars) . '
							';
	if (strlen(trim($__compilerTemp5)) > 0) {
		$__finalCompiled .= '
						<hr class="memberHeader-separator" />

						<div class="memberHeader-buttons">
							' . $__compilerTemp5 . '
						</div>
					';
	}
	$__finalCompiled .= '
				</div>

			</div>
		</div>
		<h2 class="block-tabHeader block-tabHeader--memberTabs tabs hScroller"
			data-xf-init="tabs h-scroller"
			data-panes=".js-memberTabPanes"
			data-state="replace"
			role="tablist">
			<span class="hScroller-scroll">
				' . '
				';
	if ($__templater->method($__vars['user'], 'canViewPostsOnProfile', array())) {
		$__finalCompiled .= '
					<a href="' . $__templater->fn('link', array('members', $__vars['user'], ), true) . '"
						class="tabs-tab is-active"
						role="tab"
						aria-controls="profile-posts">' . 'Bài viết trên hồ sơ' . '</a>
				';
	}
	$__finalCompiled .= '

				';
	if ($__templater->method($__vars['user'], 'canViewLatestActivity', array())) {
		$__finalCompiled .= '
					<a href="' . $__templater->fn('link', array('members/latest-activity', $__vars['user'], ), true) . '"
						rel="nofollow"
						class="tabs-tab"
						id="latest-activity"
						role="tab">' . 'Hoạt động mới nhất' . '</a>
				';
	}
	$__finalCompiled .= '

				<a href="' . $__templater->fn('link', array('members/recent-content', $__vars['user'], ), true) . '"
					rel="nofollow"
					class="tabs-tab"
					id="recent-content"
					role="tab">' . 'Các bài viết' . '</a>

				' . '

				<a href="' . $__templater->fn('link', array('members/about', $__vars['user'], ), true) . '"
					class="tabs-tab"
					id="about"
					role="tab">' . 'Giới thiệu' . '</a>

				';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewWarnings', array()) AND $__vars['user']['warning_count']) {
		$__finalCompiled .= '
					<a href="' . $__templater->fn('link', array('members/warnings', $__vars['user'], ), true) . '"
						class="tabs-tab"
						id="warnings"
						role="tab">' . 'Cảnh báo' . '</a>
				';
	}
	$__finalCompiled .= '
				' . '
			</span>
		</h2>
	</div>
</div>

' . $__templater->callAdsMacro('member_view_below_tabs', array(
		'user' => $__vars['user'],
	), $__vars) . '

<ul class="tabPanes js-memberTabPanes">
	' . '
	';
	if ($__templater->method($__vars['user'], 'canViewPostsOnProfile', array())) {
		$__finalCompiled .= '
		<li class="is-active" role="tabpanel" id="profile-posts">
			';
		$__templater->includeJs(array(
			'src' => 'xf/inline_mod.js',
			'min' => '1',
		));
		$__finalCompiled .= '
			<div class="block block--messages" data-xf-init="inline-mod" data-type="profile_post" data-href="' . $__templater->fn('link', array('inline-mod', ), true) . '">
				<div class="block-container">
					<div class="block-body js-replyNewMessageContainer">
						';
		if ($__templater->method($__vars['user'], 'canPostOnProfile', array())) {
			$__finalCompiled .= '
							';
			$__vars['firstProfilePost'] = $__templater->filter($__vars['profilePosts'], array(array('first', array()),), false);
			$__finalCompiled .= '
							' . $__templater->callMacro('profile_post_macros', 'submit', array(
				'user' => $__vars['user'],
				'lastDate' => ($__vars['firstProfilePost']['post_date'] ?: 0),
				'containerSelector' => '< .js-replyNewMessageContainer',
			), $__vars) . '
						';
		}
		$__finalCompiled .= '

						';
		if (!$__templater->test($__vars['profilePosts'], 'empty', array())) {
			$__finalCompiled .= '
							';
			if ($__templater->isTraversable($__vars['profilePosts'])) {
				foreach ($__vars['profilePosts'] AS $__vars['profilePost']) {
					$__finalCompiled .= '
								' . $__templater->callMacro('profile_post_macros', (($__vars['profilePost']['message_state'] == 'deleted') ? 'profile_post_deleted' : 'profile_post'), array(
						'profilePost' => $__vars['profilePost'],
					), $__vars) . '
							';
				}
			}
			$__finalCompiled .= '
						';
		} else {
			$__finalCompiled .= '
							<div class="block-row js-replyNoMessages">' . 'Hiện tại không có tin nhắn trong hồ sơ của ' . $__templater->escape($__vars['user']['username']) . '.' . '</div>
						';
		}
		$__finalCompiled .= '
					</div>
				</div>

				<div class="block-outer block-outer--after">
					' . $__templater->fn('page_nav', array(array(
			'page' => $__vars['page'],
			'total' => $__vars['total'],
			'link' => 'members',
			'data' => $__vars['user'],
			'wrapperclass' => 'block-outer-main',
			'perPage' => $__vars['perPage'],
		))) . '
					<div class="block-outer-opposite">
						' . $__templater->fn('show_ignored', array(array(
		))) . '
						';
		if ($__vars['canInlineMod']) {
			$__finalCompiled .= '
							' . $__templater->callMacro('inline_mod_macros', 'button', array(), $__vars) . '
						';
		}
		$__finalCompiled .= '
					</div>
				</div>
			</div>
		</li>
	';
	}
	$__finalCompiled .= '

	';
	if ($__templater->method($__vars['user'], 'canViewLatestActivity', array())) {
		$__finalCompiled .= '
		<li data-href="' . $__templater->fn('link', array('members/latest-activity', $__vars['user'], ), true) . '" role="tabpanel" aria-labelledby="latest-activity">
			<div class="blockMessage">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
		</li>
	';
	}
	$__finalCompiled .= '

	<li data-href="' . $__templater->fn('link', array('members/recent-content', $__vars['user'], ), true) . '" role="tabpanel" aria-labelledby="recent-content">
		<div class="blockMessage">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
	</li>

	' . '

	<li data-href="' . $__templater->fn('link', array('members/about', $__vars['user'], ), true) . '" role="tabpanel" aria-labelledby="about">
		<div class="blockMessage">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
	</li>

	';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewWarnings', array()) AND $__vars['user']['warning_count']) {
		$__finalCompiled .= '
		<li data-href="' . $__templater->fn('link', array('members/warnings', $__vars['user'], ), true) . '" role="tabpanel" aria-labelledby="warnings">
			<div class="blockMessage">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
		</li>
	';
	}
	$__finalCompiled .= '
	' . '
</ul>

';
	$__templater->modifySidebarHtml('_xfWidgetPositionSidebarMemberViewSidebar', $__templater->widgetPosition('member_view_sidebar', array(
		'user' => $__vars['user'],
	)), 'replace');
	return $__finalCompiled;
});