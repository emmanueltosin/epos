<?php
$extra_charges=$this->db->get_where('others',array("SN"=>"1"))->row_array();
$track = $extra_charges['track_expiry_date'];
$date = strtotime('+ '.$track.' days');
$ex_date = date('Y-m-d',$date);
$batch_table = $this->db->from('batch_table')->where('status','unsorted')->where('expiry_date <',$ex_date)->get();
?>
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default panel-table">
            <div class="panel-heading">Stock Expiry Batch List(s)
           </div>
            <div class="panel-body">
                <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Batch ID</th>
                        <th>Expiry Date</th>
                        <th>Expired</th>
                        <th>No. of Product</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Command</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $num=1;
                    foreach($batch_table->result_array() as $batch){
                        ?>
                        <tr>
                            <td><?php echo $num; ?></td>
                            <td><?php echo $batch['batch_id'] ?></td>
                            <td><?php echo $batch['expiry_date'] ?></td>
                            <td><?php echo $this->utils->cal_days_($batch['expiry_date']) ?></td>
                            <td><?php echo $this->db->get_where('batch_product_table',array("batch_id"=>$batch['SN']))->num_rows(); ?> Product(s)</td>
                            <td><?php echo $batch['created'] ?></td>
                            <td><?php echo $batch['updated'] ?></td>
                            <td>
                                <a href="<?php echo base_url('dashboard/stock_expiry_product/'.$batch['SN']) ?>" class="btn btn-sm btn-primary">View Products</a>
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