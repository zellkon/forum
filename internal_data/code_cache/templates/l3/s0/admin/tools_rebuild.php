<?php
// FROM HASH: d284ec3a34fbd76c000962710be34bca
return array('macros' => array('rebuild_job' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'header' => '!',
		'body' => '',
		'submit' => 'Cập nhật ngay',
		'job' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = '';
	if ($__vars['body']) {
		$__compilerTemp1 .= '<div class="block-body">' . $__templater->filter($__vars['body'], array(array('raw', array()),), true) . '</div>';
	}
	$__finalCompiled .= $__templater->form('
		<div class="block-container">
			<h2 class="block-header">' . $__templater->filter($__vars['header'], array(array('raw', array()),), true) . '</h2>
			' . $__compilerTemp1 . '
			' . $__templater->formSubmitRow(array(
		'submit' => $__templater->escape($__vars['submit']),
	), array(
	)) . '
		</div>
		' . $__templater->formHiddenVal('job', $__vars['job'], array(
	)) . '
	', array(
		'action' => $__templater->fn('link', array('tools/rebuild', ), false),
		'class' => 'block',
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Cập nhật bộ nhớ đệm');
	$__finalCompiled .= '

';
	if ($__vars['success']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--success blockMessage--iconic">' . 'Bộ nhớ đệm được xây dựng lại thành công.' . '</div>
';
	}
	$__finalCompiled .= '

';
	if ($__vars['hasStoppedManualJobs']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--important blockMessage--iconic">
		' . 'There are manual rebuild jobs awaiting completion. <a href="' . $__templater->fn('link', array('tools/run-job', ), true) . '">Continue running them.</a>' . '
	</div>
';
	}
	$__finalCompiled .= '

' . '

';
	$__compilerTemp1 = array(array(
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'Tất cả' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	$__compilerTemp1 = $__templater->mergeChoiceOptions($__compilerTemp1, $__templater->method($__vars['xf']['app'], 'getContentTypePhrases', array(true, 'search_handler_class', )));
	$__vars['searchBody'] = $__templater->preEscaped('
	' . $__templater->formSelectRow(array(
		'name' => 'options[type]',
	), $__compilerTemp1, array(
		'label' => 'Content type',
	)) . '

	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'options[truncate]',
		'label' => 'Xóa chỉ mục trước khi cập nhật',
		'_type' => 'option',
	)), array(
	)) . '

	' . $__templater->formNumberBoxRow(array(
		'name' => 'options[batch]',
		'value' => '500',
		'min' => '1',
	), array(
		'label' => 'Items to process per page',
	)) . '
');
	$__finalCompiled .= '
' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật chỉ mục tìm kiếm',
		'body' => $__vars['searchBody'],
		'job' => 'XF:SearchRebuild',
	), $__vars) . '
' . '

';
	$__vars['threadBody'] = $__templater->preEscaped('
	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'options[position_rebuild]',
		'value' => '1',
		'label' => 'Rebuild position and post counters',
		'hint' => 'This will slow the process down and is only needed if posts are shown in an incorrect order or to show users when they have posted in a thread.',
		'_type' => 'option',
	)), array(
	)) . '
');
	$__finalCompiled .= '
' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật chủ đề',
		'body' => $__vars['threadBody'],
		'job' => 'XF:Thread',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật diễn đàn',
		'job' => 'XF:Forum',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật bộ nhớ đệm thành viên',
		'job' => 'XF:User',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Rebuild User Group Promotions',
		'job' => 'XF:UserGroupPromotion',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật lại danh hiệu',
		'job' => 'XF:Trophy',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật lượt thích',
		'job' => 'XF:LikeCount',
	), $__vars) . '
' . '

';
	$__compilerTemp2 = $__templater->mergeChoiceOptions(array(), $__templater->method($__vars['xf']['app'], 'getContentTypePhrases', array(true, 'like_handler_class', )));
	$__vars['likesCountedBody'] = $__templater->preEscaped('
	' . $__templater->formSelectRow(array(
		'name' => 'options[type]',
	), $__compilerTemp2, array(
		'label' => 'Content type',
	)) . '
');
	$__finalCompiled .= '
' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Rebuild likes counted status',
		'body' => $__vars['likesCountedBody'],
		'job' => 'XF:LikeIsCounted',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật ảnh thu nhỏ đính kèm',
		'job' => 'XF:AttachmentThumb',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật cuộc trò chuyện',
		'job' => 'XF:Conversation',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật bài viết trên hồ sơ',
		'job' => 'XF:ProfilePost',
	), $__vars) . '
' . '

' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Rebuild Poll Information',
		'job' => 'XF:Poll',
	), $__vars) . '
' . '

';
	$__vars['statsBody'] = $__templater->preEscaped('
	' . $__templater->formNumberBoxRow(array(
		'name' => 'options[batch]',
		'value' => '28',
		'min' => '1',
	), array(
		'label' => 'Days to process per page',
	)) . '

	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'options[delete]',
		'value' => '1',
		'label' => 'Delete existing cached data',
		'hint' => 'Some data may not be rebuilt retroactively. Use this option only if you have a specific reason to do so. Data deletion can not be undone.',
		'_type' => 'option',
	)), array(
	)) . '
');
	$__finalCompiled .= '
' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật thống kê hàng ngày',
		'body' => $__vars['statsBody'],
		'job' => 'XF:Stats',
	), $__vars) . '
' . '

' . $__templater->form('
	<div class="block-container">
		<h2 class="block-header">' . 'Clean Up Permissions' . '</h2>
		<div class="block-body">
			' . $__templater->formInfoRow('This will clean up any permission combinations which are no longer in use. This can speed up permission update and rebuild operations and remove unused data from the database.', array(
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Run',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('tools/clean-up-permissions', ), false),
		'class' => 'block',
	)) . '
' . '

';
	$__vars['postMdBody'] = $__templater->preEscaped('
	' . $__templater->formCheckBoxRow(array(
		'name' => 'options[types]',
		'listclass' => 'listColumns',
	), array(array(
		'value' => 'attachments',
		'label' => 'Đính kèm',
		'selected' => true,
		'_type' => 'option',
	)), array(
	)) . '
');
	$__finalCompiled .= '
' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Rebuild post embed metadata',
		'body' => $__vars['postMdBody'],
		'job' => 'XF:PostEmbedMetadata',
	), $__vars) . '

';
	$__vars['conversationMdBody'] = $__templater->preEscaped('
	' . $__templater->formCheckBoxRow(array(
		'name' => 'options[types]',
		'listclass' => 'listColumns',
	), array(array(
		'value' => 'attachments',
		'label' => 'Đính kèm',
		'selected' => true,
		'_type' => 'option',
	)), array(
	)) . '
');
	$__finalCompiled .= '
' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Rebuild conversation embed metadata',
		'body' => $__vars['conversationMdBody'],
		'job' => 'XF:ConversationEmbedMetadata',
	), $__vars) . '
' . '

';
	$__vars['sitemapBody'] = $__templater->preEscaped('
	' . $__templater->formInfoRow('The sitemap contents can be controlled via the <a href="admin.php?options/groups/sitemap/">XML sitemap generation</a> options.', array(
	)) . '
');
	$__finalCompiled .= '
' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Cập nhật sitemap',
		'body' => $__vars['sitemapBody'],
		'job' => 'XF:Sitemap',
	), $__vars) . '
' . '

';
	$__vars['gravatarBody'] = $__templater->preEscaped('
	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'options[posters]',
		'selected' => 1,
		'label' => 'Limit to users who have posted',
		'_type' => 'option',
	),
	array(
		'name' => 'options[import_table]',
		'label' => 'Limit to imported users logged in this table' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'options[import_table_name]',
	))),
		'_type' => 'option',
	)), array(
		'explain' => 'Any users with no avatar matching the above conditions will have a <a href="https://gravatar.com" target="_blank">Gravatar</a> applied if one exists for their email address.',
	)) . '
');
	$__finalCompiled .= '
' . $__templater->callMacro(null, 'rebuild_job', array(
		'header' => 'Fetch Gravatars for users with no avatar',
		'body' => $__vars['gravatarBody'],
		'job' => 'XF:Gravatar',
	), $__vars) . '

' . '

';
	return $__finalCompiled;
});