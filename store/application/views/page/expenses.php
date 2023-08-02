<div class="row">
<div class="col-sm-12">
	 <div class="panel panel-default panel-table">
                <div class="panel-heading"> Expenses
					<div class="tools">
						<a href="<?php echo base_url('dashboard/new_expenses') ?>" class="btn btn-primary btn-sm">Add New Expenses</a>
					</div>
                </div>
<div class="panel-body">
<table id="table3" class="table table-striped table-hover table-fw-widget" style="font-size:12px;">
				<thead>
			<th data-field="check" data-checkbox="true"></th>
													 <th data-field="SN" data-editable="true">#</th>
                                                    <th data-field="title" data-editable="true">Title</th>
													<th data-field="description" data-editable="true">Description</th>
													 <th data-field="amount" data-editable="true">Amount</th>
                                                    <th data-field="department" data-editable="true">Department</th>
                                                    <th data-field="date" data-editable="true">Date</th>
													<th data-field="added_by" data-editable="true">Added By</th>
													<th data-field="modified">Modified</th>
                                                    <th data-field="created">Created</th>
													<th>Action</th>
				</thead>
				<tbody>
				<?php
													$num = 1;
													$filter = array("expense_date"=>date("Y-m-d"));
													if($this->users->get_user_by_username($this->session->userdata("username"))->role=="Sales Representative"){
														$filter['user_id'] = $this->users->get_user_by_username($this->session->userdata("username"))->SN;
													}
													$expenses = $this->stock->getExpenses($filter);
													$total = 0;
													foreach($expenses  as $expense){
														$total+=$expense['expense_total_amount'];
														$user = $this->db->get_where("users",array("SN"=>$expense['user_id']))->row();
												?>
													<tr>
														<td></td>
														<td><?php echo $num; ?></td>
														<td><?php echo $expense['expense_purpose_title'] ?></td>
														<td><?php echo $expense['expense_purpose'] ?></td>
														<td><?php echo number_format($expense['expense_total_amount'],2) ?></td>
                                                        <td><?php echo $expense['department'] ?></td>
														<td><?php echo $expense['expense_date'] ?></td>
														<td><?php echo $user->username; ?></td>
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