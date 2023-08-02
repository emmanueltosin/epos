<div class="row">
<div class="col-sm-12">
	<?php
	$user_id = $this->tank_auth->get_user_id();
	$user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
    $this->db->from('movies_shows');
    if(count($_POST) >0){
        $this->db->where("date_ BETWEEN '$_POST[from]' and '$_POST[to]'");
    }else{
        $from = date('Y-m-d');
        $this->db->where("date_ BETWEEN '$from' and ' $from'");
    }
    $shows = $this->db->order_by('SN','DESC')->get()->result_array();
	?>
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Cinema Movie Show List(s)
                    <div class="tools">
                        <form method="post" class="form-horizontal" id="change_branch" action="">
                            <?php
                            ?>
                            <?php
                            if(isset($_POST['to']) && isset($_POST['from'])){
                                ?>
                                <div class="col-md-5">
                                    <label>From</label>
                                    <input value="<?php echo $_POST['from']  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>
                                </div>
                                <div class="col-md-5">
                                    <label>To</label>
                                    <input type="text" value="<?php echo $_POST['to']  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="col-md-5">
                                    <label>From</label>
                                    <input value="<?php echo date('Y').'-'.date('m').'-'.date('d')  ?>" type="text" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="from" id="datetimepicker" placeholder="From" class="form-control input-sm datetimepicker" name="from required"/>
                                </div>
                                <div class="col-md-5">
                                    <label>To</label>
                                    <input type="text" value="<?php echo date('Y').'-'.date('m').'-'.date('d')  ?>" style="padding-left:10px;" data-min-view="2" data-date-format="yyyy-mm-dd" name="to" id="datetimepicker" placeholder="To" class="form-control input-sm datetimepicker" name="to" required/>
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
				<div class="panel-body" style="padding: 30px;">
				 <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
					  <th>#</th>
                      <th>Code</th>
					  <th>Movie Title</th>
                      <th>Ticket Price</th>
                      <th>No Of Seats / Tickets</th>
                      <th>Total Quantity Sold</th>
                      <th>Total Sold</th>
					  <th>Show Date</th>
					  <th>Show Time</th>
					  <th>Command</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $num = 1;
                    $total =0;
                    foreach($shows as $show) {
                        $movie = $this->db->get_where('movies',array('SN'=>$show['movie_id']))->row_array();
                        $total+=$show['qty_sold']*$show['price'];
                        ?>
                        <tr>
                            <td><?php echo $num; ?></td>
                            <td><?php echo $movie['moviecode']; ?></td>
                            <td><?php echo $movie['title']; ?></td>
                            <td>N<?php echo number_format($show['price'],1); ?></td>
                            <td><?php echo $show['seats']; ?> Tickets / Seats</td>
                            <td><?php echo $show['qty_sold']; ?> Ticket Sold</td>
                            <td>N<?php echo number_format(($show['qty_sold']*$show['price']),2) ?></td>
                            <td><?php echo $show['date_']; ?></td>
                            <td><?php echo $show['time_']; ?></td>
                            <td>
                                <?php
                                    if(time() < strtotime($show['date_'].' '.$show['time_'])) {
                                        if($show['qty_sold'] == '0') {
                                            ?>
                                            <a href="<?php echo base_url('dashboard/delete_show/' . $show['SN']) ?>"
                                               class="btn btn-sm btn-danger">Delete</a>
                                            <?php
                                        }else{
                                            echo 'No Action';
                                        }
                                    }else {
                                        ?>
                                        No Action
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
                     <tfoot>
                     <tr>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td>N<?php echo number_format($total,2) ?></td>
                         <td></td>
                         <td></td>
                     </tr>
                     </tfoot>
				</table>
				</div>

</div>
</div>
