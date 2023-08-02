<div class="row">
<div class="col-sm-12">
	 <div class="panel panel-default panel-table">
                <div class="panel-heading"> Expenses
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
					<br/><br/><br/>
                </div>
<div class="panel-body">
<table id="table3" class="table table-striped table-hover table-fw-widget" style="font-size:12px;">
				<thead>
			<th data-field="check" data-checkbox="true"></th>
													 <th data-field="SN" data-editable="true">#</th>
                                                    <th data-field="title" data-editable="true">Title</th>
													<th data-field="description" data-editable="true">Description</th>
													 <th data-field="amount" data-editable="true">Amount</th>
                                                    <th data-field="date" data-editable="true">Date</th>
													<th data-field="modified">Modified</th>
                                                    <th data-field="created">Created</th>
													<th>Action</th>
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
													$num = 1;
													$total = 0;
													$expenses = $this->stock->getExpensesRange($from,$to,FALSE);
													foreach($expenses  as $expense){
														$total+=$expense['expense_total_amount'];
												?>
													<tr>
														<td></td>
														<td><?php echo $num; ?></td>
														<td><?php echo $expense['expense_purpose_title'] ?></td>
														<td><?php echo $expense['expense_purpose'] ?></td>
														<td><?php echo number_format($expense['expense_total_amount'],2) ?></td>
														<td><?php echo $expense['expense_date'] ?></td>
														<td><?php echo $expense['updated'] ?></td>
														<td><?php echo $expense['created'] ?></td>
														<td>
														<?php
															if($expense['expense_purpose_title']!="Salary Payment"){
														?>
														<div class="btn-group btn-space">
														<button type="button" class="btn btn-default">Action</button>
														<button type="button" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span></button>
														<ul role="menu" class="dropdown-menu">
														  <li><a href="<?php echo base_url('dashboard/edit_expenses/'.$expense['SN'] )  ?>">Edit </a></li>
														  <li><a onclick="return confirm('Are you sure, you want delete this data?')" href="<?php echo base_url('dashboard/delete_expenses/'.$expense['SN'] )  ?>">Delete</a></li>
														</ul>
													  </div>
														<?php
															}else{
														?>
														No Action
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
				<tfoot>
					<tr>
					<th></th>
					<th></th>
				    <th></th>
					<th></th>
				    <th>Total : <?php echo number_format($total,2) ?></th>
				    <th></th>
					<th></th>
					<th></th>
					
				  </tr>
				</tfoot>
			</table>
</div>	</div>	</div>	</div>	