<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/main_style.css'?>"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/jquery-ui.css'?>"/>
	


	<script src="<?=base_url().'js/jquery.js'?>"></script>
	<script src="<?=base_url().'js/jquery-ui.js'?>"></script>
	<script src="<?=base_url().'js/jquery-timepicker.js'?>"></script>
	<script src="<?=base_url().'js/datepicker.js'?>"></script>
	<script src="<?=base_url().'js/timepicker.js'?>"></script>

	<meta charset="utf-8">
	<title>Meetings website</title>
	


</head>

<body>

	<input id="baseurl" type="hidden" value="<?=base_url();?>">

	<div class="header_title">
		Create new meeting
	</div>

	<div class="header_menu">
	
  			<div class="header_item_menu_left">
  				<div class="item_left">Main Page</div>
  				<div class="item_left">Create Meeting</div>
				<div class="item_left">List of Meetings</div>
			</div>
			

			<div class="header_item_menu_right">
  				<div class="item_right">Registration</div>
  				<div class="item_right">Login</div>
				<div class="item_right">Profile</div>
  			</div>
			
			
			
			
			
	</div>
	
	<div class="page_content">
		
		<form id="create_meeting" action="<?=base_url().'meetings/newMeeting'?>" method="post">

 
			<table id="create_meeting_table">
				
				<tr>
					<td>Summary</td>
					<td><input name="meeting_summary" type="text" value=""/></td>
				</tr>
				<tr>
					<td>Location</td>
					<td><input name="meeting_location" type="text" value=""/></td>
				</tr>


				<tr>
					<td>Date and Time</td>
					<td>
						<input id="meeting_date" name="meeting_date" type="text" value=""/>

					</td>
				</tr>
				<tr>
					<td>Description</td>
					<td><textarea name="meeting_description" rows=7 cols=40 wrap="hard"></textarea></td>
				</tr>
				<tr>
					<td>
						<?=form_submit('mysubmit', 'Create meeting')?>
					</td>
					<td>
						<?=form_reset('reset', 'Reset')?>
					</td>
				</tr>
				
			</table>
		</form>
	
	</div>
	
	<pre>
	<?
		//print_r($data);
	?>
	</pre>


</body>
</html>