<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Returned Merchandise List(s)
                 <div class="tools">
					 <a href="<?php echo base_url('dashboard/newrma')  ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> New Return Merchandise</a>
				 </div>
                </div>
				<div class="panel-body">
					<div class="panel-body">
				
				 <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
					  <th>#</th>
					  <th>RMA ID</th>
					  <th>Product</th>
					  <th>Branch</th>
					  <th>Staff</th>
					  <th>Customer</th>
					  <th>Status</th>
					  <th>Action</th>
					  <th>Command</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					$rmas = $this->stock->getRMAs();
					$num = 1;
					foreach($rmas as $rma){
						
						$array = array(
										'0'=>'<span class="label label-warning">Pending</span>',
										'1'=>'<span class="label label-success">Completed</span>'
									);
						$array_operation = array(
												'1'=>'<span class="label label-primary">Femtechit Engineer</span>',
												'2'=>'<span class="label label-success">Warranty Engineer</span>',
												'0'=>''
												);
							$array_operation2 = array(
												'1'=>'Femtechit Engineer',
												'2'=>'Warranty Engineer',
												'0'=>''
												);
						$br = $this->stock->getBranch($rma['branch']);
					?>
						<tr>
							<td><?php echo $num ?></td>
							<td><?php echo $rma['rma_id'] ?></td>
							<td><?php echo $rma['product_name'] ?></td>
							<td><?php echo $br['branch_name'] ?></td>
							<td><?php echo $rma['testing_staff'] ?></td>
							<td><?php echo $rma['customer_name'] ?></td>
							<td><?php echo $array[$rma['status']] ?></td>
							<td><?php echo $array_operation[$rma['data']['rma_action']]; ?></td>
							<td>
							<?php
							if(!empty($array_operation[$rma['data']['rma_action']])){
							?>
							<a href="<?php echo base_url('dashboard/perform_rma_action/'.$rma['rma_id'].'/'.$rma['data']['rma_action']) ?>" class="btn btn-success btn-sm"><?php echo $array_operation2[$rma['data']['rma_action']]; ?></a>
							<?php
							}else{
							?>
							<div class="btn-group btn-space">
							<button type="button" class="btn btn-default">Set Action</button>
							<button type="button" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span></button>
							<ul role="menu" class="dropdown-menu">
							  <li><a href="<?php echo base_url('dashboard/perform_rma_action/'.$rma['rma_id'].'/1') ?>">Send to an Engineer</a></li>
							  <li><a href="<?php echo base_url('dashboard/perform_rma_action/'.$rma['rma_id'].'/2') ?>">Replaced for the Customer</a></li>
							</ul>
						  </div>
						  <?php
							}
						  ?>
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