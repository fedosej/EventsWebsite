$(function() {
		
		dateInputs="#meeting_startdate, #meeting_enddate, #meeting_startdate_from, #meeting_startdate_to, #meeting_enddate_from, #meeting_enddate_to";
		$(dateInputs).datetimepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd", 
			timeFormat: 'HH:mm:ss',
			firstDay:1
		});

		$(".clear_date").click(function(){
			$(this).parent("td").prev("td").find("input").val("");
			//$( "#meeting_date, #meeting_date_from, #meeting_date_to").val("");
		});


});


