<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/main_style.css'?>"/>

	




	<meta charset="utf-8">
	<title>Meetings website</title>
	


</head>

<body>

	<input id="baseurl" type="hidden" value="<?=base_url().'meetings/regsitration'?>">

	<div class="header_title">
		Registration
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
		
		<form id="registration" action="" method="post">
			<table id="registration_table">
				
				<tr>
					<td>Login/Email</td>
					<td><input name="reg_email" type="text" value="<?=set_value('reg_email')?>"/><?=form_error('reg_email')?></td>
				</tr>
				
				<tr>
					<td>Password</td>
					<td>
						<input name="reg_pass" type="password" value=""/><?=form_error('reg_pass')?></td>
				</tr>
				
				<tr>
					<td>Confirm Password</td>
					<td><input name="reg_pass_confirm" type="password" value=""/><?=form_error('reg_pass_confirm')?></td>
				</tr>
				
				<tr>
					<td>First Name</td>
					<td><input name="reg_fname" type="text" value="<?=set_value('reg_fname')?>"/><?=form_error('reg_fname')?></td>
				</tr>
				<tr>
					<td>Second Name</td>
					<td><input name="reg_sname" type="text" value="<?=set_value('reg_sname')?>"/><?=form_error('reg_sname')?></td>
				</tr>
				<tr>
					<td>Contact info</td>
					<td><input name="reg_contact" type="text" value="<?php echo set_value('reg_contact')?>"/>
					<br><?php echo form_error('reg_contact')?></td>
				</tr>
				
				<tr>
					<td>
						<?//=form_submit('mysubmit', 'Create new account')?>
						<input type="submit" value="Create new account"/>
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