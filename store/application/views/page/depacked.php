<?php
$stock = $this->stock->getStockByID($this->uri->segment(3));
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel panel-heading">De-pack / Convert <?php echo $stock['product_name'] ?> to Pieces </div>
            <div class="panel-body">
                <form action="" method="POST" onsubmit="return confirm('Are you sure you want depacked this product')">
                    <div class="form-group">
                        <label>No of Quantity to Convert</label>
                        <input type="number" required name="qty" max="<?php echo $stock['cartoon_qty'] ?>"  id="num"  placeholder="No of Quantity to Convert" autocomplete="off" class="input-sm form-control">
                    </div>
                    <div class="form-group">
                        <label>Add Extra Quantity</label>
                        <input type="number" name="extra_qty"  value="0" id="num"  placeholder="Add Extra Quantity to add to Pieces" autocomplete="off" class="input-sm form-control">
                    </div>
                    <div class="form-group xs-pt-10">
                        <input type="submit" value="Convert Product" class="btn btn-block btn-primary btn-xl">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>