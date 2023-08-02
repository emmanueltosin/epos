<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Due Payment List(s)
					<div class="tools">
					</div>
                </div>
<div class="panel-body">
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
						
						$today = date("Y-m-d");
						$customer = $this->db->from("tbl_customers")->get()->result_array();
						foreach($customer as $cus){
						$ins = $this->db->get_where("tbl_credit_sales",array("customer"=>$cus['SN'],"status"=>"PENDING"))->result_array();
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
						}
					?>
				</tbody>
				<tfoot>
					<tr>
					<th></th>
				    <th></th>
					<th><?php echo number_format(@$alltotal,2) ?></th>
					<th><?php echo number_format(@$alltotalpaid,2) ?></th>
				    <th><?php echo number_format(@$alldiscount,2) ?></th>
					<th></th><th></th>
					<th><?php echo number_format(@$allvat,2) ?></th>
					<th><?php echo number_format(@$allscharge,2) ?></th>
					<th><?php echo number_format(@$allttp,2) ?></th>
					<th><?php echo number_format(@$allbalp,2) ?></th>
					<th></th>
				  </tr>
				</tfoot>
			</table>
</div>	</div>	</div>	</div>			