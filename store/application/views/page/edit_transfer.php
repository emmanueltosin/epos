<div class="row">
	<div class="col-sm-12">
		<form action="<?php  echo base_url('dashboard/update_transfer/'.$this->uri->segment(3)); ?>" method="post">
			<div class="panel panel-default">
					<div class="panel-heading"><a href="<?php echo base_url('dashboard/stock_transfer') ?>" class="btn btn-sm btn-success">Back</a>
						  Transfer ID : <?php echo $transfer['transfer_id']  ?> Edit Transfer
						<div class="tools">
						 <button class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> Update changes</button>
				 
						</div>
					</div>
			<div class="panel-body">
			 <h3>Transfer Information</h3>
					 <div class="row">
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Transfer Date</label>
								  <input id="transfer_date" required type="text" value="<?php echo $transfer['transfer_date']?>" name="transfer_date" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Date Available" class="date form-control input-sm">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Transfer To</label>
								  <input type="text" name="branch" class="form-control input-sm" placeholder="Branch Or Supplier"/>
								 </div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Transfer User</label>
								  <input type="text" readonly required value="<?php  echo $this->tank_auth->get_username(); ?>" placeholder="Transfer User" class="form-control input-sm">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Received User</label>
								  <input type="text" value="<?php echo $transfer['reciever_userfullname']?>" placeholder="Received User Fullname" name="reciever_userfullname" class="form-control input-sm">
								 </div>
							</div>
							
							<div class="col-lg-12">
								<div class="form-group xs-pt-10">
								  <label>Transfer Note</label>
								  <textarea placeholder="Detailed not about the transfer if any?.." style="height:150px" class="form-control col-lg-12" name="transfer_note"><?php echo $transfer['note']?></textarea>
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
										$prod_name =$this->stock->getStock($product['product']);
										$num = $prod_name['SN'];
										?>
										<tr id="stock-<?php echo $num; ?>">
											<td><select required  id="select-<?php echo $num; ?>" class="max-select form-control input-sm" name="product[<?php echo $num ?>]">
												<?php 
												$prods = $this->stock->getStocks();
												foreach($prods as $prod){	
												?>
												<option <?php  echo ($prod['SN']==$product['product'] ? 'selected' : '') ?> value="<?php echo $prod['SN'] ?>"><?php echo $prod['product_name'] ?></option>
												<?php
												}
												?>
											</select><input type="hidden" value="<?php echo $product['product_barcodes']  ?>" name="bar_code[<?php echo $num; ?>]" id="bar_code-<?php echo $num; ?>"/></td>
											<td><input id="product_qty_<?php echo $num; ?>" value="<?php echo $product['qty'] ?>" required type="number" name="qty[<?php echo $num; ?>]" value="" placeholder="Quantity" class="form-control input-xs"></td>
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
			</div>
		</form>
	</div>
</div>	