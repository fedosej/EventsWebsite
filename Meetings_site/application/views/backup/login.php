<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/main_style.css'?>"/>
	



	<meta charset="utf-8">
	<title>Meetings website</title>
	


</head>

<body>

	<input id="baseurl" type="hidden" value="<?=base_url();?>">

	<div class="header_title">
		Log-in
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
		
		<form id="login" action="<?=base_url().'meetings/loginUser'?>" method="post">
			<table id="login_table">
				
				<tr>
					<td>Login</td>
					<td><input name="login_login" type="text" value=""/></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input name="login_pass" type="text" value=""/></td>
				</tr>
				
				
				<tr>
					<td>
						<?=form_submit('mysubmit', 'Log-in')?>
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