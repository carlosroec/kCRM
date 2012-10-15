<?php

namespace Fuel\Migrations;

class Create_invoices
{
	public function up()
	{
		\DBUtil::create_table('invoices', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'paid_date' => array('type' => 'date', 'null' => true),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'job_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'), true, 'innoDB', 'utf8');

		\DBUtil::create_table('histories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'payment_date' => array('type' => 'date'),
			'payment_method' => array('constraint' => 11, 'type' => 'int'),
			'amount' => array('constraint' => '8,2', 'type' => 'double'),
			'detail' => array('constraint' => 256, 'type' => 'varchar', 'null' => true),
			'invoice_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'), true, 'innoDB', 'utf8');
	}

	public function down()
	{
		\DBUtil::drop_table('invoices');
		\DBUtil::drop_table('histories');
	}
}