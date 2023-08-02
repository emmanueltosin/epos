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
<body onload="window.print();"><br/><br/>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>RECEIVED FORM</th><td></td>
		</tr>
		<tr>
			<th>ADDRESSS</th><td></td>
		</tr>
		<tr>
			<th>The Sum of (in words)</th><td></td>
		</tr>
		<tr>
			<th>BEING PAYMENT FOR</th><td></td>
		</tr>
		<tr>
			<
		</tr>
	</thead>
</table>
</body>
</html>