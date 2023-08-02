<div class="row">
<div class="col-sm-12">
			<form action="" method="post" id="stock_recieved_form">
				<div class="panel panel-default">
					<div class="panel-heading">Add New Supplier Invoice
					
					</div>
					<div class="panel-body">
						<div class="">
						<div class="main-content container-fluid">
          <div class="row wizard-row">
            <div class="col-md-12 fuelux">
              <div class="block-wizard panel panel-default">
                <div id="wizard1" class="wizard wizard-ux">
                  <ul class="steps">
                    <li data-step="1" class="active">Step 1<span class="chevron"></span></li>
                    <li data-step="2">Step 2<span class="chevron"></span></li>
                  </ul>
                  <div class="actions">
                    <button type="button" class="btn btn-xs btn-prev btn-default"><i class="icon mdi mdi-chevron-left"></i>Prev</button>
                    <button type="button" data-last="Finish" class="btn btn-xs btn-next btn-default">Next<i class="icon mdi mdi-chevron-right"></i></button>
                  </div>
                  <div class="step-content">
                    <div data-step="1" class="step-pane active">
                     <h3>Invoice Information</h3>
					 <div class="row">
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label> Invoice Date</label>
								  <input id="transfer_date" required type="text" required value="<?php echo date('Y-m-d'); ?>" name="recieved_date" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Date Available" class="date form-control input-sm">
								</div>
							</div>
						
						<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Supplier</label>
								  <select required class="form-control input-sm" name="supplier">
									<option value="">-Select Supplier-</option>
									<?php
										$brs = $this->stock->getSuppliers();
										foreach($brs as $br){
									?>
										<option value="<?php  echo $br['SN'] ?>"><?php echo $br['supplier_name']  ?></option>
										
									<?php
										}
									?>
								  </select>
								 </div>
							</div>
							
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Total Invoice Amount</label>
								  <input type="number" steps=".00001" required placeholder="Total Invoice Amount" name="total_invoice_amount" class="form-control input-sm">
								</div>
							</div>
							
							<!--
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Total Amount Paid</label>
								  <input type="number" steps=".00001" required placeholder="Total Amount Paid" name="amount_paid" class="form-control input-sm">
								</div>
							</div>
							
							 <input type="hidden" value="0" required placeholder="Total Amount Paid" name="amount_paid" class="form-control input-sm">
							<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Bank</label>
								    <select required class="form-control input-sm" name="bank">
										
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
							
							<div class="col-lg-3">
								<div class="form-group xs-pt-10">
								  <label>Payment Method</label>
								   <select name="payment_method" class="form-control select2_demo_2 input-sm" id="customer_id">
								<?php
									$pmethod = $this->db->get("payment_method")->result_array();
									foreach($pmethod as $p){
									if(strtolower($p['payment_method']) != "deposit"){
								?>
									<option  value="<?php echo $p['SN'] ?>"><?php echo $p['payment_method'] ?></option>
								<?php
									}
								}
								?>
								</select>
								 </div>
							</div>-->
							<input type="hidden" value="Pending" name="status"/>
							<!--
								<div class="col-lg-2">
								<div class="form-group xs-pt-10">
								  <label>Status</label>
								   <select name="status" class="form-control select2_demo_2 input-sm" id="customer_id">
										<option class="bs-title-option" value="Pending">Pending</option>
										<option class="bs-title-option" value="Complete">Complete</option>
								</select>
								 </div>
							</div>
							-->
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group xs-pt-10">
								  <label>Received Note</label>
								  <textarea placeholder="Received Note" style="height:150px" class="form-control col-lg-12" name="transfer_note"></textarea>
								 </div>
							
							</div>
						</diV>
					 <div class="form-group">
                        <br/><br/>
                            <button type="button" data-wizard="#wizard1" class="btn btn-default btn-space wizard-previous">Previous</button>
                            <button type="button" data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Next Step</button>
                          
                        </div>
					 
					 
                    </div>
                    <div data-step="2" class="step-pane">
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
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
											
												<th>
													 <button onclick="addTemp(this,'clicked');" type="button" class="btn btn-sm btn-primary">Add Product</button>
				 
												</th>
											</tr>
										</tfoot>
						</table>
						
					 <div class="form-group">
							<br/><br/>
                            <button type="button" data-wizard="#wizard1" class="btn btn-default btn-space wizard-previous">Previous</button>
                            <button data-wizard="#wizard1" class="btn btn-success btn-space" onclick="$(this).attr('disabled','disabled'); return $('#stock_recieved_form').submit();" type="button"><i class="mdi mdi-plus"></i> Complete</button>
                          
                        </div>
						
						
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		</div>
					</div>
					<div class="panel-footer">
					
				</div>
			
</div>
</form>
</div>