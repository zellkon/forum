!function($, window, document, _undefined)
{
	"use strict";

	var USER_AGENT = navigator.userAgent;
	var IS_FIREFOX = /firefox/i.test(USER_AGENT);
	var IS_EDGE = /Edge/i.test(USER_AGENT);
	var IS_CHROME = !IS_EDGE && /Chrome/i.test(USER_AGENT);

	var chat = $('#siropuChat');
	var header = $('#siropuChatHeader');
	var tabs = $('#siropuChatTabs');
	var roomListTab = tabs.find('a[data-target="room-list"]');
	var convListTab = tabs.find('a[data-target="conv-list"]');
	var convFormTab = tabs.find('a[data-target="conv-form"]');
	var content = $('#siropuChatContent');
	var messages = $('.siropuChatMessages');
	var startConversation = $('#siropuChatStartConversation');
	var conversationUsers = $('.siropuChatConversation.siropuChatUsers');
	var noConversations = $('#siropuChatNoConversations');
	var rooms = $('#siropuChatRooms');
	var settings = $('#siropuChatSettings');
	var editor = $('#siropuChatEditor');
	var form = editor.find('form');
	var input = form.find('textarea');
	var bar = $('#siropuChatBar');
	var barMessageContainer = $('#siropuChatBarMessageContainer');
	var barUserCount = $('#siropuChatBarUserCount span');
	var allPagesMode = chat.hasClass('siropuChatAllPages');
	var logout = $('.siropuChatLogout');

	XF.SiropuChat = {};

	XF.SiropuChat.Core = XF.Element.newHandler({
		options:
		{
			active: false
		},

		loggedIn: $('#XF').data('logged-in'),
		channel: 'room',
		screenSize: 'l',
		serverTime: 0,
		pageFocus: true,
		pageTitle: $('title').text(),
		tabNotification: false,
		tabNotificationInterval: null,
		roomId: 1,
		lastId: {},
		convId: 0,
		convUnread: {},
		convOnly: 0,
		convLastActive: 0,
		noticeLastUpdate: 0,
		messageDisplayLimit: 25,
		notificationTimeout: 5000,
		isVisible: true,
		refreshActive: 5000,
		refreshActiveHidden: 15000,
		refreshInactive: 30000,
		refreshInactiveHidden: 60000,
		refreshInterval: 0,
		refreshSet: null,
		inverse: 0,
		floadCheck: 0,
		displayNavCount: false,
		forceRoom: false,
		inIframe: window.frameElement,
		dynamicTitle: true,
		commands: {},
		sounds: {},

		init: function()
		{
			this.getScreenSize();
			this.startRefreshInterval();

			this._initSubmitForm();
			this._initTabs();
			this._initRoomListActions();
			this._initRoomActions();
			this._initConversations();
			this._initAutoScrollToggle();
			this._initSounds();
			this._initOnLoad();

			settings.on('change', $.proxy(this, 'saveSettings'));
			bar.on('click', $.proxy(this, 'toggleChat'));
			chat.on('new-message', $.proxy(this, 'newMessage'));

			var self = this;

			if (allPagesMode)
			{
				$('.p-footer').css('padding-bottom', 60);
			}

			$(window).scroll(function()
			{
				if ($('.p-navSticky').length && $('.siropuChatAllPages.siropuChatMaximized').length)
				{
					self.adjustContentHeight();
				}
			});

			$(window).resize(function()
			{
				self.getScreenSize();
			});

			$(window).blur(function()
			{
				self.pageFocus = false;
			});

			$(window).focus(function()
			{
				self.pageFocus = true;

				if (self.tabNotificationInterval)
				{
	                    clearInterval(self.tabNotificationInterval);
	                    $('title').text(self.pageTitle);
	               }
			});

			$(document).on('click', '.colorPicker-save', function()
			{
				self.saveSettings();
			});

			$(document).on('keyup', function(e)
			{
				if (e.which == 27 && allPagesMode)
				{
					self.toggleChat();
				}
			});

			$(document).on('click', '.siropuChatMessageRow.siropuChatBot ol li b', function()
			{
				self.editorSetHtml($(this).html());
			});

			$(document).on('siropuChat:show-load-more', '.siropuChatMessages', function()
			{
				var roomId = $(this).data('room-id');
				var convId = $(this).data('conv-id');

				if ($(this).find('> li[data-id]').length < self.messageDisplayLimit)
				{
					return;
				}

				var row = $('<li class="siropuChatLoadMoreMessages" style="display: none;" />');
				var button = $('<a class="button button--link" data-xf-click="siropu-chat-load-more-messages" />');

				button.html(XF.phrase('siropu_chat_load_more_messages')).appendTo(row)

				if ($(this).find('.siropuChatLoadMoreMessages').length)
				{
					return $(this).find('.siropuChatLoadMoreMessages').fadeIn();
				}

				if (self.inverse)
				{
					row.appendTo($(this)).fadeIn();
					$(this).scrollTop(1000000);
				}
				else
				{
					row.prependTo($(this)).fadeIn();
				}

				XF.activate(row);
			});

			$(document).on('click', function(e)
			{
				if (allPagesMode && chat.is(':visible') && e.target.className.match('p-'))
				{
					bar.trigger('click');
				}
			});

			this.$target.on('mouseover mouseout', '.siropuChatMessageRow', function()
			{
				if ($(this).find('.siropuChatMessageActions').length)
				{
					$(this).find('.siropuChatDateTime, .siropuChatMessageActions').toggle();
				}
			});

			setTimeout(function()
			{
				self.adjustContentHeight();
				self.editorSetHtml('');

				if (chat.hasClass('siropuChatPage') && !self.inIframe && !self.screenSizeIs('s'))
				{
					self.editorFocus();
				}

				if (self.channel == 'conv' && self.getConvCount())
				{
					conversationUsers.find('.siropuChatActiveConversation').trigger('click', true);
				}
			}, 500);

			if (this.isResponsive() && this.channel == 'room')
			{
				$('.siropuChatRoom.siropuChatUsers').hide();
			}

			this.noticeLastUpdate = this.serverTime;
			this.convLastActive = this.serverTime;

			this.autoScroll();
			this.toggleLogout();
		},

		getScreenSize: function()
		{
			if (window.matchMedia('(max-width: 768px)').matches)
			{
				this.screenSize = 's';
			}
			else if (window.matchMedia('(max-width: 1024px)').matches)
			{
				this.screenSize = 'm';
			}
			else
			{
				this.screenSize = 'l';
			}
		},

		getRoomCount: function()
		{
			return chat.find('ul[data-room-id]').length;
		},

		getConvCount: function()
		{
			return chat.find('li[data-conv-id]').length;
		},

		screenSizeIs: function(size)
		{
			return this.screenSize == size;
		},

		isResponsive: function()
		{
			return (this.screenSizeIs('s') || chat.hasClass('siropuChatSidebar'));
		},

		newMessage: function(e, data)
		{
			if (data.action != 'join')
			{
				this.playSound(data);

				if (!this.pageFocus)
				{
					this.displayTabNotification(data);
					this.initDesktopNotification(data);
				}
			}
		},

		doRoomActions: function(data)
		{
			var self = this;

			if (data.actions)
			{
				for (var roomId in data.actions)
				{
					if (this.lastId[roomId] === undefined)
					{
						continue;
					}

					var container = $('.siropuChatMessages[data-room-id="' + roomId + '"]');

					for (var messageId in data.actions[roomId])
					{
						var action = data.actions[roomId][messageId];
						var message = container.find('> li[data-id="' + messageId + '"]');

						for (var type in action.action)
						{
							if (message.attr('data-last-change') == action.action[type])
							{
								continue;
							}

							switch (type)
							{
								case 'edit':
									message.find('.siropuChatMessageText').html(action.html);
									break;
								case 'delete':
									message.fadeOut();
									break;
								case 'like':
									var likes = message.find('.siropuChatMessageLikes');

									if (likes.length)
									{
										if (action.likes)
										{
											likes.replaceWith(action.likes)
										}
										else
										{
											likes.remove();
										}
									}
									else
									{
										message.find('.siropuChatMessageText').after(action.likes);
									}
									break;
								case 'prune':
									if (data.prune)
									{
										container.find('> li[data-user-id="' + data.prune + '"]').remove();
									}
									else
									{
										container.find('> li').each(function()
										{
											if ($(this).data('id') < messageId)
											{
												$(this).remove();
											}
										});
									}
									break;
							}

							message.attr('data-last-change', action.action[type]);
						}
					}
				}
			}
		},

		updateHeaderTitle: function(element)
		{
			if (this.dynamicTitle)
			{
				header.find('> span').text(element.data('title'));
			}
		},

		updateRooms: function(data)
		{
			var self = this;
			var isNew = false;

			if (data.rooms === undefined)
			{
				return;
			}

			for (var roomId in data.rooms)
			{
				var messageContainer = content.find('.siropuChatMessages[data-room-id="' + roomId + '"]');
				var userContainer = content.find('.siropuChatUsers[data-room-id="' + roomId + '"]');
				var messages = $(data.rooms[roomId]['messages']);
				var users = $(data.rooms[roomId]['users']);
				var userCount = data.rooms[roomId]['userCount'];
				var roomTab = tabs.find('a[data-room-id="' + roomId + '"]');
				var noUsers = userContainer.find('.siropuChatNoRoomUsers');

				if (data.action != 'submit')
				{
					users.each(function()
					{
						var id = $(this).data('user-id');

						if (id == 0)
						{
							user = userContainer.find('li[data-username="' + $(this).data('username') + '"]');
						}
						else
						{
							var user = userContainer.find('li[data-user-id="' + id + '"]');
						}

						if (user.length)
						{
							user.find('.siropuChatActivityStatus').replaceWith($(this).find('.siropuChatActivityStatus'));
						}
						else
						{
							if ($(this).hasClass('siropuChatNoRoomUsers'))
							{
								userContainer.html($(this));
							}
							else
							{
								userContainer.prepend($(this));
								XF.activate(userContainer);

								if (noUsers.length)
								{
									noUsers.remove();
								}
							}
						}
					});

					roomTab.find('span')
						.html(userCount)
						.attr('class', userCount ? 'siropuChatTabCountActive' : 'siropuChatTabCountInactive');
				}

				if (messages.length)
				{
					messages = $.grep(messages, function(value)
					{
						return messageContainer.find('> li[data-id="' + $(value).data('id') + '"]').length ? false : true;
					});

					if (this.inverse)
					{
						messageContainer.prepend(messages);
					}
					else
					{
						messageContainer.append(messages);
					}

					XF.activate(messageContainer);

					this.autoScroll(messageContainer);
					this.deleteOlderMessages(data.serverTime, messageContainer);

					if (!roomTab.hasClass('siropuChatActiveTab'))
					{
						roomTab.addClass('siropuChatNewMessage');
					}

					if ($(messages).length)
					{
						isNew = true;
					}
				}
			}

			this.updateLastId(data);
			this.updateNavUserCount(data);
			this.updateRoomTabs(data);
			this.updateBar(data);

			if (isNew)
			{
				data.channel = 'room';
				chat.trigger('new-message', data);
			}
		},

		updateConversations: function(data)
		{
			var self = this;
			var isNew = false;

			this.convUnread = {};

			convListTab.find('span')
				.html(data.convOnline)
				.attr('class', data.convOnline ? 'siropuChatTabCountActive' : 'siropuChatTabCountInactive');

			if (data.convContacts)
			{
				$(data.convContacts).each(function()
				{
					var conversation = conversationUsers.find('li[data-conv-id="' + $(this).data('conv-id') + '"]');

					if (conversation.length)
					{
						conversation.find('.siropuChatActivityStatus').replaceWith($(this).find('.siropuChatActivityStatus'));
					}
					else
					{
						conversationUsers.append($(this));

						if (noConversations.length)
						{
							noConversations.remove();
						}
					}
				});
			}

			if (data.convMessages)
			{
				for (var id in data.convMessages)
				{
					var messageList = $(data.convMessages[id]);
					var messageContainer = $('.siropuChatConversation.siropuChatMessages[data-conv-id="' + id + '"]');

					if (messageContainer.length)
					{
						messageList = $.grep(messageList, function(value)
						{
							return messageContainer.find('> li[data-id="' + $(value).data('id') + '"]').length ? false : true;
						});
					}
					else if (!this.convId || data.convId)
					{
						messageContainer = this.createConversationMessageContainer(id);
						messageContainer.insertBefore(startConversation);

						this.convId = data.convId ? data.convId : id;

						setTimeout(function()
						{
							conversationUsers.find('li[data-conv-id="' + self.convId + '"]').click();
						});
					}

					if (this.inverse)
					{
						messageContainer.prepend(messageList);
					}
					else
					{
						messageContainer.append(messageList);
					}

					XF.activate(messageContainer);

					this.autoScroll(messageContainer);
					this.deleteOlderMessages(data.serverTime, messageContainer);
				}
			}

			if (data.convUnread)
			{
				this.convUnread = data.convUnread;

				for (var id in data.convUnread)
				{
					var conversation = conversationUsers.find('li[data-conv-id="' + id + '"]');

					if (!conversation.hasClass('siropuChatNewMessage'))
					{
						isNew = true;
					}

					conversation.addClass('siropuChatNewMessage');
				}

				if (this.channel == 'room')
				{
					convListTab.addClass('siropuChatNewMessage');
				}
			}

			if (isNew)
			{
				data.channel = 'conv';
				chat.trigger('new-message', data);
			}
		},

		createRoomMessageContainer: function(id)
		{
			return $('<ul class="siropuChatRoom siropuChatMessages" data-room-id="' + id + '" data-autoscroll="1" />');
		},

		createConversationMessageContainer: function(id)
		{
			return $('<ul class="siropuChatConversation siropuChatMessages" data-conv-id="' + id + '" data-autoscroll="1" />');
		},

		updateNotice: function(data)
		{
			var noticeOld = $('#siropuChatNotice');

			if (data.notice && (data.serverTime - this.noticeLastUpdate >= 60 || !noticeOld.length))
			{
				var noticeNew = $(data.notice);

				if (noticeOld.length && noticeOld.find('span').text() == noticeNew.find('span').text())
				{
					return;
				}

				noticeNew.find('span').hide();

				if (noticeOld.length)
				{
					noticeOld.replaceWith(noticeNew);
				}
				else
				{
					$('#siropuChatHeader').after(noticeNew);
				}

				setTimeout(function()
				{
					noticeNew.find('span').fadeIn();
				});

				this.noticeLastUpdate = data.serverTime;
			}

			if (!data.notice && noticeOld.length)
			{
				noticeOld.remove();
			}
		},

		updateActivityStatus: function(data)
		{
			if (data.action != 'submit' && (data.active && !this.options.active || !data.active && this.options.active))
			{
			     this.options.active = data.active;
				chat.attr('data-active', data.active);

				this.resetRefreshInterval();
			}
		},

		updateNavUserCount: function(data)
		{
			if (data.action == 'submit')
			{
				return;
			}

			if (!this.displayNavCount)
			{
				return;
			}

			var badge = $('a[data-nav-id="siropuChat"] span.badge');
			badge.text(data.userCount);

			if (data.userCount)
			{
				badge.addClass('badge--active');
			}
			else
			{
				badge.removeClass('badge--active');
			}
		},

		updateBar: function(data)
		{
			if (!data.lastRow)
			{
				return;
			}

			barMessageContainer.html(data.lastRow.message);
			bar.attr('data-room-id', data.lastRow.roomId);

			if (data.action != 'submit')
			{
				barUserCount.html(data.userCount);
			}
		},

		updateRoomTabs: function(data)
		{
			if (this.forceRoom == true || this.loggedIn == false || data.joinedRooms === undefined)
			{
				return;
			}

			if (tabs.length)
			{
				if (this.lastId && data.joinedRooms)
				{
					for (var roomId in this.lastId)
					{
						if ($.inArray(Number(roomId), data.joinedRooms) == -1)
						{
							this.leaveRoomPostActions(roomId);
						}
					}
				}
				else if (this.getRoomCount())
				{
					this.postLogout();
				}
			}
		},

		updateLastId: function (data)
		{
			if (data.lastId === undefined || data.lastId.length === 0)
			{
				return;
			}

			for (var id in data.lastId)
			{
				this.lastId[id] = data.lastId[id];
			}
		},

		getRooms: function()
		{
			XF.ajax('GET',
				XF.canonicalizeUrl('index.php?chat/room/list'),
				{},
				function(data)
				{
					if (data.html)
					{
						XF.setupHtmlInsert(data.html, function($html, data, onComplete)
						{
							rooms.html($html);
						});
					}
				}
			);
		},

		loadRoom: function(data)
		{
			var self = this;
			var tab = $(data.roomTab);

			if (this.getRoomCount() == 0)
			{
				tab.removeClass('siropuChatActiveTab');
			}

			tab.insertBefore(roomListTab);

			var messageContainer = this.createRoomMessageContainer(data.roomId);
			messageContainer.prependTo(content);

			this._initAutoScrollToggle(messageContainer);

			$('<ul class="siropuChatRoom siropuChatUsers" data-room-id="' + data.roomId + '" />').prependTo(content);

			this.updateRooms(data);

			setTimeout(function()
			{
				self.doAutoScroll(messageContainer);
			});

			this.switchRoom(data.roomId);
			this.toggleLogout();
		},

		leaveRoom: function(roomId)
		{
			var self = this;
			var roomId = roomId ? roomId : this.roomId;

			XF.ajax('POST',
				XF.canonicalizeUrl('index.php?chat/room/' + roomId + '/leave'),
				{},
				function(data)
				{
					self.leaveRoomPostActions(roomId);
				},
				{ skipDefault: true }
			);
		},

		leaveRoomPostActions: function(roomId, switchTabs)
		{
			chat.find('[data-room-id="' + roomId + '"]').remove();

			delete this.lastId[roomId];
			XF.Cookie.remove('siropu_chat_room_id');

			if (switchTabs)
			{
				var lastRoom = tabs.find('[data-room-id]:last');

				if (lastRoom.length)
				{
					lastRoom.click();
				}
				else
				{
					roomListTab.click();
				}
			}

			this.toggleLogout();
		},

		leaveConversationPostActions: function(convId)
		{
			chat.find('[data-conv-id="' + convId + '"]').remove();
			XF.Cookie.remove('siropu_chat_conv_id');

			if (this.getConvCount())
			{
				conversationUsers.find('li[data-conv-id]:first').click();
			}
		},

		autoScroll: function(element)
		{
			var element = element ? element : $('.siropuChatMessages');

			if (element.attr('data-autoscroll') == 1)
			{
                   	this.doAutoScroll(element);
               }
		},

		doAutoScroll: function(element)
		{
			var element = element ? element : $('.siropuChatMessages');

			if (this.inverse)
			{
			    element.scrollTop(0);
			}
			else
			{
			    element.scrollTop(1000000);
			}
		},

          getSoundSetting: function(option)
		{
              return settings.find('input[name="sound[' + option + ']"]').is(':checked');
	    	},

          getNotificationSetting: function(option)
		{
              return settings.find('input[name="notification[' + option + ']"]').is(':checked');
	    	},

		getMiscSetting: function(option)
		{
              return settings.find('input[name="' + option + '"]').is(':checked');
	    	},

		getCommand: function(name)
		{
			return this.commands[name];
		},

		getNotificationPhrase: function(data)
		{
			var type = this.getMessageType(data);

			switch (type)
			{
				case 'mention':
				case 'public':
					return XF.phrase('siropu_chat_new_public_message');
					break;
				case 'private':
					return XF.phrase('siropu_chat_new_private_message');
					break;
				case 'whisper':
					return XF.phrase('siropu_chat_new_whisper_message');
					break;
				default:
					return XF.phrase('siropu_chat_new_message');
					break;
			}
		},

		getMessageType: function(data)
		{
			return data.channel == 'room' ? data.lastRow.type : data.convLastRow.type;
		},

		playSound: function(data)
		{
			if (data.channel == 'room')
			{
				var sound = data.playSound;
			}
			else
			{
				var sound = data.convPlaySound;
			}

			if (this.sounds[sound])
			{
				this.sounds[sound].play();
			}
		},

		initDesktopNotification: function(data)
		{
			var self = this;

			if (!('Notification' in window))
			{
                   return;
               }

               if (!this.getNotificationSetting(this.getMessageType(data)))
			{
                   return;
               }

			if (Notification.permission === 'granted')
			{
			   this.sendDesktopNotification(data);
			}
			else if (Notification.permission !== 'denied')
			{
			    Notification.requestPermission(function(permission)
			    {
				   if (permission === 'granted')
				   {
					  self.sendDesktopNotification(data);
				   }
			    });
			}
		},

		sendDesktopNotification: function(data)
		{
			if (data.channel == 'room')
			{
				var message = data.lastRow;
			}
			else
			{
				var message = data.convLastRow;
			}

			var self = this;
			var options = {
                   body: message.text,
                   icon: message.avatar,
                   tag: 'siropuChatNotification'
               };

			var n = new Notification(this.getNotificationPhrase(data), options);
			setTimeout(n.close.bind(n), this.notificationTimeout);

			n.onclick = function()
			{
			    this.close();
			    window.focus();

			    if (allPagesMode && chat.is(':hidden'))
			    {
				   bar.click();
			    }
			    else
			    {
				   self.switchRoom();
			    }
			};
		},

		displayTabNotification: function(data)
		{
			var self = this;

			if (this.tabNotification && !this.tabNotificationInterval)
			{
				this.tabNotificationInterval = setInterval(function()
				{
					$('title').text($('title').text() == self.pageTitle ? self.getNotificationPhrase(data) : self.pageTitle);
				}, 1500);
			}
		},

		switchRoom: function(id)
		{
			tabs.find('a[data-room-id="' + id + '"]').click();
		},

		switchConversation: function(id)
		{
			conversationUsers.find('li[data-conv-id="' + id + '"]').click();
		},

		preSubmit: function()
		{
			var self = this;

			this.editorSetHtml('');
			self.editorOffPlaceholder('posting');

			this.responseTimeout = setTimeout(function()
			{
				self.editorSetPlaceholder('noresponse');
				self.editorOn();
				self.startRefreshInterval();
			}, 5000);

			this.stopRefreshInterval();
		},

		postSubmit: function()
		{
			if (this.channel == 'room' && !this.getRoomCount() || this.channel == 'conv' && !this.getConvCount())
			{
				this.editorOffPlaceholder('');
			}
			else
			{
				this.editorOn();
				this.editorFocus();

				if (this.channel == 'room')
				{
					this.editorSetPlaceholder('public');
				}
				else
				{
					this.editorSetPlaceholder('private', conversationUsers.find('li[data-conv-id="' + this.convId + '"]'));
				}
			}

			clearTimeout(this.responseTimeout);

			this.startRefreshInterval();
		},

		saveSettings: function(form)
		{
			var self = this;

			if (!settings.length)
			{
				return;
			}

			XF.ajax('POST',
				XF.canonicalizeUrl('index.php?chat/save-settings'),
				settings.serialize(),
				function(data)
				{
					if (data.errorHtml)
					{
						XF.setupHtmlInsert(data.errorHtml, function($html, container)
						{
							var title = container.h1 || container.title || XF.phrase('oops_we_ran_into_some_problems');
							XF.overlayMessage(title, $html);
						});

						return true;
					}

					var option = '';

					if (form !== undefined)
					{
						option = form.target.name;
					}

					switch (option)
					{
						case 'inverse':
							self.inverse = self.getMiscSetting('inverse');
							self.autoScroll();
							break;
						case 'maximized':
							chat.toggleClass('siropuChatMaximized');
							self.adjustContentHeight();
							if (allPagesMode && !chat.hasClass('siropuChatMaximized'))
							{
								chat.css('z-index', '');
								content.css('height', '');
							}
							break;
						case 'display_mode':
						case 'editor_on_top':
							if (option == 'display_mode' && chat.hasClass('siropuChatPage'))
							{
								return;
							}
							XF.flashMessage(XF.phrase('siropu_chat_settings_change_reload_page'), 3000);
							break;
						case 'hide_bot':
							$('.siropuChatRoom.siropuChatMessages > li.siropuChatBot').fadeToggle();
							break;
						case 'hide_chatters':
							chat.toggleClass('siropuChatHideUserList');
							break;
						case 'disable':
							XF.flashMessage(XF.phrase('siropu_chat_has_been_disabled'), 5000);
							$('#siropuChat, #siropuChatBar').remove();
							$(document).click();
							break;
						default:
							if (option.match('sound'))
							{
								self._initSounds();
							}
							break;
					}
				},
				{ skipDefault: true }
			);
		},

		toggleChat: function()
		{
			chat.toggle();
			barMessageContainer.toggle();

			this.isVisible = chat.is(':visible');

			this.switchRoom(bar.attr('data-room-id'));
			this.doAutoScroll();
			this.resetRefreshInterval();

			if (!this.screenSizeIs('s'))
			{
				this.editorFocus();
			}

			var chatHeight = chat.height() + bar.height() + 10;

			if (chatHeight > $(window).height())
			{
				this.adjustContentHeight();
			}
		},

		toggleAutoScroll: function(element)
		{
			var scrollDiff = element[0].scrollHeight - element.innerHeight();
			var scrollTop = parseInt(element.scrollTop());

			element.attr('data-autoscroll', 0);

			if (((scrollTop == scrollDiff
			     || scrollTop + 1 == scrollDiff
			     || scrollTop - 1 == scrollDiff)
			          && !this.inverse)
			               || scrollTop == 0
			                    && this.inverse)
			{
			   element.attr('data-autoscroll', 1);
			}

			if (scrollTop == 0
				&& !this.inverse
					|| ((scrollTop == scrollDiff
						|| scrollTop + 1 == scrollDiff
						|| scrollTop - 1 == scrollDiff)
							&& this.inverse))
			{
				element.trigger('siropuChat:show-load-more');
			}
		},

		toggleLogout: function()
		{
			if (this.getRoomCount() == 0)
			{
				logout.fadeOut();
			}
			else
			{
				logout.fadeIn();
			}
		},

		startRefreshInterval: function()
		{
			if (this.isVisible)
			{
				if (this.options.active)
				{
					this.refreshInterval = this.refreshActive;
				}
				else
				{
					this.refreshInterval = this.refreshInactive;
				}
			}
			else
			{
				if (this.options.active)
				{
					this.refreshInterval = this.refreshActiveHidden;
				}
				else
				{
					this.refreshInterval = this.refreshInactiveHidden;
		 		}
			}

			this.refreshSet = setInterval($.proxy(this, 'refresh'), this.refreshInterval);
		},

		resetRefreshInterval: function()
		{
			this.stopRefreshInterval();
			this.startRefreshInterval();
		},

		stopRefreshInterval: function()
		{
			clearInterval(this.refreshSet);
		},

		refresh: function()
		{
			var self = this;

			XF.ajax('POST',
				XF.canonicalizeUrl('index.php?chat/update'),
				{
					channel: self.channel,
					room_id: self.roomId,
					last_id: self.lastId,
					conv_id: self.convId,
					conv_unread: self.convUnread,
					conv_only: self.convOnly,
					conv_last_active: self.convLastActive,
					is_chat_page: chat.hasClass('siropuChatPage')
				},
				function(data)
				{
					self.updateRooms(data);
					self.updateConversations(data);
					self.updateNotice(data);
					self.updateActivityStatus(data);

					setTimeout(function()
					{
						self.doRoomActions(data);
					});
				},
				{
					skipDefault: true,
					global: false
				}
			);
		},

		adjustContentHeight: function ()
		{
			var windowHeight = $(window).height();
			var chatHeight = chat.height();
			var contentHeight = content.height();
			var barHeight = bar.height();
			var diffHeight = windowHeight - chatHeight;
			var subtract = 0;

			if ($('.p-navSticky').length && $('.p-navSticky.is-sticky').length)
			{
				subtract = $('.p-navSticky').height();
			}

			if ($('.siropuChatAllPages.siropuChatMaximized').length)
			{
				chat.css('z-index', 100);
				content.css('height', (contentHeight + diffHeight - barHeight - subtract - 20) + 'px');
			}
			else if ($('#siropuChatFullPage').length)
			{
				content.css('height', (contentHeight + diffHeight) + 'px');
			}
			else if (this.screenSizeIs('s'))
			{
				content.css('height', (contentHeight + diffHeight - barHeight - 20) + 'px');
			}
    		},

		editorFocus: function()
		{
			input.froalaEditor('events.focus');
		},

		editorOn: function()
		{
			input.froalaEditor('edit.on');
		},

		editorOff: function()
		{
			input.froalaEditor('edit.off');
		},

		editorSetHtml: function(html)
		{
			input.froalaEditor('html.set', html);
			input.froalaEditor('selection.setAfter', 'p');
			input.froalaEditor('selection.restore');
		},

		editorGetHtml: function()
		{
			return input.froalaEditor('html.get', true);
		},

		editorGetText: function ()
		{
			return $.trim(input.data('froala.editor').$el.text());
		},

		editorInsertImage: function(imageUrl)
		{
			input.froalaEditor('image.insert', imageUrl);
		},

		editorSetPlaceholder: function(type, element)
		{
			var placeholder = ' ';

			switch (type)
			{
				case 'public':
					placeholder = XF.phrase('siropu_chat_write_public_message');
					break;
				case 'private':
					if (this.getConvCount())
					{
						placeholder = '(' + element.data('username') + ') ' + XF.phrase('siropu_chat_write_private_message');
					}
					else
					{
						placeholder = XF.phrase('siropu_chat_no_conversations_started');
					}
					break;
				case 'posting':
					placeholder = XF.phrase('siropu_chat_posting_message');
					break;
				case 'wait':
					if (this.floodCheck == 1000)
					{
						placeholder = XF.phrase('siropu_chat_please_wait');
					}
					else
					{
						placeholder = XF.phrase('siropu_chat_please_wait_x_seconds');
					}
					break;
				case 'readonly':
					placeholder = XF.phrase('siropu_chat_room_is_read_only');
					break;
				case 'noresponse':
					placeholder = XF.phrase('siropu_chat_no_response');
					break;
			}

			input.data('froala.editor').opts.placeholderText = placeholder;
			input.froalaEditor('placeholder.refresh');
		},

		editorOffPlaceholder: function(placeholder)
		{
			this.editorOff();
			this.editorSetPlaceholder(placeholder);
		},

		editorOnPlaceholder: function(placeholder)
		{
			this.editorOn();
			this.editorSetPlaceholder(placeholder);
		},

		loadSound: function(type)
		{
			return this.sounds[type]
				? this.sounds[type]
				: new Audio(XF.config.url.basePath + 'styles/default/siropu/chat/sounds/' + type + '.mp3');
		},

		postLogout: function()
		{
			for (var id in this.lastId)
			{
				this.leaveRoomPostActions(id);
			}

			if (roomListTab.hasClass('siropuChatActiveTab'))
			{
				this.getRooms();
			}
			else
			{
				roomListTab.click();
			}
		},

		setChannel: function(channel)
		{
			if (this.channel != channel)
			{
				XF.Cookie.set('siropu_chat_channel', channel);
			}

			this.channel = channel;
		},

		deleteOlderMessages: function(serverTime, container)
		{
			if (serverTime - this.serverTime >= 300
				&& container.find('> li[data-id]').length >= 100
				&& container.data('autoscroll') == 0)
			{
			    container.find('>li[data-id]:nth-child(' + (this.inverse ? '' : '-') + 'n+' + this.messageDisplayLimit + ')').remove();
			    this.serverTime = serverTime;
			}
		},

		_initRoomListActions: function()
		{
			var self = this;

			$(document).on('click', '.siropuChatRoomInfo h3', function()
			{
				$(this).parents('li').find('.siropuChatRoomJoin').submit();
			});

			$(document).on('submit', '.siropuChatRoomAction form', function(e)
			{
				e.preventDefault();

				var submit = $(this).find('button[type="submit"]');
				var password = $(this).find('input[name="password"]');

				if (password.length)
				{
					password.toggle().focus();

					if (!password.val())
					{
						return;
					}
				}

				submit.prop('disabled', true);

				setTimeout(function()
				{
					submit.prop('disabled', false);
					password.val('');
				}, 1000);

				XF.ajax('POST',
					$(this).attr('action'),
					$(this).serialize(),
					function(data)
					{
						if (data.action == 'join')
						{
							self.loadRoom(data);
						}

						if (data.action == 'leave')
						{
							self.leaveRoomPostActions(data.roomId);
						}

						self.getRooms();
					}
				);
			});
		},

		_initRoomActions: function()
		{
			var self = this;

			$(document).on('click', '.siropuChatRecipients', function()
			{
				var recipients = $(this).data('recipients').split(', ');
				self.editorSetHtml('/' + self.getCommand('whisper') + ' [' + recipients.join(', ') + '] ');
			});

			$(document).on('click', '.siropuChatTag', function()
			{
				self.editorSetHtml(input.val() + ' @' + $(this).next('a').text());
			});
		},

		_initSubmitForm: function()
		{
			var self = this;

			input.on('froalaEditor.initialized', function(e, editor)
			{
				var removed = input.data('buttons-remove');

				if (!XF.isEditorEnabled() && removed.match(/xfBbCode/))
				{
					XF.setIsEditorEnabled(true);
				}

				editor.events.on('click', function(e)
				{
					if (self.channel == 'conv')
					{
						var conversation = conversationUsers.find('li[data-conv-id="' + self.convId + '"]');

						if (conversation.hasClass('siropuChatNewMessage'))
						{
							conversation.removeClass('siropuChatNewMessage');
						}
					}
				});

				editor.events.on('keyup', function(e)
				{
					var join = self.getCommand('join');
					var text = self.editorGetText();
					var find = text.replace('/' + join, '').trim();

					if (text.match(/\/join/) && find)
					{
						var results = new XF.AutoCompleteResults(
						{
							onInsert: function(name)
							{
								self.editorSetHtml(text.replace(find, name));
								results.hideResults();
								form.submit();
							}
						});

						XF.ajax('GET',
							XF.canonicalizeUrl('index.php?chat/room/find'),
							{
								q: find
							},
							function (data)
							{
								results.showResults(data.q, data.results, form);
							},
							{
								global: false,
								error: false
							}
						);
					}
				});

				if (self.channel == 'room' && tabs.find('a[data-room-id="' + self.roomId + '"]').data('readonly'))
				{
					self.editorOffPlaceholder('readonly');
				}

				if (self.channel == 'room' && !self.getRoomCount() || self.channel == 'conv' && !self.getConvCount())
				{
					self.editorOffPlaceholder('');
				}
			});

			form.on('submit', function(e)
			{
				e.preventDefault();

				var messageHtml = self.editorGetHtml();
				var messageText = self.editorGetText();

				if (!messageText && !$(messageHtml).find('img').length)
				{
					return self.editorSetHtml('');
				}

				var messageContainer = $('.siropuChatMessages[data-room-id="' + self.roomId + '"]');
				var userContainer = $('.siropuChatUsers[data-room-id="' + self.roomId + '"]');

				self.preSubmit();

				XF.ajax('POST',
					XF.canonicalizeUrl('index.php?chat/submit'),
					{
						channel: self.channel,
						room_id: self.roomId,
						last_id: self.lastId,
						conv_id: self.convId,
						conv_unread: self.convUnread,
						message: messageHtml
					},
					function(data)
					{
						if (data.input)
						{
							self.editorSetHtml(data.input);
						}

						if (data.roomTab)
						{
							self.loadRoom(data);
							self.postSubmit();

							return;
						}

						if (data.find !== undefined)
						{
							$('.siropuChatMessages:visible').html($(data.messages)).attr('data-search', data.find);

							self.doAutoScroll();
							self.postSubmit();

							return;
						}

						if (data.leaveRoom)
						{
							self.leaveRoomPostActions(data.leaveRoom, true);
						}

						if (data.leaveConv)
						{
							self.leaveConversationPostActions(data.leaveConv);
						}

						if (data.logout)
						{
							self.postLogout();
						}

						if (data.html)
						{
							XF.setupHtmlInsert(data.html, function($html, container)
							{
								if ($html.length)
								{
									XF.overlayMessage(container.title, $html)
								}
							});
						}

						if (data.prune)
						{
							if (data.prune == 'all')
							{
								$('.siropuChatMessages[data-room-id]').html('');

								self.lastId = {};
							}
							else if (data.prune == 'room')
							{
								messageContainer.html('');
							}
							else if (data.prune['user_id'])
							{
								messageContainer.find('> li[data-user-id="' + data.prune['user_id'] + '"]').html('');
							}
						}

						if (data.sanctioned)
						{
							userContainer.find('> li[data-user-id="' + data.sanctioned + '"]').remove();
						}

						self.updateRooms(data);
						self.updateConversations(data);
						self.updateNotice(data);
						self.updateActivityStatus(data);

						if (self.floodCheck)
						{
							self.editorSetPlaceholder('wait');
						}

						setTimeout(function()
						{
							self.postSubmit();
						}, self.floodCheck);

						if (self.channel == 'conv')
						{
							self.convLastActive = data.serverTime;
						}
					},
					{
						global: false
					}
				);
			});
		},

		_initTabs: function()
		{
			var self = this;

			tabs.on('click', 'a', function(e)
			{
				e.preventDefault();

				if ($(this).hasClass('siropuChatActiveTab') && !self.isResponsive())
				{
					return;
				}

				$(this).removeClass('siropuChatNewMessage');

				content.find('> *').hide();

				tabs.find('a.siropuChatActiveTab').removeClass('siropuChatActiveTab');

				$(this).addClass('siropuChatActiveTab');

				self.editorSetPlaceholder('public');
				self.updateHeaderTitle($(this));

				var target = $(this).data('target');

				switch (target)
				{
					case 'room':
						self.roomId = $(this).data('room-id');
						XF.Cookie.set('siropu_chat_room_id', self.roomId);

						content.find('[data-room-id="' + self.roomId + '"]').show();

						if ($(this).data('readonly'))
						{
							self.editorOffPlaceholder('readonly');
						}
						else
						{
							self.editorOnPlaceholder('public');
						}

						if (self.isResponsive())
						{
							$('.siropuChatRoom.siropuChatUsers').hide();
						}
						else
						{
							self.editorFocus();
						}

						self.autoScroll();
						break;
					case 'room-list':
						rooms.toggle();

						self.getRooms();
						self.editorOffPlaceholder('');
						break;
					case 'conv-list':
						conversationUsers.show();

						if (self.getConvCount())
						{
							conversationUsers.find('li[data-conv-id="' + self.convId + '"]').trigger('click', true);
						}
						else
						{
							self.editorOffPlaceholder('');
						}
						break;
					case 'conv-form':
						startConversation.show();

						if (!self.screenSizeIs('s'))
						{
							startConversation.find('input').focus();
						}

						self.editorOffPlaceholder('');
						break;
				}

				self.setChannel(target.match(/room/) ? 'room' : 'conv');
			});
		},

		_initConversations: function()
		{
			var self = this;

			conversationUsers.on('click', 'li[data-conv-id]', function(e, isTriggered)
			{
				self.convId = $(this).data('conv-id');
				XF.Cookie.set('siropu_chat_conv_id', self.convId);

				self.updateHeaderTitle($(this));

				$(this).removeClass('siropuChatNewMessage');

				$('.siropuChatConversation.siropuChatMessages').hide();
				$(this).addClass('siropuChatActiveConversation').siblings().removeClass('siropuChatActiveConversation');

				var messageContainer = $('.siropuChatConversation.siropuChatMessages[data-conv-id="' + self.convId + '"]');

				if (messageContainer.find('> li').length)
				{
					messageContainer.show();
					self.autoScroll(messageContainer);

					if (self.convUnread[self.convId])
					{
						XF.ajax('POST',
							XF.canonicalizeUrl('index.php?chat/conversation/' + self.convId + '/mark-as-read'),
							{
								conv_unread: self.convUnread[self.convId]
							},
							function(data)
							{
								if (data.convRead)
								{
									delete self.convUnread[data.convRead];
								}
							},
							{
								skipDefault: true,
								global: false
							}
						);
					}
				}
				else
				{
					var loadingMessages = $('<li class="siropuChatLoadingMessages" />');
					loadingMessages.html(XF.phrase('siropu_chat_loading_conversation_messages'));

					messageContainer = self.createConversationMessageContainer(self.convId);
					messageContainer.html(loadingMessages).insertBefore(startConversation).show();

					self._initAutoScrollToggle(messageContainer);

					XF.ajax('POST',
						XF.canonicalizeUrl('index.php?chat/conversation/' + self.convId + '/load-messages'),
						{
							conv_unread: self.convUnread[self.convId]
						},
						function(data)
						{
							messageContainer.html(data.messages);
							XF.activate(messageContainer);

							setTimeout(function()
							{
								self.doAutoScroll(messageContainer);
							});
						}
					);
				}

				self.editorOn();
				self.editorSetPlaceholder('private', $(this));

				if (!self.inverse && messageContainer.find('iframe').length)
				{
					setTimeout(function()
					{
						self.autoScroll(messageContainer);
					}, 1000);
				}

				if (self.isResponsive())
				{
					 if (isTriggered)
					 {
						 messageContainer.hide();
					 }
					 else
					 {
					 	conversationUsers.hide();
					 }
				}
				else
				{
					self.editorFocus();
				}
			});

			conversationUsers.on('mouseover mouseout', '> li', function()
			{
				$(this).find('.siropuChatLeaveConversation').toggle();
			});
		},

		_initOnLoad: function()
		{
			if (this.inverse)
			{
				return;
			}

			var self = this;

			$('.siropuChatMessageText:visible img').on('load', function()
			{
				self.autoScroll();
			});
		},

		_initAutoScrollToggle: function(element)
		{
			var self = this;
			var element = element ? element : $('.siropuChatMessages');

			element.scroll(function()
			{
				self.toggleAutoScroll($(this));
			});
		},

		_initSounds: function()
		{
			this.sounds['normal'] = this.getSoundSetting('normal') ? this.loadSound('normal') : '';
			this.sounds['whisper'] = this.getSoundSetting('whisper') ? this.loadSound('whisper') : '';
			this.sounds['private'] = this.getSoundSetting('private') ? this.loadSound('private') : '';
			this.sounds['tag'] = this.getSoundSetting('tag') ? this.loadSound('tag') : '';
			this.sounds['bot'] = this.getSoundSetting('bot') ? this.loadSound('bot') : '';
			this.sounds['error'] = this.getSoundSetting('bot') ? this.loadSound('error') : '';
		},

		getChannel: function()
		{
			return this.channel;
		},

		getRoomId: function()
		{
			return this.roomId;
		},

		getConvId: function()
		{
			return this.convId;
		},

		escapeRegExp: function(str)
		{
              return isNaN(str) ? str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&") : str;
          }
	});

	XF.SiropuChat.Form = XF.Element.newHandler({
		options: {
			edit: false,
			multiLine: false
		},

		init: function()
          {
			var self = this;
			var form = this.$target;
			var input = form.find('textarea');

			input.on('froalaEditor.initialized', function(e, editor)
			{
				editor.opts.multiLine = self.options.multiLine;
				editor.opts.htmlAllowedTags = ['img'];

				editor.events.on('keydown', function(e)
				{
					if (e.which == 32 && !self.options.edit && !XF.SiropuChat.Core.prototype.editorGetText())
					{
						e.preventDefault();

						return input.froalaEditor('html.set', '');
					}

					if (e.which == 13)
					{
						if (self.options.multiLine && e.shiftKey)
						{
							return e.preventDefault();
						}

						form.submit();

						if (self.options.edit)
						{
							form.find('.js-overlayClose').click();
						}
					}
				});

				if (self.options.edit)
				{
					setTimeout(function()
					{
						input.froalaEditor('events.focus');
						input.froalaEditor('selection.setAfter', 'p');
						input.froalaEditor('selection.restore');
					}, 500);
				}
				else
				{
					input.froalaEditor('html.set', '');
				}
			});
          }
	});

	XF.SiropuChat.Messages = XF.Element.newHandler({
		options:{},

		init: function()
          {
               $('a[data-xf-click="siropu-chat-quote"]').remove();

			this.$target.on('mouseover mouseout', '.siropuChatMessageRow', function()
			{
				if ($(this).find('.siropuChatMessageActions').length)
				{
					$(this).find('.siropuChatDateTime, .siropuChatMessageActions').toggle();
				}
			});
          }
	});

	XF.SiropuChat.FindRooms = XF.Element.newHandler({
          options: {},

          init: function()
          {
			this.$target.on('keyup', function()
			{
				var find = $(this).val().trim();
				var regex = new RegExp(find, 'gi');

				$('#siropuChatRooms > li[data-room-name]').hide().each(function()
				{
				    if ($(this).data('room-name').match(regex))
				    {
					   $(this).show();
				    }
				});
			});
          }
     });

	XF.SiropuChat.StartConversationForm = XF.Element.newHandler({
          options: {},

          init: function()
          {
			var self = this;

               this.$target.on('submit', function(e)
			{
				e.preventDefault();

				var recipientInput = $(this).find('input');
				var messageInput = $(this).find('textarea');

				if (!recipientInput.val().trim())
				{
					return recipientInput.focus();
				}

				if (!messageInput.val().trim())
				{
					return messageInput.focus();
				}

				XF.ajax('POST',
					$(this).attr('action'),
					$(this).serialize(),
					function(data)
					{
						if (noConversations.length)
						{
							noConversations.remove();
						}

						XF.SiropuChat.Core.prototype.updateConversations(data);
						tabs.find('a[data-target="conv-list"]').click();

						recipientInput.val('');
						messageInput.val('');
					}
				);
			});
          }
     });

	XF.SiropuChat.LeaveConversation = XF.Element.newHandler({
		options: {},

		init: function()
		{
			this.$target.on('ajax-submit:response', $.proxy(this, 'ajaxResponse'));
		},

		ajaxResponse: function(e, data)
		{
			XF.SiropuChat.Core.prototype.updateConversations(data);
			XF.SiropuChat.Core.prototype.leaveConversationPostActions(data.convId);
		}
	});

	XF.SiropuChat.Like = XF.Click.newHandler({
		eventNameSpace: 'SiropuChatLike',

		init: function() {},

		click: function(e)
		{
			e.preventDefault();

			var self = this;

			XF.ajax('POST',
				this.$target.attr('href'),
				function(data)
				{
					if (data.html)
					{
						XF.setupHtmlInsert(data.html, function($html, data, onComplete)
						{
							if ($html.length)
							{
								self.$target.parents('.siropuChatMessageRow').replaceWith($html);
							}
						});
					}
				}
			);
		}
	});

	XF.SiropuChat.Unlike = XF.Click.newHandler({
		eventNameSpace: 'SiropuChatUnlike',

		init: function() {},

		click: function(e)
		{
			e.preventDefault();

			var self = this;

			XF.ajax('POST',
				this.$target.attr('href'),
				function(data)
				{
					if (data.html)
					{
						XF.setupHtmlInsert(data.html, function($html, data, onComplete)
						{
							if ($html.length)
							{
								self.$target.parents('.siropuChatMessageRow').replaceWith($html);
							}
						});
					}
				}
			);
		}
	});

	XF.SiropuChat.Quote = XF.Click.newHandler({
		eventNameSpace: 'SiropuChatQuote',

		init: function() {},

		click: function(e)
		{
			e.preventDefault();

			XF.ajax('POST',
				this.$target.attr('href'),
				function(data)
				{
					if (data.quote)
					{
						XF.SiropuChat.Core.prototype.editorSetHtml(data.quoteHtml);
						XF.SiropuChat.Core.prototype.editorFocus();
					}
				}
			);
		}
	});

	XF.SiropuChat.LeaveRoom = XF.Click.newHandler({
		eventNameSpace: 'SiropuChatLeaveRoom',

		init: function() {},

		click: function(e)
		{
			e.preventDefault();

			var self = this;

			XF.ajax('POST',
				this.$target.attr('href'),
				function(data)
				{
					XF.SiropuChat.Core.prototype.leaveRoomPostActions(data.roomId, true);
					self.$target.parent('.menu').toggle();
				}
			);
		}
	});

	XF.SiropuChat.Whisper = XF.Click.newHandler({
		eventNameSpace: 'SiropuChatWhisper',

		init: function() {},

		click: function(e)
		{
			var menuId = this.$target.parents('.menu').attr('id');
			var username = $('a[aria-controls="' + menuId + '"').parents('li[data-user-id]').data('username');
			var editorText = XF.SiropuChat.Core.prototype.editorGetText();
			var command = XF.SiropuChat.Core.prototype.getCommand('whisper');

			var recipients = [];
			recipients.push(username);

			if (editorText.match(/\[(.*?)\]/))
			{
				var startTag = editorText.indexOf('[');
				var endTag = editorText.indexOf(']');
				var usernames = editorText.substring(startTag + 1, endTag);

				if (usernames.length)
				{
					var userArr = usernames.split(',');

					for (var i in userArr)
					{
						recipients.push(userArr[i].trim());
					}
				}

				if (usernames.match(XF.SiropuChat.Core.prototype.escapeRegExp(username)))
				{
					recipients = recipients.filter(function(item)
					{
						return item != username;
					});
				}
			}

			var output = '';

			if (recipients.length)
			{
				output = '/' + command + ' [' + recipients.join(', ') + ']';
			}

			XF.SiropuChat.Core.prototype.editorSetHtml(output);
		}
	});

	XF.SiropuChat.Popup = XF.Click.newHandler({
		eventNameSpace: 'SiropuChatPopup',

		init: function() {},

		click: function(e)
		{
			e.preventDefault();

			var siropuChatWindowPopup;

			if (siropuChatWindowPopup === undefined || siropuChatWindowPopup.closed)
			{
				siropuChatWindowPopup = window.open(e.target.href, 'siropuChatWindowPopup', 'width=800,height=500');
			}
			else
			{
				siropuChatWindowPopup.focus();
			};
		}
	});

	XF.SiropuChat.LoadMoreMessages = XF.Click.newHandler({
		eventNameSpace: 'siropuChatLoadMoreMessages',

		init: function() {},

		click: function(e)
		{
			e.preventDefault();

			var target = this.$target;

			if (target.data('complete'))
			{
				return;
			}

			var ul = target.parents('ul.siropuChatMessages');
			var roomId = ul.data('room-id');
			var convId = ul.data('conv-id');
			var search = ul.attr('data-search');
			var inverse = XF.SiropuChat.Core.prototype.getMiscSetting('inverse');

			if (inverse)
			{
				var message = ul.find('> li[data-id]:last');
			}
			else
			{
				var message = ul.find('> li[data-id]:first');
			}

			if (roomId)
			{
				var uri = 'room/' + roomId;
			}
			else
			{
				var uri = 'conversation/' + convId;
			}

			XF.ajax('GET',
				XF.canonicalizeUrl('index.php?chat/' + uri + '/load-more-messages'),
				{
					message_id: message.data('id'),
					find: search
				},
				function(data)
				{
					if (data.messages)
					{
						if (inverse)
						{
							message.after(data.messages);
						}
						else
						{
							message.before(data.messages).get(0).scrollIntoView(false);
						}
					}

					if (!data.hasMore)
					{
						target.attr('data-complete', true);
						target.html(XF.phrase('siropu_chat_all_messages_have_been_loaded'));

						setTimeout(function()
						{
							target.fadeOut();
						}, 5000);
					}
				}
			);
		}
	});

	XF.SiropuChat.EditNotice = XF.Element.newHandler({
          options: {},

          init: function()
          {
               this.$target.on('ajax-submit:response', $.proxy(this, 'ajaxResponse'));
          },

          ajaxResponse: function(e, data)
          {
			if (data.message)
               {
                    XF.flashMessage(data.message, 2000);
               }

			XF.SiropuChat.Core.prototype.updateNotice(data);
          }
     });

	XF.SiropuChat.ToggleUsers = XF.Click.newHandler({
		eventNameSpace: 'siropuChatToggleUsers',

		init: function() {},

		click: function(e)
		{
			var channel = XF.SiropuChat.Core.prototype.getChannel();
			var roomId = XF.SiropuChat.Core.prototype.getRoomId();
			var convId = XF.SiropuChat.Core.prototype.getConvId();

			if (channel == 'room')
			{
				$('.siropuChatUsers[data-room-id="' + roomId + '"]').toggle();
				$('.siropuChatMessages[data-room-id="' + roomId + '"]').toggle();
			}
			else
			{
				conversationUsers.toggle();
				$('.siropuChatMessages[data-conv-id="' + convId + '"]').toggle();
			}
		}
	});

	XF.SiropuChat.ToggleOptions = XF.Click.newHandler({
		eventNameSpace: 'siropuChatToggleOptions',

		init: function() {},

		click: function(e)
		{
			var input = this.$target.parents('fieldset').find('input');
			input.prop('checked', input.filter(':checked').length ? false : true);
			settings.change();
		}
	});

	XF.SiropuChat.ToggleConvForm = XF.Click.newHandler({
		eventNameSpace: 'siropuChatToggleConvForm',

		init: function() {},

		click: function(e)
		{
			var form = this.$target.parent('.siropuChatUserMenu').find('form');
			form.toggle();

			if (!XF.SiropuChat.Core.prototype.screenSizeIs('s'))
			{
				form.find('textarea').focus();
			}
		}
	});

	XF.SiropuChat.Logout = XF.Element.newHandler({
          options: {},

          init: function()
          {
               this.$target.on('ajax-submit:response', $.proxy(this, 'ajaxResponse'));
          },

          ajaxResponse: function(e, data)
          {
               if (data.errors || data.exception)
               {
                    return;
               }

               e.preventDefault();

               if (data.message)
               {
                    XF.flashMessage(data.message, 3000);
               }

			XF.SiropuChat.Core.prototype.postLogout();
          }
     });

	XF.SiropuChat.EditorButton = {
		init: function()
		{
			XF.SiropuChat.EditorButton.initializeDialog();
			XF.EditorHelpers.dialogs.chat = new XF.SiropuChat.EditorDialogGallery('chat');

			if ($.FE.COMMANDS.xfCustom_chat)
			{
				$.FE.COMMANDS.xfCustom_chat.callback = XF.SiropuChat.EditorButton.callback;
			}
		},

		initializeDialog: function()
		{
			XF.SiropuChat.EditorDialogGallery = XF.extend(XF.EditorDialog, {
				cache: false,

				_init: function(overlay)
				{
					var self = this;
					var container = overlay.$container;
					var submitRowControls = container.find('.formSubmitRow-controls');

					$('.siropuChatDialogInsert').click(function(e)
					{
						e.preventDefault();

						var output = '';

						$('.js-attachmentFileSelected').each(function()
		                    {
		                         output += $(this).data('url');
		                    });

						self.ed.image.insert(output);
						self.overlay.hide();
					});

					$('.siropuChatDialogDelete').click(function(e)
					{
						e.preventDefault();

						var remove = [];

						$('.js-attachmentFileSelected').each(function()
		                    {
		                         remove.push($(this).data('attachment-id'));
		                    });

		                    if (remove.length)
		                    {
		                         XF.ajax('POST',
		     					XF.canonicalizeUrl('index.php?chat/delete-attachments'),
		     					{
		                                   hash: container.find('input[name="hash"]').val(),
		                                   remove: remove,
		                              },
		     					function(data)
		     					{
		                                   if (data.success)
		                                   {
		                                        $('.js-attachmentFileSelected').remove();

		                                        if (!container.find('.js-attachmentFile').length)
		                                        {
		                                             submitRowControls.fadeOut();
		                                        }
		                                   }
		     					}
		     				);
		                    }
					});

					container.on('click', '.js-attachmentFile', function()
		               {
		                    $(this).toggleClass('js-attachmentFileSelected');

		                    if (container.find('.js-attachmentFileSelected').length)
		                    {
		                         submitRowControls.fadeIn();
		                    }
		                    else
		                    {
		                         submitRowControls.fadeOut();
		                    }
		               });
				}
			});
		},

		callback: function()
		{
			XF.EditorHelpers.loadDialog(this, 'chat');
		}
	};

	$(document).on('editor:first-start', XF.SiropuChat.EditorButton.init);

	XF.Element.register('siropu-chat', 'XF.SiropuChat.Core');
	XF.Element.register('siropu-chat-form', 'XF.SiropuChat.Form');
	XF.Element.register('siropu-chat-messages', 'XF.SiropuChat.Messages');
	XF.Element.register('siropu-chat-find-rooms', 'XF.SiropuChat.FindRooms');
	XF.Element.register('siropu-chat-start-conversation-form', 'XF.SiropuChat.StartConversationForm');
	XF.Element.register('siropu-chat-leave-conversation', 'XF.SiropuChat.LeaveConversation');
	XF.Element.register('siropu-chat-edit-notice', 'XF.SiropuChat.EditNotice');
	XF.Element.register('siropu-chat-logout', 'XF.SiropuChat.Logout');

	XF.Click.register('siropu-chat-popup', 'XF.SiropuChat.Popup');
	XF.Click.register('siropu-chat-like', 'XF.SiropuChat.Like');
	XF.Click.register('siropu-chat-unlike', 'XF.SiropuChat.Unlike');
	XF.Click.register('siropu-chat-quote', 'XF.SiropuChat.Quote');
	XF.Click.register('siropu-chat-whisper', 'XF.SiropuChat.Whisper');
	XF.Click.register('siropu-chat-leave-room', 'XF.SiropuChat.LeaveRoom');
	XF.Click.register('siropu-chat-load-more-messages', 'XF.SiropuChat.LoadMoreMessages');
	XF.Click.register('siropu-chat-toggle-users', 'XF.SiropuChat.ToggleUsers');
	XF.Click.register('siropu-chat-toggle-options', 'XF.SiropuChat.ToggleOptions');
	XF.Click.register('siropu-chat-toggle-conv-form', 'XF.SiropuChat.ToggleConvForm');
}
(jQuery, window, document);
