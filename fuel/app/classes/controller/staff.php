<?php

/**
* CMS - Customer Relationship Management
* @version 		1.0
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Staff extends Controller_User
{
	public $template = 'template';
	
	public function before()
	{
		parent::before();

		if ( ! Sentry::user()->in_group('staff') and ! Sentry::user()->in_group('administrator') )
		{
			Response::redirect('user/login');
		}
	}

	public function action_dashboard()
	{
		$data = array();

		$this->template->title = 'Listing Courses';
		$this->template->subtitle = 'Listing Courses';
		$this->template->content = View::forge('staff/dashboard', $data);
	}

	public function action_profile()
	{
		$data = array();

		if (Input::method() == 'POST')
		{
			$val = Validation::forge('profile');
			$val->add_field('first_name', 'First Name', 'required|max_length[50]');
			$val->add_field('last_name', 'Last Name', 'required|max_length[50]');

			if ($val->run())
			{
				try
				{
					$first_name = Input::post('first_name');
					$last_name = Input::post('last_name');

					$user = Sentry::user();

					$update = $user->update(array(
						'metadata' => array(
							'first_name' => $first_name,
							'last_name' => $last_name
						)
					));

					if ($update)
					{
						Session::set_flash('success', 'Profile Updated');
					}

					else
					{
						Session::set_flash('error', 'Could not save Profile.');
					}
				}
				catch(SentryUserException $e)
				{
					Session::set_flash('error', $e->getMessage());
				}
			}

			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		$this->template->set_global('user', Sentry::user(), false);
		$this->template->title = 'PROFILE';
		$this->template->subtitle = "Manage your profile";
		$this->template->content = View::forge('staff/profile', $data, false);
	}

	public function action_change_password()
	{
		$data = array();

		if (Input::method() == 'POST')
		{
			$val = Validation::forge('registration');
			$val->add_field('password', 'Password', 'required');
			$val->add_field('confirm', 'Confirm', 'required|match_field[password]');

			if ($val->run())
			{
				try
				{
					$password = Input::post('password');

					$user = Sentry::user();

					$update = $user->update(array(
						'password' => $password
					));

					if ($update)
					{
						Session::set_flash('success', 'Password Updated');
					}

					else
					{
						Session::set_flash('error', 'Could not save Password.');
					}
				}
				catch(SentryUserException $e)
				{
					Session::set_flash('error', $e->getMessage());
				}
			}

			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		$this->template->title = 'PASSWORD';
		$this->template->subtitle = "Manage your password";
		$this->template->content = View::forge('staff/change_password', $data, false);
	}
}