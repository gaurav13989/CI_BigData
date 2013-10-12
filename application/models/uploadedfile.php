<?php
/**
	This class acts as the Model class for uploadedfile table.
	It handles all CRUD operations on the uploadedfile relation.
*/
class uploadedfile extends CI_Model{

	// This method inserts an array of rows in the uploadedfile table
	function insert_uploadedfile($arrayList) {
		foreach($arrayList as $array){
			$this->db->insert('uploadedfile',$array);
		}
	}

	// This method retrieves all records from the uploadedfile table
	function getAll_uploadedfile(){

		$query=$this->db->get('uploadedfile');
		$data = array();
		if($query->num_rows()>0)
			foreach($query->result() as $row){
				$data[]=$row;
			}
		return $data;
	}

	// This method is used to delete the entry for city = $initials in uploadedfile table as well
	// as the other two tables namely, restaurant_feature_list and restaurant
	function delete_uploadedfile($initials){

		$this->db->where('city',$initials);
		$this->db->delete('uploadedfile');

		$this->db->where('city',$initials);
		$this->db->delete('restaurant_feature_list');

		$this->db->where('city',$initials);
		$this->db->delete('restaurant');
	}

	// This method gets the name of the file that was uploaded having city = $initials
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
