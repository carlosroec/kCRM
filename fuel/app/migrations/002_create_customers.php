<?php

namespace Fuel\Migrations;

class Create_customers
{
	public function up()
	{
		\DBUtil::create_table('customers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 256, 'type' => 'varchar'),
			'first_name' => array('constraint' => 256, 'type' => 'varchar'),
			'last_name' => array('constraint' => 256, 'type' => 'varchar'),
			'email' => array('constraint' => 128, 'type' => 'varchar', 'null' => true),
			'phone' => array('constraint' => 128, 'type' => 'varchar', 'null' => true),
			'mobile' => array('constraint' => 128, 'type' => 'varchar', 'null' => true),
			'language' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'address_line1' => array('constraint' => 256, 'type' => 'varchar', 'null' => true),
			'address_line2' => array('constraint' => 256, 'type' => 'varchar', 'null' => true),
			'address_city' => array('constraint' => 256, 'type' => 'varchar', 'null' => true),
			'address_post_code' => array('constraint' => 64, 'type' => 'varchar', 'null' => true),
			'address_state' => array('constraint' => 256, 'type' => 'varchar', 'null' => true),
			'address_country' => array('constraint' => 256, 'type' => 'varchar', 'null' => true),
			'status' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
			), array('id'), true, 'innoDB', 'utf8');
	}

	public function down()
	{
		\DBUtil::drop_table('customers');
	}
}