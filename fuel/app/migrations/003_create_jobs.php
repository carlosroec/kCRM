<?php

namespace Fuel\Migrations;

class Create_jobs
{
	public function up()
	{
		\DBUtil::create_table('jobs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'title' => array('constraint' => 256, 'type' => 'varchar'),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'start_date' => array('type' => 'date'),
			'due_date' => array('type' => 'date'),
			'finished_date' => array('type' => 'date', 'null' => true),
			'cost' => array('constraint' => '10,2', 'type' => 'double', 'null' => true),
			'tax' => array('constraint' => '6,2', 'type' => 'double', 'null' => true),
			'customer_id' => array('constraint' => 11, 'type' => 'int'),
			'staff_id' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_by' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
			), array('id'), true, 'innoDB', 'utf8');
	}

	public function down()
	{
		\DBUtil::drop_table('jobs');
	}
}