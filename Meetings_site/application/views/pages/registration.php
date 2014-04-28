	<div class="header_title">
		Registration
	</div>
	
	<div class="page_content">
	

		<form class="form-reg" id="registration" method="post" action="" enctype="multipart/form-data">
	        
	        <h2 class="form-reg-heading">Create new account</h2>
	        
	        <table id="registration_table">
				
				<tr>
					<td>Login/Email</td>
					<td>
						<input class="form-control" name="reg_email" type="text" value="<?=set_value('reg_email')?>"/>
					</td>
					<td><?=form_error('reg_email')?></td>
				</tr>
				
				
				<tr>
					<td>Password</td>
					<td>
						<input class="form-control" name="reg_pass" type="password" value=""/>
					</td>
					<td><?=form_error('reg_pass')?></td>				
				</tr>
				
				<tr>
					<td>Confirm Password</td>
					<td>
						<input class="form-control" name="reg_pass_confirm" type="password" value=""/>
					</td>
					<td><?=form_error('reg_pass_confirm')?></td>
				</tr>
				

				<tr>
					<td>Avatar</td>
					<td colspan="2">
						<input class="form-control" type="file" name="reg_avatar" size="20" value="" />
					</td>
				</tr>

				<tr>
					<td>First Name</td>
					<td>
						<input class="form-control" name="reg_fname" type="text" value="<?=set_value('reg_fname')?>"/>
					</td>
					<td><?=form_error('reg_fname')?></td>
				</tr>
				
				<tr>
					<td>Last Name</td>
					<td>
						<input class="form-control" name="reg_sname" type="text" value="<?=set_value('reg_sname')?>"/>
					</td>
					<td><?=form_error('reg_sname')?></td>
				</tr>


				<tr>
					<td>Contact info</td>
					<td>
						<input class="form-control" name="reg_contact" type="text" value="<?=set_value('reg_contact')?>"/>
					</td>
					<td></td>
				</tr>
				
				
				
			</table>
	        
	        <div class="reg_submit">
	        	<button class="btn btn-primary btn-block" type="submit">
	        		Create new account
	        	</button>
	    	</div>
	        
	        <div class="reg_reset">
		        <button class="btn btn-block" type="reset">
		        	Reset
		        </button>
		   	</div>



	    </form>



	</div> <!--end page content-->
	
