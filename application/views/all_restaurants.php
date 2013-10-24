<html>
	<head>
	<script type="text/javascript" src=""></script>
	<style type="text/css">
		body{
			margin: 0;
			padding: 0;
		}
		#search{
			float:left;
			width: 100%;	
			height: 25%;
			border: solid 1px black;
		}
		#restaurants{
			height:75%;
			width: 74%;
			float: left;
			border: solid 1px black;
		}
		#features_list{
			float: left;
			width: 24%;
			height: 75%;
			border: solid 1px black;
		}
	#first{
		float: right;
		border: solid 1px black;
		width: 60%;
		height: 100%;
		
	}


	</style>
	</head>

	<body>
	<div id="title" align="center"><h1>RECCOMENDATION SYSTEM</h1></div>
	<div id="search">
		
	<div id="first">
	</br>
	</br>

		<div style="float:left">
		City:
	 
			<select>
					<?php foreach ($row as $r):?>
						<option  value= '<?php echo $r->city ?>'><?php echo $r->cityName ?></option>
					<?php endforeach ?>
					
			
			</select><br/>
		
		Restaurant:
		
			<input id="restaurant_key" type="text"></input><br/>
			<input id="search_button" type="button" value="Search">
		
		</div>

	</div>
	</div>
	<div id="features_list"></div>
	
	<div id="restaurants">
	
		<div id="1">
				Name:</br>
				Features:</br>	
		</div>
	
	
	
	</div>


	</body>
</html>