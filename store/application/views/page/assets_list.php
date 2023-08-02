<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default ">
		<div class="panel-heading">
			Assets List
		</div>
		<div class="panel-body">
			<table class="table table-condensed table-striped" id="table3">
							<thead>
							  <tr>
								<th>SN</th>
								<th   > Assets Name</th>
								<th  >Assets Status</th>
								<th >Assets Category</th>
								<th  >Department</th>
								<th  >Purchase Price</th>
								<th  >Purchase Date</th>
								<th  >Sold Date</th>
								<th  >Model No</th>
								<th>Action</th>
							</thead>
							<tbody>
							<?php
								$assets = $this->db->from("tbl_assets")->order_by("SN","DESC")->get()->result_array();
								$num=1;
								foreach($assets as $asset){
							?>
								<tr>
									<td><?php echo $num; ?></td>
									<td><?php echo $asset['assests_name'] ?></td>
									<td><?php echo $asset['status'] ?></td>
									<td><?php echo $asset['category'] ?></td>
									<td><?php echo $asset['department'] ?></td>
									<td><?php echo number_format($asset['purchase_price'],2); ?></td>
									<td><?php echo $asset['purchase_date'] ?></td>
									<td><?php echo  ($asset['date_sold'] == "0000-00-00" ? 'Not Sold' : $asset['date_sold']); ?></td>
									<td><?php echo $asset['model_number'] ?></td>
									<td><a href="<?php echo base_url('dashboard/view_assests/'.$asset['SN']) ?>" class="btn btn-sm btn-primary">Edit / View Assets</a></td>
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