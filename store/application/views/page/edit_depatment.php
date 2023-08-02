<div class="row">
    <div class="col-sm-6">

        <div class="col-lg-12">
            <div class="panel">
                <div class="panel panel-heading">Edit Department</div>
                <div class="panel-body">
                    <?php
                    $department = $this->db->get_where("department",array("SN"=>$this->uri->segment(3)))->row_array();
                    ?>
                    <form action=""  method="post">

                        <div class="form-group">
                            <div class="form-group">
                                <label>Name</label>
                                <input id="department" readonly value="<?php echo $department['department'] ?>" type="text" required name="department" placeholder="Department" class="form-control input-sm">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control input-sm"  required name="type">
                                    <option <?php echo ($department['type'] =="Service" ? 'selected' : '') ?> value="Service">Service</option>
                                    <option <?php echo ($department['type'] =="Sales" ? 'selected' : '') ?>  value="Sales">Sales</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <br/>
                            <button class="btn btn-primary" type="submit">Update Department</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>