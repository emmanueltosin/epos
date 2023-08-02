<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Profits By Stock/Product.
                 <div class="tools">
					<form method="post" class="form-horizontal" id="change_branch" action="">
						<?php
						if(isset($_POST['to']) && isset($_POST['from'])){
						?>
							<div class="col-md-3">
							<label>From</label>
								<input value="<?php echo $_POST['from']  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-3">
								<label>To</label>
								<input type="text" value="<?php echo $_POST['to']  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
							<div class="col-md-4">
								<label>Stock</label>
								<select name="customer_id" class="form-control select2_demo_2 input-sm" id="customer_id">
								<option class="bs-title-option" value="">Select Stock</option>
								<?php
									$stocks = $this->stock->getStocksToRecieved();
									foreach($stocks as $stock){
								?>
									<option <?php echo ($stock['SN']==$_POST['customer_id'] ? 'selected' : '') ?> value="<?php echo $stock['SN'] ?>"><?php echo $stock['product_name'] ?></option>
								<?php
									}
								?>
								</select>
							</div>
						<?php
						}else{
						?>
						<div class="col-md-3">
							<label>From</label>
								<input value="<?php echo date('Y').'-'.date('m').'-'.date('d')  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-3">
								<label>To</label>
								<input type="text" value="<?php echo date('Y').'-'.date('m').'-'.date('d')  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
							<div class="col-md-4">
								<label>Stock</label>
								<select name="customer_id" class="form-control select2_demo_2 input-sm" id="customer_id">
								<?php
									$stocks = $this->stock->getStocksToRecieved();
									foreach($stocks as $stock){
								?>
									<option  value="<?php echo $stock['SN'] ?>"><?php echo $stock['product_name'] ?></option>
								<?php
									}
								?>
								</select>
							</div>
								
						<?php
						}
						?>
							<div class="col-md-1"><label style="visibility: hidden;">To</label>
								<button class="btn btn-primary">Go</button>
								
							</div>
							
						</form>
				
	<?php

							if(isset($_POST['from'])){
								$from = $_POST['from'];
								$to = $_POST['to'];
								$customer_id = $_POST['customer_id'];
								}else{
									
								$from =date('Y').'-'.date('m').'-'.date('d') ;
								$to = date('Y').'-'.date('m').'-'.date('d');
								if(!isset($customers[0])){
								$customer_id = 0;	
								}else{
								$customer_id = $customers[0]['SN'];
								}
								}
					
					
						$ins = $this->stock->getSalesRange($from,$to,array("status"=>"COMPLETE"));
						$total_profit = 0;
				$total_vat = 0;
				$total_s_charge = 0;
				$total_discount = 0;
				$total_cost = 0;
						foreach($ins as $in){
							$products = json_decode($in['items'],true);
							foreach($products  as $product){
							$id_pro = $this->stock->getStock($customer_id)[0];
								if($product['id'] == $id_pro['id_stock']){									
									$total_profit +=($product['item_price']* $product['item_qty']);
									$total_cost +=	($product['cost_price']*$product['item_qty']);
								}
							}
						}
?>				
				</div>
                </div>
<div class="panel-body">
				<div class="container">
				<br/><br/>
					<br/><br/><br/><br/><br/>
					
				
							<div class="row">
							<div class="col-sm-6">
								<div class="well">
								<h3 align="center">Total Selling Price</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_profit,2) ?></h2>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="well">
								<h3 align="center">Total Cost Price</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_cost,2) ?></h2>
								</div>
							</div>
							
					</div>
					
					<div class="row">
							<div class="col-sm-12">
						<div class="well">
								<h3 align="center">Profit</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format(($total_profit - $total_cost),2); ?></h2>
								</div>
					</div>
					</div>
				
	
				</div>				
				</div>
	
</div>
</div>