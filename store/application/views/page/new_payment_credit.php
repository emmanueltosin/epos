<?php 
$deposits = $this->db->get_where("tbl_credit_sales",array("credit_id"=>$this->uri->segment(3)))->result_array()[0];
$customer = $this->settings->getCustomer($deposits['customer']);
$customer = $customer['firstname'].' '.$customer['lastname'];
?>
<div class="row">
	<div class="col-sm-12">
		<form action="" enctype="multipart/form-data" method="post" >
		<div class="panel">
			 <div class="panel-heading"><a href="<?php echo base_url('dashboard/view_credit/'.$this->uri->segment(3)) ?>" class="btn btn-sm btn-success">Back</a> New Credit Sale Payment
                 <div class="tools"><button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Save</button></div>
              </div>
			  <div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group xs-mt-10">
                      <label for="product_name" class="col-sm-2 control-label">Customer</label>
                      <div class="col-sm-8">
						<input type="text" value="<?php echo $customer ?>" class="input-sm form-control" value="" disabled="disabled"/>
						<input type="hidden" name="customer_id" value="<?php echo $deposits['customer']; ?>"/>
						<input type="hidden" name="credit_SN" value="<?php echo $deposits['SN'] ?>"/>
						<input type="hidden" name="credit_id" value="<?php echo $deposits['credit_id'] ?>"/>
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="product_name"  class="col-sm-2 control-label">Payment Date</label>
                      <div class="col-sm-8">
						<input id="date_available" required type="text" value="<?php echo date('Y-m-d') ?>" name="date_added" data-min-view="2" data-date-format="yyyy-mm-dd" placeholder="Date Available" class="date form-control input-sm">
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Amount Paid</label>
                      <div class="col-sm-8">
                        <input id="price" min="1" max="<?php echo ($deposits['total_amount_paid'] -$this->stock->getTotalAmountCreditPaid($deposits['SN'],false)) ?>" value="<?php echo ($deposits['total_amount_paid'] -$this->stock->getTotalAmountCreditPaid($deposits['SN'],false)) ?>" type="number" required name="amount"  placeholder="Amount Deposited" class="form-control input-sm">
                      </div>
                    </div>

<input type="hidden" name="sales_rep" id="user_id" c value="<?php  echo $this->users->get_user_by_username($this->session->userdata("username"))->SN ?>"/>
				
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Payment Method</label>
                      <div class="col-sm-8">
                      <select name="payment_method" required id="method" class="form-control select2_demo_2 select2">
							<option value="">Select One</option>
							<?php 
								$methods = $this->db->get('payment_method')->result_array();
								foreach($methods as $method){
							?>
								<option value="<?php echo $method['SN'] ?>"><?php echo $method['payment_method'] ?></option>
							<?php 
							}
							?>
						</select>
                      </div>
                    </div>

					
				</div>
			  </div>
		</div>
		</form>
	</div>
</div>