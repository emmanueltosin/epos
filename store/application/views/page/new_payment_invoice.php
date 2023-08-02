<?php 
$deposits = $this->db->get_where("supplier_invoice",array("supplier_id"=>$this->uri->segment(3)))->result_array()[0];
$supplier = $this->db->get_where("supplier",array("SN"=>$deposits['supplier']))->row_array();

?>
<div class="row">
	<div class="col-sm-12">
		<form action="" enctype="multipart/form-data" method="post" >
		<div class="panel">
			 <div class="panel-heading"><a href="<?php echo base_url('dashboard/view_invoice/'.$this->uri->segment(3)) ?>" class="btn btn-sm btn-success">Back</a> New Supplier Invoice Payment
                 <div class="tools"><button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-save"></i> Save</button></div>
              </div>
			  <div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group xs-mt-10">
                      <label for="product_name" class="col-sm-2 control-label">Supplier</label>
                      <div class="col-sm-8">
						<input type="text" value="<?php echo $supplier['supplier_name'] ?>" class="input-sm form-control" value="" disabled="disabled"/>
						<input type="hidden" name="supplier_id" value="<?php echo $deposits['supplier']; ?>"/>
						<input type="hidden" name="Invoice_SN" value="<?php echo $deposits['SN'] ?>"/>
						<input type="hidden" name="	invoice_id" value="<?php echo $deposits['supplier_id'] ?>"/>
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="product_name"  class="col-sm-2 control-label">Payment Date</label>
                      <div class="col-sm-8">
						<input id="date_available" required type="text" value="<?php echo date('Y-m-d') ?>" name="date_added" data-min-view="2" data-date-format="yyyy-mm-dd" placeholder="Date Available" class="date form-control input-sm">
					 </div>
                    </div>
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Amount Paid</label>
                      <div class="col-sm-8">
                        <input id="price" min="1" max="<?php echo ($deposits['total_invoice_amount'] -$this->stock->getInvoiceAmountpaid($deposits['SN'],false)) ?>" value="<?php echo ($deposits['total_invoice_amount'] -$this->stock->getInvoiceAmountpaid($deposits['SN'],false)) ?>" type="number" required name="amount"  placeholder="Amount Paid" class="form-control input-sm">
                      </div>
                    </div>

				
					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Bank</label>
                      <div class="col-sm-8">
                       <select required class="form-control input-sm" name="bank">
										<option value="">-Select One-</option>
										<?php  
										foreach($this->db->get("tbl_bank")->result_array() as $bank){
										?>
										<option value="<?php echo $bank['SN'] ?>"><?php echo $bank['bank_name'] ?>[<?php echo $bank['account_number'] ?>]</option>
										<?php
										}
										?>
									</select>
                      </div>
                    </div>

					<div class="form-group xs-mt-10">
                      <label for="price" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-8">
						<textarea placeholder="More Description" style="height:150px" class="form-control col-lg-12" name="description"></textarea>
					  </div>
					</div>
				</div>
			  </div>
		</div>
		</form>
	</div>
</div>