<div class="row">
	<div class="col-sm-12">
		<form action="" enctype="multipart/form-data" method="post" >
		<div class="panel">
			 <div class="panel-heading">Move Stock to Store
                 <div class="tools"><button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> Move Stock</button></div>
              </div>
			  <div class="panel-body">
					<div class="form-horizontal">
					<div class="form-group xs-mt-10">
                      <label for="product_name" readonly class="col-sm-2 control-label">Product Name</label>
                      <div class="col-sm-10">
                        <input id="product_name" readonly value="<?php  echo $stock['product_name'] ?>" name="product_name" type="text" required  max="255" placeholder="Product Name" class="form-control input-sm">
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="model" class="col-sm-2 control-label">Model</label>
                      <div class="col-sm-10">
                        <input id="model" name="model" readonly value="<?php  echo $stock['model'] ?>" type="text" required min="3" max="255" placeholder="Model" class="form-control input-sm">
                      </div>
                    </div>
					
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-10">
                        <input id="price" required readonly value="<?php  echo $stock['price'] ?>" type="number" name="price"  placeholder="Price" class="form-control input-sm">
                      </div>
                    </div>
					
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Store Qty</label>
                      <div class="col-sm-10">
                        <input id="qty" readonly value="<?php  echo $stock['quantity'] ?>" type="number" name="quantity"  placeholder="Price" class="form-control input-sm">
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Sales Arena Qty</label>
                      <div class="col-sm-10">
                        <input id="qty_arena" readonly value="<?php  echo $stock['quantity_arena'] ?>" type="number" name="quantity_arena"  placeholder="Price" class="form-control input-sm">
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Qty to move</label>
                      <div class="col-sm-10">
                        <input id="move_qty" required value="" max="<?php  echo $stock['quantity_arena'] ?>" type="number" name="qty_to_move"  placeholder="Enter Quantity to Store" class="form-control input-sm">
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Pick up Staff</label>
                      <div class="col-sm-10">
                        <input id="move_qty" required value=""  type="text" name="pick_up_staff"  placeholder="Pick up staff" class="form-control input-sm">
                      </div>
                    </div>
					<div class="form-group xs-mt-10">
					 <label for="price" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<button type="submit" class="btn  btn-primary"><i class="mdi mdi-plus"></i> Move Stock</button>
					</div>
					</div>
			  </div>
			  </div>
		</div>
	</div>
</div>