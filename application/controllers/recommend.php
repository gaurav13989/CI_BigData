<?php
class recommend extends CI_Controller{
	public function index(){
		$this->load->helper("url");
		$this->load->model("uploadedfile");
		$city['row']=$this->uploadedfile->getAllCities();
		$this->load->view("all_restaurants",$city);
	}
}
?>