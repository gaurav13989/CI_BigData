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

	// INCOMPLETE
	public function home($error = '')
	{
		// cal to model retrieving all uploaded files
		// returned records as fileName - cityName - cityInitials

		// model to delete all records of a particular city by passing city initials
		// records for all <city initails> should be deleted from all appropriate tables in the database
		$this->load->model('uploadedfile');
		$uploaded = $this->uploadedfile->getAll_uploadedfile();
		$data['size'] = sizeof($uploaded);
		if($error = '')
			$error = array('error' => '');
		$data['error'] = $error;
		$data['uploadedfile'] = $uploaded;
		$this->load->view('header');
		$this->load->view('home', $data);
		$this->load->view('footer');
	}

	// COMPLETE
	public function upload()
	{
		$defaultCityName = $this->input->post('cityName');
		if($defaultCityName == "")
			$defaultCityName = "xx";

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
			$this->home($error);
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
			redirect('data_load/add/'.$this->upload->data()['file_name'].'/'.$defaultCityName, 'refresh');
		}

		
	}

	// INCOMPLETE
	public function add($fileName, $cityName)
	{
		// city code from fileName

		// $feature[] = array();
		// $restaurant[] = array();
		// $restaurant_feature_list[] = array();
		$fileNameArr = explode('_', $fileName);
		$city = substr($fileName, 0, 2);
		if(sizeof($fileNameArr) > 1)
		{
			$city = substr($fileNameArr[0], 0, 1).substr($fileNameArr[1], 0, 1);
		}

		$entireFile = file('./uploads/'.$fileName);
		if($fileName == 'features.txt')
		{
			foreach ($entireFile as $line) {
				$explodedLine = explode("\t", $line);
				$feature[] = array('feature_id' => $explodedLine[0], 'feature_name' => $explodedLine[1]);
			}
			// call model
			$this->load->model('feature');
			$this->feature->insert_feature($feature);
			$this->load->model('uploadedfile');
			$this->uploadedfile->insert_uploadedFile(array(array('fileName' => $fileName, 'cityName' => 'Feature', 'city' => '')));
		}
		else
		{
			foreach ($entireFile as $line) {
				$explodedLine = explode("\t", $line);
				if(sizeof($explodedLine) < 3)
				{
					redirect('data_load/home', 'refresh');
				}
				$restaurant[] = array('city' => $city, 'restaurant_id' => $explodedLine[0], 'restaurant_name' => $explodedLine[1]);

				$explodedRestFeatureList = explode(" ", $explodedLine[2]);
				foreach($explodedRestFeatureList as $feature)
				{
					$features[] = $feature;
				}
				// $features[] = array_splice($features, 0);
				$features = array_unique($features);
				// $features = null;
				foreach ($features as $feature) {
					$restaurant_feature_list[] = array('city' => $city, 'restaurant_id' => $explodedLine[0], 'feature_id' => $feature);
				}
				$features = null;
				// $features[] = array_splice($features, 0);
			}
			// call model method for restaurant and restaurant_feature_list
			$this->load->model('restaurant');
			$this->load->model('restaurant_feature_list');
			$this->load->model('uploadedfile');
			$this->uploadedfile->insert_uploadedFile(array(array('fileName' => $fileName, 'cityName' => $cityName, 'city' => $city)));
			$this->restaurant->insert_restaurant($restaurant);
			$this->restaurant_feature_list->insert_restaurant_feature_list($restaurant_feature_list);
			
		}
		redirect('data_load/home', 'refresh');
	}

	public function delete($initials = "")
	{
		if($initials == ""){

		}
		else {
			// call model for deleting file and records with $initials
			$this->load->model('uploadedfile');
			$fileName = $this->uploadedfile->getFileName($initials);
			$this->uploadedfile->delete_uploadedfile($initials);
		}
		// redirect('data_load/add/'.$this->upload->data()['file_name'], 'refresh');
		redirect('data_load/home', 'refresh');
	}
}