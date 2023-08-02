<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo APP_NAME ?> | POS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-fav.png')  ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/adminpro-custon-icon.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/meanmenu.min.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/form.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>style.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>css/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/form.css">
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/modals.css">
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/form/all-type-forms.css">
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/select2/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/chosen/bootstrap-chosen.css">
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/datapicker/datepicker3.css">
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/Lobibox.min.css">
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/notifications.css">
	

	<style type="text/css">
.expandable {
	width: 19%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    transition-property: width;
	transition-duration: 2s;
}
.item-grid-title {
	width: 19%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    transition-property: width;
	transition-duration: 2s;
}
.item-grid-price {
	width: 19%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    transition-property: width;
	transition-duration: 2s;
}
.expandable:hover{
	overflow: visible;
    white-space: normal;
    width: auto;
}
.shop-items:hover {
	background:#FFF;
	cursor:pointer;
	box-shadow:inset 5px 5px 100px #EEE;
}
.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none;   /* Chrome/Safari/Opera */
  -khtml-user-select: none;    /* Konqueror */
  -moz-user-select: none;      /* Firefox */
  -ms-user-select: none;       /* Internet Explorer/Edge */
  user-select: none;           /* Non-prefixed version, currently
                                  not supported by any browser */
}
.img-responsive {
    margin: 0 auto;
}
.modal-dialog {
	margin: 10px auto !important;
}

/**
 NexoPOS 2.7.1
**/

#cart-table-body .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    border-bottom: 1px solid #f4f4f4;
	margin-bottom:-1px;
}
.box {
	border-top: 0px solid #d2d6de;
}
</style>
 <script>
 Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};
 </script>
</head>
<body>
<div class="wrapper-pro">
<div class="login-form-area mg-t-30 mg-b-30">
<div class="col-lg-12">
<?php $total_amt  = $this->stock->getTotalAmountDeposited($this->uri->segment(3),true); ?>
<script>
var total_amt = <?php echo $this->stock->getTotalAmountDeposited($this->uri->segment(3)); ?>;
</script>
<?php
$depo = $this->db->get_where("deposit",array("SN"=>$this->uri->segment(3)))->row_array();
?>
<div class="row checkout-header ng-scope">		   
				<div class="col-lg-5" >
				
					<input type="text" name="search_bar" placeholder="Search for product name , model numbers product codes" style="margin-top:-25px" class="form-control" id="search_bar"/>
				</div>	
				<div class="col-lg-4" style="margin-bottom:10px">
                  <?php
					if($this->users->get_user_by_username($this->session->userdata("username"))->role!="Sales Representative"){
				  ?>
				   <center>  <button style="margin-top:-40px" onclick="goTo( '<?php echo base_url('dashboard/view_deposit/'.$this->uri->segment(3)); ?>' )" class="btn btn-sm btn-default">
				   <i class="fa fa-arrow-back"></i> Back to Deposit Details</button></center>
				   <?php
					}
				   ?>
                       <!-- <button onclick="openCalculator()" class="btn btn-sm btn-default calculator-button">
                <i class="fa fa-calculator"></i> Calculator</button></center> --->     
                </div>
				
				<div class="col-lg-3" style="margin-top:-15px">
					<h5>Deposit Value : <b><?php echo $total_amt; ?></b></h5>
				</div>
			
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="login-form-area login-bg">
			<div class="row">
				<?php
					$branch = $this->stock->getBranch_id();
					if($branch =="0"){
				?>
				<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $depo['customer_id'] ?>"/>
				<?php
					}else{
				?>
			
					<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $depo['customer_id'] ?>"/>
				
				
				<?php
					}
				?>
				<div class="col-lg-4">
					<span class="input-group-btn">
                   
                    <button class="btn btn-default" type="button"  data-toggle="modal" data-target="#InformationproModalalert"> <i class="fa fa-pencil"></i> <span class="hidden-sm hidden-xs">Add a Note</span></button>                    
                </span>
				</div>
				
				<div class="col-lg-2">
						<select name="rec_size" id="rec_size" class="form-control select2_demo_2">
							<option value="thermal">Thermal Receipt</option>
							<option value="Big">Big Receipt</option>
							<!--<option value="Communication">Communication Receipt</option>-->
						</select>
				</div>
				 
				<div class="col-lg-2">
					<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->users->get_user_by_username($this->session->userdata("username"))->SN; ?>"/>
					<b class="form-control"><?php echo ucwords($this->session->userdata("username")); ?></b>
				 </div>
				  
				  <div class="col-lg-2">
				  <input type="hidden" value="4" id="method" name="user_id"/>
						<!--
						<select name="user_id" id="method" class="form-control select2_demo_2">
							<option value="">Payment Method</option>
							<?php 
								//$methods = $this->db->get('payment_method')->result_array();
								//foreach($methods as $method){
							?>
								<option value="<?php //echo $method['SN'] ?>"><?php //echo $method['payment_method'] ?></option>
							<?php 
							//}
							?>
						</select>
						-->
				</div>
			</div>
