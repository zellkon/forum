<?php
// FROM HASH: a94c4ec2a442cf9105fa2884a8cf48df
return array('macros' => array('attribution' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'profilePost' => '!',
		'showTargetUser' => false,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__vars['showTargetUser'] AND ($__vars['profilePost']['user_id'] != $__vars['profilePost']['profile_user_id'])) {
		$__finalCompiled .= '
		' . $__templater->fn('username_link', array($__vars['profilePost']['User'], true, array(
			'defaultname' => $__vars['profilePost']['username'],
			'aria-hidden' => 'true',
		))) . '
		<i class="fa ' . ($__vars['xf']['isRtl'] ? 'fa-caret-left' : 'fa-caret-right') . ' u-muted" aria-hidden="true"></i>
		' . $__templater->fn('username_link', array($__vars['profilePost']['ProfileUser'], true, array(
			'defaultname' => 'Unknown',
			'aria-hidden' => 'true',
		))) . '
		<span class="u-srOnly">' . '' . ($__templater->escape($__vars['profilePost']['User']['username']) ?: $__templater->escape($__vars['profilePost']['username'])) . ' wrote on ' . ($__templater->escape($__vars['profilePost']['ProfileUser']['username']) ?: 'Unknown') . '\'s profile.' . '</span>
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->fn('username_link', array($__vars['profilePost']['User'], true, array(
			'defaultname' => $__vars['profilePost']['username'],
		))) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'profile_post' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'profilePost' => '!',
		'showTargetUser' => false,
		'allowInlineMod' => true,
	), $__arguments, $__vars);
	$__finalCompiled .= '

	';
	$__templater->includeCss('message.less');
	$__finalCompiled .= '
	';
	$__templater->includeJs(array(
		'src' => 'xf/comment.js',
		'min' => '1',
	));
	$__finalCompiled .= '

	<article class="message message--simple' . ($__templater->method($__vars['profilePost'], 'isIgnored', array()) ? ' is-ignored' : '') . ' js-inlineModContainer"
		data-author="' . ($__templater->escape($__vars['profilePost']['User']['username']) ?: $__templater->escape($__vars['profilePost']['username'])) . '"
		data-content="profile-post-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . '"
		id="js-profilePost-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . '">

		<span class="u-anchorTarget" id="profile-post-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . '"></span>
		<div class="message-inner">
			<div class="message-cell message-cell--user">
				' . $__templater->callMacro('message_macros', 'user_info_simple', array(
		'user' => $__vars['profilePost']['User'],
		'fallbackName' => $__vars['profilePost']['username'],
	), $__vars) . '
			</div>
			<div class="message-cell message-cell--main">
				<div class="message-main js-quickEditTarget">
					<div class="message-content js-messageContent">
						<header class="message-attribution message-attribution--plain">
							<ul class="listInline listInline--bullet">
								<li class="message-attribution-user">
									' . $__templater->fn('avatar', array($__vars['profilePost']['User'], 'xxs', false, array(
	))) . '
									<h4 class="attribution">' . $__templater->callMacro(null, 'attribution', array(
		'profilePost' => $__vars['profilePost'],
		'showTargetUser' => $__vars['showTargetUser'],
	), $__vars) . '</h4>
								</li>
								<li><a href="' . $__templater->fn('link', array('profile-posts', $__vars['profilePost'], ), true) . '" class="u-concealed" rel="nofollow">' . $__templater->fn('date_dynamic', array($__vars['profilePost']['post_date'], array(
	))) . '</a></li>
							</ul>
						</header>

						';
	if ($__vars['profilePost']['message_state'] == 'deleted') {
		$__finalCompiled .= '
							<div class="messageNotice messageNotice--deleted">
								' . $__templater->callMacro('deletion_macros', 'notice', array(
			'log' => $__vars['profilePost']['DeletionLog'],
		), $__vars) . '
							</div>
						';
	} else if ($__vars['profilePost']['message_state'] == 'moderated') {
		$__finalCompiled .= '
							<div class="messageNotice messageNotice--moderated">
								' . 'Bài viết này đang chờ phê duyệt của người kiểm duyệt và không nhìn thấy được đối với khách truy cập bình thường.' . '
							</div>
						';
	}
	$__finalCompiled .= '
						';
	if ($__vars['profilePost']['warning_message']) {
		$__finalCompiled .= '
							<div class="messageNotice messageNotice--warning">
								' . $__templater->escape($__vars['profilePost']['warning_message']) . '
							</div>
						';
	}
	$__finalCompiled .= '
						';
	if ($__templater->method($__vars['profilePost'], 'isIgnored', array())) {
		$__finalCompiled .= '
							<div class="messageNotice messageNotice--ignored">
								' . 'Bạn đang bỏ qua nội dung bởi thành viên này.' . '
							</div>
						';
	}
	$__finalCompiled .= '

						<article class="message-body">
							' . $__templater->fn('structured_text', array($__vars['profilePost']['message'], ), true) . '
						</article>
					</div>


					<footer class="message-footer">
						<div class="message-actionBar actionBar">
							';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
									';
	if ($__templater->method($__vars['profilePost'], 'canLike', array())) {
		$__compilerTemp1 .= '
										<a href="' . $__templater->fn('link', array('profile-posts/like', $__vars['profilePost'], ), true) . '" class="actionBar-action actionBar-action--like" data-xf-click="like" data-like-list="< .message | .js-likeList">';
		if ($__templater->method($__vars['profilePost'], 'isLiked', array())) {
			$__compilerTemp1 .= 'Bỏ thích';
		} else {
			$__compilerTemp1 .= 'Thích';
		}
		$__compilerTemp1 .= '</a>
									';
	}
	$__compilerTemp1 .= '
									';
	if ($__templater->method($__vars['profilePost'], 'canComment', array())) {
		$__compilerTemp1 .= '
										<a class="actionBar-action actionBar-action--reply"
											data-xf-click="toggle"
											data-target=".js-commentsTarget-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . '"
											data-scroll-to="true"
											role="button"
											tabindex="0">' . 'Bình luận' . '</a>
									';
	}
	$__compilerTemp1 .= '
								';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
								<div class="actionBar-set actionBar-set--external">
								' . $__compilerTemp1 . '
								</div>
							';
	}
	$__finalCompiled .= '

							';
	$__compilerTemp2 = '';
	$__compilerTemp2 .= '
									';
	if ($__vars['allowInlineMod'] AND $__templater->method($__vars['profilePost'], 'canUseInlineModeration', array())) {
		$__compilerTemp2 .= '
										' . $__templater->formCheckBox(array(
			'standalone' => 'true',
		), array(array(
			'value' => $__vars['profilePost']['profile_post_id'],
			'labelclass' => 'actionBar-action actionBar-action--inlineMod',
			'class' => 'js-inlineModToggle',
			'data-xf-init' => 'tooltip',
			'title' => $__templater->filter('Chọn để kiểm duyệt', array(array('for_attr', array()),), false),
			'_type' => 'option',
		))) . '
									';
	}
	$__compilerTemp2 .= '
									';
	if ($__templater->method($__vars['profilePost'], 'canReport', array())) {
		$__compilerTemp2 .= '
										<a href="' . $__templater->fn('link', array('profile-posts/report', $__vars['profilePost'], ), true) . '" class="actionBar-action actionBar-action--report" data-xf-click="overlay">' . 'Báo cáo' . '</a>
									';
	}
	$__compilerTemp2 .= '

									';
	$__vars['hasActionBarMenu'] = false;
	$__compilerTemp2 .= '
									';
	if ($__templater->method($__vars['profilePost'], 'canEdit', array())) {
		$__compilerTemp2 .= '
										';
		$__templater->includeJs(array(
			'src' => 'xf/message.js',
			'min' => '1',
		));
		$__compilerTemp2 .= '
										<a href="' . $__templater->fn('link', array('profile-posts/edit', $__vars['profilePost'], ), true) . '"
											class="actionBar-action actionBar-action--edit actionBar-action--menuItem"
											data-xf-click="quick-edit"
											data-editor-target="#js-profilePost-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . ' .js-quickEditTarget"
											data-no-inline-mod="' . ((!$__vars['allowInlineMod']) ? 1 : 0) . '"
											data-menu-closer="true">' . 'Sửa' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__compilerTemp2 .= '
									';
	}
	$__compilerTemp2 .= '
									';
	if ($__templater->method($__vars['profilePost'], 'canDelete', array('soft', ))) {
		$__compilerTemp2 .= '
										<a href="' . $__templater->fn('link', array('profile-posts/delete', $__vars['profilePost'], ), true) . '"
											class="actionBar-action actionBar-action--delete actionBar-action--menuItem"
											data-xf-click="overlay">' . 'Xóa' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__compilerTemp2 .= '
									';
	}
	$__compilerTemp2 .= '
									';
	if ($__templater->method($__vars['profilePost'], 'canCleanSpam', array())) {
		$__compilerTemp2 .= '
										<a href="' . $__templater->fn('link', array('spam-cleaner', $__vars['profilePost'], ), true) . '"
											class="actionBar-action actionBar-action--spam actionBar-action--menuItem"
											data-xf-click="overlay">' . 'Spam' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__compilerTemp2 .= '
									';
	}
	$__compilerTemp2 .= '
									';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewIps', array()) AND $__vars['profilePost']['ip_id']) {
		$__compilerTemp2 .= '
										<a href="' . $__templater->fn('link', array('profile-posts/ip', $__vars['profilePost'], ), true) . '"
											class="actionBar-action actionBar-action--ip actionBar-action--menuItem"
											data-xf-click="overlay">' . 'IP' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__compilerTemp2 .= '
									';
	}
	$__compilerTemp2 .= '
									';
	if ($__templater->method($__vars['profilePost'], 'canWarn', array())) {
		$__compilerTemp2 .= '
										<a href="' . $__templater->fn('link', array('profile-posts/warn', $__vars['profilePost'], ), true) . '"
											class="actionBar-action actionBar-action--warn actionBar-action--menuItem">' . 'Cảnh cáo' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__compilerTemp2 .= '
									';
	} else if ($__vars['profilePost']['warning_id'] AND $__templater->method($__vars['xf']['visitor'], 'canViewWarnings', array())) {
		$__compilerTemp2 .= '
										<a href="' . $__templater->fn('link', array('warnings', array('warning_id' => $__vars['profilePost']['warning_id'], ), ), true) . '"
											class="actionBar-action actionBar-action--warn actionBar-action--menuItem"
											data-xf-click="overlay">' . 'View Warning' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__compilerTemp2 .= '
									';
	}
	$__compilerTemp2 .= '

									';
	if ($__vars['hasActionBarMenu']) {
		$__compilerTemp2 .= '
										<a class="actionBar-action actionBar-action--menuTrigger"
											data-xf-click="menu"
											title="' . $__templater->filter('Thêm tùy chọn', array(array('for_attr', array()),), true) . '"
											role="button"
											tabindex="0"
											aria-expanded="false"
											aria-haspopup="true">&#8226;&#8226;&#8226;</a>
										<div class="menu" data-menu="menu" aria-hidden="true" data-menu-builder="actionBar">
											<div class="menu-content">
												<h4 class="menu-header">' . 'Thêm tùy chọn' . '</h4>
												<div class="js-menuBuilderTarget"></div>
											</div>
										</div>
									';
	}
	$__compilerTemp2 .= '
								';
	if (strlen(trim($__compilerTemp2)) > 0) {
		$__finalCompiled .= '
								<div class="actionBar-set actionBar-set--internal">
								' . $__compilerTemp2 . '
								</div>
							';
	}
	$__finalCompiled .= '

						</div>

						<section class="message-responses js-messageResponses">
							<div class="message-responseRow message-responseRow--likes js-likeList ' . ($__vars['profilePost']['likes'] ? 'is-active' : '') . '">';
	if ($__vars['profilePost']['likes']) {
		$__finalCompiled .= '
								' . $__templater->fn('likes_content', array($__vars['profilePost'], $__templater->fn('link', array('profile-posts/likes', $__vars['profilePost'], ), false), array(
			'url' => $__templater->fn('link', array('profile-posts/likes', $__vars['profilePost'], ), false),
		))) . '
							';
	}
	$__finalCompiled .= '</div>

							';
	if (!$__templater->test($__vars['profilePost']['LatestComments'], 'empty', array())) {
		$__finalCompiled .= '
								';
		if ($__templater->method($__vars['profilePost'], 'hasMoreComments', array())) {
			$__finalCompiled .= '
									<div class="message-responseRow u-jsOnly js-commentLoader">
										<a href="' . $__templater->fn('link', array('profile-posts/load-previous', $__vars['profilePost'], array('before' => $__templater->arrayKey($__templater->method($__vars['profilePost']['LatestComments'], 'first', array()), 'comment_date'), ), ), true) . '"
											data-xf-click="comment-loader"
											data-container=".js-commentLoader"
											rel="nofollow">' . 'Xem nhận xét trước' . $__vars['xf']['language']['ellipsis'] . '</a>
									</div>
								';
		}
		$__finalCompiled .= '
								<div class="js-replyNewMessageContainer">
									';
		if ($__templater->isTraversable($__vars['profilePost']['LatestComments'])) {
			foreach ($__vars['profilePost']['LatestComments'] AS $__vars['comment']) {
				$__finalCompiled .= '
										' . $__templater->callMacro(null, (($__vars['comment']['message_state'] == 'deleted') ? 'comment_deleted' : 'comment'), array(
					'comment' => $__vars['comment'],
					'profilePost' => $__vars['profilePost'],
				), $__vars) . '
									';
			}
		}
		$__finalCompiled .= '
								</div>
								';
	} else {
		$__finalCompiled .= '
								<div class="js-replyNewMessageContainer"></div>
							';
	}
	$__finalCompiled .= '

							';
	if ($__templater->method($__vars['profilePost'], 'canComment', array())) {
		$__finalCompiled .= '
								';
		$__templater->includeJs(array(
			'src' => 'xf/message.js',
			'min' => '1',
		));
		$__finalCompiled .= '
								<div class="message-responseRow js-commentsTarget-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . ' toggleTarget">
									';
		$__vars['lastProfilePostComment'] = $__templater->filter($__vars['profilePost']['LatestComments'], array(array('last', array()),), false);
		$__finalCompiled .= $__templater->form('
										<div class="comment-inner">
											<span class="comment-avatar">
												' . $__templater->fn('avatar', array($__vars['xf']['visitor'], 'xxs', false, array(
		))) . '
											</span>
											<div class="comment-main">
												' . $__templater->formTextArea(array(
			'name' => 'message',
			'rows' => '1',
			'autosize' => 'true',
			'maxlength' => $__vars['xf']['options']['profilePostMaxLength'],
			'class' => 'comment-input js-editor',
			'data-xf-init' => 'user-mentioner',
			'data-toggle-autofocus' => '1',
			'placeholder' => 'Viết bình luận' . $__vars['xf']['language']['ellipsis'],
		)) . '
												<div>
													' . $__templater->button('
														' . 'Đăng bình luận' . '
													', array(
			'type' => 'submit',
			'class' => 'button--primary button--small',
		), '', array(
		)) . '
												</div>
											</div>
										</div>
										' . '' . '
										' . $__templater->formHiddenVal('last_date', $__vars['lastProfilePostComment']['comment_date'], array(
		)) . '
									', array(
			'action' => $__templater->fn('link', array('profile-posts/add-comment', $__vars['profilePost'], ), false),
			'ajax' => 'true',
			'class' => 'comment',
			'data-xf-init' => 'quick-reply',
			'data-message-container' => '< .js-messageResponses | .js-replyNewMessageContainer',
		)) . '
								</div>
							';
	}
	$__finalCompiled .= '
						</section>
					</footer>
				</div>
			</div>
		</div>
	</article>
