<div class="row">
	<div class="col-sm-12">
		<form action="" enctype="multipart/form-data" method="post"  onsubmit="$('#sub').attr('disabled','disabled')" >
		<div class="panel">
			 <div class="panel-heading">New Deposits
                 <div class="tools"><button type="submit" id="sub" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Save</button></div>
              </div>
			  <div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group xs-mt-10">
                      <label for="product_name" class="col-sm-2 control-label">Customer</label>
                      <div class="col-sm-8">
					<select name="customer_id"  required id="customer_id" class="form-control select2_demo_2 input-sm select2">
					<option class="bs-title-option" value="">Select Customer</option>
					<?php
						$customers = $this->settings->getCustomers();
						foreach($customers as $customer){
					?>
						<option value="<?php echo $customer['SN'] ?>"><?php echo $customer['firstname'] ?>  <?php echo $customer['lastname'] ?></option>
					<?php
						}
					?>
					</select><br/><br/>
					<a href="#" data-toggle="modal" data-target="#PrimaryModalalert" class="btn btn-primary">Add New Customer</a>
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="product_name"  class="col-sm-2 control-label">Deposit Date</label>
                      <div class="col-sm-8">
						<input id="date_available" required type="text" value="<?php echo date('Y-m-d') ?>" name="date_added" data-min-view="2" data-date-format="yyyy-mm-dd" placeholder="Date Available" class="date form-control input-sm">
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Amount Deposited</label>
                      <div class="col-sm-8">
                        <input id="price" type="number" required name="amount"  placeholder="Amount Deposited" class="form-control input-sm">
                      </div>
                    </div>
					<input type="hidden" name="sales_rep" id="user_id"  value="<?php  echo $this->users->get_user_by_username($this->session->userdata("username"))->SN ?>"/>
					
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Payment Method</label>
                      <div class="col-sm-8">
                      <select name="payment_method" required id="method" class="form-control select2_demo_2 select2">
							<option value="">Select One</option>
							<?php 
								$methods = $this->db->get('payment_method')->result_array();
								foreach($methods as $method){
									if($method['payment_method'] != "DEPOSIT"){
							?>
								<option value="<?php echo $method['SN'] ?>"><?php echo $method['payment_method'] ?></option>
							<?php 
									}
							}
							?>
						</select>
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Deposit For</label>
                      <div class="col-sm-8">
                        <textarea placeholder="Product Description" required style="height:200px" class="form-control col-lg-12" name="deposit_for"></textarea>
							
                      </div>
                    </div>

					
				</div>
			  </div>
		</div>
		</form>
	</div>
</div>

<div id="PrimaryModalalert" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
                                
								<div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-close-area modal-close-df">
                                            <a class="close" data-dismiss="modal" href="modals.html#"><i class="fa fa-close"></i></a>
                                        </div>
                                        <div class="modal-body">
										<form action="<?php echo base_url('dashboard/addCustomer') ?>" method="POST" id="new_customer_form" class="form-horizontal">
										 <div class="row">
                                        <div class="col-lg-12">
                                            <div class="login-title">
                                                <h1>New Customer Form</h1>
                                            </div>
                                        </div>
                                    </div>
									
									
										<div class="form-group xs-mt-10">
										  <label for="product_name"  class="col-sm-3 control-label">First Name</label>
										  <div class="col-sm-8">
										 <input type="text" required class="form-control input-sm" name="firstname">
										</div>
										</div>
									
									<div class="form-group xs-mt-10">
										  <label for="product_name"  class="col-sm-3 control-label">Last Name</label>
										  <div class="col-sm-8">
										<input type="text" class="form-control input-sm" required name="lastname">
										</div>
										</div>
									
									<div class="form-group xs-mt-10">
										  <label for="product_name"  class="col-sm-3 control-label">Phone Number</label>
										  <div class="col-sm-8">
										 <input type="text" required class="form-control input-sm" name="phone">
										</div>
										</div>
									
										<div class="form-group xs-mt-10">
										  <label for="product_name"  class="col-sm-3 control-label">Address</label>
										  <div class="col-sm-8">
										  <input type="text" class="form-control input-sm" name="address">
										</div>
										</div>
									<div class="form-group xs-mt-10">
									 <label for="product_name"  class="col-sm-3 control-label"></label>
										 <button type="submit" class="btn btn-primary">Add Customer</button>
									</div>
									</form>									
									</div>
                                    </div>
                                </div>
								
                            </div>	