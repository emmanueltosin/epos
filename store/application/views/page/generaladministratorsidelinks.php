<?php
$user_id = $this->tank_auth->get_user_id();
$user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
?>
<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li> <a href="<?php echo base_url(); ?>"><span class="icon mdi mdi-home"></span>Dashboard</a></li>
                        <li><a href="<?php echo base_url('dashboard/pos')  ?>"><span class="icon mdi mdi-shopping-cart-plus"></span>Open POS</a></li>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-shopping-cart"></span>Daily Sales Report</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('dashboard/sales')  ?>">Daily Sales List</a></li>
                            </ul>
                        </li>
                        <?php
                        if($user['department'] == "Cinema") {
                            $dpt = json_decode(json_encode(array('type'=>"Cinema",'department'=>'Cinema')));
                        }else{
                            $dpt = $this->db->get_where('department', array('department' => $user['department']))->row();
                        }
                        if($dpt->type =="Sales") {
                            ?>
                            <li class="parent"><a href="#"><span class="icon mdi mdi-format-list-numbered"></span>Stock
                                    Manager</a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo base_url('dashboard/stock'); ?>">Manage Stock</a></li>
                                    <li><a href="<?php echo base_url('dashboard/stock_expiry'); ?>">Expired Stock
                                            List</a></li>
                                    <li><a href="<?php echo base_url('dashboard/out_of_stock'); ?>">Out of Stock</a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="parent"><a href="#"><span class="icon mdi mdi-chart"></span>Sales Report</a>
                            <ul class="sub-menu">
                                <li> <a href="<?php echo base_url('dashboard/sales_report'); ?>">General Report</a></li>
                                <li> <a href="<?php echo base_url('dashboard/refund_report'); ?>">Refund/Return Report</a></li>
                                <!--<li> <a href="<?php echo base_url('dashboard/admin_refund_report'); ?>">Admin Pickup Report</a></li>-->
                                <li> <a href="<?php echo base_url('dashboard/report_customer'); ?>">Report By Customer</a></li>
                            </ul>
                        </li>
                        <?php
                        $de = $this->db->get_where('department',array('department'=>$user['department']))->row_array();
                        if($de['type'] == "Service") {
                            ?>
                            <li class="parent"><a href="#"><span class="icon mdi mdi-account-box-o"></span>Service
                                    Management</a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo base_url('dashboard/service_category') ?>">Service
                                            Category</a></li>
                                    <li><a href="<?php echo base_url('dashboard/new_service') ?>">New Service</a></li>
                                    <li><a href="<?php echo base_url('dashboard/list_service') ?>">List Service</a></li>
                                </ul>
                            </li>
                            <?php
                        }

                        ?>
                        <?php
                        if($user['department'] == "Cinema") {
                            ?>

                            <li class="parent"><a href="#"><span class="icon mdi mdi-movie"></span>Movies Management</a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo base_url('dashboard/genre')  ?>">Genre</a></li>
                                    <li><a href="<?php echo base_url('dashboard/new_movies')  ?>">New Movies</a></li>
                                    <li><a href="<?php echo base_url('dashboard/movies')  ?>">List Movies</a></li>
                                    <li><a href="<?php echo base_url('dashboard/list_shows')  ?>">List Movie Shows</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if($dpt->type =="Sales") {
                            ?>
                            <li class="parent"><a href="#"><span class="icon mdi mdi-settings"></span>Settings</a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo base_url('dashboard/barcode_page'); ?>">Generate Barcode</a>
                                    </li>
                                    <li><a href="<?php echo base_url('dashboard/manufacturer'); ?>">Product
                                            Manufacturer</a></li>
                                    <li><a href="<?php echo base_url('dashboard/category'); ?>">Product Category</a>
                                    </li>
                                    <li><a href="<?php echo base_url('dashboard/suppliers'); ?>">Suppliers</a></li>
                                </ul>
                            </li>

                        <?php
                        }
                        ?>
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