';
	return $__finalCompiled;
},
'profile_post_deleted' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'profilePost' => '!',
		'showTargetUser' => false,
	), $__arguments, $__vars);
	$__finalCompiled .= '

	';
	$__templater->includeCss('message.less');
	$__finalCompiled .= '
	<div class="message message--simple' . ($__templater->method($__vars['profilePost'], 'isIgnored', array()) ? ' is-ignored' : '') . ' js-inlineModContainer"
		data-author="' . ($__templater->escape($__vars['profilePost']['User']['username']) ?: $__templater->escape($__vars['profilePost']['username'])) . '"
		data-content="profile-post-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . '">

		<span class="u-anchorTarget" id="profile-post-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . '"></span>
		<div class="message-inner">
			<div class="message-cell message-cell--user">
				' . $__templater->callMacro('message_macros', 'user_info_simple', array(
		'user' => $__vars['profilePost']['User'],
		'fallbackName' => $__vars['profilePost']['username'],
	), $__vars) . '
			</div>
			<div class="message-cell message-cell--main">
				<div class="message-attribution message-attribution--plain">
					<ul class="listInline listInline--bullet">
						<li class="message-attribution-user">
							' . $__templater->fn('avatar', array($__vars['profilePost']['User'], 'xxs', false, array(
	))) . '
							<h4 class="attribution">' . $__templater->callMacro(null, 'attribution', array(
		'profilePost' => $__vars['profilePost'],
		'showTargetUser' => $__vars['showTargetUser'],
	), $__vars) . '</h4>
						</li>
						<li>' . $__templater->fn('date_dynamic', array($__vars['profilePost']['post_date'], array(
	))) . '</li>
					</ul>
				</div>

				<div class="messageNotice messageNotice--deleted">
					' . $__templater->callMacro('deletion_macros', 'notice', array(
		'log' => $__vars['profilePost']['DeletionLog'],
	), $__vars) . '

					<a href="' . $__templater->fn('link', array('profile-posts/show', $__vars['profilePost'], ), true) . '" class="u-jsOnly" data-xf-click="inserter" data-replace="[data-content=profile-post-' . $__templater->escape($__vars['profilePost']['profile_post_id']) . ']">' . 'Hiển thị' . $__vars['xf']['language']['ellipsis'] . '</a>
				</div>
			</div>
		</div>
	</div>
