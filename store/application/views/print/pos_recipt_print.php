<!DOCTYPE html><html class=''>
<head>
<link rel="stylesheet" href="<?php echo base_url('application/posfont/stylesheet.css'); ?>"/>
<style class="cp-pen-styles">
#invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 76mm;
  background: #FFF;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #000;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #000;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS h1 {
  font-size: 1.0em;
  color: #000;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS h2 {
  font-size: 0.9em;
  font-family: 'MyWebFont', Arial, sans-serif;
  padding:0px;
  margin-top:0px;
  margin-bottom:6px;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS p {
  font-size: 1.2em;
  color:#000;
  line-height: 1.2em;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */

  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS #top {

  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS #mid {
  min-height: 80px;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS #bot {
  min-height: 50px;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS #top .logo {

  width: 60px;
  background: url(images/head.png) no-repeat;
  background-size: 60px 60px;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
  background: url(images/head.png) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS .title {
  float: right;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS .title p {
  text-align: right;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS .tabletitle {
  font-size: .90em;
  font-family: 'MyWebFont', Arial, sans-serif;
  margin:0px;
  padding:0px;
}
#invoice-POS .service {
  font-family: 'MyWebFont', Arial, sans-serif;
 
}
#invoice-POS .item {
  width: 24mm;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS .itemtext {
  font-size: 0.80em;
  font-weight: 200;
  text-align:left;
  padding-bottom:10px;
  font-family: 'MyWebFont', Arial, sans-serif;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
  font-family: 'MyWebFont', Arial, sans-serif;
}
</style></head><body>

  <div id="invoice-POS" align="center">
     <div class="logo" style="margin-bottom:10px;"><center><img style="width:48mm;" src="<?php echo $this->settings->getSettings()['slogo'] ?>" alt="" width="60" /></center></div>
    
	  <div class="info" style="margin-top:-26px;margin-bottom:3px;">
		 <span style="font-size:13px;;margin-bottom:10px;"><?php echo $this->settings->getSettings()['saddress_1']  ?>
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
	  </span>
	  </div>
	  <div class="info" align="center"> 
        <span style="font-weight:bolder;font-size:15px;margin-bottom:10px; display:block;">Payment Receipt.</span>

            <span style="float:left;font-size:13px;;margin-bottom:6px;">Receipt ID : <?php echo $payment['reciept_id']  ?></span> <span style="float:right; font-size:13px;;margin-bottom:6px;">Date   : <?php echo $payment['date'];  ?></span>
           </br>
			<span style="float:left;font-size:13px;;margin-bottom:6px;">Time   : <?php echo $payment['sales_time']; ?></span>  
			 <span style="float:right;font-size:13px;;margin-bottom:6px;">Sales Rep  : <?php echo $this->users->get_user_by_id($payment['user_id'],1)->username; ?></span>
			 <span style="float:right;font-size:13px;;margin-bottom:6px;">Branch : <?php
			 $username = $this->users->get_user_by_id($payment['user_id'],1)->username;
			
			 $bid = $this->users->get_user_by_username($username)->branch_id;
			 $branch_detail = $this->users->get_user_branch_by_id($bid);
 
			 if($branch_detail){
			   echo $branch_detail->branch_name;
			 }else{
			   echo "no branch";
			 } 
			 ?></span>
			 
           
			<?php if(is_numeric($payment['customer'])){  ?>
			<?php
			if($payment['customer'] > 0){
			$cuustomer = $this->settings->getCustomer($payment['customer']); 
			?>
			<span style="float:left;font-size:13px;">Customer Name :  <?php echo $cuustomer['firstname']  ?>  <?php echo $cuustomer['lastname']  ?></span>  <span style="float:right;font-size:13px;">Phone No : <?php echo $cuustomer['phone'] ?></span>
			<?php  } 
			} ?>
		 

	<br/>
	<hr/>  
    </div>

	<!--End Invoice Mid-->
    <div id="bot">
	<h6 style="font-family:MyWebFont; font-size:12px;margin-top:-4px;"align="center">Item(s) Bought</h6>
		<div id="table" style="margin-top:-22px;">
						<table>
						<tr class="tabletitle">
								<td class="Rate"><h2>Qty</h2></td>
								<td class="Rate"><h2 align="center">Item</h2></td>
								<td class="Rate"><h2>Price</h2></td>
								<td class="Rate"><h2>Total</h2></td>
							</tr>
							<?php
								$items = json_decode($payment['items'],true);
								foreach($items as $item){
							?>
							<tr class="service">
								<td class="tableitem itemtext"  style="max-width:1%;width:1%;text-align:left;"><?php echo $item['item_qty'];   ?></td>
								<td class="tableitem itemtext" style="max-width:54%;width:54%;text-align:left;"><?php echo ucwords(strtolower($item['item_name']))  ?></td>
								<td class="tableitem itemtext"  style="max-width:17%;width:17%;text-align:left"><?php echo number_format($item['item_price'],1);   ?></td>
								<td class="tableitem itemtext" style="max-width:10%;width:10%;text-align:right;">&#8358;<?php echo number_format($item['total'],1); ?></td>
							</tr>
							<?php
								}
							?>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Sub Total</h2></td>
								<td></td>
								<td class="payment"><h2>&#8358;<?php echo number_format(($payment['total_amount']),2); ?></h2></td>
								
							</tr>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Discount</h2></td>
								<td></td>
								<td class="payment"><h2>&#8358;<?php echo number_format($payment['discount'],2); ?></h2></td>
								
							</tr>
						
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>VAT</h2></td>
								<?php $vat = $payment['vat_amount'];
								?>
								<td></td>
								<td class="payment"><h2>&#8358;<?php echo number_format($vat,2); ?></h2></td>
							
							</tr>
							
						
							<tr class="tabletitle" style="display: none;">
								<td></td>
								<td class="Rate"><h2>S.Charge(<?php echo $payment['scharge'] ?>%)</h2></td>
								<?php $scharge =($payment['scharge']/100)*$payment['total_amount']; ?>
								<td></td>
								<td class="payment"><h2>&#8358;<?php echo number_format($scharge,2); ?></h2></td>
								
							</tr>
							
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Total</h2></td>
								<td></td>
								<?php $to_pay = ($payment['total_amount']-$payment['discount'])+($scharge+$vat); ?>
								<td class="payment"><h2>&#8358;<?php echo number_format($to_pay,2); ?></h2></td>
								
							</tr>
						</table>
		
		<div align="center" style="font-size:13px;"><?php
			$settings = $this->db->get_where("others",array("SN"=>"1"))->row_array();
			echo $settings['footer_rec'];
		?></div>		
	</div>
	</div>
  </div>
</body>
<script>
window.onload = function(){
window.print();
setTimeout(function(){
	window.close();
},1400)
}
</script>

</html>
