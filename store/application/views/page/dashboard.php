<?php

$total_stock = count($this->stock->getSellable(array("status"=>'1')));
$total_out_of_stock =count($this->stock->getStocksToRecieved()) - $total_stock;
$last_month = date('Y-m', strtotime('last month'));
$from= $last_month.'-'.date('27');
$to = date('Y').'-'.date('m').'-'."26";

$transfer= $this->stock->getStocktransfersBetween($from,$to);
$received= $this->stock->getStockrecievedBetween($from,$to);

//$total_in_stock = 
//constructing line chart from here
$months = array("January"=>"1", "February"=>"2", "March"=>"3", "April"=>"4", "May"=>"5",
    "June"=>"6", "July"=>"7",
    "August"=>"8","September"=>"9","October"=>"10","November"=>"11","December"=>"12");
$data = array();
foreach($months as $key=>$month){
    $current_month = date('Y').'-'.$month.'-'.'01';
    $start_ = date("Y-m",strtotime($current_month.' last month')).'-27';
    $stop_ = date("Y-".$month).'-26';
    $in = $this->stock->inReport($start_,$stop_);
    $out = $this->stock->outReport($start_,$stop_);
    $data['in'][] = $in;
    $data['out'][] = $out;
    $data['labels'][] = $key;
}

$data['color1'] = "#006400";
$data['color2'] = "#FF4500";

?>
<script>
    var data_in = JSON.parse('<?php  echo json_encode($data) ?>');
</script>
<?php
$from = date('Y').'-'.date('m').'-'.date('01');
$to = date('Y').'-'.date('m').'-'.date('t');
$yealy_produced = array();
$data_sales = array();
$labelsales = array();
foreach($months as $key=>$month){
    $payment = $this->invoice->getTotalIncome($month);
    $data_sales['payment'][] =$payment;
    $data_sales['labels'][] = $key;
}


?>
<script>
    var sales = JSON.parse('<?php  echo json_encode($data_sales) ?>');
