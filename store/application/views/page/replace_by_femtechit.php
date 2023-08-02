
<div class="form-group xs-pt-10">
	<label>Staff:</label>
	<input type="text" value="<?php echo $rma['data']['replace_femtech_staff'] ?>" class="form-control input-sm" placeholder="Replace Staff" name="replace_femtech_staff"/>
</div>
<div class="form-group xs-pt-10">
	<label>Replaced Date:</label>
	<input type="text" autocomplete="off" value="<?php echo ($rma['data']['replace_femtech_date']=="0000-00-00" ? '' : $rma['data']['replace_femtech_date'])  ?>" class="form-control input-sm date" name="replace_femtech_date" data-min-view="2" data-date-format="yyyy-mm-dd"  placeholder="Replace Date" class="date form-control input-sm"/>
</div>
<div class="form-group xs-pt-10">
	<label>Claiming Status:</label>
	<select class="form-control input-sm claiming_status" name="claim_status">
		<option value="">-Select One-</option>
		<option value="1" <?php echo ($rma['data']['claim_status']=="1" ? 'selected' : '')  ?>>Claimed from supplier</option>
		<option value="2" <?php echo ($rma['data']['claim_status']=="2" ? 'selected' : '')  ?>>Not Claimed</option>
	</select>
</div>
<?php
if($rma['data']['claim_status'] =="2"){
?>	
<div class="form-group xs-pt-10 bad" >
<div class="be-radio has-success inline">
                          <input type="radio" <?php  echo ($rma['data']['claim_status']=="2" ? 'checked="checked"' : '') ?> name="move_to_bad_product" value="1" id="move_to_bad_product">
                          <label for="radinsucc">Move to Bad Product</label>
                        </div>
</div>
<?php
}else{
?>
<div class="form-group xs-pt-10 bad"  style="display:none">
<div class="be-radio has-success inline">
                          <input type="radio" name="move_to_bad_product" value="1" id="move_to_bad_product">
                          <label for="radinsucc">Move to Bad Product</label>
                        </div>
</div>
<?php
}
?>