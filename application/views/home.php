<div id = "uploadBox">
	Upload file<br/><br/>
	<?php 
	if(!empty($error))
	foreach ($error as $err) {
		echo '<span style="color: red;">'.$err.'</span>';
	} ?>
	<?php echo form_open_multipart('data_load/upload');?>
		<div class = "cell">
		Enter city name: <input type="text" name="cityName"/><br/>
		Choose a file: <input type="file" name="userfile"/><br/>
		<div style="width: 270px; display: inline-block;"></div><input type="submit" value="Submit"/>
		</div>
		<div class="clear"></div>
	</form><br/>
	Please note the following before uploading a new file.
	<ol>
	<li>Check the list of already uploaded cities
	<li>If the new city that is being uploaded has the same initials change the file name approproately
	<li>If the file is intended to replace an existing city feature list, delete the feature list before uploading
	<li>Example: For New York City if the name of the file is new_york.txt, New York City initials will be considered as 'ny'
	<li>Example: For the city of Atlanta if the name of the file is atlanta.txt, the initials will be considered as 'at'	
	</ol>
</div> 
<div id="deleteBox">
	<div class="record">
		<div class="cell">City name</div>
		<div class="cell">City initials</div>
		<div class="cell">Delete records</div>
		<div class="clear"></div>
	</div>
	<?php // for loop begin?>
	<div class="record">
		<div class="cell"></div>
		<div class="cell"></div>
		<div class="cell"></div>
		<div class="clear"></div>
	</div>
	<?php // for loop end?>
</div>
<div class="clear"></div>