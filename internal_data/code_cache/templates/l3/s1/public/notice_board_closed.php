<?php
// FROM HASH: ff899b2eabdbaaffe7ce0692b513c19f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= 'Diễn đàn hiện tại đang đóng cửa. Chỉ có Ban quản trị mới có thể vào diễn đàn.' . '<br />
<a href="' . $__templater->fn('link_type', array('admin', 'options/groups', array('group_id' => 'boardActive', ), ), true) . '">' . 'Mở lại diễn đàn qua bảng điều khiển' . '</a>';
	return $__finalCompiled;
});