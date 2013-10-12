<?php
/**
	This class acts as the Model class for uploadedfile table.
	It handles all CRUD operations on the uploadedfile relation.
*/
class uploadedfile extends CI_Model{

	function insert_uploadedfile($arrayList) {
		foreach($arrayList as $array){
			$this->db->insert('uploadedfile',$array);
		}
	}

	function getAll_uploadedfile(){

		$query=$this->db->get('uploadedfile');
		$data = array();
		if($query->num_rows()>0)
			foreach($query->result() as $row){
				$data[]=$row;
			}
		return $data;
	}

	function delete_uploadedfile($initials){

		$this->db->where('city',$initials);
		$this->db->delete('uploadedfile');

		$this->db->where('city',$initials);
		$this->db->delete('restaurant_feature_list');

		$this->db->where('city',$initials);
		$this->db->delete('restaurant');
	}

	function getFileName($initials) {
		$this->db->where('city',$initials);
		$query=$this->db->get('uploadedfile');
		$fileName = "";
		foreach ($query->result() as $row) {
			$fileName = $row->fileName;
		}
		return $fileName;
	}
}
