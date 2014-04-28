	<div class="header_title">
		My events
	</div>
	
	
	
	<div class="page_content">
		
		<div class="tabs">
			<a href="#organized" id="org_link" class="tab_link">My own events</a>
			<a href="#participated" id="part_link" class="tab_link">Events where I am participated</a>
		</div>
		
		<!--organized meetings-->
		<div class="blocks_container" id="organized">
			<h3>My own events</h3>
			
			<?php if(isset($organized)): ?>
				<div class="meetings_filter_results">
				<?php foreach($organized as $meeting):?>	
					
						<div class="meeting_row_list">
							
							<div class="meeting_avatar">
								<?php if ($meeting['m_avatar']!=""):?>
									<img src="<?=base_url()."avatars_m/".$meeting["m_avatar"]?>"/>
								<?php else: ?>
									<img src="<?=base_url()."avatars_m/nophoto.jpg"?>"/>
								<?php endif?>	
							</div>
						
						
						
							<div class="meeting_cell_list_left">
								
								<a class="meeting_link" id="<?=$meeting['m_id']?>" href="<?=base_url()."meetings/showMeetingDetails/".$meeting['m_id']?>">								
									<?=$meeting['summary']?>
								</a>
								
								<div class="meeting_dates">
									<?=$meeting["m_startdate"]." - ".$meeting["m_enddate"]?>
								</div>
								
								<div class="meeting_location">
									<?=$meeting["location"]?>
								</div>
								
							</div>
							
							
							
							
							<div class="meeting_cell_list_right">
								
								<span class="participators_link">
									View participators
								</span>
							</div>
							
						</div>

				<?php endforeach; ?>
				</div>
			<?php endif; ?>
			
			
			
		</div>
	
	
		<!--participated meetings-->
		<div class="blocks_container unvisible" id="participated">
			
			
			
			<h3>Events where I am participated</h3>
			
			<?php if(isset($participated)): ?>
				<div class="meetings_filter_results">
				<?php foreach($participated as $meeting):?>	
					
						<div class="meeting_row_list">
						
							<div class="meeting_avatar">
								<?php if ($meeting['m_avatar']!=""):?>
									<img src="<?=base_url()."avatars_m/".$meeting["m_avatar"]?>"/>
								<?php else: ?>
									<img src="<?=base_url()."avatars_m/nophoto.jpg"?>"/>
								<?php endif?>	
							</div>
						
						
						
							<div class="meeting_cell_list_left">
								<a class="meeting_link" id="<?=$meeting['m_id']?>" href="<?=base_url()."meetings/showMeetingDetails/".$meeting['m_id']?>">								
									<?=$meeting['summary']?>
								</a>
								
								<div class="meeting_dates">
									<?=$meeting["m_startdate"]." - ".$meeting["m_enddate"]?>
								</div>
								
								<div class="meeting_location">
									<?=$meeting["location"]?>
								</div>
							</div>

							
						</div>

				<?php endforeach; ?>
				</div>
			<?php endif; ?>
			
			
			
			
			
			
			
			
			
			
			
		</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
		
		
		<div id="participants" class="unvisible">
							<div id='loading'>
								<img src="<?=base_url('img/gifs/loading.gif')?>">
							</div>
							<div id="participants_list" class="unvisible">
							</div>
		</div>
	
	
	
	
	</div> <!--page content-->