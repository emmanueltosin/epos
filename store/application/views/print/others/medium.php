<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
td{
padding:7px;
}
th{
font-size:10px;
}
body{
font-size:12px;
font-weight:20;
}
</style>
</head>
<?php
if(is_numeric($invoice['customer'])){
$customer = $this->settings->getCustomer($invoice['customer']);
}else{
$customer = $invoice['customer'];	
}
$reservation = $this->stock->getSale($invoice['reciept_id']);
$items = json_decode($invoice['items'],true);
$rep = $this->db->from("users")->where("id",$invoice['user_id'])->get()->result_array()[0];
?>
<body>
<div id="wrapper">
  <table border="1" width="800">
	<tr>
		<th width="50%" align="center" valign="top">
		<img src="http://localhost/pos/store_assets/newnewlogo.png"/> 
		<h3 align="center" style="margin-top:0px;">INFORMATION TECHNOLOGY</h3>
		</th>
		<td width="50%" valign="top">
			<?php echo $this->settings->getSettings()['saddress_1']  ?>
			<br/><?php echo $this->settings->getSettings()['saddress_1']  ?>
		<?php
		if(!empty($this->settings->getSettings()['saddress_2'])){
		?><br/><?php echo $this->settings->getSettings()['saddress_2']  ?>
		<?php
		}
		?>
		<?php
		if(!empty($this->settings->getSettings()['scontact_no'])){
		?><h2 style="margin-top:0px;">HOT LINE: <?php echo $this->settings->getSettings()['scontact_no']  ?><h2>
		<?php
		}
		?>
			
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table border="1" width="100%">
				<tr>
					<th>
						<h2 align="left" valign="top">BILL TO</h2>
						<h3 align="left" valign="top" style="margin-top:0px;"><?php echo ucwords($customer['firstname']) ?>  <?php echo ucwords($customer['lastname']) ?></h3>
					</th>
					<th>
						<h2 align="center">INVOICE NO.</h2>
						<h3> <?php echo $invoice['reciept_id'] ?></h3>
					</th>
				</tr>
				<tr>
					<td colspan="2">
						<table width="100%" border="1">
							<tr>
								<th>DATE</th>
								<th>SALESMAN</th>
								<th>TERMS</th>
							</tr>
							<tr>
								<td align="center">24/01/2019</td>
								<td align="center">AKEEM</td>
								<td align="center">CASH</td>
							</tr>
						</table>
					</td>
					<tr>
					<td colspan="2">
						<table width="100%" border="1">
							<tr>
								<th width="5%">SN</th>
								<th width="65%">DESCRIPTION</th>
								<th width="10%">PRICE</th>
								<th width="10%">QTY</th>
								<th width="10%">AMOUNT</th>
							</tr>
							<tr >
								<?php $alltotal=0;
										$num = 1;
													foreach($items as $item) {
														$info = $item;
														$alltotal+=$info['total'];
													?>
													<tr>
														<td><?php echo $num; ?></td>
														<td><?php  echo $item['item_name'] ?></td>
														<td><?php  echo number_format($item['item_price'],2) ?></td>
														<td><?php  echo $item['item_qty'] ?></td>
														<td><?php  echo number_format($item['total'],2); ?></td>
													</tr>
													<?php 
													$num++;
													} ?>
							</tr>
						</table>
					</td>
					</tr>
					<tr>
						<table width="100%">
							<tr>
								<td>
									<table width="100%">
										<tr>
											<td>AMOUNT IN WORDS <br/><br/><br/><br/><br/></td>
										</tr>
										<tr>
											<td style="font-size:9px;border:0.5px solid black; width:100px;">
												*Warranty services are rendered at the Manufacturer's Service Centres.<br>
												*For Warranty Service after Ninety (90)days from date of purchase, Customers<br>
												will br responsible for taking thier gadgets to the Manufacture's Service Centre.<br>
												*Please check Product Manual for Warranty terms and Conditions
												*No refund of money after payment.
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table width="100%" border="1">
										<tr>
											<td width="50%">
												GRAND TOTAL (=N=)
											</td>
											<td> <?php echo number_format($alltotal,2); ?>     </td>
										</tr>
										<tr>
											<td width="50%">
												ADVANCE PAYMENT
											</td>
											<td>    
											</td>
										</tr>
										<tr>
											<td width="50%">
											TO BALANCE
											</td>
											<td>  
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
							<td></td>
							</tr>
							<tr>
							<td></td>
							</tr>
							<tr>
							<td></td>
							</tr>
							<tr>
							<td></td>
							</tr>
							<tr>
							<td></td>
							</tr>
							<tr>
							<td></td>
							</tr>
							<tr>
							<td></td>
							</tr>
							<tr>
											<td>CUSTOMER _________________________________</td>
											<td>FEMTECH____________________________________</td>
										</tr>
							</tr>
						</table>
					</tr>
				</tr>
			</table>
		</td>
	</tr>
  </table>

</body>
</html>

