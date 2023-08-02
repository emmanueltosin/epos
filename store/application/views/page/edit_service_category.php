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
								<div class="panel panel-heading">Update Form</div>
								<div class="panel-body">
						<form action=""  method="post">
						
							<div class="form-group">
							  <div class="form-group">
                                  <label>Category Name</label>
								<input id="category_name" type="text" value="<?php echo $service['name']  ?>" required name="name" placeholder="Category Name" class="form-control input-sm">
							  </div>
                                <div class="form-group">
                                    <label>VAT(%)</label>
                                    <input id="vat" type="text" value="<?php echo $service['vat']  ?>" required name="vat" placeholder="VAT" class="form-control input-sm">
                                </div>
							</div>
							
							<div class="col-sm-12">
								<br/>
								<button class="btn btn-primary" type="submit">Update Service</button>
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
