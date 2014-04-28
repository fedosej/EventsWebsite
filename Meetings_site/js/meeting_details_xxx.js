

$(function(){
	
	var base_url=$('#base_url').val();
	userID=$('#user_ID').val(); 
	
	//detect if logged user is owner of this meeting
	if($("#edit_meeting_message").length>0){
			//insert editable icon
			editIcon="<div class='edit_icon'>";
			editIcon+="<img src='"+base_url+"img/edit.png"+"'/>";
			editIcon+="</div>";		
			$(editIcon).insertBefore(".md_value");
	
	} //end f logged user is owner of this meeting
	
	
	//if owner clicked on edit icon
	$(document).on("click", ".edit_icon", function(){
		fieldName=$(this).prev("div.meetings_headers").text();
		fieldID=$(this).next("div.md_value").attr("id");
		editBlock="<div class='editBlock'>"+fieldName+"<div class='input_container'>";
		switch(fieldID){
            	
				case 'md_startdate': 
					inputfield="";
					inputfield='<input class="form-control" id="meeting_startdate" name="meeting_startdate" type="text" value="'+$("#"+fieldID).text()+'"/>';
                	break;
				
				case 'md_enddate': 
					inputfield=="";
					inputfield='<input class="form-control" id="meeting_enddate" name="meeting_enddate" type="text" value="'+$("#"+fieldID).text()+'"/>';
                	break;
				
				case 'md_location':
					inputfield="";
					inputfield='<input class="form-control" id="meeting_location" name="meeting_location" type="text" value="'+$("#"+fieldID).text()+'"/>';
					break;
					
				case 'md_desc':
					inputfield="";
					inputfield='<textarea class="form-control" name="meeting_description" rows="10" cols="50" wrap="hard">'+$("#"+fieldID).text()+'</textarea>'
					break;
		}
		
		
		
		editBlock+=inputfield;
		editBlock+="</div></div>"
		
		//open Dialog Window
		$(editBlock).dialog({
				buttons: [
					{
						text: "Save",
						click: function(){
							inputEl="";
							inputEl=$(".input_container").children();
							console.log(inputEl);
							$(this).dialog( "close" ); 
						}
					},	//end SAVE button
						
					{
						text: "Cancel",
						click: function(){
							$(this).dialog( "close" ); 
						}
					}	//end CANCEL button
				],
			
		}) //end pop-up window for edit
		
		
	}) //end click on edit icon
	
	
	
	
	
	
	
	
	
	
	
	
}); //end document ready




/*

function convertTovalidDateformat(DateStr){
	var thisDateT = DateStr.substr(0, 10) + "T" + DateStr.substr(11, 8);
	var jDate = new Date(thisDateT);
	return jDate;
	//console.log(jDate);
}
*/

/*

function convertDate(DateStr){
	var a=DateStr.split(" ");
	var d=a[0].split("-");
	var t=a[1].split(":");
	var date = new Date(d[0],(d[1]-1),d[2],t[0],t[1],t[2]);
	return date;

}
*/