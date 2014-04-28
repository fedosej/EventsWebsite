

	<!--hidden inputs-->
	<!--<input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">-->
	<input type="hidden" id="meeting_ID" name="meeting_ID" value="<?=$meeting['m_id']?>">
	
	


	<div class="header_title">
		Information about participator and event
	</div>	
	
	
	<div class="page_content">
	
			<div class="middleblock">
				<div class="info_title">
					Event information
				</div>
				
				<div class="info">
					<img src="<?=base_url()?>/avatars_m/<?=$meeting['m_avatar']?>"/>
					<div class="info_data">
						Event: <?=$meeting['m_summary']?>
						<br>
						About: <?=$meeting['m_desc']?>
						<br>
						Organizer: <?=$meeting['u_firstname']." ".$meeting['u_lastname']?>
						<br>
						Occurs in <?=$meeting['m_location']?>
						<br>
						From: <?=$meeting['m_startdate']?> To: <?=$meeting['m_enddate']?>
					</div>
				</div>
				
				<hr>
				
				<div class="info_title">Participator information</div>
				
				<div class="info">
					<input type="hidden" name="participator_ID" id="participator_ID" value="<?=$user['u_id']?>" />
					<div class="info_avatar">
							<?echo "<img src='".base_url()."avatars/".$user['u_avatar']."'/>";?>
					</div>
					
					<div class="info_data">
						User Initials: <?=$user['u_firstname']." ".$user['u_lastname']; ?>
						<br>
						User email: <?=$user['u_email']?>
						<br>
						User contact: <?=$user['u_contact']?>
					</div>
				
				</div>

				<?php if($this->session->userdata['u_id']==$meeting['m_owner']):?>
				<!--<div class="user_and_meeting_actions">-->
						<?php if($registered==false):?>
							<div class="message">
								Register participator:
							</div>
							<input type="button" id="reg_participator" class="btn btn-primary btn-block" value="Register participator">
						<?php else: ?>
							<div class="message">
								Participator already registered!
							</div>
							<input type="button" id="cancel_participator" class="btn btn-block" value="Cancel registration">
						<?php endif; ?>	

				<!-- </div> -->
				<?php endif; ?>
				
			</div> <!--middle Block-->
	</div>

	

		

			
		







