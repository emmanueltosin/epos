 <?php
	$payment = $this->stock->getpaymentgeneratedbyid($this->uri->segment(3));
	$history = $this->stock->getpaymentgeneratedhistorybypaymentid($this->uri->segment(3));
 ?>
 
		
		 <div class="panel panel-default">
                <div class="panel-heading"><strong>Payment Information</strong> <?php if($payment['status'] !="1"){  ?><a href="<?php echo base_url('dashboard/mark_fully_paid_salary/'.$payment['SN']) ?>" class="pull-right btn btn-success btn-sm">Mark as Paid</a> <?php } ?></div>
                <?php
					$array = array(
												'0'=>'Pending',
												'1'=>'Paid'
											);
				?>
				<div class="panel-body"><br/>
          <div class="row">
            <div class="col-lg-6">
              <form>
                <fieldset disabled>
                      <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><strong>ID</strong> :  <?php echo $payment['payment_id']  ?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><strong>Date</strong> : <?php echo $payment['month']  ?>,<?php echo $payment['year']  ?></label>

                    </div>
					 <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><strong>No. of Staff</strong> : <?php echo $payment['total_staff']  ?> Staff</label>
                    </div>
                </fieldset>
              </form>
            </div>
            <div class="col-lg-6">
              <form>
                <fieldset disabled>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><strong>Total</strong> : <?php echo number_format($payment['total_pay'],2)  ?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><strong>Payment Date</strong> : <?php echo ($payment['pay_date']=='0000-00-00' ? '' :$payment['pay_date']);   ?></label>
                    </div>
					 <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><strong>Status</strong> : <?php echo $array[$payment['status']]  ?></label>
                    </div>
                </fieldset>
              </form>
            </div>                
          </div> 
        </div>
                </div>
		
		
		
				 <div class="panel panel-default">
					  <div class="panel-heading"><strong>Generated Payment</strong></div>
					  <div class="panel-body">
						 <table class="table" id="table3">
							<thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Salary</th>
								<th>Loan Deduction</th>
								<th>Addition</th>
								<th>Deduction</th>
								<th>Net Pay</th>
								
                            </tr>
                        </thead>
						<tbody>
							<?php
								$num=1;
								$alltotal = 0;
								foreach($history as $payment){
									$emp = $this->db->get_where("users",array("id"=>$payment['employee_id']))->row_array();
									$addition = (((float)$payment['salary']) +((float)$payment['addition']));
									$deduction = (((float)$payment['deduction']) + ((float)$payment['loan_deduction']));
									$total = $addition - $deduction;
									$alltotal =$alltotal+$total;
							?>
								<tr>
									<td><?php echo $num; ?></td>
									<td><?php echo $emp['firstname']; ?> <?php echo $emp['lastname']; ?></td>
									<td><?php echo number_format($payment['salary'],2); ?></td>
									<td><?php echo number_format($payment['loan_deduction'],2); ?></td>
									<td><?php echo number_format($payment['addition'],2); ?></td>
									<td><?php echo number_format($payment['deduction'],2); ?></td>
									<td><?php echo number_format($total,2); ?></td>
								
								</tr>
							<?php
								$num++;
								}
							?>
						</tbody>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th align="center">Total</th>
								<th align="center"><span id="total"><?php echo number_format($alltotal,2) ?></span></th>
								
							</tr>
						 </table>
					  </div>
				</div>
						 