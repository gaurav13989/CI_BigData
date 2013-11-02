<?php
class similarity_controller extends CI_Controller{
	
	public function calculateSimilarRestaurants($cityS,$cityD,$resId){
		$this->load->model('restaurant_feature_list');
		$arrayList['city']='at';
		$arrayList['restaurant_id']='6';
		$a=array($arrayList);
		$data=$this->restaurant_feature_list->getAll_restaurant_feature_list($a);

		$this->load->model('restaurant');
		$restaurants=$this->restaurant->getCityRestaurant($cityD);

		foreach ($restaurants as $row) {
			$id=$row->restaurant_id;
			$array['city']='ny';
			$array['restaurant_id']=$id;
			$b=array($array);
			$d=$this->restaurant_feature_list->getAll_restaurant_feature_list($b);

			echo sizeof($array_diff($data,$d));
			
		}


	}
}
?>