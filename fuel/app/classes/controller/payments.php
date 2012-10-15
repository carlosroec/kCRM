<?php

/**
* CRM - Customer Relationship Management
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Payments extends Controller_User
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
		$total_payments = DB::count_records('payments');

		$config = array(
			'pagination_url' => Uri::create('payments/list'),
			'total_items' => $total_payments,
			'per_page' => 10,
			'uri_segment' => 3,
			'template' => array(
				'wrapper_start' => '<div class="pagination"> ',
				'wrapper_end' => ' </div>',
			),
		);

		Pagination::set_config($config);

		$payments = DB::select()
			->from('payments')
			->limit(Pagination::$per_page)
			->offset(Pagination::$offset)
			->order_by('payment_date', 'desc')
			->execute();

		$payments_results = array();

		foreach ($payments as $payment) {
			$id = $payment['id'];
			$name = $payment['name'];
			$description = $payment['description'];
			$amount = $payment['amount'];
			$payment_date = $payment['payment_date'];
			$status = '';
			switch ($payment['status'])
			{
				case 0:
					$status = '<strong class="hg-yellow"> PENDING </strong>';
					break;
				case 1:
					$status = '<strong class="hg-green"> PAID </strong>';
					break;
			}

			$payments_results[] = array('id' => $id, 'name' => $name, 'description' => $description, 'amount' => $amount, 'payment_date' => $payment_date, 'status' => $status);
		}

		$data['pagination'] = Pagination::create_links();
		$data['payments'] = $payments_results;

		$this->template->title = "PAYMENTS";
		$this->template->subtitle = "Manage all your payments";
		$this->template->content = View::forge('staff/payments/list', $data, false);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Payment::validate('create');

			if ($val->run())
			{
				$payment = Model_Payment::forge(array(
					'name' => Input::post('name'),
					'description' => Input::post('description'),
					'amount' => Input::post('amount'),
					'payment_date' => Input::post('payment_date'),
					'status' => Input::post('status'),
					'created_by' => Input::post('created_by'),
				));

				if ($payment and $payment->save())
				{
					Session::set_flash('success', 'Added Payment #' . $payment->id . '.');

					Response::redirect('payments/list');
				}

				else
				{
					Session::set_flash('error', 'Could not save Payment.');
				}
			}

			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		//Current User
		$user_id = Sentry::user()->get('id');

		//Set Status
		$status = array('PENDING', 'PAID');

		$view = View::forge('staff/payments/create');
		$view->set_global('user_id', $user_id);
		$view->set_global('status', $status);

		$this->template->title = "PAYMENTS";
		$this->template->subtitle = "Manage all your payments";
		$this->template->content = $view;
	}

	public function action_view($id = null)
	{
		$id = Security::xss_clean($id);

		$payment = DB::select()
			->from('payments')
			->where('payments.id', '=', $id)
			->execute();

		$payment = $payment->current();
		$payments_results = array();

		if ($payment)
		{
			$id = $payment['id'];
			$name = $payment['name'];
			$description = $payment['description'];
			$amount = $payment['amount'];
			$payment_date = $payment['payment_date'];
			$status = '';
			switch ($payment['status'])
			{
				case 0:
					$status = '<strong class="hg-yellow"> PENDING </strong>';
					break;
				case 1:
					$status = '<strong class="hg-green"> PAID </strong>';
					break;
			}
			$created_by = $payment['created_by'];

			$payments_results = array('id' => $id, 'name' => $name, 'description' => $description, 'amount'=> $amount, 'payment_date' => $payment_date, 'status' => $status, 'created_by' => $created_by);
		}

		else
		{
			throw new HttpNotFoundException;	
		}

		$data['payment'] = $payments_results;

		$this->template->title = "PAYMENTS";
		$this->template->subtitle = "Manage all your payments";
		$this->template->content = View::forge('staff/payments/view', $data, false);
	}

	public function action_edit($id = null)
	{
		$id = Security::xss_clean($id);
		$payment = Model_Payment::find($id);
		$val = Model_Payment::validate('edit');

		if ($val->run())
		{
			$payment->name = Input::post('name');
			$payment->description = Input::post('description');
			$payment->amount = Input::post('amount');
			$payment->payment_date = Input::post('payment_date');
			$payment->status = Input::post('status');
			$payment->created_by = Input::post('created_by');

			if ($payment->save())
			{
				Session::set_flash('success', 'Updated Payment #' . $id);

				Response::redirect('payments/list');
			}

			else
			{
				Session::set_flash('error', 'Could not update Payment #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$payment->name = $val->validated('name');
				$payment->description = $val->validated('description');
				$payment->amount = $val->validated('amount');
				$payment->payment_date = $val->validated('payment_date');
				$payment->status = $val->validated('status');
				$payment->created_by = $val->validated('created_by');

				Session::set_flash('error', $val->show_errors());
			}

			$this->template->set_global('payment', $payment, false);
		}

		//Set Status
		$status = array('PENDING', 'PAID');

		$view = View::forge('staff/payments/edit');
		$view->set_global('status', $status);

		$this->template->title = "PAYMENTS";
		$this->template->subtitle = "Manage all your payments";
		$this->template->content = $view;
	}
}