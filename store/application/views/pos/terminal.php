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
        .twitter-typeahead, .tt-hint, .tt-input, .tt-menu { width: 100%; }
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
            <div class="row checkout-header ng-scope">
                <div class="col-lg-4" >

                    <input type="text" name="search_bar" placeholder="Search for product name , model numbers product codes" style="margin-top:-25px" class="form-control" id="search_bar"/>
                </div>
                <div class="col-lg-1" style="margin-bottom:10px">
                    <?php
                    if($this->users->get_user_by_username($this->session->userdata("username"))->role!="Sales Representative"){
                    ?>
                    <center>  <button style="margin-top:-40px" onclick="goTo( '<?php echo base_url('dashboard'); ?>' )" class="btn btn-sm btn-default">
                            <i class="fa fa-home"></i> Dashboard</button></center>
                    <?php
                    }
                    ?>
                    <!-- <button onclick="openCalculator()" class="btn btn-sm btn-default calculator-button">
                 <i class="fa fa-calculator"></i> Calculator</button></center> --->
                </div>
				<!--
                <div class="col-lg-2">
                    <button style="margin-top:-40px" onclick="return LoadTodaySales();" class="btn btn-sm btn-default">
                        <i class="fa fa-arrow-lg-left"></i> Today's Sales</button>
                </div>
				-->

                <div class="col-lg-1">
                    
                <button style="margin-top:-40px" id="pending_cart_btn" class="btn btn-sm btn-default">
                    <?php  
                        $bid = $this->users->get_user_by_username($this->session->userdata("username"))->branch_id;
                        $branch_detail = $this->users->get_user_branch_by_id($bid);
            
                        if($branch_detail){
                            echo $branch_detail->branch_name;
                        }else{
                            echo "no branch";
                        } 
                        ?>
                 </button>
               </div>



                <div class="col-lg-2">
                    <button style="margin-top:-40px" id="pending_cart_btn" onclick="return LoadPendingcart();" class="btn btn-sm btn-default">
                        <?php
                        $count =0;
                        if($this->session->userdata('pending_cart')){
                            $count = "(".sizeof($this->session->userdata('pending_cart')).")";
                        }else{
                            $count ="";
                        }
                        ?>
                        <i class="fa fa-arrow-lg-left"></i> Pending Cart<?php echo $count; ?></button>
                </div>
                <div class="col-lg-2">
                    <button style="margin-top:-40px" onclick="goTo( '<?php echo base_url('auth/logout'); ?>' )" class="btn btn-sm btn-default">
                        <i class="fa fa-arrow-lg-left"></i> Log Out</button>
                </div>
                <div class="col-lg-2">
                    <button style="margin-top:-40px" onclick="goTo( '<?php echo base_url('dashboard/myprofile'); ?>' )" class="btn btn-sm btn-default">
                        <i class="fa fa-user"></i> My Profile</button>
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
                                <div class="col-lg-2">
                                    <select name="customer_id" class="form-control select2_demo_2" id="customer_id">
                                        <option class="bs-title-option" value="">Select Customer</option>
                                        <?php
                                        $customers = $this->settings->getCustomers();
                                        foreach($customers as $customer){
                                            ?>
                                            <option value="<?php echo $customer['SN'] ?>"><?php echo $customer['firstname'] ?>  <?php echo $customer['lastname'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="col-lg-2">
                                    <select name="customer_id" id="customer_id" class="form-control select2_demo_2">
                                        <option class="bs-title-option" value="">Select Customer</option>
                                        <?php
                                        $customers = $this->settings->getCustomers();
                                        foreach($customers as $customer){
                                            ?>
                                            <option value="<?php echo $customer['SN'] ?>"><?php echo $customer['firstname'] ?>  <?php echo $customer['lastname'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <?php
                            }
                            ?>
                            <div class="col-lg-2">
					<span class="input-group-btn">
                    <button type="button" data-toggle="modal" data-target="#PrimaryModalalert" class="btn btn-default"  title="Add a customer">
                        <i class="fa fa-user"></i>
                        <span class="hidden-sm hidden-xs">New customer</span>
                       
                    </button>
                    <button class="btn btn-default" type="button"  data-toggle="modal" data-target="#InformationproModalalert"> <i class="fa fa-pencil"></i> <span class="hidden-sm hidden-xs">Note</span></button>                    
                </span>
                            </div>

                            <div class="col-lg-2">
                                <select name="rec_size" id="rec_size" class="form-control select2_demo_2">
                                    <option value="thermal">Thermal Receipt</option>
                                    <option value="Big">Big Receipt</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->users->get_user_by_username($this->session->userdata("username"))->SN; ?>"/>
                                <b class="form-control"><?php echo ucwords($this->session->userdata("username")); ?></b>
                            </div>
                            <div class="col-lg-2">
                                <select name="user_id" id="method" class="form-control select2_demo_2">
                                    <option value="">Payment Method</option>
                                    <?php
                                    $methods = $this->db->get('payment_method')->result_array();
                                    foreach($methods as $method){
                                        if($method['payment_method'] !="DEPOSIT"){
                                            ?>
                                            <option value="<?php echo $method['SN'] ?>"><?php echo $method['payment_method'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            $admin_pickup = 1;
                            if($admin_pickup == 1){
                                ?>
                                <?php

                                ?>

                                <?php
                                $user_id = $this->tank_auth->get_user_id();
                                $user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
                                if($user['role'] == "Top Administrator"){
                                    ?>
                                    <div class="col-lg-2">
                                        <select name="sales_type" id="sales_type" class="form-control select2_demo_2">
                                            <option value="COMPLETE" selected="selected">NORMAL SALES</option>
                                            <option value="PICKUP">ADMIN PICKUP</option>
                                        </select>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <input type="hidden" name="sales_type" id="sales_type" value="COMPLETE"/>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                        <br/>
                        <div class="row">

                            <form action="<?php echo base_url("dashboard/posSave");  ?>" id="cart_form" method="POST">

                                <div class="direct-chat-messages" id="cart-table-body" style="padding: 0px; height: 310px; overflow:auto;">
                                    <table class="table" style="margin-bottom:0;font-size:12px;"><tbody id="cart_appender"><tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr></tbody></table>
                                </div>
                            </form>
                            <script>
                  
                                    var elem = document.getElementById('cart-table-body');
                                    elem.scrollTop = elem.scrollHeight;
                         
                            </script>
                            <table class="table" id="cart-details">
                                <tfoot class="hidden-xs hidden-sm hidden-md">
                                <tr class="active">
                                    <td class="text-left" width="200"><b>Number of Items ( <span class="items-number">0</span> )</b></td>
                                    <td class="text-right hidden-xs" width="150"></td>
                                    <td class="text-right" width="150"><b>Sub Total</b></td>
                                    <td class="text-right" width="90"><span class="cart-value">&#8358 0.00 </span></td>
                                </tr>
                                <tr class="active">
                                    <td></td>
                                    <td></td>
                                    <td class="text-right cart-discount-notice-area"><b>Discount on Cart</b></td>
                                    <td class="text-right cart-discount-remove-wrapper"><span class="cart-discount pull-right">&#8358 0.00 </span></td>
                                </tr>
                                <tr class="active">
                                    <td></td>
                                    <td></td>
                                    <td class="text-right cart-discount-notice-area"><b>VAT</b></td>
                                    <td class="text-right cart-discount-remove-wrapper"><span class="cart-vat pull-right">&#8358 0.00 </span></td>
                                </tr>
                                <tr class="active" style="display:none;">
                                    <td></td>
                                    <td></td>
                                    <td class="text-right cart-discount-notice-area">Service Charge(<?php echo $this->settings->getSettings()['scharge'] ?>%)</td>
                                    <td class="text-right cart-discount-remove-wrapper"><span class="cart-s-charger pull-right">&#8358 0.00 </span></td>
                                </tr>
                                <tr class="success">
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"><strong>
                                        </strong></td>
                                    <td class="text-right"><b style="font-size: 30px;color:blue;"><span class="cart-topay pull-right">&#8358; 0.00 </span></b></td>
                                </tr>
                                </tfoot>

                            </table>
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                <div class="btn-group ng-scope" role="group" ng-controller="payBox">
                                    <button type="button" id="payNoww" class="btn btn-primary btn-lg sendToKitchenButton" onclick="PayNow();" style="margin-bottom:0px;"> <i class="fa fa-money"></i>
                                        <span class="hidden-xs">Pay Now</span>
                                    </button>
                                </div>
                                <div class="btn-group ng-scope" role="group" ng-controller="saveBox">
                                    <button type="button" onclick="holdNow()" class="hold_btn btn btn-success btn-lg" style="margin-bottom:0px;"> <i class="fa fa-hand-stop-o"></i>
                                        <span class="hidden-xs">Hold</span>
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
    Number.prototype.money =function(amount, decimalCount = 2, decimal = ".", thousands = ","){
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

            const negativeSign = amount < 0 ? "-" : "";

            let i = parseFloat(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
            error("Invalid total please reeload the application");
        }
    }
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
        var new_item_html='<tr class="item_list" data-amount="'+amount+'" data-id="'+item_id+'"><td class="text-left" style="line-height:30px;" width="200"><p style="width:45px;margin:0px;float:left"><a class="btn btn-sm btn-default quick_edit_item" href="javascript:void(0)" onclick="$(this).parent().parent().parent().remove();calculateSub();countItem();" style="float:left;vertical-align:inherit;margin-right:10px;"><i class="fa fa-trash"></i></a></p><p class="filter-add-product" style="text-transform: uppercase;float:left;width:76%;margin-bottom:0px;" class="item-name">'+item_name+'</p></td><td class="text-center item-unit-price hidden-xs" style="line-height:30px;" width="110">'+amount+'</td><td class="text-center item-control-btns" width="100"><div class="input-group" style="width:100px"><span class="input-group-btn"><button class="btn btn-default item_qty_plus" type="button"><span class="" aria-hidden="true"></span><i class="fa fa-plus"></i></button></span><input type="number"  name="qty" data-qty="'+data_qty+'" data-track="'+data_track+'" data-id="'+item_id+'" value="1" style="width:140px"class="form-control shop_item_quantity" placeholder="Qty" /><span class="input-group-btn"><button  class="btn btn-default item_qty_minus" type="button"><span  aria-hidden="true"></span><i class="fa fa-minus"></i></button></span></div></td><td class="text-right item-total-price" style="line-height:30px;" width="100" total_price="'+(parseFloat(amount).toFixed(2))+'">'+numberWithCommas((parseFloat(amount).toFixed(2)))+'</td></tr>';
        if(no_item_html==cart_appender.html()){
            cart_appender.html('');
        }
        var adding = true;
        $('.item_list').each(function(id,elem){
            var ex_data_id = $(elem).attr('data-id');
            if(parseFloat(ex_data_id) ==parseFloat(item_id)){
                var qty_val = $(elem).find('.shop_item_quantity');
                var qty = parseFloat(qty_val.val());
                qty++;
                if(data_track=="1"){
                    adding = false;
                    if(parseFloat(data_qty) > 0){
                        if(parseFloat(qty) <= parseFloat(data_qty)){
                            $(qty_val).val(qty);
                            var parent = $(elem);
                            var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                            var item_total_price = parent.find('.item-total-price');
                            item_total_price.attr('total_price',data_amount.toFixed(2));
                            item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
                            calculateSub();
                        }else{
                            error("Quantity Must not be Greater than Available Quantity("+data_qty+")")
                        }
                    }else{
                        error("Item Out of Stock");
                    }
                }else{
                    $(qty_val).val(qty);
                    adding = false;
                    var parent = $(elem);
                    var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                    var item_total_price = parent.find('.item-total-price');
                    item_total_price.attr('total_price',data_amount.toFixed(2));
                    item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
                    calculateSub();
                }
            }
        });
        if(adding!=false){
            if(data_track=="1"){
                if(parseFloat(data_qty) > 0){
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

   function bindtextbox(){
        $('.shop_item_quantity').off('keyup');
        $('.shop_item_quantity').on("keyup",function(){
            qty_val= $(this);
            var data_qty= parseFloat(qty_val.attr('data-qty'));
            var parent = $(this).parent().parent().parent();
            var qty = parseFloat((qty_val.val()=="" ? 0 : qty_val.val()));
            if(qty > data_qty){
                error("Quantity Must not be Greater than Availabe Quantity("+data_qty+")")
                qty_val.val(data_qty);
            }
            var data_amount = (qty * parseFloat(parent.attr('data-amount')));
            var item_total_price = parent.find('.item-total-price');
            item_total_price.attr('total_price',data_amount.toFixed(2));
            item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
            calculateSub();
        })
    }

    function add_to_qty(){
		bindtextbox();
        $(".item_qty_plus").unbind("click");
        $(".item_qty_plus").bind("click",function(){
            var parent = $(this).parent().parent().parent();
            qty_val=parent.find('.shop_item_quantity');
            var qty = parseFloat(qty_val.val());
            var data_track = qty_val.attr('data-track');
            var data_qty= parseFloat(qty_val.attr('data-qty'))
            qty =qty+1;
            if(qty<=data_qty){
                $(qty_val).val(qty);
                parent = parent.parent();
                var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                var item_total_price = parent.find('.item-total-price');
                item_total_price.attr('total_price',data_amount.toFixed(2));
                item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
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
            var qty = parseFloat(qty_val.val());
            qty = qty-1;
            if(qty==0){
                parent = parent.parent().remove();
            }else{
                $(qty_val).val(qty);
                parent = parent.parent();
                var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                var item_total_price = parent.find('.item-total-price');
                item_total_price.attr('total_price',data_amount.toFixed(2));
                item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
            }
            calculateSub();
        });
    }



    function calculateSub(){
        var total =0;
        $('.item-total-price').each(function(id,elem){
            total +=parseFloat($(elem).attr('total_price'));
        });

        $('.cart-value').html("&#8358; "+(numberWithCommas(total.toFixed(2))));
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
<style>
  .packed:hover{
    background:#0b81bb;
     color:#FFF;
  }
</style>
<div id="packed_product_modal"  class="modal" role="dialog">
    <div class="modal-dialog" style="width:40%;">
        <div class="modal-content" style="margin-top: 25%;">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style="">
                        <div class="col-md-6">
                            <div class="panel panel-flat packed" id="packed_price" onclick="fetch_product_multitype(this,'packed')" style="cursor: pointer;border:1px solid #eeeeee;border-radius: 5px;">
                                <div class="panel-heading" style="font-size: 20px;"><center>Packed Product</center></div>
                                <div class="panel-body">
                                    <img src="<?php echo base_url('assets/packed.png')  ?>" class="img-responsive"/>
                                    <br/>
                                    <h4 align="center"></h4>
                               </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-flat packed" onclick="fetch_product_multitype(this,'unpacked')" id="unpacked_price" style="cursor: pointer;border:1px solid #eeeeee;border-radius: 5px;">
                                <div class="panel-heading" style="font-size: 20px;"><center>Pieces Product</center></div>
                                <div class="panel-body">
                                    <img src="<?php echo base_url('assets/unpacked.png')  ?>" class="img-responsive"/>
                                    <br/><br/>
                                    <h4 align="center"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.total_split = 0;
</script>
<div id="split_payment"  class="modal modal-adminpro-general fullwidth-popup-InformationproModal rotateInUpRight" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <h2 align="center">SPLIT PAYMENT DIALOG</h2>
                <div class="row" id="split_payment_sales">
                    <table class="table table-bordered">
                        <tbody>
                        <tr><th style="font-size:20px;font-weight:bold;">Payment Method<th style="font-size:20px;font-weight:bold;"><span>SPLIT PAYMENT</span></th></tr>
                        <tr><th style="font-size:20px;font-weight:bold;">Total Amount<th><span class="topay_bal" style="font-size:20px;font-weight:bold;"></span></th></tr>
                        <?php
                        $methods = $this->db->get('payment_method')->result_array();
                        foreach($methods as $method){
                            if($method['payment_method'] !="DEPOSIT" && $method['payment_method'] !="SPLIT PAYMENT"){
                                ?>
                                <tr><th style="font-size:20px;font-weight:bold;"><?php echo strtoupper($method['payment_method']) ?></th><th><input  type="number" name="<?php echo $method['SN'] ?>" class="form-control split_calculation" onkeyup="return split_calculation();" placeholder="<?php echo strtoupper($method['payment_method']) ?> AMOUNT"/></th></tr>
                                <?php
                            }
                        }
                        ?>
                        <tr><th style="font-size:20px;font-weight:bold;">Total Paid</th><th><span id="total_paid_split" style="font-size:20px;font-weight:bold;">0.00</span></th></tr>
                        </tbody>
                    </table>
                    <center><button class="btn btn-lg btn-primary cashpnow" disabled id="total_paid_split_btn" onclick="return PayNow(true)">Print Receipt</button></center>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cashsales"  class="modal modal-adminpro-general fullwidth-popup-InformationproModal rotateInUpRight" role="dialog">
    <div class="modal-dialog" style="width:30%;">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <h2 align="center">CASH PAYMENT DIALOG</h2>
                <div class="row" id="cash_sales">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                        <tr><th style="font-size:20px;font-weight:bold;">Payment Method<th style="font-size:20px;font-weight:bold;"><span>CASH</span></th></tr>
                        <tr><th style="font-size:20px;font-weight:bold;">Total Amount<th><span id="topay_bal" style="font-size:20px;font-weight:bold;"></span></th></tr>
                        <tr><th style="font-size:20px;font-weight:bold;">Amount Tendered<th><input onkeyup="return cal_caculate_chage($(this).val());" type="number" name="tendered" id="amount_tendered" class="form-control" placeholder="Amount Tendered"/></th></tr>

                        </tr>
                        </tbody>
                    </table>
                    <h5 align="center">Customer Change</h5>
                    <span style="font-size:55px;font-weight:bold;" id="bal_change">&#8358; 0.00</span>
                    <br/>
                    <center><button class="btn btn-lg btn-primary" id="cashpnow" onclick="$('#cashsales').modal('show'); return PayNow(true)">Print Receiptooo</button></center>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dailySalesModal"  class="modal modal-adminpro-general fullwidth-popup-InformationproModal rotateInUpRight" role="dialog">
    <div class="modal-dialog" style="width:88%;">

        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="row" id="dailySalesModalloader">

                </div>
            </div>
        </div>
    </div>
</div>
<div id="PendingCartModal"  class="modal modal-adminpro-general fullwidth-popup-InformationproModal rotateInUpRight" role="dialog">
    <div class="modal-dialog" style="width:88%;">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="row" id="PendingCartModal_div">

                </div>
            </div>
        </div>
    </div>
</div>
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
    var continue_id = ""
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
            discount_value=parseFloat($(".discount_input").val());
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
            total +=parseFloat($(elem).attr('total_price'));
        });
        return total;
    }

    function calculate_to_pay(){
        var appen = $(".cart-topay");
        var to_pay = getSubTotal() ;
        to_pay = to_pay+calculateScharge();
        to_pay = to_pay+calculateVat();
        to_pay = to_pay - discount_value;
        appen.html("&#8358; "+numberWithCommas(to_pay.toFixed(2)));
        $("#topay_bal").html("&#8358; "+to_pay.money(to_pay));
        $(".topay_bal").html("&#8358; "+to_pay.money(to_pay));
        return to_pay;
    }

    function cal_caculate_chage(val){
        if(val !=""){
            var to_pay = getSubTotal() ;
            to_pay = to_pay+calculateScharge();
//to_pay = to_pay+calculateVat();
            to_pay = to_pay - discount_value;
            change = parseFloat(val) - to_pay ;
            if(change > 0){
                $("#bal_change").html("&#8358; "+change.money(change))
            }else{
                $("#bal_change").html("&#8358; 0.00")
            }
        }else{
            $("#bal_change").html("&#8358; 0.00")
        }
    }

    function holdNow(){
        var data = {};
        var form_data ={};
        var product_type = {};
        if(getSubTotal() ==0){
            error('Empty cart!..');
        }else {
            $(".shop_item_quantity").each(function (id, elem) {
                form_data[$(elem).attr('data-id')] = $(elem).val();
                product_type[$(elem).attr('data-id')] = $(elem).attr('data-product-type');
            });
            data['cart'] = form_data;
            data['product_type'] = product_type;
            myApp.showPleaseWait();
            ajaxSentRequest('<?php echo base_url('dashboard/hold_cart') ?>', data, function (result) {
                myApp.hidePleaseWait();
                result = JSON.parse(result);
                if (result.status == true) {
                    alert('Item has been saved successfully!..');
                    window.location.reload();
                } else {
                    error('Server error while saving cart, please try again!..')
                }

            });
        }
    }

    function PayNow(dialog = false){
        var customer = '';
        if($("#customer_id").val()==""){
            customer = 0;
        }else{
            customer = $("#customer_id").val();
        }
        if(getSubTotal() ==0){
            error('Empty cart!..');
        }
        else if($("#user_id").val()==""){
            error("Please select Sales Representative!!..");
        }else if($("#method").val()==""){
            error("Please select Payment Method");
        }
        else{
            var data = {};
            var form_data ={};
            var bar_code =  {};
            var product_type = {};
            $(".shop_item_quantity").each(function(id,elem){
                form_data[$(elem).attr('data-id')] = $(elem).val();
                bar_code[$(elem).attr('data-id')] = barcodes_product_id[$(elem).attr('data-id')];
                product_type[$(elem).attr('data-id')] = $(elem).attr('data-product-type');
            });
            data['cart'] = form_data;
            data['barcodes'] = bar_code;
            data['product_type'] = product_type;
            data['user_id'] = $("#user_id").val();
            data['discount'] = discount_value;
            data['method'] = $("#method").val();
            data['discount_type'] = discount_type;
            data['comment'] = $("#cart_note").html();
            data['customer_id'] = $("#customer_id").val();
            data['rec_size'] = $("#rec_size").val();
            data['sales_type'] = $('#sales_type').val();
            data['vat'] = calculateVat();
            if(continue_id !=""){
                data['cart_continue_id'] = continue_id;
            }
            if(data['method'] == "2" && dialog ==false && data['sales_type']!="PICKUP") {
                $('#cashsales').modal('show');
            }else if((data['method'] == "4") && dialog ==false && data['sales_type']!="PICKUP"){
                $('#split_payment').modal('show');
            }else {

                var payment = [];
                if(data['method'] == "4"){
                    $('.split_calculation').each(function(index,element){
                        if($.trim($(element).val()) !== "") {
                            payment.push({'user':'<?php echo $this->tank_auth->get_user_id() ?>','payment_date':'<?php echo date('Y-m-d') ?>','department':'<?php echo $this->stock->getUserDepartmentPos() ?>','customer':customer,'payment_method_id': $(element).attr('name'), 'amount': $(element).val()})
                        }
                    });
                }else if(data['method'] == "2"){
                    payment.push({'user':'<?php echo $this->tank_auth->get_user_id() ?>','payment_date':'<?php echo date('Y-m-d') ?>','department':'<?php echo $this->stock->getUserDepartmentPos() ?>','customer':customer, 'payment_method_id': 2, 'amount': calculate_to_pay()})
                }else if(data['method'] == "1"){
                    payment.push({'user':'<?php echo $this->tank_auth->get_user_id() ?>','payment_date':'<?php echo date('Y-m-d') ?>','department':'<?php echo $this->stock->getUserDepartmentPos() ?>','customer':customer, 'payment_method_id': 1, 'amount': calculate_to_pay()})
                }

                data['payments'] = payment;


                $("#pnow").attr("disabled","disabled");
                $("#cashpnow").attr("disabled","disabled");
                if($("#amount_tendered").val() !==""){
                    data['amount_tendered'] = $("#amount_tendered").val();
                }
                myApp.showPleaseWait();
                $("#pnow").attr("disabled","disabled");
                $(".cashpnow").attr("disabled","disabled");
                ajaxSentRequest($("#cart_form").attr('action'), data, function (result) {
                    result = JSON.parse(result);
                    if (result.status == true) {
                        $("#cart-return-to-order").click();
                        window.open(result.print, 'width=400;hieght=400;', '400', '400');
                        refresh_stock_list("Sales");
                    } else {
                        error(result.message);
                        myApp.hidePleaseWait();
                        $("#pnow").removeAttr("disabled","disabled");
                        $(".cashpnow").removeAttr("disabled","disabled");
                    }
                });
            }
        }
    }


    function split_calculation(){
        window.total_split = 0;
        $('.split_calculation').each(function(index,element){
            if($.trim($(element).val()) !== "") {
                window.total_split += parseFloat($(element).val());
            }
        });
        var total = calculate_to_pay();
        $('#total_paid_split').html(''+window.total_split.money(window.total_split));
        if((window.total_split === total || window.total_split > total)){
            $('#total_paid_split_btn').removeAttr('disabled');
        }else{
            $('#total_paid_split_btn').attr('disabled','disabled');
        }

    }

    function calculateVat(){
        var total_vat = 0;
        $('.shop_item_quantity').each(function(i,elem){
            var vat = parseFloat($(elem).attr('data-vat'));
            var qty = parseFloat($(elem).val());
            var price = parseFloat($(elem).attr('data-price'));
            var total = price*qty;
            var vat_ = ((vat/100) * total);
            total_vat+=vat_;
        });
        $(".cart-vat").html('&#8358; '+total_vat.toFixed(2));
        return total_vat;
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
        window.location.reload();
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
                }else if(result.product_type == "Packed"){
                    $('#packed_price h4').html('&#8358;'+result.whole_price);
                    $("#unpacked_price h4").html('&#8358;'+result.price);

                    $('#packed_price').attr('data_id',result.cat_id);
                    $('#unpacked_price').attr('data_id',result.cat_id);
                    $('#packed_product_modal').modal('show');
                }
                else if(result.quantity == 0){
                    error("Item Out of Stock");
                }else if(barcode_exist(result.id_stock)==true){
                    $("#tr-"+result.id_stock).find(".item_qty_plus").click();

                }else{
                    var item_id = result.id_stock;
                    var amount = result.price;
                    var item_name = result.product_name;
                    var data_track ="1";
                    var vat = result.vat;
                    var typed_product = result.type;
                    var data_qty = result.quantity;
                    //add barcode with product_id;
                    if(barcodes[item_id]){
                    }else{
                        barcodes[result.id_stock] = result.id_stock;
                    }
                    var cart_appender = $('#cart_appender');
                    var no_item_html ='<tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr>';
                    var new_item_html='<tr id="tr-'+result.id_stock+'" class="item_list '+result.id_stock+'" data-vat="'+vat+'" data-amount="'+amount+'" data-id="'+item_id+'"><td class="text-left" style="line-height:30px;" width="200"><p style="width:45px;margin:0px;float:left"><a class="btn btn-sm btn-default quick_edit_item" href="javascript:void(0)" onclick="$(this).parent().parent().parent().remove();calculateSub();countItem();" style="float:left;vertical-align:inherit;margin-right:10px;"><i class="fa fa-trash"></i></a></p><p class="filter-add-product" style="text-transform: uppercase;float:left;width:76%;margin-bottom:0px;" class="item-name"><b>'+item_name+'</b></p></td><td class="text-center item-unit-price hidden-xs" style="line-height:30px;" width="110"><b>'+amount+'</b></td><td class="text-center item-control-btns" width="100"><div class="input-group" style="width:100px"><span class="input-group-btn"><button class="btn btn-default item_qty_plus" type="button"><span class="" aria-hidden="true"></span><i class="fa fa-plus"></i></button></span><input type="number" data-vat="'+vat+'" data-price="'+amount+'" data-product-type="'+typed_product+'"  name="qty" data-qty="'+data_qty+'" data-track="'+data_track+'" data-id="'+item_id+'"  value="1" style="width:140px" class="form-control shop_item_quantity" placeholder="Qty" /><span class="input-group-btn"><button  class="btn btn-default item_qty_minus" type="button"><span  aria-hidden="true"></span><i class="fa fa-minus"></i></button></span></div></td><td class="text-right" style="line-height:30px;" width="100"><b style="font-size: 15px;color:blue" class="item-total-price" total_price="'+(parseFloat(amount).toFixed(2))+'">'+numberWithCommas((parseFloat(amount).toFixed(2)))+'</b></td></tr>';
                    if(no_item_html==cart_appender.html()){
                        cart_appender.html('');
                    }
                    var adding = true;
                    $('.item_list').each(function(id,elem){
                        var ex_data_id = $(elem).attr('data-id');
                        if(parseFloat(ex_data_id) ==parseFloat(item_id)){
                            var qty_val = $(elem).find('.shop_item_quantity');
                            var qty = parseFloat(qty_val.val());
                            qty++;
                            if(data_track=="1"){
                                adding = false;
                                if(parseFloat(data_qty) > 0){
                                    if(parseFloat(qty) <= parseFloat(data_qty)){

                                        $(qty_val).val(qty);
                                        var parent = $(elem);
                                        var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                                        var item_total_price = parent.find('.item-total-price');
                                        item_total_price.attr('total_price',data_amount.toFixed(2));
                                        item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
                                        calculateSub();
                                    }else{
                                        error("Quantity Must not be Greater than Available Quantity("+data_qty+")")
                                    }
                                }else{
                                    error("Item Out of Stock");
                                    return;
                                }
                            }else{
                                $(qty_val).val(qty);
                                adding = false;
                                var parent = $(elem);
                                var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                                var item_total_price = parent.find('.item-total-price');
                                item_total_price.attr('total_price',data_amount.toFixed(2));
                                item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
                                calculateSub();
                            }
                        }
                    });
                    if(adding!=false){
                        if(data_track=="1"){
                            if(parseFloat(data_qty) > 0){
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
				 autoScroll();
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

    function LoadTodaySales(){
        $('#dailySalesModal').modal('show');
    }

    function LoadPendingcart(){
        $('#PendingCartModal').modal('show');
    }

    $('#PendingCartModal').on('shown.bs.modal', function (e) {
        $("#PendingCartModal_div").html("<h5 align='center'>Loading Please Wait...</h5>");
        $.get('<?php echo base_url('dashboard/list_pending_cart')  ?>',function(data){
            $("#PendingCartModal_div").html(data);
        });
    });

    function continue_cart(cart_id,btn){
        btn = $(btn);
        btn.attr('disabled','disabled').html('Please wait');
        $.get('<?php echo base_url('dashboard/continue_cart/') ?>'+cart_id,function(data){
            data = JSON.parse(data);
            if(data.status == true){
                $("#cart-return-to-order").click();
                var items = data.items;
                for(var i=0; i < items.length;i++){
                    for(var u=0; u < items[i].item_qty; u++) {
                        if(items[i].type == "packed"){
                            fetch_product_continue_type(items[i].id,items[i].type);
                        }else {
                            fetch_product_continue_type(items[i].id,items[i].type);
                        }
                    }
                }
                continue_id = cart_id;
                $('#PendingCartModal').modal('hide');
            }else{
                error('unknoe error occurred data not found!..');
            }



        });
    }
    function delete_cart(cart_id,btn){
        btn = $(btn);
        btn.attr('disabled','disabled').html('Please wait');
        $.get('<?php echo base_url('dashboard/delete_cart/') ?>'+cart_id,function(data){
            $("#pending_cart_btn").html(data);
            $.get('<?php echo base_url('dashboard/list_pending_cart')  ?>',function(data){
                $("#PendingCartModal_div").html(data);
            });
        });
    }


    $('#dailySalesModal').on('shown.bs.modal', function (e) {
        $("#dailySalesModalloader").html("<h5 align='center'>Loading Please Wait...</h5>");
        $.get('<?php echo base_url('dashboard/ref')  ?>',function(data){
            $("#dailySalesModalloader").html(data);
        });
    });

    function fetch_product_multitype(div,product_type){
        var id = $(div).attr('data_id');
        $.get('<?php echo base_url('dashboard/packed_and_unpacked/')  ?>'+id+"/"+product_type,function(response){
            $('#packed_product_modal').modal('hide');
            var result = JSON.parse(response);

            if(result.type == "packed"){
                result.id_stock =result.id_stock+ "packed";
            }

            if(result.status == false){
                error(result.message)
            }
            else if(result.quantity == 0){
                error("Item Out of Stock");
            }else if(barcode_exist(result.id_stock)==true){
                $("#tr-"+result.id_stock).find(".item_qty_plus").click();

            }else{
                var item_id = result.id_stock;
                var amount = result.price;
                var item_name = result.product_name;
                var data_track ="1";
                var vat = result.vat;
                var data_qty = result.quantity;
                var typed_product = result.type;
                //data-product-type="'+typed_product+'"
                //add barcode with product_id;
                if(barcodes[item_id]){
                }else{
                    barcodes[result.id_stock] = result.id_stock;
                }
                var cart_appender = $('#cart_appender');
                var no_item_html ='<tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr>';
                var new_item_html='<tr id="tr-'+result.id_stock+'" class="item_list '+result.id_stock+'" data-vat="'+vat+'" data-amount="'+amount+'" data-id="'+item_id+'"><td class="text-left" style="line-height:30px;" width="200"><p style="width:45px;margin:0px;float:left"><a class="btn btn-sm btn-default quick_edit_item" href="javascript:void(0)" onclick="$(this).parent().parent().parent().remove();calculateSub();countItem();" style="float:left;vertical-align:inherit;margin-right:10px;"><i class="fa fa-trash"></i></a></p><p class="filter-add-product" style="text-transform: uppercase;float:left;width:76%;margin-bottom:0px;" class="item-name"><b>'+item_name+'</b></p></td><td class="text-center item-unit-price hidden-xs" style="line-height:30px;" width="110"><b>'+amount+'</b></td><td class="text-center item-control-btns" width="100"><div class="input-group" style="width:100px"><span class="input-group-btn"><button class="btn btn-default item_qty_plus" type="button"><span class="" aria-hidden="true"></span><i class="fa fa-plus"></i></button></span><input type="number" data-vat="'+vat+'" data-price="'+amount+'" data-product-type="'+typed_product+'"  name="qty" data-qty="'+data_qty+'" data-track="'+data_track+'" data-id="'+item_id+'"  value="1" style="width:140px"class="form-control shop_item_quantity" placeholder="Qty" /><span class="input-group-btn"><button  class="btn btn-default item_qty_minus" type="button"><span  aria-hidden="true"></span><i class="fa fa-minus"></i></button></span></div></td><td class="text-right" style="line-height:30px;" width="100"><b style="font-size: 15px;color:blue" class="item-total-price" total_price="'+(parseFloat(amount).toFixed(2))+'">'+numberWithCommas((parseFloat(amount).toFixed(2)))+'</b></td></tr>';
                if(no_item_html==cart_appender.html()){
                    cart_appender.html('');
                }
                var adding = true;
                $('.item_list').each(function(id,elem){
                    var ex_data_id = $(elem).attr('data-id');
                    if(parseFloat(ex_data_id) ==parseFloat(item_id)){
                        var qty_val = $(elem).find('.shop_item_quantity');
                        var qty = parseFloat(qty_val.val());
                        qty++;
                        if(data_track=="1"){
                            adding = false;
                            if(parseFloat(data_qty) > 0){
                                if(parseFloat(qty) <= parseFloat(data_qty)){

                                    $(qty_val).val(qty);
                                    var parent = $(elem);
                                    var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                                    var item_total_price = parent.find('.item-total-price');
                                    item_total_price.attr('total_price',data_amount.toFixed(2));
                                    item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
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
                            var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                            var item_total_price = parent.find('.item-total-price');
                            item_total_price.attr('total_price',data_amount.toFixed(2));
                            item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
                            calculateSub();
                        }
                    }
                });
                if(adding!=false){
                    if(data_track=="1"){
                        if(parseFloat(data_qty) > 0){
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
        })
    }
    function fetch_product_continue_type(id,product_type){
        $.get('<?php echo base_url('dashboard/packed_and_unpacked/')  ?>'+id+"/"+product_type,function(response){
            $('#packed_product_modal').modal('hide');
            var result = JSON.parse(response);
            if(result.type == "packed"){
                result.id_stock =result.id_stock+ "packed";
            }
            if(result.status == false){
                error(result.message)
            }
            else if(result.quantity == 0){
                error("Item Out of Stock");
            }else if(barcode_exist(result.id_stock)==true){
                $("#tr-"+result.id_stock).find(".item_qty_plus").click();

            }else{
                var item_id = result.id_stock;
                var amount = result.price;
                var item_name = result.product_name;
                var data_track ="1";
                var vat = result.vat;
                var data_qty = result.quantity;
                var typed_product = result.type;
                if(result.type == "packed"){
                    var append_name = "packed";
                }else{
                    var append_name = "";
                }
                //data-product-type="'+typed_product+'"
                //add barcode with product_id;
                if(barcodes[item_id]){
                }else{
                    barcodes[result.id_stock] = result.id_stock;
                }
                var cart_appender = $('#cart_appender');
                var no_item_html ='<tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr>';
                var new_item_html='<tr id="tr-'+result.id_stock+'" class="item_list '+result.id_stock+'" data-vat="'+vat+'" data-amount="'+amount+'" data-id="'+item_id+'"><td class="text-left" style="line-height:30px;" width="200"><p style="width:45px;margin:0px;float:left"><a class="btn btn-sm btn-default quick_edit_item" href="javascript:void(0)" onclick="$(this).parent().parent().parent().remove();calculateSub();countItem();" style="float:left;vertical-align:inherit;margin-right:10px;"><i class="fa fa-trash"></i></a></p><p class="filter-add-product" style="text-transform: uppercase;float:left;width:76%;margin-bottom:0px;" class="item-name"><b>'+item_name+'</b></p></td><td class="text-center item-unit-price hidden-xs" style="line-height:30px;" width="110"><b>'+amount+'</b></td><td class="text-center item-control-btns" width="100"><div class="input-group" style="width:100px"><span class="input-group-btn"><button class="btn btn-default item_qty_plus" type="button"><span class="" aria-hidden="true"></span><i class="fa fa-plus"></i></button></span><input type="number" data-vat="'+vat+'" data-price="'+amount+'" data-product-type="'+typed_product+'"  name="qty" data-qty="'+data_qty+'" data-track="'+data_track+'" data-id="'+item_id+'"  value="1" style="width:140px"class="form-control shop_item_quantity" placeholder="Qty" /><span class="input-group-btn"><button  class="btn btn-default item_qty_minus" type="button"><span  aria-hidden="true"></span><i class="fa fa-minus"></i></button></span></div></td><td class="text-right" style="line-height:30px;" width="100"><b style="font-size: 15px;color:blue" class="item-total-price" total_price="'+(parseFloat(amount).toFixed(2))+'">'+numberWithCommas((parseFloat(amount).toFixed(2)))+'</b></td></tr>';
                if(no_item_html==cart_appender.html()){
                    cart_appender.html('');
                }
                var adding = true;
                $('.item_list').each(function(id,elem){
                    var ex_data_id = $(elem).attr('data-id');
                    if(parseFloat(ex_data_id) ==parseFloat(item_id)){
                        var qty_val = $(elem).find('.shop_item_quantity');
                        var qty = parseFloat(qty_val.val());
                        qty++;
                        if(data_track=="1"){
                            adding = false;
                            if(parseFloat(data_qty) > 0){
                                if(parseFloat(qty) <= parseFloat(data_qty)){

                                    $(qty_val).val(qty);
                                    var parent = $(elem);
                                    var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                                    var item_total_price = parent.find('.item-total-price');
                                    item_total_price.attr('total_price',data_amount.toFixed(2));
                                    item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
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
                            var data_amount = (qty * parseFloat(parent.attr('data-amount')));
                            var item_total_price = parent.find('.item-total-price');
                            item_total_price.attr('total_price',data_amount.toFixed(2));
                            item_total_price.html(numberWithCommas(data_amount.toFixed(2)));
                            calculateSub();
                        }
                    }
                });
                if(adding!=false){
                    if(data_track=="1"){
                        if(parseFloat(data_qty) > 0){
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
        })
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
 <script>
    function autoScroll(){
        var elem = document.getElementById('cart-table-body');
        elem.scrollTop = elem.scrollHeight;
   }
</script>
</body>

</html>
