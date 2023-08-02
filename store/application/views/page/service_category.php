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
								<div class="panel panel-heading">Service Category List(s)</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>SN</th>
												<th>Service Category</th>
                                                <th>VAT</th>
                                                <th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$num = 1;
											$service_list = $this->stock->getServiceCategories();
											foreach($service_list as $service){
											?>
											<tr>
												<td><?php echo $num; ?></td>
												<td><?php echo $service['name'] ?></td>
												<td><?php echo $service['vat'] ?>(%)</td>
                                                <td>
                                                    <a href="<?php echo base_url('dashboard/edit_service_category/'.$service['SN']) ?>" class="btn btn-primary btn-sm">Edit</a>
                                                </td>
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
								<div class="panel panel-heading">Create New Category</div>
								<div class="panel-body">
						<form action=""  method="post">
						
							<div class="form-group">
							  <div class="form-group">
                                  <label>Category Name</label>
								<input id="category_name" type="text" required name="name" placeholder="Category Name" class="form-control input-sm">
							  </div>
                                <div class="form-group">
                                    <label>VAT(%)</label>
                                    <input id="vat" type="text" required name="vat" placeholder="VAT" class="form-control input-sm">
                                </div>
							</div>
							
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Add Service</button>
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
