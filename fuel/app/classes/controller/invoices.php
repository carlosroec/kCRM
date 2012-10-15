<?php

/**
* CRM - Customer Relationship Management
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Invoices extends Controller_User
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
		$invoices = '';
		$total_invoices = 0;
		$user_id = Sentry::user()->get('id');

		if (Sentry::user()->is_admin())
		{
			$invoices = DB::select()
				->from('invoices')
				->execute();
			$total_invoices = count($invoices);
		}

		else
		{
			$invoices = DB::select()
				->from('invoices')
				->join('jobs', 'LEFT')->on('jobs.id', '=', 'invoices.job_id')
				->where('jobs.staff_id', $user_id)
				->execute();
			$total_invoices = count($invoices);
		}

		$config = array(
			'pagination_url' => Uri::create('invoices/list'),
			'total_items' => $total_invoices,
			'per_page' => 10,
			'uri_segment' => 3,
			'template' => array(
				'wrapper_start' => '<div class="pagination"> ',
				'wrapper_end' => ' </div>',
			),
		);

		Pagination::set_config($config);

		if (Sentry::user()->is_admin())
		{
			$invoices = DB::select('invoices.id', 'jobs.title', 'invoices.status', 'invoices.created_at')
				->from('invoices')
				->join('jobs', 'LEFT')->on('jobs.id', '=', 'invoices.job_id')
				->limit(Pagination::$per_page)
				->offset(Pagination::$offset)
				->order_by('invoices.created_at')
				->execute();
		}
		else
		{
			$invoices = DB::select('invoices.id', 'jobs.title', 'invoices.status', 'jobs.staff_id', 'invoices.created_at')
				->from('invoices')
				->join('jobs', 'LEFT')->on('jobs.id', '=', 'invoices.job_id')
				->where('jobs.staff_id', $user_id)
				->limit(Pagination::$per_page)
				->offset(Pagination::$offset)
				->order_by('invoices.created_at')
				->execute();
		}

		$invoices_result = array();

		foreach ($invoices as $invoice) 
		{
			$id = $invoice['id'];
			$title = $invoice['title'];
			$status = '';
			switch ($invoice['status'])
			{
				case 0:
					$status = '<strong class="hg-yellow"> UNPAID </strong>';
					break;
				case 1:
					$status = '<strong class="hg-green"> PAID </strong>';
					break;
			}

			$invoices_result[] = array('id' => $id, 'title' => $title, 'status' => $status);
		}


		$data['pagination'] = Pagination::create_links();
		$data['invoices'] = $invoices_result;

		$this->template->title = "INVOICES";
		$this->template->subtitle = "Manage all your invoices";
		$this->template->content = View::forge('staff/invoices/list', $data, false);
	}

	public function action_view($invoice_id = null)
	{
		$invoice_id = Security::xss_clean($invoice_id);

		$invoices = DB::select('invoices.id', 'jobs.title', 'invoices.status', 'jobs.staff_id', 'jobs.cost', 'jobs.tax', 'invoices.created_at')
			->from('invoices')
			->join('jobs', 'LEFT')->on('jobs.id', '=', 'invoices.job_id')
			->where('invoices.id', $invoice_id)
			->limit(Pagination::$per_page)
			->offset(Pagination::$offset)
			->order_by('invoices.created_at')
			->execute();

		$invoice = $invoices->current();
		$invoices_result = array();

		if ($invoice)
		{
			$id = $invoice['id'];
			$title = $invoice['title'];
			$cost = $invoice['cost'];
			$tax = $invoice['tax'];
			$status = '';
			switch ($invoice['status'])
			{
				case 0:
					$status = '<strong class="hg-yellow"> UNPAID </strong>';
					break;
				case 1:
					$status = '<strong class="hg-green"> PAID </strong>';
					break;
			}

			$invoices_history = DB::select()
				->from('histories')
				->where('histories.invoice_id', '=', $id)
				->execute();

			$invoices_history_result = array();
			$total_collected = 0;
			foreach ($invoices_history as $invoice_history) {
				$id = $invoice_history['id'];
				$payment_date = $invoice_history['payment_date'];
				$payment_method = '';
				switch ($invoice_history['payment_method'])
				{
					case 0:
						$payment_method= '<strong class="hg-yellow"> BANK TRANSFER </strong>';
						break;
					case 1:
						$payment_method = '<strong class="hg-green"> CASH </strong>';
						break;
					case 2:
						$payment_method = '<strong class="hg-blue"> PAYPAL </strong>';
						break;
				}
				$amount = $invoice_history['amount'];
				$detail = $invoice_history['detail'];
				$total_collected += $amount;

				$invoices_history_result[] = array('id' => $id, 'payment_date' => $payment_date, 'payment_method' => $payment_method, 'amount' => $amount, 'detail' => $detail);
			}

			$balance = $cost - $total_collected;

			$invoices_result = array('id' => $id, 'title' => $title, 'cost' => $cost, 'tax' => $tax, 'total_collected' => $total_collected, 'balance' => $balance, 'status' => $status, 'invoices_history' => $invoices_history_result);
		}
		else
		{
			throw new Exception("Error Processing Request", 1);
		}

		$data['invoice'] = $invoices_result;
		$data['invoice_id'] = $invoice_id;
		$this->template->title = "INVOICES";
		$this->template->subtitle = "Manage all your invoices";
		$this->template->content = View::forge('staff/invoices/view', $data, false);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Invoice::validate('create');

			if ($val->run())
			{
				$invoice = Model_Invoice::forge(array(
					'status' => Input::post('status'),
					'job_id' => Input::post('job_id')
				));

				if ($invoice and $invoice->save())
				{
					Session::set_flash('success', 'Added Invoice #' . $invoice->id . '.');

					Response::redirect('invoices/list');
				}
				else
				{
					Session::set_flash('error', 'Could not save Invoice.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}
		
		$user_id = Sentry::user()->get('id');

		if (Sentry::user()->is_admin())
		{
			//Set Jobs
			$jobs = DB::select()
				->from('jobs')
				->where('jobs.status', '=', '1')
				->execute();
		}
		else
		{
			//Set Jobs
			$jobs = DB::select()
				->from('jobs')
				->where('jobs.status', '=', '1')
				->and_where('jobs.staff_id', '=', $user_id)
				->execute();
		}

		$jobs_result = array();

		foreach ($jobs as $job)
		{
			$id = $job['id'];
			$title = $job['title'];

			$jobs_result[$id] = $title;
		}

		//Set Status
		$status = array('UNPAID', 'PAID');

		$view = View::forge('staff/invoices/create');
		$view->set_global('jobs', $jobs_result);
		$view->set_global('status', $status);

		$this->template->title = "INVOICES";
		$this->template->subtitle = "Manage all your invoices";
		$this->template->content = $view;
	}

	public function action_edit($id = null)
	{
		$id = Security::xss_clean($id);

		$invoice = Model_Invoice::find($id);
		$val = Model_Invoice::validate('edit');

		if ($val->run())
		{
			$invoice->job_id = Input::post('job_id');
			$invoice->status = Input::post('status');
			
			if ($invoice->save())
			{
				Session::set_flash('success', 'Updated Invoice #' . $id);

				Response::redirect('invoices/list');
			}

			else
			{
				Session::set_flash('error', 'Could not update Invoice #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$invoice->job_id = $val->validated('job_id');
				$invoice->status = $val->validated('status');
				
				Session::set_flash('error', $val->show_errors());
			}

			$this->template->set_global('invoice', $invoice, false);
		}

		if (Sentry::user()->is_admin())
		{
			//Set Jobs
			$jobs = DB::select()
				->from('jobs')
				->where('jobs.status', '=', '1')
				->execute();
		}
		else
		{
			//Set Jobs
			$jobs = DB::select()
				->from('jobs')
				->where('jobs.status', '=', '1')
				->and_where('jobs.staff_id', '=', $user_id)
				->execute();
		}

		$jobs_result = array();

		foreach ($jobs as $job)
		{
			$id = $job['id'];
			$title = $job['title'];

			$jobs_result[$id] = $title;
		}

		//Set Status
		$status = array('UNPAID', 'PAID');

		$view = View::forge('staff/Invoices/edit');
		$view->set_global('jobs', $jobs_result);
		$view->set_global('status', $status);

		$this->template->title = "INVOICES";
		$this->template->subtitle = "Manage all your invoices";
		$this->template->content = $view;
	}

	public function action_delete($id = null)
	{
		$id = Security::xss_clean($id);

		if ($invoice = Model_Invoice::find($id))
		{
			$invoice->delete();

			Session::set_flash('success', 'Deleted Invoice #' . $id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete Invoice #' . $id);
		}

		Response::redirect('invoices/list');
	}
}