<br/>		
<div class="row">
		<form action="<?php echo base_url("dashboard/depositSave/".$this->uri->segment(3));  ?>" id="cart_form" method="POST">
		<div class="direct-chat-messages" id="cart-table-body" style="padding: 0px; height: 290px; overflow:auto;">
            <table class="table" style="margin-bottom:0;font-size:12px;"><tbody id="cart_appender"><tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr></tbody></table>
        </div>
		</form>
		<script>
			window.setInterval(function(){
				var elem = document.getElementById('cart-table-body');
				elem.scrollTop = elem.scrollHeight;
			},500);
		</script>
		<table class="table" id="cart-details">
            <tfoot class="hidden-xs hidden-sm hidden-md">
                <tr class="active">
                    <td class="text-left" width="200">Number of Items ( <span class="items-number">0</span> )</td>
                    <td class="text-right hidden-xs" width="150"></td>
                    <td class="text-right" width="150">Sub Total</td>
                    <td class="text-right" width="90"><span class="cart-value">&#8358 0.00 </span></td>
                </tr>
                <tr class="active">
                    <td></td>
                    <td></td>
                    <td class="text-right cart-discount-notice-area">Discount on Cart</td>
                    <td class="text-right cart-discount-remove-wrapper"><span class="cart-discount pull-right">&#8358 0.00 </span></td>
                </tr>
				<tr class="active">
                    <td></td>
                    <td></td>
                    <td class="text-right cart-discount-notice-area">VAT(<?php echo $this->settings->getSettings()['vat'] ?>%)</td>
                    <td class="text-right cart-discount-remove-wrapper"><span class="cart-vat pull-right">&#8358 0.00 </span></td>
                </tr>
				<tr class="active">
                    <td></td>
                    <td></td>
                    <td class="text-right cart-discount-notice-area">Service Charge(<?php echo $this->settings->getSettings()['scharge'] ?>%)</td>
                    <td class="text-right cart-discount-remove-wrapper"><span class="cart-s-charger pull-right">&#8358 0.00 </span></td>
                </tr>
                <tr class="success">
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"><strong>
                       Total                       </strong></td>
                    <td class="text-right"><span class="cart-topay pull-right">&#8358; 0.00 </span></td>
                </tr>
            </tfoot>
            
        </table>
<div class="btn-group btn-group-justified" role="group" aria-label="...">
			<div class="btn-group ng-scope" role="group" ng-controller="payBox">
			 <button type="button" class="btn btn-primary btn-lg sendToKitchenButton" onclick="PayNow()" style="margin-bottom:0px;"> <i class="fa fa-money"></i>
				  <span class="hidden-xs">Pay Now</span>
			 </button>
			</div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#discountDialog" id="cart-discount-button" style="margin-bottom:0px;"> <i class="fa fa-gift"></i>
                    <span class="hidden-xs">Discount</span>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-danger btn-lg" id="cart-return-to-order" style="margin-bottom:0px;"> <!-- btn-app  -->
                <i class="fa fa-refresh"></i>
                    <span class="hidden-xs">Cancel</span>
                </button>
            </div>
        </div>
