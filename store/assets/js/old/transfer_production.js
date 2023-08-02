
function materialTemplate(){
$('#material_holder').append(html);
 $select = $(".material-select").chosen({width: "100%"}); 
 $('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
}

function calculate_quantity(select){
	var selected = $(select);	
	var parent = selected.parent().parent();
	var quantity = parent.find('.quantity');
	var mesureInt = selected.val();
	var error =  parent.find('#error_display');
	var material_selected = parent.find('.material');
	error.html('');
	if(selected.val() == "" || material_selected.val()==""){
		quantity.val('');				
	}else{
		var option_selected = material_selected.find(':selected');
		var qty_kg = parseInt(option_selected.attr('data-scale'));
		
		var in_stock = parseInt(option_selected.attr('data-available-measurement'));

		if(mesureInt > in_stock){
			error.html('Not enough material to transfer');
			quantity.val('');
		}else{
			var needed = (mesureInt /qty_kg);
			quantity.val(needed.toFixed(2));
		}
		
	}
}
