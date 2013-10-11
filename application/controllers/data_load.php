<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_load extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//$this->home();
		$this->load->model('feature');
		$array=array(array('feature_id'=>103, 'feature_name'=>'abc'),array('feature_id'=>104,'feature_name'=>'def'));

		$this->feature->insert_feature($array);
		$data=$this->feature->getAll_feature();
		foreach($data as $row){
			echo $row->feature_id;
		}
	}

	public function home($error = '')
	{
		if($error = '')
			$error = array('error' => '');
		$data['error'] = $error;
		$this->load->view('header');
		$this->load->view('home', $data);
		$this->load->view('footer');
	}

	public function upload()
	{
		echo $this->input->post('cityName');
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'txt';
		$config['max_size']	= (1024 * 1024).'';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
		$this->upload->overwrite = true;

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			// var_dump($error);
			// echo 'here';
		}
		else
		{
			// Successful upload
			// read file and make array for inserting into db
			// $string = read_file('/uploads/'.$_FILE['userfile']['name']);
			// echo $string;
			$error = array('error'=>'');
		}

		$this->home($error);
		redirect('data_load/add/'.$this->upload->data()['file_name'], 'refresh');
	}

	public function add($fileName)
	{
		// city code from fileName

		$feature[] = array();
		$restaurant[] = array();
		$restaurant_feature_list[] = array();

		$entireFile = file('./uploads/'.$fileName);
		if($fileName == 'features.txt')
		{
			foreach ($entireFile as $line) {
				$explodedLine = explode("\t", $line);
				$feature[] = array('feature_id' => $explodedLine[0], 'feature_name' => $explodedLine[1]);
			}
			// call model
		}
		else
		{
			$fileNameArr = explode('_', $fileName);
			$city = substr($fileName, 0, 2);
			if(sizeof($fileNameArr) > 1)
			{
				$city = substr($fileNameArr[0], 0, 1).substr($fileNameArr[1], 0, 1);
			}
			foreach ($entireFile as $line) {
				$explodedLine = explode("\t", $line);
				$restaurant[] = array('city' => $city, 'restaurant_id' => $explodedLine[0], 'restaurant_name' => $explodedLine[1]);

				$explodedRestFeatureList = explode(" ", $explodedLine[2]);
				foreach($explodedRestFeatureList as $feature)
				{
					$restaurant_feature_list[] = array('city' => $city, 'restaurant_id' => $explodedLine[0], 'feature_id' => $feature);
				}
			}
			// print_r($restaurant);
			// print_r($restaurant_feature_list);
			// call model
		}
	}
}