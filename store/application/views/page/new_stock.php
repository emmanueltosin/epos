<div class="row">
    <div class="col-sm-12">
        <form action="<?php  echo base_url('dashboard/save_new_stock')  ?>" enctype="multipart/form-data" method="post" >
            <div class="panel">
                <div class="panel-heading">Add New Stock
                    <div class="tools"><button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Save</button></div>
                </div>
                <div class="tab-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Data</a></li>
                        <li><a href="#scan" data-toggle="tab">Scan Bar Code</a></li>
                        <li><a href="#profile" data-toggle="tab">General Description</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="home" class="tab-pane active cont">
                            <div class="form-horizontal">

                                <div class="form-group xs-mt-10">
                                    <label for="product_name" class="col-sm-2 control-label">Product Name</label>
                                    <div class="col-sm-10">
                                        <input id="product_name" name="product_name" type="text" required  max="255" placeholder="Product Name" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Date Available</label>
                                    <div class="col-sm-10">
                                        <input id="date_available" type="text" value="<?php echo date('Y-m-d'); ?>" name="date_available" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Date Available" class="date form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="model" class="col-sm-2 control-label">Model</label>
                                    <div class="col-sm-10">
                                        <input id="model" name="model" type="text"  placeholder="Model" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="model" class="col-sm-2 control-label">Initial Quantity</label>
                                    <div class="col-sm-10">
                                        <input id="initial_qty" required value="0" name="quantity" type="number"  placeholder="Initial Quantity" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="model" class="col-sm-2 control-label">Can Product Expire?</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-sm" name="expiry_status" id="expiry_status">
                                            <option value="Yes">Yes</option>
                                            <option selected value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10" style="display: none">
                                    <label for="model" class="col-sm-2 control-label">Product Expiry Date</label>
                                    <div class="col-sm-10">
                                        <input  data-min-view="2" id="expired_date" value="0000-00-00" data-date-format="yyyy-mm-dd" name="expired_date" type="text"  placeholder="Product Expiry Date" class="date2 form-control input-sm">
                                    </div>
                                </div>

                                <?php
                                $d = $this->stock->getUserDepartment();
                                if($d =="Top Administrator" || $d =="Store") {
                                    ?>
                                    <div class="form-group xs-mt-10">
                                        <label for="model" class="col-sm-2 control-label">Department</label>
                                        <div class="col-sm-10">
                                            <?php
                                            $dpts = $this->db->get_where("department",array("type"=>"Sales"))->result_array();
                                            foreach($dpts as $dpt){
                                                $department[$dpt['department']] = array('Sales Representative','Administrator');
                                            }

                                            ?>
                                            <select required class="form-control input-sm" name="department">
                                                <option value="">-Select Department-</option>
                                                <?php
                                                foreach($department as $key=>$dpt){
                                                    ?>
                                                    <option value="<?php echo $key ?>"><?php echo $key ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                }else {
                                    ?>
                                    <input type="hidden" name="department" value="<?php echo $this->stock->getUserDepartment()  ?>"/>
                                    <?php
                                }
                                ?>
                               <input id="model" name="product_code" type="hidden"  placeholder="Product Code" class="form-control input-sm">
                                <div class="form-group xs-mt-10">
                                    <label for="model" class="col-sm-2 control-label">Product Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-sm" name="product_type" id="product_t">
                                            <option selected value="Pieces">Pieces Product</option>
                                            <option value="Packed">Packed / Cartoon Product</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Cost Price</label>
                                    <div class="col-sm-10">
                                        <input step=".000001" id="cost_price" type="number" onkeyup="$('#price').attr('min',$(this).val())" required name="cost_price" id="cost_price"  placeholder="Cost Price" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="product_name" class="col-sm-2 control-label">Product Markup</label>
                                    <div class="col-sm-10">
                                        <input id="product_markup"  onkeyup="return calculate_selling_price(this.value);"  min="1" max="2000" name="markup" type="number" required  placeholder="Product Markup" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Selling Price</label>
                                    <div class="col-sm-10">
                                        <input step=".000001" id="price" type="number" required name="price" id="price"  placeholder="Price" class="form-control input-sm">
                                    </div>
                                </div>


                                <div id="product_type" style="display: none;">
                                    <div class="form-group xs-mt-10">
                                        <label for="price" class="col-sm-2 control-label">Total Pieces in One Pack/Cartoon</label>
                                        <div class="col-sm-10">
                                            <input  type="number"  name="item_packed" id="item_packed"  placeholder="Total Pieces in One Pack/Cartoon" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group xs-mt-10">
                                        <label for="price" class="col-sm-2 control-label">Cartoon Cost Price</label>
                                        <div class="col-sm-10">
                                            <input step=".000001" id="p_cost_price" onkeyup="$('#p_price').attr('min',$(this).val())" type="number"  name="whole_cost_price" id="whole_cost_price"  placeholder="Cartoon Cost Price" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group xs-mt-10">
                                        <label for="price" class="col-sm-2 control-label">Cartoon Selling Price</label>
                                        <div class="col-sm-10">
                                            <input step=".000001" id="p_price" type="number"  name="whole_price" id="whole_price"  placeholder="Cartoon Selling Price" class="form-control input-sm">
                                        </div>
                                    </div>



                                </div>


                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Manufacturer</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-sm" name="manufacturer">
                                            <option selected value="">Select One</option>
                                            <?php
                                            $manu = $this->stock->getManufacturers();
                                            foreach($manu as $man){
                                                ?>
                                                <option value="<?php echo $man['SN']  ?>"><?php echo $man['manufacturer']  ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Product Category</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-sm" name="category_id">                                            <?php
                                            $manu = $this->stock->getcategories();
                                            foreach($manu as $man){
                                                ?>
                                                <option value="<?php echo $man['SN']  ?>"><?php echo $man['category']  ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-sm" required name="status">
                                            <option value="1">Enabled</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="scan" class="tab-pane cont">
                            <div class="well">
                                <h1 align="center" style="font-weight:bolder;font-size:40px; height:120px;" id="bar_code"></h1>
                                <input type="hidden" name="bar_code_code" id="bar_code_code"/>
                            </div>
                        </div>
                        <div id="profile" class="tab-pane cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                                        <div class="panel-heading panel-heading-divider">Product Description<span class="panel-subtitle">Describe Specification</span></div>
                                        <div class="panel-body">
                                            <textarea placeholder="Product Description" style="height:200px" class="form-control col-lg-12" name="product_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    window.onload = function(){
        $(document).ready(function(e){
            $('#product_t').on("change",function(){
                if($(this).val() == "Packed"){
                    $("#product_type").attr('style','display:block');
                    $("#initial_qty").attr("name",'cartoon_qty');
                }else{
                    $("#product_type").attr('style','display:none');
                    $("#initial_qty").attr("name",'quantity');
                }
            });

            $('.date2').datetimepicker({
                autoclose: true,
                startDate: new Date(),
                componentIcon: '.mdi.mdi-calendar',
                navIcons:{
                    rightIcon: 'mdi mdi-chevron-right',
                    leftIcon: 'mdi mdi-chevron-left'
                }
            });

            $('#expiry_status').on('change',function(){
                if($(this).val() == "Yes"){
                    $("#expired_date").parent().parent().attr('style','display:block');
                    $("#expired_date").attr("required",'required');
                }else{
                    $("#expired_date").parent().parent().attr('style','display:none');
                    $("#expired_date").removeAttr("required");
                }
            });

            $('#price, #item_packed, #cost_price,#product_markup').on('keyup',function(){
                if($('#product_t').val() == "Packed"){
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
    }

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