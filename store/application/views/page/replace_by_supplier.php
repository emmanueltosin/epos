<div class="form-group xs-pt-10">
	<label>Replaced Status:</label>
	<select class="form-control input-sm replaced_status" name="supplier_replaced_status">
		<option value="">-Select One-</option>
		<option value="1" <?php echo ($rma['data']['supplier_replaced_status']=="1" ? 'selected' : '')  ?>>Product Replaced</option>
		<option value="2" <?php echo ($rma['data']['supplier_replaced_status']=="2" ? 'selected' : '')  ?>>Product Replaced/Credit Note</option>
	</select>
	
	<div class="form-group xs-pt-10">
	<label>Staff:</label>
	<input type="text" value="<?php echo $rma['data']['supplier_replaced_staff']  ?>" class="form-control input-sm" placeholder="Replace Staff" name="supplier_replaced_staff"/>
	</div>
	<div class="form-group xs-pt-10">
		<label>Replaced Date:</label>
		<input type="text" autocomplete="off" value="<?php echo ($rma['data']['supplier_replaced_date']=="0000-00-00" ? '' : $rma['data']['supplier_replaced_date'])  ?>" class="form-control input-sm date" name="supplier_replaced_date" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Replace Date" class="date form-control input-sm"/>
	</div>
	<?php
	if($rma['data']['supplier_replaced_status']=="2"){
	?>
	<div class="bad" style="display:none;">
		<div class="form-group xs-pt-10">
		<label>Credit Note Information:</label>
		<textarea class="form-control input-sm" placeholder="More Information About the Credit Note" name="credit_note_information"><?php echo $rma['data']['credit_note_information']  ?></textarea>
		</div>
		
	</div>
	<?php
	}else{
	?>
	<div class="bad" style="display:none;">
		<div class="form-group xs-pt-10">
		<label>Credit Note Information:</label>
		<textarea class="form-control input-sm" placeholder="More Information About the Credit Note" name="credit_note_information"></textarea>
		</div>
		
	</div>
	<?php
	}
	?>
</div>	