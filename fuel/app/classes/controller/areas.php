<?php

/**
* CRM - Customer Relationship Management
* @author 		@carlosro_ec
* @license 		MIT License
* @copyright 	2012 Kooper
* @link 		http://www.kooper.ec
*/

class Controller_Areas extends Controller_User
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

	public function action_list()
	{
		$total_areas = DB::count_records('areas');

		$config = array(
			'pagination_url' => Uri::create('areas/list'),
			'total_items' => $total_areas,
			'per_page' => 10,
			'uri_segment' => 3,
			'template' => array(
				'wrapper_start' => '<div class="pagination"> ',
				'wrapper_end' => ' </div>',
			),
		);

		Pagination::set_config($config);

		$areas = DB::select()
			->from('areas')
			->limit(Pagination::$per_page)
			->offset(Pagination::$offset)
			->execute();

		$areas_result = array();

		foreach ($areas as $area)
		{
			$id = $area['id'];
			$name = $area['name'];

			$areas_result[] = array('id' => $id, 'name' => $name);
		}

		$data['pagination'] = Pagination::create_links();
		$data['areas'] = $areas_result;

		$this->template->title = "AREAS";
		$this->template->subtitle = "Manage all your areas";
		$this->template->content = View::forge('administrator/areas/list', $data, false);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Area::validate('create');

			if ($val->run())
			{
				$area = Model_Area::forge(array(
					'name' => Input::post('name'),
				));

				if ($area and $area->save())
				{
					Session::set_flash('success', 'Added Area #' . $area->id . '.');

					Response::redirect('areas/list');
				}

				else
				{
					Session::set_flash('error', 'Could not save Area.');
				}
			}

			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		$view = View::forge('administrator/areas/create');

		$this->template->title = "AREAS";
		$this->template->subtitle = "Manage all your area";
		$this->template->content = $view;
	}

	public function action_view($id = null)
	{
		$id = Security::xss_clean($id);

		$areas = DB::select()
			->from('areas')
			->where('areas.id', '=', $id)
			->execute();

		$area = $areas->current();
		$areas_result = array();

		if ($area)
		{
			$id = $area['id'];
			$name = $area['name'];
			
			$areas_result = array('id' => $id, 'name' => $name);
		}

		else
		{
			throw new HttpNotFoundException;	
		}

		$data['area'] = $areas_result;

		$this->template->title = "AREAS";
		$this->template->subtitle = "Manage all your areas";
		$this->template->content = View::forge('administrator/areas/view', $data, false);
	}

	public function action_edit($id = null)
	{
		$area = Model_Area::find($id);
		$val = Model_Area::validate('edit');

		if ($val->run())
		{
			$area->name = Input::post('name');
			
			if ($area->save())
			{
				Session::set_flash('success', 'Updated Area #' . $id);

				Response::redirect('areas/list');
			}

			else
			{
				Session::set_flash('error', 'Could not update Area #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$area->name = $val->validated('name');

				Session::set_flash('error', $val->show_errors());
			}

			$this->template->set_global('area', $area, false);
		}

		$view = View::forge('administrator/areas/edit');
		
		$this->template->title = "AREAS";
		$this->template->subtitle = "Manage all your areas";
		$this->template->content = $view;
	}

	public function action_delete($id = null)
	{
		if ($area = Model_Area::find($id))
		{
			$area->delete();

			Session::set_flash('success', 'Deleted Area #' . $id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete Area #' . $id);
		}

		Response::redirect('areas/list');
	}
}