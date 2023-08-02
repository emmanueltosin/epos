<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Invoice Report</div>
				<div class="tab-container">
                  <ul class="nav nav-tabs">
                   <li><a href="<?php  echo base_url('dashboard/invoice_report') ?>">Invoice Report</a></li>
					<li><a href="<?php  echo base_url('dashboard/invoice_report_customer') ?>">Invoice Rep By Customer</a></li>
					<li  class="active"><a href="<?php  echo base_url('dashboard/invoice_report_sales_rep') ?>">Invoice Rep By Sales Rep</a></li>
                   </ul>
				    <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
					<div class="col-lg-12">
					<div class="panel panel-default panel-table">
                <div class="panel-heading">Invoice Report By Sales Rep
                 <div class="tools">
					<form method="post" class="form-horizontal" id="change_branch" action="">
						<?php
						if(isset($_POST['to']) && isset($_POST['from'])){
						?>
							<div class="col-md-3">
							<label>From</label>
								<input value="<?php echo $_POST['from']  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-3">
								<label>To</label>
								<input type="text" value="<?php echo $_POST['to']  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
							<div class="col-md-4">
								<label>Sales Rep</label>
								<select name="customer_id" class="form-control select2_demo_2 input-sm" id="customer_id">
								<option class="bs-title-option" value="">Select Sales Rep</option>
								<?php
									$stocks = $this->db->from("users")->where("role !=","Superuser")->get()->result_array();
									foreach($stocks as $stock){
								?>
									<option <?php echo ($stock['id']==$_POST['customer_id'] ? 'selected' : '') ?> value="<?php echo $stock['id'] ?>"><?php echo $stock['username'] ?></option>
								<?php
									}
								?>
								</select>
							</div>
						<?php
						}else{
						?>
						<div class="col-md-3">
							<label>From</label>
								<input value="<?php echo date('Y').'-'.date('m').'-'.date('01')  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-3">
								<label>To</label>
								<input type="text" value="<?php echo date('Y').'-'.date('m').'-'.date('t')  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
							<div class="col-md-4">
								<label>Sales Rep</label>
								<select name="customer_id" class="form-control select2_demo_2 input-sm" id="customer_id">
								<option class="bs-title-option" value="">Select Sales Rep</option>
								<?php
									$stocks = $this->db->from("users")->where("role !=","Superuser")->get()->result_array();
									foreach($stocks as $stock){
								?>
									<option  value="<?php echo $stock['id'] ?>"><?php echo $stock['username'] ?></option>
								<?php
									}
								?>
								</select>
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
								$customer_id = $_POST['customer_id'];
								}else{
									
								$from =date('Y').'-'.date('m').'-'.date('01') ;
								$to = date('Y').'-'.date('m').'-'.date('t');
								if(!isset($customers[0])){
								$customer_id = 0;	
								}else{
								$customer_id = $customers[0]['SN'];
								}
								}
					
						$ins = $this->invoice->getInvoiceRange($from,$to,array('user_created'=>$customer_id));;
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
		</div>
	</div>
</div>