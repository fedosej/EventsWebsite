//two buttons:
// 1) my own meetings
// 2) participated meetings

$(function() {
		
		var base_url=$('#base_url').val();
		$("#org_link, #part_link").click(function(){
			console.log("adsjfakj");
			if($(this).attr('id')=="org_link"){
				$("#participated").addClass("unvisible");
				$("#organized").removeClass("unvisible");
			}
			else{
				$("#organized").addClass("unvisible");
				$("#participated").removeClass("unvisible");
			}
		})
		//$("document").on("click", "#org_link, #part_link", function(){
			
		
		//$(document).on('click', '#participate, #cancel_participation', function(){

			
			
		

}); //end document ready




//----------------------VARIABLES and FUNCTIONS--------------------------














	


