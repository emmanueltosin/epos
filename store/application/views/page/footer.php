
</div>
</div>


<div id="form-bp1" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Scan Product Bar code</h3>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <select multiple="" class="tags">
                        </select>
                    </div></div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" onclick="cancel_me();" class="btn btn-default md-close">Cancel</button>
                <button type="button" id="save_product" onclick="save_product(this)" index data-dismiss="modal" class="btn btn-primary md-close">Save Product</button>
            </div>
        </div>
    </div>
</div>


</body>
<script>

    var BASE_URL = '<?php echo base_url(); ?>';
</script>
<script src="<?php  echo base_url('assets/lib/jquery/jquery.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/table/');  ?>datatables.min.js"></script>
<script src="<?php  echo base_url('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php  echo base_url('assets/lib/bootstrap/dist/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php  echo base_url('assets/js/main.js'); ?>" type="text/javascript"></script>
<script src="<?php  echo base_url(); ?>assets/lib/jquery.gritter/js/jquery.gritter.js" type="text/javascript"></script>
<script src="<?php echo base_url()  ?>js/Lobibox.js"></script>
<script>
    function success(msg){
        Lobibox.notify('success', {
            width: 600,
            msg: msg
        });
    }
    function error(msg){
        Lobibox.notify('error', {
            width: 600,
            msg:msg
        });
    }
    (function($){
        $.fn.scannerDetection=function(options){

            // If string given, call onComplete callback
            if(typeof options==="string"){
                this.each(function(){
                    this.scannerDetectionTest(options);
                });
                return this;
            }

            // If false (boolean) given, deinitialize plugin
            if(options === false){
                this.each(function(){
                    this.scannerDetectionOff();
                });
                return this;
            }

            var defaults={
                onComplete:false, // Callback after detection of a successfull scanning (scanned string in parameter)
                onError:false, // Callback after detection of a unsuccessfull scanning (scanned string in parameter)
                onReceive:false, // Callback after receiving and processing a char (scanned char in parameter)
                onKeyDetect:false, // Callback after detecting a keyDown (key char in parameter) - in contrast to onReceive, this fires for non-character keys like tab, arrows, etc. too!
                timeBeforeScanTest:100, // Wait duration (ms) after keypress event to check if scanning is finished
                avgTimeByChar:30, // Average time (ms) between 2 chars. Used to do difference between keyboard typing and scanning
                minLength:6, // Minimum length for a scanning
                endChar:[9,13], // Chars to remove and means end of scanning
                startChar:[], // Chars to remove and means start of scanning
                ignoreIfFocusOn:false, // do not handle scans if the currently focused element matches this selector
                scanButtonKeyCode:false, // Key code of the scanner hardware button (if the scanner button a acts as a key itself)
                scanButtonLongPressThreshold:3, // How many times the hardware button should issue a pressed event before a barcode is read to detect a longpress
                onScanButtonLongPressed:false, // Callback after detection of a successfull scan while the scan button was pressed and held down
                stopPropagation:false, // Stop immediate propagation on keypress event
                preventDefault:false // Prevent default action on keypress event
            };
            if(typeof options==="function"){
                options={onComplete:options}
            }
            if(typeof options!=="object"){
                options=$.extend({},defaults);
            }else{
                options=$.extend({},defaults,options);
            }

            this.each(function(){
                var self=this, $self=$(self), firstCharTime=0, lastCharTime=0, stringWriting='', callIsScanner=false, testTimer=false, scanButtonCounter=0;
                var initScannerDetection=function(){
                    firstCharTime=0;
                    stringWriting='';
                    scanButtonCounter=0;
                };
                self.scannerDetectionOff=function(){
                    $self.unbind('keydown.scannerDetection');
                    $self.unbind('keypress.scannerDetection');
                }
                self.isFocusOnIgnoredElement=function(){
                    if(!options.ignoreIfFocusOn) return false;
                    if(typeof options.ignoreIfFocusOn === 'string') return $(':focus').is(options.ignoreIfFocusOn);
                    if(typeof options.ignoreIfFocusOn === 'object' && options.ignoreIfFocusOn.length){
                        var focused=$(':focus');
                        for(var i=0; i<options.ignoreIfFocusOn.length; i++){
                            if(focused.is(options.ignoreIfFocusOn[i])){
                                return true;
                            }
                        }
                    }
                    return false;
                }
                self.scannerDetectionTest=function(s){
                    // If string is given, test it
                    if(s){
                        firstCharTime=lastCharTime=0;
                        stringWriting=s;
                    }

                    if (!scanButtonCounter){
                        scanButtonCounter = 1;
                    }

                    // If all condition are good (length, time...), call the callback and re-initialize the plugin for next scanning
                    // Else, just re-initialize
                    if(stringWriting.length>=options.minLength && lastCharTime-firstCharTime<stringWriting.length*options.avgTimeByChar){
                        if(options.onScanButtonLongPressed && scanButtonCounter > options.scanButtonLongPressThreshold) options.onScanButtonLongPressed.call(self,stringWriting,scanButtonCounter);
                        else if(options.onComplete) options.onComplete.call(self,stringWriting,scanButtonCounter);
                        $self.trigger('scannerDetectionComplete',{string:stringWriting});
                        initScannerDetection();
                        return true;
                    }else{
                        if(options.onError) options.onError.call(self,stringWriting);
                        $self.trigger('scannerDetectionError',{string:stringWriting});
                        initScannerDetection();
                        return false;
                    }
                }
                $self.data('scannerDetection',{options:options}).unbind('.scannerDetection').bind('keydown.scannerDetection',function(e){
                    // If it's just the button of the scanner, ignore it and wait for the real input
                    if(options.scanButtonKeyCode !== false && e.which==options.scanButtonKeyCode) {
                        scanButtonCounter++;
                        // Cancel default
                        e.preventDefault();
                        e.stopImmediatePropagation();
                    }
                    // Add event on keydown because keypress is not triggered for non character keys (tab, up, down...)
                    // So need that to check endChar and startChar (that is often tab or enter) and call keypress if necessary
                    else if((firstCharTime && options.endChar.indexOf(e.which)!==-1)
                        || (!firstCharTime && options.startChar.indexOf(e.which)!==-1)){
                        // Clone event, set type and trigger it
                        var e2=jQuery.Event('keypress',e);
                        e2.type='keypress.scannerDetection';
                        $self.triggerHandler(e2);
                        // Cancel default
                        e.preventDefault();
                        e.stopImmediatePropagation();
                    }
                    // Fire keyDetect event in any case!
                    if(options.onKeyDetect) options.onKeyDetect.call(self,e);
                    $self.trigger('scannerDetectionKeyDetect',{evt:e});

                }).bind('keypress.scannerDetection',function(e){
                    if (this.isFocusOnIgnoredElement()) return;
                    if(options.stopPropagation) e.stopImmediatePropagation();
                    if(options.preventDefault) e.preventDefault();

                    if(firstCharTime && options.endChar.indexOf(e.which)!==-1){
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        callIsScanner=true;
                    }else if(!firstCharTime && options.startChar.indexOf(e.which)!==-1){
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        callIsScanner=false;
                    }else{
                        if (typeof(e.which) != 'undefined'){
                            stringWriting+=String.fromCharCode(e.which);
                        }
                        callIsScanner=false;
                    }

                    if(!firstCharTime){
                        firstCharTime=Date.now();
                    }
                    lastCharTime=Date.now();

                    if(testTimer) clearTimeout(testTimer);
                    if(callIsScanner){
                        self.scannerDetectionTest();
                        testTimer=false;
                    }else{
                        testTimer=setTimeout(self.scannerDetectionTest,options.timeBeforeScanTest);
                    }

                    if(options.onReceive) options.onReceive.call(self,e);
                    $self.trigger('scannerDetectionReceive',{evt:e});
                });
            });
            return this;
        }
    })(jQuery);



    $(document).scannerDetection({
        timeBeforeScanTest: 200, // wait for the next character for upto 200ms
        endChar: [13], // be sure the scan is complete if key 13 (enter) is detected
        avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
        ignoreIfFocusOn: 'input', // turn off scanner detection if an input has focus
        startChar: [16], // Prefix character for the cabled scanner (OPL6845R)
        endChar: [40],
        onComplete: function(barcode, qty){
            <?php  if($page == "new_stock" || $page == "edit_stock"){ ?>
            checkIFProductCode(barcode);
            <?php }elseif($page =="new_recieved_supplier" || $page=="new_recieved_branch" ){ ?>
            addTemp(document.getElementById('add_product'),barcode)
            <?php  }elseif($page == "stock_single_recieved"){ ?>
            rec_product_bar_code(barcode);
            <?php  }else{ ?>
            getInputFromBarcode(barcode, qty);
            <?php  } ?>

        }, // main callback function
        scanButtonKeyCode: 116, // the hardware scan button acts as key 116 (F5)
        scanButtonLongPressThreshold: 5, // assume a long press if 5 or more events come in sequence
        onScanButtonLongPressed: function(){
            alert('key pressed');
        }, // callback for long pressing the scan button
        onError: function(string){}
    });

    function rec_product_bar_code(code){
        $.post(<?php echo "'".base_url('dashboard/checkifBarcodeExist2/')."'+code"  ?>,function(data){
            data = JSON.parse(data);
            if(data.status == true){
                $("#single_recieved").val(data.data.SN);
                $("#single_recieved").trigger('change');
                $('#s_form').submit();
            }else{
                $.gritter.add({
                    title: 'Error',
                    text: code+" does not exist, please check try again",
                    class_name: 'color danger'
                });
            }
        })
    }

    function checkIFProductCode(code){
        $.post(<?php echo "'".base_url('dashboard/checkifBarcodeExist/')."'+code"  ?>,function(data){
            data = JSON.parse(data);
            if(data.status == true){
                if($("#bar_code")){
                    $("#bar_code").html(code);
                }
                if($("#bar_code_code")){
                    $("#bar_code_code").val(code);
                }

            }else{
                $.gritter.add({
                    title: 'Error',
                    text: code+" bar code already exist",
                    class_name: 'color danger'
                });
            }
        })

    }

