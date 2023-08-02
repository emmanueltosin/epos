<?php
$deposits = $this->db->get_where("deposit",array("SN"=>$this->uri->segment(3)))->result_array()[0];
$deposit_history = $this->db->get_where("deposit_payment_history",array("deposit_SN"=>$this->uri->segment(3)))->result_array();
$user =$this->users->get_user_by_id($deposits['sales_rep'],1);
$customer = $this->settings->getCustomer($deposits['customer_id']);
$customer = $customer['firstname'].' '.$customer['lastname'];
?>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default panel-table">
					<div class="panel-heading"><a href="<?php echo base_url('dashboard/deposits') ?>" class="btn btn-sm btn-success">Back</a> Deposit Information
					 <div class="tools">
					 <div class="btn-group btn-sm">
																<div class="dropdown">
																  <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown">Print All Receipt
																  <span class="caret"></span></button>
																  <ul class="dropdown-menu">
																	<li><a onclick="window.open($(this).attr('href'),'width=400;height=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_add_depo_full_recipt/'.$this->uri->segment(3)) ?>/Thermal">Thermal Receipt</a></li>
																	<li><a onclick="window.open($(this).attr('href'),'width=400;height=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_add_depo_full_recipt/'.$this->uri->segment(3)) ?>/Big">Big Receipt</a></li>
																  </ul>
																</div>
																</div>
					<?php if($deposits['deposit_status'] =="PENDING"){   ?>
					 <div class="btn-group">
						<a href="<?php  echo base_url() ?>dashboard/refund_deposit/<?php echo $this->uri->segment(3) ?>" class="btn btn-sm btn-danger">Refund Deposit</a>
						<a href="<?php  echo base_url() ?>dashboard/add_new_deposit_history/<?php echo $this->uri->segment(3) ?>" class="btn btn-sm btn-primary">Add New Deposit Payment</a>
						<a href="<?php  echo base_url() ?>dashboard/checkout_depsits/<?php echo $this->uri->segment(3) ?>" class="btn btn-sm btn-success">Proceed to Checkout <i class="mdi mdi-long-arrow-right"></i></a>
					</div>
					<?php } ?>
					 </div>
					</div>
					<div class="panel-body">
						<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Receipt ID</label>
								  <span class="form-control input-sm"><?php echo $deposits['reciept_id'] ?> </span>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Customer</label>
								   <span class="form-control input-sm"><?php echo $customer ?> </span>
								 </div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Total Deposited</label>
								 
								  <span class="form-control input-sm"><?php echo $this->stock->getTotalAmountDeposited($this->uri->segment(3),true) ?></span>
								</div>
							</div>
		
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Status</label>
								 
								  <span class="form-control input-sm"><?php echo $deposits['deposit_status']; ?></span>
								 </div>
							</div>
							</div>
							</div>
							<?php if($deposits['deposit_status']=="REFUND"){ ?>
							<div class="row">
							<div class="col-sm-12">
								<h3>Reason For Deposit Refund</h3>
								<div class="well"><?php echo $deposits['reason_for_refund'] ?></div>
							</div>
							</div>
							<?php } ?>
							<?php
							if($deposits['sales_id'] > 0){
							?>
							<div class="row">
								<div class="col-sm-12">
									<h3>Product Bought</h3>
									<?php
										$reservation = $this->stock->getSale($deposits['sales_id']);
										$items = json_decode($reservation['items'],true);
									?>
									<table class="table table-condensed table-bordered" id="table3">
												<thead>
													<tr>
														<th class="text-center">Item Name</td>
														<th class="text-center">Qty</td>
														<th class="text-center">Price</td>
														<th class="text-right">Total</th>
														<th class="text-right">Profit</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													
													$alltotal=0;
													foreach($items as $item) {
														$info = $item;
														$alltotal+=$info['total'];
													?>
													<tr>
														<td class="text-center"><?php  echo $item['item_name'] ?></td>
														<td class="text-center"><?php  echo $item['item_qty'] ?></td>
														<td class="text-center"><?php  echo number_format($item['item_price'],2) ?></td>
														<td class="text-right"><?php  echo number_format($item['total'],2); ?></td>
														<td class="text-right"><?php  echo @number_format($item['profit'],2); ?></td>
													</tr>
													<?php } ?>
												</tbody>
													<tfoot>
														<tr>
														
														<td></td>
														<td></td>
														<td></td>
														<th class="text-right">Sub Total</th>
														<th class="text-right"><?php echo number_format($alltotal,2); ?></th>
														
													</tr>
													<tr>
														
														<td></td>
														<td></td>
														<td></td>
														<th class="text-right">Discount</th>
														<th class="text-right"><?php echo number_format($reservation['discount'],2)  ?></th>
													</tr>
													<tr>
													
														<td></td>
														<td></td>
														<td></td>
														<th class="text-right">VAT(<?php echo $reservation['vat'] ?>%)</th>
														<?php $vat = (($reservation['vat']/100) * $alltotal);  ?>
														
														<th class="text-right"><?php echo number_format($vat,2); ?></th>
													</tr>
													<tr>
													
														<td></td>
														<td></td>
														<td></td>
														<th class="text-right">Charge(<?php echo $reservation['scharge'] ?>%)</th>
														<?php $charge = (($reservation['scharge']/100) * $alltotal);  ?>
														
														<th class="text-right"><?php echo number_format($charge,2); ?></th>
													</tr>
													<tr>
														<?php $alltotal=$alltotal-$reservation['discount']; ?>
														<?php $alltotal=$alltotal+$charge ?>
														<?php $alltotal=$alltotal+$vat ?>
														<td></td>
														<td></td>
													<td></td>
														<th class="text-right">Total</th>
														<th class="text-right"><?php echo number_format($alltotal,2); ?></th>
													</tr>
													<tr>
														<td></td>
														<td></td>
													<td></td>
														<th class="text-right">Total Profit</th>
														<th class="text-right"><?php echo number_format($reservation['total_profit'],2); ?></th>
													</tr>
													</tfoot>
												</table>
								</div>
							</div>
							<?php
							}
							?>
							<div class="row">
							<div class="col-sm-12">
							<h3>Deposit Payment History</h3>
							<table id="table3" class="table table-striped table-hover table-fw-widget" style="font-size:12px;">
												<thead>
													<tr>
														<th class="text-center">Amount Deposited</th>
														<th class="text-center">Date</th>
														<th class="text-center">Payment Method</th>
														<th class="text-right">Receipt ID</th>
														<th class="text-right">Sales Rep</th>
														
													</tr>
												</thead>
												<tbody>
													<?php
														foreach($deposit_history as $dep){
													?>
														<tr>
															<td  class="text-center"><?php  echo $dep['amount']  ?></td>
															<td  class="text-center"><?php  echo $dep['date_added']  ?></td>
															<td  class="text-center"><?php  echo $this->db->get_where("payment_method",array('SN'=>$dep['payment_method']))->row()->payment_method  ?></td>
															<td  class="text-right"><?php  echo $dep['reciept_id']  ?></td>
															<td  class="text-right"><?php echo $this->db->get_where('users',array("id"=>$dep['sales_rep']))->result_array()[0]['username'] ?></td>
														
														</tr>
													<?php
														}
													?>
												</tbody>
													
												</table>
							</div>	</div>			
						<br/>
							</div>
						
					</div>
		</div>
	</div>
</div>
<script>
function con(msg){
	return confirm(msg);	
}
</script>