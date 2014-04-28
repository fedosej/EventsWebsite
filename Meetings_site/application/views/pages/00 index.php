
	
	<div class="header_title">
	<!--
		<div class="header_title_float">
			<img src="<?=base_url()?>/img/qrcode_3d_small.jpg">
		</div>
	-->
			Main page

	
	</div>
	
	<div id="main_pic">
		<img src="<?=base_url()?>/img/qrcode_3d.jpg">
	</div>
	
	<div class="page_content">
		<div id="about">
			<p>
				Welcome to events site. On this site you can create your own event as well as participate to another event. 
				<br>
				After you participated on event a QR code image will be sent on your email address. Please keep this image, it will help organizer to control participants.
			</p>
			<?php if(!isset($this->session->userdata['u_id'])):?>
			<p>
				Please login or create your account and start using our resource right now!
			</p>
			<?php endif?>
		</div>
			
		
			<form class="form-listofmeet" id="quick_search_filter" action="<?=base_url()?>meetings/quickSearch" method="post">
				<input type="text" name="keyword">
				<div class="btn_div">
					<button class="btn btn-primary btn-block" type="button" id="quick_search_button">
						Quick event search
					</button>
				</div>
				
			</form>
			
			<div class="res_info">Recently added events</div>
			
			
			
			
	

			<div class="first_page_meeting_container">
				<?php if(isset($data)): ?>
					<?php foreach($data as $meeting):?>	
						<div class="first_page_meeting">
							
							<div class="first_page_meeting_image">
									<?php if ($meeting['m_avatar']!=""):?>
										<img src="<?=base_url()."avatars_m/".$meeting["m_avatar"]?>"/>
									<?php else: ?>
										<img src="<?=base_url()."avatars_m/nophoto.jpg"?>"/>
									<?php endif?>	
							</div>
							
							<a class="first_page_meeting_link" href="<?=base_url()."meetings/showMeetingDetails/".$meeting['m_id']?>">
								<?=$meeting['summary']?>
							</a>
							
							
						</div>
							
						
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		

			
			
			
			
			
			
			
			<div class="blocks_container">
				<div class="main_page_meetings_block">
					
					<div class="btn_div">
						<a href="<?=base_url()?>/meetings/createNewMeeting">
						<button class="btn btn-primary btn-block" type="sybmit" id="new_meet_button">
								Create your own event
						</button>
						</a>
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
			
			
	</div>

