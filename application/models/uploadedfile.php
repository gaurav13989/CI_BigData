<?php
class uploadedfile extends CI_Model{
	function getAll_uploadedfile(){

	    $query=$this->db->get('uploadedfile');
		$data = array();
		if($query->num_rows()>0)
			foreach($query->result() as $row){
				$data[]=$row;
			}
		return $data;
	}

	function delete_uploadedfile($array){

		$this->db->where('city',$array);
		$this->db->delete('uploadedfile');

		$this->db->where('city',$array);
		$this->db->delete('restaurant_feature_list');

		$this->db->where('city',$array);
		$this->db->delete('restaurant');
	}
}
