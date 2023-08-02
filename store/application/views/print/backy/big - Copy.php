<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo APP_NAME ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<base href="<?php echo base_url(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
	<link href="<?php echo base_url() ?>css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
<style>
#background{
    position:absolute;
    z-index:0;
    display:block;
    min-height:50%; 
    min-width:50%;
    color:yellow;
}

#content{
    position:absolute;
    z-index:1;
}

#bg-text
{
    color:lightgrey;
    font-size:22px;
    transform:rotate(300deg);
    -webkit-transform:rotate(300deg);
}
</style>
</head>
<body  onload="window.print();"><br/><br/>
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
<div class="container" >
    <div class="row">
        <div class="col-xs-12">
				 			
		<div class="row">
		<div class="col-xs-6">
		<img src="<?php echo $this->settings->getSettings()['slogo'] ?>" alt="">
		<address>
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
		</address>
		</div>
		</div>
    	</div>		
    		<div class="invoice-title">
			<h2>Sales Receipt </h2><h3 class="pull-right"> # <?php echo $invoice['reciept_id'] ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Sold To:</strong><br>
					<?php if(is_array($customer)){  ?>
    					<?php echo $customer['firstname'] ?>  <?php echo $customer['lastname'] ?><br>
    					<?php echo $customer['address'] ?><br>
    					<?php echo $customer['city'] ?><br>
    					<?php echo $customer['phone'] ?><br>
						<?php echo $customer['email'] ?>
					<?php }else{ ?>
					<?php  echo $customer ?>
					<?php } ?>
    				</address>
    			</div>
    			
				
				<div class="col-xs-6 ">
    				<address class="pull-right">
    				<strong>Sales Information:</strong><br>
    					Sales Rep : <?php echo ucwords($rep['username']) ?><br/>
						Payment Method : CASH <br/>
						Date : <?php echo $invoice['date'] ?><br/>
						Receipt No :<?php echo $invoice['reciept_id'] ?><br/>
    				</address>
    			</div>
				
				
    		</div>
    		
    	</div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Sales Summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed table-bordered">
												<thead>
													<tr>
														<th class="text-center">Item Name</td>
														<th class="text-center">Qty</td>
														<th class="text-center">Price</td>
														<th class="text-right">Total</th>
													</tr>
												</thead>
												<tbody>
													<?php $alltotal=0;
													foreach($items as $item) {
														$info = $item;
														$alltotal+=$info['total'];
													?>
													<tr>
														<td class="text-center"><?php  echo $item['item_name'] ?></td>
														<td class="text-center"><?php  echo $item['item_qty'] ?></td>
														<td class="text-center"><?php  echo number_format($item['item_price'],2) ?></td>
														<td class="text-right"><?php  echo number_format($item['total'],2); ?></td>
													</tr>
													<?php } ?>
												</tbody>
													<tfoot>
														<tr>
														
														<td></td>
														<td></td>
												
														<th class="text-right">Sub Total</th>
														<th class="text-right"><?php echo number_format($alltotal,2); ?></th>
														
													</tr>
													<tr>
														
														<td></td>
														<td></td>
													
														<th class="text-right">Discount</th>
														<th class="text-right"><?php echo number_format($reservation['discount'],2)  ?></th>
													</tr>
													<tr>
													
														<td></td>
														<td></td>
														
														<th class="text-right">VAT(<?php echo $reservation['vat'] ?>%)</th>
														<?php $vat = (($reservation['vat']/100) * $alltotal);  ?>
														
														<th class="text-right"><?php echo number_format($vat,2); ?></th>
													</tr>
													<tr>
													
														<td></td>
														<td></td>
													
														<th class="text-right">Charge(<?php echo $reservation['scharge'] ?>%)</th>
														<?php $charge = (($reservation['scharge']/100) * $alltotal);  ?>
														
														<th class="text-right"><?php echo number_format($charge,2); ?></th>
													</tr>
													<tr>
														<?php $alltotal=$alltotal-$reservation['discount']; ?>
														<?php $alltotal=$alltotal+$charge ?>
														<?php $alltotal=$alltotal+$vat ?>
														<td></td>
														<td></td>
													
														<th class="text-right">Total</th>
														<th class="text-right"><?php echo number_format($alltotal,2); ?></th>
													</tr>
													</tfoot>
												</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<?php
if(!isset($_GET['print'])){
?>
<script>
function warning(link){
var con =confirm("Are you sure..this can not be reversed..");
if(con== true){
		return true;
	}
	return false;
}	
</script>
<?php
}
?>
</body>
</html>