<?php
class similarity_controller extends CI_Controller{
	
	public function calculateSimilarRestaurants($cityS,$cityD,$resId){
		$this->load->model('restaurant_feature_list');
		$arrayList['city']=$cityS;
		$arrayList['restaurant_id']=$resId;
		$a=array($arrayList);
		$data=$this->restaurant_feature_list->getAll_restaurant_feature_list($a);
		
		foreach($data as$r){
			$sourcefeatures[]=$r->feature_id;
		}
		
		$this->load->model('restaurant');
		$restaurants=$this->restaurant->getCityRestaurant($cityD);

		foreach ($restaurants as $row) {
			$id=$row->restaurant_id;
			if(!($cityD == $cityS && $id == $resId))
			{
				$array['city']=$cityD;
				$array['restaurant_id']=$id;
				$b=array($array);
				$d=$this->restaurant_feature_list->getAll_restaurant_feature_list($b);

				foreach($d as $r){
					$destinationfeatures[]=$r->feature_id;
				}
				
				 $count=sizeof(array_intersect($sourcefeatures, $destinationfeatures));
				$restaurant[$id]=$count;				
			}
			//$all_restaurants[]=$restaurant;

		}

		arsort($restaurant);
		foreach ($variable as $key => $value) {
			# code...
			$restaurant=$this->restaurant->getRestaurant($cityD,$key);
			$resName='';
			foreach ($restaurant as $r) {
				$resName=$r->restaurant_name;
			}
			$restaurant_names[$key]=$resName;
		}

		$this->load->model('uploadedfile');
		$cityName=$this->uploadedfile->getCityName($cityD);
		$send_to_view['restaurants']=$restaurant;
		$send_to_view['city']=$cityD;
		$send_to_view['city_name']=$cityName;
		$send_To_view['restaurant_names']=$restaurant_names;
		$this->load->view("similar_restaurants_view",$send_to_view);
}

public function getRestaurantName($city,$resId){
	$this->load->model('restaurant');
	$restaurant=$this->restaurant->getRestaurant($city,$resId);
	$resName='';
	foreach ($restaurant as $r) {
		$resName=$r->restaurant_name;
	}
	echo $resName;
}
}