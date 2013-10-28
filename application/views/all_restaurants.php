<html>
<head>
<script type="text/javascript" src="/CI_BigData/public/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('.name').click(function() {
			$('body').css('overflow','hidden');
			$('.mainContainer').css({top: $('body').scrollTop()});
			$('.backgroundContainer').css({top: $('body').position().top, height: $(document).height()});
			$('.mainContainer').fadeIn();
			$('.backgroundContainer').fadeIn();
			
			// load content in mainContainer using ajax - begin

			// load content in mainContainer using ajax - end

		});
		$('.backgroundContainer').click(function() {
			$('.mainContainer').hide();
			$('.backgroundContainer').hide();
			$('body').css('overflow','auto');	
		});
	});
</script>
<style type="text/css">
	body {
		margin: 0px;
		padding: 0px;
	}
	#search{
		float:left;
		width: 100%;
	}
	#restaurants{
		float: right;
		width: 75%;
		margin-right: 5px;
	}
	#features_list{
		float: left;
		width: 23%;
		margin-left: 5px;
		min-height: 400px;
		max-height: 400px;
	}
	#title {
		padding: 10px;
	}
	#first {
		margin-left: auto;
		margin-right: auto;
		padding: 20px;
		width: 20%;
	}
	.cell {
		float: left;
		text-align: left;
		width: 100px;
	}
	.clear {
		clear: both;
	}
	.restaurantCell {
		width: 200px;
		height: 200px;
		max-width: 200px;
		max-height: 200px;
		float: left;
		padding: 10px;
		margin: 3px 3px 0px 0px;
		border: dashed 1px rgb(100,100,100);
	}
	.name {
		text-align: center;
		font-weight: bold;
		font-size: 18px;
		cursor: pointer;
	}
	.city {
		text-align: center;
		font-style: italic;
	}
	.features {
		background-color: rgb(200,200,150);
		height: 500px;
		max-height: 70%;
		overflow-y: auto;
		margin-top: 3px;
	}
	.feature {
		text-align: left;
		padding: 5px;
		font-style: italic;
		border: dotted 1px rgb(100,100,100);
		margin-bottom: 2px;
	}
	.backgroundContainer {
		width: 100%;
		height: 100%;
		overflow: hidden;
		display: none;
		position: absolute;
		background-color: rgba(100,100,100,0.5);
	}
	.mainContainer {
		width: 80%;
		height: 80%;
		margin-top: 70px;
		margin-left: 10%;
		margin-right: 10%;
		background-color: rgb(250,250,250);
		display: none;
		position: absolute;
	}
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
				<select style="width: 160px;">
				<?php foreach ($row as $r):?>
					<option  value= '<?php echo $r->city ?>'><?php echo $r->cityName ?></option>
				<?php endforeach ?>
				</select>
			</div>
			<div class="clear"></div>
			<div class="cell">Restaurant:</div>
			<div class="cell">
				<input id="restaurant_key" type="text" style="width: 160px;" />
				<input id="search_button" type="button" value="Search"/>
			</div>	
			<div class="clear"></div>
		</div>
	</div>
	<hr/>
	<div id="features_list">
		<hr/>
		<span style="text-align: center; display: inline-block;width: 100%;">Features</span>
		<hr/>
	</div>
	<div id="restaurants">
	<hr/>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		<div class="restaurantCell">
			<div class="name">Name</div>
			<div class="city">City</div>
			<div class="features">
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
				<div class="feature">Feature</div>
			</div>	
		</div>
		
		<div class="clear"></div>
	<hr/>
	</div>
</body>
</html>