<script type="text/javascript">
	$(function(){

		// change ***********************************************************
		$('.name').click(function() {
			$('body').css('overflow','hidden');
			$('.mainContainer').css({top: $('body').scrollTop()});
			$('.backgroundContainer').css({top: $('body').position().top, height: $(document).height()});
			$('.mainContainer').fadeIn();
			$('.backgroundContainer').fadeIn();
			
			// load content in mainContainer using ajax - begin
			var res_name= $(this).find('#resName').html();
			var city_name=$(this).parent().find('.city').html();
			//var features=[];
			var f=$(this).parent().find('.features').html();
			
			var obj = $(this);
			
			var restId = obj.parent().find('.restId').html();
			var city = obj.next().html();
			$.ajax({
				url: '/CI_BigData/index.php/machine/loadMainContainer/'+city+'/'+restId,
				success: function(html){
					//alert(html);
					$('#topContainer').html('');
					$('#topContainer').append(html);
				},
				error: function(a, b, c) {
					alert(a+" "+b+" "+c);
				}
			});
		});
		// change ***********************************************************

		$('.features').each(function(){
			var obj = $(this);
			setTimeout(function() {
				var restId = obj.parent().find('.restId').html();
				var city = obj.prev().prev().html();

				//alert(restId+" "+city);
				$.ajax({
					url: '/CI_BigData/index.php/machine/features/'+city+'/'+restId,
					success: function(html){
						//alert(html);
						obj.html(html);
					},
					error: function(a, b, c) {
						alert(a+" "+b+" "+c);
					}
				});
			}, 500);
		});
	});
</script>
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