<?php
// FROM HASH: e26535bd44b7a80163fc57bf996c12f5
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Rời cuộc trò chuyện');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped('Trò chuyện'), $__templater->fn('link', array('conversations', ), false), array(
	));
	$__finalCompiled .= '
';
	$__templater->breadcrumb($__templater->preEscaped($__templater->escape($__vars['conversation']['title'])), $__templater->fn('link', array('conversations', $__vars['conversation'], ), false), array(
	));
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Leaving a conversation will remove it from your conversation list.' . '
			', array(
	)) . '
			' . $__templater->formRadioRow(array(
		'name' => 'recipient_state',
	), array(array(
		'value' => 'deleted',
		'checked' => 'checked',
		'label' => 'Cho phép tin nhắn trong tương lai',
		'hint' => 'Should this conversation receive further responses in the future, this conversation will be restored to your inbox.',
		'_type' => 'option',
	),
	array(
		'value' => 'deleted_ignored',
		'label' => 'Ignore future messages',
		'hint' => 'You will not be notified of any future responses and the conversation will remain deleted.',
		'_type' => 'option',
	)), array(
		'label' => 'Future Message Handling',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Rời khỏi',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('conversations/leave', $__vars['conversation'], ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});