
<div class="row">
    <div class="col-sm-12">
        <form action="<?php  echo base_url('dashboard/update_stock/'.$this->uri->segment(3))  ?>" id="edit" enctype="multipart/form-data" method="post" >
            <div class="panel">
                <div class="panel-heading">Edit Stock
                    <div class="tools"><button type="submit" form="edit" class="btn btn-sm btn-primary"><i class="mdi mdi-edit"></i> Update Stock</button></div>
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
                                        <input id="product_name" value="<?php  echo $stock['product_name'] ?>" name="product_name" type="text" required  max="255" placeholder="Product Name" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Date Available</label>
                                    <div class="col-sm-10">
                                        <input id="date_available" type="text" value="<?php  echo $stock['date_available'] ?>" name="date_available" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Date Available" class="date form-control input-sm">
                                    </div>
                                </div>
                                <div class="form-group xs-mt-10">
                                    <label for="model" class="col-sm-2 control-label">Model</label>
                                    <div class="col-sm-10">
                                        <input id="model" name="model" value="<?php  echo $stock['model'] ?>" type="text" min="3" max="255" placeholder="Model" class="form-control input-sm">
                                    </div>
                                </div>
                                <div class="form-group xs-mt-10">
                                    <label for="model" class="col-sm-2 control-label">Can Product Expire?</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-sm" name="expiry_status">
                                            <option <?php  echo $stock['expiry_status']=='Yes' ? 'selected' : '' ?> value="Yes">Yes</option>
                                            <option <?php  echo $stock['expiry_status']=='No' ? 'selected' : '' ?> value="No">No</option>
                                        </select>
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
                                                    <option <?php echo $stock['department']==$key ? 'selected' : ''  ?> value="<?php echo $key ?>"><?php echo $key ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                }else {
                                    ?>
                                    <input type="hidden" name="department" value="<?php echo $stock['department']  ?>"/>
                                    <?php
                                }
                                ?>
                                <div class="form-group xs-mt-10">
                                    <label for="model" class="col-sm-2 control-label">Product Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-sm" name="product_type" id="product_t">
                                            <option <?php echo $stock['product_type']=="Pieces" ? 'selected' : '' ?> value="Pieces">Pieces Product</option>
                                            <option <?php echo $stock['product_type']=="Packed" ? 'selected' : '' ?> value="Packed">Packed / Cartoon Product</option>
                                        </select>
                                    </div>
                                </div>
                                <input  required value="<?php  echo $stock['expired_date'] ?>"  name="expired_date" type="hidden"  placeholder="Product Expiry Date" class="date form-control input-sm">

                                <input id="model" name="product_code" value="<?php echo $stock['product_code'] ?>" type="hidden"   placeholder="Product Code" class="form-control input-sm">

                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Cost Price</label>
                                    <div class="col-sm-10">
                                        <input id="cost_price" step=".000001" onkeyup="$('#price').attr('min',$(this).val())" type="number" value="<?php  echo $stock['cost_price'] ?>" required name="cost_price"  placeholder="Cost Price" class="form-control input-sm">
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
                                        <input id="price" step=".000001" value="<?php  echo $stock['price'] ?>" type="number" name="price"  placeholder="Selling Price" class="form-control input-sm">
                                    </div>
                                </div>

                                <div id="product_type" style="<?php echo $stock['product_type'] == "Packed" ? 'display: block;' : 'display: none;' ?>">
                                    <div class="form-group xs-mt-10">
                                        <label for="price" class="col-sm-2 control-label">Total Pieces in One Pack/Cartoon</label>
                                        <div class="col-sm-10">
                                            <input id="item_packed" type="number"  name="item_packed" value="<?php  echo $stock['item_packed'] ?>"  placeholder="Total Pieces in One Pack/Cartoon" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group xs-mt-10">
                                        <label for="price" class="col-sm-2 control-label">Cartoon Cost Price</label>
                                        <div class="col-sm-10">
                                            <input id="p_cost_price" step=".000001" onkeyup="$('#p_price').attr('min',$(this).val())" type="number" value="<?php  echo $stock['whole_cost_price'] ?>"  name="whole_cost_price"  placeholder="Cartoon Cost Price" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group xs-mt-10">
                                        <label for="price" class="col-sm-2 control-label">Cartoon Selling Price</label>
                                        <div class="col-sm-10">
                                            <input id="p_price" step=".000001" type="number" value="<?php  echo $stock['whole_price'] ?>" required name="whole_price"  placeholder="Cartoon Selling Price" class="form-control input-sm">
                                        </div>
                                    </div>



                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Manufacturer</label>
                                    <div class="col-sm-10">
                                        <select required class="form-control input-sm" name="manufacturer">

                                            <?php
                                            $manu = $this->stock->getManufacturers();
                                            foreach($manu as $man){
                                                ?>
                                                <option <?php echo ($man['SN']==$stock['manufacturer']) ?>  value="<?php echo $man['SN']  ?>"><?php echo $man['manufacturer']  ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group xs-mt-10">
                                    <label for="price" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10">
                                        <select required class="form-control input-sm" name="category_id">

                                            <?php
                                            $manu = $this->stock->getcategories();
                                            foreach($manu as $man){
                                                ?>
                                                <option <?php echo ($man['SN']==$stock['category_id']) ?>  value="<?php echo $man['SN']  ?>"><?php echo $man['category']  ?></option>
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
                                            <option <?php echo ($stock['status']=="1" ? 'selected' : '') ?> value="1">Enabled</option>
                                            <option <?php echo ($stock['status']=="0" ? 'selected' : '') ?>value="0">Disabled</option>
                                        </select>
                                    </div>
                                </div>




                            </div>

                        </div>
                        <div id="scan" class="tab-pane cont">
                            <div class="well">
                                <h1 align="center" style="font-weight:bolder;font-size:50px; height:150px;" id="bar_code"><?php echo $stock['bar_code_code'] ?></h1>
                                <input type="hidden" name="bar_code_code" value="<?php echo $stock['bar_code_code'] ?>" id="bar_code_code"/>
                            </div>
                        </div>
                        <div id="profile" class="tab-pane cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                                        <div class="panel-heading panel-heading-divider">Product Description<span class="panel-subtitle">Describe Specification</span></div>
                                        <div class="panel-body">
                                            <textarea placeholder="Product Description" style="height:200px" class="form-control col-lg-12" name="product_description"><?php echo $stock['product_description'] ?></textarea>
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
                    $("#product_type").attr('style','display:block')
                }else{
                    $("#product_type").attr('style','display:none')
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