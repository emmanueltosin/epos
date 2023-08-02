<div class="row">
<div class="col-sm-12">
	<?php
	$user_id = $this->tank_auth->get_user_id();
	$user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
    $movies = $this->stock->getMovies();
	?>
	 <div class="panel panel-default panel-table">
                <div class="panel-heading">Movie List(s)
                </div>
				<div class="panel-body" style="padding: 30px;">
				 <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
					  <th>#</th>
                      <th>Code</th>
					  <th>Title</th>
                      <th>Category</th>
					  <th>Date</th>
					  <th>Time</th>
					  <th>Duration</th>
                      <th>Last Updated</th>
					  <th>Command</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $num = 1;
                    foreach($movies as $movie) {
                        ?>
                        <tr>
                            <td><?php echo $num; ?></td>
                            <td><?php echo $movie['moviecode']; ?></td>
                            <td><?php echo $movie['title']; ?></td>
                            <td><?php echo $this->db->get_where("service_category",array("SN"=>$movie['category']))->row()->name ?></td>
                            <td><?php echo $movie['moviedate']; ?></td>
                            <td><?php echo $movie['movietime']; ?></td>
                            <td><?php echo $movie['duration']; ?></td>
                            <td><?php echo $movie['updated']; ?></td>
                            <td>
                                <div class="btn-group btn-space">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="<?php echo base_url('dashboard/edit_movie/'.$movie['SN'] )  ?>">Edit</a></li>
                                        <li><a href="<?php echo base_url('dashboard/delete_movie/'.$movie['SN'] )  ?>">Delete</a></li>
                                        <li><a href="<?php echo base_url('dashboard/show_movie/'.$movie['SN'] )  ?>">Show Movie</a></li>
                                    </ul>
                                </div>
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
