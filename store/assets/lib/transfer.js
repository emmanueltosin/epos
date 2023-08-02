function materialTemplate(){
$('#material_holder').append(html);
 $select = $(".material-select").chosen({width: "100%"}); 
 $('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
}



function calculate_measurement(select){
	var selected = $(select);	
	var parent = selected.parent().parent();
	var measurement = parent.find('.measurement');
	var mesureInt = parseInt(selected.val());
	var error =  parent.find('#error_display');
	var material_selected = parent.find('.material');
	error.html('');
	if(selected.val() == "" || material_selected.val()==""){
		measurement.val('');				
	}else{
		
		var option_selected = material_selected.find(':selected');
		var qty_kg = parseInt(option_selected.attr('data-scale'));
		
		var in_stock = parseInt(option_selected.attr('data-available-qty'));
		if(mesureInt > in_stock){
			error.html('Not enough material to transfer');
			measurement.val('');
		}else{
		var needed = (mesureInt *qty_kg);
		measurement.val(needed.toFixed(2))
		}
	}
}