';
	return $__finalCompiled;
},
'profile_post_simple' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'profilePost' => '!',
		'limitHeight' => false,
	), $__arguments, $__vars);
	$__finalCompiled .= '

	<div class="contentRow">
		<div class="contentRow-figure">
			' . $__templater->fn('avatar', array($__vars['profilePost']['User'], 'xxs', false, array(
		'defaultname' => $__vars['profilePost']['username'],
	))) . '
		</div>
		<div class="contentRow-main contentRow-main--close">
			<div class="contentRow-lesser">
				' . $__templater->callMacro(null, 'attribution', array(
		'profilePost' => $__vars['profilePost'],
		'showTargetUser' => true,
	), $__vars) . '
			</div>

			';
	if ($__vars['limitHeight']) {
		$__finalCompiled .= '
				<div class="contentRow-faderContainer">
					<div class="contentRow-faderContent">
						' . $__templater->fn('structured_text', array($__vars['profilePost']['message'], ), true) . '
					</div>
					<div class="contentRow-fader"></div>
				</div>
			';
	} else {
		$__finalCompiled .= '
				' . $__templater->fn('structured_text', array($__vars['profilePost']['message'], ), true) . '
			';
	}
	$__finalCompiled .= '

			<div class="contentRow-minor">
				<a href="' . $__templater->fn('link', array('profile-posts', $__vars['profilePost'], ), true) . '" rel="nofollow" class="u-concealed">' . $__templater->fn('date_dynamic', array($__vars['profilePost']['post_date'], array(
	))) . '</a>
				<a href="' . $__templater->fn('link', array('profile-posts', $__vars['profilePost'], ), true) . '" rel="nofollow" class="contentRow-extra" data-xf-click="overlay" data-xf-init="tooltip" title="' . $__templater->filter('Tương tác', array(array('for_attr', array()),), true) . '">&#8226;&#8226;&#8226;</a>
			</div>
		</div>
	</div>
