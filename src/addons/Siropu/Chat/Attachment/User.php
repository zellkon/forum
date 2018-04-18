<?php

namespace Siropu\Chat\Attachment;

use XF\Attachment\AbstractHandler;
use XF\Entity\Attachment;
use XF\Mvc\Entity\Entity;

class User extends AbstractHandler
{
	public function canView(Attachment $attachment, Entity $container, &$error = null)
	{
		return true;
	}
	public function canManageAttachments(array $context, &$error = null)
	{
		$visitor = \XF::visitor();

		if (!$visitor->canUploadSiropuChatImages())
		{
			return false;
		}

		return true;
	}
	public function onNewAttachment(Attachment $attachment, \XF\FileWrapper $file)
	{
		$inserter = \XF::app()->service('XF:Attachment\Preparer');
		$inserter->associateAttachmentsWithContent(
			\XF::app()->request()->filter('hash', 'string'),
			'siropu_chat',
			\XF::visitor()->user_id
		);
	}
	public function onAttachmentDelete(Attachment $attachment, Entity $container = null)
	{

	}
	public function prepareAttachmentJson(Attachment $attachment, array $context, array $json)
	{
		$json['attachment']['url'] = \XF::app()->router('public')->buildLink('attachments', $attachment);

		return $json;
	}
	public function getConstraints(array $context)
	{
		$constraints = \XF::repository('XF:Attachment')->getDefaultAttachmentConstraints();
		$constraints['extensions'] = ['png', 'jpg', 'jpeg', 'jpe', 'gif'];
		$constraints['count'] = \XF::visitor()->canUploadSiropuChatImages();

		return $constraints;
	}
	public function getContainerIdFromContext(array $context)
	{
		return isset($context['user_id']) ? intval($context['user_id']) : null;
	}
	public function getContainerLink(Entity $container, array $extraParams = [])
	{
		return \XF::app()->router('public')->buildLink('members', $container, $extraParams);
	}
	public function getContext(Entity $entity = null, array $extraContext = [])
	{
		if ($entity instanceof \XF\Entity\User)
		{
			$extraContext['user_id'] = $entity->user_id;
		}
		else if (!$entity)
		{
			// need nothing
		}
		else
		{
			throw new \InvalidArgumentException("Entity must be media, album or category");
		}

		return $extraContext;
	}
}
