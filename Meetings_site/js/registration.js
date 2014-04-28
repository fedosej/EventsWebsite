//two buttons:
// 1) reg_participator
// 2) cancel_participator
// PHP method Registration - pass registration value TRUE or FALSE
// 


$(function() {

	var base_url=$('#base_url').val();

	$(document).on('click', '#reg_participator, #cancel_participator', function(){
		
			//insert loading image
			$("<div id='loading'><img src='"+base_url+"/img/gifs/loading.gif' /></div>").appendTo(".user_and_meeting_actions");

			//check button has been clicked - participation OR cancel
			buttonID=$(this).attr('id');
			phpMethodName='registrationInMeeting';
			switch(buttonID){
            	case 'reg_participator': 
            		alternateButtonID='cancel_participator';
					alternateButtonClass='btn btn-block';
            		alternatebuttonValue='Cancel registration';
            		messageText='Registration successful!';
            		registerValue=1;
            		break;

                case 'cancel_participator': 
                	alternateButtonID='reg_participator';
					alternateButtonClass='btn btn-primary btn-block';
            		alternatebuttonValue='Register participator';
            		messageText='You canceled your participation on this meeting!';    	
                	registerValue=0;
                	break;
          	}
			
			/*
			console.log($('#meeting_ID').val());
			console.log($('#user_ID').val());
			console.log(registerValue);
			*/
			
			$.ajax({
					 url: base_url+"ajax_controller/"+phpMethodName,
					 type: 'GET',
					 dataType: 'json',
					 data:{
					 	'meetingID':$('#meeting_ID').val(),
					 	'userID':$('#participator_ID').val(),
					 	'registerValue':registerValue				 	
					 },
					 
					 success: function(data){
					 		if(data['updated']==true){
					 				//if row hase been inserted change button
							 		$('.message').removeClass('.message').addClass('ajax_message').text(messageText);
							 		alternatebutton="<input id='"+alternateButtonID+"' type=button value='"+alternatebuttonValue+"' class='"+alternateButtonClass+"' />";
							 		$(alternatebutton).insertAfter("#"+buttonID);
							 		$('#'+buttonID).remove();
					 		}
					 		else{
						 		alertBlock='<p>An error has occured.<br>Please reload window and check registration status again!</p>';
						 		generateAlertDialog('Oops...', alertBlock);
						 	}

					 		//remove loading image after registration
							$('#loading').remove();
					 } //end success
				 	
			}); //end ajax
			


			

	}); //end click enevt on button



}); //end document ready


//----------------------functions---------------
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

} // end generate dialog function


