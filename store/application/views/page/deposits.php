<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Todays Deposit List(s)
					<div class="tools">
						<a href="<?php echo base_url('dashboard/add_deposit') ?>" class="btn btn-primary btn-sm">Add New Deposit</a>
					</div>
                </div>
<div class="panel-body">
 <table id="table3" class="table table-striped table-hover table-fw-widget" style="font-size:12px;">
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
						$deposits =$this->stock->getDepositRange(date('Y-m-d'),date('Y-m-d'));
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
				<tfoot>
					<tr>
					<th></th>
					<th></th>
				    <th></th>
				    <th></th>
				    <th></th>
					<th></th>
				  </tr>
				</tfoot>
			</table>
</div>	</div>	</div>	</div>			