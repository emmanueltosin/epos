<div class="row">
<div class="panel">
<div class="panel-heading">Backup and Restore Database</div>
<div class="panel-body">
<div class="login-form-area mg-t-30 mg-b-15">
                <div class="container-fluid">
                    <div class="row">   
					<div class="col-lg-6">
					<div class="login-bg"> 
			    <h1>Database Restore</h1>
			  <p>Upload backup file and click on Restore</p>
			  <form  enctype="multipart/form-data" action="<?php echo base_url('dashboard/restore_database') ?>" method="POST">
				<input type="file" class="form-control" name="restore" /><br/>
				<button type="submit" name="restore_btn" class="btn btn-danger btn-block btn-lg"><i class="fa fa-database"> Restore Database Now</i></button>
			  </form>
			  </div>
					
					</div>
					        <div class="col-md-6">
							 <div class="login-bg"> 
			    <h1>Database Backup</h1>
			  <p>Click on the button below to Backup</p>
			  <br /><br /><br />
				<a style="margin-top:10px;" href="<?php echo base_url('dashboard/backupandUpload'); ?>" class="btn btn-primary btn-block btn-lg"><i class="fa fa-database"> Back up Database Now</i></a>
              </div>
					
                </div>
                </div>
            </div> 
			</div>
</div>
</div>
</div>