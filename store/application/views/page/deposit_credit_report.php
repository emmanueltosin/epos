<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default ">
		<div class="panel-heading">
			Bank Deposit / Debit Report
			
			<div class="tools">
				<form method="post" class="form-horizontal" id="change_branch" action="">
									<?php
		?>
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
								<div class="col-md-3">
								<label>Select bank</label>
							 <select required class="form-control input-sm" name="bank">
										
										<?php  
										foreach($this->db->get("tbl_bank")->result_array() as $bank){
										?>
										<option value="<?php echo $bank['SN'] ?>"><?php echo $bank['bank_name'] ?>[<?php echo $bank['account_number'] ?>]</option>
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
								<input value="<?php echo date('Y').'-'.date('m').'-'.date('01')  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>							
							</div>
							<div class="col-md-3">
								<label>To</label>
								<input type="text" value="<?php echo date('Y').'-'.date('m').'-'.date('t')  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
							</div>
								<div class="col-md-3">
								<label>Select bank</label>
							 <select required class="form-control input-sm" name="bank">
										
										<?php  
										foreach($this->db->get("tbl_bank")->result_array() as $bank){
										?>
										<option value="<?php echo $bank['SN'] ?>"><?php echo $bank['bank_name'] ?>[<?php echo $bank['account_number'] ?>]</option>
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
			</div>
			
		</div>
		<div class="panel-body">
			<br/><br/><br/><br/>
			<table class="table table-condensed table-bordered" id="table3">
							<thead>
							  <tr>
								<th class="text-center"  data-field="item_name"> Date </th>
								<th class="text-center" data-field="comment">Description</th>
								<th class="text-center" data-field="credit">Credit</th>
								<th class="text-center" data-field="debit">Debit</th>
								<th class="text-center" data-field="Bank">Bank</th>
							</thead>
							<tbody>
							<?php
								
								if(isset($_POST['from'])){
									$from = $_POST['from'];
								}else{
									$from = date('Y-m-01');
								}
								if(isset($_POST['to'])){
									$to = $_POST['to'];
								}else{
									$to = date('Y-m-t');
								}
								
								
								if(isset($_POST['to'])){
									$bank = $_POST['bank'];
								}else{
									$bank = (isset($this->db->get("tbl_bank")->result_array()[0]['SN']) ? $this->db->get("tbl_bank")->result_array()[0]['SN'] : 0);;
								}
								$total_cre =0;
								$total_deb =0;
								$this->db->from("tbl_cashbook");
								$this->db->where("date_ BETWEEN '$from' and '$to'");
								$this->db->where("bank",$bank);
								$this->db->order_by("date_","DESC");
								$cashbooks =$this->db->get();
								foreach($cashbooks->result_array() as $cash){
								$b = $this->db->get_where("tbl_bank",array("SN"=>$cash['bank']))->row_array();
							?>
								<tr>
									<td class="text-center"><?php  echo $cash['date_'] ?></td>
									<td class="text-center"><?php  echo $cash['comment'] ?></td>
									<?php if($cash['type']=="Credit"){  ?>
									<td class="text-center"><?php  echo number_format($cash['amt'],2); $total_cre +=$cash['amt'] ?></td>
									<td class="text-center"></td>
									<?php }else{ ?>
									<td class="text-center"></td>
									<td class="text-center"><?php  echo number_format($cash['amt'],2); $total_deb +=$cash['amt']?></td>
									<?php } ?>
									<td class="text-center"><?php echo $b['bank_name']; ?></td>
								</tr>
							<?php
								}
							?>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<th>Total Credit : <?php echo number_format($total_cre,2); ?></th>
									<th>Total Debit : <?php echo number_format($total_deb,2); ?></th>
									<td></td>
								
								</tr>
							</tfoot>
				</table>
		</div>
</div>
</div>
</div>