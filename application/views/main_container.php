 <script type="text/javascript" src="/CI_BigData/public/jquery.min.js"></script>
 <script type="text/javascript">
$(function(){
	$("#cheap_restaurants").click(function(){
		var city_id=$('#city_id').html().trim();
		var feature_id=$('#feature_id').html().trim();
		$.ajax({
					
			url: '/CI_BigData/index.php/machine/findCheaperRestaurants/'+city_id+'/'+feature_id,
			success: function(html){
				
				$('.mainContainer').html(html);
			},
			error: function(a, b, c) {
				alert(a+" "+b+" "+c);
			}
		});
	});

$('#select_city').html($('#city').html());

$('#similar_search').click(function(){
	$.ajax({
					
			url: '/CI_BigData/index.php/similarity_controller/calculateSimilarRestaurants/',
			success: function(html){
				
				$('.mainContainer').html(html);
			},
			error: function(a, b, c) {
				alert(a+" "+b+" "+c);
			}
		});
});
});
 </script>


<html>
<body>

<?php foreach ($restaurant_name as $r) {?>
	<div align="center" class=''><?php echo $r->restaurant_name?></div>

<?php }?>
	<div id='city_id' style="display:none"> <?php echo $city_id?> </div>
	<div align="center"><?php echo $city?></div>
	<br>
	<br>
<?php foreach ($data as $feature) {
?>
	<div class='container_features'><?php echo $feature->feature_name;
	if($feature->feature_id==164 || $feature->feature_id==167 || $feature->feature_id==169){
?>
	<div id="feature_id" style="display:none"><?php echo $feature->feature_id?></div>
	<input id="cheap_restaurants"type ="button" value="Find Cheaper Restaurants"></input>
<?php
}
?>
	 	</div>

<?php 
}
?>

Find Similar Restaurants in:
	
	<select id='select_city'>

	</select>
	<input id='similar_search' type="button" value="Search"></input>
	


</body>
</html>