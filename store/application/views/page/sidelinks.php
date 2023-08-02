<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li> <a href="<?php echo base_url(); ?>"><span class="icon mdi mdi-home"></span>Dashboard</a></li>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-shopping-cart"></span>Open POS</a>
                            <ul class="sub-menu">
                                <?php
                                $dpts = $this->stock->getDepartments();

/*
                                $department = array(
                                    'Cinema'=>array('Sales Representative','Administrator'),
                                );
*/

                                foreach($dpts as $dpt){
                                    $department[$dpt['department']] = array('Sales Representative','Administrator');
                                }
                                ?>
                                <?php
                                foreach($department as $key=>$dpt){
                                    ?>
                                    <li><a href="<?php echo base_url('dashboard/openPos/'.$key)  ?>"><?php echo $key ?></a></li>
                                <?php } ?>

                            </ul>
                        </li>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-shopping-cart"></span>Daily Sales Report</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('dashboard/sales')  ?>">Daily Sales List</a></li>
                                <!---->
                            </ul>
                        </li>
                       
							<li class="parent"><a href="#"><span class="icon mdi mdi-assignment"></span>Credit & Deposit</a>
							<ul class="sub-menu">
								<!--<li><a href="<?php //echo base_url('dashboard/deposits')  ?>">Deposits</a></li>-->
								<li><a href="<?php echo base_url('dashboard/credit')  ?>">Daily Credit Sales</a></li>
								<li><a href="<?php echo base_url('dashboard/due_payment_report')  ?>">Due Payment List</a></li>
							</ul>
							</li>
							
                        <li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Stock Manager</a>
                            <ul class="sub-menu">
                                <li> <a href="<?php echo base_url('dashboard/stock'); ?>">Manage Stock</a></li>
                                <li> <a href="<?php echo base_url('dashboard/new_stock'); ?>">New Stock</a></li>
                                <li> <a href="<?php echo base_url('dashboard/stock_by_department'); ?>">Stock By Department</a></li>
                                <li> <a href="<?php echo base_url('dashboard/stock_transfer'); ?>">Transfer Stock</a></li>
                                <li> <a href="<?php echo base_url('dashboard/stock_expiry'); ?>">Expired Stock List</a></li>
                                <li> <a href="<?php echo base_url('dashboard/stock_recieved'); ?>">Received Stock</a></li>
                                <li> <a href="<?php echo base_url('dashboard/stock_recieved_single'); ?>">Received Single Stock</a></li>
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
                                <li> <a href="<?php echo base_url('dashboard/refund_report'); ?>">Refund/Return Report</a></li>
                                <li> <a href="<?php echo base_url('dashboard/admin_refund_report'); ?>">Admin Pickup Report</a></li>
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
                        <li class="parent"><a href="#"><span class="icon mdi mdi-chart"></span>Profit/Loss Report</a>
                            <ul class="sub-menu">
                                <li> <a href="<?php echo base_url('dashboard/total_income_report'); ?>">Income Report</a></li>
                                <li> <a href="<?php echo base_url('dashboard/todays_profit'); ?>">Today's Profit and Expenses</a></li>
                                <li> <a href="<?php echo base_url('dashboard/by_sales_report'); ?>">Profit and Expenses</a></li>
                                <li> <a href="<?php echo base_url('dashboard/by_report_customer'); ?>">By Customer</a></li>
                                <li> <a href="<?php echo base_url('dashboard/by_report_sales_rep'); ?>">By Sales Rep</a></li>
                                <li> <a href="<?php echo base_url('dashboard/by_report_stock'); ?>">By Product/Stock</a></li>
                                <li> <a href="<?php echo base_url('dashboard/by_report_payment_method'); ?>">By Payment Method</a></li>
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
                        <li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Expenses</a>
                            <ul class="sub-menu">
                                <li> <a href="<?php echo base_url('dashboard/new_expenses'); ?>">New Expenses</a></li>
                                <li> <a href="<?php echo base_url('dashboard/expenses_report'); ?>">Today's Expenses</a></li>
                                <!-- <li> <a href="<?php echo base_url('dashboard/staff_salary'); ?>">Staff Salary</a></li>-->
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
                                <li> <a href="<?php echo base_url('dashboard/transfer_stock_report'); ?>">Transfer Stock Report</a></li>
                            </ul>
                        </li>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-movie"></span>Movies Management</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('dashboard/genre')  ?>">Genre</a></li>
                                <li><a href="<?php echo base_url('dashboard/new_movies')  ?>">New Movies</a></li>
                                <li><a href="<?php echo base_url('dashboard/movies')  ?>">List Movies</a></li>
                                <li><a href="<?php echo base_url('dashboard/list_shows')  ?>">List Movie Shows</a></li>
                            </ul>
                        </li>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-account-box-o"></span>Service Management</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('dashboard/service_category')  ?>">Service Category</a></li>
                                <li><a href="<?php echo base_url('dashboard/new_service')  ?>">New Service</a></li>
                                <li><a href="<?php echo base_url('dashboard/list_service')  ?>">List Service</a></li>
                            </ul>
                        </li>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Assets Management</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('dashboard/new_assets')  ?>">New Assets</a></li>
                                <li><a href="<?php echo base_url('dashboard/assets_list')  ?>">Assets List</a></li>
                            </ul>
                        </li>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-chart-donut"></span>Supplier Invoice</a>
                            <ul class="sub-menu">
                                <li> <a href="<?php echo base_url('dashboard/new_invoice'); ?>">New Invoice</a></li>
                                <li> <a href="<?php echo base_url('dashboard/supplier_invoice_report'); ?>">Invoice Report</a></li>
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
                        
                        <li class="parent"><a href="#"><span class="icon mdi mdi-settings"></span>Settings</a>
                            <ul class="sub-menu">
                                <li> <a href="<?php echo base_url('dashboard/branch'); ?>">Branch</a></li>
                                <li> <a href="<?php echo base_url('dashboard/backup'); ?>">Database Backup</a></li>
                                <li> <a href="<?php echo base_url('dashboard/barcode_page'); ?>">Generate Barcode</a></li>
                                <li> <a href="<?php echo base_url('dashboard/settings'); ?>">User Management</a></li>
                                <li> <a href="<?php echo base_url('dashboard/login_session'); ?>">Login Sessions</a></li>
                                <li> <a href="<?php echo base_url('dashboard/department'); ?>">Department</a></li>
                                <li> <a href="<?php echo base_url('dashboard/manufacturer'); ?>">Product Manufacturer</a></li>
                                <li> <a href="<?php echo base_url('dashboard/category'); ?>">Product Category</a></li>
                                <li> <a href="<?php echo base_url('dashboard/suppliers'); ?>">Suppliers</a></li>
                                <li> <a href="<?php echo base_url('dashboard/payment_method'); ?>">Payment Method</a></li>
                                <li> <a href="<?php echo base_url('dashboard/bank_manager'); ?>">Bank List</a></li>
                                <li> <a href="<?php echo base_url('dashboard/extra_charges'); ?>">Store Settings</a></li>
                                
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
