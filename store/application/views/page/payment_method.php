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
								<div class="panel panel-heading">Payment Method</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>SN</th>
												<th>Payment Method</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$num = 1;
												$supps =$this->stock->getPaymentMethod();
												foreach($supps as $supp){
											?>
												<tr>
													<td><?php echo $num; ?></td>
													<td><?php echo $supp['payment_method'] ?></td>
													<?php if($supp['defaults'] == "0"){ ?>
													<td><a href="<?php echo base_url('dashboard/payment_method/'.$supp['SN'].'?del=true') ?>" class="btn btn-danger">Delete</a></td>
													<?php  }else{ ?>
													<td></td>
													<?php } ?>
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
								<div class="panel panel-heading">Add New Payment Method</div>
								<div class="panel-body">
						<form action=""  method="post">
						
							<div class="form-group xs-pt-10">
							<br/>
							  <label for="branch_name" class="col-sm-12 control-label">Payment Method</label>
							  <div class="col-sm-12">
								<input id="payment_method" required type="text" name="payment_method" placeholder="Payment Method" class="form-control input-sm">
							  </div>
							</div>
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Add</button>
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
