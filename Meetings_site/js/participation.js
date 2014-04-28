//two buttons:
// 1) participate
// 2) cancel participation

$(function(){
		meetingID=$("#meetingID").val();
		userID=$('#user_ID').val();
		var base_url=$('#base_url').val();

		$(document).on('click', '#participate, #cancel_participation', function(){

			
			
			//check button has been clicked - participation OR cancel
			buttonID=$(this).attr('id');
			switch(buttonID){
            	case 'participate': 
            		alternateButtonID='cancel_participation';
					alternateButtonClass='btn btn-block';
            		alternatebuttonValue='Cancel participation';
            		messageText='Participation successful!<br> An QR image has been sent on your email address. Please keep this image.';
            		phpMethodName='newParticipation';
					confirmBlock="<p>Please confrm your participation</p>"
            		break;
                case 'cancel_participation': 
                	alternateButtonID='participate';
					alternateButtonClass='btn btn-primary btn-block';
            		alternatebuttonValue='Participate';
            		messageText='You canceled your participation on this meeting!';
                	phpMethodName='cancelParticipation';
					confirmBlock="<p>Are you really want to cancel your participation?</p>"
                	break;
          	}

			//confirm that user was cliecked
			$(confirmBlock).dialog({ 				 	
					buttons: [ 
						{ 
							text: "Yes", 
							click: function() { 
									//user confirmed his click
									
									//insert loading image
									$("<div id='loading'><img src='"+base_url+"/img/gifs/loading.gif' /></div>").appendTo(".meetings_block_actions");
									
									$.ajax({
											 url: base_url+"ajax_controller/"+phpMethodName,
											 type: 'GET',
											 dataType: 'json',
											 data:{
												'meetingID':meetingID,
												'userID':userID				 	
											 },
											 
											 success: function(data){
												//check if row has been inserted/removed succesfully
												if(data['check_result']==true){
													//if row hase been inserted change button
													$('.message').removeClass('.message').addClass('ajax_message').html(messageText);
													alternatebutton="<input id='"+alternateButtonID+"' class='"+alternateButtonClass+"'type=button value='"+alternatebuttonValue+"' />";
													$(alternatebutton).insertAfter("#"+buttonID);
													$('#'+buttonID).remove();
													
													qrblockID='qr_block';
													$('#'+qrblockID).remove();

													//if articipation button, generate link and create  QR image
													if(phpMethodName=='newParticipation'){
													}
													
												}
												//if error has been occured during insert/remove row
												else{
													alertBlock='<p>An error has occured.<br>Please close window and check participation status again!</p>';
													generateAlertDialog('Oops...', alertBlock);
												}
												//all elements has been loaded. Remove loading image
												$('#loading').remove();
												
											 } //end success
									}); //end ajax
								$(this).dialog( "close" ); 
							}
						}, //end Yes button
						{ 
							text: "No", 
							click: function() { 
								$(this).dialog( "close" ); 
							} 
						} // end No button
					],
					resizable: false,					
					draggable:false,					
					modal: true,					
					title: "",
			}); //end Confirm dialog
		}); //end click event


});

//----------------------VARIABLES and FUNCTIONS--------------------------



function generateAlertDialog(titleString, messageBlock){
		$(messageBlock).dialog({ 				 	
				 	buttons: {
					    "OK": function() {
					    $(this).dialog("close");
					    }
				    }, //end buttons					
					resizable: false,					
					draggable:false,					
					modal: true,					
					title: titleString,
		}); //end dialog

} // end generate Alert dialog function



function generateConfirmDialog(titleString, messageBlock){
		$(messageBlock).dialog({ 				 	
					buttons: [ 
						{ 
							text: "Yes", 
							click: function() { 
								
							} 
						},
						{ 
							text: "No", 
							click: function() { 
								$(this).dialog( "close" ); 
							} 
						} 
					],
					resizable: false,					
					draggable:false,					
					modal: true,					
					title: titleString,
		}); //end dialog

} // end generate Confirm dialog function










	


