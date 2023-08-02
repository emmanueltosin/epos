<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default panel-table">
					<div class="panel-heading"><a href="<?php echo base_url('dashboard/stock') ?>" class="btn btn-sm btn-success">Back</a> Stock List(s)
					 <div class="tools"></div>
					</div>
					<div class="panel-body">
					 <table id="table3" class="table table-striped table-hover table-fw-widget">
						<thead>
						  <tr>
						  <th>#</th>
						  <th>Bar Code</th>
						  <th>Date Available</th>
						  <th>Created</th>
						  <th>Status</th>
						  <th>References</th>
<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						<?php  
							$stocks =$this->db->from("product_bar_code")->where("stock_id",$this->uri->segment(3))->get();
							$num =1;
							$class = array(
											"0"=>'<span class="label label-success">Available</span>',
											'1'=>'<span class="label label-primary">Sold</span>',
											'2'=>'<span class="label label-primary">Transfer</span>',
											'3'=>'<span class="label label-warning">Picked Up</span>'
										);
							foreach($stocks->result_array() as $stock){
							$user = $this->users->get_user_by_id($stock['added_by'],1);
						?>
								<tr>
									<td><?php echo $num; ?></td>
									<td><?php echo $stock['bar_code'] ?></td>
									<td><?php echo $stock['date_available'] ?></td>
									<td><?php echo $user->username; ?></td>
									<td><?php echo $class[$stock['status']] ?></td>
									<td><?php echo $stock['recieved_ref'] ?></td>
<?php  if($stock['status']!="0"){  ?>
<td><a href="<?php echo base_url('dashboard/return_stock/'.$this->uri->segment(3).'/'.$stock['bar_code'] ) ?>" class="btn btn-success">Return</a></td>
<?php }else{ ?>
<td>No Action</td>
<?php  
}
?>
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
</div>