<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading"><a href="<?php echo base_url('dashboard/stock') ?>" class="btn btn-sm btn-success">Back</a> Stock List(s)
                <div class="tools"></div>
            </div>
            <div class="panel-body">
                <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Batch ID</th>
                        <th>Expiry Date</th>
                        <th>Days Left</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stocks =$this->db->from("batch_product_table")->where("product_id",$this->uri->segment(3))->get();
                    $num =1;
                    foreach($stocks->result_array() as $stock){
                        ?>
                        <tr>
                            <td><?php echo $num; ?></td>
                            <td><?php echo $stock['batch_code'] ?></td>
                            <td><?php echo $stock['expiry_date'] ?></td>
                            <td><?php echo $this->utils->cal_days($stock['expiry_date']) ?> Days Left</td>
                            <td><?php echo $stock['quantity']?></td>

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