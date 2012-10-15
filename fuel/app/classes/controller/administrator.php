<?php

/**
* CMS - Customer Relationship Management
* @version 		1.0
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Administrator extends Controller_User
{
	public $template = 'template';
	
	public function before()
	{
		parent::before();

		if ( ! Sentry::user()->in_group('administrator') )
		{
			Response::redirect('user/login');
		}
	}

	public function action_dashboard()
	{
		$data = array();

		//Get jobs info
		$jobs = DB::select("jobs.type", "areas.name")
			->from('jobs')
			->join('areas', 'LEFT')->on('areas.id', '=', 'jobs.type')
			->where('jobs.status', '=', 1)
			->order_by('areas.name','asc')
			->execute();

		$current_job_name = '';
		$job_total = array();

		foreach ($jobs as $job) {
			if ($current_job_name != $job['name'])
			{
				$current_job_name = $job['name'];
				$job_total[ '"' . $current_job_name . '"'] = 0;
			}
			$job_total['"' . $current_job_name . '"']++;
		}

		
		$pie_chart_text = '';
		foreach ($job_total as $key => $value) {
			$pie_chart_text .= "[$key, $value],";
		}

		//Get Incomes per Year
		$year = date('Y');
		$start_date = $year . '-00-00';
		$end_date = $year . '-12-31';

		$jobs= DB::select('jobs.cost', 'jobs.start_date', 'jobs.type')
			->from('jobs')
			->where('jobs.start_date', '>=', $start_date)
			->and_where('jobs.start_date', '<=', $end_date)
			->and_where('status', '=', 1)
			->or_where('jobs.status', '=', 2)
			->or_where('jobs.status', '=', 3)
			->execute();

		$total_month1 = 0;
		$total_month2 = 0;
		$total_month3 = 0;
		$total_month4 = 0;
		$total_month5 = 0;
		$total_month6 = 0;
		$total_month7 = 0;
		$total_month8 = 0;
		$total_month9 = 0;
		$total_month10 = 0;
		$total_month11 = 0;
		$total_month12 = 0;

		foreach ($jobs as $job) {
			$temp_job = explode('-', $job['start_date']);

			switch ($temp_job[1])
			{
				case 1:
					$total_month1 += $job['cost'];
					break;
				case 2:
					$total_month2 += $job['cost'];
					break;
				case 3:
					$total_month3 += $job['cost'];
					break;
				case 4:
					$total_month4 += $job['cost'];
					break;
				case 5:
					$total_month5 += $job['cost'];
					break;
				case 6:
					$total_month6 += $job['cost'];
					break;
				case 7:
					$total_month7 += $job['cost'];
					break;
				case 8:
					$total_month8 += $job['cost'];
					break;
				case 9:
					$total_month9 += $job['cost'];
					break;
				case 10:
					$total_month10 += $job['cost'];
					break;
				case 11:
					$total_month11 += $job['cost'];
					break;
				case 12:
					$total_month12 += $job['cost'];
					break;
			}
		}

		$data['year'] = $year;
		$data['total_types'] = $pie_chart_text;		
		$data['total_month1'] = $total_month1;
		$data['total_month2'] = $total_month2;
		$data['total_month3'] = $total_month3;
		$data['total_month4'] = $total_month4;
		$data['total_month5'] = $total_month5;
		$data['total_month6'] = $total_month6;
		$data['total_month7'] = $total_month7;
		$data['total_month8'] = $total_month8;
		$data['total_month9'] = $total_month9;
		$data['total_month10'] = $total_month10;
		$data['total_month11'] = $total_month11;
		$data['total_month12'] = $total_month12;

		$this->template->title = 'DASBOARD';
		$this->template->subtitle = 'Welcome Area';
		$this->template->content = View::forge('administrator/dashboard', $data, false);
	}

	public function action_list_users($page = null)
	{
		$data = array();

		$total_users = DB::count_records('users');
		
		$config = array(
			'pagination_url' => Uri::create('administrator/list_users'),
			'total_items' => $total_users,
			'per_page' => 10,
			'uri_segment' => 3,
			'template' => array(
				'wrapper_start' => '<div class="pagination"> ',
				'wrapper_end' => ' </div>',
			),
		);

		Pagination::set_config($config);

		$users = DB::select('users.id', 'users.email', 'users_metadata.first_name', 'users_metadata.last_name', 'groups.name', 'users.status')
			->from('users')
			->join('users_metadata', 'LEFT')->on('users.id', '=', 'users_metadata.user_id')
			->join('users_groups', 'LEFT')->on('users.id', '=', 'users_groups.user_id')
			->join('groups', 'LEFT')->on('users_groups.group_id', '=', 'groups.id')
			->limit(Pagination::$per_page)
			->offset(Pagination::$offset)
			->execute();

		$users_result = array();

		foreach ($users as $user) {
			$id = $user['id'];
			$email = $user['email'];
			$name = $user['first_name'] . ' ' . $user['last_name'];
			$group = '';
			if ($user['name'] == 'administrator')
			{
				$group = '<strong class="hg-green"> ADMMINISTRATOR </strong>';
			}
			if ($user['name'] == 'staff')
			{
				$group = '<strong class="hg-purple"> STAFF </strong>';
			}
			$status = '';
			switch ($user['status']) {
				case 0:
					$status = '<b>Inactive</b>';
					break;
				case 1:
					$status = '<b>Active</b>';
					break;
			}

			$users_result[] = array('id' => $id, 'email' => $email, 'name' => $name, 'group' => $group, 'status' => $status);
		}

		$data['pagination'] = Pagination::create_links();
		$data['users'] = $users_result;

		$this->template->title = "USERS";
		$this->template->subtitle = "Manage all your users";
		$this->template->content = View::forge('administrator/users/list', $data, false);
	}

	public function action_create_user()
	{
		$data = array();

		if (Input::method() == 'POST')
		{
			$val = Validation::forge('user');
			$val->add_field('email', 'Email', 'required|max_length[50]|valid_email');
			$val->add_field('first_name', 'First Name', 'required|max_length[50]');
			$val->add_field('last_name', 'Last Name', 'required|max_length[50]');
			$val->add_field('password', 'Password', 'required');
			$val->add_field('confirm', 'Confirm', 'required|match_field[password]');

			if ($val->run())
			{
				try
				{
					$email = Input::post('email');
					$first_name = Input::post('first_name');
					$last_name = Input::post('last_name');
					$password = Input::post('password');
					$group = Input::post('group');

					$vars = array(
						'email'    => $email,
						'password' => $password,
						'metadata' => array(
							'first_name' => $first_name,
							'last_name'  => $last_name,
						)
					);

					$user_id = Sentry::user()->create($vars);

					if ($user_id)
					{
						$user = Sentry::user($user_id);
						$user->add_to_group($group);

						Session::set_flash('success', 'Added User #' . $user_id . '.');

						Response::redirect('administrator/list_users');
					}

					else
					{
						Session::set_flash('error', 'Could not save User.');
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

		//Groups
		$groups_names = array();
		try
		{
			$groups = Sentry::group()->all();
			

			foreach ($groups as $group) {
				$id = $group['id']	;
				$name = Str::upper($group['name']);

				$groups_names[$id] = $name;
			}
		}
		catch (SentryGroupException $e)
		{
			$errors = $e->getMessage();
		}

		$view = View::forge('administrator/users/create');
		$view->set_global('groups', $groups_names);

		$this->template->title = "USERS";
		$this->template->subtitle = "Manage all your users";
		$this->template->content = $view;
	}

	public function action_view_user($id = null)
	{
		$data = array();
		$id = intval(Security::xss_clean($id));

		$users = DB::select('users.id', 'users.email', 'users_metadata.first_name', 'users_metadata.last_name', 'groups.name', 'users.status', 'users.created_at')
			->from('users')
			->join('users_metadata', 'LEFT')->on('users.id', '=', 'users_metadata.user_id')
			->join('users_groups', 'LEFT')->on('users.id', '=', 'users_groups.user_id')
			->join('groups', 'LEFT')->on('users_groups.group_id', '=', 'groups.id')
			->where('users.id', '=', $id)
			->execute();

		$user = $users->current();
		$users_result = array();

		if ($user)
		{
			$id = $user['id'];
			$email = $user['email'];
			$name = $user['first_name'] . ' ' . $user['last_name'];
			$group = '';
			if ($user['name'] == 'administrator')
			{
				$group = '<strong class="hg-green"> ADMMINISTRATOR </strong>';
			}
			if ($user['name'] == 'staff')
			{
				$group = '<strong class="hg-purple"> STAFF </strong>';
			}
			$status = '';
			switch ($user['status']) {
				case 0:
					$status = '<b>Inactive</b>';
					break;
				case 1:
					$status = '<b>Active</b>';
					break;
			}
			$since = Date::time_ago($user['created_at']);

			$users_result = array('id' => $id, 'email' => $email, 'name' => $name, 'group' => $group, 'status' => $status, 'since' => $since);
		}

		else
		{
			throw new HttpNotFoundException;
		}

		$data['user'] = $users_result;

		$this->template->title = "USERS";
		$this->template->subtitle = "Manage all your users";
		$this->template->content = View::forge('administrator/users/view', $data, false);
	}

	public function action_edit_user($id = null)
	{
		$id = intval(Security::xss_clean($id));

		// update the user
		$user = Sentry::user($id);
		$current_groups = $user->groups();
		$current_group = $current_groups[0]['id'];

		$val = Validation::forge('user');
		$val->add_field('email', 'Email', 'required|max_length[50]|valid_email');
		$val->add_field('first_name', 'First Name', 'required|max_length[50]');
		$val->add_field('last_name', 'Last Name', 'required|max_length[50]');
		$val->add_field('password', 'Password', '');
		$val->add_field('confirm', 'Confirm', 'match_field[password]');
		$val->add_field('group', 'Group', 'required');

		if ($val->run())
		{
			try
			{
				$email = Input::post('email');
				$first_name = Input::post('first_name');
				$last_name = Input::post('last_name');
				$password = Input::post('password');
				$group = Input::post('group');
				
				$update = '';
				if ($password != '')
				{
					$update = $user->update(array(
						'email' => $email,
						'password' => $password,
						'metadata' => array(
							'first_name' => $first_name,
							'last_name'  => $last_name
						)
					));
				}

				else
				{
					$update = $user->update(array(
						'email' => $email,
						'metadata' => array(
							'first_name' => $first_name,
							'last_name'  => $last_name
						)
					));
				}

				if ($update)
				{
					if ($group != $current_group)
					{
						$user->remove_from_group($current_group);
						$user->add_to_group($group);
					}

					Session::set_flash('success', 'Updated User #' . $id);

					Response::redirect('administrator/list_users');
				}

				else
				{
					Session::set_flash('error', 'Could not update User #' . $id);
			    }
			}
			catch (SentryUserException $e)
			{
				Session::set_flash('error', $e->getMessage());
			}
		}
		
		else
		{
			$email = $user->get('email');
			$first_name = $user->get('metadata.first_name');
			$last_name = $user->get('metadata.last_name');

			if (Input::method() == 'POST')
			{
				$email = $val->validated('email');
				$first_name = $val->validated('first_name');
				$last_name = $val->validated('last_name');
				$current_group = $val->validated('group');

				Session::set_flash('error', $val->show_errors());
			}

			$users_result = array('email' => $email, 'first_name' => $first_name, 'last_name' => $last_name, 'group' => $current_group);

			$this->template->set_global('user', $users_result, false);
		}

		//Groups
		$groups_names = array();
		try
		{
			$groups = Sentry::group()->all();
			
			foreach ($groups as $group) {
				$id = $group['id']	;
				$name = Str::upper($group['name']);

				$groups_names[$id] = $name;
			}
		}
		catch (SentryGroupException $e)
		{
			Session::set_flash('error', $e->getMessage());
		}

		$view = View::forge('administrator/users/edit');
		$view->set_global('groups', $groups_names);

		$this->template->title = "USERS";
		$this->template->subtitle = "Manage all your users";
		$this->template->content = $view;
	} 

	public function action_enable_user($id = null)
	{
		$id = intval(Security::xss_clean($id));

		try
		{
			$enabled = Sentry::user($id)->enable();
			if ($enabled)
			{
		        Session::set_flash('success', 'Enabled User #' . $id);

				Response::redirect('administrator/list_users');
		    }
		    else
		    {
		        Session::set_flash('error', 'Could not enable User #' . $id);
		    }
		}
		catch (SentryUserException $e)
		{
		    Session::set_flash('error', $e->getMessage());
		}
	}

	public function action_disable_user($id = null)
	{
		$id = intval(Security::xss_clean($id));

		try
		{

			$disabled = Sentry::user($id)->disable();
			if ($disabled)
			{
		        Session::set_flash('success', 'Disabled User #' . $id);

				Response::redirect('administrator/list_users');
		    }
		    else
		    {
		        Session::set_flash('error', 'Could not disable User #' . $id);
		    }
		}
		catch (SentryUserException $e)
		{
		    Session::set_flash('error', $e->getMessage());
		}
	}
}