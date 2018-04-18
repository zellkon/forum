!function($, window, document, _undefined)
{
	var chat = $('#siropuChat');

	XF.SiropuChat.RoomSave = XF.Element.newHandler({
		options: {},

		init: function()
		{
			this.$target.on('ajax-submit:response', $.proxy(this, 'ajaxResponse'));
		},

		ajaxResponse: function(e, data)
		{
			var roomListTab = $('#siropuChatTabs a[data-target="room-list"]');

			if (data.rooms)
			{
				XF.SiropuChat.Core.prototype.loadRoom(data);
			}
               else if (roomListTab.hasClass('siropuChatActiveTab'))
               {
                    XF.SiropuChat.Core.prototype.getRooms();
               }
               else
               {
                    roomListTab.trigger('click');
               }

			if (!data.errorHtml)
			{
				this.$target[0].reset();
			}
		}
	});

	XF.SiropuChat.RoomDelete = XF.Element.newHandler({
		options: {},

		init: function()
		{
			this.$target.on('ajax-submit:response', $.proxy(this, 'ajaxResponse'));
		},

		ajaxResponse: function(e, data)
		{
			$('#siropuChatRooms > li[data-id="' + data.room_id + '"]').fadeOut();
			chat.find('[data-room-id="' + data.room_id + '"]').remove();
		}
	});

	XF.Element.register('siropu-chat-room-save', 'XF.SiropuChat.RoomSave');
	XF.Element.register('siropu-chat-room-delete', 'XF.SiropuChat.RoomDelete');
}
(jQuery, window, document);
