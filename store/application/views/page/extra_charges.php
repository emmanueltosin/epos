<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Application Settings</div>
                <div class="tab-container">
				  <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
						<div class="col-lg-3">
						</div>
						<div class="col-lg-6">
						<div class="panel">
								<div class="panel panel-heading">Store Settings</div>
								<div class="panel-body">
						<form action=""  method="post" enctype="multipart/form-data">
							<?php
								$extra_charges=$this->db->from("others")->where("SN","1")->get()->result_array()[0];
							?>
							
							<div class="form-group xs-pt-10">
							<br/>
							  <label for="branch_name" class="col-sm-12 control-label">Value Added Tax - VAT(%)</label>
							  <div class="col-sm-12">
								<input id="vat" value="<?php echo $extra_charges['vat'] ?>" required type="text" name="vat" placeholder="Branch name" class="form-control input-sm">
							  </div>
							</div>
							
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Service Charge(%)</label>
							  <div class="col-sm-12">
								<input id="scharge" value="<?php echo $extra_charges['scharge'] ?>" type="text" name="scharge" placeholder="" class="form-control input-sm">
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">No of Days to product Track</label>
							  <div class="col-sm-12">
								<input id="track_expiry_date" value="<?php echo $extra_charges['track_expiry_date'] ?>" type="number" name="track_expiry_date" placeholder="Expiry Days Track" class="form-control input-sm">
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Minimum Quantity</label>
							  <div class="col-sm-12">
								<input id="track_expiry_date" value="<?php echo $extra_charges['min_qty'] ?>" type="number" name="min_qty" placeholder="Minimum Quantity" class="form-control input-sm">
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Credit Limit</label>
							  <div class="col-sm-12">
								<input id="credit_limit" value="<?php echo $extra_charges['credit_limit'] ?>" type="number" name="credit_limit" placeholder="Credit Limit" class="form-control input-sm">
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Store Name</label>
							  <div class="col-sm-12">
								<input id="sname" value="<?php echo $extra_charges['sname'] ?>" type="text" name="sname" placeholder="Store Name" class="form-control input-sm">
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="branch_name" class="col-sm-12 control-label">Branch Name</label>
							  <div class="col-sm-12">
								<input id="vat" value="<?php echo $extra_charges['store_name'] ?>" required type="text" name="store_name" placeholder="Branch Name" class="form-control input-sm">
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Store Address Line 1</label>
							  <div class="col-sm-12">
							  <textarea class="form-control" name="saddress_1" placeholder="Store Address Line 1"><?php echo $extra_charges['saddress_1'] ?></textarea>
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Store Address Line 2</label>
							  <div class="col-sm-12">
							  <textarea class="form-control" name="saddress_2" placeholder="Store Address Line 2"><?php echo $extra_charges['saddress_2'] ?></textarea>
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Store Contact Numbers</label>
							  <div class="col-sm-12">
							  <textarea class="form-control" name="scontact_no" placeholder="Store Contact Numbers"><?php echo $extra_charges['scontact_no'] ?></textarea>
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/><br/><br/>
							  <label for="note" class="col-sm-12 control-label">Footer Reciept Notes</label>
							  <div class="col-sm-12">
							  <textarea class="form-control" name="footer_rec" placeholder="Footer Reciept Notes"><?php echo $extra_charges['footer_rec'] ?></textarea>
							  </div>
							</div>
							<div class="form-group xs-pt-10">
							<br/><br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Store Logo</label>
							  <div class="col-sm-12">
								<?php
								if($extra_charges['slogo']!=""){
								?>
								<br/><br/>
								<img src="<?php echo $extra_charges['slogo'] ?>"  style="width:60%"/>
								<?php
								}
								?>
								<input type="file" name="slogo" class="input-sm form-control"/>
							</div>
							</div>
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Save Changes</button>
							</div>

						</form>
						
						</div>
							</div>
						</div>
							<div class="col-lg-3">
						</div>
					</div>
                  </div>
                </div>
              </div>
		
	</div>
