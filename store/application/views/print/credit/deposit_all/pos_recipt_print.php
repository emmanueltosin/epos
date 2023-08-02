
<!DOCTYPE html><html class=''>
<head>


<style class="cp-pen-styles">
#invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 76mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #000;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #000;
}
#invoice-POS h1 {
  font-size: 1.2em;
  color: #000;
}
#invoice-POS h2 {
  font-size: 1.2em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: 1.2em;
  color:#000;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 60px;
  width: 60px;
  background: url(images/head.png) no-repeat;
  background-size: 60px 60px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
  background: url(images/head.png) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .90em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: 0.90em;
  font-weight: 900;
  text-align:left;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}
</style></head><body>

  <div id="invoice-POS">
     <div class="logo"><center><img style="width:58mm;" src="<?php echo $this->settings->getSettings()['slogo'] ?>" alt="" width="60" /></center></div>
     <center id="top">
	  <div class="info">
	<p align="left">
		<br/><?php echo $this->settings->getSettings()['saddress_1']  ?>
		<?php
		if(!empty($this->settings->getSettings()['saddress_2'])){
		?><br/><?php echo $this->settings->getSettings()['saddress_2']  ?>
		<?php
		}
		?>
		<?php
		if(!empty($this->settings->getSettings()['scontact_no'])){
		?><br/><?php echo $this->settings->getSettings()['scontact_no']  ?>
		<?php
		}
		?>
	  </p>
	  </div>
	  </center>
	  <center id="top">
	  <div class="info"> 
        <h2>Payment Receipt.</h2>
      <div class="info" >
        <h2>Transaction Information</h2>
        <p align="left" > 
            Credit ID : <?php echo $payment['deposit']['credit_id']  ?></br>
            Date   : <?php echo $payment['deposit']['date']  ?></br>
            Sales Rep  : <?php echo $this->users->get_user_by_id($payment['deposit']['user_id'],1)->username; ?></br>
			<?php if(is_numeric($payment['deposit']['customer'])){  ?>
			<?php  $cuustomer = $this->settings->getCustomer($payment['deposit']['customer']); ?>
			Payment Method : <?php echo $this->db->get_where('payment_method',array('SN'=>$payment['deposit']['payment_method']))->result_array()[0]['payment_method']; ?> <br/>
			Customer Name :  <?php echo $cuustomer['firstname']  ?>  <?php echo $cuustomer['lastname']  ?></br>
			Address : <?php echo $cuustomer['address'] ?><br>
    		Phone No : <?php echo $cuustomer['phone'] ?><br>
			<?php  } ?>
		 </p>
      </div>
    </div>
	</center>
	<div id="bot">
	<h3 align="center"><b>Payment History</b></h3>
	<div id="table">
		<table>
							<tr class="tabletitle">
								<td class="item"><h3>Receipt ID</h3></td>
								<td class="Hours"><h3>Date</h3></td>
								<td class="Hours"><h3>Amount</h3></td>
							</tr>
							<?php
							$total =0;
							foreach($payment['payment_history'] as $hit){	
							?>
							<tr class="service">
								<td class="tableitem"><p class="itemtext"><?php echo $hit['reciept_id']  ?></p></td>
								<td class="tableitem"><p class="itemtext"><?php echo $hit['date_added'];   ?></p></td>
								<td class="tableitem"><p class="itemtext">&#8358;<?php $total+=$hit['amount']; echo number_format($hit['amount'],2);   ?></p></td>
							</tr>
							<?php
							}	
							?>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Sub Total</h2></td>
								<td class="payment"><h2>&#8358;<?php echo number_format(($total),2); ?></h2></td>
								
							</tr>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2> Total</h2></td>
								<td class="payment"><h2>&#8358;<?php echo number_format(($total),2); ?></h2></td>
								
							</tr>
						</table>
	</div>
	</div>
	<?php $payment = $this->db->get_where('tbl_credit_sales',array('SN'=>$payment['deposit']['SN']))->result_array()[0]; ?><!--End Invoice Mid-->
    <div id="bot">
	<h3 align="center"><b>Product Items</b></h3>
	<div id="table">
						<table>
							<tr class="tabletitle">
								<td class="item"><h3>Item</h3></td>
								<td class="Hours"><h3>Qty</h3></td>
								<td class="Hours"><h3>Price</h3></td>
								<td class="Rate"><h3>Total</h3></td>
							</tr>
							<?php
								$items = json_decode($payment['items'],true);
								foreach($items as $item){
							?>
							<tr class="service">
								<td class="tableitem"><p class="itemtext"><?php echo $item['item_name']  ?></p></td>
								<td class="tableitem"><p class="itemtext"><?php echo $item['item_qty'];   ?></p></td>
								<td class="tableitem"><p class="itemtext">&#8358;<?php echo number_format($item['item_price'],2);   ?></p></td>
								<td class="tableitem"><p class="itemtext">&#8358;<?php echo number_format($item['total'],2); ?></p></td>
							</tr>
							<?php
								}
							?>
							<tr class="tabletitle">
								<td></td><td></td>
								<td class="Rate"><h2>Sub Total</h2></td>
								<td class="payment"><h2>&#8358;<?php echo number_format(($payment['total_amount']),2); ?></h2></td>
								
							</tr>
							<tr class="tabletitle">
								<td></td><td></td>
								<td class="Rate"><h2>Discount</h2></td>
								<td class="payment"><h2>&#8358;<?php echo number_format($payment['discount'],2); ?></h2></td>
								
							</tr>
							<tr class="tabletitle">
								<td></td><td></td>
								<td class="Rate"><h2>VAT(<?php echo $payment['vat'] ?>%)</h2></td>
								<?php $vat = ($payment['vat']/100)*$payment['total_amount'];
		  ?>
								<td class="payment"><h2>&#8358;<?php echo number_format($vat,2); ?></h2></td>
							
							</tr>
							<tr class="tabletitle">
								<td></td><td></td>
								<td class="Rate"><h2>S.Charge(<?php echo $payment['scharge'] ?>%)</h2></td>
								<?php $scharge =($payment['scharge']/100)*$payment['total_amount']; ?>
								<td class="payment"><h2>&#8358;<?php echo number_format($scharge,2); ?></h2></td>
								
							</tr>
							<tr class="tabletitle">
								<td></td><td></td>
								<td class="Rate"><h2>Total</h2></td>
								<?php $to_pay = ($payment['total_amount']-$payment['discount'])+($scharge+$vat); ?>
								<td class="payment"><h2>&#8358;<?php echo number_format($to_pay,2); ?></h2></td>
								
							</tr>
						</table>
	</div>
  </div>
  </div>
</body>
<script>
window.onload = function(){
window.print();
}
</script>

</html>
