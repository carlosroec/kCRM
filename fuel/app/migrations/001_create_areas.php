<?php

namespace Fuel\Migrations;

class Create_areas
{
	public function up()
	{
		\DBUtil::create_table('areas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 128, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'), true, 'innoDB', 'utf8');
	}

	public function down()
	{
		\DBUtil::drop_table('areas');
	}
}