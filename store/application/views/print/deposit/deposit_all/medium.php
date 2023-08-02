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
body{
	font-size:10px;
}
h1,h2,h3,h4{
	font-size:13px;
}
.panel-title{
	font-size:13px;
}
</style>
</head>
<body  onload="window.print();">
<div class="">
<?php
if(is_numeric($payment['deposit']['customer_id'])){
$customer = $this->settings->getCustomer($payment['deposit']['customer_id']);
}else{
$customer = $payment['deposit']['customer'];	
}
$reservation = $this->stock->getSale($payment['deposit']['reciept_id']);
$items = array();
$rep = $this->db->from("users")->where("id",$payment['deposit']['sales_rep'])->get()->result_array()[0];
?>
<div class="container col-md-4" >
    <div class="row">
        <div class="col-xs-12">
				 			
		<div class="row">
		<center><div class="col-xs-12">
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
		</div></center>
		</div>
    	</div>		
    		<div class="invoice-title">
			<h2>Deposit Receipt </h2><h3 class="pull-right"> # <?php echo $payment['deposit']['reciept_id'] ?></h3>
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
						Payment Method : <?php echo $this->db->get_where('payment_method',array('SN'=>$payment['deposit']['payment_method']))->result_array()[0]['payment_method']; ?> <br/>
						Date : <?php echo $payment['deposit']['date_added'] ?><br/>
						Receipt No :<?php echo $payment['deposit']['reciept_id'] ?><br/>
						
    				</address>
    			</div>
				
				
    		</div>
    		
    	</div>
	<?php $description = $this->db->get_where('deposit',array('SN'=>$payment['deposit']['SN']))->result_array()[0]['deposit_for'] ?>
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-body">
				<h3 align="center">Description</h3>
							<p align="center"><?php echo $description; ?></p>
						<br/>
    				<div class="table-responsive">
    					
						<table class="table table-condensed table-bordered">
												<thead>
													<tr>
														<th class="text-center">Receipt ID</td>
														<th class="text-center">Date</td>
														<th class="text-center">Amount</td>
													</tr>
												</thead>
												<tbody>
													<?php
												$alltotal =0;
												foreach($payment['payment_history'] as $hit){	
												?>
													<tr>
														<td class="text-center"><?php echo $hit['reciept_id']  ?></td>
														<td class="text-center"><?php echo $hit['date_added'];   ?></td>
														<td class="text-right">&#8358;<?php $alltotal+=$hit['amount']; echo number_format($hit['amount'],2);   ?></td>
													</tr>
													<?php } ?>
												</tbody>
													<tfoot>
														<tr>
														
														<td></td>
												
												
														<th class="text-right">Sub Total</th>
														<th class="text-right">&#8358;<?php echo number_format($alltotal,2); ?></th>
														
													</tr>
													
													
													<tr>
														<td></td>
														<th class="text-right">Total</th>
														<th class="text-right">&#8358;<?php echo number_format($alltotal,2); ?></th>
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
</div>
</body>
</html>