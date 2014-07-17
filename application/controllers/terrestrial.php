<?php
if (!defined('BASEPATH')) die();

class Terrestrial extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		$info['active'] = 'Terrestrial';
		$info['topics'] = $this->getSubTopics();
		$this->load->view('include/header', $info);
		$this->load->view('include/navbar');
		$this->load->view('include/sidebar');
		$this->load->view('main_terrestrial');
		$this->load->view('include/footer');
	}
	
	protected function getSubTopics()
	{
		$topics = array();
		$tables = $this->getTables();
		foreach ($tables as $table)
		{
			$this->load->model('shared_model');
			$count = $this->shared_model->getRowCount($table['table']);
			$table['count'] = $count;
			$topics[] = $table;
		}
		return $topics;	
	}
	
	protected function getTables()
	{
		$tables = array();
		$tables[] = array('table'=>'crops', 'name'=>'Crops', 'ion'=>'leaf');
		$tables[] = array('table'=>'crop_history', 'name'=>'Crop History', 'ion'=>'clock');
		return $tables;
	}
	
	protected function displayOutput($output)
	{
		$active['active'] = 'Terrestrial';
		$this->load->view('include/header');
		$this->load->view('include/navbar');
		$this->load->view('include/sidebar', $active);
		$this->load->view('table', $output);
		$this->load->view('include/footer');
	}
	
	public function crops()
	{
		$crud = new Grocery_CRUD();
		//$crud->set_theme('twitter-bootstrap');
		$crud->set_table('crops')
			->set_subject('Crops')
			->unset_columns('crop_id')
			->edit_fields('crop_species', 'crop_type')
			->add_fields('crop_species', 'crop_type');
		$output = $crud->render();
		$this->displayOutput($output);
	}
	
	public function crophistory()
	{
		$crud = new Grocery_CRUD();
		//$crud->set_theme('twitter-bootstrap');
		$crud->set_table('crop_history')
			->set_model('crud_model');
		$output = $crud->render();
		$this->displayOutput($output);
	}
	
}