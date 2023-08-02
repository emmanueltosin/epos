<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default panel-table">
            <div class="panel-heading">Sales Representative Login Session</div>
            <div class="panel-body">
                <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Full name</th>
                        <th>Username</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $from = date('Y-m-1');
                    $to = date('Y-m-t');
                    $num = 1;
                    $sessions = $this->db->from('login_session')->where("date_ BETWEEN '$from' AND '$to' ")->order_by('SN','DESC')->get()->result_array();
                    foreach($sessions as $session) {
                        ?>
                        <tr>
                            <td><?php echo $num; ?></td>
                            <td><?php echo $session['fullname'] ?></td>
                            <td><?php echo $session['username'] ?></td>
                            <td><?php echo $session['department'] ?></td>
                            <td><?php echo $session['role'] ?></td>
                            <td><?php echo $session['date_'] ?></td>
                            <td><?php echo $session['time'] ?></td>
                            <td><?php echo $session['status'] ?></td>
                            <td>
                                <?php
                                if($session['status'] != "APPROVED") {
                                    ?>
                                    <a href="<?php echo base_url('dashboard/approve_session/'.$session['SN']) ?>" class="btn btn-success">Approved Session</a>
                                    <?php
                                }else {
                                    ?>
                                    <a href="<?php echo base_url('dashboard/decline_session/'.$session['SN']) ?>" class="btn btn-danger">Decline Session</a>

                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $num++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>