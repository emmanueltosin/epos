<script>
var rma_id = '<?php  echo $this->uri->segment(3) ?>';
</script>

<div class="row">
	<div class="col-sm-12">
	<div class="widget be-loading ">
	<form action="" method="post">
                <div class="widget-head">
                  <div class="tools">
				  <a href="<?php echo base_url("dashboard/mark_rma_as_completed/".$this->uri->segment(3)) ?>/<?php  echo $this->uri->segment(4); ?>" class="btn btn-primary btn-sm" type="submit" >Mark has Complete</a><span style="display:none" class="icon mdi mdi-refresh-sync toggle-loading"></span></div>
                  <div class="title">Return Merchandise Operation</div>
                </div>
                <div class="widget-chart-container">
				
				<div style="width:100%;height:300px;" id="rma_form_loader">
				
				</div>
				<button class="btn btn-success btn-sm" type="submit" name="btn" value="Draft">Save as Draft</button>
				
				</div>
                <div class="be-spinner">
                  <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                  </svg><br/>
				  
                </div>
				</form>
              </div>
	</div>

</div>