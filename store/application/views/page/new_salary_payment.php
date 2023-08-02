<?php
$months = array("January"=>"1", "February"=>"2", "March"=>"3", "April"=>"4", "May"=>"5", 
"June"=>"6", "July"=>"7",
"August"=>"8","September"=>"9","October"=>"10","November"=>"11","December"=>"12");
?>
<div class="panel panel-default">
					 <div class="panel-heading">
					 Generate New Payment Form
					 </div>
					 <div class="panel-body">
						<form action="" method="post"><br/>
							<div class="row">
								<div class="col-lg-4 col-md-12">
									<label>Select Month</label>
									<select name="month" class="form-control  input-sm custom-select mb-2 mr-sm-2 mb-sm-0" required>
										<?php if(!isset($_POST['month'])){ ?>
										<option value="">-Select Month-</option>
										<?php  
											}foreach($months as $key=>$month){
										?>
											<?php if(isset($_POST['month'])){  ?>
											<option <?php echo ($_POST['month']==$key.'=>'.$month ? 'selected' : '') ?> value="<?php echo $key.'=>'.$month ?>"><?php echo $key ?></option>
											<?php }else{ ?>
											<option <?php echo ($month==date('m') ? 'selected' : '') ?> value="<?php echo $key.'=>'.$month ?>"><?php echo $key ?></option>
											<?php  } ?>
										<?php
											}
										?>
									</select>
								</div>
								<div class="col-lg-4 col-md-12">
								<label>Select Year</label>
									<?php
										$year = date('Y');
										
										$to_year = $year + 5;
									?>
									<select name="year" class="form-control input-sm custom-select mb-2 mr-sm-2 mb-sm-0" required>
										<?php if(!isset($_POST['year'])){ ?>
										<option value="">-Select Year-</option>
										<?php } for($i = $year; $i<$to_year;$i++){  ?>
										<?php if(isset($_POST['year'])){  ?>
										<option  <?php echo ($_POST['year']==$i ? 'selected' : '') ?> value="<?php echo $i;   ?>"><?php echo $i; ?></option>
										<?php }else{ ?>
										<option <?php echo ($i==date('Y') ? 'selected' : '') ?> value="<?php echo $i;   ?>"><?php echo $i; ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
								<div class="col-lg-2 col-md-12">
									<label>Payment Type</label>
									<input type="text" class="form-control input-sm" readonly value="Salary" name="payment_type"/>
								</div>
								<div class="col-lg-2 col-md-12">
									<label> &nbsp;</label><br/>
									<button class="btn btn-success " type="submit">Generate Payment</button>
								</div>
							</div>
						</form>
					 </div>
			 </div>
			 
<?php  if(count($_POST)>0) {
				$m = explode("=>",$_POST['month']);
			?>
		<form action="<?php echo base_url('dashboard/processnewsalarypayment') ?>" method="post">
		<input type="hidden" value="<?php echo $_POST['year']  ?>" name="year"/>
		<input type="hidden" value="<?php echo $m[0];  ?>" name="month"/>
		<input type="hidden" value="<?php echo $m[1];  ?>" name="month_no"/>
		<input type="hidden" value="<?php echo $_POST['payment_type'];  ?>" name="type"/>
			<div class="panel panel-default mt-4">
					  <div class="panel-heading">
					  Payment Generated	<button class="btn-sm btn btn-primary pull-right" type="submit">Submit Payment Generated</button>
				</div>
					  <div class="panel-body">
						<table class="table table-hover" id="table3">
							<thead>
                            <tr>
                                <th width="2%">#</th>
                                <th width="20%">Staff Name</th>
                                <th width="10%">Salary</th>
								<th width="13%">Loan Deduction</th>
								<th width="13%">Addition</th>
								<th width="13%">Deduction</th>
								<th width="10%">Net Pay</th>
								<th width="5%">Action</th>
                            </tr>
                        </thead>
						<tbody>
							<?php
	
									$employees = $this->db->select("*,users.id as SN")->from("users")->where("role !=","Superuser")->get()->result_array();
									$num=1;
									$alltotal = 0;
									$total =0;
									foreach($employees as $employee){
									$total = 	$employee['salary'];
									$loan =false;
									if($loan != false){
									$total = $total - $loan['deduction'];
									$loan_template = '<input type="number" onkeyup="return calculate_nettotal(this);" value="'.$loan['deduction'].'" placeholder="Loan" class="loan_deduction form-control input-sm" name="loan_deduction['.$employee['SN'].']"/>';
									}else{
									$loan_template = '<input readonly type="number" value="0" placeholder="Loan" class="loan_deduction form-control input-sm" name="loan_deduction['.$employee['SN'].']"/>';
											
									}
									$alltotal = $alltotal+$total;
								?>
									<tr>
										<td align="left"><?php echo $num; ?></td>
										<td align="left"><?php echo $employee['firstname']; ?> <?php echo $employee['lastname']; ?></td>
										<td align="left"><input type="hidden" value="<?php echo $employee['salary'] ?>" name="salary[<?php echo $employee['SN']; ?>]"/><span class="salary" data-salary="<?php echo $employee['salary'] ?>"><?php echo number_format($employee['salary'],2) ?></span></td>
										<td align="left"><?php echo $loan_template ?></td>
										<td align="left"><input onchange="return calculate_nettotal(this);" onkeyup="return calculate_nettotal(this);" type="number" placeholder="Addition" class="addition form-control input-sm" name="addition[<?php echo $employee['SN'] ?>]"/></td>
										<td align="left"><input onchange="return calculate_nettotal(this);" onkeyup="return calculate_nettotal(this);" type="number" placeholder="Deduction" class="deduction form-control input-sm" name="deduction[<?php echo $employee['SN'] ?>]"/></td>
										<td align="left"><span class="net_pay" data-net_pay="<?php echo $total; ?>"><?php echo number_format($total); ?></span></td>
										<td> <a href="#" onclick="$(this).parent().parent().remove();" class="btn btn-danger btn-sm">Delete</a>
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
								<th></th>
								<th align="center">Total</th>
								<th align="center"><span id="total"><?php echo number_format($alltotal,2) ?></span></th>
								<th></th>
							</tr>
						</tfoot>
						</table>
					  </div>
					  <div class="panel-footer">
					  	<button class="btn btn-primary btn-sm" type="submit">Submit Payment Generated</button>
				
					  </div>
			</div>
	</form>
	<?php } ?>
		</div>
	</div>
</div>

<script>
function calculate_nettotal(obj){
	var parent = $(obj).parent().parent();
	var plus_total =0;
	var minus_total =0;
	var net_pay_ =0;
	var salary = parent.find('.salary');
	var loan_deduction = parent.find('.loan_deduction');
	var addition  = parent.find('.addition');
	var deduction = parent.find('.deduction');
	var net_pay = parent.find('.net_pay');
	
	plus_total = parseInt(salary.attr('data-salary')) + parseInt((addition.val()=="" ? 0 : addition.val()));
	minus_total = parseInt((loan_deduction.val()=="" ? 0 : loan_deduction.val())) + parseInt((deduction.val()=="" ? 0 : deduction.val()));
	
	net_pay_ = plus_total - minus_total;
	net_pay.html(net_pay_.toFixed(2));
	net_pay.attr('data-net_pay',net_pay_);
	getAlltotal();	
}


function getAlltotal(){
	var total =0;
	var tt =$('.net_pay');
	$('.net_pay').each(function(obj,span){
		total = total+ parseInt($(span).attr('data-net_pay'));
	});
	$("#total").html(total.toFixed(2));
}
</script>