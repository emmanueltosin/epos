
function activate_qunatity(select){
	var selected = $(select);
	if(selected.val()!=""){
	var parent = selected.parent().parent();
	var quantity = parent.find('.quantity');
	var size = parent.find('.size');
	var unit_price = parent.find('.unit_price');
	var option_selected = selected.find(':selected');
	var total = parent.find('.total');
	size.html(option_selected.attr('data-size'));
	unit_price.html(parseInt(option_selected.attr('data-price')).toFixed(2));
	var tt = parseInt(option_selected.attr('data-price')) * (quantity.val() =="" ? 0 :parseInt(quantity.val()));
	quantity.removeAttr('readonly');
	quantity.attr('max',option_selected.attr('data-available-qty'));
	total.html(tt.toFixed(2));
	getAlltotal()
	}else{
		var parent = selected.parent().parent();
		var quantity = parent.find('.quantity');
		var size = parent.find('.size');
		var unit_price = parent.find('.unit_price');
		var option_selected = selected.find(':selected');
		var total = parent.find('.total');
		size.html('');
		unit_price.html('');
		quantity.val('');
		quantity.attr('readonly','readonly');
		total.html('');
		getAlltotal();
	}
}

function calculatetotal(select){
	var quantity =$(select);
	var parent = quantity.parent().parent();
	var total = parent.find('.total');
	var selected = parent.find('.products');
	var option_selected = selected.find(':selected');
	var tt = parseInt(option_selected.attr('data-price')) * (quantity.val() =="" ? 0 :parseInt(quantity.val()));
	quantity.removeAttr('readonly');
	total.html(tt.toFixed(2));
	getAlltotal()
}


function getAlltotal(){
var all = 0;
$('#material_holder').find('.total').each(function(){
	if($(this).html()!=""){
	all += parseInt($(this).html());
	}
});
$('.all_total').html(all.toFixed(2));
}


function addHtml(){
	$('#material_holder').append(html);
}