<div class="form-group xs-pt-10">
	<label>Warranty Status:</label>
	<select class="form-control input-sm warranty_engineering_status" name="warranty_status">
		<option value="">-Select One</option>
		<option value="Replaced" <?php echo ($rma['data']['warranty_status']=="Replaced" ? 'selected' : '') ?>>Replaced</option>
		<option value="Repaired" <?php echo ($rma['data']['warranty_status']=="Repaired" ? 'selected' : '') ?>>Repaired</option>
	</select>
</div>

<div class="Replaced" style="display:none;">
	
	<div class="form-group xs-pt-10">
	<label>Date Replaced:</label>
	<input type="text" autocomplete="off" value="<?php  echo ($rma['data']['warranty_replaced_date']=="0000-00-00" ? '' : $rma['data']['warranty_replaced_date']) ?>" class="form-control input-sm date" name="warranty_replaced_date" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Replace Date" class="date form-control input-sm"/>
	</div>
	<div class="form-group xs-pt-10">
	<label>Replaced Supplier:</label>
	<input type="text"  class="form-control input-sm" value="<?php echo $rma['data']['supplier_warranty_replaced'] ?>" name="supplier_warranty_replaced" placeholder="Replaced Supplier" class="form-control input-sm"/>
	</div>
	<div class="form-group xs-pt-10">
	<label>Date Arrived:</label>
	<input type="text" autocomplete="off" value="<?php  echo ($rma['data']['warranty_date_arrived']=="0000-00-00" ? '' : $rma['data']['warranty_date_arrived']) ?>" class="form-control input-sm date" name="warranty_date_arrived" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Replace Date" class="date form-control input-sm"/>
	</div>
	<div class="form-group xs-pt-10">
	<label>Extra Note:</label>
	<textarea placeholder="Extra Note"  class="form-control input-sm" name="extra_warranty_replaced_note"><?php echo $rma['data']['extra_warranty_replaced_note'] ?></textarea>
	</div>
</div>
<div class="Repaired" style="display:none;">
	<div class="form-group xs-pt-10">
	<label>Date Repaired:</label>
	<input type="text" autocomplete="off" class="form-control input-sm date" value="<?php  echo ($rma['data']['warranty_repaired_date']=="0000-00-00" ? '' : $rma['data']['warranty_repaired_date']) ?>" name="warranty_repaired_date" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Replace Date" class="date form-control input-sm"/>
	</div>
	<div class="form-group xs-pt-10">
	<label>Warranty Engineer:</label>
	<input type="text"  class="form-control input-sm" name="warranty_engineer_repaired" value="<?php echo $rma['data']['warranty_engineer_repaired']  ?>" placeholder="Warranty Engineer" class="form-control input-sm"/>
	</div>
	<div class="form-group xs-pt-10">
	<label>Date Arrived:</label>
	<input type="text" autocomplete="off" class="form-control input-sm date" value="<?php  echo ($rma['data']['warranty_date_arrived']=="0000-00-00" ? '' : $rma['data']['warranty_date_arrived']) ?>" name="warranty_date_arrived" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Replace Date" class="date form-control input-sm"/>
	</div>
	<div class="form-group xs-pt-10">
	<label>Extra Note:</label>
	<textarea placeholder="Extra Note" class="form-control input-sm" name="extra_replaced_note"><?php echo $rma['data']['extra_warranty_replaced_note'] ?></textarea>
	</div>
</div>