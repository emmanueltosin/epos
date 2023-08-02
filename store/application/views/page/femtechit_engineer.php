
<div class="form-group xs-pt-10">
	<label>Sender:</label>
	<input type="text" class="form-control input-sm" value="<?php echo $rma['data']['staff'] ?>" placeholder="Received Staff" name="staff"/>
</div>
<div class="form-group xs-pt-10">
	<label>Send Date:</label>
	<input type="text" autocomplete="off" value="<?php echo ($rma['data']['send_date']=="0000-00-00" ? '' : $rma['data']['send_date']) ?>" class="form-control input-sm date" name="send_date" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Sending Date" class="date form-control input-sm"/>
</div>
<div class="form-group xs-pt-10">
	<label>Assigned Engineer:</label>
	<input type="text" class="form-control input-sm" value="<?php echo $rma['data']['assigned_engineer']  ?>" placeholder="Assigned Engineer" name="assigned_engineer"/>
</div>
<div class="form-group xs-pt-10">
	<label>Status:</label>
	<select class="form-control input-sm pro_status" name="pro_status">
		<option value="">-Select One-</option>
		<option value="Repaired" <?php echo ($rma['data']['pro_status']=="Repaired" ? 'selected' : '')  ?>>Repaired</option>
		<option value="Beyond-Repaired" <?php echo ($rma['data']['pro_status']=="Beyond-Repaired" ? 'selected' : '')  ?>>Beyond Repaired</option>
	</select>
</div>
<div class="Repaired" style="display:none">
<div class="form-group xs-pt-10">

</div>
</div>
<div class="Beyond-Repaired" style="display:none">
<div class="form-group xs-pt-10">
	<label>What's Next:</label>
	<select class="form-control input-sm whatsnext" name="whatsnext">
		<option value="">-Select One-</option>
		<option value="sent_to_warranty"  <?php echo ($rma['data']['whatsnext']=="sent_to_warranty" ? 'selected' : '')  ?>>Send to Warranty Engineer</option>		
		<option value="bad_product" <?php echo ($rma['data']['whatsnext']=="bad_product" ? 'selected' : '')  ?>>Moved to Bad Product</option>
	</select>
</div>
<div id="Send-to-Warranty" class="Send-to-Warranty">

</div>

</div>

