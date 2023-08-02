<form action="" method="post">
<h3>Customer RMA Replaced Form</h3>
</div>
	<div class="form-group xs-pt-10">
	<label>Replaced By:</label>
	<select class="form-control input-sm" required name="replaced_by" id="replaced_by" <?php  echo ($rma['data']['replaced_by']!="0" ? 'disabled' : '') ?> required>
		<option value="">-Select One-</option>
		<option value="1" <?php echo ($rma['data']['replaced_by']=="1" ? 'selected' : '') ?>>Replaced By Femtechit</option>
		<option value="2" <?php echo ($rma['data']['replaced_by']=="2" ? 'selected' : '') ?>>Replaced By Supplier</option>
	</select>
	</div>
	<div id="option_select">

	</div>
</form>