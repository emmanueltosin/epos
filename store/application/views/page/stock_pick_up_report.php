<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Stock Pick up Report List(s)
                 <div class="tools">
					<form method="post" class="form-horizontal" id="change_branch" action="">
									<?php
		?>
						<?php
						if(isset($_POST['to']) && isset($_POST['from'])){
						?>
							<div class="col-md-5">
							<label>From</label>
								<input value="<?php echo $_POST['from']  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-5">
								<label>To</label>
								<input type="text" value="<?php echo $_POST['to']  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
						<?php
						}else{
						?>
						<div class="col-md-5">
							<label>From</label>
								<input value="<?php echo date('Y').'-'.date('m').'-'.date('01')  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-5">
								<label>To</label>
								<input type="text" value="<?php echo date('Y').'-'.date('m').'-'.date('t')  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
								
						<?php
						}
						?>
							<div class="col-md-1"><label style="visibility: hidden;">To</label>
								<button class="btn btn-primary">Go</button>
								
							</div>
							
						</form>
				 
				 </div>
                </div>
				<div class="panel-body">
				<br/><br/>
				<table id="table3" class="table table-hover table-striped table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>Pick Up ID</th>
									<th>Name</th>
									<th>Date</th>
									<th>Bar code</th>
									<th>Qty</th>
									<th>Staff</th>
									<th>Note</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($_POST['from'])){
									$from = $_POST['from'];
									$to = $_POST['to'];
									}else{
									$from =date('Y').'-'.date('m').'-'.date('01') ;
									$to = date('Y').'-'.date('m').'-'.date('t');
									}
								
											$pickup =$this->stock->getPickupReport($from,$to);
											$num = 1;
											foreach($pickup as $pi){
											$product = $this->stock->getStock($pi['product']);
											//status of pick up
											//0 ---> pending
											//1----> returned
											//2----> moved to arena
											//3----> sold
								?>
									<tr>
										<td><?php  echo $num; ?></td>
										<td><?php  echo $pi['pickup_id']; ?></td>
										<td><?php  echo $product['product_name']; ?></td>
										<td><?php  echo $pi['pickup_date']; ?></td>
										<?php if(empty($pi['product_barcode'])){ ?>
										<td><?php  echo $pi['product_barcode']; ?></td>
										<td><?php  echo $pi['qty']; ?></td>
										<?php }else{ ?>
										<td><?php  echo $pi['product_barcode']; ?></td>
										<td><?php  echo $pi['qty']; ?></td>
										<?php } ?>
										<td><?php  echo $pi['pickUpstaff']; ?></td>									
										<td><?php  echo $pi['pickup_info']['note']; ?></td>
										<?php if($pi['status']=="0"){?>
										<td class="status_id"><span class="label label-warning">Pending</span></td>
										<?php }else if($pi['status']=="1"){ ?>
										<td class="status_id"><span class="label label-primary">Returned</span></td>
										<?php }else if($pi['status']=="2"){ ?>
										<td class="status_id"><span class="label label-primary">In-Arena</span></td>
										<?php }else{ ?>
										<td class="status_id"><span class="label label-success">Sold</span></td>
										<?php } ?>
										<td>
										<?php
										if($pi['status']=="0"){
										?>
										  <div class="btn-group">
											<a href="<?php echo base_url('dashboard/update_pick_up_status/'.$pi['SN'])  ?>" data-qty="<?php  echo $pi['qty']; ?>" data-value="returned" class="btn btn-success btn-sm update_pick_up_status">Returned</a>
											<a href="<?php echo base_url('dashboard/update_pick_up_status/'.$pi['SN']) ?>" data-qty="<?php  echo $pi['qty']; ?>" data-value="sold" class="btn btn-primary btn-sm update_pick_up_status">Sold</a>
											<a href="<?php echo base_url('dashboard/update_pick_up_status/'.$pi['SN']) ?>" data-qty="<?php  echo $pi['qty']; ?>" data-value="arena" class="btn btn-warning btn-sm update_pick_up_status">Arena</a>
										  </div>
										 <?php
										}else{
										 ?>
										 <b>No Action</b>
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