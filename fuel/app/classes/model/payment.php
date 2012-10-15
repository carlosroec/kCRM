<?php
use Orm\Model;

class Model_Payment extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'description',
		'amount',
		'payment_date',
		'status',
		'created_by',
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
		$val->add_field('name', 'Name', 'required|max_length[64]');
		$val->add_field('description', 'Description', 'required|max_length[512]');
		$val->add_field('amount', 'First Name', 'required|numeric_min[0]|valid_string[numeric,dots]');
		$val->add_field('payment_date', 'Payment Date', 'required');
		$val->add_field('status', 'Status', 'required');

		return $val;
	}
}