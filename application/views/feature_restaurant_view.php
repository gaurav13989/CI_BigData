<script type="text/javascript">
	$(function(){
		$('.name').click(function() {
			$('body').css('overflow','hidden');
			$('.mainContainer').css({top: $('body').scrollTop()});
			$('.backgroundContainer').css({top: $('body').position().top, height: $(document).height()});
			$('.mainContainer').fadeIn();
			$('.backgroundContainer').fadeIn();
			
			/*load content in mainContainer using ajax - begin*/
			var res_name= $(this).find('#resName').html();
			var city_name=$(this).parent().find('.city').html();
			/*var features=[];*/
			var f=$(this).parent().find('.features').html();
			
			var obj = $(this);
			
			var restId = obj.parent().find('.restId').html();
			var city = obj.next().html();
			/*$('.mainContainer').html(city);
			alert(restId+" "+city);*/
			$.ajax({
				url: '/CI_BigData/index.php/machine/loadMainContainer/'+city+'/'+restId,
				success: function(html){
					/*alert(html);*/
					$('#topContainer').html('');
					$('#topContainer').append(html);
				},
				error: function(a, b, c) {
					alert(a+" "+b+" "+c);
				}
			});
			/*$.ajax({
					url: '/CI_BigData/index.php/machine/features/'+res_name+"/"+city_name,
					success: function(html){
						//alert(html);
						$('.mainContainer').html(html);
					},
					error: function(a, b, c) {
						alert(a+" "+b+" "+c);
					}
				});
			$('.mainContainer').append(f);
		
			load content in mainContainer using ajax - end*/

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

		$('input[name="features"]').change(function(){

			$('#restaurants').hide();
			$('#restaurantsShadow').show();	
			var checkedValues = $('input[name=features]:checked').map(function() {
				return $(this).val();
			})
			.get();
        /*    var jqXHR;
            if(jqXHR && jqXHR.readystate != 4){
           		jqXHR.abort();
       		}*/
       		var jqXHR = $.ajax({
       			url: '/CI_BigData/index.php/machine/restaurantsByFeatures',
       			type: 'POST',
       			data: { city: $('#city').val(), restName: $('#restaurant_key').val(), features: checkedValues },
       			success: function(html) {
       				// alert(html);
					$('#restaurantsShadow').hide();	
       				$('#restaurants').remove();
       				$('body').append(html);
       			},
       			error: function(a, b, c) {
					alert(a+" "+b+" "+c);
					$('#restaurantsShadow').hide();	
					$('#restaurants').show();
       			}
       		});
		});
	});
</script>
<div id="features_list">
	<hr/>
	<span style="text-align: center; display: inline-block;width: 100%;">Features</span>
	<hr/>
	<?php foreach ($features as $feature) { ?>
		<div class="feature">
			<input type="checkbox" name="features" value="<?php echo $feature->feature_id; ?>" id="<?php echo $feature->feature_id; ?>"/>
			<label for="<?php echo $feature->feature_id; ?>"><?php echo $feature->feature_name ?></label>
		</div>
	<?php } ?>
</div>
<div id="restaurantsShadow" style="display: none; text-align: center; float: right; width: 75%;">
	<img src="/CI_BigData/public/loading2.gif"/>
</div>
<div id="restaurants">
	<hr/>
	<?php $i = 0;?>
	<?php foreach ($restaurant_list['restaurant_id'] as $restaurant) { 
		?>
	<div class="restaurantCell">
		<div class="name">
			<span style="display: none;" class="restId">
				<?php echo $restaurant_list['restaurant_id'][$i]; ?>
			</span>
			<div id="resName"><?php echo $restaurant_list['restaurant_name'][$i]; ?></div>
		</div>
		<div class="cityIni" style="display: none;"><?php echo $restaurant_list['city']?></div>
		<div class="city"><?php echo urldecode($restaurant_list['cityName'])?></div>
		<div class="features">
			<div style="text-align: center; margin-top: 20%;"><img src="/CI_BigData/public/loading.gif"/></div>
			
		</div>
	</div>

	<?php $i++; } 
	$features = NULL;
	$restaurants['restaurant_id'] = NULL;
	$restaurants['restaurant_name'] = NULL;
	$restaurants['cityName'] = NULL;
	?>
	<div class="clear"></div>
	<hr/>
</div>