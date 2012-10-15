<?php
use Orm\Model;

class Model_Customer extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'first_name',
		'last_name',
		'email',
		'phone',
		'mobile',
		'language',
		'address_line1',
		'address_line2',
		'address_city',
		'address_post_code',
		'address_state',
		'address_country',
		'status',
		'created_at',
		'updated_at',
	);

	protected static $_has_many = array(
		'jobs' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Job',
			'key_to' => 'customer_id',
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
		$val->add_field('name', 'Name', 'required|max_length[256]');
		$val->add_field('first_name', 'First Name', 'required|max_length[256]');
		$val->add_field('last_name', 'Last Name', 'required|max_length[256]');
		$val->add_field('email', 'Email', 'valid_email');

		return $val;
	}
}