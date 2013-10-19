<?php
/**
	This class acts as the Model class for feature table.
	It handles all CRUD operations on the feature relation.
*/
class feature extends CI_Model {
	// This method returns all rows of feature table unless an array of feature_id s is passed
	// use keys 
	// 		feature_id and feature_name
	function getAll_feature($arrayList=NULL) {
		
		if(!(is_null($arrayList)))
			$this->db->where_in('feature_id',$arrayList);
		
		$query=$this->db->get('feature');
		if($query->num_rows()>0)
			foreach($query->result() as $row) {
				$data[]=$row;
			}
		return $data;
	}

	function getFeatureName($feature_id)
	{
		$feature_name = "";
		$this->db->where('feature_id',$feature_id);
		$query=$this->db->get('feature');
		if($query->num_rows()>0)
			foreach($query->result() as $row) {
				$feature_name = $row->feature_name;
			}
		return $feature_name;
	}

	// This method is used for inserting an array of rows into the feature table
	function insert_feature($arrayList) {
		foreach($arrayList as $array){
			$this->db->insert('feature',$array);
		}
	}

	// This method deletes the passed features from both the restaurant_feature_list table
	// and the feature table
	function delete_feature($arraylist) {
		$this->db->where_in('feature_id');
		$this->db->delete('restaurant_feature_list');
		
		$this->db->where_in('feature_id',$arraylist);
		$this->db->delete('feature');
	}
}