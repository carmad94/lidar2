<?php
if (!defined('BASEPATH')) die();

class Aquatic extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		$info['active'] = 'Aquatic';
		$info['topics'] = $this->getSubTopics();
		$this->load->view('include/header', $info);
		$this->load->view('include/navbar');
		$this->load->view('include/sidebar');
		$this->load->view('main_aquatic');
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
		$tables[] = array('table'=>'aquatic_rsc', 'name'=>'Aquatic Resources', 'ion'=>'waterdrop');
		$tables[] = array('table'=>'aquarsc_history', 'name'=>'Aquatic History', 'ion'=>'clock');
		return $tables;
	}
	
	protected function displayOutput($output)
	{
		$active['active'] = 'Aquatic';
		$this->load->view('include/header');
		$this->load->view('include/navbar');
		$this->load->view('include/sidebar', $active);
		$this->load->view('table', $output);
		$this->load->view('include/footer');
	}
	
	public function aquaticresources()
	{
		$crud = new Grocery_CRUD();
		//$crud->set_theme('twitter-bootstrap');
		$crud->set_table('aquatic_rsc')
			->set_subject('Aquatic Resources')
			->unset_columns('aqua_id')
			->edit_fields('aqua_species', 'aqua_type')
			->add_fields('aqua_species', 'aqua_type');
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