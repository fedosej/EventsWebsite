$(function() {
	
	//quick search disable
	disableEmptyForms("#quick_search_button", "#quick_search_filter");
	
	// meeting filter disable
	disableEmptyForms("#submit_filter", "#meetings_filter")
	
		
		
}) //end document ready


function disableEmptyForms(submitButtonID, formID){
		
		
		$(document).on('click', submitButtonID, function(){
		
		filterIsEmpty=true;
		var formInputs=$(formID).find("input, textarea");
		$(formInputs).each(function(){
			var input=$(this);
			if(input.val().length>0){
				filterIsEmpty=false;
				return false;
			}		
		}) //en each input of form
		
		if(filterIsEmpty==true){
			//generate Alert
			message="<p>Filter Can not be empty!</p>";
			generateAlertDialog("Error!", message);		
			
		}
		else{
			$(formID).submit();
		}
		

	}) //end click event



}


