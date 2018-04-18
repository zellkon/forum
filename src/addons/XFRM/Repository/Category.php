<?php

namespace XFRM\Repository;

use XF\Repository\AbstractCategoryTree;

class Category extends AbstractCategoryTree
{
	protected function getClassName()
	{
		return 'XFRM:Category';
	}

	public function mergeCategoryListExtras(array $extras, array $childExtras)
	{
		$output = array_merge([
			'childCount' => 0,
			'resource_count' => 0,
			'last_update' => 0,
			'last_resource_title' => '',
			'last_resource_id' => 0
		], $extras);

		foreach ($childExtras AS $child)
		{
			if (!empty($child['resource_count']))
			{
				$output['resource_count'] += $child['resource_count'];
			}

			if (!empty($child['last_update']) && $child['last_update'] > $output['last_update'])
			{
				$output['last_update'] = $child['last_update'];
				$output['last_resource_title'] = $child['last_resource_title'];
				$output['last_resource_id'] = $child['last_resource_id'];
			}

			$output['childCount'] += 1 + (!empty($child['childCount']) ? $child['childCount'] : 0);
		}

		return $output;
	}
}