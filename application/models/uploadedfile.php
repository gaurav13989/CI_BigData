<?php
class uploadedfile extends CI_Model{
	function getAll_uploadedfile(){

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
