<script type="text/javascript">
$(function(){
	<?php
		foreach ($restaurants as $key => $value) {
			# code...
			?>
			var d='<div><?php echo $key?></div>';
			$('#similar_restaurants').append(d);
	<?php
		}
	?>
});
</script>
<html>
<body>
<div id='similar_restaurants'>
	<?php
		foreach ($restaurants as $key => $value) {
	?>
		<div><?php echo $key?></div>
	<?php
	}
	?>
</div>
</body>
</html>
