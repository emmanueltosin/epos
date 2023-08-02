<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Supplier Invoice List(s)
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
					  <th>#</th>
					  <th>Invoice ID</th>
					  <th>Invoice Date</th>
					  <th>Supplier</th>
					  <th>Total Invoice Amount</th>
					  <th>Amount Paid</th>
					  <th>Status</th>
					  <th>Command</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					if(isset($_POST['from'])){
				$from = $_POST['from'];
				$to = $_POST['to'];
				}else{
				$from =date('Y').'-'.date('m').'-'.date('01') ;
				$to = date('Y').'-'.date('m').'-'.date('t');
				}
						$num=1;
						$array = array(
										'Pending'=>'<span class="label label-danger">Pending</span>',
										'Complete'=>'<span class="label label-success">Complete</span>'
									);
						$recievers = $this->stock->getSupplierInvoiceBetween($from,$to);
						foreach($recievers as $transfer){		
						
					?>
						<tr>
							<td><?php  echo $num ?></td>
							<td><?php  echo $transfer['supplier_id'] ?></td>
							<td><?php  echo $transfer['recieved_date'] ?></td>					
							<td><?php
								$supp = $this->stock->getSupplier($transfer['supplier']);
								echo $supp['supplier_name'];
								?></td>
							<td><?php  echo number_format($transfer['total_invoice_amount'],2); ?></td>
							<td><?php  echo $this->stock->getInvoiceAmountpaid($transfer['SN'],TRUE) ?></td>
							<td><?php  echo $array[$transfer['status']]; ?></td>
							<td><a href="<?php echo base_url('dashboard/view_invoice/'.$transfer['supplier_id']) ?>" class="btn btn-sm btn-primary">View Invoice</a></td>
						</tr>
					<?php
						$num++;
						}
					?>
					</tbody>
				</table>
				</div>
	
</div>
</div>