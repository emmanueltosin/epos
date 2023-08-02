<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default panel-table">
            <div class="panel-heading">Payment Report By Sales Rep
                <div class="tools">
                    <form method="post" class="form-horizontal" id="change_branch" action="">
                        <?php
                        ?>
                        <?php
                        if(isset($_POST['from'])){
                            ?>
                            <div class="col-md-3">
                                <label>From</label>
                                <input value="<?php echo $_POST['from']  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" id="datetimepicker" placeholder="From" class="form-control input-sm date" name="from"/>
                            </div>
                            <div class="col-md-3">
                                <label>To</label>
                                <input value="<?php echo $_POST['to']  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd"  id="datetimepicker" placeholder="From" class="form-control input-sm date" name="to"/>
                            </div>
                            <div class="col-md-4">
                                <label>Sales Rep</label>
                                <select name="customer_id" class="form-control  input-sm" id="customer_id">
                                    <?php
                                    $stocks = $this->db->from("users")->where("role !=","Superuser")->get()->result_array();
                                    foreach($stocks as $stock){
                                        ?>
                                        <option <?php echo ($stock['SN']==$_POST['customer_id'] ? 'selected' : '') ?> value="<?php echo $stock['SN'] ?>"><?php echo $stock['username'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="col-md-3">
                                <label>From</label>
                                <input value="<?php echo date('Y-m-d')?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from"/>
                            </div>
                            <div class="col-md-3">
                                <label>To</label>
                                <input value="<?php echo date('Y-m-d')?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="to"/>
                            </div>
                            <div class="col-md-4">
                                <label>Sales Rep</label>
                                <select name="customer_id" class="form-control  input-sm" id="customer_id">
                                    <?php
                                    $stocks = $this->db->from("users")->where("role !=","Superuser")->get()->result_array();
                                    foreach($stocks as $stock){
                                        ?>
                                        <option  value="<?php echo $stock['SN'] ?>"><?php echo $stock['username'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col-md-1"><label style="visibility: hidden;">To</label>
                            <button class="btn btn-primary">Go</button>

                        </div>

                    </form>

                </div>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <?php
                    if(isset($_POST['from'])){
                        $from = $_POST['from'];
                        $to = $_POST['to'];
                        $customer_id = $_POST['customer_id'];
                    }else{
                        $stocks = $this->db->from("users")->where("role !=","Superuser")->get()->result_array();
                        $from =date('Y').'-'.date('m').'-'.date('d') ;
                        $to = date('Y').'-'.date('m').'-'.date('d');
                        $customer_id = $stocks[0]['SN'];
                    }
                    $payment_methods = $this->db->from('payment_method')->where('payment_method !=','DEPOSIT')->where('payment_method !=','SPLIT PAYMENT')->get()->result_array();
                    $alltotal = 0;
                    foreach($payment_methods as $payment_method){
                        ?>

                        <br/><br/><br/>
                        <h3><?php echo $payment_method['payment_method'] ?> PAYMENT TRANSACTION</h3>
                        <table class="table table-striped table-hover table-fw-widget payment_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Receipt ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $num = 1;
                            $total = 0;
                            $reports = $this->db->from('tbl_payment')->where("payment_date BETWEEN '$from' and '$to'")->where('user',$customer_id)->where('payment_method_id',$payment_method['SN'])->get()->result_array();
                            foreach ($reports as $report) {
                                $total += $report['amount'];
                                $alltotal += $report['amount'];
                                if(is_numeric($report['customer'])){
                                    $customer = $this->settings->getCustomer($report['customer']);
                                    $customer_name = $customer['firstname'].' '.$customer['lastname'];
                                }else{
                                    $customer = $this->settings->getCustomer($report['customer']);
                                    $customer_name = $customer['firstname'].' '.$customer['lastname'];
                                }
                                $sales = $this->db->get_where('sales',['SN'=>$report['sales_id']])->row_array();
                                ?>
                                <tr>
                                    <td><?php echo $num; ?></td>
                                    <td><?php echo $sales['reciept_id']; ?></td>
                                    <td><?php echo $customer_name ?></td>
                                    <td><?php echo number_format($report['amount'],2) ?></td>
                                </tr>
                                <?php
                                $num++;
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <th>Total</th>
                                <td><?php echo number_format( $total,2) ?></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>

                        <?php
                    }
                    ?>
                    <br/>  <br/>
                    <h3><b>Grand Total : <?php echo number_format( $alltotal,2) ?></b></h3>
                    <br/>  <br/>
                </div>
            </div>
        </div>
    </div>
