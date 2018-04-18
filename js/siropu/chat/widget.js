!function($, window, document, _undefined)
{
     XF.SiropuChatFindItem = XF.Element.newHandler({
          options: {},

          init: function()
		{
               this.$target.on('keyup', function()
               {
                    var regex = new RegExp($(this).val().trim(), 'gi');

                    $(this).closest('.block-body').find('> ul > li').hide().each(function()
                    {
                         if ($(this).data('name').match(regex))
                         {
                              $(this).show();
                         }
                    });
               });
          }
     });

     XF.SiropuChatWidgetRoom = XF.Element.newHandler({
          options: {},

          init: function()
		{
               var roomId = this.$target.data('id');

               this.$target.click(function(e)
               {
                    if (e.target.className == 'siropuChatActiveRoom')
                    {
                         $(this).find('> ul').slideToggle();
                    }
               });

               this.$target.on('mouseover mouseout', function()
               {
                    $(this).find('> a').toggle();
               });

               this.$target.on('click', '> a', function(e)
               {
                    var $_this = $(this);
                    var action = $(this).attr('data-action');

                    if (action == 'leave')
                    {
                         XF.ajax('POST',
          				XF.canonicalizeUrl('index.php?chat/room/' + roomId + '/leave'),
          				{
                                   widget: true
                              },
          				function(data)
          				{
                                   if (data.message)
                    			{
                    				XF.flashMessage(data.message, 2000);
                    			}

                                   $_this.remove();
          				},
          				{ skipDefault: true }
          			);

                         return false;
                    }
               });
          }
     });

     XF.Element.register('siropu-chat-find-item', 'XF.SiropuChatFindItem');
     XF.Element.register('siropu-chat-widget-room', 'XF.SiropuChatWidgetRoom');
}
(jQuery, window, document);
