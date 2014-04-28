$(function() {
	
			var base_url=$("#base_url").val();	
			
			$("#organizer").autocomplete({
				minLength: 3,
				source: function(request, response) {
					$.ajax({
						   url: base_url+"/ajax_controller/getUsers",
						   dataType: "json",
						   data: {
						   		term: request.term					                
						   },
						   
						   success: function(data) {
						    	response($.map(data, function(item) {
									//alert('aaa');
							     	return {
								      	//label: item.u_firstname +" "+ item.u_lastname,
								      	value: item.u_firstname +" "+ item.u_lastname,
								      	id: item.u_id
								      	
							     	}
						   		})) //end response
						   } //end success
					  
					  })//end ajax
				}, //end source
				
				select: function( event, ui ) {
					$('#organizer_ID').val(ui.item.id);
				},
								 
			}).on('keyup', function(){
				if($(this).val()==""){
					$('#organizer_ID').val("");
				}					
			}); //end autocomplete	



}); //end document ready

