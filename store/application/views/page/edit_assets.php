<?php 
$as = $this->db->get_where("tbl_assets",array("SN"=>$this->uri->segment(3)))->row_array();
?>
<div class="row">
	<div class="col-sm-12">
		<form action="" enctype="multipart/form-data" method="post" >
		<div class="panel">
			 <div class="panel-heading">New Assets
                 <div class="tools"><button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Update Assets</button></div>
              </div>
			  <div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group xs-mt-10">
                      <label for="product_name"  class="col-sm-2 control-label">Assets Name</label>
                      <div class="col-sm-8">
						<input id="assests_name" required type="text" value="<?php echo $as['assests_name'] ?>" name="assests_name"  placeholder="Assets Name" class="form-control input-sm">
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="product_name"  class="col-sm-2 control-label">Purchase Date</label>
                      <div class="col-sm-8">
						<input id="purchase_date" required type="text" value="<?php echo $as['purchase_date'] ?>" name="purchase_date" data-min-view="2" data-date-format="yyyy-mm-dd" placeholder="Purchase Date" class="date form-control input-sm">
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="product_name"  class="col-sm-2 control-label">Date Sold</label>
                      <div class="col-sm-8">
						<input id="date_sold"  type="text" value="<?php echo ($as['date_sold'] == "0000-00-00" ? "" : $as['date_sold']) ?>" name="date_sold" data-min-view="2" data-date-format="yyyy-mm-dd" placeholder="Date Sold" class="date form-control input-sm">
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Purchase Price</label>
                      <div class="col-sm-8">
                        <input id="purchase_price" type="number" value="<?php echo $as['purchase_price'] ?>" required name="purchase_price"  placeholder="Purchase Price" class="form-control input-sm">
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-8">
						<select class="form-control input-sm" required name="status">
							<option value="New" <?php echo ($as['purchase_price']=="New" ? "selected" : "") ?>>New</option>
							<option value="Sold" <?php echo ($as['purchase_price']=="Sold" ? "selected" : "") ?>>Sold</option>
							<option value="Refurbish" <?php echo ($as['purchase_price']=="Refurbish" ? "selected" : "") ?>>Refurbish</option>
							<option value="Damaged" <?php echo ($as['purchase_price']=="Damaged" ? "selected" : "") ?>>Damaged</option>
						</select>
						
                      </div>
                    </div>
						<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Category</label>
                      <div class="col-sm-8">
						<select class="form-control input-sm" required name="category">
							<option value="Funiture" <?php echo ($as['category']=="Funiture" ? "selected" : "") ?>>Funiture</option>
							<option value="Electronics" <?php echo ($as['category']=="Electronics" ? "selected" : "") ?>>Electronics</option>
							<option value="Copier/Printers" <?php echo ($as['category']=="Copier/Printers" ? "selected" : "") ?>>Copier/Printers</option>
							<option value="Automobiles" <?php echo ($as['category']=="Automobiles" ? "selected" : "") ?>>Automobiles</option>
							<option value="Others" <?php echo ($as['category']=="Others" ? "selected" : "") ?>>Others</option>
						</select>
						
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Model Number</label>
                      <div class="col-sm-8">
                        <input id="model_number" type="text" value="<?php echo $as['model_number'] ?>" name="model_number"  placeholder="Model Number" class="form-control input-sm">
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
                          <select required class="form-control input-sm" name="department">
                              <option>-Select Department-</option>
                              <?php
                              foreach($department as $key=>$dpt){
                                  ?>
                                  <option <?php echo $key==$as['department'] ? 'selected' : ''  ?> value="<?php echo $key ?>"><?php echo $key ?></option>
                              <?php } ?>
                          </select>
                      </div>
                    </div>	
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-8">
                        <textarea placeholder="Description" required style="height:200px" class="form-control col-lg-12" name="description"><?php echo $as['description'] ?></textarea>
                      </div>
                    </div>
					<br/>
					<div class="xx-mt-10" style="margin-left:80px;">
						<button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Update Assets</button>
					</div>
					
				</div>
			  </div>
		</div>
		</form>
	</div>
</div>