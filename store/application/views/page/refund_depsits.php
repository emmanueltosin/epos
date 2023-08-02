<?php 
$deposits = $this->db->get_where("deposit",array("SN"=>$this->uri->segment(3)))->result_array()[0];
	
?>
<div class="row">
	<div class="col-sm-12">
		<form action="" enctype="multipart/form-data" method="post" >
		<div class="panel">
			 <div class="panel-heading">Refund Deposit
                 <div class="tools"><button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Update Deposit</button></div>
              </div>
			  <div class="panel-body">
				<div class="form-horizontal">
			<div class="form-group xs-mt-10">
                    <label for="product_name"  class="col-sm-2 control-label">Total to Be Refunded</label>
                    <div class="col-sm-8">
						<input required type="text" value="<?php echo $this->stock->getTotalAmountDeposited($this->uri->segment(3),true);  ?>"  name="amt_refunded" disabled class="date form-control input-sm">
					</div>
            </div>
			<div class="form-group xs-mt-10">
                    <label for="product_name"  class="col-sm-2 control-label">Date Refunded</label>
                    <div class="col-sm-8">
						<input required type="text" value="<?php echo date('Y-m-d') ?>" data-min-view="2" data-date-format="yyyy-mm-dd" id="date_refunded"  name="date_refunded" class="date form-control input-sm">
					</div>
            </div>
			<div class="form-group xs-mt-10">
                    <label for="product_name"  class="col-sm-2 control-label">Reason For Refund</label>
                    <div class="col-sm-8">
						<textarea class="form-control" name="reason_for_refund" placeholder="State Reason for refund"></textarea>
					</div>
            </div>
			
			</div>
			</div>
			
			
			
			</div>
			
			
		</form>
	</div>

</div>