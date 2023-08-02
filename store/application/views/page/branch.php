<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Application Settings</div>
                <div class="tab-container">
                  <ul class="nav nav-tabs">
                    <li><a href="<?php  echo base_url('dashboard/user_manager') ?>">User Management</a></li>
                    <li ><a href="<?php  echo base_url('dashboard/manufacturer') ?>" >Manufacturer</a></li>
					<li class="active"><a href="<?php  echo base_url('dashboard/branch') ?>">Branch</a></li>
					<li><a href="<?php  echo base_url('dashboard/extra_charges') ?>">Store Settings</a></li>
					<li><a href="<?php  echo base_url('dashboard/payment_method') ?>">Payment Method</a></li>
                  </ul>
				  <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
						<div class="col-lg-8">
							<div class="panel">
								<div class="panel panel-heading">Branch List(s)</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>SN</th>
												<th>Branch</th>
												<th>Address</th>
												<td>Action</td>
											</tr>
										</thead>
										<tbody>
											<?php
												$num = 1;
												$supps =$this->stock->getBranches();
												foreach($supps as $supp){
											?>
												<tr>
													<td><?php echo $num; ?></td>
													<td><?php echo $supp['branch_name'] ?></td>
													<td><?php echo $supp['branch_address'] ?></td>
													<td><a href="<?php echo base_url('dashboard/branch/'.$supp['SN'].'?del=true') ?>" class="btn btn-danger">Delete</a></td>
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
						
						<div class="col-lg-4">
						<div class="panel">
								<div class="panel panel-heading">Add New Branch</div>
								<div class="panel-body">
						<form action=""  method="post">
						
							<div class="form-group xs-pt-10">
							<br/>
							  <label for="branch_name" class="col-sm-12 control-label">Branch name</label>
							  <div class="col-sm-12">
								<input id="branch_name" required type="text" name="branch_name" placeholder="Branch name" class="form-control input-sm">
							  </div>
							</div>
							
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="branch_address" class="col-sm-12 control-label">Branch Address</label>
							  <div class="col-sm-12">
								<input id="branch_address" type="text" name="branch_address" placeholder="Branch Address" class="form-control input-sm">
							  </div>
							</div>
							
					
							
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Add Branch</button>
							</div>

						</form>
						
						</div>
							</div>
						</div>
					</div>
                  </div>
                </div>
              </div>
		
	</div>
