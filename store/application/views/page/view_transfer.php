<div class="row">
<div class="col-sm-12">
				<form action="" method="post">
				<div class="panel panel-default">
					<div class="panel-heading"><a href="<?php echo base_url('dashboard/stock_transfer') ?>" class="btn btn-sm btn-success">Back</a>
						  Transfer ID : <?php echo $transfer['transfer_id']  ?>
					<div class="tools">
					
					</div>
					</div>
				
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Transfer Date</label>
								  <span class="form-control input-sm"><?php echo $transfer['transfer_date']?> </span>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Branch</label>
									<span class="form-control input-sm">
									<?php
										$br = $this->stock->getBranch($transfer['branch']);
										
									?><?php echo $br['branch_name']  ?></span>
								 </div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Transfer User</label>
								  <?php 
								  $user = $this->users->get_user_by_id($transfer['transfer_user'],1);
								  ?>
								  <span class="form-control input-sm"><?php echo $user->username; ?></span>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Received User</label>
								  <span class="form-control input-sm"><?php  echo $transfer['reciever_userfullname'] ?></span>
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
										$prod_name =$this->stock->getStock($product['product']);
										?>
										<tr>
											<td><?php echo $prod_name[0]['product_name'] ?></td>
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
					
				
				</div>
			
</div>
	</form>
</div>