<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Sales List(s)
                </div>
<div class="panel-body">
 <table id="table3" class="table table-striped table-hover table-fw-widget">
	<thead>
		<tr>
			<th>#</th>
			<th>Firstname</th>
			<th>Last name</th>
			<th>Email</th>
			<th>Phone No</th>
			<th>Address</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$customers = $this->db->get('tbl_customers')->result_array();
		$num = 1;
		foreach($customers as $cus){
		?>
		<tr>
			<td><?php  echo $num; ?></td>
			<td><?php echo $cus['firstname'] ?></td>
			<td><?php echo $cus['lastname'] ?></td>
			<td><?php echo $cus['email'] ?></td>
			<td><?php echo $cus['phone'] ?></td>
			<td><?php echo $cus['address'] ?></td>
			
		</tr>
		<?php $num++; } ?>
	</tbody>
</table>
</div>	</div>	</div>	</div>	