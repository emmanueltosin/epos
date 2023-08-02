 <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
					<ul class="sidebar-elements">
						<li> <a href="<?php echo base_url(); ?>"><span class="icon mdi mdi-home"></span>Dashboard</a></li>
						 
							
							<li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Stock Manager</a>
							<ul class="sub-menu">
							   <li> <a href="<?php echo base_url('dashboard/stock'); ?>">Manage Stock</a></li>
							   <li> <a href="<?php echo base_url('dashboard/stock_transfer'); ?>">Transfer Stock</a></li>
							   <li> <a href="<?php echo base_url('dashboard/stock_expiry'); ?>">Expired Stock List</a></li>
							   <li> <a href="<?php echo base_url('dashboard/stock_recieved'); ?>">Received Stock</a></li>
                                <li> <a href="<?php echo base_url('dashboard/stock_recieved_single'); ?>">Received Single Stock</a></li>
							   <li> <a href="<?php echo base_url('dashboard/out_of_stock'); ?>">Out of Stock</a></li>
							  
							</ul>
							</li>
					
						
							<li class="parent"><a href="#"><span class="icon mdi mdi-chart-donut"></span>Stock Report</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/recieved_stock_report'); ?>">Received Stock Report</a></li>
							</ul>
							</li>
						
							
						
							
							<li class="parent"><a href="#"><span class="icon mdi mdi-settings"></span>Settings</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/barcode_page'); ?>">Generate Barcode</a></li>
								  <li> <a href="<?php echo base_url('dashboard/manufacturer'); ?>">Product Manufacturer</a></li>
								  <li> <a href="<?php echo base_url('dashboard/category'); ?>">Product Category</a></li>
								  <li> <a href="<?php echo base_url('dashboard/suppliers'); ?>">Suppliers</a></li>
							</ul>
							</li>
							
							<li>
                            <div class="dropdown-tools">
                              <div class="btn-group xs-mt-5 xs-mb-10">
                                <a href="<?php  echo base_url('auth/logout') ?>"   class="btn btn-default"><span class="mdi mdi-power"></span></a>
                                <a href="<?php  echo base_url('dashboard/myprofile') ?>"  class="btn btn-default active"><span class="mdi mdi-face"></span></a>
                              </div>
                            </div>
                          </li>
						 
					</ul>
			  </div>
			</div>
		  </div>
		</div>
	</div>