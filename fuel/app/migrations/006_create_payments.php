<?php

namespace Fuel\Migrations;

class Create_payments
{
	public function up()
	{
		\DBUtil::create_table('payments', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 64, 'type' => 'varchar'),
			'description' => array('constraint' => 512, 'type' => 'varchar'),
			'amount' => array('constraint' => '8,2', 'type' => 'double'),
			'payment_date' => array('type' => 'date'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'created_by' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'), true, 'innoDB', 'utf8');
	}

	public function down()
	{
		\DBUtil::drop_table('payments');
	}
}