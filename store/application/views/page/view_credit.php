<?php
$in = $this->stock->getCredit($this->uri->segment(3));
				if(is_numeric($in['customer'])){
						$customer = $this->settings->getCustomer($in['customer']);
						$customer = $customer['firstname'].' '.$customer['lastname'];
						}else{
							$customer = $in['customer'];
						}
	
						$user =$this->users->get_user_by_id($in['user_id'],1);
$credit_history = $this->db->get_where("credit_payment_history",array("credit_SN"=>$in['SN']))->result_array();

?>
<?php
$reservation = $this->stock->getCredit($this->uri->segment(3));
$items = json_decode($in['items'],true);
?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default panel-table">
					<div class="panel-heading">Credit Sale Transaction
					 <div class="tools">
					 <div class="btn-group btn-sm">
												<div class="dropdown">
												  <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown">Print All
												  <span class="caret"></span></button>
												  <ul class="dropdown-menu">
														<li><a onclick="window.open($(this).attr('href'),'width=400;height=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_add_credit_full_recipt/'.$this->uri->segment(3)) ?>/Thermal">Thermal Receipt</a></li>
														<li><a onclick="window.open($(this).attr('href'),'width=400;height=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_add_credit_full_recipt/'.$this->uri->segment(3)) ?>/Big">Big Receipt</a></li>		 
												  </ul>
												</div>
								</div>
						<div class="btn-group btn-sm">
							<!--<a  onclick="return con('Are sure you want delete this sales transaction');" href="<?php echo base_url('dashboard/delete_credit/'.$this->uri->segment(3)) ?>" class="btn btn-sm btn-danger">Delete Credit Sales</a>-->
							
						</div>
					 </div>
					</div>
					<div class="panel-body">
						<div class="col-lg-12">
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Credit ID</label>
								  <span class="form-control input-sm"><?php echo $in['credit_id'] ?> </span>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Customer</label>
								   <span class="form-control input-sm"><?php echo $customer ?> </span>
								 </div>
							</div>
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Total Amount</label>
								 
								  <span class="form-control input-sm"><?php echo number_format($in['total_amount_paid'],2); ?></span>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Total Paid</label>
								 
								  <span class="form-control input-sm"><?php echo $this->stock->getTotalAmountCreditPaid($in['SN'],true); ?></span>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Total Due</label>
								 
								  <span class="form-control input-sm"><?php echo number_format(($in['total_amount_paid']-$this->stock->getTotalAmountCreditPaid($in['SN'],false)),2); ?></span>
								</div>
							</div>
							</div>
							<div class="col-lg-12">
							<h3>Product List(s)</h3>
							<table class="table table-condensed table-bordered" id="table3">
												<thead>
													<tr>
														<th class="text-center">Item Name</td>
														<th class="text-center">Qty</td>
														<th class="text-center">Price</td>
														<th class="text-right">Total</th>
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
													</tr>
													<?php } ?>
												</tbody>
													<tfoot>
														<tr>
														
														<td></td>
														<td></td>
												
														<th class="text-right">Sub Total</th>
														<th class="text-right"><?php echo number_format($alltotal,2); ?></th>
														
													</tr>
													<tr>
														
														<td></td>
														<td></td>
													
														<th class="text-right">Discount</th>
														<th class="text-right"><?php echo number_format($reservation['discount'],2)  ?></th>
													</tr>
													<tr>
													
														<td></td>
														<td></td>
														
														<th class="text-right">VAT(<?php echo $reservation['vat'] ?>%)</th>
														<?php $vat = (($reservation['vat']/100) * $alltotal);  ?>
														
														<th class="text-right"><?php echo number_format($vat,2); ?></th>
													</tr>
													<tr>
													
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
													
														<th class="text-right">Total</th>
														<th class="text-right"><?php echo number_format($alltotal,2); ?></th>
													</tr>
													</tfoot>
												</table>
										
						<br/>
						<h3>Payment History(s) <?php if($in['status'] != "1"){  ?> <a href="<?php echo base_url('dashboard/new_payment_credit/'.$this->uri->segment(3)) ?>" class="pull-right btn btn-sm btn-success">Add New Payment</a> <?php } ?></h3> 
						<table  class="table table-striped table-hover"  style="font-size:12px;"
												<thead>
													<tr>
														<th class="text-center">Amount Deposited</td>
														<th class="text-center">Date</td>
														<th class="text-center">Payment Method</td>
														<th class="text-right">Receipt ID</th>
														<th class="text-right">Sales Rep</th>
													</tr>
												</thead>
												<tbody>
													<?php
														foreach($credit_history as $dep){
													?>
														<tr>
															<td  class="text-center"><?php  echo $dep['amount']  ?></td>
															<td  class="text-center"><?php  echo $dep['date_added']  ?></td>
															<td  class="text-center"><?php  echo $this->db->get_where("payment_method",array('SN'=>$dep['payment_method']))->row()->payment_method  ?></td>
															<td  class="text-right"><?php  echo $dep['reciept_id']  ?></td>
															<td  class="text-right"><?php echo $this->db->get_where('users',array("SN"=>$dep['sales_rep']))->result_array()[0]['username'] ?></td>
														</tr>
													<?php
														}
													?>
												</tbody>
													
												</table>
						<br/>
							</div></div>
						
					</div>
		</div>
	</div>
</div>
<script>
function con(msg){
	return confirm(msg);	
}
</script>