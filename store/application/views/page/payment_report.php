<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default panel-table">
            <div class="panel-heading">Payment Report List(s)
                <div class="tools">
                    <form method="post" class="form-horizontal" id="change_branch" action="">
                        <?php
                        ?>
                        <?php
                        if(isset($_POST['to']) && isset($_POST['from'])){
                            ?>
                            <div class="col-md-3">
                                <label>From</label>
                                <input value="<?php echo $_POST['from']  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>
                            </div>
                            <div class="col-md-3">
                                <label>To</label>
                                <input type="text" value="<?php echo $_POST['to']  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
                            </div>
                            <div class="col-md-3">
                                <label>Department</label>
                                <select required class="form-control input-sm"  name="department">
                                    <?php
                                    $dpts = $this->stock->getDepartments();
                                    $department = array(

                                    );
                                    foreach($dpts as $dpt){
                                        $department[$dpt['department']] = array('Sales Representative','Administrator');
                                    }
                                    ?>
                                    <option value="all">-Select-</option>
                                    <?php
                                    foreach($department as $key=>$dpt) {
                                        if ($key != "Administrator") {
                                            ?>
                                            <option <?php echo $_POST['department']==$key ? 'selected' : '' ?> value="<?php echo $key ?>"><?php echo $key ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="col-md-3">
                                <label>From</label>
                                <input value="<?php echo date('Y').'-'.date('m').'-'.date('d')  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>
                            </div>
                            <div class="col-md-3">
                                <label>To</label>
                                <input type="text" value="<?php echo date('Y').'-'.date('m').'-'.date('d')  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
                            </div>
                            <div class="col-md-3">
                                <label>Department</label>
                                <select required class="form-control input-sm" onchange="return show_role(this.value)" name="department">
                                    <?php
                                    $dpts = $this->stock->getDepartments();
                                    $department = array(

                                    );
                                    foreach($dpts as $dpt){
                                        $department[$dpt['department']] = array('Sales Representative','Administrator');
                                    }
                                    ?>
                                    <option value="all">-Select-</option>
                                    <?php
                                    foreach($department as $key=>$dpt) {
                                        if ($key != "Administrator") {
                                            ?>
                                            <option  value="<?php echo $key ?>"><?php echo $key ?></option>
                                        <?php }
                                    }?>
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
                <br/><br/><br/>
                <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                    <tr>
                        <th> Receipt ID </th>
                        <th> Department </th>
                        <th> Customer </th>
                        <th>Amount</th>
                        <th> Date </th>
                        <th> Sales Rep </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_POST['from'])){
                        $from = $_POST['from'];
                        $to = $_POST['to'];
                    }else{
                        $from =date('Y').'-'.date('m').'-'.date('d') ;
                        $to = date('Y').'-'.date('m').'-'.date('d');
                    }
                    $filter = array();
                    $user_id = $this->tank_auth->get_user_id();
                    $user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
                    if($this->stock->getUserDepartment() !="Top Administrator"){
                        $dpt = $user['department'];
                    }else{
                        if(isset($_POST['from'])) {
                            if ($_POST['department'] != "all") {
                                $dpt = $_POST['department'];
                            }else{
                                $dpt = false;
                            }
                        }else{
                            $dpt = false;
                        }
                    }

                    $total = 0;
                    if(isset($dpt)) {
                        $ins = $this->db->from("tbl_payment")->where('department', $dpt)->where("payment_date BETWEEN '$from' and '$to'")->get()->result_array();
                    }else {
                        $ins = $this->db->from("tbl_payment")->where("payment_date BETWEEN '$from' and '$to'")->get()->result_array();
                    }
                    foreach($ins as $in){
                        if(is_numeric($in['customer'])){
                            $customer = $this->settings->getCustomer($in['customer']);
                            $customer_name = $customer['firstname'].' '.$customer['lastname'];
                        }else{
                            $customer_name = $in['customer'];
                        }
                        $user =$this->users->get_user_by_id($in['user'],1);
                        $sales = $this->db->get_where('sales',['SN'=>$in['sales_id']])->row_array();
                        $total+=$in['amount'];
                        ?>
                        <tr>
                            <td><?php echo $sales['reciept_id'] ?></td>
                            <td><?php echo $sales['department'] ?></td>
                            <td><?php  echo  $customer_name ?></td>
                            <td><?php  echo  number_format($in['amount'],2) ?></td>
                            <td><?php echo $in['payment_date'] ?></td>
                            <td><?php echo $user->firstname ?> <?php echo $user->lastname ?> (<?php echo $user->username; ?>)</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo number_format($total,2) ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
