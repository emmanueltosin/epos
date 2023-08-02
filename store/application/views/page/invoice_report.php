<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Invoice Report List(s)
                 <div class="tools">
					<form method="post" class="form-horizontal" id="change_branch" action="">
									<?php
		?>
						<?php
						if(isset($_POST['to']) && isset($_POST['from'])){
						?>
							<div class="col-md-5">
							<label>From</label>
								<input value="<?php echo $_POST['from']  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-5">
								<label>To</label>
								<input type="text" value="<?php echo $_POST['to']  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
						<?php
						}else{
						?>
						<div class="col-md-5">
							<label>From</label>
								<input value="<?php echo date('Y').'-'.date('m').'-'.date('01')  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-5">
								<label>To</label>
								<input type="text" value="<?php echo date('Y').'-'.date('m').'-'.date('t')  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
								
						<?php
						}
						?>
							<div class="col-md-1"><label style="visibility: hidden;">To</label>
								<button class="btn btn-primary">Go</button>
								
							</div>
							
						</form>
						
				</div>
                </div>
				<div class="panel-body">
				<br/><br/><br/>
				 <table id="table3" class="table table-striped table-hover table-fw-widget">
		<thead>
				  <tr>
					 <th> Invoice ID </th>
				    <th> Customer </th>
					<th> Amount </th>
				    <th> Last Updated By </th>
				    <th> Payment ID </th>
					
					<th> Status </th>
					<th>VAT</th>
					<th>S.Charge</th>
					<th>Action</th>
				  </tr>
				</thead>
		<tbody>
					<?php
					$status = array(
								"1"=>'<div class="btn-group project-list-ad-bl"><button class="btn btn-success btn-xs">Paid</button></div>',
								"0"=>'<div class="btn-group project-list-ad-bl"><button class="btn btn-warning btn-xs">Pending</button></div>',
								);
								if(isset($_POST['from'])){
								$from = $_POST['from'];
								$to = $_POST['to'];
								}else{
								$from =date('Y').'-'.date('m').'-'.date('01') ;
								$to = date('Y').'-'.date('m').'-'.date('t');
								}
					
						$ins = $this->invoice->getInvoicesRange($from,$to);
						$alltotal =0;
						foreach($ins as $in){
						$customer = $this->settings->getCustomer($in['customer']);
						$user = $user =$this->users->get_user_by_id($in['last_modeified_user'],1);
						$alltotal +=$in['amount'];
					?>
						<tr>
							<td><?php echo $in['invoice_id'] ?></td>
							<td><?php echo $customer['firstname'] ?>  <?php echo $customer['lastname'] ?></td>
							<td><?php echo number_format($in['amount'],2); ?></td>
							<td><?php echo $user->username  ?></td>
							<td><?php echo $in['payment_id'] ?></td>
							
							<td><?php echo $status[$in['payment_status']]; ?></td>
							<td><?php echo $in['scharge'] ?>%</td>
							<td><?php echo $in['vat'] ?>%</td>
							<td><a href="<?php  echo base_url('dashboard/invoice/'.$in['invoice_id']) ?>" class="btn btn-success btn-sm">View Invoice</a></td>
						</tr>
					<?php
						}
					?>
				</tbody>
				<tfoot>
					<tr>
					<th></th>
				    <th>Total</th>
					<th><?php echo number_format($alltotal,2) ?></th>
				    <th></th>
				    <th></th>
					<th></th>
					<th></th>
					<th></th>
				  </tr>
				</tfoot>
							</table>
				</div>
	
</div>
</div>