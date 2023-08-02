<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
							 <?php
if($this->users->get_user_by_username($this->session->userdata("username"))->role!="Sales Representative"){
 ?>	
                <div class="panel-heading">Credit Report</div>
<?php
}
?>				
				<div class="tab-container">
							 <?php
if($this->users->get_user_by_username($this->session->userdata("username"))->role!="Sales Representative"){
 ?>	                  
				  <ul class="nav nav-tabs">
                      <li><a href="<?php  echo base_url('dashboard/credit_reports') ?>">General Credit Report</a></li>
					<li ><a href="<?php  echo base_url('dashboard/credit_report_customer') ?>">Rep By Customer</a></li>
					<li class="active"><a href="<?php  echo base_url('dashboard/credit_report_sales_rep') ?>">Rep By Sales Rep</a></li>
                 </ul>
<?php
}
?>				 
				    <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
					<div class="col-lg-12">
					<div class="panel panel-default panel-table">
                <div class="panel-heading">Credit Report By Sales Rep
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
												 <?php
if($this->users->get_user_by_username($this->session->userdata("username"))->role!="Sales Representative"){
 ?>	
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
$stocks = array(array('id'=>$this->users->get_user_by_username($this->session->userdata("username"))->SN));
?>
<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $this->users->get_user_by_username($this->session->userdata("username"))->SN; ?>" />
<?php
}
?>	
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
												 <?php
if($this->users->get_user_by_username($this->session->userdata("username"))->role!="Sales Representative"){
 ?>								
							
							<div class="col-md-4">
								<label>Sales Rep</label>
								<select name="customer_id" class="form-control select2_demo_2 input-sm" id="customer_id">
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
}else{
$stocks = array(array('id'=>$this->users->get_user_by_username($this->session->userdata("username"))->SN));
?>
<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $this->users->get_user_by_username($this->session->userdata("username"))->SN; ?>" />
<?php
}
?>								

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
				 <table id="table3" class="table table-striped table-hover table-fw-widget" style="font-size:12px;">
				<thead>
				  <tr>
					  <th  > Credit ID </th>
					  <th > Customer </th>
				    <th > Sub Total </th>
					<th > Total Amount </th>
				    <th > Discount </th>
				    <th > Date </th>
					<th > Sales Rep </th>
					<th>VAT</th>
					<th>S.Charge</th>
					<th>Total Paid</th>
					<th > Balance </th>
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
								$customer_id = $_POST['customer_id'];
								}else{
									
								$from =date('Y').'-'.date('m').'-'.date('01') ;
								$to = date('Y').'-'.date('m').'-'.date('t');
								$customer_id = $stocks [0]['id'];
								}
				
					
						$ins = $this->stock->getCreditRange($from,$to,array('user_id'=>$customer_id));
						$alltotal =0;
						$alldiscount =0;
						$allvat = 0;
						$allscharge = 0;
						$alltotalpaid =0;
						$allttp =0;
						$allbalp=0;
					foreach($ins as $in){
						if(is_numeric($in['customer'])){
						$customer = $this->settings->getCustomer($in['customer']);
						$customer = $customer['firstname'].' '.$customer['lastname'];
						}else{
							$customer = $in['customer'];
						}
						$alltotal +=$in['total_amount'];
						$alldiscount +=$in['discount'];
						$allvat +=$in['vat_amount'];
						$allscharge+=$in['s_charge_amt'];
						$alltotalpaid += $in['total_amount_paid'];
						$allttp = $this->stock->getTotalAmountCreditPaid($in['SN'],false);
						$allbalp = 	($in['total_amount_paid'] - $this->stock->getTotalAmountCreditPaid($in['SN'],false));					
						$user =$this->users->get_user_by_id($in['user_id'],1);
					?>
						<tr>
							<td><?php echo $in['credit_id'] ?></td>
							<td><?php echo $customer ?></td>
							<td><?php echo number_format($in['total_amount'],2); ?></td>
							<td><?php echo number_format($in['total_amount_paid'],2) ?></td>
							<td><?php echo number_format($in['discount'],2); ?></td>
							<td><?php echo $in['date'] ?></td>
							<td><?php echo $user->username; ?></td>
							<td><?php echo number_format($in['s_charge_amt'],2) ?></td>
							<td><?php echo number_format($in['vat_amount'],2) ?></td>
							<td><?php echo $this->stock->getTotalAmountCreditPaid($in['SN'],true) ?></td>
							<td><?php echo number_format(($in['total_amount_paid'] - $this->stock->getTotalAmountCreditPaid($in['SN'],false)),2) ?></td>						
							<td>
						
											<div class="dropdown">
												  <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
												  <span class="caret"></span></button>
												  <ul class="dropdown-menu">
												  <li><a href="<?php  echo base_url('dashboard/view_credit/'.$in['credit_id']) ?>">View</a></li>
													<li><a onclick="window.open($(this).attr('href'),'width=400;hieght=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_credit_recipt/'.$in['credit_id']) ?>/Thermal">Thermal Receipt</a></li>
													<li><a onclick="window.open($(this).attr('href'),'width=400;hieght=400;','400','400'); return false;" href="<?php  echo base_url('dashboard/print_credit_recipt/'.$in['credit_id']) ?>/Big">Big Receipt</a></li>
												  </ul>
												</div>
							</td>
							
						</tr>
					<?php
						}
					?>
				</tbody>
				<tfoot>
					<tr>
					<th></th>
				    <th></th>
					<th><?php echo number_format($alltotal,2) ?></th>
					<th><?php echo number_format($alltotalpaid,2) ?></th>
				    <th><?php echo number_format($alldiscount,2) ?></th>
					<th></th><th></th>
					<th><?php echo number_format($allvat,2) ?></th>
					<th><?php echo number_format($allscharge,2) ?></th>
					<th><?php echo number_format($allttp,2) ?></th>
					<th><?php echo number_format($allbalp,2) ?></th>
					<th></th>
				  </tr>
				</tfoot>
			</table>
</div>	</div>	</div>	</div>			