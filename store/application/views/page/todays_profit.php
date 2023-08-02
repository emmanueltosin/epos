<div class="row">
<div class="col-sm-12">
	<?php
	$from = date('Y-m-d');
	$to = date('Y-m-d');
	$ins = $this->stock->getSalesRange(date('Y-m-d'),date("Y-m-d"),array("status"=>"COMPLETE"));
				$total_profit = 0;
				$total_vat = 0;
				$total_s_charge = 0;
				$total_discount = 0;
				$total_cost = 0;
				
				foreach($ins as $in){
					$total_discount+=$in['discount'];
					$total_profit +=$in['total_amount_paid'];
					$total_vat += $in['vat_amount'];
					$total_s_charge +=	$in['s_charge_amt'];
					
					$items = json_decode($in['items'],true);
					
					foreach($items as $item){
						$total_cost+=($item['cost_price']*$item['item_qty']);
					}
					
				}

				//expense
				$total_expenses = 0;
				$expense = $this->db->from("tbl_expenses")->where("expense_date BETWEEN '$from' AND '$to'")->get()->result_array();
				foreach($expense as $exp){
					$total_expenses+=$exp['expense_total_amount'];
				}
	?>
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Today's Profits and Expenses Report
                 
                </div>
				<div class="panel-body">
				<div class="container">
				<br/><br/>

<div class="container">
					<br/><br/><br/><br/><br/>
					
				
							<div class="row">
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total Selling Price</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_profit,2) ?></h2>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total VAT</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_vat,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-3" style="display: none;">
								<div class="well">
								<h3 align="center">Total Service Charge</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_s_charge,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Net Revenue</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php $tt_in = $total_profit+$total_vat+$total_s_charge;   echo number_format(($total_profit+$total_vat+$total_s_charge),2); ?></h2>
								</div>
							</div>
					</div>
					<br/>
				
							<div class="row">
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total Cost</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_cost,2) ?></h2>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total Expenses</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_expenses,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total Discount</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_discount,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Net Cost</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php $tt_cost=$total_discount+$total_expenses+$total_cost;  echo number_format(($total_discount+$total_expenses+$total_cost),2); ?></h2>
								</div>
							</div>
					</div>
				
				<br/>
					<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<div class="well">
								<h3 align="center">Profit</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format(($tt_in - $tt_cost),2); ?></h2>
								</div>
					</div>
					<div class="col-sm-3"></div>
					</div>
				</div>				
				
				</div>
				</div>
				</div>
	
</div>
</div>