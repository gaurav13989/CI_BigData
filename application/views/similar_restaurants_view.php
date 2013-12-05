<script type="text/javascript">
$(function(){
	
	var city='<?php echo $city?>';
	<?php
		$x=0;
		foreach ($restaurants as $key => $value) {
			# code...
			?>

			
			var resId='<?php echo $key?>';
			$.ajax({
					url: '/CI_BigData/index.php/similarity_controller/getRestaurantName/'+city+'/'+resId,
					success: function(html){
					$('#similar_restaurants').append("<div class='restaurantCell'><div>"+html+"</div><div  id='<?php echo $x.$city; ?>'></div></div>");
					},
					error: function(a, b, c) {
						alert(a+" "+b+" "+c);
					}
				});
		
			//$('#similar_restaurants').append(city);
	<?php
	$x++;
	if($x==8){
		
		$y=0;
		foreach ($restaurants as $key => $value) {
			# code...
			?>	

			$.ajax({
					url: '/CI_BigData/index.php/machine/features/'+city+'/'+restId,
					success: function(html){
						//alert(html);
						$('#<?php echo $y.$city;?>').append(html);
					},
					error: function(a, b, c) {
						alert(a+" "+b+" "+c);
					}
				});

			<?php
			$y++;
			if($y==8){
				break;
			}
		}



		break;
		}
	}
	?>
});



</script>


<div id='similar_restaurants'>

</div>

