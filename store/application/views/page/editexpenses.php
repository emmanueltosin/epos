<?php
$expen = $this->db->get_where("tbl_expenses",array("SN"=>$this->uri->segment(3)))->row_array();
?>
<div class="col-lg-12">
								<div class="panel">
								<div class="panel panel-heading">Update </div>
								<div class="panel-body">
									<form action="" method="post" accept-charset="utf-8">
											<div class="form-group">
											<label>Expenses Title</label>
												<input type="text" value="<?php echo $expen['expense_purpose_title'] ?>" name="expense_purpose_title" autocomplete="OFF" value="" id="firstname"   required="" placeholder="Expenses Title" autocomplete="off" class="input-sm form-control">
											 </div>
											 <div class="form-group">
											<label>Date</label>
												<input type="text" value="<?php echo $expen['expense_date'] ?>" name="expense_date" autocomplete="OFF" value="" id="lastname"  required="" placeholder="Date" autocomplete="off" class="date input-sm form-control">
											 </div>
											  <div class="form-group">
											<label>Expenses Amount</label>
												<input type="number" value="<?php echo $expen['expense_total_amount'] ?>" name="expense_total_amount" autocomplete="OFF" value="" id="bank_name"  required="" placeholder="Expenses Amount" autocomplete="off" class="input-sm form-control">
											 </div>
                                            <div class="form-group">
                                            <label>Department</label>
                                            <select required class="form-control input-sm" name="department">
                                                <?php
                                                $dpts = $this->stock->getDepartments();
                                                $department = array(
                                                    'Store'=> array('Stock Officer'),
                                                    'Cinema'=>array('Sales Representative','Administrator'),
                                                );
                                                foreach($dpts as $dpt){
                                                    $department[$dpt['department']] = array('Sales Representative','Administrator');
                                                }
                                                ?>
                                                <option value="all">-Select-</option>
                                                <?php
                                                foreach($department as $key=>$dpt) {
                                                    if ($key != "Top Administrator") {
                                                        ?>
                                                        <option <?php echo $expen['department']==$key ? 'selected' : '' ?>  value="<?php echo $key ?>"><?php echo $key ?></option>
                                                    <?php }
                                                }?>
                                            </select>
                                        </div>
											 <div class="form-group">
											<label>Expenses Description</label>
											<textarea class="form-control" name="expense_purpose" placeholder="Expenses Description"><?php echo $expen['expense_purpose'] ?></textarea>
											</div>
											
											<div class="form-group xs-pt-10">
												<input type="submit" value="Update Expenses" class="btn btn-block btn-primary btn-xl">
											</div>
									</form>
								</div>
								</div>
							</div>