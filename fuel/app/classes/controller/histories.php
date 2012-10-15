<?php

/**
* CRM - Customer Relationship Management
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Histories extends Controller_User
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

	public function action_create($invoice_id = null)
	{
		$invoice_id = Security::xss_clean($invoice_id);

		if (Input::method() == 'POST')
		{
			$val = Model_History::validate('create');

			if ($val->run())
			{
				$history = Model_History::forge(array(
					'payment_date' => Input::post('payment_date'),
					'payment_method' => Input::post('payment_method'),
					'amount' => Input::post('amount'),
					'detail' => Input::post('detail'),
					'invoice_id' => Input::post('invoice_id')
				));

				if ($history and $history->save())
				{
					Session::set_flash('success', 'Added Invoice History #' . $history->id . '.');

					Response::redirect('invoices/view/' . Input::post('invoice_id'));
				}
				else
				{
					Session::set_flash('error', 'Could not save Invoice History.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}
		
		//Set Payment Methods
		$payment_methods = array('BANK TRANSFER', 'CASH', 'PAYPAL');

		$view = View::forge('staff/histories/create');
		$view->set_global('invoice_id', $invoice_id);
		$view->set_global('payment_methods', $payment_methods);

		$this->template->title = "INVOICES HISTORY";
		$this->template->subtitle = "Manage all your invoices history";
		$this->template->content = $view;
	}

	public function action_edit($id = null)
	{
		$id = Security::xss_clean($id);

		$history = Model_History::find($id);
		$val = Model_History::validate('edit');

		if ($val->run())
		{
			$history->payment_date = Input::post('payment_date');
			$history->payment_method = Input::post('payment_method');
			$history->amount = Input::post('amount');
			$history->detail = Input::post('detail');
			$history->invoice_id = Input::post('invoice_id');
			
			if ($history->save())
			{
				Session::set_flash('success', 'Updated History #' . $id);

				Response::redirect('invoices/view/' . Input::post('invoice_id'));
			}

			else
			{
				Session::set_flash('error', 'Could not update Invoice History #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$history->payment_date = $val->validated('payment_date');
				$history->payment_method = $val->validated('payment_method');
				$history->amount = $val->validated('amount');
				$history->detail = $val->validated('detail');
				$history->invoice_id = $val->validated('invoice_id');
				
				Session::set_flash('error', $val->show_errors());
			}

			$this->template->set_global('history', $history, false);
		}

		//Set Payment Methods
		$payment_methods = array('BANK TRANSFER', 'CASH', 'PAYPAL');

		$view = View::forge('staff/histories/edit');
		$view->set_global('payment_methods', $payment_methods);

		$this->template->title = "INVOICES History";
		$this->template->subtitle = "Manage all your invoices History";
		$this->template->content = $view;
	}

	public function action_delete($id = null)
	{
		$id = Security::xss_clean($id);
		$invoice_id = '';

		if ($history = Model_History::find($id))
		{
			$invoice_id = $history->invoice_id;
			$history->delete();

			Session::set_flash('success', 'Deleted History #' . $id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete History #' . $id);
		}

		Response::redirect('invoices/view/' . $invoice_id);
	}
}