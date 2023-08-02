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
        <h2>Deposit Receipt.</h2>
      <div class="info" >
        <h2>Transaction Information</h2>
        <p align="left" > 
            Receipt ID : <?php echo $payment['reciept_id']  ?></br>
            Date   : <?php echo $payment['date_added']  ?></br>
            Sales Rep  : <?php echo $this->users->get_user_by_id($payment['sales_rep'],1)->username; ?></br>
			<?php if(is_numeric($payment['customer_id'])){  ?>
			<?php  $cuustomer = $this->settings->getCustomer($payment['customer_id']); ?>
			Payment Method : <?php echo $this->db->get_where('payment_method',array('SN'=>$payment['payment_method']))->result_array()[0]['payment_method']; ?> <br/>
			Customer Name :  <?php echo $cuustomer['firstname']  ?>  <?php echo $cuustomer['lastname']  ?></br>
			Address : <?php echo $cuustomer['address'] ?><br>
    		Phone No : <?php echo $cuustomer['phone'] ?><br>
			<?php  } ?>
		 </p>
      </div>
    </div>
	</center>
	<?php $description = $this->db->get_where('deposit',array('SN'=>$payment['deposit_SN']))->result_array()[0]['deposit_for'] ?>
	<!--End Invoice Mid-->
    <div id="bot">
		<div id="table">
		<h3 align="center">Description</h3>
		<p align="center"><?php echo $description; ?></p>					
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
