<?php
class recommend extends CI_Controller{

	public function index(){
		$this->home();
	}

	public function home() {
		$this->load->helper("url");
		$this->load->model("uploadedfile");
		$city['row']=$this->uploadedfile->getAllCities();
		$this->load->view("all_restaurants",$city);
	}
}