<html>
<?php foreach ($restaurant_name as $row) {?>
	<div align="center" class=''><?php echo $row->restaurant_name?></div>

<?php }?>

	<div align="center"><?php echo $city?></div>
	<br>
	<br>
<?php foreach ($data as $feature) {?>
	<div class=''><input type='checkbox' value='<?php echo $feature->feature_id?>'><?php echo $feature->feature_name?></input></div>

<?php }?>


<html>