';
	return $__finalCompiled;
},
'comment' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'comment' => '!',
		'profilePost' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '

	<div class="message-responseRow">
		<div class="comment' . ($__templater->method($__vars['comment'], 'isIgnored', array()) ? ' is-ignored' : '') . '"
			data-author="' . $__templater->escape($__vars['comment']['User']['username']) . '"
			data-content="profile-post-comment-' . $__templater->escape($__vars['comment']['profile_post_comment_id']) . '"
			id="js-profilePostComment-' . $__templater->escape($__vars['comment']['profile_post_comment_id']) . '">

			<div class="comment-inner">
				<span class="comment-avatar">
					' . $__templater->fn('avatar', array($__vars['comment']['User'], 'xxs', false, array(
		'defaultname' => $__vars['comment']['username'],
	))) . '
				</span>
				<div class="comment-main">
					<span class="u-anchorTarget" id="profile-post-comment-' . $__templater->escape($__vars['comment']['profile_post_comment_id']) . '"></span>
					<div class="js-quickEditTargetComment">
						<div class="comment-content">
							';
	if ($__vars['comment']['message_state'] == 'deleted') {
		$__finalCompiled .= '
								<div class="messageNotice messageNotice--deleted">
									' . $__templater->callMacro('deletion_macros', 'notice', array(
			'log' => $__vars['comment']['DeletionLog'],
		), $__vars) . '
								</div>
							';
	} else if ($__vars['comment']['message_state'] == 'moderated') {
		$__finalCompiled .= '
								<div class="messageNotice messageNotice--moderated">
									' . 'Bài viết này đang chờ phê duyệt của người kiểm duyệt và không nhìn thấy được đối với khách truy cập bình thường.' . '
								</div>
							';
	}
	$__finalCompiled .= '
							';
	if ($__vars['comment']['warning_message']) {
		$__finalCompiled .= '
								<div class="messageNotice messageNotice--warning">
									' . $__templater->escape($__vars['comment']['warning_message']) . '
								</div>
							';
	}
	$__finalCompiled .= '
							';
	if ($__templater->method($__vars['comment'], 'isIgnored', array())) {
		$__finalCompiled .= '
								<div class="messageNotice messageNotice--ignored">
									' . 'Bạn đang bỏ qua nội dung bởi thành viên này.' . '
								</div>
							';
	}
	$__finalCompiled .= '

							<div class="comment-contentWrapper">
								' . $__templater->fn('username_link', array($__vars['comment']['User'], true, array(
		'defaultname' => $__vars['comment']['username'],
		'class' => 'comment-user',
	))) . '
								<article class="comment-body">' . $__templater->fn('structured_text', array($__vars['comment']['message'], ), true) . '</article>
							</div>
						</div>

						<footer class="comment-footer">
							<div class="comment-actionBar actionBar">
								<div class="actionBar-set actionBar-set--internal">
									<span class="actionBar-action">' . $__templater->fn('date_dynamic', array($__vars['comment']['comment_date'], array(
	))) . '</span>
									';
	if ($__templater->method($__vars['comment'], 'canReport', array())) {
		$__finalCompiled .= '
										<a href="' . $__templater->fn('link', array('profile-posts/comments/report', $__vars['comment'], ), true) . '"
											class="actionBar-action actionBar-action--report"
											data-xf-click="overlay">' . 'Báo cáo' . '</a>
									';
	}
	$__finalCompiled .= '

									';
	$__vars['hasActionBarMenu'] = false;
	$__finalCompiled .= '
									';
	if ($__templater->method($__vars['comment'], 'canEdit', array())) {
		$__finalCompiled .= '
										';
		$__templater->includeJs(array(
			'src' => 'xf/message.js',
			'min' => '1',
		));
		$__finalCompiled .= '
										<a href="' . $__templater->fn('link', array('profile-posts/comments/edit', $__vars['comment'], ), true) . '"
											class="actionBar-action actionBar-action--edit actionBar-action--menuItem"
											data-xf-click="quick-edit"
											data-editor-target="#js-profilePostComment-' . $__templater->escape($__vars['comment']['profile_post_comment_id']) . ' .js-quickEditTargetComment"
											data-menu-closer="true">' . 'Sửa' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__finalCompiled .= '
									';
	}
	$__finalCompiled .= '
									';
	if ($__templater->method($__vars['comment'], 'canDelete', array('soft', ))) {
		$__finalCompiled .= '
										<a href="' . $__templater->fn('link', array('profile-posts/comments/delete', $__vars['comment'], ), true) . '"
											class="actionBar-action actionBar-action--delete actionBar-action--menuItem"
											data-xf-click="overlay">' . 'Xóa' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__finalCompiled .= '
									';
	}
	$__finalCompiled .= '
									';
	if (($__vars['comment']['message_state'] == 'deleted') AND $__templater->method($__vars['comment'], 'canUndelete', array())) {
		$__finalCompiled .= '
										<a href="' . $__templater->fn('link', array('profile-posts/comments/undelete', $__vars['comment'], array('t' => $__templater->fn('csrf_token', array(), false), ), ), true) . '"
											class="actionBar-action actionBar-action--undelete actionBar-action--menuItem">' . 'Khôi phục' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__finalCompiled .= '
									';
	}
	$__finalCompiled .= '
									';
	if ($__templater->method($__vars['comment'], 'canCleanSpam', array())) {
		$__finalCompiled .= '
										<a href="' . $__templater->fn('link', array('spam-cleaner', $__vars['comment'], ), true) . '"
											class="actionBar-action actionBar-action--spam actionBar-action--menuItem"
											data-xf-click="overlay">' . 'Spam' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__finalCompiled .= '
									';
	}
	$__finalCompiled .= '
									';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewIps', array()) AND $__vars['comment']['ip_id']) {
		$__finalCompiled .= '
										<a href="' . $__templater->fn('link', array('profile-posts/comments/ip', $__vars['comment'], ), true) . '"
											class="actionBar-action actionBar-action--ip actionBar-action--menuItem"
											data-xf-click="overlay">' . 'IP' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__finalCompiled .= '
									';
	}
	$__finalCompiled .= '
									';
	if ($__templater->method($__vars['comment'], 'canWarn', array())) {
		$__finalCompiled .= '
										<a href="' . $__templater->fn('link', array('profile-posts/comments/warn', $__vars['comment'], ), true) . '"
											class="actionBar-action actionBar-action--warn actionBar-action--menuItem">' . 'Cảnh cáo' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__finalCompiled .= '
									';
	} else if ($__vars['comment']['warning_id'] AND $__templater->method($__vars['xf']['visitor'], 'canViewWarnings', array())) {
		$__finalCompiled .= '
										<a href="' . $__templater->fn('link', array('warnings', array('warning_id' => $__vars['comment']['warning_id'], ), ), true) . '"
											class="actionBar-action actionBar-action--warn actionBar-action--menuItem"
											data-xf-click="overlay">' . 'View Warning' . '</a>
										';
		$__vars['hasActionBarMenu'] = true;
		$__finalCompiled .= '
									';
	}
	$__finalCompiled .= '
									';
	if ($__templater->method($__vars['comment'], 'canApproveUnapprove', array())) {
		$__finalCompiled .= '
										';
		if ($__vars['comment']['message_state'] == 'moderated') {
			$__finalCompiled .= '
											<a href="' . $__templater->fn('link', array('profile-posts/comments/approve', $__vars['comment'], array('t' => $__templater->fn('csrf_token', array(), false), ), ), true) . '"
												class="actionBar-action actionBar-action--approve actionBar-action--menuItem">' . 'Duyệt bài' . '</a>
											';
			$__vars['hasActionBarMenu'] = true;
			$__finalCompiled .= '
										';
		} else if ($__vars['comment']['message_state'] == 'visible') {
			$__finalCompiled .= '
											<a href="' . $__templater->fn('link', array('profile-posts/comments/unapprove', $__vars['comment'], array('t' => $__templater->fn('csrf_token', array(), false), ), ), true) . '"
												class="actionBar-action actionBar-action--unapprove actionBar-action--menuItem">' . 'Bỏ duyệt' . '</a>
											';
			$__vars['hasActionBarMenu'] = true;
			$__finalCompiled .= '
										';
		}
		$__finalCompiled .= '
									';
	}
	$__finalCompiled .= '

									';
	if ($__vars['hasActionBarMenu']) {
		$__finalCompiled .= '
										<a class="actionBar-action actionBar-action--menuTrigger"
											data-xf-click="menu"
											title="' . $__templater->filter('Thêm tùy chọn', array(array('for_attr', array()),), true) . '"
											role="button"
											tabindex="0"
											aria-expanded="false"
											aria-haspopup="true">&#8226;&#8226;&#8226;</a>
										<div class="menu" data-menu="menu" aria-hidden="true" data-menu-builder="actionBar">
											<div class="menu-content">
												<h4 class="menu-header">' . 'Thêm tùy chọn' . '</h4>
												<div class="js-menuBuilderTarget"></div>
											</div>
										</div>
									';
	}
	$__finalCompiled .= '
								</div>
								';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
										';
	if ($__templater->method($__vars['comment'], 'canLike', array())) {
		$__compilerTemp1 .= '
											<a href="' . $__templater->fn('link', array('profile-posts/comments/like', $__vars['comment'], ), true) . '" class="actionBar-action actionBar-action--like" data-xf-click="like" data-like-list="< .comment | .js-commentLikeList">';
		if ($__templater->method($__vars['comment'], 'isLiked', array())) {
			$__compilerTemp1 .= 'Bỏ thích';
		} else {
			$__compilerTemp1 .= 'Thích';
		}
		$__compilerTemp1 .= '</a>
										';
	}
	$__compilerTemp1 .= '
									';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
									<div class="actionBar-set actionBar-set--external">
									' . $__compilerTemp1 . '
									</div>
								';
	}
	$__finalCompiled .= '
							</div>

							<div class="comment-likes js-commentLikeList ' . ($__vars['comment']['likes'] ? 'is-active' : '') . '">';
	if ($__vars['comment']['likes']) {
		$__finalCompiled .= '
								' . $__templater->fn('likes_content', array($__vars['comment'], $__templater->fn('link', array('profile-posts/comments/likes', $__vars['comment'], ), false), array(
			'url' => $__templater->fn('link', array('profile-posts/comments/likes', $__vars['comment'], ), false),
		))) . '
							';
	}
	$__finalCompiled .= '</div>
						</footer>

					</div>
				</div>
			</div>
		</div>
	</div>
