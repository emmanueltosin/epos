$("#new_production_form").on('submit',function(){
var size_select = $("#size_select");
var qty_no = $("#qty-no");
if(($.trim(qty_no.val()).length !==0) && ($.trim(size_select.val()).length !==0)){
	$(".loading").html('<h3 align="center">Loading...</h3><div align="center"><i class="fa fa-spinner fa-2x"></i></div>')	
	ajaxSentRequest($(this).attr('action'),{'qty':qty_no.val(),'size':size_select.val()},function(data){
		$("#holder").html(data);
		 $('.date').datepicker({
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true
	});
	});
}
return false;	
});