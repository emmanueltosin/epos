<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Application Settings</div>
                <div class="tab-container">
				  <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
						<div class="col-lg-6">
							<div class="panel">
								<div class="panel panel-heading">Bank List(s)</div>
								<div class="panel-body">
									<table class="table table-bordered">
												<thead>
									  <tr>
										 <th  data-field="no">#</th>
										<th  data-field="customer_name">Bank Name</th>
										<th  data-field="number">Account Number</th>
										<th  data-field="name">Account Name</th>
										<th></th>
									  </tr>
									</thead>
									<tbody>
									<?php  
										$ps = $this->db->get("tbl_bank");
										$num = 1;
										foreach($ps->result_array() as $p){
									?>
										<tr>
											<td><?php echo $num; ?></td>
											<td><?php echo $p['bank_name'] ?></td>
											<td><?php echo $p['account_number'] ?></td>
											<td><?php echo $p['account_name'] ?></td>
											<td><a href="<?php echo base_url('dashboard/bank_manager/'.$p['SN'].'?del=true') ?>" class="btn btn-danger btn-xs">Delete</a></td>
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
						
						<div class="col-lg-6">
						<div class="panel">
								<div class="panel panel-heading">Add New Bank</div>
								<div class="panel-body">
						<form action=""  method="post">
								<div class="form-group">
										<label>Bank Name</label>
										<input required value="" class="form-control input-sm"  placeholder="Bank Name"  type="text" name="bank_name">
								</div>
								
								<div class="form-group">
										<label>Account Number</label>
										<input required value="" class="form-control input-sm"  placeholder="Account Number"  type="text" name="account_number">
								</div>
								
								<div class="form-group">
										<label>Account Name</label>
										<input required value="" class="form-control input-sm"  placeholder="Account Name"  type="text" name="account_name">
								</div>
											
							
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Add Bank</button>
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
