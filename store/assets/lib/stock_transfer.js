$("#go").on("click",function(){
var transfer_id = $("#transfer_id");
if($.trim(transfer_id.val()).length !==0){
$(".loading").html('<h3 align="center">Loading...</h3><div align="center"><i class="fa fa-spinner fa-2x"></i></div>')	
ajaxSentRequest(transfer_id.attr('href-link'),{'transfer_id':transfer_id.val()},function(data){
	$("#replacer").html(data);
	 $('.date').datepicker({
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true
	});
});
}
return false		
});
