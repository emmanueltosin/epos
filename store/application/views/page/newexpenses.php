<div class="col-lg-12">
								<div class="panel">
								<div class="panel panel-heading">Add New Expenses</div>
								<div class="panel-body">
									<form action="" method="post" accept-charset="utf-8">
									<input type="hidden" name="user_id" value="<?php echo $this->users->get_user_by_username($this->session->userdata("username"))->SN; ?>"/>
											<div class="form-group">
											<label>Expenses Title</label>
												<input type="text" name="expense_purpose_title" autocomplete="OFF" value="" id="firstname"   required="" placeholder="Expenses Title" autocomplete="off" class="input-sm form-control">
											 </div>
											 <div class="form-group">
											<label>Date</label>
												<input type="text" name="expense_date"  autocomplete="OFF" value=""  data-min-view="2" data-date-format="yyyy-mm-dd"   required="" placeholder="Date" autocomplete="off" class="date input-sm form-control">
											 </div>
											  <div class="form-group">
											<label>Expenses Amount</label>
												<input type="number" name="expense_total_amount" steps=".00001" autocomplete="OFF" value="" id="bank_name"  required="" placeholder="Expenses Amount" autocomplete="off" class="input-sm form-control">
											 </div>
											 <div class="form-group">
                                                 <label>Department</label>
                                                 <select required class="form-control input-sm" onchange="return show_role(this.value)" name="department">
                                                     <?php
                                                     $dpts = $this->stock->getDepartments();
                                                     $department = array(
                                                         'Store'=> array('Stock Officer'),
                                                         'Cinema'=>array('Sales Representative','Administrator'),
                                                         'Top Administrator'=> array('Top Administrator'),
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
                                                             <option  value="<?php echo $key ?>"><?php echo $key ?></option>
                                                         <?php }
                                                     }?>
                                                 </select>
                                             </div>
											 <div class="form-group">
											<label>Expenses Description</label>
											<textarea class="form-control" name="expense_purpose" placeholder="Expenses Description"></textarea>
											</div>
											
											<div class="form-group xs-pt-10">
												<input type="submit" value="Add Expenses" class="btn btn-block btn-primary btn-xl">
											</div>
									</form>
								</div>
								</div>
							</div>