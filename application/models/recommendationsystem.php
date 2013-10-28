<?php
/**
	This class acts as the Model class for the recommendation system
	It handles all CR operations for the recommendation system
	Structure of recommendationsystem
		- No database table
		- Instead we use the file system
		- root directory
			- city directory
				- rest file
					- entry in rest file
					- entry in rest file
					- entry in rest file
				- rest file
					- entry in rest file
					- entry in rest file
					- entry in rest file
			- city directory
				- rest file
					- entry in rest file
					- entry in rest file
					- entry in rest file
				- rest file
					- entry in rest file
					- entry in rest file
					- entry in rest file					
			- city directory
				- rest file
					- entry in rest file
					- entry in rest file
					- entry in rest file
				- rest file
					- entry in rest file
					- entry in rest file
					- entry in rest file
			  entries in the rest file would be tab separated				
		- Whenever a user clicks on a restaurant the click is recorded as "cityInitials:restId" and 
			is stored in the session
		- So if a user clicks on restaurant 1 then restaurant 2 then 3 4 5 and so on..
			a session variable would hold all these in the order in which the restaurants were visited
		- Before we can save the visited restaurant in the session variable
			- We insert the recorded click "cityInitials:restId" in the files for each of the restaurants
				that occur earlier in the list of visited restaurants in the session variable
			- This means if a user clicks on restaurant 1 then restaurant 2 then 3 and 4, and then proceeds to
				click on restaurant 5, we record restaurant 5's click i.e. "cityInitials:rest5" in each of
				the files of restaurant 1, restaurant 2 and 3 and 4. This is because restaurant 5 was visited
				after each of the earlier restaurants and must be considered for recommending purposes
			- Thus each file consists of restaurants that were visited after the restaurant given by the file
				name
		- For recommendations for given restaurant, the file for that restaurant is considered as follows
			- Arrange all the entries in the file in descending order of their occurances with the
				frequency count
			- The frequency count depicts the number of clicks on this restaurant
			- We return the first 10 values as the top 10 recommendations
*/
class Recommendationsystem extends CI_Model{

	// $earlierRestaurants is an array of click records
	// each value will be of the form
	//		cityInitials:restId
	// $newRest is a single value
	// 		it will also be of the same structure
	// returns true if all click records were inserted successfully
	// returns false if the format was not correct
	function record($earlierRestaurants, $newRest)
	{
		// parsing each value in earlierRestaurants and inserting $newRest in the file for each
		// restaurant in earlierRestaurants
		foreach ($earlierRestaurants as $rest) {
			$city = substr($rest, 0, 2);
			$restId = substr($rest, 3);
			if(!is_dir('\\CI_BigData\\recommendationsystem\\'.$city))
			{
				mkdir('\\CI_BigData\\recommendationsystem\\'.$city);
			}
			$file = fopen('\\CI_BigData\\recommendationsystem\\'.$city.'\\'.$restId, 'a');
			fwrite($file, $newRest);
			fclose($file);
		}
	}

	// $restaurant is a single value
	// 		it will have the following format
	// 			cityInitials:restId
	// returns list of click record values
	// 		'cityInitials' 'restId'
	//		'cityInitials' 'restId'
	//		'cityInitials' 'restId'
	function recommendationsFor($restaurant)
	{
		$city = substr($restaurant, 0, 2);
		$restId = substr($restaurant, 3);
		if(!file_exists('\\CI_BigData\\recommendationsystem\\'.$city.'\\'.$restId))
			return "";
		$lines = $file('\\CI_BigData\\recommendationsystem\\'.$city.'\\'.$restId);
		$sort = array_count_values($lines);
		arsort($sort);
		$finalValues = array_slice($sort, 0, 10));
		$arr = null;
		foreach ($finalValues as $rest) {
			// get all features of restaurant
			// and arrange in html form
			$arrEntry = array(substr($rest, 0, 2), substr($rest, 3)); 
			$arr[] = $arrEntry;
		}
		return $arr;
	}
}