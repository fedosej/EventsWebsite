	<div class="header_title">
		Log-in
	</div>
	
	<div class="page_content">
		
	


		<form class="form-signin" id="login" method="post" action="">
	        


	        <h2 class="form-signin-heading">Please Log in</h2>
	        
	        <input type="text" name="login_email" value="<?=set_value('login_email')?>" class="form-control" placeholder="Email address" autofocus> <?=form_error('login_email')?>
	        
	        <input type="password" name="login_pass" value="<?=set_value('login_pass')?>" class="form-control" placeholder="Password"> <?=form_error('login_pass')?>
	        
	        <button class="btn btn-lg btn-primary btn-block" type="submit">
	        	Sign in
	        </button>
			
			
				
			<?php if($wrongPass==true):?>
				<div class="WrongPassBlock">
					Wrong Email/Password! Please Try again
				</div>
			<?php endif;?>
			
			<div class="recover_pass">
				<a href="<?=base_url()?>meetings/requestPassRecover">
					Recover password
				</a>
			</div>
			<?php if($mailSent!=null):?>
				
				<?php if($mailSent=="true"):?>
					<div class="message_sent">
						A message with instructions was sent on your email.
					</div>
				<?php elseif($mailSent=="false"):?>
					<div class="WrongPassBlock">
						Unable to find registered user with such email Please check email adress again
					</div>
				<?php endif;?>
				
			<?php endif;?>
			
			
			
			
			
	    </form>
	
		
	
	
	
	
	
	
	</div> <!--end page content-->
	
