<!DOCTYPE html>
<html lang="en">
<head>
	<!--<meta charset="utf-8"/>-->
	<meta http-equiv="content-type" content="text/html; charset=<?php echo config_item('charset');?>" />
	
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/main_style.css'?>"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/jquery-ui.css'?>"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url().'css/bootstrap.css'?>"/>



	<script src="<?=base_url().'js/jquery.js'?>"></script>
	<script src="<?=base_url().'js/jquery-ui.js'?>"></script>
	<script src="<?=base_url().'js/timepicker_addon.js'?>"></script>
	
	<script src="<?=base_url().'js/common.js'?>"></script>
	<script src="<?=base_url().'js/datepicker.js'?>"></script>
	<script src="<?=base_url().'js/users_autocomplete.js'?>"></script>
	<script src="<?=base_url().'js/participation.js'?>"></script>
	<script src="<?=base_url().'js/registration.js'?>"></script>
	<script src="<?=base_url().'js/mymeetings.js'?>"></script>
	<script src="<?=base_url().'js/viewparticipators.js'?>"></script>
	<script src="<?=base_url().'js/disable_empty_forms.js'?>"></script>


	
	<title>Events website</title>
	


</head>
<body>


	<!-- Hiddens common inputs -->
	<input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
	<?php if(isset($this->session->userdata['u_id'])):?>
		<input type="hidden" id="user_ID" name="user_ID" value="<?=$this->session->userdata['u_id']?>">
	<?php endif; ?>
	
	<div class="bodyblock">