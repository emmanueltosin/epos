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
								<div class="panel panel-heading">Department List(s)</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>SN</th>
												<th>Department</th>
                                                <th>Type</th>
                                                <th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$num = 1;
											$departments = $this->stock->getDepartments();
                                            $departments[] = array('department'=>"Cinema","type"=>"Service");
											foreach($departments as $department){
											?>
											<tr>
												<td><?php echo $num; ?></td>
												<td><?php echo $department['department'] ?></td>
												<td><?php echo $department['type'] ?></td>
                                                <td>
                                                    <?php
                                                    if($department['department'] !="Cinema") {
                                                        ?>
                                                        <a href="<?php echo base_url('dashboard/edit_department/' . $department['SN']) ?>"
                                                           class="btn btn-primary">Edit</a>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        No Action
                                                        <?php
                                                    }
                                                    ?>
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
								<div class="panel panel-heading">Create New Department</div>
								<div class="panel-body">
						<form action=""  method="post">
						
							<div class="form-group">
							  <div class="form-group">
                                  <label>Name</label>
								<input id="department" type="text" required name="department" placeholder="Department" class="form-control input-sm">
							  </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control input-sm"  required name="type">
                                        <option value="Service">Service</option>
                                        <option value="Sales">Sales</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
							</div>
							
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Add Department</button>
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
