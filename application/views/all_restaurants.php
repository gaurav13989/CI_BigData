<html>
<head>
<script type="text/javascript" src="/CI_BigData/public/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
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
			$('.mainContainer').html('');
			$('.backgroundContainer').html('');
			$('body').css('overflow','auto');
		});
		// ajax to get restaurants acc to city and restaurant name
		// search if the id of the search button 
		$('#search_button').on('click',function() {
			var city = $('#city').val();
			var restName = $('#restaurant_key').val();
			if(restName == '')
				restName = "102";
			var ajx = $.ajax({
				url: '/CI_BigData/index.php/machine/search/'+city+'/'+restName,
				type: 'GET',
				success: function(html) {
					//alert(html);
					$('#features_list').remove();
					$('#restaurants').remove();
					$('body').append(html);
					ajx = '';
				},
				error: function(a, b, c) {
					//alert(a+" "+b+" "+c);
				}
			});
		});
		$('#clear').click(function(){
			$('#features_list').remove();
					$('#restaurants').remove();
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="/CI_BigData/public/styling.css"/>
<style type="text/css">
</style>
</head>
<body>
	<div class="backgroundContainer"></div>
	<div class="mainContainer"></div>
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
	<!-- Well well, what are you looking for? -->
</body>
</html>