<div class="row">
	<div class="col-sm-12">
		<form action="" enctype="multipart/form-data" method="post" >
		<div class="panel">
			 <div class="panel-heading">New Assets
                 <div class="tools"><button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Save Assets</button></div>
              </div>
			  <div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group xs-mt-10">
                      <label for="product_name"  class="col-sm-2 control-label">Assets Name</label>
                      <div class="col-sm-8">
						<input id="assests_name" required type="text"  name="assests_name"  placeholder="Assets Name" class="form-control input-sm">
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="product_name"  class="col-sm-2 control-label">Purchase Date</label>
                      <div class="col-sm-8">
						<input id="purchase_date" required type="text" value="<?php echo date('Y-m-d') ?>" name="purchase_date" data-min-view="2" data-date-format="yyyy-mm-dd" placeholder="Purchase Date" class="date form-control input-sm">
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Purchase Price</label>
                      <div class="col-sm-8">
                        <input id="purchase_price" type="number" required name="purchase_price"  placeholder="Purchase Price" class="form-control input-sm">
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-8">
						<select class="form-control input-sm" required name="status">
							<option value="">Select Status</option>
							<option value="New">New</option>
							<option value="Sold">Sold</option>
							<option value="Refurbish">Refurbish</option>
							<option value="Damaged">Damaged</option>
						</select>
						
                      </div>
                    </div>
						<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Category</label>
                      <div class="col-sm-8">
						<select class="form-control input-sm" required name="category">
						<option value="">Select Category</option>
							<option value="Funiture">Funiture</option>
							<option value="Electronics">Electronics</option>
							<option value="Copier/Printers">Copier/Printers</option>
							<option value="Automobiles">Automobiles</option>
							<option value="Others">Others</option>
						</select>
						
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Model Number</label>
                      <div class="col-sm-8">
                        <input id="model_number" type="text"  name="model_number"  placeholder="Model Number" class="form-control input-sm">
                      </div>
                    </div>	
					
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Department</label>
                      <div class="col-sm-8">
                          <?php
                          $dpts = $this->stock->getDepartments();
                          $department = array(
                              'Store'=> array('Stock Officer'),
                              'Cinema'=>array('Sales Representative','Administrator'),
                          );
                          foreach($dpts as $dpt){
                              $department[$dpt['department']] = array('Sales Representative','Administrator');
                          }

                          ?>
                          <select required class="form-control input-sm" name="department" onchange="return show_role(this.value)">
                              <option>-Select Department-</option>
                              <?php
                              foreach($department as $key=>$dpt){
                                  ?>
                                  <option  value="<?php echo $key ?>"><?php echo $key ?></option>
                              <?php } ?>
                          </select>
                       </div>
                    </div>	
					
			
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-8">
                        <textarea placeholder="Description" required style="height:200px" class="form-control col-lg-12" name="description"></textarea>
                      </div>
                    </div>
					<br/>
					<div class="xx-mt-10" style="margin-left:80px;">
						<button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Save Assets</button>
					</div>
					
				</div>
			  </div>
		</div>
		</form>
	</div>
</div>