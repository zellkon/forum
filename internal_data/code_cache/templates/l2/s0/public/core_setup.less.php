<?php
// FROM HASH: 097e43bb0c6528b6da6caeacf9d14e81
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// Vital base setup, don\'t change these!

html:after
{
	content: \'full\';
	display: none;

	@media (max-width: @xf-responsiveWide) { content: \'wide\'; }
	@media (max-width: @xf-responsiveMedium) { content: \'medium\'; }
	@media (max-width: @xf-responsiveNarrow) { content: \'narrow\'; }
}

*
{
	// global sizing calculations expect border-box
	box-sizing: border-box;
}

body
{
	// don\'t hide the vertical scrollbar
	overflow-y: scroll !important;
}


[data-xf-click], a[tabindex]
{
	// iOS doesn\'t bubble clicks up to the body where we have a listener, so we need to force that
	cursor: pointer;
}

[dir=auto]
{
	// this will get flipped in RT
	text-align: left;
}

pre, textarea
{
	// soft line wraps
	word-wrap: normal;
}

img
{
	// without specifying this, resized images look worse
	-ms-interpolation-mode: bicubic;
}

// #################################################
// Focus handlers, set by XF.NavDeviceWatcher (core.js)

.has-pointer-nav
{
	:focus
	{
		outline: 0
	}

	::-moz-focus-inner
	{
		border: 0;
	}

	label.iconic > input:focus + i:before
	{
		outline: 0;
	}
}';
	return $__finalCompiled;
});