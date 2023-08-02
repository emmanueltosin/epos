<div class="row">
<div class="col-sm-12">

					
				<div class="panel panel-default">
					<div class="panel-heading">
					 <b>Stock Movement Report</b> <br/>
					Stcok Name : <?php $mat = $this->db->get_where("stock",array("SN"=>$this->uri->segment(3)))->row_array();  ?>
					<?php echo $mat['product_name']; ?>
					<div class="tools">
					<form action="" method="post">
								<div class="row">
									<div class="col-md-5">
										<div><b>FROM :</b> <input required placeholder="Received Date" data-min-view="2" data-date-format="yyyy-mm-dd"  class="datetimepicker date form-control input-sm" value="<?php echo date('Y-m-01') ?>" type="text" name="from">
                                           </div>
									</div>
									<div class="col-md-5">
										<div ><b>TO :</b>  <input required placeholder="Received Date" data-min-view="2" data-date-format="yyyy-mm-dd"  class="datetimepicker date form-control input-sm" value="<?php echo date('Y-m-t') ?>" type="text" name="to">
                                           </div>
									</div>
									<div class="col-md-2">
										 <button class="btn  btn-primary" type="submit"> Go</button>
									</div>
									</div>
				 	</form>
					</div>
					</div>
					<div class="panel-body">
						<div class="row">
							
									<table class="table  table-striped" id="table3">
										<thead>
											<th class="text-center">Date</th>
											<th class="text-center">Stock In</th>
                                            <th class="text-center">Stock Out</th>
											<th class="text-center">Stock Sold</th>
											<th class="text-center">Stock Balance</th>
                                            <th class="text-center">Comment</th>
											<th class="text-center">Move By</th>
											<th>Action</th>
										</thead>
										<tbody id="material_holder">
											<?php
												if(isset($_POST['from'])){
													$from = $_POST['from'];
													$to =$_POST['to'];
												}else{
													$from = date("Y-m-01");
													$to = date("Y-m-t");
												}
												$this->db->from("tbl_transfer_recieved");
												$this->db->where("stock_id",$this->uri->segment(3));
												$this->db->where("date_ BETWEEN '$from' AND '$to'");
												$bincards = $this->db->get();	
												$tt_in =0;
												$tt_out =0;
												$tt_tt =0;
												$sold =0;
												foreach($bincards->result_array() as $bincard){
												$user = $this->db->get_where("users",array("SN"=>$bincard['user']))->row_array();
											?>
											<tr>
												<td class="text-center"><?php echo  $bincard['date_'] ?></td>
												<td class="text-center"><?php echo ($bincard['amt_in']=="" ? '' : $bincard['amt_in']); $tt_in+=$bincard['amt_in'] ?></td>
												<td class="text-center"><?php echo ($bincard['amt_out']=="" ? '' : $bincard['amt_out']); $tt_out +=$bincard['amt_out']?></td>
												<td class="text-center"><?php echo ($bincard['sold']=="" ? '' : $bincard['sold']); $sold +=$bincard['sold']?></td>
												<td class="text-center"><?php echo $bincard['balance']; ?></td>
                                                <td class="text-center"><?php echo $bincard['comment']; ?></td>
												<td class="text-center"><?php echo $user['firstname'] ?> <?php echo $user['lastname'] ?></td>
												<td>No Action</td>
											</tr>
											<?php
												}
											?>
										</tbody>
										<!--<tfoot>
											<tr>
												<td></td>
												<th class="text-center"><?php echo $tt_in; ?></th>
												<th class="text-center"><?php echo $tt_out; ?></th>
											
												<th class="text-center"><?php echo $sold; ?></th>
												<td></td>
												<td></td>
												
											</tr>
										</tfoot>-->
									</table>
						</div>
						
						
						
					</div>

			
</div>

</div>