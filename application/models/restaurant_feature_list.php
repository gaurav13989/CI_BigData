<?php
class restaurant_feature_list extends CI_MOdel{
	function getAll_restaurant_feature_list($arrayList=NULL){
	
     if(!(is_null($arrayList))){
     	foreach($arrayList as $array)
     	$this->db->where('restaurant_id',$array['restaurant_id']);
     	$this->db->where('city',$array['city']);
     }
    $query=$this->db->get('restaurant_feature_list');
	if($query->num_rows()>0)
	foreach($query->result() as $row){
	$data[]=$row;
	}
return $data;
}


function insert_feature($arrayList){
	foreach($arrayList as $array){
		$this->db->insert('restaurant_feature_list',$array);
}
	
}
}