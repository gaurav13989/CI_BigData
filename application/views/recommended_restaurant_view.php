<script type="text/javascript">
	$(function(){

		$('.name').click(function() {
			/*load content in mainContainer using ajax - begin*/
			var res_name= $(this).find('#resName').html();
			var city_name=$(this).parent().find('.city').html();
			/*var features=[];*/
			var f=$(this).parent().find('.features').html();
			
			var obj = $(this);
			
			var restId = obj.parent().find('.restId').html();
			var city = obj.next().html();
			// alert(restId + " " + city);
			$.ajax({
				url: '/CI_BigData/index.php/machine/loadMainContainer/'+city+'/'+restId,
				success: function(html){
					/*alert(html);*/
					$('#shown').nextAll().remove();
					$('#shown').attr('id', '');
					$('#topContainer').append(html);
				},
				error: function(a, b, c) {
					alert(a+" "+b+" "+c);
				}
			});
		});

		$('.features').each(function(){
			var obj = $(this);
			// setTimeout(function() {
				var restId = obj.parent().find('.restId').html();
				var city = obj.prev().prev().html();

				/*alert(restId+" "+city);*/
				$.ajax({
					url: '/CI_BigData/index.php/machine/features/'+city+'/'+restId,
					success: function(html){
						/*alert(html);*/
						obj.html(html);
					},
					error: function(a, b, c) {
						alert(a+" "+b+" "+c);
					}
				});
			// }, 500);
		});
	});
</script>
	<?php 
	$i = 1;

	foreach ($restaurant_names as $restaurant_id => $restaurant_name) { 
		?>
	<div class="restaurantCell">
		<div class="name">
			<span style="display: none;" class="restId">
				<?php echo $restaurant_id; ?>
			</span>
			<div id="resName"><?php echo $restaurant_name; ?></div>
		</div>
		<div class="cityIni" style="display: none;"><?php echo $city;?></div>
		<div class="city"><?php echo urldecode($city_name);?></div>
		<div class="features">
			<div style="text-align: center; margin-top: 20%;"><img src="/CI_BigData/public/loading.gif"/></div>
		</div>
	</div>
	<div class="done" style="display: none;">yes</div>
	<?php $i++; 
	// echo $i." ";
	if($i == 10)
		break;
	} 

	?>