<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Application Settings
                    <div class="tools">
                        <a href="<?php echo base_url('dashboard/adduser') ?>" class="btn btn-sm btn-primary">Add User</a>
                    </div>
                </div>
                <div class="tab-container">
				  <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
					<div class="row">
					<div class="col-lg-12">
					<div class="panel">
								<div class="panel panel-heading">User List(s)</div>
								<div class="panel-body">
						<table class="table table-bordered" id="table">
						<thead>
							<tr>
								<th>SN</th>
								<th>Username</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
                                <th>Department</th>
								<th>Role</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						<thead>
						<?php
						$num =1;
						$status = array(
										'0'=>'<span class="label label-danger">Disabled</span>',
										'1'=>'<span class="label label-success">Enabled</span>'
									);
						$num = 1;
						$users = $this->db->from("users")->get();
						foreach($users->result_array() as $user){
						?>
						<tr>
							<td><?php  echo $num; ?></td>
							<td><?php echo $user['username'] ?></td>
							<td><?php echo $user['firstname'] ?></td>
							<td><?php echo $user['lastname'] ?></td>
							<td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['department'] ?></td>
							<td><?php echo $user['role'] ?></td>
							
							<td><?php echo $status[$user['activated']] ?></td>
							<td>
							<?php  if($user['activated']=="1"){ ?>
							<a href="<?php echo base_url('dashboard/settings/'.$user['SN'].'?del=0') ?>" class="btn btn-sm btn-danger">Disable</a>
							<?php }else{ ?>
							<a href="<?php echo base_url('dashboard/settings/'.$user['SN'].'?del=1') ?>" class="btn btn-sm btn-success">Enable</a>
							<?php } ?>
							<a href="<?php echo base_url('dashboard/edit_settings/'.$user['SN']) ?>" class="btn btn-sm btn-primary">Edit User</a>
							<a href="<?php echo base_url('dashboard/reset_password/'.$user['SN']) ?>" onclick="return confirm('Are you sure you want reset this password ?');" class="btn btn-sm btn-primary">Reset Password</a>
							</td>
						</tr>
						
						<?php
						$num++;
						}
						?>
						</table>
						</div>
						</div>
						</div>

						</div>
					</div>
					</div>
                  </div>
                </div>
              </div>
		
	</div>
</div>