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
}	