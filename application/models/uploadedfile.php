<?php
class uploadedfile extends CI_Model{
	function getAll_uploadedfile(){

	}
	public function index()
	{
		// $this->load->model('restaurant_feature_list');
		// $data=$this->restaurant_feature_list->getAll_restaurant_feature_list($array=array(array('city'=>'de','restaurant_id'=>'10006')));
		// foreach ($data as $r) {
		// echo $r->city;
		// echo $r->restaurant_id;
		$this->load->model('uploadedfile');
		$this->uploadedfile->delete_uploadedfile('de');
			# code...
		//$this->home();
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
?>