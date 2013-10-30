<?php
class recommend extends CI_Controller{

	public function index(){
		$this->home();
	}

	public function home() {
		$this->load->helper("url");
		$this->load->model("uploadedfile");
		$data['row']=$this->uploadedfile->getAllCities();
		$this->load->view("all_restaurants",$data);
	}
}