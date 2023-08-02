<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
td{
padding:7px;
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
								<td align="center"><?php echo $invoice['date'] ?></td>
								<td align="center"><?php echo ucwords($rep['username']) ?></td>
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
							<tr>
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
											<td>
											<div style="border-bottom:0.5px solid black; height:20px; width:100%; padding-top:4px; word-break:break-all; font-size:12px;font-weight:bold;">
											AMOUNT IN WORDS : <?php echo  strtoupper(num2words((int)$alltotal)); ?>
											</div>
											
											</td>
										</tr>
										<tr>
											<td style="font-size:11px;border:0.5px solid black; width:100px;">
												*Warranty services are rendered at the Manufacturer's Service Centres.<br>
												*For Warranty Service after Ninety (90)days from date of purchase, Customers<br>
												will br responsible for taking thier gadgets to the Manufacture's Service Centre.<br>
												*Please check Product Manual for Warranty terms and Conditions
												*No refund of money after payment.
											</td>
										</tr>
									</table>
								</td>
								<td valign="top">
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


<?php  
function num2words($num, $c=1) {
    $ZERO = 'zero';
    $MINUS = 'minus';
    $lowName = array(
         /* zero is shown as "" since it is never used in combined forms */
         /* 0 .. 19 */
         "", "one", "two", "three", "four", "five",
         "six", "seven", "eight", "nine", "ten",
         "eleven", "twelve", "thirteen", "fourteen", "fifteen",
         "sixteen", "seventeen", "eighteen", "nineteen");
   
    $tys = array(
         /* 0, 10, 20, 30 ... 90 */
         "", "", "twenty", "thirty", "forty", "fifty",
         "sixty", "seventy", "eighty", "ninety");
   
    $groupName = array(
         /* We only need up to a quintillion, since a long is about 9 * 10 ^ 18 */
         /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
         "", "hundred", "thousand", "million", "billion",
         "trillion", "quadrillion", "quintillion");
   
    $divisor = array(
         /* How many of this group is needed to form one of the succeeding group. */
         /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
         100, 10, 1000, 1000, 1000, 1000, 1000, 1000) ;
   
    $num = str_replace(",","",$num);
    $num = number_format($num,2,'.','');
    $cents = substr($num,strlen($num)-2,strlen($num)-1);
    $num = (int)$num;
   
    $s = "";
   
    if ( $num == 0 ) $s = $ZERO;
    $negative = ($num < 0 );
    if ( $negative ) $num = -$num;
    // Work least significant digit to most, right to left.
    // until high order part is all 0s.
    for ( $i=0; $num>0; $i++ ) {
       $remdr = (int)($num % $divisor[$i]);
       $num = $num / $divisor[$i];
       // check for 1100 .. 1999, 2100..2999, ... 5200..5999
       // but not 1000..1099,  2000..2099, ...
       // Special case written as fifty-nine hundred.
       // e.g. thousands digit is 1..5 and hundreds digit is 1..9
       // Only when no further higher order.
       if ( $i == 1 /* doing hundreds */ && 1 <= $num && $num <= 5 ){
           if ( $remdr > 0 ){
               $remdr = ($num * 10);
               $num = 0;
           } // end if
       } // end if
       if ( $remdr == 0 ){
           continue;
       }
       $t = "";
       if ( $remdr < 20 ){
           $t = $lowName[$remdr];
       }
       else if ( $remdr < 100 ){
           $units = (int)$remdr % 10;
           $tens = (int)$remdr / 10;
           $t = $tys [$tens];
           if ( $units != 0 ){
               $t .= "-" . $lowName[$units];
           }
       }else {
           $t = num2words($remdr, 0);
       }
       $s = $t." ".$groupName[$i]." ".$s;
       $num = (int)$num;
    } // end for
    $s = trim($s);
    if ( $negative ){
       $s = $MINUS . " " . $s;
    }
   
    if ($c == 1) $s .= (($cents/100)==0 ? '' : ($cents/100) )."  Naira Only";
   
    return $s;
} // end num2words
 ?>
</body>
</html>

