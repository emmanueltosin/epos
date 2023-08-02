<div class="row">
<div class="col-sm-12">
	<?php
		$user_id = $this->tank_auth->get_user_id();

	$user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
	?>
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Stock List(s) By Department
                    <div class="tools">
                        <form method="post" class="form-horizontal" id="change_branch" action="">
                            <div class="col-md-12">
                                <select onchange="return $('#change_branch').submit();" required class="form-control input-sm" name="department">
                                    <?php
                                    $dpts = $this->stock->getDepartments();
                                    foreach($dpts as $dpt){
                                        if($dpt['type'] !="Service") {
                                            $department[$dpt['department']] = array('Sales Representative', 'Administrator');
                                        }
                                    }
                                    ?>
                                    <option value="all">-Select-</option>
                                    <?php
                                    foreach($department as $key=>$dpt) {
                                            ?>
                                    <option </select <?php echo isset($_POST['department']) ? ($_POST['department'] == $key ? 'selected' : '') : ''  ?> value="<?php echo $key ?>"><?php echo $key ?></option>
                                        <?php
                                    }?>
                                </select>
                            </div>
                        </form>

                    </div>
                </div>
         <?php

         $total_cost = 0;
         $total_selling = 0;
         $total_profit =0;
         foreach($stocks as $stock){
             $total_cost +=$stock['cost_price']*$stock['quantity'];
             $total_selling+=$stock['price']*$stock['quantity'];
             if($stock['product_type']=="Packed") {
                 $total_cost +=$stock['whole_price']*$stock['cartoon_qty'];
                 $total_selling+=$stock['whole_cost_price']*$stock['cartoon_qty'];
             }
         }
         $total_profit+=$total_selling - $total_cost;
         ?>
				<div class="panel-body panel-table">
                    <?php
                    if($user['role'] == "Top Administrator"){
                    ?>
                    <br/>
                    <div class="col-lg-10 col-lg-offset-2">
                        <div class="col-lg-4">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    Total Cost Price
                                    <h1><b>N<?php echo  number_format($total_cost,1) ?></b></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    Total Selling Price
                                    <h1><b>N<?php echo  number_format($total_selling,1) ?></b></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    Total Profit
                                    <h1><b>N<?php echo  number_format($total_profit,1) ?></b></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <?php
                    }
                    ?>
				 <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
					  <th>#</th>
                      <th>Name</th>
                      <th>Type</th>
					  <th>Selling</th>
					   <?php if($user['role'] == "Top Administrator"){ ?>
					  <th>Cost</th>
					  <?php } ?>
                      <th>Price + VAT</th>
					  <th>Quantity</th>
					  <th>Manufacturer</th>
					  <th>Category</th>
                      <th>Department</th>
                      <th>Status</th>
					  <th>Command</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$num=1;
						$array = array(
										'0'=>'<span class="label label-danger">Disabled</span>',
										'1'=>'<span class="label label-success">Enabled</span>'
									);
						foreach($stocks as $stock){
					?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $stock['product_name'] ?></td>
                        <td><?php echo $stock['product_type'] ?></td>
						<td><?php echo number_format($stock['price'],2);  echo $stock['product_type'] == "Packed" ? " / " . number_format($stock['whole_price'],2) : '' ?></td>
						<?php if($user['role'] == "Top Administrator"){ ?>
						<td><?php echo number_format($stock['cost_price'],2);  echo $stock['product_type'] == "Packed" ? " / " . number_format($stock['whole_cost_price'],2) : ''  ?></td>
						 <?php } ?>
                        <td><?php echo $this->stock->getVatablePrice($stock['SN']) ?></td>
						<td><?php echo $stock['quantity'] ?>  <?php echo $stock['product_type']=="Packed" ? "/ ".$stock['cartoon_qty'] : '' ?></td>
						<td><?php
							if($stock['manufacturer'] == "0"){
								echo "No Manufacturer";
							}else{
								$m = $this->stock->getManufacturer($stock['manufacturer']);
								if(count($m) == 0){
									echo "No Manufacturer";
								}else{
									echo $m[0]['manufacturer'];
								}
							}
						?></td>
						<td><?php
							if($stock['category_id'] == "0"){
								echo "Un-Categorized";
							}else{
								$c = $this->stock->getcategory($stock['category_id']);
								if(count($c) == 0){
									echo "Un-Categorized";
								}else{
									echo $c[0]['category'];
								}
							}
						?></td>
                        <td>
                            <?php echo $stock['department'] ?>
                        </td>
						<td><?php echo $array[$stock['status']] ?></td>
						<td>
						<?php if($user['role'] == "Top Administrator"){ ?>
							<div class="btn-group btn-space">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Action</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="<?php echo base_url('dashboard/edit_stock/'.$stock['SN'] )  ?>">Edit</a></li>
                          <!--<li><a href="<?php echo base_url('dashboard/view_stock_list/'.$stock['SN'] )  ?>">View Stock List</a></li>-->
						  <li><a href="<?php echo base_url('dashboard/view_stock_movement/'.$stock['SN'] )  ?>">Stock Movement History/Report</a></li>
                            <?php
                            if($stock['expiry_status']=="Yes") {
                                ?>
                                <li><a href="<?php echo base_url('dashboard/view_stock_batches/' . $stock['SN']) ?>">View
                                        Product Batch(s)</a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if($stock['product_type']=="Packed") {
                                ?>
                                <li><a href="<?php echo base_url('dashboard/depacked/' . $stock['SN']) ?>">Convert/De-packed to Pieces</a></li>
                                <?php
                            }
                            ?>
						  <?php if($stock['status']=="1"){  ?>
						  <li><a href="<?php echo base_url('dashboard/set_availability/'.$stock['SN'].'/0' )  ?>">Disable</a></li>
                          <?php }else{ ?>
						   <li><a href="<?php echo base_url('dashboard/set_availability/'.$stock['SN'].'/1' )  ?>">Enable</a></li>
						  <?php } ?>
                        </ul>
                      </div>
                      <?php
						}else{
                      ?>
                      	<div class="btn-group btn-space">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
						  <li><a href="<?php echo base_url('dashboard/view_stock_movement/'.$stock['SN'] )  ?>">Stock Movement History/Report</a></li>

                        </ul>
                      </div>
                      <?php
						}
                      ?>
						</td>
					</tr>
					<?php
						$num++;
						}
					?>
					</tbody>
				</table>
				</div>

</div>
</div>