</script>
<?php
$d = $this->users->get_user_by_username($this->session->userdata("username"))->department;
if($d=="Store" || $d=='Top Administrator'){
    ?>
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3"    onclick="location.href='<?php echo base_url('dashboard/stock')  ?>'">
            <div class="widget widget-tile">
                <div id="spark1" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                <div class="data-info">
                    <div class="desc" title="Stock">Stock</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="<?php  echo $total_stock; ?>" class="number"><?php  echo $total_stock; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3" style="cursor:pointer;" onclick="location.href='<?php echo base_url('dashboard/out_of_stock')  ?>'">
            <div class="widget widget-tile">
                <div id="spark2" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                <div class="data-info">
                    <div class="desc" title="Out of Stock">Out of Stock</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="<?php  echo $total_out_of_stock ; ?>" class="number"><?php  echo $total_out_of_stock; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if($d!="Store") {
            ?>
            <div class="col-xs-12 col-md-6 col-lg-3" style="cursor:pointer;"
                 onclick="location.href='<?php echo base_url('dashboard/settings') ?>'">
                <div class="widget widget-tile">
                    <div id="spark3" class="chart sparkline">
                        <canvas width="85" height="35"
                                style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas>
                    </div>
                    <div class="data-info">
                        <div class="desc" title="Monthly Received Report">Users</div>
                        <?php $emp = $this->db->from("users")->where("role !=", "Superuser")->get()->result_array(); ?>
                        <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span
                                    data-toggle="counter" data-end="<?php echo count($emp) ?>"
                                    class="number"><?php echo count($emp) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="col-xs-12 col-md-6 col-lg-3" style="cursor:pointer;" onclick="location.href='<?php echo base_url('dashboard/recieved_stock_report')  ?>'">
            <div class="widget widget-tile">
                <div id="spark4" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                <div class="data-info">
                    <div class="desc">Monthly Received Report</div>
                    <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span data-toggle="counter" data-end="<?php echo count($received) ?>" class="number"><?php echo count($received) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($d!="Store"){
?>
<div class="row">
    <div class="col-xs-12 col-md-6 col-lg-3" style="cursor:pointer;"
         onclick="location.href='<?php echo base_url('dashboard/sales') ?>'">
        <div class="widget widget-tile">
            <div id="spark4" class="chart sparkline">
                <canvas width="85" height="35"
                        style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas>
            </div>
            <div class="data-info">
                <?php
                $t_total_sales = $this->invoice->getDailyIncome(date('Y-m-d'));
                ?>
                <div class="desc">Today's Sales Report</div>
                <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span
                            data-toggle="counter" data-end="<?php echo $t_total_sales ?>"
                            class="number"><?php echo $t_total_sales ?></span>
                </div>
            </div>
        </div>
    </div>


    <?php
    }
    $d = $this->users->get_user_by_username($this->session->userdata("username"))->department;
    if( $d=='Top Administrator'){
        ?>
        <div class="col-xs-12 col-md-6 col-lg-3" onclick="location.href='<?php echo base_url('dashboard/bank_manager')  ?>'">
            <div class="widget widget-tile">
                <div id="spark3" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                <div class="data-info">
                    <?php
                    $getInvoices = $this->db->get('tbl_bank')->result_array();
                    ?>
                    <div class="desc" title="Monthly Received Report">Banks</div>
                    <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="<?php echo count($getInvoices) ?>" class="number"><?php echo count($getInvoices) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="widget widget-tile" onclick="location.href='<?php echo base_url('dashboard/stock_expiry')  ?>'">
                <div id="spark1" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                <div class="data-info">
                    <?php
                    $numberofgetexpiredproduct = $this->stock->numberofgetexpiredproduct();
                    ?>
                    <div class="desc" title="Stock">No Batch Expired Product</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="<?php  echo $numberofgetexpiredproduct; ?>" class="number"><?php  echo $numberofgetexpiredproduct; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if($d!="Store"){
    ?>
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="widget widget-tile">
            <div id="spark2" class="chart sparkline">
                <canvas width="85" height="35"
                        style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas>
            </div>
            <div class="data-info">
                <?php
                $months = array("01" => "January", "02" => "February", "03" => "March", "04" => "April", "05" => "May",
                    "06" => "June", "07" => "July",
                    "08" => "August", "09" => "September", "10" => "October", "11" => "November", "12" => "December");

                $total_paid_invoice = $this->invoice->getMonthRange(date("Y-m-01"), date("Y-m-t"));
                ?>
                <div class="desc" title="Out of Stock"><?php echo $months[date('m')] ?>'s Sales</div>
                <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span
                            data-toggle="counter" data-end="<?php echo $total_paid_invoice; ?>"
                            class="number"><?php echo $total_paid_invoice; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
$d = $this->users->get_user_by_username($this->session->userdata("username"))->department;
if($d!="Store") {
    ?>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="widget be-loading">
                <div class="widget-head">
                    <div class="tools"><span class="icon mdi mdi-refresh-sync toggle-loading"></span></div>
                    <div class="title">Sales Chart Report (Year : <?php echo date('Y') ?>)</div>
                </div>
                <div class="widget-chart-container">
                    <canvas id="sales_bar-chart"></canvas>
                </div>
                <div class="be-spinner">
                    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                        <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30"
                                class="circle"></circle>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
$d = $this->users->get_user_by_username($this->session->userdata("username"))->department;
if($d=="Store" || $d=="Top Administrator"){
    ?>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="widget be-loading">
                <div class="widget-head">
                    <div class="tools"><span class="icon mdi mdi-refresh-sync toggle-loading"></span></div>
                    <div class="title">Stock Movement Chart(In and Out Year : <?php echo date('Y') ?>)</div>
                </div>
                <div class="widget-chart-container">
                    <canvas id="bar-chart"></canvas>
                </div>
                <div class="be-spinner">
                    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                        <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>	
