<?php

class Crud_Model extends grocery_CRUD_Model
{
	public function getList()
	{
		$method = $this->uri->segment(2);
		$control =$this->uri->segment(1);
		switch ($method)
		{
			case 'crophistory'	:	$query=$this->db->query('SELECT * FROM crop_history 
									JOIN crops ON crop_history.crop_id = crops.crop_id
									JOIN province ON province.province_id = crop_history.place_id');
									return $query->result();
			default				:	break;
		}
	}
}