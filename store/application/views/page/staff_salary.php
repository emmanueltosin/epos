<div class="row">
<div class="col-sm-12">
	 <div class="panel panel-default panel-table">
                <div class="panel-heading"> Staff Salary Payment List(s)
					<div class="tools">
						<a href="<?php echo base_url('dashboard/new_salary_payment') ?>" class="btn btn-primary btn-sm">New Salary Payment</a>
					</div>
                </div>
<div class="panel-body">
		<table class="table" id="table3">
                        <thead>
                            <tr>
								<th>#</th>
                                <th>Payment ID</th>
								<th>Type</th>
                                <th>Date</th>
								<th>No. Of Staff</th>
								<th>Total</th>
								<th>Payment Date</th>
								<th>Status</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php 
								$num=1;
								$payments = $this->stock->getpaymentgenerated();
								$array = array(
												'0'=>'Pending',
												'1'=>'Paid'
											);
								foreach($payments as $payment){
							?>
								<tr>
									<td><?php echo $num; ?></td>
									<td><?php echo $payment['payment_id']; ?></td>
									<td><?php echo $payment['type']; ?></td>
									<td><?php echo $payment['month']; ?>,<?php echo $payment['year']; ?></td>
									<td align="center"><?php echo $payment['total_staff']; ?></td>
									<td><?php echo number_format($payment['total_pay'],2); ?></td>
									<td><?php echo ($payment['pay_date']=='0000-00-00' ? '' :$payment['pay_date']); ?></td>
									<td><?php echo $array[$payment['status']]; ?></td>
									<td> <a href="<?php echo base_url('dashboard/view_history_salary/'.$payment['SN']); ?>" class="btn btn-info btn-sm">View Payment</a>
                                        <?php if($payment['status']=="0"){  ?>
										<a href="<?php echo base_url('dashboard/delete_gen_pay_salary/'.$payment['SN']); ?>" class="btn btn-danger btn-sm">Delete</a>
										<?php } ?>
										<a onclick="window.open($(this).attr('href'),'width=400;hieght=400;','400','400'); return false" href="<?php echo base_url('dashboard/print_payment_slip/'.$payment['SN']); ?>" class="btn btn-success btn-sm">Print Slip</a>
										
									</td>
									
								</tr>
							<?php
							$num++;
								}
							?>
						</tbody>

			</table>
</div>	</div>	</div>	</div>	