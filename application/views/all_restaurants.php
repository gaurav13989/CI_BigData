<html>
<head>
<title>Group 9 - Big Data Term Project</title>
<script type="text/javascript" src="/CI_BigData/public/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#next').click(function(){
			//alert('asd'+$('#shown').next('.sliderElement').length);
			if($('#shown').next('.sliderElement').length > 0)
			{
				var obj = $('#shown').next();
				$('#shown').attr('id', '');
				obj.attr('id', 'shown');
			}
		});
		
		$('#prev').click(function(){
			//alert('asd'+$('#shown').prev('.sliderElement').length);
			if($('#shown').prev('.sliderElement').length > 0)
			{
				var obj = $('#shown').prev();
				$('#shown').attr('id', '');
				obj.attr('id', 'shown');
			}
		});
		// $('.name').click(function() {
		// 	$('body').css('overflow','hidden');
		// 	$('.mainContainer').css({top: $('body').scrollTop()});
		// 	$('.backgroundContainer').css({top: $('body').position().top, height: $(document).height()});
		// 	$('.mainContainer').fadeIn();
		// 	$('.backgroundContainer').fadeIn();
			
		// 	// load content in mainContainer using ajax - begin

		// 	// load content in mainContainer using ajax - end

		// });

		$('.backgroundContainer').click(function() {
			$('.mainContainer').hide();
			$('.backgroundContainer').hide();
			// $('.mainContainer').html('');
			$('#topContainer').html($('#loadingDiv').html());
			$('.backgroundContainer').html('');
			$('body').css('overflow','auto');
		});
		// ajax to get restaurants acc to city and restaurant name
		// search if the id of the search button 
		$('#search_button').on('click',function() {
			var city = $('#city').val();
			var restName = $('#restaurant_key').val();
			$('#features_list').hide();
			$('#restaurants').hide();
			$('#firstLoad').show();
			if(restName == '')
				restName = "102";
			var ajx = $.ajax({
				url: '/CI_BigData/index.php/machine/search/'+city+'/'+restName,
				type: 'GET',
				success: function(html) {
					//alert(html);
					$('#firstLoad').hide();
					$('#features_list').remove();
					$('#restaurants').remove();
					$('body').append(html);
					ajx = '';
				},
				error: function(a, b, c) {
					alert(a+" "+b+" "+c);
					$('#features_list').show();
					$('#restaurants').show();
					$('#firstLoad').hide();
				}
			});
		});
		$('#clear').click(function(){
			$('#features_list').remove();
					$('#restaurants').remove();
		});
		
		$('.backgroundContainer').click(function() {
			$('.mainContainer').hide();
			$('.backgroundContainer').hide();
			// $('.mainContainer').html('');
			$('.backgroundContainer').html('');
			$('body').css('overflow','auto');
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="/CI_BigData/public/styling.css"/>
<style type="text/css">
</style>
</head>
<body>
	<div class="backgroundContainer"></div>
	<div class="mainContainer">
		<div id="topContainer">
			<div style="text-align: center; margin-top: 20%;">
				<img src="/CI_BigData/public/loading2.gif"/>
			</div>
		</div>
		<div id="bottomContainer">
			<div id="next">&gt;</div>
			<div id="prev">&lt;</div>
		</div>
		<div id="loadingDiv" style="display: none;">
			<div style="text-align: center; margin-top: 20%;">
				<img src="/CI_BigData/public/loading2.gif"/>
			</div>
		</div>
	</div>
	<div id="title" align="center"><h1>RESTAURANT SEARCH SYSTEM</h1></div>
	<hr/>
	<div id="search">
		<div id="first">
			<div class="cell">City:</div>
			<div class="cell">
				<select id='city' style="width: 160px;">
				<?php foreach ($row as $r):
					if ($r->cityName != 'Feature') {
					?>
					<option value='<?php echo $r->city ?>'><?php echo urldecode($r->cityName) ?></option>
				<?php }
				endforeach ?>
				</select>
			</div>
			<div class="clear"></div>
			<div class="cell">Restaurant:</div>
			<div class="cell">
				<input id="restaurant_key" type="text" style="width: 160px;" />
				<input id="search_button" type="button" value="Search"/>
				<input id="clear" type="button" value="Clear" style="display: none;"/>
			</div>	
			<div class="clear"></div>
		</div>
	</div>
	<hr/>
	<div id="firstLoad" style="text-align: center; display: none;">
		<img style="margin-left: auto; margin-right: auto; margin-top: 10px;" src="/CI_BigData/public/loading2.gif"/>
	</div>
	<!-- Well well, what are you looking for? -->
</body>
</html>