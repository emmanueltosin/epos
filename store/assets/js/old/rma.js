
function selectRMA(){
	$("#replaced_by").on("change",function(){
		var parent = $('.toggle-loading').parents('.widget, .panel');
		 parent.addClass('be-loading-active');
		 var val = $(this).val();
		$.get(BASE_URL+"dashboard/load_replaced_by_form/"+rma_id+"/"+$(this).val(),function(result){
			 $("#option_select").html(result);
			 parent.removeClass('be-loading-active');
			 if(val == "1"){
			 claiming_status();
			 }else{
			 replaced_status();
			 }
			   $(".date").datetimepicker({
				autoclose: true,
				componentIcon: '.mdi.mdi-calendar',
				navIcons:{
					rightIcon: 'mdi mdi-chevron-right',
					leftIcon: 'mdi mdi-chevron-left'
				}
		});
		})
	});
	if($("#replaced_by").val() !=""){
		var parent = $('.toggle-loading').parents('.widget, .panel');
		 parent.addClass('be-loading-active');
		 var val =$("#replaced_by").val();
			$.get(BASE_URL+"dashboard/load_replaced_by_form/"+rma_id+"/"+$("#replaced_by").val(),function(result){
			 $("#option_select").html(result);
			 parent.removeClass('be-loading-active');
			 if(val == "1"){
			 claiming_status();
			 }else{
			 replaced_status();
			 }
			   $(".date").datetimepicker({
				autoclose: true,
				componentIcon: '.mdi.mdi-calendar',
				navIcons:{
					rightIcon: 'mdi mdi-chevron-right',
					leftIcon: 'mdi mdi-chevron-left'
				}
		});
		})
	}
}


function sentToengine(){
	$("#which_engineer").on("change",function(){
		var parent = $('.toggle-loading').parents('.widget, .panel');
		 parent.addClass('be-loading-active');
		 var val = $(this).val();
		$.get(BASE_URL+"dashboard/load_sent_to_engineer/"+rma_id+"/"+$(this).val(),function(result){
			 $("#option_select").html(result);
			 parent.removeClass('be-loading-active');
			 warranty_engineering_status();
			 pro_status();
			 	   $(".date").datetimepicker({
				autoclose: true,
				componentIcon: '.mdi.mdi-calendar',
				navIcons:{
					rightIcon: 'mdi mdi-chevron-right',
					leftIcon: 'mdi mdi-chevron-left'
				}
		});
		})
	});
	
	if($("#which_engineer").val()!=""){
			var parent = $('.toggle-loading').parents('.widget, .panel');
		 parent.addClass('be-loading-active');
		 var val = $("#which_engineer").val();
		$.get(BASE_URL+"dashboard/load_sent_to_engineer/"+rma_id+"/"+$("#which_engineer").val(),function(result){
			 $("#option_select").html(result);
			 parent.removeClass('be-loading-active');
			 warranty_engineering_status();
			 pro_status();
			 	   $(".date").datetimepicker({
				autoclose: true,
				componentIcon: '.mdi.mdi-calendar',
				navIcons:{
					rightIcon: 'mdi mdi-chevron-right',
					leftIcon: 'mdi mdi-chevron-left'
				}
		});
		})
	}
}

function warranty_engineering_status(){
$('.warranty_engineering_status').on("change",function(){
$(".Replaced").attr("style","display:none");
$(".Repaired").attr("style","display:none");	
var v = "."+$(this).val();
$(v).removeAttr("style");		
});
if($('.warranty_engineering_status').val()!=""){
$(".Replaced").attr("style","display:none");
$(".Repaired").attr("style","display:none");	
var v = "."+$('.warranty_engineering_status').val();
$(v).removeAttr("style");		
}
}
function pro_status(){
$(".pro_status").on("change",function(){
$(".Repaired").attr("style","display:none");
$(".Beyond-Repaired").attr("style","display:none");	
var v = "."+$(this).val();
$(v).removeAttr("style");	
});
if($(".pro_status").val() !=""){
$(".Repaired").attr("style","display:none");
$(".Beyond-Repaired").attr("style","display:none");	
var v = "."+$(".pro_status").val();
$(v).removeAttr("style");
preLoadWhatsnext();		
}
loadWhatsNext();
}

function claiming_status(){	
	$(".claiming_status").on("change",function(){
		if($(this).val()=="2"){
			$(".bad").attr("style","");
			$("#move_to_bad_product").attr("checked","checked")
		}else{
			$(".bad").attr("style","display:none");
			$("#move_to_bad_product").removeAttr("checked");
		}
	});
}


function replaced_status(){
	$(".replaced_status").on("change",function(){
		if($(this).val()=="1"){
			$(".com").attr("style","");
			$(".bad").attr("style","display:none");
		}else if($(this).val()=="2"){
			$(".bad").attr("style","");
			$(".com").attr("style","display:none");
		}else{
			$(".com").attr("style","display:none");
			$(".bad").attr("style","display:none");
		}
	});

	if($(".replaced_status").val()!=""){
		if($(".replaced_status").val()=="1"){
			$(".com").attr("style","");
			$(".bad").attr("style","display:none");
		}else if($(".replaced_status").val()=="2"){
			$(".bad").attr("style","");
			$(".com").attr("style","display:none");
		}else{
			$(".com").attr("style","display:none");
			$(".bad").attr("style","display:none");
		}
	}
	
}

function loadWhatsNext(){
$(".whatsnext").off("change");
$(".whatsnext").on("change",function(){
if($(this).val() == "sent_to_warranty"){
		var parent = $('.toggle-loading').parents('.widget, .panel');
		 parent.addClass('be-loading-active');
		$.get(BASE_URL+"dashboard/load_sent_to_engineer/"+rma_id+"/"+"2",function(result){
			 $("#Send-to-Warranty").html(result);
			 parent.removeClass('be-loading-active');
			 warranty_engineering_status();
			 pro_status();
			 	   $(".date").datetimepicker({
				autoclose: true,
				componentIcon: '.mdi.mdi-calendar',
				navIcons:{
					rightIcon: 'mdi mdi-chevron-right',
					leftIcon: 'mdi mdi-chevron-left'
				}
		});
		})
	
}else{
		 $("#Send-to-Warranty").html('');
}	
});

}

function preLoadWhatsnext(){
if($(".whatsnext").val()== "sent_to_warranty"){
var parent = $('.toggle-loading').parents('.widget, .panel');
		 parent.addClass('be-loading-active');
		$.get(BASE_URL+"dashboard/load_sent_to_engineer/"+rma_id+"/"+"2",function(result){
			 $("#Send-to-Warranty").html(result);
			 parent.removeClass('be-loading-active');
			 warranty_engineering_status();
			 //pro_status();
			 	   $(".date").datetimepicker({
				autoclose: true,
				componentIcon: '.mdi.mdi-calendar',
				navIcons:{
					rightIcon: 'mdi mdi-chevron-right',
					leftIcon: 'mdi mdi-chevron-left'
				}
		});
		})
	
}else{
		 $("#Send-to-Warranty").html('');
}		
}
