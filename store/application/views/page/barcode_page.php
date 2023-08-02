<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel panel-heading">Generate Bar code</div>
			<div class="panel-body">
				<form action="<?php echo base_url('dashboard/barcode')  ?>" method="POST" target="new">
					<div class="form-group">
						<label>No of Bar code to generate</label>
						<input type="number" name="num" min="5" value="" id="num" required="" placeholder="Bar code Number" autocomplete="off" class="input-sm form-control">
					</div>
					<div class="form-group xs-pt-10">
						<input type="submit" value="Generate Bar code" class="btn btn-block btn-primary btn-xl">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>