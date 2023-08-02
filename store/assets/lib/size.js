var $select;
$(document).ready(function(){
$('.material-select').chosen({width: "100%"}); 
});

function materialTemplate(){
$('#material_holder').append(html);
 $select = $(".material-select").chosen({width: "100%"}); 
 $('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
}


function activate_measurement(select){
	var selected = $(select);
	var parent = selected.parent().parent();
	var measurement = parent.find('.measurement');
	var quantity = parent.find('.quantity');
	if(selected.val() == ""){
		measurement.val('');
		quantity.val('');
		measurement.attr('readonly','readonly');
	}else{
	measurement.removeAttr('readonly');
	calculate_qty(measurement)
	}
	return false;
}

function calculate_qty(select){
	var selected = $(select);
	var parent = selected.parent().parent();
	var quantity = parent.find('.quantity');
	var mesureInt = parseFloat(selected.val());	
	if(selected.val() !=""){
	if(mesureInt ==0){
		quantity.val(0);
	}
	else{
		var material_selected = parent.find('.material');
		var option_selected = material_selected.find(':selected');
		var qty_kg = parseInt(option_selected.attr('data-scale'));		
		var needed = (mesureInt/qty_kg);
		//needed = parseInt(needed);
		quantity.val(needed);
	}
	}else{
		quantity.val('')
	}
	
}

