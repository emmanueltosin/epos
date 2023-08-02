<?php
$stocks = [];
$s_stocks = $this->db->get_where("batch_product_table",array("batch_id"=>$batch_id,"status"=>"unsorted"))->result_array();
foreach($s_stocks as $s_stock) {
    $this->db->from("stock");
    $this->db->where('SN',$s_stock['product_id']);
    $s = $this->db->get()->row_array();
    $s['quantity_'] = $s_stock['quantity'];
    $s['expiry_date'] = $s_stock['expiry_date'];
    $s['batch_sn'] = $s_stock['SN'];
    $s['date_recieved'] = $s_stock['date_recieved'];
    $stocks[] = $s;
}
?>
<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Stock Expiry List(s)
               </div>
				<div class="panel-body">
				 <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                       <tr>
					  <th>#</th>
                      <th>Product Name</th>
					  <th>Selling Price</th>
					  <th>Cost Price</th>
					  <th>Batch Quantity</th>
					  <th>Manufacturer</th>
					  <th>Category</th>
					  <th>Expiry Date</th>
                      <th>Received Date</th>
					  <th>Expired</th>
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
						<td><?php echo number_format($stock['price'],2) ?></td>
						<td><?php echo number_format($stock['cost_price'],2) ?></td>
						<td><?php echo $stock['quantity_'] ?></td>
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
                        <td><?php echo $stock['expiry_date'] ?></td>
						<td><?php echo $stock['date_recieved'] ?></td>
						<td><?php echo $this->utils->cal_days_($stock['expiry_date']) ?></td>
						<td><?php echo $array[$stock['status']] ?></td>
						<td>
							<div class="btn-group btn-space">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
						  <li><a href="<?php echo base_url('dashboard/sort_expiry/'.$stock['batch_sn'] )  ?>">Mark As Sorted</a></li>
                        </ul>
                      </div>
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