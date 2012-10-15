<?php

/**
* CRM - Customer Relationship Management
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Jobs extends Controller_User
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
		$jobs = '';
		$total_jobs = '';
		$user_id = Sentry::user()->get('id');

		if (Sentry::user()->is_admin())
		{
			$jobs = DB::select()
				->from('jobs')
				->execute();
			$total_jobs = count($jobs);
		}

		else
		{
			$jobs = DB::select()
				->from('jobs')
				->where('staff_id', $user_id)
				->execute();
			$total_jobs = count($jobs);
		}

		$config = array(
			'pagination_url' => Uri::create('jobs/list'),
			'total_items' => $total_jobs,
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
			$jobs = DB::select('jobs.id', 'jobs.title', array('areas.name', 'type'), 'customers.name', 'users_metadata.first_name', 'users_metadata.last_name', 'jobs.status')
				->from('jobs')
				->join('users_metadata', 'LEFT')->on('jobs.staff_id', '=', 'users_metadata.user_id')
				->join('customers', 'LEFT')->on('jobs.customer_id', '=', 'customers.id')
				->join('areas', 'LEFT')->on('areas.id', '=', 'jobs.type')
				->limit(Pagination::$per_page)
				->offset(Pagination::$offset)
				->execute();
		}

		else
		{
			$jobs = DB::select('jobs.id', 'jobs.title', array('areas.name', 'type'), 'customers.name', 'users_metadata.first_name', 'users_metadata.last_name', 'jobs.status')
				->from('jobs')
				->join('users_metadata', 'LEFT')->on('jobs.staff_id', '=', 'users_metadata.user_id')
				->join('customers', 'LEFT')->on('jobs.customer_id', '=', 'customers.id')
				->join('areas', 'LEFT')->on('areas.id', '=', 'jobs.type')
				->where('staff_id', $user_id)
				->limit(Pagination::$per_page)
				->offset(Pagination::$offset)
				->execute();
		}

		$jobs_result = array();

		foreach ($jobs as $job)
		{
			$id = $job['id'];
			$title = $job['title'];

			$type = '<strong class="hg-blue"> ' . $job['type'] . ' </strong>';
			$customer = $job['name'];
			$staff = $job['first_name'] . ' ' . $job['last_name'];
			$status = '';
			switch ($job['status'])
			{
				case 0:
					$status = '<strong class="hg-gray"> PENDING </strong>';
					break;
				case 1:
					$status = '<strong class="hg-green"> ACTIVE </strong>';
					break;
				case 2:
					$status = '<strong class="hg-red"> PAUSED </strong>';
					break;
				case 3:
					$status = '<strong class="hg-purple"> COMPLETED </strong>';
					break;
				case 4:
					$status = '<strong class="hg-gray"> CANCELED </strong>';
					break;
			}
			$jobs_result[] = array('id' => $id, 'title' => $title, 'type' => $type, 'customer' => $customer, 'staff' => $staff, 'status' => $status);
		}

		$data['pagination'] = Pagination::create_links();
		$data['jobs'] = $jobs_result;

		$this->template->title = "JOBS";
		$this->template->subtitle = "Manage all your jobs";
		$this->template->content = View::forge('staff/jobs/list', $data, false);
	}

	public function action_view($id = null)
	{
		$areas = DB::select()
			->from('areas')
			->execute();

		$jobs = DB::select('jobs.id', 'jobs.title', array('areas.name', 'type'), 'jobs.start_date', 'jobs.due_date', 'jobs.finished_date', 'jobs.cost', 'jobs.tax', 'customers.name', array('staff.first_name', 'staff_first_name'), array('staff.last_name', 'staff_last_name'), array('staff_creator.first_name', 'staff_creator_first_name'), array('staff_creator.last_name', 'staff_creator_last_name'), 'jobs.status')
				->from('jobs')
				->join(array('users_metadata', 'staff'), 'LEFT')->on('jobs.staff_id', '=', 'staff.user_id')
				->join(array('users_metadata', 'staff_creator'), 'LEFT')->on('jobs.created_by', '=', 'staff_creator.user_id')
				->join('customers', 'LEFT')->on('jobs.customer_id', '=', 'customers.id')
				->join('areas', 'LEFT')->on('areas.id', '=', 'jobs.type')
				->where('jobs.id', '=', $id)
				->execute();

		$job = $jobs->current();
		$jobs_result = array();
		$job_id = '';
		
		if ($job)
		{
			$job_id = $job['id'];
			$title = $job['title'];
			$area_name = explode(' ', $job['type']);
			$type = '<strong class="hg-gray">' . $area_name[0] . '</strong>';
			$start_date = $job['start_date'];
			$due_date = $job['due_date'];
			$finished_date = $job['finished_date'];
			$cost = $job['cost'];
			$tax = $job['tax'];
			$status = '';
			switch ($job['status'])
			{
				case 0:
					$status = '<strong class="hg-gray"> PENDING </strong>';
					break;
				case 1:
					$status = '<strong class="hg-green"> ACTIVE </strong>';
					break;
				case 2:
					$status = '<strong class="hg-red"> PAUSED </strong>';
					break;
				case 3:
					$status = '<strong class="hg-purple"> COMPLETED </strong>';
					break;
				case 4:
					$status = '<strong class="hg-gray"> CANCELED </strong>';
					break;
			}
			$customer = $job['name'];
			$staff = $job['staff_first_name'] . ' ' . $job['staff_last_name'];
			$creator = $job['staff_creator_first_name'] . ' ' . $job['staff_creator_last_name'];

			//Get Tasks
			$tasks = DB::select()
				->from('tasks')
				->join('users_metadata', 'LEFT')->on('users_metadata.user_id', '=', 'tasks.staff_id')
				->where('tasks.job_id', '=', $job_id)
				->execute();

			$tasks_resulst = array();
			foreach ($tasks as $task) {
				$task_id = $task['id'];
				$task_name = $task['name'];
				$task_amount = $task['amount'];
				$task_staff = $task['first_name'] . ' ' . $task['last_name'];

				$tasks_resulst[] = array('id' => $task_id, 'name' => $task_name, 'amount' => $task_amount, 'staff' => $task_staff);
			}

			$jobs_result = array('id' => $job_id, 'title' => $title, 'type' => $type, 'start_date' => $start_date, 'due_date' => $due_date, 'finished_date' => $finished_date, 'cost' => $cost, 'tax' => $tax, 'status' => $status, 'customer' => $customer, 'creator'=> $creator, 'staff' => $staff, 'tasks' => $tasks_resulst);
		}

		else
		{
			throw new Exception("Error Processing Request", 1);
		}

		$data['job'] = $jobs_result;
		$data['job_id'] = $job_id;
		$this->template->title = "JOBS";
		$this->template->subtitle = "Manage all your jobs";
		$this->template->content = View::forge('staff/jobs/view', $data, false);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Job::validate('create');

			if ($val->run())
			{
				$job = Model_Job::forge(array(
					'title' => Input::post('title'),
					'type' => Input::post('type'),
					'start_date' => Input::post('start_date'),
					'due_date' => Input::post('due_date'),
					'finished_date' => Input::post('finished_date'),
					'cost' => Input::post('cost'),
					'tax' => Input::post('tax'),
					'customer_id' => Input::post('customer_id'),
					'staff_id' => Input::post('staff_id'),
					'status' => Input::post('status'),
					'created_by' => Input::post('created_by'),
				));

				if ($job and $job->save())
				{
					Session::set_flash('success', 'Added Job #' . $job->id.'.');

					Response::redirect('jobs/list/');
				}

				else
				{
					Session::set_flash('error', 'Could not save Job.');
				}
			}

			else
			{
				Session::set_flash('error', $val->show_errors());
			}

		}

		//Set Job Type
		$areas_names = array();

		$areas = DB::select()
			->from('areas')
			->order_by('areas.name','asc')
			->execute();

		foreach ($areas as $area) {
			$id = $area['id'];
			$name = $area['name'];

			$areas_names[$id] = $name;
		}

		//Set Job Status
		$status = array('PENDING', 'ACTIVE', 'PAUSED', 'COMPLETED', 'CANCELED');

		//Set Customers Name
		$customers_names = array();

		$customers = DB::select()
			->from('customers')
			->execute();
		foreach($customers as $customer){
			$id = $customer['id'];
			$name = $customer['name'];

			$customers_names[$id] = $name;
		}

		//Set Staff Full Name
		$staff_names = array();

		$staffs = Sentry::group('staff')->users();

		foreach ($staffs as $staff) {
			$user = Sentry::user($staff['email']);

			$id = $user->get('id');
			$user_full_name = $user->get('metadata.first_name') . ' ' . $user->get('metadata.last_name');

			$staff_names[$id] = $user_full_name;
		}

		//Current User
		$user_id = Sentry::user()->get('id');

		$view = View::forge('staff/jobs/create');
		$view->set_global('areas_names', $areas_names);
		$view->set_global('status', $status);
		$view->set_global('customers_names', $customers_names);
		$view->set_global('staff', $staff_names);
		$view->set_global('user_id', $user_id);

		$this->template->title = "JOBS";
		$this->template->subtitle = "Manage all your jobs";
		$this->template->content = $view;
	}

	public function action_edit($id = null)
	{
		$job = Model_Job::find($id);
		$val = Model_Job::validate('edit');

		if ($val->run())
		{
			$job->title = Input::post('title');
			$job->type = Input::post('type');
			$job->start_date = Input::post('start_date');
			$job->due_date = Input::post('due_date');
			$job->finished_date = Input::post('finished_date');
			$job->cost =Input::post('cost');
			$job->tax =Input::post('tax');
			$job->customer_id = Input::post('customer_id');
			$job->staff_id = Input::post('staff_id');
			$job->status = Input::post('status');

			if ($job->save())
			{
				Session::set_flash('success', 'Updated Job #' . $id);

				Response::redirect('jobs/list');
			}

			else
			{
				Session::set_flash('error', 'Could not update Job #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$job->title = $val->validated('title');
				$job->type = $val->validated('type');
				$job->start_date = $val->validated('start_date');
				$job->due_date = $val->validated('due_date');
				$job->finished_date = $val->validated('finished_date');
				$job->cost =$val->validated('cost');
				$job->tax =$val->validated('tax');
				$job->customer_id = $val->validated('customer_id');
				$job->staff_id = $val->validated('staff_id');
				$job->status = $val->validated('status');

				Session::set_flash('error', $val->show_errors());
			}

			$this->template->set_global('job', $job, false);
		}

		//Set Job Type
		$areas_names = array();

		$areas = DB::select()
			->from('areas')
			->order_by('areas.name','asc')
			->execute();

		foreach ($areas as $area) {
			$id = $area['id'];
			$name = $area['name'];

			$areas_names[$id] = $name;
		}


		//Set Job Status
		$status = array('PENDING', 'ACTIVE', 'PAUSED', 'COMPLETED', 'CANCELED');

		//Set Customers Name
		$customers_names = array();

		$customers = DB::select()
			->from('customers')
			->execute();
		foreach($customers as $customer){
			$id = $customer['id'];
			$name = $customer['name'];

			$customers_names[$id] = $name;
		}

		//Set Staff Full Name
		$staff_names = array();

		$staffs = Sentry::group('staff')->users();

		foreach ($staffs as $staff) {
			$user = Sentry::user($staff['email']);

			$id = $user->get('id');
			$user_full_name = $user->get('metadata.first_name') . ' ' . $user->get('metadata.last_name');

			$staff_names[$id] = $user_full_name;
		}

		$view = View::forge('staff/jobs/edit');
		$view->set_global('areas_names', $areas_names);
		$view->set_global('status', $status);
		$view->set_global('customers_names', $customers_names);
		$view->set_global('staff', $staff_names);

		$this->template->title = "JOBS";
		$this->template->subtitle = "Manage all your jobs";
		$this->template->content = $view;
	}

	public function action_delete($id = null)
	{
		if ($job = Model_Job::find($id))
		{
			$job->delete();
			Session::set_flash('success', 'Deleted Job #' . $id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete Job #' . $id);
		}

		Response::redirect('jobs/list');
	}
}