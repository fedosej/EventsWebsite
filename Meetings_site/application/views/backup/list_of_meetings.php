<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/main_style.css'?>"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/jquery-ui.css'?>"/>

	<script src="<?=base_url().'js/jquery.js'?>"></script>
	<script src="<?=base_url().'js/jquery-ui.js'?>"></script>
	<script src="<?=base_url().'js/datepicker.js'?>"></script>

	<meta charset="utf-8">
	<title>Meetings website</title>
	


</head>

<body>

	<input id="baseurl" type="hidden" value="<?=base_url();?>">

	<div class="header_title">
		List of meetings
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
	
	
		<form id="meetings_filter" action="<?=base_url().'meetings/findMeetings'?>" method="post">
			<h3>Meetings filter</h3>
			<table id="meetings_filter_table">
			
				<tr>
					<tr>
						<td>Summary</td>
						<td><input name="meeting_summary" type="text" value=""/></td>
					</tr>
					<tr>
						<td>Location</td>
						<td><input name="meeting_location" type="text" value=""/></td>
					</tr>


					<td>Date and Time</td>
					<td>
						<input id="meeting_date" name="meeting_date" type="text" value=""/>
					</td>
				</tr>
				
				<tr>
					<td>
						<?=form_submit('mysubmit', 'Find')?>
					</td>
					<td>
						<?=form_reset('reset', 'Reset')?>
					</td>
				</tr>
				
			</table>
			
		</form>
		
		
		<?if($data){		
		foreach($data['list_of_meetings'] as $meeting):?>	
		  
				<div class="meetings_block">
					What: <?=$meeting['m_summary']?><br>
					When: <?=$meeting['m_date']?><br>
					Where: <?=$meeting['m_location']?><br>
				</div>

		<? endforeach; } ?>


	
	</div>
	
	


</body>
</html>