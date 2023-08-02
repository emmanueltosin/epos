
<h3>RMA Engineering Form</h3>
</div>
	<div class="form-group xs-pt-10">
	<label>Which Engineer:</label>
	<select class="form-control input-sm" required name="which_engineer" id="which_engineer" required>
		<option value="">-Select One-</option>
		<option value="1" <?php  echo ($rma['data']['which_engineer']=="1" ? 'selected' : '') ?>>Femtechit Engineer</option>
		<option value="2" <?php  echo ($rma['data']['which_engineer']=="2" ? 'selected' : '') ?>>Warranty Engineer</option>
	</select>
	</div>
	<div id="option_select">

	</div>
