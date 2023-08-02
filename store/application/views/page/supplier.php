<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Application Settings</div>
                <div class="tab-container">
				  <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
						<div class="col-lg-8">
							<div class="panel">
								<div class="panel panel-heading">Supplier List(s)</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>SN</th>
												<th>Supplier</th>
												<th>Address</th>
												<th>Email</th>
												<th>Phone Number</th>
												<td>Action</td>
											</tr>
										</thead>
										<tbody>
											<?php
												$num = 1;
												$supps =$this->stock->getSuppliers();
												foreach($supps as $supp){
											?>
												<tr>
													<td><?php echo $num; ?></td>
													<td><?php echo $supp['supplier_name'] ?></td>
													<td><?php echo $supp['supplier_address'] ?></td>
													<td><?php echo $supp['supplier_email'] ?></td>
													<td><?php echo $supp['supplier_phone_number'] ?></td>
													<td><a href="<?php echo base_url('dashboard/supplier/'.$supp['SN'].'?del=true') ?>" class="btn btn-danger">Delete</a></td>
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
								<div class="panel panel-heading">Add New Supplier</div>
								<div class="panel-body">
						<form action=""  method="post">
						
							<div class="form-group xs-pt-10">
							<br/>
							  <label for="supplier_name" class="col-sm-12 control-label">Supplier name</label>
							  <div class="col-sm-12">
								<input id="supplier_name" required type="text" name="supplier_name" placeholder="Supplier name" class="form-control input-sm">
							  </div>
							</div>
							
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="supplier_address" class="col-sm-12 control-label">Supplier Address</label>
							  <div class="col-sm-12">
								<input id="supplier_address" type="text" name="supplier_address" placeholder="Supplier Address" class="form-control input-sm">
							  </div>
							</div>
							
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="supplier_email" class="col-sm-12 control-label">Supplier Email</label>
							  <div class="col-sm-12">
								<input id="supplier_email" type="text" name="supplier_email" placeholder="Supplier Email" class="form-control input-sm">
							  </div>
							</div>
							
							<div class="form-group xs-pt-10">
							<br/><br/><br/>
							  <label for="supplier_phone_number" class="col-sm-12 control-label">Supplier Phone Number</label>
							  <div class="col-sm-12">
								<input id="supplier_phone_number" type="text" name="supplier_phone_number" placeholder="Supplier Phone Number" class="form-control input-sm">
							  </div>
							</div>
							
							
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Add Supplier</button>
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
