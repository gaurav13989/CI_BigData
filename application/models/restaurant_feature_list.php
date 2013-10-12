<?php
/**
	This class acts as the Model class for restaurant_feature_list table.
	It handles all CRUD operations on the restaurant_feature_list relation.
*/

class restaurant_feature_list extends CI_Model{

	// This method retrieves all records of restaurant_feature_list table of no parameter is passed
	// Else if returns only those which match the criteria
	// 		i.e. all records with the passed restaurant_id and 
	function getAll_restaurant_feature_list($arrayList=NULL) {
	
		if(!(is_null($arrayList))){
			foreach($arrayList as $array){
				$this->db->where('restaurant_id',$array['restaurant_id']);
				$this->db->where('city',$array['city']);
			}
		}
		$query=$this->db->get('restaurant_feature_list');
		if($query->num_rows()>0)
			foreach($query->result() as $row){
				$data[]=$row;
		}
		return $data;
	}

	// This method inserts as array of rows in the restaurant_feature_list tables
	function insert_restaurant_feature_list($arrayList) {
		foreach($arrayList as $array){
			$this->db->insert('restaurant_feature_list',$array);
		}
	}
}