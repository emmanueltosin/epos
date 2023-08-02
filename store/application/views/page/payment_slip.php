<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <?php
	$payment = $this->stock->getpaymentgeneratedbyid($this->uri->segment(3));
	$history = $this->stock->getpaymentgeneratedhistorybypaymentid($this->uri->segment(3));

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Slip</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="#" type="image/vnd.microsoft.icon" />
<link rel="stylesheet" type="text/css" href="<?php  echo base_url('assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css')  ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('assets/lib/material-design-icons/css/material-design-iconic-font.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('assets/lib/jqvmap/jqvmap.min.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php  echo base_url('assets/lib/summernote/summernote.css') ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php  echo base_url('assets/lib/select2/css/select2.min.css') ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/jquery.gritter/css/jquery.gritter.css')  ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/lib/jquery.gritter/css/jquery.gritter.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/lib/select2/css/select2.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url()  ?>css/Lobibox.min.css">
</head>
<body class="body" onload="window.print()" style="background:white;border:1px solid #c0c0c0;">
<div class="container" style="border-radius:5px;" >


		<div class="row">
		<div class="col-xs-12">
		<center>
		<img src="<?php echo $this->settings->getSettings()['slogo'] ?>" alt="">
		<address>
		<h4><b><?php echo $this->settings->getSettings()['saddress_1']  ?></b></h4>
		<?php
		if(!empty($this->settings->getSettings()['saddress_2'])){
		?><h4><b><?php echo $this->settings->getSettings()['saddress_2']  ?></b></h4>
		<?php
		}
		?>
		<?php
		if(!empty($this->settings->getSettings()['scontact_no'])){
		?><h4><b><?php echo $this->settings->getSettings()['scontact_no']  ?></b></h4>
		<?php
		}
		?>
		</address>
		</center>
		</div>
		</div>

	<h4 align="center"><b><?php echo strtoupper($payment['type']) ?> PAYMENT SLIP FOR <?php echo strtoupper($payment['month']).' '.$payment['year'] ?></b></h4>
	<table class="table" id="employee">
							<thead>
                            <tr>
                                <th>#</th>
                                <th>Staff Name</th>
								<th>Acount Name</th>
								<th>Bank</th>
								<th>Acount Number</th>
								<th>Net Pay</th>

                            </tr>
                        </thead>
						<tbody>
							<?php
								$num=1;
								$alltotal = 0;
								foreach($history as $payment){
									$emp = $this->db->get_where("users",array("id"=>$payment['employee_id']))->row_array();

									$addition = (((float)$payment['salary']) +((float)$payment['addition']));
									$deduction = (((float)$payment['deduction']) + ((float)$payment['loan_deduction']));
									$total = $addition - $deduction;
									$alltotal =$alltotal+$total;
							?>
								<tr>
									<td><?php echo $num; ?></td>
									<td><?php echo ucwords($emp['firstname']); ?> <?php echo ucwords($emp['lastname']); ?></td>
									<td><?php echo ucwords($emp['bank_account_name']) ?></td>
									<td><?php echo ucwords($emp['bank_name']) ?></td>
									<td><?php echo $emp['bank_account_no'] ?></td>
									<td><?php echo number_format($total,2); ?></td>
								</tr>
							<?php
								$num++;
								}
							?>
						</tbody>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th align="center"></th>
								<th align="center"><span id="total">Total :<?php echo number_format($alltotal,2) ?></span></th>

							</tr>
						 </table>

<div class="row">
	<div style="width:40%;display:inline-block;float:left;">
		<hr/>
		<center><b>Manager's Signature</b></center>
	</div>

	<div style="width:40%;isplay:inline-block; float:right">
		<hr/>
		<center><b>Accountant's Signature</b></center>
	</div>
</div>
</div>
</body>
</html>