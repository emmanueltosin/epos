<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Total Income Report
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
				<?php
				if(isset($_POST['from'])){
								$from = $_POST['from'];
								$to = $_POST['to'];
								}else{
								$from =date('Y').'-'.date('m').'-'.date('01') ;
								$to = date('Y').'-'.date('m').'-'.date('t');
								}
				$ins = $this->stock->getSalesRange($from,$to,array("status"=>"COMPLETE"));
				$total_profit = 0;
				$total_expenses = 0;
				$total_discount =0;
				$total_expense =0;
				
				foreach($ins as $in){
					$total_discount+=$in['discount'];
					$total_profit +=$in['total_amount_paid'];
				}
				
				//expense
				$credit_payment = 0;
				$expense = $this->db->from("credit_payment_history")->where("date_added BETWEEN '$from' AND '$to'")->get()->result_array();
				foreach($expense as $exp){
					$credit_payment+=$exp['amount'];
				}
				
				
					$deposit_payment = 0;

				$deposit = $this->db->from("deposit_payment_history")->where("date_added BETWEEN '$from' AND '$to'")->get()->result_array();
				foreach($deposit as $exp){
					$check_depsit_usage = $this->db->get_where("deposit",array("deposit_id"=>$exp['deposit_id']))->row_array();
					if($check_depsit_usage['deposit_status']!="USED" && $check_depsit_usage['deposit_status']!="REFUND"){
						$deposit_payment+=$exp['amount'];
					}
				}
				
				
				
				$total_expenses = 0;
				$expense = $this->db->from("tbl_expenses")->where("expense_date BETWEEN '$from' AND '$to'")->get()->result_array();
				foreach($expense as $exp){
					$total_expenses+=$exp['expense_total_amount'];
				}
				
				?>

			
				
				</div>
                </div>
				<div class="panel-body">
				<div class="container-fluid">
					<br/><br/><br/><br/><br/>
					
					<h4>Income Report</h4>
							<div class="row">
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Sales Payment</h3>
								<h2 align="center" style="font-weight:bolder;font-size:18px; height:60px;" ><?php  echo number_format($total_profit,2) ?></h2>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Credit Payment</h3>
								<h2 align="center" style="font-weight:bolder;font-size:18px; height:60px;" ><?php  echo number_format($credit_payment,2); ?></h2>
								</div>
							</div>
								<div class="col-sm-3" style="visibility: hidden">
								<div class="well">
								<h3 align="center">Deposit Payment</h3>
								<h2 align="center" style="font-weight:bolder;font-size:18px; height:60px;" ><?php  echo number_format($deposit_payment,2); ?></h2>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Net Income</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format(($credit_payment+$deposit_payment+$total_profit),2); ?></h2>
								</div>
							</div>
					</div>
					<br/>
				
						<h4>Expenses Report</h4>
							<div class="row">
							<div class="col-sm-4">
								<div class="well">
								<h3 align="center">Total Expenses</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_expenses,2) ?></h2>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="well">
								<h3 align="center">Total Discount</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_discount,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="well">
								<h3 align="center">Net Expenses</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format(($total_discount+$total_expenses),2); ?></h2>
								</div>
							</div>
					</div>
				
				<br/>
					<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<div class="well">
								<h3 align="center">Gross Income</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format((($credit_payment+$deposit_payment+$total_profit)-($total_discount+$total_expenses)),2); ?></h2>
								</div>
					</div>
					<div class="col-sm-3"></div>
					</div>
				</div>
				</div>
	
</div>
</div>