<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
                <div class="panel-heading">Void Sales #<?php echo $this->uri->segment(3) ?>
					 <div class="tools">
					 </div>
				</div>
				<form onsubmit="return confirm('Are you sure you want to cancel this transaction?, this can not be reversed.')" action="<?php echo base_url("dashboard/delete_sales/".$this->uri->segment(3)) ?>" method="post">
					<div class="panel-body">
						<div class="form-horizontal">
							
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label">Reason</label>
							  <div class="col-sm-10">
									<textarea class="form-control" required name="reason" placeholder="Void Reason"></textarea>
								</div>
							</div>
						
							<div class="form-group xs-mt-10">
							  <label for="product_name" class="col-sm-2 control-label"></label>
							  <div class="col-sm-10">
							
								<button class="btn btn-danger" type="submit">Void/Cancel Sales</button>
							</div>
							</div>
							
						</div>
					</div>
				</form>
		</div>
	</div>
</div>