	<div class="header_title">
		Your profile
	</div>



	<div class="page_content">
		
			<div class="prof_img_avatar">
			<?php 
				echo "<img src='".base_url()."avatars/".$user['u_avatar']."'/>";
			?>
			</div>




		<form id="profile" action="" method="post" enctype="multipart/form-data">
			<div class="updatePass">
				<a href="<?=base_url()?>meetings/updatePassFromProfile">Update Password >></a>
			</div>
			
			
			<table id="profile_table">

				<tr>
					<td>Avatar</td>
					<td colspan="2">
						<input class="form-control" type="file" name="profile_avatar" size="20" value="" />
					</td>
				</tr>


				<tr>
					<td>First Name</td>
					<td>
						<input class="form-control" name="profile_fname" type="text"  value="<?=$user['u_firstname']?>"/>
					</td>
					<td><?=form_error('profile_fname')?></td>
				</tr>
				
				<tr>
					<td>Last Name</td>
					<td>
						<input class="form-control" name="profile_sname" type="text" value="<?=$user['u_lastname']?>"/>
					</td>
					<td><?=form_error('profile_sname')?></td>
				</tr>
				<tr>
					<td>Contact info</td>
					<td>
						<input class="form-control" name="profile_contact" type="text"  value="<?=$user['u_contact']?>"/>
					</td>
					<td><?=form_error('profile_contact')?></td>
				</tr>
				
				
				
			</table>
		
		
	




			<div class="prof_submit">
		        	<button class="btn btn-primary btn-block" type="submit">
		        		Apply changes
		        	</button>
		    </div>
		        
		    <div class="prof_back">
		    	<a href="<?=base_url().'meetings'?>" style="text-decoration:none">
			        <button class="btn btn-block" type="button">
			        	Back to main page
			        </button>
			    </a>
			</div>



		</form>




	</div>
	

	

