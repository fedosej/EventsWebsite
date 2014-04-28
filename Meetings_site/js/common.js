$(function() {
	header_title_text="";
	logo="<img src='"+$('#base_url').val()+"img/qrcode_3d_small.jpg'>";
	header_title_text=$(".header_title").html();
	
	//clear block
	$(".header_title").html("");
	
	//insert text together with image
	$(".header_title").html(logo+header_title_text);
})