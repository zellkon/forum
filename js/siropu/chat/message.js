!function($, window, document, _undefined)
{
	var chat = $('#siropuChat');

     XF.SiropuChat.MessageSave = XF.Element.newHandler({
          options: {},

          init: function()
          {
               this.$target.on('ajax-submit:response', $.proxy(this, 'ajaxResponse'));
          },

          ajaxResponse: function(e, data)
          {
			if (data.channel == 'room')
			{
				var ul = $('.siropuChatRoom');
			}
			else
			{
				var ul = $('.siropuChatConversation');
			}

               var rowOld = ul.find('.siropuChatMessageRow[data-id=' + data.message_id  + ']');
               var rowNew = $(data.message_html);

			if ($('ul[data-archive="true"]').length)
			{
				rowNew.find('a[data-xf-click="siropu-chat-quote"]').remove();
			}

               rowOld.replaceWith(rowNew);
               XF.activate(rowNew);

			if (data.message)
			{
				XF.flashMessage(data.message, 1500);
			}
          }
     });

     XF.SiropuChat.MessageDelete = XF.Element.newHandler({
          options: {},

          init: function()
          {
               this.$target.on('ajax-submit:response', $.proxy(this, 'ajaxResponse'));
          },

          ajaxResponse: function(e, data)
          {
			if (data.channel == 'room')
			{
				var ul = $('.siropuChatRoom.siropuChatMessages');
			}
			else
			{
				var ul = $('.siropuChatConversation.siropuChatMessages');
			}

               ul.find('.siropuChatMessageRow[data-id=' + data.message_id  + ']').fadeOut();

			if (data.message)
			{
				XF.flashMessage(data.message, 1500);
			}

			setTimeout(function()
			{
				if ($('#siopuChatArchive').length && !$('.siropuChatMessageRow:visible').length)
				{
					location.reload();
				}
			}, 1000);
          }
     });

     XF.Element.register('siropu-chat-message-save', 'XF.SiropuChat.MessageSave');
     XF.Element.register('siropu-chat-message-delete', 'XF.SiropuChat.MessageDelete');
}
(jQuery, window, document);
