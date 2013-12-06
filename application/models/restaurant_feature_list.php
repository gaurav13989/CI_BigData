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

	//
	// $arr may consist of params
	// city(initials), restaurant_name (optional), NOT YET>>feature_ids array of feature_id(optional)
	// This method returns a list of restaurants
	// restaurant id - restaurant name - restaurant feature id list with description
	// [1199, Mickey Mantle's, [(feature id, feature name), (feature id, feature name), (feature id, feature name)]]
	//
	function getRestaurants($arr)
	{
		$restaurant_list['restaurant_id'] = null;
		$restaurant_list['restaurant_name'] = null;
		$this->load->model('feature');
		$this->load->model('uploadedFile');
		// get restaurants from city
		$restaurant_list['city'] = $arr['city'];
		$restaurant_list['cityName'] = $this->uploadedFile->getCityName($arr['city']);

		if(isset($arr['restaurant_name']))
		{
			$this->db->like('restaurant_name', '%'.$restaurant_name.'%');
		}
		$this->db->where('city', $arr['city']);
		$this->db->order_by('restaurant_name','asc');
		$query1 = $this->db->get('restaurant');
		
		$restIds[] = null;
		foreach ($query1->result() as $row1) {

			if (isset($arr['features'])) {
				if ($this->_checkIfFeaturesMatch($arr['city'], $row1->restaurant_id, $arr['features'])) {
					$restaurant_list['restaurant_id'][] = $row1->restaurant_id;
					$restaurant_list['restaurant_name'][] = $row1->restaurant_name;
				}
			}
			else {
				$restaurant_list['restaurant_id'][] = $row1->restaurant_id;
				$restaurant_list['restaurant_name'][] = $row1->restaurant_name;
			}
			
		}
		return $restaurant_list;
	}
	public function features($city = NULL, $restId = NULL) {
		$this->db->where('restaurant_id', $restId);
		$this->db->where('city', $city);
		$query = $this->db->get('restaurant_feature_list');
		return $query;
	}


	// This method is used to find cheaper restaurants
	function getCheaperRestaurants($city,$feature_id){
		
		$this->db->select('restaurant.restaurant_id');
		$this->db->select('restaurant.restaurant_name');
		$this->db->from('restaurant_feature_list');
		$this->db->join('restaurant','restaurant_feature_list.restaurant_id=restaurant.restaurant_id 
			AND restaurant_feature_list.city=restaurant.city');
		$this->db->where('restaurant.city', $city);
		$this->db->where('feature_id','161');
		if($feature_id=='167'){
			$this->db->or_where('feature_id','164');
		}
		if($feature_id=='169'){
			$this->db->or_where('feature_id','164');
			$this->db->or_where('feature_id','167');
		}
		$this->db->distinct();
		$query=$this->db->get();
	

		if($query->num_rows()>0)
			foreach($query->result() as $row){

				$data[]=$row;
		}
		return $data;
	}

	public function _checkIfFeaturesMatch($city, $restId, $features) {
		$this->db->where('city', $city);
		$this->db->where('restaurant_id', $restId);
		$query2 = $this->db->get('restaurant_feature_list');
		foreach ($query2->result() as $row) {
			$featureIds[] = $row->feature_id;
		}
		$min = min(sizeof($featureIds), sizeof($features));
		return $min == sizeof(array_intersect($features, $featureIds));
	}

}
