<?php

namespace Siropu\Chat;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function installStep1()
	{
		$this->schemaManager()->alterTable('xf_user', function(\XF\Db\Schema\Alter $table)
		{
			$table->addColumn('siropu_chat_room_id', 'int')->setDefault(1);
			$table->addColumn('siropu_chat_conv_id', 'int')->setDefault(0);
			$table->addColumn('siropu_chat_rooms', 'blob')->nullable();
			$table->addColumn('siropu_chat_conversations', 'blob')->nullable();
			$table->addColumn('siropu_chat_settings', 'blob')->nullable();
			$table->addColumn('siropu_chat_status', 'varchar', 255)->setDefault('');
			$table->addColumn('siropu_chat_is_sanctioned', 'tinyint', 1)->setDefault(0);
			$table->addColumn('siropu_chat_message_count', 'int')->setDefault(0);
			$table->addColumn('siropu_chat_last_activity', 'int')->unsigned(false)->setDefault(-1);

			$table->addKey('siropu_chat_room_id');
			$table->addKey('siropu_chat_message_count');
			$table->addKey('siropu_chat_last_activity');
		});
	}
	public function installStep2()
	{
		$this->schemaManager()->createTable('xf_siropu_chat_room', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('room_id', 'int')->autoIncrement();
			$table->addColumn('room_user_id', 'int');
			$table->addColumn('room_name', 'varchar', 100);
			$table->addColumn('room_description', 'varchar', 255);
			$table->addColumn('room_password', 'varchar', 15);
			$table->addColumn('room_user_groups', 'blob');
			$table->addColumn('room_readonly', 'tinyint', 1)->setDefault(0);
			$table->addColumn('room_locked', 'int')->setDefault(0);
			$table->addColumn('room_prune', 'int')->setDefault(0);
			$table->addColumn('room_thread_id', 'int')->setDefault(0);
			$table->addColumn('room_state', 'enum')->values(['visible', 'deleted'])->setDefault('visible');
			$table->addColumn('room_date', 'int');
			$table->addColumn('room_last_prune', 'int')->setDefault(0);
			$table->addColumn('room_user_count', 'int')->setDefault(0);
			$table->addColumn('room_last_activity', 'int')->setDefault(0);
			$table->addKey('room_user_id');
			$table->addKey('room_name');
			$table->addKey('room_prune');
			$table->addKey('room_user_count');
		});

		$this->schemaManager()->createTable('xf_siropu_chat_message', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('message_id', 'int')->autoIncrement();
			$table->addColumn('message_room_id', 'int')->setDefault(0);
			$table->addColumn('message_user_id', 'int');
			$table->addColumn('message_username', 'varchar', 50);
			$table->addColumn('message_bot_name', 'varchar', 50);
			$table->addColumn('message_type', 'varchar', 10)->setDefault('chat');
			$table->addColumn('message_type_id', 'tinyint', 1)->setDefault(0);
			$table->addColumn('message_is_ignored', 'int')->setDefault(0);
			$table->addColumn('message_text', 'text');
			$table->addColumn('message_recipients', 'blob');
			$table->addColumn('message_mentions', 'blob');
			$table->addColumn('message_like_users', 'blob');
			$table->addColumn('message_like_count', 'int')->setDefault(0);
			$table->addColumn('message_date', 'int');
			$table->addColumn('message_edit_count', 'int')->setDefault(0);
			$table->addKey('message_room_id');
			$table->addKey('message_user_id');
			$table->addKey('message_type');
			$table->addKey('message_is_ignored');
			//$table->addFullTextKey('message_text');
			$table->addKey('message_like_count');
			$table->addKey('message_date');
		});

		$this->schemaManager()->createTable('xf_siropu_chat_conversation', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('conversation_id', 'int')->autoIncrement();
			$table->addColumn('user_1', 'int');
			$table->addColumn('user_2', 'int');
			$table->addColumn('start_date', 'int');
			$table->addColumn('user_left', 'int');
			$table->addKey(['user_1', 'user_2'], 'users');
		});

		$this->schemaManager()->createTable('xf_siropu_chat_conversation_message', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('message_id', 'int')->autoIncrement();
			$table->addColumn('message_conversation_id', 'int');
			$table->addColumn('message_user_id', 'int');
			$table->addColumn('message_username', 'varchar', 50);
			$table->addColumn('message_text', 'text');
			$table->addColumn('message_type', 'varchar', 25)->setDefault('chat');
			$table->addColumn('message_read', 'tinyint', 1)->setDefault(0);
			$table->addColumn('message_liked', 'tinyint', 1)->setDefault(0);
			$table->addColumn('message_date', 'int');
			$table->addKey('message_conversation_id');
			$table->addKey('message_user_id');
			//$table->addFullTextKey('message_text');
			$table->addKey('message_read');
			$table->addKey('message_date');
		});

		$this->schemaManager()->createTable('xf_siropu_chat_bot_message', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('message_id', 'int')->autoIncrement();
			$table->addColumn('message_bot_name', 'varchar', 50);
			$table->addColumn('message_title', 'varchar', 100);
			$table->addColumn('message_text', 'text');
			$table->addColumn('message_rooms', 'blob');
			$table->addColumn('message_rules', 'blob');
			$table->addColumn('message_enabled', 'tinyint', 1)->setDefault(0);
		});

		$this->schemaManager()->createTable('xf_siropu_chat_bot_response', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('response_id', 'int')->autoIncrement();
			$table->addColumn('response_bot_name', 'varchar', 50);
			$table->addColumn('response_keyword', 'text');
			$table->addColumn('response_message', 'mediumtext');
			$table->addColumn('response_rooms', 'blob');
			$table->addColumn('response_user_groups', 'blob');
			$table->addColumn('response_settings', 'blob');
			$table->addColumn('response_last', 'blob');
			$table->addColumn('response_enabled', 'tinyint', 1)->setDefault(0);
		});

		$this->schemaManager()->createTable('xf_siropu_chat_command', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('command_name', 'varchar', 25);
			$table->addColumn('command_name_default', 'varchar', 25);
			$table->addColumn('command_description', 'text');
			$table->addColumn('command_callback_class', 'varchar', 100);
			$table->addColumn('command_callback_method', 'varchar', 75);
			$table->addColumn('command_rooms', 'blob');
			$table->addColumn('command_user_groups', 'blob');
			$table->addColumn('command_options_template', 'varchar', 50);
			$table->addColumn('command_options', 'blob');
			$table->addColumn('command_enabled', 'tinyint', 1)->setDefault(1);
			$table->addPrimaryKey('command_name');
		});

		$this->schemaManager()->createTable('xf_siropu_chat_user_command', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('command_id', 'int')->autoIncrement();
			$table->addColumn('command_user_id', 'int');
			$table->addColumn('command_name', 'varchar', 50);
			$table->addColumn('command_value', 'text');
			$table->addKey('command_user_id');
			$table->addKey('command_name');
		});

		$this->schemaManager()->createTable('xf_siropu_chat_sanction', function(\XF\Db\Schema\Create $table)
		{
			$table->addColumn('sanction_id', 'int')->autoIncrement();
			$table->addColumn('sanction_user_id', 'int');
			$table->addColumn('sanction_room_id', 'int');
			$table->addColumn('sanction_type', 'varchar', 5);
			$table->addColumn('sanction_start', 'int');
			$table->addColumn('sanction_end', 'int');
			$table->addColumn('sanction_author', 'int');
			$table->addColumn('sanction_reason', 'text');
			$table->addKey('sanction_user_id');
			$table->addKey('sanction_room_id');
			$table->addKey('sanction_type');
		});
	}
	public function installStep3()
	{
		$room = \XF::em()->create('Siropu\Chat:Room');
		$room->bulkSet([
			'room_name'        => 'General chit-chat',
			'room_description' => 'The place where you can chat about everything.'
		]);
		$room->save();
	}
	public function installStep4()
	{
		$commands = [
			'help'    => ['class' => 'Help', 'description' => 'phrase:siropu_chat_command_help_explain', 'perms' => []],
			'join'    => ['class' => 'Join', 'description' => 'phrase:siropu_chat_command_join_explain', 'perms' => [2]],
			'leave'   => ['class' => 'Leave', 'description' => 'phrase:siropu_chat_command_leave_explain', 'perms' => []],
			'logout'  => ['class' => 'Logout', 'description' => 'phrase:siropu_chat_command_logout_explain', 'perms' => [2]],
			'mute'    => ['class' => 'Mute', 'description' => 'phrase:siropu_chat_command_mute_explain', 'perms' => [3]],
			'unmute'  => ['class' => 'Unmute', 'description' => 'phrase:siropu_chat_command_unmute_explain', 'perms' => [3]],
			'kick'    => ['class' => 'Kick', 'description' => 'phrase:siropu_chat_command_kick_explain', 'perms' => [3]],
			'unkick'  => ['class' => 'Unkick', 'description' => 'phrase:siropu_chat_command_unkick_explain', 'perms' => [3]],
			'ban'     => ['class' => 'Ban', 'description' => 'phrase:siropu_chat_command_ban_explain', 'perms' => [3]],
			'unban'   => ['class' => 'Unban', 'description' => 'phrase:siropu_chat_command_unban_explain', 'perms' => [3]],
			'roll'    => ['class' => 'Roll', 'description' => 'phrase:siropu_chat_command_roll_explain', 'perms' => []],
			'giphy'   => ['class' => 'Giphy', 'description' => 'phrase:siropu_chat_command_giphy_explain', 'perms' => []],
			'me'      => ['class' => 'Me', 'description' => 'phrase:siropu_chat_command_me_explain', 'perms' => []],
			'status'  => ['class' => 'Status', 'description' => 'phrase:siropu_chat_command_status_explain', 'perms' => [2]],
			'whisper' => ['class' => 'Whisper', 'description' => 'phrase:siropu_chat_command_whisper_explain', 'perms' => [2]],
			'msg'     => ['class' => 'Msg', 'description' => 'phrase:siropu_chat_command_msg_explain', 'perms' => [2]],
			'find'    => ['class' => 'Find', 'description' => 'phrase:siropu_chat_command_find_explain', 'perms' => []],
			'prune'   => ['class' => 'Prune', 'description' => 'phrase:siropu_chat_command_prune_explain', 'perms' => [3]],
			'nick'    => ['class' => 'Nick', 'description' => 'phrase:siropu_chat_command_nick_explain', 'perms' => [1]],
			'my'      => ['class' => 'My', 'description' => 'phrase:siropu_chat_command_my_explain', 'perms' => [2]],
			'invite'  => ['class' => 'Invite', 'description' => 'phrase:siropu_chat_command_invite_explain', 'perms' => [2]]
		];

		foreach ($commands as $name => $data)
		{
			$command = \XF::em()->create('Siropu\Chat:Command');
			$command->bulkSet([
				'command_name'            => $name,
				'command_name_default'    => $name,
				'command_description'     => $data['description'],
				'command_callback_class'  => 'Siropu\Chat\Command\\' . $data['class'],
				'command_callback_method' => 'run',
				'command_user_groups'     => $data['perms']
			]);
			$command->save();
		}
	}
	public function installStep5()
	{
		$this->createWidget('siropu_chat', 'siropu_chat', [
			'positions' => [
				'siropu_chat_above_forum_list' => 10,
				'siropu_chat_below_forum_list' => 10,
				'siropu_chat_above_content'    => 10,
				'siropu_chat_below_content'    => 10,
				'siropu_chat_sidebar_top'      => 10,
				'siropu_chat_sidebar_bottom'   => 10,
				'siropu_chat_all_pages'        => 10,
				'siropu_chat_page'             => 10
			]
		]);

		$this->createWidget('siropu_chat_rooms', 'siropu_chat_rooms', [
			'positions' => []
		]);

		$this->createWidget('siropu_chat_top_chatters', 'siropu_chat_top_chatters', [
			'positions' => []
		]);

		$this->createWidget('siropu_chat_users', 'siropu_chat_users', [
			'positions' => []
		]);
	}
	public function installStep6()
	{
		$this->app->repository('Siropu\Chat:Room')->rebuildRoomCache();
		$this->app->repository('Siropu\Chat:Command')->rebuildCommandCache();
		$this->app->repository('Siropu\Chat:BotResponse')->rebuildBotResponseCache();
		$this->app->repository('Siropu\Chat:BotMessage')->rebuildBotMessageCache();
	}
	public function uninstallStep1(array $stepParams = [])
	{
		$this->schemaManager()->alterTable('xf_user', function(\XF\Db\Schema\Alter $table)
		{
			$table->dropColumns([
				'siropu_chat_room_id',
				'siropu_chat_conv_id',
				'siropu_chat_rooms',
				'siropu_chat_conversations',
				'siropu_chat_settings',
				'siropu_chat_status',
				'siropu_chat_is_sanctioned',
				'siropu_chat_message_count',
				'siropu_chat_last_activity'
			]);
		});
	}
	public function uninstallStep2(array $stepParams = [])
	{
		$this->schemaManager()->dropTable('xf_siropu_chat_room');
		$this->schemaManager()->dropTable('xf_siropu_chat_message');
		$this->schemaManager()->dropTable('xf_siropu_chat_conversation');
		$this->schemaManager()->dropTable('xf_siropu_chat_conversation_message');
		$this->schemaManager()->dropTable('xf_siropu_chat_bot_message');
		$this->schemaManager()->dropTable('xf_siropu_chat_bot_response');
		$this->schemaManager()->dropTable('xf_siropu_chat_command');
		$this->schemaManager()->dropTable('xf_siropu_chat_user_command');
		$this->schemaManager()->dropTable('xf_siropu_chat_sanction');
	}
	public function uninstallStep3()
	{
		$this->db()->delete('xf_attachment', 'content_type = ?', 'siropu_chat');
	}
}
