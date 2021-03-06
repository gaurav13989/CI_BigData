<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	This class handles all ajax calls made by the system
*/
class Machine extends CI_Controller {

	// Default Constructor
	public function __construct()
	{
		parent::__construct();
	}

	public function loadMainContainer($city,$restId){
		$this->load->model('restaurant_feature_list');
		$query = $this->restaurant_feature_list->features($city, $restId);

		foreach($query->result() as $row) {
			$featureIds[] = $row->feature_id;
		}

		$data['city_id']=$city;
		$data['restId']=$restId;
		$this->load->model('feature');
		$data['data'] = $this->feature->getAll_feature($featureIds);
		$this->load->model('uploadedfile');
		$data['city']=$this->uploadedfile->getCityName($city);
		$this->load->model('restaurant');
		$data['restaurant_name']=$this->restaurant->getRestaurant($city,$restId);
		$this->load->view('main_container', $data);
	}
	
	// Displays the home page for this module
	public function search($city = null, $restName = null)
	{
		//echo "as";
		$this->load->model('restaurant_feature_list');
		$this->load->model('feature');
		$arr = array('city' => $city, 'restName' => '101');
		$data['restaurant_list'] = $this->restaurant_feature_list->getRestaurants($arr);
		$data['features'] = $this->feature->getAll_feature();
		$data['asd'] = '';
		$this->load->view('feature_restaurant_view', $data);
	}

	// returns feature names for given restId and city
	public function features($city, $restId) {
		$this->load->model('restaurant_feature_list');
		$query = $this->restaurant_feature_list->features($city, $restId);

		foreach($query->result() as $row) {
			$featureIds[] = $row->feature_id;
		}
		$this->load->model('feature');
		$data['data'] = $this->feature->getAll_feature($featureIds);
		$this->load->view('feature_name_list', $data);
	}

	//finds cheaper restaurants
	public function findCheaperRestaurants($city,$feature_id,$cityName){
		$this->load->model('restaurant_feature_list');
		$data['restData']=$this->restaurant_feature_list->getCheaperRestaurants($city,$feature_id);
		$data['city'] = $city;
		$data['cityName'] = $cityName;
		$this->load->view('cheaper_restaurants_view',$data);
	}
	
	// this function returns restaurants of a given city and matching 
	// name according to the feature ids provided
	public function restaurantsByFeatures() {
		// echo "a";
		$this->load->model('restaurant_feature_list');
		$features = null;
		if(isset($_POST['features']))
			$features = $_POST['features'];
		$arr = array('city' => $_POST['city'], 'restName' => $_POST['restName'], 'features' => $features);
		// var_dump($arr);
		$data['restaurant_list'] = $this->restaurant_feature_list->getRestaurants($arr);
		$this->load->view('restaurants_on_feature_change', $data);
	}

}	
