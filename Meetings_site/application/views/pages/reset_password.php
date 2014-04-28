	<div class="header_title">
		Reset password
	</div>
	
	<div class="page_content">
		
	


		<form class="form-resetpass" id="updatepass" method="post">
	        


	        <h2 class="form-signin-heading">Enter new password</h2>
	        <input type="hidden" name="user" value="<?=$user?>"/>
			
			
	        <input type="password" name="updatepass_pass" value="" class="form-control" autofocus> <?=form_error('updatepass_pass')?>
	        
	        <input type="password" name="updatepass_pass_confirm" value="" class="form-control"> <?=form_error('updatepass_pass_confirm')?>
	        
	        <button class="btn btn-lg btn-primary btn-block" type="submit">
	        	Set new password
	        </button>
			
			
	    </form>
	
		
	
	
	
	
	
	
	</div> <!--end page content-->
	
