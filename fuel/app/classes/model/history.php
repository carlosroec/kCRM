<?php
use Orm\Model;

class Model_History extends Model
{
	protected static $_properties = array(
		'id',
		'payment_date',
		'payment_method',
		'amount',
		'detail',
		'invoice_id',
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
		$val->add_field('payment_date', 'Payment Date', 'required');
		$val->add_field('payment_method', 'Payment Date', 'required');
		$val->add_field('amount', 'Payment Date', 'required|numeric_min[0]|valid_string[numeric,dots]');
		$val->add_field('invoice_id', 'Invoice', 'required');

		return $val;
	}
}