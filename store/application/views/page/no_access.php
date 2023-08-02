<div class="row">
	<div class="col-sm-12">
		
		<div class="col-lg-12">
		<?php
		
		$get =$this->users->get_user_by_username($this->session->userdata("username"));
		?>
								<div class="panel">
								<div class="panel panel-heading">Edit Profile</div>
								<div class="panel-body">
									<form action="<?php  echo base_url('dashboard/edit_settings/'.$this->tank_auth->get_user_id());  ?>" method="post" accept-charset="utf-8">
											<div class="form-group">
											<label>Username</label>
												<input type="text" value="<?php  echo $get->username  ?>" name="username" value="" id="username" maxlength="20" size="30" required="" placeholder="Username" autocomplete="off" class="input-sm form-control">
											 </div>
											<div class="form-group">
												 <input type="text" value="<?php  echo $get->email  ?>" name="email" value="" id="email" maxlength="80" size="30" required="" placeholder="E-mail" autocomplete="off" class="input-sm form-control">
											</div>
												<div class="form-group">
														<label>Password</label>
														  <input type="password" name="password" value="" id="password" maxlength="20" size="30"  class="input-sm form-control" placeholder="Password">
															<span style="color:red;">Note : Leave Blank if you do not want to change your password</span>
													  </div>
											  
												
													  <div class="form-group xs-pt-10">
														<input type="submit" value="Update My Profile" class="btn btn-block btn-primary btn-xl">
													  </div>
									</form>
								</div>
								</div>
							</div>
		</div>
	</div>
</div>