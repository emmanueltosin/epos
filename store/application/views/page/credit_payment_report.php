<div class="row">
	<div class="col-sm-12">
		
<div class="panel panel-default panel-table">
                <div class="panel-heading">Credit Report List(s)
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
				 <table id="table3" class="table table-striped table-hover table-fw-widget" style="font-size:12px;">
				<thead>
					<tr>
						<th>#</th>
						<th>Credit ID</th>
						<th>Reciept ID</th>
						<th>Customer</th>
						<th>Date</th>
						<th>Amount Paid</th>
						<th>Sales Rep</th>
						<th>Payment Method</th>
						<th>Action</th>
					</tr>
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
								$this->db->from("credit_payment_history");
								$this->db->where("date_added BETWEEN '$from' AND '$to'");
								$this->db->order_by("sn","DESC");								
								$report = $this->db->get()->result_array();
								$sn = 1;
								$tt =0;
								foreach($report as $rep){
								if(is_numeric($rep['customer_id'])){
						$customer = $this->settings->getCustomer($rep['customer_id']);
						$customer = $customer['firstname'].' '.$customer['lastname'];
						}else{
							$customer = $in['customer'];
						}
						$user =$this->users->get_user_by_id($rep['sales_rep'],1);
						$p = $this->db->get_where("payment_method",array("SN"=>$rep['payment_method']))->row_array();
						$tt+=$rep['amount'];
						?>
							<tr>
								<td><?php echo $sn ?></td>
								<td><?php echo $rep['credit_id'] ?></td>
								<td><?php echo $rep['reciept_id'] ?></td>
								<td><?php echo $customer; ?></td>
								<td><?php echo $rep['date_added'] ?></td>
								<td><?php echo number_format($rep['amount'],2) ?></td>
								<td><?php echo $user->username ?></td>
								<td><?php echo $p['payment_method'] ?></td>
								<td>
									<a href="<?php  echo base_url('dashboard/view_credit/'.$rep['credit_id']) ?>" class="btn btn-primary btn-sm">View Credit Details</a>
								</td>
							</tr>	
						<?php
							$sn++;
								}
						?>
				<tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><?php echo number_format($tt,2) ?></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
				</table>
</div>	</div></div>	</div>