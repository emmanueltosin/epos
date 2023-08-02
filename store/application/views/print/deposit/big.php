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
if(is_numeric($payment['customer_id'])){
$customer = $this->settings->getCustomer($payment['customer_id']);
}else{
$customer = $payment['customer'];	
}
$reservation = $this->stock->getSale($payment['reciept_id']);
$items = array();
$rep = $this->db->from("users")->where("id",$payment['sales_rep'])->get()->result_array()[0];
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
			<h2>Deposit Receipt </h2><h3 class="pull-right"> # <?php echo $payment['reciept_id'] ?></h3>
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
						Date : <?php echo $payment['date_added'] ?><br/>
						Receipt No :<?php echo $payment['reciept_id'] ?><br/>
						Payment Method : <?php echo $this->db->get_where('payment_method',array('SN'=>$payment['payment_method']))->result_array()[0]['payment_method']; ?> <br/>
			</address>
    			</div>
				
				
    		</div>
    		
    	</div>
<?php $description = $this->db->get_where('deposit',array('SN'=>$payment['deposit_SN']))->result_array()[0]['deposit_for'] ?>
   
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-body">
    				<div class="table-responsive">
    					<h3 align="center">Description</h3>
						<p align="center"><?php echo $description; ?></p>		
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