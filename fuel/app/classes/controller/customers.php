<?php

/**
* CRM - Customer Relationship Management
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Customers extends Controller_User
{
	public $template = 'template';
	
	public function before()
	{
		parent::before();

		if ( ! Sentry::user()->in_group('administrator') and ! Sentry::user()->in_group('staff'))
		{
			Response::redirect('user/login');
		}
	}

	public function action_list($page = null)
	{

		$total_customers = DB::count_records('customers');

		$config = array(
			'pagination_url' => Uri::create('customers/list'),
			'total_items' => $total_customers,
			'per_page' => 10,
			'uri_segment' => 3,
			'template' => array(
				'wrapper_start' => '<div class="pagination"> ',
				'wrapper_end' => ' </div>',
			),
		);

		Pagination::set_config($config);

		$customers = DB::select()
			->from('customers')
			->limit(Pagination::$per_page)
			->offset(Pagination::$offset)
			->execute();

		$customers_result = array();

		foreach ($customers as $customer)
		{
			$id = $customer['id'];
			$name = $customer['name'];
			$contact = $customer['first_name'] . ' ' . $customer['last_name'];
			$email = $customer['email'];
			$since = Date::time_ago($customer['created_at']);
			$status = '';
			switch ($customer['status'])
			{
				case 0:
					$status = '<strong class="hg-green"> ON </strong>';
					break;
				case 1:
					$status = '<strong class="hg-red"> OFF </strong>';
					break;
				case 2:
					$status = '<strong class="hg-purple"> POTENTIAL </strong>';
					break;
			}

			$customers_result[] = array('id' => $id, 'name' => $name, 'contact' => $contact, 'email' => $email, 'since' => $since,'status' => $status);
		}

		$data['pagination'] = Pagination::create_links();
		$data['customers'] = $customers_result;

		$this->template->title = "CUSTOMERS";
		$this->template->subtitle = "Manage all your customers";
		$this->template->content = View::forge('staff/customers/list', $data, false);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Customer::validate('create');

			if ($val->run())
			{
				$customer = Model_Customer::forge(array(
					'name' => Input::post('name'),
					'first_name' => Input::post('first_name'),
					'last_name' => Input::post('last_name'),
					'email' => Input::post('email'),
					'phone' => Input::post('phone'),
					'mobile' => Input::post('mobile'),
					'language' => Input::post('language'),
					'address_line1' => Input::post('address_line1'),
					'address_line2' => Input::post('address_line2'),
					'address_post_code' => Input::post('address_post_code'),
					'address_city' => Input::post('address_city'),
					'address_state' => Input::post('address_state'),
					'address_country' => Input::post('address_country'),
					'status' => Input::post('status'),
				));

				if ($customer and $customer->save())
				{
					Session::set_flash('success', 'Added Customer #' . $customer->id . '.');

					Response::redirect('customers/list');
				}

				else
				{
					Session::set_flash('error', 'Could not save Customer.');
				}
			}

			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		//Set Languages
		$languages = array('ES', 'EN');

		//Set Status
		$status = array('ON', 'OFF', 'POTENTIAL');

		$view = View::forge('staff/customers/create');
		$view->set_global('languages', $languages);
		$view->set_global('status', $status);

		$this->template->title = "CUSTOMERS";
		$this->template->subtitle = "Manage all your customers";
		$this->template->content = $view;
	}

	public function action_view($id = null)
	{
		$id = Security::xss_clean($id);

		$customers = DB::select()
			->from('customers')
			->where('customers.id', '=', $id)
			->execute();

		$customer = $customers->current();
		$customers_result = array();

		if ($customer)
		{
			$id = $customer['id'];
			$name = $customer['name'];
			$first_name = $customer['first_name'];
			$last_name = $customer['last_name'];
			$email = $customer['email'];
			$phone = $customer['phone'];
			$mobile = $customer['mobile'];
			$language = '';
			switch ($customer['status'])
			{
				case 0:
					$language = 'ES';
					break;
				case 1:
					$language = 'EN';
					break;
			}
			$address_line1 = $customer['address_line1'];
			$address_line2 = $customer['address_line2'];
			$address_city = $customer['address_city'];
			$address_post_code = $customer['address_post_code'];
			$address_state = $customer['address_state'];
			$address_country = $customer['address_country'];
			$since = Date::time_ago($customer['created_at']);
			$status = '';
			switch ($customer['status'])
			{
				case 0:
					$status = '<strong class="hg-green"> ON </strong>';
					break;
				case 1:
					$status = '<strong class="hg-red"> OFF </strong>';
					break;
				case 2:
					$status = '<strong class="hg-purple"> POTENTIAL </strong>';
					break;
			}

			$customers_result = array('id' => $id, 'name' => $name, 'first_name' => $first_name, 'last_name' => $last_name,'email' => $email, 'phone' => $phone, 'mobile' => $mobile, 'language' => $language, 'address_line1' => $address_line1, 'address_line2' => $address_line2, 'address_city' => $address_city, 'address_post_code' => $address_post_code, 'address_country' => $address_country, 'since' => $since, 'status' => $status);
		}

		else
		{
			throw new HttpNotFoundException;	
		}

		$data['customer'] = $customers_result;

		$this->template->title = "CUSTOMERS";
		$this->template->subtitle = "Manage all your customers";
		$this->template->content = View::forge('staff/customers/view', $data, false);
	}

	public function action_edit($id = null)
	{
		$customer = Model_Customer::find($id);
		$val = Model_Customer::validate('edit');

		if ($val->run())
		{
			$customer->name = Input::post('name');
			$customer->first_name = Input::post('first_name');
			$customer->last_name = Input::post('last_name');
			$customer->email = Input::post('email');
			$customer->phone = Input::post('phone');
			$customer->mobile = Input::post('mobile');
			$customer->language = Input::post('language');
			$customer->address_line1 = Input::post('address_line1');
			$customer->address_line2 = Input::post('address_line2');
			$customer->address_city = Input::post('address_city');
			$customer->address_post_code = Input::post('address_post_code');
			$customer->address_state = Input::post('address_state');
			$customer->address_country = Input::post('address_country');
			$customer->status = Input::post('status');

			if ($customer->save())
			{
				Session::set_flash('success', 'Updated Customer #' . $id);

				Response::redirect('customers/list');
			}

			else
			{
				Session::set_flash('error', 'Could not update Customer #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$customer->name = $val->validated('name');
				$customer->first_name = $val->validated('first_name');
				$customer->last_name = $val->validated('last_name');
				$customer->email = $val->validated('email');
				$customer->phone = $val->validated('phone');
				$customer->mobile = $val->validated('mobile');
				$customer->language = $val->validated('language');
				$customer->address_line1 = $val->validated('address_line1');
				$customer->address_line2 = $val->validated('address_line2');
				$customer->address_city = $val->validated('address_city');
				$customer->address_post_code = $val->validated('address_post_code');
				$customer->address_state = $val->validated('address_state');
				$customer->address_country = $val->validated('address_country');
				$customer->status = $val->validated('status');

				Session::set_flash('error', $val->show_errors());
			}

			$this->template->set_global('customer', $customer, false);
		}

		//Set Languages
		$languages = array('ES', 'EN');

		//Set Status
		$status = array('ON', 'OFF', 'POTENTIAL');

		$view = View::forge('staff/customers/edit');
		$view->set_global('languages', $languages);
		$view->set_global('status', $status);

		$this->template->title = "CUSTOMERS";
		$this->template->subtitle = "Manage all your customers";
		$this->template->content = $view;
	}

	public function action_delete($id = null)
	{
		if ($customer = Model_Customer::find($id))
		{
			$customer->delete();

			Session::set_flash('success', 'Deleted Customer #' . $id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete Customer #' . $id);
		}

		Response::redirect('customers/list');
	}
}