<div class="row">
    <div class="col-sm-12">
        <form action="" enctype="multipart/form-data" method="post" id="s_form">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group col-sm-11">
                        <br/>
                        <label for="product_name" class="control-label">Select Product Or Scan Bar Code</label>
                        <select id="single_recieved"  class="form-control select2 input-sm" required name="product_select">
                            <option value="">Select Product or Scan bar Code</option>
                            <?php
                            $pos = @$_POST['product_select'];
                            $stocks = $this->stock->getStocks();
                            foreach($stocks as $stock) {
                                $id = $stock['SN'];
                                $id = trim($id);
                                ?>
                                <option <?php echo $id==$pos ? 'selected' : '' ?> value="<?php echo $id ?>"><?php echo $stock['product_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-11">
                    <button type="submit" class="btn  btn-block btn-primary">Fetch Product</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if(isset($_POST['product_select'])) {
    $stock =  $this->stock->getStockByBarcode($_POST['product_select']);
    ?>
<form action="<?php echo base_url('dashboard/recieved_single_product/'.$stock['SN']) ?>" enctype="multipart/form-data" method="post" >
    <div class="panel">
        <div class="panel-heading">
            <h3>Received Stock information</h3>
        </div>
        <div class="panel-body">
            <div class="form-group col-sm-11">
                <div class="form-horizontal">

                    <div class="form-group xs-mt-10">
                        <label for="product_name" class="col-sm-2 control-label">Product Name</label>
                        <div class="col-sm-10">
                            <input  id="product_name" disabled value="<?php  echo $stock['product_name'] ?>" name="product_name" type="text" required  max="255" placeholder="Product Name" class="form-control input-sm">
                        </div>
                    </div>
                    <?php
                    if($stock['last_stock_date'] !="0000-00-00") {
                        ?>
                        <div class="form-group xs-mt-10">
                            <label for="product_name" class="col-sm-2 control-label">Last Stock Date</label>
                            <div class="col-sm-10">
                                <input id="product_name" disabled value="<?php echo $stock['last_stock_date'] ?>"
                                       name="product_name" type="text" required max="255" placeholder="Product Name"
                                       class="form-control input-sm">
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group xs-mt-10">
                        <label for="product_name" class="col-sm-2 control-label">Quantity Received</label>
                        <div class="col-sm-10">
                            <input id="product_name" value=""  name="qty" type="number" required  placeholder="Quantity Received" class="form-control input-sm">
                        </div>
                    </div>

                    <?php
                    if($stock['expiry_status'] =="Yes") {
                        ?>
                        <div class="form-group xs-mt-10">
                            <label for="model" class="col-sm-2 control-label">Product Expiry Date</label>
                            <div class="col-sm-10">
                                <input id="datetimepicker" data-min-view="2" data-date-format="yyyy-mm-dd" name="expiry_date" value="" type="text" placeholder="Expiry Date" class="date2 form-control input-sm">
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group xs-mt-10">
                        <label for="price" class="col-sm-2 control-label">Cost Price</label>
                        <div class="col-sm-10">
                            <input id="cost_price" onkeyup="$('#price').attr('min',$(this).val())" type="number" value="<?php  echo $stock['cost_price'] ?>" required name="cost_price"  placeholder="Cost Price" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="form-group xs-mt-10">
                        <label for="product_name" class="col-sm-2 control-label">Product Markup</label>
                        <div class="col-sm-10">
                            <input id="product_markup"  onkeyup="return calculate_selling_price(this.value);" value="<?php  echo $stock['markup'] ?>" min="1" max="2000" name="markup" type="number" required  placeholder="Product Markup" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group xs-mt-10">
                        <label for="price" class="col-sm-2 control-label">Selling Price</label>
                        <div class="col-sm-10">
                            <input id="price" value="<?php  echo $stock['price'] ?>" type="number" name="price"  placeholder="Selling Price" class="form-control input-sm">
                        </div>
                    </div>


                    <div id="product_type" style="<?php echo $stock['product_type'] == "Packed" ? 'display: block;' : 'display: none;' ?>" <?php echo $stock['product_type'] == "Packed" ? 'packed="yes"' : 'packed="no"' ?>>
                        <div class="form-group xs-mt-10">
                            <label for="price" class="col-sm-2 control-label">Total Pieces in One Pack/Cartoon</label>
                            <div class="col-sm-10">
                                <input id="item_packed" type="number"   name="item_packed" value="<?php  echo $stock['item_packed'] ?>"  placeholder="Total Pieces in One Pack/Cartoon" class="form-control input-sm">
                            </div>
                        </div>

                        <div class="form-group xs-mt-10">
                            <label for="price" class="col-sm-2 control-label">Cartoon Cost Price</label>
                            <div class="col-sm-10">
                                <input id="p_cost_price" onkeyup="$('#p_price').attr('min',$(this).val())" type="number" value="<?php  echo $stock['whole_cost_price'] ?>"  name="whole_cost_price"  placeholder="Cartoon Cost Price" class="form-control input-sm">
                            </div>
                        </div>

                        <div class="form-group xs-mt-10">
                            <label for="price" class="col-sm-2 control-label">Cartoon Selling Price</label>
                            <div class="col-sm-10">
                                <input id="p_price" type="number" value="<?php  echo $stock['whole_price'] ?>" required name="whole_price"  placeholder="Cartoon Selling Price" class="form-control input-sm">
                            </div>
                        </div>



                    </div>

                    <div class="col-sm-5 col-lg-offset-2">
                        <br>
                        <button class="btn btn-lg btn-primary" type="submit">Receive Stock</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <?php
}
?>

<script>
    window.onload = function(){
        $(document).ready(function(){
            var re_select2 = $("select").select2();
            $('.date2').datetimepicker({
                autoclose: true,
                startDate: new Date(),
                componentIcon: '.mdi.mdi-calendar',
                navIcons:{
                    rightIcon: 'mdi mdi-chevron-right',
                    leftIcon: 'mdi mdi-chevron-left'
                }
            });

            $('#price, #item_packed, #cost_price,#product_markup').on('keyup',function(){
                if($('#product_type').attr('packed') === "yes"){
                    if($("#item_packed").val() !=="" && $("#price").val()!=="" && $("#product_markup").val()!==""){
                        var selling = parseInt( $("#price").val());
                        var no_of_packed = parseInt($("#item_packed").val());
                        $("#p_price").val((Math.round(Math.abs(selling * no_of_packed))).toFixed(3));
                    }

                    if($("#item_packed").val() !=="" && $("#cost_price").val()!=="" && $("#product_markup").val()!==""){
                        var cost = parseInt( $("#cost_price").val());
                        var no_of_packed = parseInt($("#item_packed").val());
                        $("#p_cost_price").val(Math.round(Math.abs(cost * no_of_packed)).toFixed(3));
                    }

                }
            })

        });
    };


    function calculate_selling_price(value){
        value = parseFloat(value);
        var cost = parseFloat($('#cost_price').val());
        var increment = ((value/100) * cost);
        var selling_price = cost+increment;
        $("#price").val((Math.round(Math.abs(selling_price))).toFixed(3));
    }

    function calculate_packed_selling_price(value){
        value = parseFloat(value);
        var cost = parseFloat($('#p_cost_price').val());
        var increment = ((value/100) * cost);
        var selling_price = cost+increment;
        $("#p_price").val((Math.round(Math.abs(selling_price))).toFixed(3));
    }



</script>
