<?php

if (!defined('BASEPATH')) die();

class Place extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		$info['active'] = 'Places';
		$info['topics'] = $this->getSubTopics();
		$this->load->view('include/header', $info);
		$this->load->view('include/navbar');
		$this->load->view('include/sidebar');
		$this->load->view('main_place');
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
		$tables[] = array('table'=>'province', 'name'=>'Province', 'ion'=>'map');
		$tables[] = array('table'=>'municipality', 'name'=>'Municipality', 'ion'=>'map');
		$tables[] = array('table'=>'barangay', 'name'=>'Barangay', 'ion'=>'map');
		$tables[] = array('table'=>'place_history', 'name'=>'Place History', 'ion'=>'clock');
		return $tables;
	}
	
	protected function displayOutput($output)
	{
		$active['active'] = 'Places';
		$this->load->view('include/header');
		$this->load->view('include/navbar');
		$this->load->view('include/sidebar', $active);
		$this->load->view('table', $output);
		$this->load->view('include/footer');
	}
	
	public function province()
	{
		$crud = new Grocery_CRUD();
		//$crud->set_theme('twitter-bootstrap');
		$crud->set_table('province')
			->set_subject('Provinces')
			->unset_columns('province_id')
			->edit_fields('province_name')
			->add_fields('province_name');
		$output = $crud->render();
		$this->displayOutput($output);
	}
	
	public function municipality()
	{
		$crud = new Grocery_CRUD();
		//$crud->set_theme('twitter-bootstrap');
		$crud->set_table('municipality')
			->set_subject('Municipalities')
			->unset_columns('municipal_id')
			->edit_fields('municipal_name')
			->add_fields('municipal_name');
		$output = $crud->render();
		$this->displayOutput($output);
	}
	
	public function barangay()
	{
		$crud = new Grocery_CRUD();
		//$crud->set_theme('twitter-bootstrap');
		$crud->set_table('barangay')
			->set_subject('Barangays')
			->unset_columns('barangay_id')
			->edit_fields('barangay_name')
			->add_fields('barangay_name');
		$output = $crud->render();
		$this->displayOutput($output);
	}
}