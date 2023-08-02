<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Stock Transferred Report List(s)
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
				<br/><br/><br/>
				 <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
					  <th>#</th>
					  <th>Transfer ID</th>
					  <th>Transfer Date</th>
					  <th>Branch</th>
					  <th>Transfer User</th>
					  <th>Receiver</th>
					  <th>Command</th>
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
						$num=1;
						$array = array(
										'0'=>'<span class="label label-danger">Disabled</span>',
										'1'=>'<span class="label label-success">Enabled</span>'
									);
						$transfers = $this->stock->getStocktransfersBetween($from,$to);
						foreach($transfers as $transfer){
							
							$branch = $this->stock->getBranch($transfer['branch'] );
							
							$user = $this->users->get_user_by_id($transfer['transfer_user'],1);
					?>
						<tr>
							<td><?php  echo $num ?></td>
							<td><?php  echo $transfer['transfer_id'] ?></td>
							<td><?php  echo $transfer['transfer_date'] ?></td>
							<td><?php  echo $transfer['branch'] ?></td>
							<td><?php  echo $user->username ?></td>
							<td><?php  echo $transfer['reciever_userfullname'] ?></td>
							<td><a href="<?php echo base_url('dashboard/viewtransfer/'.$transfer['transfer_id']) ?>" class="btn btn-sm btn-primary">View Transfer</a></td>
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