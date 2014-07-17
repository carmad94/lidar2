<?php

class Shared_Model extends CI_Model {
	
	public function getRowCount($table)
	{
		$query = $this->db->from($table)
						->get();
		return $query->num_rows();	
	}
	
}