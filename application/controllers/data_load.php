<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	This class handles the upload and delete of txt files having feature and restaurant data.
	It has several functions like,
		upload() for uploading a txt file
		add() for loading contents of a txt file into tables
		delete() for deleting records of a particular city or the feature list
*/
class Data_load extends CI_Controller {

	// Default Constructor
	public function __construct()
	{
		parent::__construct();
	}

	// Default method that is called when this class is referenced from the URL
	public function index()
	{
		$this->home();
	}

	// Displays the home page for this module
	public function home($error = '')
	{
		// call to model retrieving all uploaded files
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

	// This method helps in uploading the file to the database
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

		if (!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->home($error);
		}
		else
		{
			// Successful upload
			$error = array('error'=>'');
			// redirecting for loading uploaded file in the database
			redirect('data_load/add/'.$this->upload->data()['file_name'].'/'.$defaultCityName, 'refresh');
		}
	}

	// Adds contents of txt file $fileName to the database
	// features.txt file is added to features table
	// rest are loaded in the restaurant and restaurant_feature_list tables
	public function add($fileName, $cityName)
	{
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
				$features = array_unique($features);
				foreach ($features as $feature) {
					$restaurant_feature_list[] = array('city' => $city, 'restaurant_id' => $explodedLine[0], 'feature_id' => $feature);
				}
				$features = null;
			}
			// call model methods for restaurant and restaurant_feature_list
			$this->load->model('restaurant');
			$this->load->model('restaurant_feature_list');
			$this->load->model('uploadedfile');
			$this->uploadedfile->insert_uploadedFile(array(array('fileName' => $fileName, 'cityName' => $cityName, 'city' => $city)));
			$this->restaurant->insert_restaurant($restaurant);
			$this->restaurant_feature_list->insert_restaurant_feature_list($restaurant_feature_list);
			
		}
		redirect('data_load/home', 'refresh');
	}

	// This method deletes all records from the restaurant and restaurant_feature_list tables having city given by $initials
	// The txt file used is also deletes from the server
	public function delete($initials = "")
	{
		if($initials == ""){

		}
		else {
			// calling model for deleting file and records with $initials
			$this->load->model('uploadedfile');
			$fileName = $this->uploadedfile->getFileName($initials);
			// deleting txt file with name specified by $fileName
			unlink('./uploads/'.$fileName);
			$this->uploadedfile->delete_uploadedfile($initials);
		}
		// redirecting to the home page after deletion
		redirect('data_load/home', 'refresh');
	}
}