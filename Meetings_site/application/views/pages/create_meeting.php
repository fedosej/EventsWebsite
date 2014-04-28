
	<div class="header_title">
		Create event
	</div>
	

	<div class="page_content">
		
		<form class="form-newmeet" id="create_meeting" action="" method="post" enctype="multipart/form-data">

 
			<table id="create_meeting_table">
				
				<tr>
					<td>Summary</td>
					<td>
						<input class="form-control" name="meeting_summary" type="text" value="<?=set_value('meeting_summary')?>"/>
					</td>
					<td><?=form_error('meeting_summary')?></td>
				</tr>
				
				<tr>
					<td>Avatar</td>
					<td><input class="form-control" type="file" name="m_avatar" size="50" value="" /></td>
				</tr>
				
				
				<tr>
					<td>Location</td>
					<td>
						<input class="form-control" name="meeting_location" type="text" value="<?=set_value('meeting_location')?>"/>
					</td>
					<td><?=form_error('meeting_location')?></td>
				</tr>


				<tr>
					<td>
						Start Date and time
					</td>
					<td>
						<input class="form-control" id="meeting_startdate" name="meeting_startdate" type="text" value="<?=set_value('meeting_startdate')?>"/>
					</td>
					<td>
						<span class="clear_date">
							Clear date
						</span>
						<?=form_error('meeting_startdate')?>
					</td>
				</tr>
				
				<tr>
					<td>
						End Date and time
					</td>
					
					<td>
						<input class="form-control" id="meeting_enddate" name="meeting_enddate" type="text" value="<?=set_value('meeting_enddate')?>"/>
					</td>
					<td>
						<span class="clear_date">
							Clear date
						</span>
						<?=form_error('meeting_enddate')?>
					</td>
				</tr>
				
				<tr>
					<td>Description</td>
					<td>
						<textarea class="form-control" name="meeting_description" rows="10" cols="50" wrap="hard"><?=set_value('meeting_description')?></textarea>
					</td>
					<td>
						<?=form_error('meeting_description')?>
					</td>
				</tr>
								
			</table>

			<div class="newmeet_submit">
		        	<button class="btn btn-primary btn-block" type="submit">
		        		Create event
		        	</button>
		    </div>
		        
		    <div class="newmeet_reset">
		    		<button class="btn btn-block" type="reset">
			        	Reset
			        </button>
			</div>


		</form>
	


		










	</div> <!--page content-->
	
