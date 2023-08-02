<h2 align="center">Pending Transaction</h2>
<hr/>
<table id="table3" class="table table-striped table-hover table-fw-widget">
    <thead>
    <tr>
        <th class="text-center"> Name</th>
        <th class="text-center"> ID </th>
        <th class="text-center"> Time </th>
        <th class="text-center"> No of Items </th>
        <th class="text-center"> Total </th>
        <th class="text-center"> Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach($carts as $cart){
           // if($cart['department'] == $this->stock->getUserDepartmentPos()) {
                ?>
                <tr>
                    <td><?php echo $cart['pending_cart_name'] ?></td>
                    <td><?php echo $cart['hold_id'] ?></td>
                    <td><?php echo $cart['time'] ?></td>
                    <td><?php echo @count($cart['items']) ?> Items</td>
                    <td><?php echo number_format($cart['total'], 2); ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary"
                           onclick="continue_cart('<?php echo $cart['hold_id'] ?>',this)">Continue</a>
                        <a href="#" class="btn btn-sm btn-danger"
                           onclick="delete_cart('<?php echo $cart['hold_id'] ?>',this)">Delete</a>
                    </td>

                </tr>
                <?php
         //   }
    }
    ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>
