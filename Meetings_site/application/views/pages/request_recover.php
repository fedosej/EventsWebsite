	<div class="header_title">
		Request New Password
	</div>
	
	<div class="page_content">
		
	


		<form class="form-passrequest" id="pass_request" method="post" action="requestPass">
	        
			

	        <h2 class="form-signin-heading">Please Enter Your Email</h2>
	        
	        <input type="text" name="request_email" class="form-control" placeholder="Email address" autofocus> <?=form_error('request_email')?>
	        
			<div class="request_submit_block">
				<button class="btn btn-lg btn-primary btn-block" type="submit">
					Request new password
				</button>
			</div>
			
	    </form>
		


	
	</div> <!--end page content-->
	