</div>
		
		</div>
	</div>
	<div class="col-lg-6" style="display:none;">
		<div class="login-form-area login-bg" >
			<div class="row">
			<form action="#" method="post" id="search-item-form" class="ng-pristine ng-valid">
				
			</form>		
			<div class="direct-chat-messages item-list-container" style="padding: 0px; height: 540px; overflow:auto">
			<div style="width:100%;margin-top:0px;padding:0px;padding-bottom:10px;margin:0px;">
				<input type="text" class="form-control input-bg" name="search" onkeyup="return search_list(this,'stock_list')" placeholder="Search For Available Product" autocomplete="off"/>
			</div>
				<div class="col-lg-12">
					<div class="row" id="stock_list">
						<?php
						$items = $this->stock->getSellable(array("quantity!="=>"0",'status'=>"1"));
						if(count($items) > 0){
						foreach($items as $item){
						?>
						<div data-qty="<?php echo $item['quantity'] ?>" data-track="1"  data-amount="<?php echo $item['price'] ?>" data-id="<?php echo $item['SN']; ?>" data-item-name="<?php echo $item['product_name']  ?>" onclick="addTocart(this)" class="col-lg-3 col-md-3 col-xs-6 shop-items filter-add-product noselect text-center" style="padding:5px; border-right: solid 1px #DEDEDE;border-top: solid 1px #DEDEDE;border-bottom: solid 1px #DEDEDE;" data-design="velvet v-neck body suit"><img data-original="<?php  echo base_url('assets/img/logo-fav.png'); ?>" style="max-height: 64px; display: block;" class="img-responsive img-rounded lazy" src="<?php  echo $this->settings->getSettings()['slogo'] ?>" width="100"><div class="caption text-center" style="padding:2px;overflow:hidden;"><strong class="item-grid-title"><span class="marquee_me"><?php echo $item['product_name'] ?></span></strong><br><span class="align-center">&#8358;<?php echo number_format($item['price'],2) ?></span></div></div>
						<?php
						}
						}else{
						?>
							<h2 align="center" style="margin-top:28%;">No Available Product!..<h2>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
	<!--<script src="<?php //echo base_url()  ?>assets/lib/jquery/jquery.min.js"></script>-->
	<script src="<?php echo base_url()  ?>js/vendor/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url()  ?>js/vendor/modernizr-2.8.3.min.js"></script>
	<script src="<?php echo base_url()  ?>js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url()  ?>js/barcode_reader.js"></script>
    <script src="<?php echo base_url()  ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()  ?>js/jquery.meanmenu.js"></script>
    <script src="<?php echo base_url()  ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url()  ?>js/jquery.sticky.js"></script>
    <script src="<?php echo base_url()  ?>js/jquery.scrollUp.min.js"></script>
	<script src="<?php echo base_url()  ?>js/icheck/icheck.min.js"></script>
	<script src="<?php echo base_url()  ?>js/select2/select2.full.min.js"></script>
	<script src="<?php echo base_url()  ?>js/chosen/chosen.jquery.js"></script>
	<script src="<?php echo base_url()  ?>js/select2/select2-active.js"></script>
	<script src="<?php echo base_url()  ?>js/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url()  ?>js/chosen/chosen-active.js"></script>
	<script src="<?php echo base_url()  ?>js/icheck/icheck-active.js"></script>
	<script src="<?php echo base_url()  ?>js/bootstrap3-typeahead.js"></script>	
	<script src="<?php echo base_url()  ?>js/Lobibox.js"></script>
	<script src="<?php echo base_url()  ?>js/main.js"></script>
	
	<script>
	var discount_type=2;
	var discount_value =0;
		$(document).ready(function(){
	
 
  $('#search_bar').typeahead({
	source: function(query, process) {
      var textVal=$("#search_bar").val();
      $.ajax({
        url: '<?php  echo base_url("dashboard/getProductBySearch?barcode=") ?>'+textVal,
        type: 'POST',
        data: 'query=' + query + '&field1=' + textVal,
        dataType: 'JSON',
        async: true,
        success: function(data) {
          process(data);
        }
      }) 
	},
	afterSelect:function(item){
		  $('#search_bar').val('')
		  getInputFromBarcode(item.id,1)
	  }
  });
	})																   
	var note= '';
			$( '.filter-add-product' ).each( function(){
				$(this).bind( 'mouseleave', function(){
					$( this ).find( '.marquee_me' ).replaceWith( '<span class="marquee_me">' + $( this ).find( '.marquee_me' ).html() + '</span>' );
				})
			});
			$( '.filter-add-product' ).each( function(){
				$(this).bind( 'mouseenter', function(){
					$( this ).find( '.marquee_me' ).replaceWith( '<marquee class="marquee_me" behavior="alternate" scrollamount="4" direction="left" style="width:100%;float:left;">' + $( this ).find( '.marquee_me' ).html() + '</marquee>' );
				})
			});
			
			function goTo(url){
				window.location.href=url;
			}
			
			function addTocart(elem){
				var item = $(elem);
				var item_id = item.attr('data-id');
				var amount = item.attr('data-amount');
				var item_name = item.attr('data-item-name');
				var data_track =item.attr('data-track');
				var data_qty = item.attr('data-qty');
				var cart_appender = $('#cart_appender');
				var no_item_html ='<tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr>';
				var new_item_html='<tr class="item_list" data-amount="'+amount+'" data-id="'+item_id+'"><td class="text-left" style="line-height:30px;" width="200"><p style="width:45px;margin:0px;float:left"><a class="btn btn-sm btn-default quick_edit_item" href="javascript:void(0)" onclick="$(this).parent().parent().parent().remove();calculateSub();countItem();" style="float:left;vertical-align:inherit;margin-right:10px;"><i class="fa fa-trash"></i></a></p><p class="filter-add-product" style="text-transform: uppercase;float:left;width:76%;margin-bottom:0px;" class="item-name">'+item_name+'</p></td><td class="text-center item-unit-price hidden-xs" style="line-height:30px;" width="110">'+amount+'</td><td class="text-center item-control-btns" width="100"><div class="input-group" style="width:100px"><span class="input-group-btn"><button class="btn btn-default item_qty_plus" type="button"><span class="" aria-hidden="true"></span><i class="fa fa-plus"></i></button></span><input type="number" readonly name="qty" data-qty="'+data_qty+'" data-track="'+data_track+'" data-id="'+item_id+'" value="1" style="width:60px"class="form-control shop_item_quantity" placeholder="Qty" /><span class="input-group-btn"><button  class="btn btn-default item_qty_minus" type="button"><span  aria-hidden="true"></span><i class="fa fa-minus"></i></button></span></div></td><td class="text-right item-total-price" style="line-height:30px;" width="100">'+(parseInt(amount).toFixed(2))+'</td></tr>';
				if(no_item_html==cart_appender.html()){
					cart_appender.html('');
				}
				var adding = true;
				$('.item_list').each(function(id,elem){
					var ex_data_id = $(elem).attr('data-id');
					if(parseInt(ex_data_id) ==parseInt(item_id)){
						var qty_val = $(elem).find('.shop_item_quantity');
						var qty = parseInt(qty_val.val());
						qty++;
						if(data_track=="1"){
							adding = false;
							if(parseInt(data_qty) > 0){
							if(parseInt(qty) <= parseInt(data_qty)){
								$(qty_val).val(qty);
								var parent = $(elem);
								var data_amount = (qty * parseInt(parent.attr('data-amount')));
								var item_total_price = parent.find('.item-total-price');
								item_total_price.html(data_amount.toFixed(2));
								calculateSub();
							}else{
								error("Quantity Must not be Greater than Availabe Quantity ("+data_qty+")")
							}
							}else{
								error("Item Out of Stock");
							}
						}else{
						$(qty_val).val(qty);
						adding = false;
						var parent = $(elem);
						var data_amount = (qty * parseInt(parent.attr('data-amount')));
						var item_total_price = parent.find('.item-total-price');
						item_total_price.html(data_amount.toFixed(2));
						calculateSub();
						}
					}
				});
				if(adding!=false){
				if(data_track=="1"){
					if(parseInt(data_qty) > 0){
						cart_appender.append(new_item_html);
				add_to_qty();
				minus_from_qty();
				countItem();
				calculateSub();
					}else{
							error("Item Out of Stock");
					}
				}else{
				cart_appender.append(new_item_html);
				add_to_qty();
				minus_from_qty();
				countItem();
				calculateSub();	
				}
				}
			}
			
		 function add_to_qty(){
			$(".item_qty_plus").unbind("click");
			$(".item_qty_plus").bind("click",function(){
				var parent = $(this).parent().parent().parent();
				qty_val=parent.find('.shop_item_quantity');
				var qty = parseInt(qty_val.val());
				var data_track = qty_val.attr('data-track');
				var data_qty= parseInt(qty_val.attr('data-qty'))
				qty =qty+1;
				if(qty<=data_qty){
				$(qty_val).val(qty);
				parent = parent.parent();
				var data_amount = (qty * parseInt(parent.attr('data-amount')));
				var item_total_price = parent.find('.item-total-price');
				item_total_price.html(data_amount.toFixed(2));
				calculateSub();
				}else{
					error("Quantity Must not be Greater than Availabe Quantity("+data_qty+")")
				}
			});
			
		}
		function minus_from_qty(){
			$(".item_qty_minus").unbind("click");
			$(".item_qty_minus").bind("click",function(){
				var parent = $(this).parent().parent().parent();
				qty_val=parent.find('.shop_item_quantity');
				var qty = parseInt(qty_val.val());
				qty = qty-1;
				if(qty==0){
				parent = parent.parent().remove();	
				}else{
				$(qty_val).val(qty);
				parent = parent.parent();
				var data_amount = (qty * parseInt(parent.attr('data-amount')));
				var item_total_price = parent.find('.item-total-price');
				item_total_price.html(data_amount.toFixed(2));
				}
				calculateSub();
			});
		}
		
		
		
		function calculateSub(){
			var total =0;
			$('.item-total-price').each(function(id,elem){
				total +=parseInt($(elem).html());
			});
			$('.cart-value').html("&#8358; "+(total.toFixed(2)))			
			calculate_to_pay();
		}
		function addNote(){
			note = $("#cart_note").html();
		}
		
		function countItem(){
			var num =0;
			$('.item-total-price').each(function(id,elem){
				num++;
			});
			$('.items-number').html(num);
			if(num==0){
				var no_item_html ='<tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr>';
				$("#cart_appender").append(no_item_html);
			}
		}
	</script>
		    <div id="InformationproModalalert" class="modal modal-adminpro-general fullwidth-popup-InformationproModal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-close-area modal-close-df">
                                            <a class="close" data-dismiss="modal" href="modals.html#"><i class="fa fa-close"></i></a>
                                        </div>
                                        <div class="modal-body">
										<div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p>Add a note to the order</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-textarea-area">
                                                <textarea id="cart_note" class="contact-message form-controls" name="additional_info" cols="30" rows="10"></textarea>
                                                <i class="fa fa-comment login-user"></i>
                                            </div>
                                        </div>
										</div>
										 </div>
                                        <div class="modal-footer">
                                            <a data-dismiss="modal" href="modals.html#">Cancel</a>
                                            <a data-dismiss="modal" href="modals.html#" onclick="addNote();">Save</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
		 <div id="discountDialog" class="modal modal-adminpro-general fullwidth-popup-InformationproModal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-close-area modal-close-df">
                                            <a class="close" data-dismiss="modal" href="modals.html#"><i class="fa fa-close"></i></a>
                                        </div>
										 <div class="modal-header"><h3>Apply Discount <span class="discount_type pull-right"><span class="label label-info">Fixed</span></span></h3> </div>
                                        <div class="modal-body" id="discount_modal_div">
										<div class="input-group input-group-lg"><span class="input-group-btn"><button class="btn btn-default percentage_discount" onclick="activate(this)" type="button">Percentage</button></span><input name="discount_value"  class="form-control discount_input" placeholder="Define the amount or percentage here..." type="number"><span class="input-group-btn"><button class="btn btn-default flat_discount active" onclick="activate(this)" type="button">Fixed</button></span></div><br/>
											
											<div class="row"><div class="col-lg-12">
											<div class="row">
											<div class="col-lg-2 col-md-2 col-xs-2">
											<input class="btn btn-default btn-block btn-lg numpad" value="7" type="button">
											</div>
											<div class="col-lg-2 col-md-2 col-xs-2">
											<input class="btn btn-default btn-block btn-lg numpad" value="8" type="button">
											</div>
											<div class="col-lg-2 col-md-2 col-xs-2">
											<input class="btn btn-default btn-block btn-lg numpad" value="9" type="button">
											</div>
											<div class="col-lg-6 col-md-6 col-xs-6"><input class="btn btn-warning btn-block btn-lg numpaddel" value="Go Back" data-dismiss="modal" href="modals.html#" type="button"></div>
											</div>
											<br>
											<div class="row">
											<div class="col-lg-2 col-md-2 col-xs-2">
											<input class="btn btn-default btn-block btn-lg numpad" value="4" type="button">
											</div>
											<div class="col-lg-2 col-md-2 col-xs-2">
											<input class="btn btn-default btn-block btn-lg numpad" value="5" type="button">
											</div><div class="col-lg-2 col-md-2 col-xs-2"><input class="btn btn-default btn-block btn-lg numpad" value="6" type="button"></div>
											<div class="col-lg-6 col-md-6 col-xs-6"><input class="btn btn-danger btn-block btn-lg numpadclear" value="Clear" type="button"></div>
											</div><br>
											<div class="row">
											<div class="col-lg-2 col-md-2 col-xs-2"><input class="btn btn-default btn-block btn-lg numpad" value="1" type="button">
											</div>
											<div class="col-lg-2 col-md-2 col-xs-2"><input class="btn btn-default btn-block btn-lg numpad" value="2" type="button"></div>
											<div class="col-lg-2 col-md-2 col-xs-2"><input class="btn btn-default btn-block btn-lg numpad" value="3" type="button"></div>
											</div>
											<br>
											<div class="row">
											<div class="col-lg-2 col-md-2 col-xs-2">
											<input class="btn btn-default btn-block btn-lg numpad" value="00" type="button"></div>
											<div class="col-lg-4 col-md-6 col-xs-6"><input class="btn btn-default btn-block btn-lg numpad" value="0" type="button"></div>
											</div>
											</div>
											</div>
										 </div>
										 <div class="modal-footer">
                                            <a data-dismiss="modal" href="#" onclick="applyDiscount()">Apply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
		<div id="PrimaryModalalert" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
                                
								<div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-close-area modal-close-df">
                                            <a class="close" data-dismiss="modal" href="modals.html#"><i class="fa fa-close"></i></a>
                                        </div>
                                        <div class="modal-body">
										<form action="<?php echo base_url('dashboard/addCustomer') ?>" method="POST" id="new_customer_form">
										 <div class="row">
                                        <div class="col-lg-12">
                                            <div class="login-title">
                                                <h1>New Customer Form</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p>First Name</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" required class="form-controls" name="firstname">
                                                <i class="fa fa-user login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p>Last Name</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" class="form-controls" required name="lastname">
                                                <i class="fa fa-user login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p>Phone Number</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" required class="form-controls" name="phone">
                                                <i class="fa fa-phone login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p>Address</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" class="form-controls" name="address">
                                            </div>
                                        </div>
                                    </div>
                                    
                      
       
									 
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <div class="login-button-pro">
                                                <button type="submit" class="login-button login-button-lg">Add Customer</button>
                                            </div>
                                        </div>
                                    </div>
									</form>									
									</div>
                                    </div>
                                </div>
								
                            </div>	
<script>
//1 = percentage
//2 = fixed
var barcodes = {};
var barcodes_product_id = {};
$("#new_customer_form").on("submit",function(){
$(this).find(".form-controls").attr('disabled','disabled');
$(this).attr('style','opacity:0.8;');
var form = $(this);
var data ={};
form.find('.form-controls').each(function(id,elem){
data[$(elem).attr('name')]= $(elem).val();
});
ajaxSentRequest($(this).attr('action'),data,function(result){
	result =JSON.parse(result);		
		form.find(".form-controls").removeAttr('disabled');
		form.removeAttr('style');
		form[0].reset();
		$("#PrimaryModalalert").modal('toggle');
		$(".select2_demo_2").append('<option value="'+result['SN']+'">'+result['firstname']+' '+result['lastname']+'</option>');
		$(".select2_demo_2").trigger('change');
		$(".select2_demo_2").select2('val',result['SN']);
})
return false;
});

$('#discountDialog').on('shown.bs.modal', function (e) {
 var dis_modal_body =$('#discount_modal_div');
 dis_modal_body.find('.numpad').unbind('click');
 dis_modal_body.find('.numpad').on("click",function(){
	var dis =$(".discount_input");
	var curr_val =dis.val();
	dis.val(curr_val+$(this).attr("value"));
 });
 dis_modal_body.find(".numpadclear").unbind("click");
 dis_modal_body.find(".numpadclear").bind("click",function(){
	 $(".discount_input").val('');
 });
})
function activate(elem){
	var append = $(".discount_type .label-info");
	var parent = $(elem).parent().parent();
	parent.find('button').removeClass("active");
	$(elem).addClass("active");
	append.html($(elem).html());
	if($(elem).html()=='Fixed'){
		discount_type = 2;
	}else{
		discount_type =1;
	}
}

function applyDiscount(){
	var total = getSubTotal();
	if(total > 0){
	discount_value=parseInt($(".discount_input").val());
	if(discount_type==1){
	discount_value = ((discount_value/100)*total);
	}
	var remove_discount = '<span style="cursor: pointer;margin:0px 2px;margin-top: -4px;" class="animated bounceIn btn btn-danger btn-xs cart-discount-button remove-action-bound" onclick="removeDiscount(this);"><i class="fa fa-times"></i></span>';
	var discount_html ='<span class="cart-discount pull-right">&#8358; '+(discount_value.toFixed(2))+'</span>';
	$(".cart-discount").html(remove_discount+discount_html);
	calculate_to_pay();
	}else{
		
	}
}

function removeDiscount(elem){
var html =$(elem).parent();
html.html('');
html.html('&#8358; 0.00')
discount_value =0;
calculate_to_pay();
}
function getSubTotal(){
var total =0;
$('.item-total-price').each(function(id,elem){
total +=parseInt($(elem).html());
});
return total;
}

function calculate_to_pay(){
var appen = $(".cart-topay");
var to_pay = getSubTotal() ;
to_pay = to_pay+calculateScharge();
to_pay = to_pay+calculateVat();
to_pay = to_pay - discount_value;
appen.html("&#8358; "+to_pay.toFixed(2));
}
function getTotalTopay(){
var appen = $(".cart-topay");
var to_pay = getSubTotal() ;
to_pay = to_pay+calculateScharge();
to_pay = to_pay+calculateVat();
to_pay = to_pay - discount_value;
return to_pay;
}

function PayNow(){
	if(getSubTotal() ==0){
		error('Empty cart!..');
	}
	else if($("#customer_id").val()==""){
			error("Please select a customer");
	}else if($("#user_id").val()==""){
			error("Please select Sales Representative!!..");
	}else if($("#method").val()==""){
			error("Please Select Payment Method");
	}else if(getTotalTopay() > total_amt){
			error("Total Cart seems to greater than Amount deposited!!..");
	}
	else{
		var data = {};
		var form_data ={};
		var bar_code =  {};
		$(".shop_item_quantity").each(function(id,elem){
			form_data[$(elem).attr('data-id')] = $(elem).val();
			bar_code[$(elem).attr('data-id')] = barcodes_product_id[$(elem).attr('data-id')];
		});
		data['cart'] = form_data;
		data['barcodes'] = bar_code;
		data['user_id'] = $("#user_id").val()
		data['discount'] = discount_value;
		data['method'] = $("#method").val();
		data['discount_type'] = discount_type;
		data['comment'] = $("#cart_note").html();
		data['customer_id'] = $("#customer_id").val();
		data['rec_size'] = $("#rec_size").val();
		myApp.showPleaseWait();
		ajaxSentRequest($("#cart_form").attr('action'),data,function(result){
			result=JSON.parse(result);
			if(result.status==true){
				$("#cart-return-to-order").click();
				window.open(result.print,'width=400;hieght=400;','400','400');
				window.location = result.redirect;
				refresh_stock_list("Sales");
				
			}else{
				error(data.message)
			}
		});
	}
}

function calculateVat(){
var total = getSubTotal();
var vat = (<?php echo $this->settings->getSettings()['vat'] ?>/100)*total;
$(".cart-vat").html('&#8358; '+vat.toFixed(2));
return vat;
}
function calculateScharge(){
var total = getSubTotal();
var vscharge = (<?php echo $this->settings->getSettings()['scharge'] ?>/100)*total;
$(".cart-s-charger").html('&#8358; '+vscharge.toFixed(2));
return vscharge;
}




function refresh_stock_list(something){
myApp.hidePleaseWait();
success(something+" Generated Successfully");
}


function search_list(input,ul_list) {
    // Declare variables
    var input, filter, ul, li, a, i;
    filter = input.value.toUpperCase();
    ul = document.getElementById(ul_list);
    li = ul.getElementsByClassName('shop-items');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByClassName("marquee_me")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function barcode_exist(barcode){
if($("."+barcode).html()){
	return true;
}
return false
}

function remove_barcode(barcode){
bar_cache = {};
for(var keys in barcodes){
	if(barcodes[keys]!=barcode){
		bar_cache[(Object.keys(bar_cache).length)+1] =barcode;
	}
}
barcodes =	bar_cache;
}



function getInputFromBarcode(code,qty){
	if(swal.isVisible()){
		swal.close()
	}else{
	 $.get('<?php  echo base_url("dashboard/getProductAssociatedWithBarcode?barcode=") ?>'+code,function(result){
			result = JSON.parse(result);
			
			 if(result.status == false){;
				  error(result.message)
			 }else if(result.quantity == 0){
				 error("Item Out of Stock");
			 }else if(barcode_exist(result.id_stock)==true){
				$("#tr-"+result.id_stock).find(".item_qty_plus").click();
				
			 }else{
				var item_id = result.id_stock;
				var amount = result.price;
				var item_name = result.product_name;
				var data_track ="1";
				var data_qty = result.quantity;
				//add barcode with product_id;
				if(barcodes[item_id]){
				}else{
					barcodes[result.id_stock] = result.id_stock;
				}
				var cart_appender = $('#cart_appender');
				var no_item_html ='<tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr>';
				var new_item_html='<tr id="tr-'+result.id_stock+'" class="item_list '+result.id_stock+'" data-amount="'+amount+'" data-id="'+item_id+'"><td class="text-left" style="line-height:30px;" width="200"><p style="width:45px;margin:0px;float:left"><a class="btn btn-sm btn-default quick_edit_item" href="javascript:void(0)" onclick="$(this).parent().parent().parent().remove();calculateSub();countItem();" style="float:left;vertical-align:inherit;margin-right:10px;"><i class="fa fa-trash"></i></a></p><p class="filter-add-product" style="text-transform: uppercase;float:left;width:76%;margin-bottom:0px;" class="item-name">'+item_name+'</p></td><td class="text-center item-unit-price hidden-xs" style="line-height:30px;" width="110">'+amount+'</td><td class="text-center item-control-btns" width="100"><div class="input-group" style="width:100px"><span class="input-group-btn"><button class="btn btn-default item_qty_plus" type="button"><span class="" aria-hidden="true"></span><i class="fa fa-plus"></i></button></span><input type="number" readonly name="qty" data-qty="'+data_qty+'" data-track="'+data_track+'" data-id="'+item_id+'"  value="1" style="width:60px"class="form-control shop_item_quantity" placeholder="Qty" /><span class="input-group-btn"><button  class="btn btn-default item_qty_minus" type="button"><span  aria-hidden="true"></span><i class="fa fa-minus"></i></button></span></div></td><td class="text-right item-total-price" style="line-height:30px;" width="100">'+(parseInt(amount).toFixed(2))+'</td></tr>';
				if(no_item_html==cart_appender.html()){
					cart_appender.html('');
				}
				var adding = true;
				$('.item_list').each(function(id,elem){
					var ex_data_id = $(elem).attr('data-id');
					if(parseInt(ex_data_id) ==parseInt(item_id)){
						var qty_val = $(elem).find('.shop_item_quantity');
						var qty = parseInt(qty_val.val());
						qty++;
						if(data_track=="1"){
							adding = false;
							if(parseInt(data_qty) > 0){
							if(parseInt(qty) <= parseInt(data_qty)){
								
								$(qty_val).val(qty);
								var parent = $(elem);
								var data_amount = (qty * parseInt(parent.attr('data-amount')));
								var item_total_price = parent.find('.item-total-price');
								item_total_price.html(data_amount.toFixed(2));
								calculateSub();
							}else{
								error("Quantity Must not be Greater than Availabe Quantity("+data_qty+")")
							}
							}else{
								error("Item Out of Stock");
								return;
							}
						}else{
						$(qty_val).val(qty);
						adding = false;
						var parent = $(elem);
						var data_amount = (qty * parseInt(parent.attr('data-amount')));
						var item_total_price = parent.find('.item-total-price');
						item_total_price.html(data_amount.toFixed(2));
						calculateSub();
						}
					}
				});
				if(adding!=false){
				if(data_track=="1"){
					if(parseInt(data_qty) > 0){
						cart_appender.append(new_item_html);
				add_to_qty();
				minus_from_qty();
				countItem();
				calculateSub();
					}else{
							error("Item Out of Stock");
							return;
					}
				}else{
				cart_appender.append(new_item_html);
				add_to_qty();
				minus_from_qty();
				countItem();
				calculateSub();	
				}
				} 
			 }
	 });
	}
}

$("#cart-return-to-order").on("click",function(){
$('#cart_appender').html('');
discount_value =0;
$("#cart_note").html('');
discount_type=2;
$(".remove-action-bound").click();
$(".discount_input").val('');
$("#cart_form")[0].reset();
var append = $(".discount_type .label-info");
var elem = $('.flat_discount')
var parent = elem.parent().parent();
parent.find('button').removeClass("active");
$('.flat_discount').addClass('active');	
append.html('Fixed');
calculateSub();
countItem();	
});
</script>	
</body>

</html>