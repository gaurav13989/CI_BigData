<?php
class restaurant extends CI_model{
	function getAll_restaurant($arrayList=NULL){
	
     if(!(is_null($arrayList)))
     	$this->db->where_in('city',$arrayList);

    $query=$this->db->get('restaurant');
	if($query->num_rows()>0)
	foreach($query->result() as $row){
	$data[]=$row;
	}
return $data;
}


function insert_restaurant($arrayList){
	foreach($arrayList as $array){
		$this->db->insert('restaurant',$array);
}
	
}
}
?>