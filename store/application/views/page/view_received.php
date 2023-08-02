<div class="row">
<div class="col-sm-12">
				<form action="" method="post">
				<div class="panel panel-default">
					<div class="panel-heading"><a href="<?php echo base_url('dashboard/stock_recieved') ?>" class="btn btn-sm btn-success">Back</a>
						  Received ID : <?php echo $transfer['recieved_id']  ?>
					<?php
					$branch = $this->stock->getBranch_id();
					if($branch!=0){
					?>
					<div class="tools">
						
						<!-- <a href="<?php echo base_url('dashboard/edit_received/'.$this->uri->segment(3))  ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-edit"></i> Edit Received</a>-->
				 
					</div>
					<?php
					}
					?>
					</div>
				
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Received Date</label>
								  <span class="form-control input-sm"><?php echo $transfer['recieved_date']?> </span>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Branch/Supplier</label>
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
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Transfer User</label>
								 
								  <span class="form-control input-sm"><?php echo $transfer['transfer_user'] ; ?></span>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Received User</label>
								   <?php 
								  $user = $this->users->get_user_by_id($transfer['reciever_userfullname'],1);
								  ?>
								  <span class="form-control input-sm"><?php  echo  $user->username; ?></span>
								 </div>
							</div>
						</div>
						
						<h3>Product List(s)</h3>
						<table class="table table-bordered" id="table3">
										<thead>
											<tr>
												<th style="width:70%;">Product</th>
												<th style="width:25%;">Quantity</th>
												<th style="width:5%;">Remark</th>
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
											<td><b><?php echo ucwords($product['remark']) ?></b></td>
										</tr>
										<?php
										}
										?>
										</tbody>
										
						</table>
					</div>
					<div class="panel-footer">
					
							<!-- <a href="<?php echo base_url('dashboard/edit_received/'.$this->uri->segment(3))  ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-edit"></i>  Edit Received</a>-->
				 
				
				</div>
			
</div>
	</form>
</div>