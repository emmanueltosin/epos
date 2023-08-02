<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Stock Transferred List(s)
                 <div class="tools">
				 <a href="<?php  echo base_url('dashboard/new_transfer') ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> New Stock Transfer</a>
				 </div>
                </div>
				<div class="panel-body">
				 <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
					  <th>#</th>
					  <th>Transfer ID</th>
					  <th>Transfer Date</th>
					  <th>Branch</th>
					  <th>Transfer User</th>
					  <th>Receiver</th>
					  <th>Command</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$num=1;
						$array = array(
										'0'=>'<span class="label label-danger">Disabled</span>',
										'1'=>'<span class="label label-success">Enabled</span>'
									);
						$transfers = $this->stock->getStocktransfers();
						foreach($transfers as $transfer){
							
							
							$user = $this->users->get_user_by_id($transfer['transfer_user'],1);
					?>
						<tr>
							<td><?php  echo $num ?></td>
							<td><?php  echo $transfer['transfer_id'] ?></td>
							<td><?php  echo $transfer['transfer_date'] ?></td>
							<td><?php
										$br = $this->stock->getBranch($transfer['branch']);
										
									?><?php echo $br['branch_name']  ?></td>
							<td><?php  echo $user->username ?></td>
							<td><?php  echo $transfer['reciever_userfullname'] ?></td>
							<td><a href="<?php echo base_url('dashboard/viewtransfer/'.$transfer['transfer_id']) ?>" class="btn btn-sm btn-primary">View Transfer</a></td>
						</tr>
					<?php
						$num++;
						}
					?>
					</tbody>
				</table>
				</div>
	
</div>
</div>