<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_load extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		// loading model
		// $this->load->model('model1');

		// calling model method
		// $data['query'] = $this->model1->getVals($param1);

		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}


}