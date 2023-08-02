<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
                <div class="panel-heading">New Return Merchandise
					 <div class="tools">
					 </div>
				</div>
				<form action="" method="post">
					<div class="panel-body">
						<div class="form-horizontal">
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Product Name</label>
							  <div class="col-sm-10">
								<input class="form-control input-sm select" name="product_name" placeholder="Product Name" />
							  </div>
							</div>
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Branch</label>
							  <div class="col-sm-10">
								<select required class="form-control input-sm" name="branch">
									<option value="">-Select Branch-</option>
									<?php
										$brs = $this->stock->getBranches();
										foreach($brs as $br){
									?>
										<option value="<?php  echo $br['SN'] ?>"><?php echo $br['branch_name']  ?></option>
										
									<?php
										}
									?>
								  </select>
							  </div>
							</div>
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Transfer Name</label>
							  <div class="col-sm-10">
								<input id="transfer_name" name="transfer_name" type="text" required  max="255" placeholder="Transfer Name" class="form-control input-sm">
							  </div>
							</div>
					
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Testing Staff</label>
							  <div class="col-sm-10">
								<input id="testing_staff" name="testing_staff" type="text" required  max="255" placeholder="Testing Staff" class="form-control input-sm">
							  </div>
							</div>
							
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Fault</label>
							  <div class="col-sm-10">
									<textarea class="form-control" required name="fault" placeholder="Fault"></textarea>
								</div>
							</div>
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Receipt Number</label>
							  <div class="col-sm-10">
								<input id="transfer_name" name="receipt_number" type="text"   max="255" placeholder="Receipt Number" class="form-control input-sm">
							  </div>
							</div>
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Date Sold</label>
							  <div class="col-sm-10">
								<input id="date_sold"  type="text" value="" name="date_sold" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Date Sold" class="date form-control input-sm">
								</div>
							</div>
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Date Returned</label>
							  <div class="col-sm-10">
								<input id="date_returned"  type="text" value="" name="date_returned" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Date Returned" class="date form-control input-sm">
								</div>
							</div>
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Customer Name</label>
							  <div class="col-sm-10">
								<input id="transfer_name" required name="customer_name" type="text" required  max="255" placeholder="Customer Name" class="form-control input-sm">
							  </div>
							</div>
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label"></label>
							  <div class="col-sm-10">
							
								<button class="btn btn-primary" type="submit">Add RMA</button>
							</div>
							</div>
							
						</div>
					</div>
				</form>
		</div>
	</div>
</div>