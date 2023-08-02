<div class="row">
<div class="col-sm-12">
			<form action="<?php  echo base_url('dashboard/update_received/'.$this->uri->segment(3)); ?>" method="post">
					
				<div class="panel panel-default">
					<div class="panel-heading"><a href="<?php echo base_url('dashboard/stock_recieved') ?>" class="btn btn-sm btn-success">Back</a>
						  Received ID : <?php echo $transfer['recieved_id']  ?> Edit Received
					<div class="tools">
						 <button class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> Update changes</button>
				 
					</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Transfer Date</label>
								  <input id="transfer_date" required type="text" value="<?php echo $transfer['recieved_date']?>" name="recieved_date" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Date Available" class="date form-control input-sm">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Supplier/Branch</label>
								 	<?php
								if(!empty($transfer['branch'])){																
								?>
								<input type="text" name="branch" class="form-control input-sm" value="<?php echo $transfer['branch']?>" placeholder="Branch Or Supplier"/>
								<?php
								}else{
									?>
									 <select name="supplier" required class="form-control input-sm" name="supplier">
									<?php
										$brs = $this->stock->getSuppliers();
										foreach($brs as $br){
									?>
										<option <?php echo ($br['SN']==$transfer['supplier'] ? 'selected' : ''); ?> value="<?php  echo $br['SN'] ?>"><?php echo $br['supplier_name']  ?></option>
										
									<?php
										}
									?>
								  </select>
									<?php
									}
									?>
								 </div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Transfer User</label>
								  <input type="text"  required name="transfer_user" value="<?php echo $transfer['transfer_user']?>" placeholder="Transfer User" class="form-control input-sm">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Received User</label>
								  
								  <input type="text" value="<?php  echo $this->tank_auth->get_username(); ?>" placeholder="Received User Full name" name="reciever_userfullname" class="form-control input-sm">
								 </div>
							</div>
						</div>
						
						<h3>Product List(s)</h3>
						<table class="table table-bordered">
										<thead>
											<tr>
												<th style="min-width:40%;">Product</th>
												<th style="width:25%;">Quantity</th>
												<th style="width:5%;">Remark</th>
												<th style="width:5%;">Action</th>
											</tr>
										</thead>
										<tbody id="produt_list">
										<?php
										$products = json_decode($transfer['products'],TRUE);
										foreach($products as $product){
										$prod_name =$this->stock->getStockByID($product['product']);
										?>
										<tr>
											<td><select required class="select2 form-control input-sm" name="product[]">
												<?php 
												$prods = $this->stock->getStocks();
												foreach($prods as $prod){	
												?>
												<option <?php  echo ($prod['SN']==$prod_name['SN'] ? 'selected' : '') ?> value="<?php echo $prod['SN'] ?>"><?php echo $prod['product_name'] ?></option>
												<?php
												}
												?>
											</select></td>
											<td>
											<div class="input-group">
											<input type="number" class="form-control input-sm" placeholder="Quantity" value="<?php echo $product['qty'] ?>" name="qty[]"/>
											</div>
											</td>
											<td><b><?php echo ucwords($product['remark']) ?></b></td>
											<td><button onclick="$(this).parent().parent().remove()" class="btn btn-danger" type="button">Delete</button></td>
										</tr>
										<?php
										}
										?>
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
											
												<th>
													 <button onclick="addTemp();" type="button" class="btn btn-lg btn-rounded btn-primary"><i class="mdi mdi-plus"></i></button>
				 
												</th>
											</tr>
										</tfoot>
						</table>
					</div>
					<div class="panel-footer">
					
						 <button class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> Update changes</button>
				
					
				</div>
			
</div>
</form>
</div>