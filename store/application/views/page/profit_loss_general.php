<div class="row">
<div class="col-sm-12">
	
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">General Profits and Expenses Report
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
                                <label>Department</label>
                                <select required class="form-control input-sm"  name="department">
                                    <?php
                                    $dpts = $this->stock->getDepartments();
                                    $department = array(
                                        'Store'=> array('Stock Officer'),
                                        'Cinema'=>array('Sales Representative','Administrator'),
                                        'Top Administrator'=> array('Top Administrator'),
                                    );
                                    foreach($dpts as $dpt){
                                        $department[$dpt['department']] = array('Sales Representative','Administrator');
                                    }
                                    ?>
                                    <option value="all">-Select-</option>
                                    <?php
                                    foreach($department as $key=>$dpt) {
                                        if ($key != "Top Administrator") {
                                            ?>
                                            <option <?php echo $_POST['department']==$key ? 'selected' : '' ?> value="<?php echo $key ?>"><?php echo $key ?></option>
                                        <?php }
                                    }?>
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
                                <label>Department</label>
                                <select required class="form-control input-sm" onchange="return show_role(this.value)" name="department">
                                    <?php
                                    $dpts = $this->stock->getDepartments();
                                    $department = array(
                                        'Store'=> array('Stock Officer'),
                                        'Cinema'=>array('Sales Representative','Administrator'),
                                        'Top Administrator'=> array('Top Administrator'),
                                    );
                                    foreach($dpts as $dpt){
                                        $department[$dpt['department']] = array('Sales Representative','Administrator');
                                    }
                                    ?>
                                    <option value="all">-Select-</option>
                                    <?php
                                    foreach($department as $key=>$dpt) {
                                        if ($key != "Top Administrator") {
                                            ?>
                                            <option  value="<?php echo $key ?>"><?php echo $key ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
						<?php
						}
						?>
							<div class="col-md-1"><label style="visibility: hidden;">To</label>
								<button class="btn btn-primary">Go</button>
								
							</div>
							
						</form>
				<?php
				if(isset($_POST['from'])){
								$from = $_POST['from'];
								$to = $_POST['to'];
								}else{
								$from =date('Y').'-'.date('m').'-'.date('01') ;
								$to = date('Y').'-'.date('m').'-'.date('t');
								}
                $filter =  array("status"=>"COMPLETE");
                $user_id = $this->tank_auth->get_user_id();
                $user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
                if($user['department'] !="Top Administrator"){
                    $filter['department'] = $user['department'];
                }else{
                    if(isset($_POST['from'])) {
                        if ($_POST['department'] != "all") {
                            $filter['department'] = $_POST['department'];
                        }
                    }
                }

				$ins = $this->stock->getSalesRange($from,$to,$filter);
			    $total_profit = 0;
				$total_vat = 0;
				$total_s_charge = 0;
				$total_discount = 0;
				$total_cost = 0;
				
				foreach($ins as $in){
					$total_discount+=$in['discount'];
					$total_profit +=$in['total_amount_paid'];
					$total_vat += $in['vat_amount'];
					$total_s_charge +=	$in['s_charge_amt'];
					
					$items = json_decode($in['items'],true);
					
					foreach($items as $item){
						$total_cost+=($item['cost_price']*$item['item_qty']);
					}
					
				}

				
				
				
				//expense
				$total_expenses = 0;
				$this->db->from("tbl_expenses");
                $this->db->where("expense_date BETWEEN '$from' AND '$to'");
                if(!empty($filter['department'])){
                    $this->db->where("department",$filter['department']);
                }
                $expense =  $this->db->get()->result_array();
				foreach($expense as $exp){
					$total_expenses+=$exp['expense_total_amount'];
				}
				?>				
				</div>
                </div>
				<div class="panel-body">
				<div class="container">
				<br/><br/>
					<br/><br/><br/><br/><br/>
					
				
							<div class="row">
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total Selling Price</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_profit,2) ?></h2>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total VAT</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_vat,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-3" style="display: none;">
								<div class="well">
								<h3 align="center">Total Service Charge</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_s_charge,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Net Revenue</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php $tt_in = $total_profit+$total_vat+$total_s_charge;   echo number_format(($total_profit+$total_vat+$total_s_charge),2); ?></h2>
								</div>
							</div>
					</div>
					<br/>
				
							<div class="row">
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total Cost</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_cost,2) ?></h2>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total Expenses</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_expenses,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Total Discount</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format($total_discount,2); ?></h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="well">
								<h3 align="center">Net Cost</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php $tt_cost=$total_discount+$total_expenses+$total_cost;  echo number_format(($total_discount+$total_expenses+$total_cost),2); ?></h2>
								</div>
							</div>
					</div>
				
				<br/>
					<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<div class="well">
								<h3 align="center">Profit</h3>
								<h2 align="center" style="font-weight:bolder;font-size:20px; height:60px;" ><?php  echo number_format(($tt_in - $tt_cost),2); ?></h2>
								</div>
					</div>
					<div class="col-sm-3"></div>
					</div>
				</div>				
				</div>
	
</div>
</div>