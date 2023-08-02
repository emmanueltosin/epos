<div class="row">
<div class="col-sm-12">
				<form action="" method="post">
				<div class="panel panel-default">
					<div class="panel-heading"><a href="<?php echo base_url('dashboard/supplier_invoice_report') ?>" class="btn btn-sm btn-success">Back</a>
						  Invoice ID : <?php echo $transfer['supplier_id']  ?>
			
					<div class="tools">
						<?php if($transfer['status'] =="Pending"){   ?>
					 <div class="btn-group">
						<a href="<?php  echo base_url() ?>dashboard/add_new_invoice_history/<?php echo $this->uri->segment(3) ?>" class="btn btn-sm btn-success">Add New Invoice Payment</a>
						<!-- <a href="<?php echo base_url('dashboard/complete_invoice/'.$this->uri->segment(3))  ?>" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure, you want to complete this invoice')"><i class="mdi mdi-check"></i>  Complete Invoice</a>-->
			
					</div>
					<?php } ?>
				 
					</div>
				
					</div>
				
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Received Date</label>
								  <span class="form-control input-sm"><?php echo $transfer['recieved_date']?> </span>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Supplier</label>
								   <span class="form-control input-sm">
									<?php
								if(!empty($transfer['branch'])){							
									echo $transfer['branch']; 
								}else{
									$supp = $this->stock->getSupplier($transfer['supplier']);
									echo $supp['supplier_name'];
								}
									?>
									   
								   </span>
								 </div>
							</div>
								<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Total Invoice Amount</label>
								  <span class="form-control input-sm"><?php echo number_format($transfer['total_invoice_amount'],2) ; ?></span>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Amount Paid</label>
								  <span class="form-control input-sm"><?php echo $this->stock->getInvoiceAmountpaid($transfer['SN'],TRUE) ; ?></span>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Balance</label>
								  <span class="form-control input-sm"><?php echo number_format( ($transfer['total_invoice_amount'] - $this->stock->getInvoiceAmountpaid($transfer['SN'],FALSE)),2) ; ?></span>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Status</label>
								   <?php 
									$array = array(
										'Pending'=>'<span class="label label-danger">Pending</span>',
										'Complete'=>'<span class="label label-success">Complete</span>'
									);	
								  ?>
								  <span class="form-control input-sm"><?php echo $array[$transfer['status']]; ?></span>
								 </div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
							<h3>Invoice Payment History</h3>
							<table id="table3" class="table table-striped table-hover table-fw-widget" style="font-size:12px;">
												<thead>
													<tr>
														<th class="text-center">Date</th>
														<th class="text-center">Amount Paid</th>
														<th class="text-center">Bank</th>
														<th class="text-center">Description</th>														
													</tr>
												</thead>
												<tbody>
													<?php
														$deposit_history = $this->stock->getInvoicePaymentHistory($transfer['SN']);
												
														foreach($deposit_history as $dep){
													?>
														<tr>
															<td  class="text-center"><?php  echo $dep['date_added']  ?></td>
															<td  class="text-center"><?php  echo $dep['amount']  ?></td>
															<td  class="text-center"><?php  $bank = $this->db->get_where("tbl_bank",array('SN'=>$dep['bank']))->row();  echo $bank->bank_name."[".$bank->account_number."]";  ?></td>	
															<td  class="text-center"><?php  echo $dep['description']  ?></td>															
														</tr>
													<?php
														}
													?>
												</tbody>
													
												</table>
							</div>	</div>	
						
						
						<br/><br/>
						<h3>Product List(s)</h3>
						<table class="table table-bordered" id="table2">
										<thead>
											<tr>
												<th style="width:70%;">Product</th>
												<th style="width:25%;">Quantity</th>
										
											</tr>
										</thead>
										<tbody id="produt_list">
										<?php
										$products = json_decode($transfer['products'],TRUE);
										foreach($products as $product){
										$prod_name =$this->stock->getStockByID($product['product']);
										?>
										<tr>
											<td><?php echo $prod_name['product_name'] ?></td>
											<td><?php echo $product['qty'] ?></td>
			
										</tr>
										<?php
										}
										?>
										</tbody>
										
						</table>
					</div>
					<div class="panel-footer">
					
						
				
				</div>
			
</div>
	</form>
</div>