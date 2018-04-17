<?php
// FROM HASH: c15879c1a3a33752e678852b0c1a89ef
return array('macros' => array('head' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'app' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__vars['faVer'] = $__templater->preEscaped('4.7.0');
	$__finalCompiled .= '
	';
	$__vars['cssUrls'] = array('public:normalize.css', 'public:core.less', $__vars['app'] . ':app.less', );
	$__finalCompiled .= '

	';
	if ($__vars['xf']['options']['fontAwesomeSource'] == 'local') {
		$__finalCompiled .= '
		';
		$__vars['cssUrls'] = $__templater->fn('array_merge', array($__vars['cssUrls'], array('public:font_awesome.css', ), ), false);
		$__finalCompiled .= '
		<link rel="preload" href="' . $__templater->fn('base_url', array('styles/fonts/fa/fontawesome-webfont.woff2?v=' . $__vars['faVer'], ), true) . '" as="font" type="font/woff2" crossorigin="anonymous" />
	';
	}
	$__finalCompiled .= '

	<link rel="stylesheet" href="' . $__templater->fn('css_url', array($__vars['cssUrls'], ), true) . '" />

	';
	if ($__vars['xf']['options']['fontAwesomeSource'] != 'local') {
		$__finalCompiled .= '
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/' . $__templater->escape($__vars['faVer']) . '/css/font-awesome.min.css" />
	';
	}
	$__finalCompiled .= '
	<!--XF:CSS-->
	';
	if ($__vars['xf']['fullJs']) {
		$__finalCompiled .= '
		<script src="' . $__templater->fn('js_url', array('vendor/modernizr/modernizr.min.js', ), true) . '"></script>
		<script src="' . $__templater->fn('js_url', array('xf/preamble.js', ), true) . '"></script>
	';
	} else {
		$__finalCompiled .= '
		<script src="' . $__templater->fn('js_url', array('xf/preamble-compiled.js', ), true) . '"></script>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'body' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'app' => '!',
		'jsState' => null,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->fn('core_js') . '
	<!--XF:JS-->
	<script>
		jQuery.extend(true, XF.config, {
			userId: ' . $__templater->escape($__vars['xf']['visitor']['user_id']) . ',
			url: {
				fullBase: \'' . $__templater->filter($__templater->fn('base_url', array(null, true, ), false), array(array('escape', array('js', )),), true) . '\',
				basePath: \'' . $__templater->filter($__templater->fn('base_url', array(null, false, ), false), array(array('escape', array('js', )),), true) . '\',
				css: \'' . $__templater->filter($__templater->fn('css_url', array(array('__SENTINEL__', ), false, ), false), array(array('escape', array('js', )),), true) . '\',
				keepAlive: \'' . $__templater->filter($__templater->fn('link_type', array($__vars['app'], 'login/keep-alive', ), false), array(array('escape', array('js', )),), true) . '\'
			},
			cookie: {
				path: \'' . $__templater->filter($__vars['xf']['cookie']['path'], array(array('escape', array('js', )),), true) . '\',
				domain: \'' . $__templater->filter($__vars['xf']['cookie']['domain'], array(array('escape', array('js', )),), true) . '\',
				prefix: \'' . $__templater->filter($__vars['xf']['cookie']['prefix'], array(array('escape', array('js', )),), true) . '\'
			},
			csrf: \'' . $__templater->filter($__templater->fn('csrf_token', array(), false), array(array('escape', array('js', )),), true) . '\',
			js: {\'<!--XF:JS:JSON-->\'},
			css: {\'<!--XF:CSS:JSON-->\'},
			time: {
				now: ' . $__templater->escape($__vars['xf']['time']) . ',
				today: ' . $__templater->escape($__vars['xf']['timeDetails']['today']) . ',
				todayDow: ' . $__templater->escape($__vars['xf']['timeDetails']['todayDow']) . '
			},
			borderSizeFeature: \'' . $__templater->fn('property', array('borderSizeFeature', ), true) . '\',
			enableRtnProtect: ' . ($__vars['xf']['enableRtnProtect'] ? 'true' : 'false') . ',
			enableFormSubmitSticky: ' . ($__templater->fn('property', array('formSubmitSticky', ), false) ? 'true' : 'false') . ',
			uploadMaxFilesize: ' . $__templater->escape($__vars['xf']['uploadMaxFilesize']) . ',
			visitorCounts: {
				conversations_unread: \'' . $__templater->filter($__vars['xf']['visitor']['conversations_unread'], array(array('number', array()),), true) . '\',
				alerts_unread: \'' . $__templater->filter($__vars['xf']['visitor']['alerts_unread'], array(array('number', array()),), true) . '\',
				total_unread: \'' . $__templater->filter($__vars['xf']['visitor']['conversations_unread'] + $__vars['xf']['visitor']['alerts_unread'], array(array('number', array()),), true) . '\',
				title_count: ' . ($__templater->fn('in_array', array($__vars['xf']['options']['displayVisitorCount'], array('title_count', 'title_and_icon', ), ), false) ? 'true' : 'false') . ',
				icon_indicator: ' . ($__templater->fn('in_array', array($__vars['xf']['options']['displayVisitorCount'], array('icon_indicator', 'title_and_icon', ), ), false) ? 'true' : 'false') . '
			},
			jsState: ' . ($__vars['jsState'] ? $__templater->filter($__vars['jsState'], array(array('json', array()),array('raw', array()),), true) : '{}') . '
		});

		jQuery.extend(XF.phrases, {
			date_x_at_time_y: "' . $__templater->filter('{date} lúc {time}', array(array('escape', array('js', )),), true) . '",
			day_x_at_time_y:  "' . $__templater->filter('Lúc {time}, {day} ', array(array('escape', array('js', )),), true) . '",
			yesterday_at_x:   "' . $__templater->filter('Lúc {time} Hôm qua', array(array('escape', array('js', )),), true) . '",
			x_minutes_ago:    "' . $__templater->filter('{minutes} phút trước', array(array('escape', array('js', )),), true) . '",
			one_minute_ago:   "' . $__templater->filter('1 phút trước', array(array('escape', array('js', )),), true) . '",
			a_moment_ago:     "' . $__templater->filter('Vài giây trước', array(array('escape', array('js', )),), true) . '",
			today_at_x:       "' . $__templater->filter('Lúc {time}', array(array('escape', array('js', )),), true) . '",
			in_a_moment:      "' . $__templater->filter('In a moment', array(array('escape', array('js', )),), true) . '",
			in_a_minute:      "' . $__templater->filter('In a minute', array(array('escape', array('js', )),), true) . '",
			in_x_minutes:     "' . $__templater->filter('In {minutes} minutes', array(array('escape', array('js', )),), true) . '",
			later_today_at_x: "' . $__templater->filter('Later today at {time}', array(array('escape', array('js', )),), true) . '",
			tomorrow_at_x:    "' . $__templater->filter('Tomorrow at {time}', array(array('escape', array('js', )),), true) . '",

			day0: "' . $__templater->filter('Chủ nhật', array(array('escape', array('js', )),), true) . '",
			day1: "' . $__templater->filter('Thứ hai', array(array('escape', array('js', )),), true) . '",
			day2: "' . $__templater->filter('Thứ ba', array(array('escape', array('js', )),), true) . '",
			day3: "' . $__templater->filter('Thứ tư', array(array('escape', array('js', )),), true) . '",
			day4: "' . $__templater->filter('Thứ năm', array(array('escape', array('js', )),), true) . '",
			day5: "' . $__templater->filter('Thứ sáu', array(array('escape', array('js', )),), true) . '",
			day6: "' . $__templater->filter('Thứ bảy', array(array('escape', array('js', )),), true) . '",

			dayShort0: "' . $__templater->filter('CN', array(array('escape', array('js', )),), true) . '",
			dayShort1: "' . $__templater->filter('T2', array(array('escape', array('js', )),), true) . '",
			dayShort2: "' . $__templater->filter('T3', array(array('escape', array('js', )),), true) . '",
			dayShort3: "' . $__templater->filter('T4', array(array('escape', array('js', )),), true) . '",
			dayShort4: "' . $__templater->filter('T5', array(array('escape', array('js', )),), true) . '",
			dayShort5: "' . $__templater->filter('T6', array(array('escape', array('js', )),), true) . '",
			dayShort6: "' . $__templater->filter('T7', array(array('escape', array('js', )),), true) . '",

			month0: "' . $__templater->filter('Tháng một', array(array('escape', array('js', )),), true) . '",
			month1: "' . $__templater->filter('Tháng hai', array(array('escape', array('js', )),), true) . '",
			month2: "' . $__templater->filter('Tháng ba', array(array('escape', array('js', )),), true) . '",
			month3: "' . $__templater->filter('Tháng tư', array(array('escape', array('js', )),), true) . '",
			month4: "' . $__templater->filter('Tháng năm', array(array('escape', array('js', )),), true) . '",
			month5: "' . $__templater->filter('Tháng sáu', array(array('escape', array('js', )),), true) . '",
			month6: "' . $__templater->filter('Tháng bảy', array(array('escape', array('js', )),), true) . '",
			month7: "' . $__templater->filter('Tháng tám', array(array('escape', array('js', )),), true) . '",
			month8: "' . $__templater->filter('Tháng chín', array(array('escape', array('js', )),), true) . '",
			month9: "' . $__templater->filter('Tháng mười', array(array('escape', array('js', )),), true) . '",
			month10: "' . $__templater->filter('Tháng mười một', array(array('escape', array('js', )),), true) . '",
			month11: "' . $__templater->filter('Tháng mười hai', array(array('escape', array('js', )),), true) . '",

			active_user_changed_reload_page: "' . $__templater->filter('Thành viên đang hoạt động đã thay đổi. Tải lại trang cho phiên bản mới nhất.', array(array('escape', array('js', )),), true) . '",
			server_did_not_respond_in_time_try_again: "' . $__templater->filter('The server did not respond in time. Please try again.', array(array('escape', array('js', )),), true) . '",
			oops_we_ran_into_some_problems: "' . $__templater->filter('Rất tiếc! Chúng tôi gặp phải một số vấn đề.', array(array('escape', array('js', )),), true) . '",
			oops_we_ran_into_some_problems_more_details_console: "' . $__templater->filter('Rất tiếc! Chúng tôi gặp phải một số vấn đề. Vui lòng thử lại sau. Chi tiết lỗi c có thể có trong trình duyệt.', array(array('escape', array('js', )),), true) . '",
			file_too_large_to_upload: "' . $__templater->filter('The file is too large to be uploaded.', array(array('escape', array('js', )),), true) . '",
			files_being_uploaded_are_you_sure: "' . $__templater->filter('Files are still being uploaded. Are you sure you want to submit this form?', array(array('escape', array('js', )),), true) . '",
			close: "' . $__templater->filter('Đóng', array(array('escape', array('js', )),), true) . '",

			showing_x_of_y_items: "' . $__templater->filter('Hiển thị {count} trong số {total} mục', array(array('escape', array('js', )),), true) . '",
			showing_all_items: "' . $__templater->filter('Hiển thị tất cả', array(array('escape', array('js', )),), true) . '",
			no_items_to_display: "' . $__templater->filter('No items to display', array(array('escape', array('js', )),), true) . '"
		});
	</script>

	<form style="display:none" hidden="hidden">
		<input type="text" name="_xfClientLoadTime" value="" id="_xfClientLoadTime" tabindex="-1" />
	</form>

	';
	if ($__templater->method($__vars['xf']['visitor'], 'canSearch', array()) AND ($__templater->method($__vars['xf']['request'], 'getFullRequestUri', array()) === $__templater->fn('link', array('full:index', ), false))) {
		$__finalCompiled .= '
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "WebSite",
			"url": "' . $__templater->filter($__templater->fn('link', array('canonical:index', ), false), array(array('escape', array('js', )),), true) . '",
			"potentialAction": {
				"@type": "SearchAction",
				"target": "' . (($__templater->filter($__templater->fn('link', array('canonical:search/search', ), false), array(array('escape', array('js', )),), true) . ($__vars['xf']['options']['useFriendlyUrls'] ? '?' : '&')) . 'keywords={search_keywords}') . '",
				"query-input": "required name=search_keywords"
			}
		}
		</script>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
});