<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Sales Report</div>
				<div class="tab-container">
                  <ul class="nav nav-tabs">
					<li class="active"><a href="<?php  echo base_url('dashboard/sales_report') ?>">General Report</a></li>
					<li ><a href="<?php  echo base_url('dashboard/report_customer') ?>">Rep By Customer</a></li>
					<li><a href="<?php  echo base_url('dashboard/report_sales_rep') ?>">Rep By Sales Rep</a></li>
                    <li ><a href="<?php  echo base_url('dashboard/report_stock') ?>" >Rep By Product/Stock</a></li>
					<li><a href="<?php  echo base_url('dashboard/report_payment_method') ?>">Rep Payment Method</a></li>
					<li><a href="<?php  echo base_url('dashboard/bulk_report') ?>">Bulk Rep By Product/Stock</a></li>
                  </ul>
				    <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
					<div class="col-lg-12">
					<div class="panel panel-default panel-table">
                <div class="panel-heading">Sales Report List(s)
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
					 <th  > Reciept ID </th>
					  <th > Customer </th>
				    <th > Total Amount </th>
				    <th > Discount </th>
				    <th > Date </th>
					
					<th > Sales Rep </th>
					<th > Method</th>
					<th>VAT</th>
					<th>S.Charge</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
					<?php
					$status = array(
								"1"=>'<div class="btn-group project-list-ad-bl"><button class="btn btn-success btn-xs">Paid</button></div>',
								"0"=>'<div class="btn-group project-list-ad-bl"><button class="btn btn-white btn-xs">Pending</button></div>',
								);
							if(isset($_POST['from'])){
								$from = $_POST['from'];
								$to = $_POST['to'];
								}else{
								$from =date('Y').'-'.date('m').'-'.date('01') ;
								$to = date('Y').'-'.date('m').'-'.date('t');
								}
					
					
						$ins = $this->stock->getSalesRange($from,$to);
						$alltotal =0;
						$alldiscount =0;
						foreach($ins as $in){
						if(is_numeric($in['customer'])){
						$customer = $this->settings->getCustomer($in['customer']);
						$customer = $customer['firstname'].' '.$customer['lastname'];
						}else{
							$customer = $in['customer'];
						}
						$alltotal +=$in['total_amount'];
						$alldiscount +=$in['discount'];
						$user =$this->users->get_user_by_id($in['user_id'],1);
						$in['payment_method'] = $this->db->get_where('payment_method',array('SN'=>$in['payment_method']))->result_array()[0]['payment_method'];
					?>
						<tr>
							<td><?php echo $in['reciept_id'] ?></td>
							<td><?php echo $customer ?></td>
							<td><?php echo number_format($in['total_amount'],2); ?></td>
							<td><?php echo number_format($in['discount'],2); ?></td>
							<td><?php echo $in['date'] ?></td>
							<td><?php echo $user->username; ?></td>
							<td><?php echo $in['payment_method'] ?></td>
							<td><?php echo $in['scharge'] ?>%</td>
							<td><?php echo $in['vat'] ?>%</td>
							<?php if($in['payment_type']=="Direct"){  ?>
							<td><a onclick="window.open($(this).attr('href'),'width=400;hieght=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_recipt/'.$in['reciept_id']) ?>" class="btn btn-success btn-sm">Print</a></td>
							<?php  }else{ ?>
							<td><a href="<?php  echo base_url('dashboard/invoice/'.$in['reciept_id']) ?>" class="btn btn-success btn-sm">View Invoice</a></td>
							<?php  } ?>
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
				    <th>Discount</th>
				    <th><?php echo number_format($alldiscount,2) ?></th>
					<th></th>
					<th></th><th></th>
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