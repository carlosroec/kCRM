<?php
use Orm\Model;

class Model_Job extends Model
{
	protected static $_properties = array(
		'id',
		'title',
		'type',
		'start_date',
		'due_date',
		'finished_date',
		'cost',
		'tax',
		'customer_id',
		'staff_id',
		'status',
		'created_by',
		'created_at',
		'updated_at',
	);

	protected static $_has_many = array(
		'tasks' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Task',
			'key_to' => 'job_id',
			'cascade_save' => true,
			'cascade_delete' => true,
    	),
    	'invoices' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Invoice',
			'key_to' => 'job_id',
			'cascade_save' => true,
			'cascade_delete' => true,
    	),
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
		$val->add_field('title', 'Title', 'required|max_length[256]');
		$val->add_field('start_date', 'Start Date', 'required');
		$val->add_field('due_date', 'Due Date', 'required');
		$val->add_field('customer_id', 'Customer', 'required');
		$val->add_field('staff_id', 'Staff', 'required');
		$val->add_field('cost', 'Cost', 'numeric_min[0]|valid_string[numeric,dots]');
		$val->add_field('tax', 'Tax', 'numeric_min[0]|valid_string[numeric,dots]');

		$val->set_message('valid_string', 'The field :label must be a valid value.');

		return $val;
	}
}