';
	return $__finalCompiled;
},
'comment_deleted' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'comment' => '!',
		'profilePost' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '

	<div class="message-responseRow">
		<div class="comment' . ($__templater->method($__vars['comment'], 'isIgnored', array()) ? ' is-ignored' : '') . '"
			data-author="' . $__templater->escape($__vars['comment']['User']['username']) . '"
			data-content="profile-post-comment-' . $__templater->escape($__vars['comment']['profile_post_comment_id']) . '">

			<div class="comment-inner">
				<span class="comment-avatar">
					' . $__templater->fn('avatar', array($__vars['comment']['User'], 'xxs', false, array(
		'defaultname' => $__vars['comment']['username'],
	))) . '
				</span>
				<div class="comment-main">
					<span class="u-anchorTarget" id="profile-post-comment-' . $__templater->escape($__vars['comment']['profile_post_comment_id']) . '"></span>
					<div class="comment-content">
						<div class="messageNotice messageNotice--deleted">
							' . $__templater->callMacro('deletion_macros', 'notice', array(
		'log' => $__vars['comment']['DeletionLog'],
	), $__vars) . '

							<a href="' . $__templater->fn('link', array('profile-posts/comments/show', $__vars['comment'], ), true) . '" class="u-jsOnly"
								data-xf-click="inserter"
								data-replace="[data-content=profile-post-comment-' . $__templater->escape($__vars['comment']['profile_post_comment_id']) . ']">' . 'Hiển thị' . $__vars['xf']['language']['ellipsis'] . '</a>
						</div>
					</div>

					<div class="comment-actionBar actionBar">
						<div class="actionBar-set actionBar-set--internal">
							<span class="actionBar-action">
								' . $__templater->fn('date_dynamic', array($__vars['comment']['comment_date'], array(
	))) . '
								<span role="presentation" aria-hidden="true">&middot;</span>
								' . $__templater->fn('username_link', array($__vars['comment']['User'], false, array(
		'defaultname' => $__vars['comment']['username'],
		'class' => 'u-concealed',
	))) . '
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
';
	return $__finalCompiled;
},
'submit' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
		'lastDate' => '!',
		'containerSelector' => '!',
		'style' => 'full',
		'context' => 'user',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__templater->includeJs(array(
		'src' => 'xf/message.js',
		'min' => '1',
	));
	$__finalCompiled .= '
	';
	if ($__vars['style'] == 'full') {
		$__finalCompiled .= '
		';
		$__templater->includeCss('message.less');
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

	';
	$__compilerTemp1 = '';
	if ($__vars['style'] == 'full') {
		$__compilerTemp1 .= '
			<div class="message-inner">
				<div class="message-cell message-cell--user">
					' . $__templater->callMacro('message_macros', 'user_info_simple', array(
			'user' => $__vars['xf']['visitor'],
		), $__vars) . '
				</div>
				<div class="message-cell message-cell--main">
		';
	}
	$__compilerTemp2 = '';
	if ($__vars['style'] == 'full') {
		$__compilerTemp2 .= '
				</div>
			</div>
		';
	}
	$__finalCompiled .= $__templater->form('

		' . $__compilerTemp1 . '
				<div class="message-editorWrapper">
					' . $__templater->formTextArea(array(
		'name' => 'message',
		'autosize' => 'true',
		'rows' => '1',
		'maxlength' => $__vars['xf']['options']['profilePostMaxLength'],
		'class' => (($__vars['style'] == 'full') ? 'input--avatarSizeS' : '') . ' js-editor',
		'data-xf-init' => 'focus-trigger user-mentioner',
		'data-display' => '< :next',
		'placeholder' => (($__vars['xf']['visitor']['user_id'] == $__vars['user']['user_id']) ? 'Cập nhật trạng thái' . $__vars['xf']['language']['ellipsis'] : 'Viết một vài điều gì đó' . $__vars['xf']['language']['ellipsis']),
	)) . '

					<div class="u-hidden u-hidden--transition u-inputSpacer">
						' . $__templater->button('Post', array(
		'type' => 'submit',
		'class' => 'button--primary',
	), '', array(
	)) . '
					</div>
				</div>
		' . $__compilerTemp2 . '
		' . '
		' . $__templater->formHiddenVal('last_date', $__vars['lastDate'], array(
	)) . '
		' . $__templater->formHiddenVal('style', $__vars['style'], array(
	)) . '
		' . $__templater->formHiddenVal('context', $__vars['context'], array(
	)) . '
	', array(
		'action' => $__templater->fn('link', array('members/post', $__vars['user'], ), false),
		'ajax' => 'true',
		'class' => (($__vars['style'] == 'full') ? 'message message--simple' : 'block-row'),
		'data-xf-init' => 'quick-reply',
		'data-message-container' => $__vars['containerSelector'],
		'data-ascending' => '0',
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

' . '

' . '

' . '

' . '

';
	return $__finalCompiled;
});