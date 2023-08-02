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
								<div class="panel panel-heading">Product Category List(s)</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>SN</th>
												<th>Category Name</th>
                                                <th>VAT(%)</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$num = 1;
											$manufac = $this->stock->getCategories();
											foreach($manufac as $manu){
											?>
											<tr>
												<td><?php echo $num; ?></td>
												<td><?php echo $manu['category'] ?></td>
                                                <td><?php echo $manu['vat'] ?>%</td>
												<td>
                                                    <a href="<?php echo base_url('dashboard/category/'.$manu['SN'].'?del=true') ?>" class="btn btn-danger">Delete</a>
                                                    <a href="<?php echo base_url('dashboard/edit_category/'.$manu['SN']) ?>" class="btn btn-success">Edit</a>
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
								<div class="panel panel-heading">Add New Category</div>
								<div class="panel-body">
						<form action=""  method="post">
						
							<div class="form-group">
							  <label>Category</label>

								<input id="manufacturer" type="text" required name="category" placeholder="Category" class="form-control input-sm">

							</div>

                            <div class="form-group">
                                <label>VAT(%)</label>
                                    <input id="vat" type="number" required name="vat" placeholder="VAT" class="form-control input-sm">

                            </div>
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Add Category</button>
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
