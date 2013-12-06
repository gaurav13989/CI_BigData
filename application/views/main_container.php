<div class="sliderElement" id="shown">
<script type="text/javascript" src="/CI_BigData/public/jquery.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$("#cheap_restaurants").click(function(){
			var city_id=$('#city_id').html().trim();
			var feature_id=$('#feature_id').html().trim();
			$.ajax({	
				url: '/CI_BigData/index.php/machine/findCheaperRestaurants/'+city_id+'/'+feature_id+'/'+$('#cityName').html().trim(),
				success: function(html){
					$('#shown').nextAll().remove();
					$('#shown').attr('id', '');
					$('#topContainer').append(html);
				},
				error: function(a, b, c) {
					alert(a+" "+b+" "+c);
				}
			});
		});

		$('#select_city').html($('#city').html());

		$('.recommendations').each(function(){
			 // alert($(this).parent().find('.done').html());
			var obj = $(this);
			
			var restId = obj.prev().prev().prev().html().trim();
			var cityS = obj.prev().prev().html().trim();
			var cityD = obj.prev().html().trim();
			// alert(restId+" "+cityS+" "+cityD);
			/*alert(restId+" "+city);*/
			$.ajax({
				url: '/CI_BigData/index.php/similarity_controller/calculateSimilarRestaurants/'+cityS+'/'+cityD+'/'+restId,
				success: function(html){
					// alert(html);
					obj.hide();
					obj.after(html);
				},
				error: function(a, b, c) {
					alert(a+" "+b+" "+c);
				}
			});
			obj.attr('class','noClass');
	});

		$('#more').click(function() {
			$('#containerForAllRemainingRecommendations').slideDown();
		});
	});
	</script>
	<div>
	
	<?php foreach ($restaurant_name as $r) {?>
		<div style="text-align: center; font-size: 22px; font-weight: bold; margin-top: 50px;" class=''>-- <?php echo $r->restaurant_name?> --</div>
	<?php }?>
		<div id='res_id' style="display:none"><?php echo $restId ?></div>
		<div id='city_id' style="display:none"> <?php echo $city_id?> </div>
		<div style="text-align: center; font-size: 16px; font-style: italic;" id="cityName"><?php echo $city?></div>
		<br>
		<br>
		<div style="text-align: center; text-justify: distribute-all-lines; width: 100%;">
	<?php foreach ($data as $feature) { ?>
		<div class='feature2'>
		<?php echo $feature->feature_name;
			if($feature->feature_id==164 || $feature->feature_id==167 || $feature->feature_id==169){
		?>
				<div id="feature_id" style="display:none"><?php echo $feature->feature_id?></div>
				<div id="cheap_restaurants" style="font-style: italic; cursor: pointer; color: green;">Find Cheaper Restaurants</div>
		<?php
		}
		?>
		</div>
		</div>

	<?php } ?>
</div>
<div style="clear: both;"></div>
<!-- Recommended restaurants from same city -->
<div style="overflow: auto;">
	<div style="height: 20px;"></div>
	<span style="font-style: italic; margin-left: 20px;">Recommended restaurants from the city <?php echo $city?></span>
	<div style="margin-right: 5px; position: relative; overflow: hidden; height: auto; width: 2050px;">
		<hr/>
		<div class="rId" style="display: none;"><?php echo $restId ?></div>
		<div class="cId" style="display: none;"><?php echo $city_id?></div>
		<div class="curCId" style="display: none;"><?php echo $city_id?></div>
		<div class="recommendations" style="">
			<div style="text-align: left; padding-left: 100px;"><img src="/CI_BigData/public/loading2.gif"/></div>
		</div>

		<div class="clear"></div>
		<hr/>
	</div>
</div>
<div style="text-align: right; color: blue; cursor: pointer; font-style: italic; padding-right: 25px;" id="more">MORE</div>
<!-- loop for remaining restaurants -->
<?php
	$this->load->model('uploadedfile');
	$cities = $this->uploadedfile->getCities();
?>
<div id="containerForAllRemainingRecommendations" style="display: none;">
	<?php foreach ($cities as $city1): 
	
	if($city_id != $city1->city)
	{
	?>
		<div style="overflow: auto;">
			<div style="height: 20px;"></div>
			<span style="font-style: italic; margin-left: 20px;">Recommended restaurants from the city <?php echo $city1->cityName;?></span>
			<div style="margin-right: 5px; position: relative; overflow: hidden; height: auto; width: 300%;">
				<hr/>
				<div class="rId" style="display: none;"><?php echo $restId ?></div>
				<div class="cId" style="display: none;"><?php echo $city_id?></div>
				<div class="curCId" style="display: none;"><?php echo $city1->city?></div>
				<div class="recommendations" style="">
					<div style="text-align: left; padding-left: 100px;"><img src="/CI_BigData/public/loading2.gif"/></div>
				</div>

				<div class="clear"></div>
				<hr/>
			</div>
		</div>
	<?php 
	}
	endforeach ?>
</div>
</div>
