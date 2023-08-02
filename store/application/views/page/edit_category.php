<div class="row">
    <div class="col-sm-6">

        <div class="col-lg-12">
            <div class="panel">
                <div class="panel panel-heading">Edit Category</div>
                <div class="panel-body">
                    <form action=""  method="post">
                        <?php
                        $cat = $this->db->get_where("category",array("SN"=>$this->uri->segment(3)))->row_array();
                        ?>
                        <div class="form-group">
                            <label>Category</label>

                            <input id="manufacturer" type="text" value="<?php echo $cat['category'] ?>" required name="category" placeholder="Category" class="form-control input-sm">

                        </div>

                        <div class="form-group">
                            <label>VAT(%)</label>
                            <input id="vat" type="number" value="<?php echo $cat['vat'] ?>" required name="vat" placeholder="VAT" class="form-control input-sm">

                        </div>
                        <div class="col-sm-12">
                            <br/>
                            <button class="btn btn-primary" type="submit">Update Category</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>