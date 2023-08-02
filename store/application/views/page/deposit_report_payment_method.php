<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Deposits Report</div>
				<div class="tab-container">
                  <ul class="nav nav-tabs">
                  	<li ><a href="<?php  echo base_url('dashboard/deposit_report') ?>">General Report</a></li>
					<li><a href="<?php  echo base_url('dashboard/deposit_report_customer') ?>">Rep By Customer</a></li>
					<li  ><a href="<?php  echo base_url('dashboard/deposit_report_sales_rep') ?>">Rep By Sales Rep</a></li>
					<li class="active"><a href="<?php  echo base_url('dashboard/deposit_report_payment_method') ?>">Rep Payment Method</a></li>
                   </ul>
				    <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
					<div class="col-lg-12">
					<div class="panel panel-default panel-table">
                <div class="panel-heading">Deposit Report By Payment Method
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
								<label>Payment Method</label>
								<select name="customer_id" class="form-control select2_demo_2 input-sm" id="customer_id">
								<option class="bs-title-option" value="">Select</option>
								<?php
									$stocks = $this->db->get("payment_method")->result_array();
									foreach($stocks as $stock){
								?>
									<option <?php echo ($stock['SN']==$_POST['customer_id'] ? 'selected' : '') ?> value="<?php echo $stock['SN'] ?>"><?php echo $stock['payment_method'] ?></option>
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
								<label>Payment Method</label>
								<select name="customer_id" class="form-control select2_demo_2 input-sm" id="customer_id">
								<option class="bs-title-option" value="">Select</option>
								<?php
									$stocks = $this->db->get("payment_method")->result_array();
									foreach($stocks as $stock){
								?>
									<option  value="<?php echo $stock['SN'] ?>"><?php echo $stock['payment_method'] ?></option>
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
					<th>Deposit ID</th>
					<th>Customer</th>
					<th>Receipt ID</th>
				    <th>Total Amount Deposited</th>
				    <th>Date</th>
					
					<th>Sales Rep</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
					<?php
					
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
					
					
							$deposits = $this->stock->getFullDepositRange($from,$to,array('sales_rep'=>$customer_id));
					foreach($deposits as $deposit){
					?>
						<tr>
							<td><?php echo $deposit['deposit_id'] ?></td>
							<td><?php $customer = $this->settings->getCustomer($deposit['customer_id']); echo $customer['firstname'].' '.$customer['lastname'] ?></td>
							<td><?php echo $deposit['reciept_id'] ?></td>
							<td><?php echo $this->stock->getTotalAmountDeposited($deposit['SN'],true); ?></td>
							<td><?php echo $deposit['date_added'] ?></td>
							
							<td><?php echo $this->db->get_where('users',array("id"=>$deposit['sales_rep']))->result_array()[0]['username'] ?></td>
							<td>
								 <div class="btn-group btn-sm">
												<div class="dropdown">
												  <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
												  <span class="caret"></span></button>
												  <ul class="dropdown-menu">
												  <li><a href="<?php  echo base_url('dashboard/view_deposit/'.$deposit['SN']) ?>">View Deposit</a></li>
												  <!--
													<li><a onclick="window.open($(this).attr('href'),'width=400;hieght=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_deposit_recipt/'.$deposit['SN']) ?>/Thermal">Thermal Receipt</a></li>
													<li><a onclick="window.open($(this).attr('href'),'width=400;hieght=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_deposit_recipt/'.$deposit['SN']) ?>/Medium">Medium Receipt</a></li>
													<li><a onclick="window.open($(this).attr('href'),'width=400;hieght=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_deposit_recipt/'.$deposit['SN']) ?>/Big">Big Receipt</a></li>
													-->												 
												 </ul>
												</div>
								</div>
							</td>
						</tr>
					<?php
						}
					?>
				</tbody>
			</table>
				</div>
	
</div>
				  
				  
				</div>
		</div>
	</div>
</div>