<?php
use Orm\Model;

class Model_Invoice extends Model
{
	protected static $_properties = array(
		'id',
		'paid_date',
		'status',
		'job_id',
		'created_at',
		'updated_at',
	);

	protected static $_has_many = array(
		'histories' => array(
			'key_from' => 'id',
			'model_to' => 'Model_History',
			'key_to' => 'invoice_id',
			'cascade_save' => true,
			'cascade_delete' => true,
    	)
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
		$val->add_field('status', 'Status', 'required');
		$val->add_field('job_id', 'Job', 'required');

		return $val;
	}
}