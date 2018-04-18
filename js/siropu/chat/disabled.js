!function($, window, document, _undefined)
{
	XF.SiropuChatEnable = XF.Click.newHandler({
		eventNameSpace: 'SiropuChatEnable',

		init: function() {},

		click: function(e)
		{
			XF.ajax('POST', XF.canonicalizeUrl('index.php?chat/enable'), {}, function(data) { location.reload(); });
		}
	});

	XF.Click.register('siropu-chat-enable', 'XF.SiropuChatEnable');
}
(jQuery, window, document);
