<?php if (!defined('BASEPATH')) die();
class Frontpage extends Main_Controller {

   public function index()
   {
		$active['active'] = 'Dashboard';
		$info['topics'] = $this->getTopics();
		$this->load->view('include/header', $info);
		$this->load->view('include/navbar');
		$this->load->view('include/sidebar', $active);
		$this->load->view('frontpage');
		$this->load->view('include/footer');
	}  
	
	protected function getTopics()
	{
		$topics = array();
		$topics[] = array('name'=>'Places in Region XI', 'ion'=>'map', 'color'=>'yellow', 'uri'=>'place');
		$topics[] = array('name'=>'Terrestrial Resources', 'ion'=>'leaf', 'color'=>'green', 'uri'=>'terrestrial');
		$topics[] = array('name'=>'Aquatic Resources', 'ion'=>'waterdrop', 'color'=>'aqua', 'uri'=>'aquatic');
		$topics[] = array('name'=>'Agricultural Inventory', 'ion'=>'record', 'color'=>'orange', 'uri'=>'agriinventory');
		return $topics;
	}
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
