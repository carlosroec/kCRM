<?php
use Orm\Model;

class Model_Task extends Model
{
	protected static $properties = array(
		'id',
		'name',
		'amount',
		'staff_id',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[128]');
		$val->add_field('amount', 'Amount', 'numeric_min[0]|valid_string[numeric,dots]');
		$val->add_field('staff_id', 'Staff', 'required');

		return $val;
	}
}