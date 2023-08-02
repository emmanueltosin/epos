<?php
$in = $this->stock->getSale($this->uri->segment(3));
				if(is_numeric($in['customer'])){
						$customer = $this->settings->getCustomer($in['customer']);
						$customer = $customer['firstname'].' '.$customer['lastname'];
						}else{
							$customer = $in['customer'];
						}
	
						$user =$this->users->get_user_by_id($in['user_id'],1);
?>
<?php
$reservation = $this->stock->getSale($this->uri->segment(3));
$items = json_decode($in['items'],true);
?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default panel-table">
					<div class="panel-heading"><a href="<?php echo base_url('dashboard/view_sales/'.$this->uri->segment(3)) ?>" class="btn btn-sm btn-success">Back</a> Update Transaction
					 <div class="tools">
						<button type="submit" class="btn btn-success btn-sm">Update Sales</button>
					 </div>
					</div>
					<div class="panel-body">
						<div class="col-lg-12">
							<div class="col-lg-4">
								<div class="form-group xs-pt-10">
								  <label>Receipt ID</label>
								  <span class="form-control input-sm"><?php echo $in['reciept_id'] ?> </span>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group xs-pt-10">
								  <label>Customer</label>
								  <select name="customer_id" class="form-control select2_demo_2 input-sm">
									<?php
										$customers = $this->settings->getCustomers();
										foreach($customers as $customer){
									?>
										<option <?php  echo ($in['customer']==$customer['SN'] ? 'selected' : '') ?> value="<?php echo $customer['SN'] ?>"><?php echo $customer['firstname'] ?>  <?php echo $customer['lastname'] ?></option>
									<?php
										}
									?>
									</select>

								 </div>
							</div>
							<div class="col-lg-4">
								<div class="form-group xs-pt-10">
								  <label>Sales Rep</label>
								  <select name="user_id" class="form-control input-sm select2_demo_1">
									<?php
										$sales_rep = $this->db->get("users")->result_array();
										foreach($sales_rep as $rep){
									?>
										<option <?php  echo ($rep['id']==$in['user_id'] ? 'selected' : '') ?>><?php echo $rep['username'] ?></option>
									<?php
										}
									?>
								  </select>
								</div>
							</div>
						
							<h3>Product List(s)</h3>
							<table class="table table-condensed table-bordered">
												<thead>
													<tr>
														<th class="text-center">Item Name</td>
														<th class="text-center">Qty</td>
														<th class="text-center">Price</td>
														<th class="text-right">Total</th>
														<th></th>
													</tr>
												</thead>
												<tbody id="cart_appender">
													<?php 
													$alltotal=0;
													$all_barcodes = array();
													foreach($items as $item) {
														$info = $item;
														$alltotal+=$info['total'];
														
													?>
													
													<tr>
														<input type="hidden" name="product_id[<?php echo $item['id'] ?>]" value="<?php echo $item['id'] ?>"/>					
														<td class="text-center"><?php  echo $item['item_name'] ?></td>
														<td class="text-center"><?php  echo $item['item_qty'] ?></td>
														<td class="text-center"><?php  echo number_format($item['item_price'],2) ?></td>
														<td class="text-right"><?php  echo number_format($item['total'],2); ?></td>
														<td><button class="btn btn-sm btn-danger" onclick="$(this).parent().parent().remove()">Delete</button></td>
													</tr>
													<?php } ?>
												</tbody>
													<tfoot>
														<tr>
														
														<td></td>
														<td></td>
												
														<th class="text-right">Sub Total</th>
														<th class="text-right" id="subtotal"></th>
														<td></td>
													</tr>
													<tr>
														
														<td></td>
														<td></td>
													
														<th class="text-right">Discount</th>
														<th class="text-right" id="discount"></th>
														<td></td>
													</tr>
													<tr>
													
														<td></td>
														<td></td>
														
														<th class="text-right">VAT(<?php echo $reservation['vat'] ?>%)</th>
														<?php $vat = (($reservation['vat']/100) * $alltotal);  ?>
														
														<th class="text-right" id="vat"></th>
														<td></td>
													</tr>
													<tr>
													
														<td></td>
														<td></td>
													
														<th class="text-right">Charge(<?php echo $reservation['scharge'] ?>%)</th>
														<?php $charge = (($reservation['scharge']/100) * $alltotal);  ?>
														
														<th class="text-right" id="scharge"></th>
														<td></td>
													</tr>
													<tr>
														<?php $alltotal=$alltotal-$reservation['discount']; ?>
														<?php $alltotal=$alltotal+$charge ?>
														<?php $alltotal=$alltotal+$vat ?>
														<td></td>
														<td></td>
													
														<th class="text-right">Total</th>
														<th class="text-right" id="total"></th>
														<td></td>
													</tr>
													</tfoot>
												</table>
										
						<br/>
							</div>
						
					</div>
		</div>
	</div>
</div>
<script>

</script>