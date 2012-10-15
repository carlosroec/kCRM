<?php

/**
* CRM - Customer Relationship Management
* @version 		1.0
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_User extends Controller_Template
{
	public $template = 'user/template';

	/**
	* Check for the current user
	*
	* @access public
	* @return void
	*/
	public function before()
	{
		parent::before();

		//Assign current user to the instance so controller can use it
		$current_user = Sentry::check() ? Sentry::user() : null;

		if ($current_user)
		{
			//Get all jobs (Active, Paused, Completed)
			$jobs = DB::select()
				->from('jobs')
				->where('jobs.status', '=', 1)
				->or_where('jobs.status', '=', 2)
				->or_where('jobs.status', '=', 3)
				->execute();

			$jobs_number = 0;
			$jobs_number_active = 0;
			$jobs_number_paused = 0;
			$jobs_number_completed = 0;
			$jobs_total = 0;
			foreach ($jobs as $job) {
				$jobs_number++;
				switch ($job['status']) {
					case 1:
						$jobs_number_active++;
						break;
					case 3:
						$jobs_number_completed++;
						break;
				}
				$jobs_total += $job['cost'];
			}

			//Get users (active)
			$users = DB::select('users.status')
				->from('users')
				->where('users.status', '=', 1)
				->execute();

			$users_total = count($users);

			View::set_global('jobs_number', $jobs_number);
			View::set_global('jobs_number_active', $jobs_number_active);
			View::set_global('jobs_number_completed', $jobs_number_completed);
			View::set_global('jobs_total', $jobs_total);
			View::set_global('users_total', $users_total);
		}
	}

	/**
	* Login form
	*
	* @access public
	* @return Response
	*/
	public function action_login($email = null, $hash = null)
	{
		$data = array();

		if ( Input::method() == 'POST')
		{

			$val = Validation::forge('login');
			$val->add_field('email', 'Email', 'required|valid_email');
			$val->add_field('password', 'Password', 'required');

			if ($val->run())
			{
				try
				{
					$valid_login = Sentry::login(Input::post('email'), Input::post('password'), Input::post('remember'));

					if ($valid_login)
					{
						//Admin or Staff or Don't have group
						if (Sentry::user()->in_group('administrator'))
						{
							Response::redirect('administrator/dashboard');	
						}
						elseif (Sentry::user()->in_group('staff'))
						{
							Response::redirect('staff/dashboard');	
						}
						else
						{
							Session::set_flash('error', 'Invalid login');
						}
					}
					else
					{				
						Session::set_flash('error', 'Invalid login');
					}
				}
				catch(SentryAuthException $e)
				{
					Session::set_flash('error', $e->getMessage());
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}
		
		$this->template->title = 'Login';
		$this->template->content = View::forge('user/login', $data);
	}

	/**
	* Logout Action
	*
	* @access public
	* @return Response
	*/
	public function action_logout()
	{
		Sentry::logout();
		Response::redirect('user/login');
	}
}