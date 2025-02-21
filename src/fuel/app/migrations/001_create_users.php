<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
            'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'username' => ['type' => 'varchar', 'constraint' => 50],
            'name' => ['type' => 'varchar', 'constraint' => 50],
            'email' => ['type' => 'varchar', 'constraint' => 255],
            'password' => ['type' => 'varchar', 'constraint' => 255],
            'is_admin' => ['type' => 'boolean', 'default' => 0],
            'group' => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'last_login' => ['type' => 'datetime', 'null' => true],
            'login_hash' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'profile_fields' => ['type' => 'text', 'null' => true],
            'created_at' => ['type' => 'int', 'constraint' => 10, 'null' => true],
            'updated_at' => ['type' => 'int', 'constraint' => 10, 'null' => true],
            ), ['id']);

        \DB::query("ALTER TABLE `users` ADD UNIQUE `username` (`username`)")->execute();
        \DB::query("ALTER TABLE `users` ADD UNIQUE `email` (`email`)")->execute();
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}