<?php
class feature extends CI_Model {


	function getAll_feature($arrayList=NULL){
		
	     if(!(is_null($arrayList)))
	     	$this->db->where_in('feature_id',$arrayList);

	    $query=$this->db->get('feature');
		if($query->num_rows()>0)
		foreach($query->result() as $row){
		$data[]=$row;
		}
	return $data;
	}


	function insert_feature($arrayList){
		foreach($arrayList as $array){
			$this->db->insert('feature',$array);
	}
		
	}

	function delete_feature($arraylist){

	}

}