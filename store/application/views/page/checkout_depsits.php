<div class="row">
<?php $total_amt  = $this->stock->getTotalAmountDeposited($this->uri->segment(3),true); ?>
	<div class="col-sm-12">
	<div class="widget widget-fullwidth be-loading be-loading-active">
                <div class="widget-head">
                  <div class="tools">
                </div>
                <div class="widget-chart-container">
					<div style="height:490px;"
                 </div>
                <div class="be-spinner" style="width:35%;right:35%">
                 <center> <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                  </svg><br/><center>
				  <b>Initializing POS Terminal Worth <?php echo $total_amt; ?></b>
                </div>
              </div>	
	
	</div>
</div>