<div class="sliderElement" id="shown">
	<script type="text/javascript" src="/CI_BigData/public/jquery.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$("#cheap_restaurants").click(function(){
			var city_id=$('#city_id').html().trim();
			var feature_id=$('#feature_id').html().trim();
			$.ajax({	
				url: '/CI_BigData/index.php/machine/findCheaperRestaurants/'+city_id+'/'+feature_id,
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

		$('#similar_search').click(function(){
			var cityS=$('#city_id').html().trim();
			var cityD=$('#select_city').val().trim();
			var resid=$('#res_id').html().trim();
			$.ajax({			
				url: '/CI_BigData/index.php/similarity_controller/calculateSimilarRestaurants/'+cityS+'/'+cityD+'/'+resid,
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
	<?php foreach ($restaurant_name as $r) {?>
		<div style="text-align: center; font-size: 22px; font-weight: bold; margin-top: 50px;" class=''>-- <?php echo $r->restaurant_name?> --</div>
	<?php }?>
		<div id='res_id' style="display:none"><?php echo $restId ?></div>
		<div id='city_id' style="display:none"> <?php echo $city_id?> </div>
		<div style="text-align: center; font-size: 16px; font-style: italic;"><?php echo $city?></div>
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
<div>Recommended restaurants from the same city
		<hr/>
	<div style="margin-right: 5px; overflow-x: auto; height: auto; width: auto;">
		<div class="restaurantCell" style="display: inline-block;">
			<div class="name">
				<span style="display: none;" class="restId">
					restid
				</span>
				<div class="resName">Rest1</div>
			</div>
			<div class="cityIni" style="display: none;">cityInitials</div>
			<div class="city">cityName</div>
			<div class="features">
				<div style="text-align: center; margin-top: 20%;"><img src="/CI_BigData/public/loading.gif"/></div>
			</div>
		</div>
		<div class="restaurantCell" style="display: inline-block;">
			<div class="name">
				<span style="display: none;" class="restId">
					restid
				</span>
				<div class="resName">Rest1</div>
			</div>
			<div class="cityIni" style="display: none;">cityInitials</div>
			<div class="city">cityName</div>
			<div class="features">
				<div style="text-align: center; margin-top: 20%;"><img src="/CI_BigData/public/loading.gif"/></div>
			</div>
		</div>
		<div class="restaurantCell" style="display: inline-block;">
			<div class="name">
				<span style="display: none;" class="restId">
					restid
				</span>
				<div class="resName">Rest1</div>
			</div>
			<div class="cityIni" style="display: none;">cityInitials</div>
			<div class="city">cityName</div>
			<div class="features">
				<div style="text-align: center; margin-top: 20%;"><img src="/CI_BigData/public/loading.gif"/></div>
			</div>
		</div>
		<div class="restaurantCell" style="display: inline-block;">
			<div class="name">
				<span style="display: none;" class="restId">
					restid
				</span>
				<div class="resName">Rest1</div>
			</div>
			<div class="cityIni" style="display: none;">cityInitials</div>
			<div class="city">cityName</div>
			<div class="features">
				<div style="text-align: center; margin-top: 20%;"><img src="/CI_BigData/public/loading.gif"/></div>
			</div>
		</div>
		<div class="restaurantCell" style="display: inline-block;">
			<div class="name">
				<span style="display: none;" class="restId">
					restid
				</span>
				<div class="resName">Rest1</div>
			</div>
			<div class="cityIni" style="display: none;">cityInitials</div>
			<div class="city">cityName</div>
			<div class="features">
				<div style="text-align: center; margin-top: 20%;"><img src="/CI_BigData/public/loading.gif"/></div>
			</div>
		</div>
		<div class="restaurantCell" style="display: inline-block;">
			<div class="name">
				<span style="display: none;" class="restId">
					restid
				</span>
				<div class="resName">Rest1</div>
			</div>
			<div class="cityIni" style="display: none;">cityInitials</div>
			<div class="city">cityName</div>
			<div class="features">
				<div style="text-align: center; margin-top: 20%;"><img src="/CI_BigData/public/loading.gif"/></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
		<hr/>
</div>
