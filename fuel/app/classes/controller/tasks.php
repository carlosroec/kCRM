<?php

/**
* CRM - Customer Relationship Management
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Tasks extends Controller_User
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

	public function action_create($job_id = null)
	{
		$job_id = Security::xss_clean($job_id);

		if (Input::method() == 'POST')
		{
			$val = Model_Task::validate('create');

			if ($val->run())
			{
				$task = Model_Task::forge(array(
					'name' => Input::post('name'),
					'amount' => Input::post('amount'),
					'staff_id' => Input::post('staff_id'),
					'job_id' => Input::post('job_id'),
				));

				if ($task and $task->save())
				{
					Session::set_flash('success', 'Added Task #' . $task->id . '.');

					Response::redirect('jobs/view/' . Input::post('job_id'));
				}
				else
				{
					Session::set_flash('error', 'Could not save Task.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
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

		$view = View::forge('staff/tasks/create');
		$view->set_global('job_id', $job_id);
		$view->set_global('staff_names', $staff_names);

		$this->template->title = "TASKS";
		$this->template->subtitle = "Manage all your tasks";
		$this->template->content = $view;
	}

	public function action_edit($job_id = null)
	{
		$job_id = Security::xss_clean($job_id);

		$task = Model_Task::find($job_id);
		$val = Model_Task::validate('edit');

		if ($val->run())
		{
			$task->name = Input::post('name');
			$task->amount = Input::post('amount');
			$task->staff_id  = Input::post('staff_id');
			$task->job_id = Input::post('job_id');
			
			if ($task->save())
			{
				Session::set_flash('success', 'Updated Task #' . $id);

				Response::redirect('jobs/view/' . Input::post('job_id'));
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
				$task->name = $val->validated('name');
				$task->amount = $val->validated('amount');
				$task->staff_id  = $val->validated('staff_id');
				$task->job_id = $val->validated('job_id');
				
				Session::set_flash('error', $val->show_errors());
			}

			$this->template->set_global('task', $task, false);
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

		$view = View::forge('staff/tasks/edit');
		$view->set_global('job_id', $job_id);
		$view->set_global('staff_names', $staff_names);

		$this->template->title = "TASKS";
		$this->template->subtitle = "Manage all your tasks";
		$this->template->content = $view;
	}

	public function action_delete($id = null)
	{
		$id = Security::xss_clean($id);
		$job_id = '';

		if ($task = Model_Task::find($id))
		{
			$job_id = $task->job_id;
			$task->delete();

			Session::set_flash('success', 'Deleted Task #' . $id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete Task #' . $id);
		}

		Response::redirect('jobs/view/' . $job_id);
	}
}