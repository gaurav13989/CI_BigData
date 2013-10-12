<div id = "uploadBox">
	Upload file<br/><br/>
	<?php 
	if(!empty($error))
	foreach ($error as $err) {
		echo '<span style="color: red;">'.$err.'</span>';
	} ?>
	<?php echo form_open_multipart('data_load/upload');?>
		<div class = "cell">
			Enter city name(only for uploading "City Restaurant Feature List" file): <input type="text" name="cityName"/><br/>
			Choose a file: <input type="file" name="userfile"/><br/>
			<div style="width: 520px; display: inline-block;"></div><input type="submit" value="Submit"/>
		</div>
		<div class="clear"></div>
	</form><br/>
	Please note the following before uploading a new file.
	<ul>
		<li>For New York City if the name of the file is new_york.txt, New York City initials would be 'ny'</li>
		<li>For the city of Atlanta if the name of the file is atlanta.txt, the initials would be 'at'</li>
		<li></li>
		<li>Check the list of already uploaded cities for
			<ol>
				<li>If the new city that is being uploaded has the same initials as any of the already uploaded files listed below, change the file name approproately</li>
				<li>If the file is intended to replace an existing city feature list, delete the feature list before uploading</li>
			</ol>
		</li>
	</ul>
	<i>If after uploading, the file doesn't appear in the list of files below, there was an error while either uploading or loading the file data into the database. Please check the data structuring in the file<br/>
	For uploading the list of features that a restaurant can have please make sure the file has data in the format<br>
	<div style="width: 30px; display: inline-block"></div>&lt;feature_id&gt;&lt;tab&gt;&lt;feature_name&gt;<br/>	
	For uploading a list of hotels in a city with their features make sure the file has data in the format<br/>
	<div style="width: 30px; display: inline-block"></div>&lt;restaurant_id&gt;&lt;tab&gt;&lt;restaurant_name&gt&lt;tab&gt;&lt;feature_id&gt;&lt;space&gt;&lt;feature_id&gt;&lt;space&gt;&lt;feature_id&gt;... and so on</i>
</div>
<div id="deleteBox">
	Delete File
	<ul>
		<li>The features list file with feature_id - feature_name cannot be deleted until all other files have been deleted</li>
		<li>To download the uploaded txt files click on the hyperlinked file names below</li>
		<li>To delete a file and all records that were inserted because of the file, click on delete
			<ul>
				<li>This action is irreversible</li>
				<li>You may have to clean the uploaded data again</li>
				<li>Please be sure of what you are doing</li>
			</ul>
		</li>
	</ul>
	<div class="record">
		<div class="cell">File name</div>
		<div class="cell">City name</div>
		<div class="cell">City initials</div>
		<div class="cell">Delete records</div>
		<div class="clear"></div>
	</div>
	<?php foreach($uploadedfile as $file) { // loop begin?>
	<div class="record">
		<div class="cell"><?php echo $file->fileName?></div><?// hyperlinked filename?> 
		<div class="cell"><?php echo $file->cityName?></div><?// full city name?>
		<div class="cell"><?php echo $file->city?></div><?// city initials?>
		<div class="cell"><input type="button" value="DELETE" class="deleteBtn"/></div><?// delete button?>
		<div class="clear"></div>
	</div>
	<?php } // for loop end?>
</div>
<div class="clear"></div>