	<div class="header_title">
		Discover events
	</div>
	
	<div class="page_content">
		
		
			<form class="form-listofmeet" id="meetings_filter" action="<?=base_url()?>meetings/searchMeetings" method="post">
						

				

						<table id="meetings_filter_table">
						
								<tr>
									<td>Summary</td>
									<td>
										<input class="form-control" name="meeting_summary" type="text" value=""/>
									</td>
								</tr>
								<tr>
									<td>Location</td>
									<td>
										<input class="form-control" name="meeting_location" type="text" value=""/>
									</td>
								</tr>

							
								<tr>
									<td>Start Date and time range</td>
									<td>
										
										<div class="dates_and_times">
											<div class="date_cont">
												<input class="form-control" id="meeting_startdate_from" name="meeting_startdate_from" type="text" value=""/>
												From
											</div>
											<div class="date_cont">
												<input class="form-control" id="meeting_startdate_to" name="meeting_startdate_to" type="text" value=""/>
												To
											</div>
										</div>
									</td>
									<td>
																			
											<span class="clear_date">
												Clear dates
											</span>
									</td>
								</tr>

								
								
								<tr>
									<td>End Date and time range</td>
									<td>
										
										<div class="dates_and_times">
											<div class="date_cont">
												<input class="form-control" id="meeting_enddate_from" name="meeting_enddate_from" type="text" value=""/>
												From
											</div>
											<div class="date_cont">
												<input class="form-control" id="meeting_enddate_to" name="meeting_enddate_to" type="text" value=""/>
												To
											</div>
										</div>

									</td>
									<td>
											<span class="clear_date">
												Clear dates
											</span>

									</td>
								</tr>
								
								
								
								
								
								
								
								
								<tr>
									<td>
										Organizer
									</td>

									<td>
										<input class="form-control" id="organizer" name="organizer" type="text"/>
										<br>
										<input id="organizer_ID" name="organizer_ID" type="hidden"/>
									</td>

								</tr>

								<tr>
									<td>
										Description
									</td>

									<td>
										<textarea class="form-control" name="meeting_description" rows="3" cols="50" wrap="hard"></textarea>
									</td>

								</tr>

							
						</table>

						<div class="listofmeet_buttons">
							<div class="listofmeet_submit">
						        	<button class="btn btn-primary btn-block" type="button" id="submit_filter">
						        		Find events
						        	</button>
						    </div>
						        
						    <div class="listofmeet_reset">
						    		<button class="btn btn-block" type="reset">
							        	Reset
							        </button>
							</div>
						</div>


						
			</form>
		

		<?php if($firstclick==true):?>
			<div class="res_info">Recently added events</div>
		<?php else:?>
			<div class="res_info">Found <?=count($data)?> event(s)</div>
		<?php endif;?>


			<div class="blocks_container">

			<?php if(isset($data)): ?>
				<div class="meetings_filter_results">
				<?php foreach($data as $meeting):?>	
					
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
								<?php if(isset($this->session->userdata['u_id']) && ($meeting['m_owner']==$this->session->userdata['u_id'])):?>
									<span class="participators_link">
									View participators
									</span>
								<?php endif?>
							</div>
							
						</div>

				<?php endforeach; ?>
				</div>
			<?php endif; ?>
		
			</div><!--blocks_container-->
			
			<!--for participants-->
			<div id="participants" class="unvisible">
							<div id='loading'>
								<img src="<?=base_url('img/gifs/loading.gif')?>">
							</div>
							<div id="participants_list" class="unvisible">
							</div>
			</div>
		
		
		

	</div> <!--end page content-->
