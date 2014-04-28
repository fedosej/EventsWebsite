	<input type="hidden" id="meetingID" name="meetingID" value="<?=$data['m_id']?>">
	
	<div class="header_title">
		Event:<br>
		<?=$data["m_summary"]?>
	</div>
	
	<?php //print_r($daysToMeeting)?>
	
	<div class="page_content">
			<?php echo "<img src='".base_url()."avatars_m/".$data['m_avatar']."'/>";?>
			<div id="md_content">
							
							<?php if(isset($this->session->userdata['u_id'])):?>									
								<div class="meetings_block_actions">
									

										<?php if($data['m_owner']==$this->session->userdata['u_id']):?>
											<div class='message'>
												This is your event
											</div>
											<?php if($finished==false):?>
												<div class='message' id="edit_meeting_message">Click on pencil icon to edit data of your event</div>
												<a class='edit_icon' href="<?=base_url()?>meetings/editMyMeeting/<?=$data['m_id']?>"><img src="<?=base_url()?>img/edit.png"/></a>
												<br>
											<?php endif; ?>
										
										
										<?php elseif($finished==false && $participated==false):?>
											<div class='message'>
												You can participate on this event
											</div>
											<input id='participate' class='btn btn-primary btn-block' type='button' value='Participate'/>
										<?php elseif($finished==false && $participated==true):?>
											<div class='message'>
												You already participated on this event!
											</div>
											<input id='cancel_participation' class='btn btn-block' type='button' value='Cancel participation' />
											
										<?php endif?>
								
								</div> 
							<?php endif ?>
							
							
							
							<input type="hidden" name="meeting_ID" id="meeting_ID" value="<?=$data["m_id"]?>" />
								
							<div class="md_block">
								<div class="meetings_headers">
									Organizer:
								</div>
								<div id="md_organizer" class="md_value_org">
									<?=$data['u_lastname']." ".$data['u_firstname']; ?>
								</div>
							</div>
							
							<div class="md_block">
								<div class="meetings_headers">
									Start Date:
								</div>								
								<div id="md_startdate" class="md_value"><?=$data['m_startdate']?></div>
							</div>									
								
							
							<div class="md_block">
								<div class="meetings_headers">			
									End Date:
								</div>
								<div id="md_enddate" class="md_value"><?=$data['m_enddate']?></div>
							</div>									
								
								
							<div class="md_block">	
								<div class="meetings_headers">		
									Location:
								</div>
								<div id="md_location" class="md_value"><?=$data['m_location']?></div>
							</div>
								
								
							<div class="md_block">
								<div class="meetings_headers" >			
									About:
								</div>
								<div id="md_desc" class="md_value"><?=$data['m_desc']?></div>
							</div>
							
				
			</div>
			
			
			
			
	</div>
	