</script>



<?php  if($page == "dashboard"){ ?>

    <script src="<?php  echo base_url('assets/lib/jquery.sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('assets/lib/countup/countUp.min.js') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('assets/lib/jquery-ui/jquery-ui.min.js') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('assets/js/app-dashboard.js') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('assets/js/app-tables-datatables.js?v=1.21') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js');  ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('assets/lib/jquery.gritter/js/jquery.gritter.js') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url() ?>assets/lib/raphael/raphael-min.js" type="text/javascript"></script>
    <script src="<?php  echo base_url() ?>assets/lib/morrisjs/morris.min.js" type="text/javascript"></script>
    <script src="<?php  echo base_url() ?>assets/js/app-charts-morris.js" type="text/javascript"></script>
    <script src="<?php  echo base_url() ?>assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/select2/js/select2.min.js') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url() ?>assets/lib/chartjs/Chart.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function barChart(){
            //Set the chart colors
            var color1 = tinycolor( App.color.success );
            var color2 = tinycolor( App.color.warning );
            var ctx = document.getElementById("bar-chart");
            var ctxx = document.getElementById("sales_bar-chart");


            var data = {
                labels: data_in.labels,
                datasets: [{
                    label: "Received",
                    borderColor:  data_in.color1,
                    backgroundColor: data_in.color1,
                    data: data_in.in
                }]
            };

            /*
            {
                label: "Transfered",
                borderColor: data_in.color2,
                backgroundColor: data_in.color2,
                data: data_in.out
              }

            */

            var datasales = {
                labels: sales.labels,
                datasets: [{
                    label: "Income Report",
                    borderColor:  data_in.color1,
                    backgroundColor: data_in.color1,
                    data: sales.payment
                }]
            };

            <?php
            $d = $this->users->get_user_by_username($this->session->userdata("username"))->department;
            if($d!="Store") {
            ?>
            var bar = new Chart(ctxx, {
                type: 'bar',
                data: datasales,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: 'rgb(0, 255, 0)',
                            borderSkipped: 'bottom'
                        }
                    },
                }
            });
            <?php
            }
            ?>

            <?php
            $d = $this->users->get_user_by_username($this->session->userdata("username"))->department;
            if($d=="Store" || $d=='Top Administrator'){
            ?>

            var bar = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: 'rgb(0, 255, 0)',
                            borderSkipped: 'bottom'
                        }
                    },
                }
            });

            <?php
            }
            ?>
        }

        barChart();
        var product_zero = false;
        $.fn.niftyModal('setDefaults',{
            overlaySelector: '.modal-overlay',
            closeSelector: '.modal-close',
            classAddAfterOpen: 'modal-show',
        });

        $("#pick_up_form").on("submit",function(e){
            e.preventDefault();
            $("#form-bp1_conmplete").modal('show');
        });

        function submit_pickup(){
            if($("#pickup_staff").val()==""){
                alert('Missing Pick up staff name!!..');
                $("#pickup_staff").focus();
            }else{
                showLoader();
                $.post("<?php echo base_url("dashboard/addPickUp") ?>",$("#pick_up_form").serialize(),function(result){
                    result = JSON.parse(result);
                    hideLoader();
                    if(result.status){
                        $.gritter.add({
                            title: 'Success',
                            text: result.msg,
                            class_name: 'color success'
                        });
                        $("#pickup_staff").val('');
                        $('#note_pick').val('');
                        $("#produt_list").html('');
                        $("#close_asn_").click();
                        $("#new_pick_up").attr("style","display:none");
                        $("#click_to_trigger").attr("style","");
                        window.location.href = window.location.href;
                    }else{
                        $.gritter.add({
                            title: 'Error',
                            text: "Unknown error occured!!...",
                            class_name: 'color danger'
                        });
                    }

                })
            }
        }

        function showLoader(){
            var parent = $(this).parents('.widget, .panel');
            if( parent.length ){
                parent.addClass('be-loading-active');
            }
        }
        function hideLoader(){
            var parent = $(this).parents('.widget, .panel');
            if( parent.length ){
                parent.removeClass('be-loading-active');
            }
        }


        $('.update_pick_up_status').on("click",function(e){
            $(this).parent().parent().html('Posting.....');
            var obj = $(this);
            $.post($(this).attr("href"),{'value':$(this).attr('data-value')},function(result){
                var results = JSON.parse(result);
                if(results.status==true){
                    //obj.parent().parent().html("No Action");
                    //obj.parent().parent().parent().find(".label").html(results.message);
                    window.location.href= window.location.href;
                }
            });
            e.preventDefault();
        })


        $(document).ready(function(){
            //initialize the javascript
            App.init();
            App.dashboard();
            App.dataTables();
        });

    </script>
    <?php
}elseif($page=="new_stock" || $page=="edit_stock" || $page=="newrma" || $page=="newexpenses" || $page=="edit_customer"  || $page=="editexpenses" || $page=="new_bank_deposit_withdraw" || $page=="new_assets" || $page=="edit_assets" || $page=="stock_single_recieved"){

    ?>

    <script src="<?php echo  base_url(); ?>assets/lib/summernote/summernote.min.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>assets/lib/summernote/summernote-ext-beagle.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>assets/js/app-form-wysiwyg.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/moment.js/min/moment.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/select2/js/select2.min.js') ?>" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            App.init();
            App.textEditors();
        });

        $(".date").datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            }
        });


    </script>
    <?php
}elseif($page=="credit_report/credit_reports" || $page=="view_received" || $page=="view_stock_batches" || $page=="view_invoice" || $page=="credit_report/credit_report_payment_method" || $page=="credit_report/credit_report_sales_rep" || $page=="credit_report/credit_report_customer" || $page=="credit_report/credit_reports" || $page=="invoice_report/invoice_report_payment_method" || $page=="invoice_report/invoice_report_sales_rep" || $page=="invoice_report/invoice_report_customer" || $page=="invoice_report/invoice_reports" || $page=="stock" || $page=="view_stock_list" || $page=="stock_transfer" || $page=="customerlist" || $page=="credits" || $page=="sales" || $page=="invoices" || $page=="view_transfer" || $page=="rma" || $page=="stock_recieved" || $page=="recieved_stock_report"|| $page=="stock_pick_up_report" || $page=="transfer_stock_report" || $page=="sales_report" || $page=="sales_reports" || $page=="report_customer"|| $page=="report_sales_rep" || $page=="report_stock" || $page=="invoice_report" || $page=="report_payment_method" || $page=="deposit_reports" || $page=="deposit_report_customer" || $page=="deposit_report_sales_rep" || $page=="deposit_report_payment_method"
    || $page=="view_stock_movement" || $page=="expenses"   || $page=="staff_salary"  || $page=="new_salary_payment"  || $page=="view_history_salary" || $page=="profit_loss_general" || $page=="total_income_report" || $page=="by_report_customer" || $page=="by_report_sales_rep" || $page=="by_report_stock" || $page=="by_report_payment_method" || $page=="stock_expiry"  || $page=="expenses_monthly_report" || $page=="report_payment_method" || $page=="refund_report" || $page=="deposit_credit_report"  || $page=="assets_list"   || $page=="credit_payment_report"   || $page=="admin_refund_report" || $page=="stock_open_close"  || $page=="supplier_invoice_report"   || $page=="due_payment_report"   || $page=="out_of_stock"   || $page=="movies" || $page=="list_shows" || $page=="list_service" || $page=="stock_batch_expiry" || $page=="stockby_department" || $page=="login_session" || $page=="payment_report" || $page=="payment_report_user"
){
    ?>

    <script src="<?php  echo base_url('assets/js/app-tables-datatables.js?v=1.21') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/moment.js/min/moment.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/select2/js/select2.min.js') ?>" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            App.init();
            App.dataTables();
            var re_select2 = $("select").select2();
        });
        $('.datetimepicker').datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            }
        });
    </script>
    <?php
}elseif($page=="new_transfer"){
    ?>
    <script src="<?php  echo base_url() ?>assets/lib/fuelux/js/wizard.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/select2/js/select2.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/moment.js/min/moment.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url() ?>assets/lib/bootstrap-slider/js/bootstrap-slider.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js');  ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url() ?>assets/js/app-form-wizard.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the javascript
            App.init();
            App.wizard();
        });
        var re_select2 = $(".max-select").select2();
        $(".date").datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            }
        });

        <?php
        $products = $this->stock->getSellable(array("status"=>"1","quantity!="=>"0"));

        $prod = array();
        foreach($products as $product){
            $product['product_name'] = str_replace("'","&#39;",$product['product_name']);
            $product['product_name'] = str_replace('"',"&#34;",$product['product_name']);
            $prod[] = array('id'=>$product['id_stock'],'text'=>$product['product_name']);
        }

        ?>
        var products = JSON.parse('<?php  echo json_encode($prod); ?>');
        var re_select2 = $(".select").select2({data:products});
        function addTemp(stock_id){
            if(stock_id!=undefined){
                var child = $("#produt_list tr");
                var num = stock_id;
            }else{
                var child = $("#produt_list tr");
                var num = child.length + 1;
                stock_id = num;
            }
            <?php
            if(count($prod)==0){
            ?>
            var select = '<b>No Product Found!..</b>';
            <?php
            }else{
            ?>
            var select = '<select required id="select-'+num+'" class="form-control input-sm" name="product['+num+']"></select>';
            <?php
            }
            ?>
            var html='';
            html +='<tr id="stock-'+stock_id+'">'
            html +='<td>'+select+'<input type="hidden" name="bar_code['+num+']" id="bar_code-'+num+'"/></td>';
            <?php
            if(count($prod)==0){
            ?>
            html +='<td></td><td></td><td></td>';
            <?php
            }else{
            ?>
            html +='<td><input id="product_qty_'+num+'" value="0" required type="number" name="qty['+num+']" value="" placeholder="Quantity" class="form-control input-xs"></td>';
            html +='<td><b>Transfer</b></td>';
            html +='<td><button onclick="$(this).parent().parent().remove()" class="btn btn-danger" type="button">Delete</button></td>';

            <?php
            }
            ?>
            html +='</tr>';

            $("#produt_list").append(html);
            var select2 = $('#select-'+num).select2({data:products});
            var ret = {}
            ret.select2 = select2;
            ret.num = num;
            return ret;
        }


        function open_modal_box(num){
            $("#save_product").attr("index",num);
            var pre_val = $("#bar_code-"+num).val();
            if(pre_val != ""){
                var bars= pre_val.split(",");
                for(var i=0;i<bars.length;i++){
                    if(bars[i]!=""){
                        $(".tags").append('<option selected value="'+bars[i]+'">'+bars[i]+'</option>');
                    }
                }
            }
            $(".tags").select2({allowClear: true, placeholder:'Scaned Bar code will appear here...',tags: true, width: '100%',height:'500px'});
            $("#form-bp1").modal('show');

        }

        $("#form-bp1").on('shown.bs.modal',function(){
            $(".tags").select2('open');
            $(".tags").select2('close');
        });

        function save_product(btn){
            var index =$(btn).attr("index");
            var value= $(".tags").select2('val');
            var myvalue = value;
            $("#bar_code-"+index).val(value);
            $(".tags").select2('destroy');
            $(".tags").html('');
            var parent = $(btn).parent().parent();
            var qty = parent.find('.form-control');
            value = value+"";
            if(value !=""){
                var comma =value.split(",");
                $("#product_qty_"+index).val(comma.length);
            }else{
                $("#product_qty_"+index).val('0')
            }
        }
        function cancel_me(){
            $(".tags").select2('destroy');
            $(".tags").html('');
        }


        function getInputFromBarcode(code,qty){
            $.get('<?php  echo base_url("dashboard/getProductAssociatedWithBarcode?barcode=") ?>'+code,function(result){
                console.log(result);
                result = JSON.parse(result);
                if(result.status == false){
                    $.gritter.add({
                        title: 'Error',
                        text: result.message,
                        class_name: 'color danger'
                    });
                }else{
                    if(document.getElementById('stock-'+result.id_stock)){
                        var exist =false;
                        var pre_val = $("#bar_code-"+result.id_stock).val();
                        if(pre_val != ""){
                            var bars= pre_val.split(",");
                            for(var i=0;i<bars.length;i++){
                                if(bars[i]!=""){
                                    if($.trim(bars[i]) == $.trim(code)){
                                        exist =true;
                                        break;
                                    }
                                }
                            }
                        }

                        if(exist ==true){
                            $.gritter.add({
                                title: 'Error',
                                text: code+" has been added already",
                                class_name: 'color danger'
                            });
                        }else{
                            var pre_val = $("#bar_code-"+result.id_stock).val();
                            var pre_val_arr = pre_val.split(",");
                            var len = pre_val_arr.length;
                            len++;
                            pre_val_arr[len]=code;
                            var all_pre = pre_val_arr.join(",");
                            $("#bar_code-"+result.id_stock).val(all_pre)
                            var pre = parseInt($("#product_qty_"+result.id_stock).val());
                            pre = pre+1;
                            $("#product_qty_"+result.id_stock).val(pre);
                        }
                    }else{
                        var json = addTemp(result.id_stock);
                        json.select2.val(result.id_stock).trigger('change');;
                        var pre = parseInt($("#product_qty_"+json.num).val());
                        pre = pre+1;
                        $("#product_qty_"+json.num).val(pre);
                        var previous = $("#bar_code-"+json.num).val();
                        previous_array = previous.split(",");
                        var len = previous.length;
                        if(len != 0){
                            len++;
                        }
                        previous_array[len] = code;
                        var value_arr = previous_array.join(",");
                        $("#bar_code-"+json.num).val(value_arr);
                    }
                }
            });
        }
    </script>
    <?php
}elseif($page=="edit_recieved" || $page=="new_recieved_branch" || $page=="new_payment_invoice" || $page=="new_invoice" || $page=="new_recieved_supplier" || $page=="edit_transfer" || $page=="refund_depsits" || $page=="add_deposits" || $page=="add_new_deposit_history" || $page=="new_payment_credit"){
    ?>
    <script src="<?php  echo base_url() ?>assets/lib/fuelux/js/wizard.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/select2/js/select2.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/moment.js/min/moment.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js" type="text/javascript"></script>
    <script src="<?php  echo base_url() ?>assets/js/app-form-wizard.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the javascript
            App.init();
            App.wizard();
        });
        $(".date").datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            }
        });
        $('.select2').select2();
        <?php
        if($page =="add_deposits"){
        ?>
        $("#new_customer_form").on("submit",function(){
            $(this).find(".form-control").attr('disabled','disabled');
            $(this).attr('style','opacity:0.8;');
            var form = $(this);
            var data ={};
            form.find('.form-control').each(function(id,elem){
                data[$(elem).attr('name')]= $(elem).val();
            });
            ajaxSentRequest($(this).attr('action'),data,function(result){
                result =JSON.parse(result);
                form.find(".form-controls").removeAttr('disabled');
                form.removeAttr('style');
                form[0].reset();
                window.location.reload();
            })
            return false;
        });
        <?php
        }
        ?>
        <?php
        if($page=="edit_transfer"){
            $products = $this->stock->getStocks(array("status"=>"1"));
        }else{
            $products = $this->stock->getStocksToRecieved(array("status"=>"1"));
        }
        $prod = array();
        foreach($products as $product){
            $product['product_name'] = str_replace("'","&#39;",$product['product_name']);
            $product['product_name'] = str_replace('"',"&#34;",$product['product_name']);
            $prod[] = array('id'=>$product['id_stock'],'text'=>$product['product_name']);
        }

        ?>
        var ajaxSentRequest= function(urltosent,datatosent,callbackdata,callback){
            $.ajax({type:"POST",
                url:urltosent,
                data:datatosent,
                async:true,
                success:function(data){
                    if( typeof(callbackdata)=="object"){
                        callback(data,callbackdata)
                        return;
                    }
                    if(typeof(callbackdata)=="function"){
                        callbackdata(data);
                    }
                    else
                    {
                        callback(data,callbackdata)
                    }
                }
            });
        }


        function addTemp(btn,barcode){
            var child = $("#produt_list tr");
            var num = child.length + 1;
            $(btn).attr('disabled','disabled');
            $(btn).html('Please wait');
            var url = "";
            if(barcode == "clicked"){
                url = '<?php echo base_url('dashboard/get_recieved_stock/'); ?>'+num
            }else{
                url = '<?php echo base_url('dashboard/get_recieved_stock_bar_code/'); ?>'+num+'/'+barcode;
            }
            ajaxSentRequest(url,{},function(select){
                if(select !="not_found") {
                    var html = '';
                    html += '<tr>'
                    html += '<td>' + select + '<input type="hidden" name="bar_code[]" id="bar_code-' + num + '"/></div></td>';
                    html += '<td><div class="input-group"><input id="product_qty_' + num + '" value="0" required type="number" max="2000" name="qty[' + num + ']" value="" placeholder="Quantity" class="form-control input-sm"></td>';
                    <?php
                    if($page == "edit_transfer"){
                    ?>
                    html += '<td><b>Transfer</b></td>';
                    <?php
                    }else{
                    ?>
                    html += '<td><b>Received</b></td>';
                    <?php
                    }
                    ?>
                    html += '<td><button onclick="$(this).parent().parent().remove()" class="btn btn-danger btn-sm" type="button">Delete</button></td>';
                    html += '</tr>';

                    $("#produt_list").append(html);
                    var select2 = $('#select-' + num).select2();
                    $('#expiry_date_' + num).datetimepicker({
                        autoclose: true,
                        startDate: new Date(),
                        componentIcon: '.mdi.mdi-calendar',
                        navIcons: {
                            rightIcon: 'mdi mdi-chevron-right',
                            leftIcon: 'mdi mdi-chevron-left'
                        }
                    });
                    $('#select-' + num).on('change', function () {
                        var attr = $(this).find('option:selected');
                        $(this).attr('id', attr.attr('data-code'));
                        if (attr.attr('can_expired') == '1') {
                            $('#expiry_div_' + num).attr('style', 'display:block;margin-top:12px;');
                            $('#expiry_date_' + num).removeAttr('disabled');
                            $('#expiry_date_' + num).val(attr.attr('expiry_date'))
                        } else {
                            $('#expiry_div_' + num).attr('style', 'display:none;margin-top:12px;');
                            $('#expiry_date_' + num).attr('disabled', 'disabled');
                        }
                    });
                    $(btn).removeAttr('disabled');
                    $(btn).html('Add Product');
                }else{
                    error("Product Not Found");
                    $(btn).removeAttr('disabled');
                    $(btn).html('Add Product');
                }
            });
        }


        function open_modal_box(num){
            $("#save_product").attr("index",num);
            var pre_val = $("#bar_code-"+num).val();
            if(pre_val != ""){
                var bars= pre_val.split(",");
                for(var i=0;i<bars.length;i++){
                    if(bars[i]!=""){
                        $(".tags").append('<option selected value="'+bars[i]+'">'+bars[i]+'</option>');
                    }
                }
            }
            $(".tags").select2({allowClear: true, placeholder:'Scaned Bar code will appear here...',tags: true, width: '100%',height:'500px'});
            $("#form-bp1").modal('show');

        }

        $("#form-bp1").on('shown.bs.modal',function(){
            $(".tags").select2('open');
            $(".tags").select2('close');
        });

        function save_product(btn){
            var index =$(btn).attr("index");
            var value= $(".tags").select2('val');
            var myvalue = value;
            $("#bar_code-"+index).val(value);
            $(".tags").select2('destroy');
            $(".tags").html('');
            var parent = $(btn).parent().parent();
            var qty = parent.find('.form-control');
            value = value+"";
            var comma =value.split(",");
            $("#product_qty_"+index).val(comma.length);
        }
        function cancel_me(){
            $(".tags").select2('destroy');
            $(".tags").html('');
        }
        var re_select2 = $(".max-select").select2();
    </script>
    <?php
}else if($page=="rma_operation"){
    ?>
    <script src="<?php echo base_url('assets/lib/select2/js/select2.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/moment.js/min/moment.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/js/rma.js') ?>" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            App.init();
            toggleLoader();
        });
        function toggleLoader(){
            $('.toggle-loading').on('click',function(){
                var parent = $(this).parents('.widget, .panel');
                parent.addClass('be-loading-active');
                $('#rma_form_loader').html('').attr('style','width:100%;height:300px;');
                $.get('<?php echo base_url('dashboard/rma_forms/'.$this->uri->segment(3).'/?id='.$this->uri->segment(4)) ?>',function(result){
                    $('#rma_form_loader').removeAttr('style').html(result);
                    parent.removeClass('be-loading-active');
                    <?php  if($this->uri->segment(4) =="2"){ ?>
                    selectRMA();
                    <?php }else if($this->uri->segment(4) =="1"){ ?>
                    sentToengine();
                    <?php } ?>
                });
            });
            $('.toggle-loading').click();
        }
    </script>
    <?php
}else if($page=="new_recieved_branch" || $page=="new_recieved_supplier"){
    ?>

    <script src="<?php echo base_url('assets/lib/select2/js/select2.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/moment.js/min/moment.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js');  ?>" type="text/javascript"></script>

    <script type="text/javascript">
        $(".date").datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            }
        });

        <?php
        $products = $this->stock->getStocks(array("status"=>"1"));
        $prod = array();
        foreach($products as $product){
            $product['product_name'] = str_replace("'","&#39;",$product['product_name']);
            $product['product_name'] = str_replace('"',"&#34;",$product['product_name']);
            $prod[] = array('id'=>$product['id_stock'],'text'=>$product['product_name']);
        }

        ?>


        var products = JSON.parse('<?php  echo json_encode($prod); ?>');
        var re_select2 = $(".select").select2({data:products});
        function addTemp(){
            var child = $("#produt_list tr");
            var num = child.length + 1;
            var select = '<select required id="select-'+num+'"class="form-control input-sm" name="product['+num+']"></select>';
            var html='';
            html +='<tr id="stock-'+num+'">'
            html +='<td>'+select+'<input type="hidden" name="bar_code['+num+']" id="bar_code-'+num+'"/></td>';
            html +='<td><input id="product_qty_'+num+'" value="0" required type="number" name="qty['+num+']" value="" placeholder="Quantity" class="form-control input-sm"></td>';
            html +='<td><b>Transfer</b></td>';
            html +='<td><button onclick="$(this).parent().parent().remove()" class="btn btn-danger" type="button">Delete</button></td>';
            html +='</tr>';

            $("#produt_list").append(html);
            var select2 = $('#select-'+num).select2({data:products});
            var ret = {}
            ret.select2 = select2;
            ret.num = num;
            return ret;
        }


        function open_modal_box(num){
            $("#save_product").attr("index",num);
            var pre_val = $("#bar_code-"+num).val();
            if(pre_val != ""){
                var bars= pre_val.split(",");
                for(var i=0;i<bars.length;i++){
                    if(bars[i]!=""){
                        $(".tags").append('<option selected value="'+bars[i]+'">'+bars[i]+'</option>');
                    }
                }
            }
            $(".tags").select2({allowClear: true, placeholder:'Scaned Bar code will appear here...',tags: true, width: '100%',height:'500px'});
            $("#form-bp1").modal('show');

        }

        $("#form-bp1").on('shown.bs.modal',function(){
            $(".tags").select2('open');
        });

        function save_product(btn){
            var index =$(btn).attr("index");
            var value= $(".tags").select2('val');
            var myvalue = value;
            $("#bar_code-"+index).val(value);
            $(".tags").select2('destroy');
            $(".tags").html('');
            var parent = $(btn).parent().parent();
            var qty = parent.find('.form-control');
            value = value+"";
            if(value !=""){
                var comma =value.split(",");
                $("#product_qty_"+index).val(comma.length);
            }
        }
        function cancel_me(){
            $(".tags").select2('destroy');
            $(".tags").html('');
        }
    </script>
    <?php
}else if($page=="edit_sales"){
    ?>
    <script src="<?php echo base_url()  ?>js/sweetalert2.min.js"></script>


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

        function getInputFromBarcode(code,qty){
            if(swal.isVisible()){
                swal.close()
            }else{
                $.get('<?php  echo base_url("dashboard/getProductAssociatedWithBarcode?barcode=") ?>'+code,function(result){
                    result = JSON.parse(result);
                    if(result.status == false){;
                        error(result.message)
                    }else if(barcode_exist(result.bar_code)==true){
                        swal({
                            title: 'Are you sure you want remove '+result.bar_code,
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, remove it!'
                        }).then((resultt) => {
                            if (resultt.value) {
                                var remove_tr = $("#tr-"+result.stock_id);
                                var parent = $("#tr-"+result.stock_id);
                                var qty_input =remove_tr.find("input[type=number]");
                                remove_barcode(result.bar_code);
                                if(barcodes_product_id[result.stock_id]){
                                    barcodes_product_id[result.stock_id].remove(result.bar_code);
                                    if(barcodes_product_id[result.stock_id].length == 0){
                                        delete barcodes_product_id[result.stock_id]
                                    }
                                }
                                var qty = parseInt(qty_input.val());
                                qty--;
                                if(qty==0){
                                    parent = remove_tr.remove();
                                }else{
                                    $(qty_input).val(qty);
                                    var data_amount = (qty * parseInt(parent.attr('data-amount')));
                                    var item_total_price = parent.find('.item-total-price');
                                    item_total_price.html(data_amount.toFixed(2));
                                }
                                calculateSub();
                                var b =0;
                                $('.item_list').each(function(id,elem){
                                    b++;
                                });
                                $('.items-number').html(b);
                                if(b==0){
                                    var no_item_html ='<tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr>';
                                    $("#cart_appender").append(no_item_html);
                                }
                                swal(
                                    'Removed!',
                                    'Product has been removed.',
                                    'success'
                                )
                            }
                        })
                    }else{
                        var item_id = result.stock_id;
                        var amount = result.price;
                        var item_name = result.product_name;
                        var data_track ="1";
                        var data_qty = result.quantity;
                        var len =  Object.keys(barcodes).length;
                        len++;
                        barcodes[len] = result.bar_code;
                        //add barcode with product_id;
                        if(barcodes_product_id[item_id]){
                            barcodes_product_id[item_id].push(result.bar_code);
                        }else{
                            barcodes_product_id[item_id] = new Array();
                            barcodes_product_id[item_id].push(result.bar_code);
                        }
                        var cart_appender = $('#cart_appender');
                        var no_item_html ='<tr id="cart-table-notice"><td colspan="4">Please add an item</td></tr>';
                        var new_item_html='<tr id="tr-'+result.stock_id+'" class="item_list" data-amount="'+amount+'" data-id="'+item_id+'"><td class="text-left" style="line-height:30px;" width="200"><p style="width:45px;margin:0px;float:left"><a class="btn btn-sm btn-default quick_edit_item" href="javascript:void(0)" onclick="$(this).parent().parent().parent().remove();calculateSub();countItem();" style="float:left;vertical-align:inherit;margin-right:10px;"><i class="fa fa-trash"></i></a></p><p class="filter-add-product" style="text-transform: uppercase;float:left;width:76%;margin-bottom:0px;" class="item-name">'+item_name+'</p></td><td class="text-center item-unit-price hidden-xs" style="line-height:30px;" width="110">'+amount+'</td><td class="text-center item-control-btns" width="100"><div class="input-group" style="width:100px"><span class="input-group-btn"><button class="btn btn-default item_qty_plus" type="button"><span class="" aria-hidden="true"></span><i class="fa fa-plus"></i></button></span><input type="number" readonly name="qty" data-qty="'+data_qty+'" data-track="'+data_track+'" data-id="'+item_id+'"  value="1" style="width:60px"class="form-control shop_item_quantity" placeholder="Qty" /><span class="input-group-btn"><button  class="btn btn-default item_qty_minus" type="button"><span  aria-hidden="true"></span><i class="fa fa-minus"></i></button></span></div></td><td class="text-right item-total-price" style="line-height:30px;" width="100">'+(parseInt(amount).toFixed(2))+'</td></tr>';
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
                });
            }
        }

        function barcode_exist(barcode){
            for(var keys in barcodes){
                if(barcodes[keys]==barcode){
                    return true;
                    break;
                }
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
    </script>
    <?php
}else if($page=="deposits" || $page=="view_sales" || $page=="view_deposits"|| $page=="view_credit"){
    ?>
    <script src="<?php  echo base_url('assets/js/app-tables-datatables.js?v=1.21') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/moment.js/min/moment.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/select2/js/select2.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url()  ?>js/chosen/chosen.jquery.js"></script>
    <script src="<?php echo base_url()  ?>js/select2/select2-active.js"></script>
    <script>
        $(document).ready(function(){
            App.init();
            App.dataTables();
        });

    </script>

<?php  }else if($page == "checkout_depsits"){ ?>
    <script>

        $(document).ready(function(){
            App.init();
            setTimeout(function(){
                window.location = BASE_URL + 'dashboard/therminal_deposit/'+'<?php echo $this->uri->segment(3) ?>'
            },3000);
        });

    </script>

<?php  }else if($page == "preparing_credit_sales"){ ?>
    <script>

        $(document).ready(function(){
            App.init();
            setTimeout(function(){
                window.location = BASE_URL + 'dashboard/therminal_credit'
            },3000);
        });

    </script>
    <?php
}else{
    ?>
    <script>
        $(document).ready(function(){
            App.init();
        });
    </script>
    <?php
}
?>


<script>
    <?php
    if($this->session->flashdata("success")){
    ?>
    $.gritter.add({
        title: 'Success',
        text: '<?php echo $this->session->flashdata("success") ?>',
        class_name: 'color success'
    });
    <?php
    }
    if($this->session->flashdata("error")){
    ?>
    $.gritter.add({
        title: 'Error',
        text: '<?php echo $this->session->flashdata("error") ?>',
        class_name: 'color danger'
    });

    <?php
    }
    ?>
</script>
</html>
