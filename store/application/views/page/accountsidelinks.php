 <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
					<ul class="sidebar-elements">
						<li> <a href="<?php echo base_url(); ?>"><span class="icon mdi mdi-home"></span>Dashboard</a></li>
							<li class="parent"><a href="#"><span class="icon mdi mdi-shopping-cart"></span>Daily Sales Report</a>
							<ul class="sub-menu">
								<li><a href="<?php echo base_url('dashboard/sales')  ?>">Daily Sales List</a></li>
								<!--<li><a href="<?php echo base_url('dashboard/invoices')  ?>">Daily Invoice List</a></li>-->
								</ul>
							</li>
							<!--
							<li class="parent"><a href="#"><span class="icon mdi mdi-assignment"></span>Deposit & Credit</a>
							<ul class="sub-menu">
								<li><a href="<?php echo base_url('dashboard/deposits')  ?>">Deposits</a></li>
								<li><a href="<?php echo base_url('dashboard/credit')  ?>">Credit Sales</a></li>
							</ul>
							</li>
							-->
							<li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Stock Manager</a>
							<ul class="sub-menu">
							   <li> <a href="<?php echo base_url('dashboard/stock'); ?>">Manage Stock</a></li>
							   <!--<li> <a href="<?php echo base_url('dashboard/stock_transfer'); ?>">Transfer Stock</a></li>-->
							   <li> <a href="<?php echo base_url('dashboard/stock_expiry'); ?>">Expired Stock List</a></li>
							   <li> <a href="<?php echo base_url('dashboard/stock_recieved'); ?>">Received Stock</a></li>
							   <li> <a href="<?php echo base_url('dashboard/out_of_stock'); ?>">Out of Stock</a></li>
							  
							</ul>
							</li>
							<li class="parent"><a href="#"><span class="icon mdi mdi-face"></span>Customer Manager</a>
							<ul class="sub-menu">
								 <li> <a href="<?php echo base_url('dashboard/customerlist'); ?>">Customers List</a></li>
							</ul>
							</li>
							<li class="parent"><a href="#"><span class="icon mdi mdi-chart"></span>Sales Report</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/sales_report'); ?>">General Report</a></li>
								  <li> <a href="<?php echo base_url('dashboard/refund_report'); ?>">Refund Report</a></li>
								  <li> <a href="<?php echo base_url('dashboard/report_customer'); ?>">Report By Customer</a></li>
								  <li> <a href="<?php echo base_url('dashboard/report_sales_rep'); ?>">Report By Sales Rep</a></li>
								  <li> <a href="<?php echo base_url('dashboard/report_stock'); ?>">Report By Product/Stock</a></li>
								  <li> <a href="<?php echo base_url('dashboard/report_payment_method'); ?>">Report Payment Method</a></li>
							</ul>
							</li>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-chart"></span>Payment Report</a>
                            <ul class="sub-menu">
                                <li> <a href="<?php echo base_url('dashboard/payment_report'); ?>">Payment Report</a></li>
                                <li> <a href="<?php echo base_url('dashboard/payment_report_user'); ?>">Payment Report by User</a></li>
                            </ul>
                        </li>
						<li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Assets Management</a>
							<ul class="sub-menu">
								<li><a href="<?php echo base_url('dashboard/new_assets')  ?>">New Assests</a></li>
								<li><a href="<?php echo base_url('dashboard/assets_list')  ?>">Assests List</a></li>
								</ul>
							</li>
							<!--
							<li class="parent"><a href="#"><span class="icon mdi mdi-chart-donut"></span>Deposit Report</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/deposit_report'); ?>">General Report</a></li>
								  <li> <a href="<?php echo base_url('dashboard/deposit_report_customer'); ?>">Report By Customer</a></li>
								  <li> <a href="<?php echo base_url('dashboard/deposit_report_sales_rep'); ?>">Report By Sales Rep</a></li>
								  <li> <a href="<?php echo base_url('dashboard/deposit_report_payment_method'); ?>">Report Payment Method</a></li>
							</ul>
							</li>
							-->
							<li class="parent"><a href="#"><span class="icon mdi mdi-chart-donut"></span>Credit Report</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/credit_reports'); ?>">General Report</a></li>
								  <li> <a href="<?php echo base_url('dashboard/credit_report_customer'); ?>">Report By Customer</a></li>
								  <li> <a href="<?php echo base_url('dashboard/credit_report_sales_rep'); ?>">Report By Sales Rep</a></li>
								  <li> <a href="<?php echo base_url('dashboard/credit_payment_report'); ?>">Credit Payment Report</a></li>
							</ul>
							</li>
							
							<!--
							<li class="parent"><a href="#"><span class="icon mdi mdi-chart-donut"></span>Invoice Report</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/invoice_report'); ?>">General Report</a></li>
								  <li> <a href="<?php echo base_url('dashboard/invoice_report_customer'); ?>">Report By Customer</a></li>
								  <li> <a href="<?php echo base_url('dashboard/invoice_report_sales_rep'); ?>">Report By Sales Rep</a></li>
							</ul>
							</li>
							-->
							<li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Expenses & Salary</a>
							<ul class="sub-menu">
							   <li> <a href="<?php echo base_url('dashboard/new_expenses'); ?>">New Expenses</a></li>
							   <li> <a href="<?php echo base_url('dashboard/expenses_report'); ?>">Today's Expenses</a></li>	
 							   <li> <a href="<?php echo base_url('dashboard/staff_salary'); ?>">Staff Salary</a></li>
							   <li> <a href="<?php echo base_url('dashboard/expenses_monthly_report'); ?>">Monthly Expenses</a></li>
															   
							</ul>
							</li>
							<li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Bank Credit & Debit</a>
							<ul class="sub-menu">
							   <li> <a href="<?php echo base_url('dashboard/new_entry'); ?>">Bank Deposit/Withdraw</a></li>
							   <li> <a href="<?php echo base_url('dashboard/deposit_credit_report'); ?>">Bank Deposit/Withdraw Report</a></li>																  
							</ul>
							</li>
							<li class="parent"><a href="#"><span class="icon mdi mdi-chart-donut"></span>Stock Report</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/recieved_stock_report'); ?>">Received Stock Report</a></li>
								 <!-- <li> <a href="<?php echo base_url('dashboard/transfer_stock_report'); ?>">Transfer Stock Report</a></li>-->
							</ul>
							</li>
							<!--
							<li class="parent"><a href="#"><span class="icon mdi mdi-chart-donut"></span>Deposit Report</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/deposit_report'); ?>">General Report</a></li>
								  <li> <a href="<?php echo base_url('dashboard/deposit_report_customer'); ?>">Report By Customer</a></li>
								  <li> <a href="<?php echo base_url('dashboard/deposit_report_sales_rep'); ?>">Report By Sales Rep</a></li>
								  <li> <a href="<?php echo base_url('dashboard/deposit_report_payment_method'); ?>">Report Payment Method</a></li>
							</ul>
							</li>
							
							<li class="parent"><a href="#"><span class="icon mdi mdi-chart-donut"></span>Credit Report</a>
							<ul class="sub-menu">
								  <li> <a href="<?php echo base_url('dashboard/credit_reports'); ?>">General Report</a></li>
								  <li> <a href="<?php echo base_url('dashboard/credit_report_customer'); ?>">Report By Customer</a></li>
								  <li> <a href="<?php echo base_url('dashboard/credit_report_sales_rep'); ?>">Report By Sales Rep</a></li>
								  <li> <a href="<?php echo base_url('dashboard/credit_report_payment_method'); ?>">Report Payment Method</a></li>
							</ul>
							</li>
							-->
						
							
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
