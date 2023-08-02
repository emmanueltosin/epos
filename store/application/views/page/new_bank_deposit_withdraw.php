<div class="row">
	<div class="col-sm-12">
		<form action="" enctype="multipart/form-data" method="post" >
		<div class="panel">
			 <div class="panel-heading">New Withdraw/Deposit
                 <div class="tools"><button type="submit" class="btn  btn-primary"><i class="mdi mdi-save"></i> Save Transaction</button></div>
              </div>
			  <div class="form-horizontal">
					
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Trasnaction Date</label>
                      <div class="col-sm-10">
                        <input id="trasnaction_date" type="text" value="<?php echo date('Y-m-d'); ?>" name="date_" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Date Available" class="date form-control input-sm">
                      </div>
                    </div>
					<input type="hidden" name="added_by" value="<?php echo $this->tank_auth->get_user_id() ?>"/>
					<div class="form-group xs-mt-10">
                      <label for="model" class="col-sm-2 control-label">Trasnaction Type</label>
                      <div class="col-sm-10">
                        <select required class="form-control input-sm" name="type">
										<option value="Credit">Credit</option>
										<option value="Debit">Debit</option>
						</select>
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="model" class="col-sm-2 control-label">Select Bank</label>
                      <div class="col-sm-10">
                        <select required class="form-control input-sm" name="bank">
							<option value="">Select Bank</option>
										
										<?php  
										foreach($this->db->get("tbl_bank")->result_array() as $bank){
										?>
										<option value="<?php echo $bank['SN'] ?>"><?php echo $bank['bank_name'] ?>[<?php echo $bank['account_number'] ?>]</option>
										<?php
										}
										?>
						</select>
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="model" class="col-sm-2 control-label">Trasnaction Amount</label>
                      <div class="col-sm-10">
                        <input class="form-control input-sm" name="amt" placeholder="Transaction Amount" class="form-control input-sm" step="0.00000000000000000000" type="number"/>
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="model" class="col-sm-2 control-label">More Description</label>
					   <div class="col-sm-10">
					  <textarea class="form-control input-sm" tabindex="-6" required placeholder="Comment About this Trasaction like Teller no etc" name="comment"></textarea>
					  </div>
					 </div>
					 <div class="form-group xs-mt-10">
						<button type="submit" style="margin-left:150px;" class="btn btn-primary"><i class="mdi mdi-save"></i> Save Transaction</button>
					 </div>
					 <br/><br/><br/>
			  </div>
		</div>
	</div>
</div>