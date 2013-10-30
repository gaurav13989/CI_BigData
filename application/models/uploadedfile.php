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

	// use key cityName for name of the city - Eg. New_York
	// and key city for city code - Eg. ny
	function getCities()
	{
		$this->db->where('cityName !=', 'Feature');
		$this->db->where('cityName !=', 'feature');
		$query = $this->db->get('uploadedFile');
		if($query->num_rows()>0)
			foreach($query->result() as $row){
				$data[]=$row;
			}
		return $data;
	}
	function getAllCities(){
		//$this->db->select('cityName','city');
		$query=$this->db->get('uploadedfile');

		if($query->num_rows()>0)
			foreach ($query->result() as $row) {
				$data[]=$row;
			}
			return $data;
	}

	// returns city name for a value of city initials
	function getCityName($city) {
		$this->db->where('city',$city);
		$query = $this->db->get('uploadedFile');
		$cityName = '';
		foreach ($query->result() as $row) {
			$cityName = $row->cityName;
		}
		return $cityName;
	}
}
