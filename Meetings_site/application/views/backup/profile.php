<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/main_style.css'?>"/>
	
	<script src="<?=base_url().'js/jquery.js'?>"></script>
	<script src="<?=base_url().'js/jquery-ui.js'?>"></script>
	<script src="<?=base_url().'js/jquery-timepicker.js'?>"></script>
	<script src="<?=base_url().'js/datepicker.js'?>"></script>




	<meta charset="utf-8">
	<title>Meetings website</title>
	


</head>

<body>

	<input id="baseurl" type="hidden" value="<?=base_url();?>">
	

	<div class="header_title">
		Profile
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
		
		<form id="profile" action="<?=base_url().'meetings/changeProfileData'?>" method="post">
			<table id="profile_table">
				
				<!--for example-->
				<input id="userid" name="userid" type="hidden" value="42">
				<!-- for example-->

				<tr>
					<td>Password</td>
					<td><input name="profile_pass" type="password" value=""/></td>
				</tr>
				
				<tr>
					<td>Confirm new password</td>
					<td><input name="profile_pass_confirm" type="password" value=""/></td>
				</tr>
				
				<tr>
					<td>First Name</td>
					<td><input name="profile_fname" type="text" value=""/></td>
				</tr>
				<tr>
					<td>Second Name</td>
					<td><input name="profile_sname" type="text" value=""/></td>
				</tr>
				<tr>
					<td>Contact info</td>
					<td><input name="profile_contact" type="text" value=""/></td>
				</tr>
				
				<tr>
					<td>
						<?=form_submit('mysubmit', 'Apply changes')?>
					</td>
					<td>
						<?=form_reset('reset', 'Reset')?>
					</td>
				</tr>
				
			</table>
		</form>
	
	</div>
	
	



</body>
</html>