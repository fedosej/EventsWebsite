


<div class="header_menu">
	
  			<div class="header_item_menu_left">
			
				<a href="<?=base_url().'meetings'?>">
					<img class="item_left" src="<?=base_url()?>/img/qrcode_3d_extrasmall.jpg">
				</a>
				
  				<a href="<?=base_url().'meetings'?>">
  					<div class="item_left">Main Page</div>
  				</a>

  				<? if ($this->session->userdata('validated')): ?>
  				<a href="<?=base_url().'meetings/createNewMeeting'?>">
  					<div class="item_left">Create</div>
				</a>
				<? endif; ?>
				
				<a href="<?=base_url().'meetings/searchMeetings'?>">
					<div class="item_left">Discover Events</div>
				</a>
				
				<a href="<?=base_url().'meetings/about'?>">
					<div class="item_left">About</div>
				</a>
				
				
				<? if (!$this->session->userdata('validated')): ?>
						
						<a href="<?=base_url().'meetings/registration'?>">
							<div class="item_left">Register</div>
						</a>
					
						<a href="<?=base_url().'meetings/login'?>">
		  					<div class="item_left">Log-in</div>
		  				</a>


	  				<? else: ?>

		  				<a href="<?=base_url().'meetings/logout'?>">
		  					<div class="item_left">Logout</div>
		  				</a>
					
						<a href="<?=base_url().'meetings/myMeetings'?>">
							<div class="item_left">My events</div>
						</a>

						
		  				<a href="<?=base_url().'meetings/updateProfile'?>">
		  					<div class="item_left">Profile</div>
		  				</a> 
						


		  				

	  			<? endif; ?>
				
				
				
			</div>
			






						
</div>

<div style="display:none">

<?
	$this->meetings_model->print_arr($this->session->userdata);
?>
</div>