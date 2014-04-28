

$(function(){
	
	var base_url=$('#base_url').val();
	
	

	$(document).on('click', '.participators_link', function(){
			
			//save clicket meet ID
			// !!!! do not rename this variable
			meetID=$(this).parent("div").parent("div").find(".meeting_link").attr("id"); 
			
			//show block
			$("#participants").addClass("visible");
			
			//convert block to modal window
			$( "#participants" ).dialog({
				width: 500,
				modal: true,
				position:['middle', 0],
				title: $("#"+meetID).parents(".meetings_block").find(".meetings_block_content").html(),
				buttons: [ 
					{ 
						text: "Close window", 
						click: function() { 
							$( this ).dialog( "close" ); 
						} 
					} 
				],
				close:function(){
					$("#participants_list").text("");
				}
			}); //end dialog
			
			//call list with participants through ajax 
			phpMethodName="viewParticipants";
			$.ajax({
					 url: base_url+"ajax_controller/"+phpMethodName,
					 type: 'GET',
					 dataType: 'json',
					 data:{
					 	'meetingID':meetID,	 	
					 },
					 
					 success: function(data){
						//remove loading image
						$("#loading").remove();
						
						//open bloc contents
						$("#participants_list").addClass("visible");
						
						//insert participants
						if(data.length!=0){
							participant="";
							$.each(data, function(item, val){
								participant+=val['u_lastname']+" "+val["u_firstname"]+" ("+val["u_email"]+")";
								if (item != data.length-1){
									participant+=", <br>"
								}
							})
							list=participant;
						}
						else{
							list="There are no participants at the moment";
						}
						
						$("#participants_list").html(list);
					 } //end success

					
			}); //end ajax
			
			
			
			
	}); //end click event

	
	
	
}); //end document ready










