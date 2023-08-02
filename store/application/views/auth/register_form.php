
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php  echo base_url(); ?>assets/img/logo-fav.png">
    <title>Beagle</title>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/css/style.css" type="text/css"/>
  </head>
   <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading"><img src="<?php  echo base_url(); ?>assets/img/logo-xx.png" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
              <div class="panel-body">
<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'required'=>"", 
		'placeholder'=>"Username", 
		'autocomplete'=>"off", 
		'class' =>"form-control"
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'required'=>"", 
	'placeholder'=>"E-mail", 
	'autocomplete'=>"off", 
	'class'=>"form-control"
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'required'=>"", 
	'class'=>"form-control",
	'placeholder'=>'Password'
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'required'=>"", 
	'class'=>"form-control",
	'placeholder'=>'Confirm Password'
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	'class' =>  'form-control',
	'placeholder'=> 'Captcha'
);
?>
<?php echo form_open($this->uri->uri_string()); ?>
		<div class="form-group">
            <?php echo form_input($username); ?>
		 </div>
		<div class="form-group">
             <?php echo form_input($email); ?>
		</div>
			<div class="form-group row signup-password">
                    <div class="col-xs-6">
                      <?php echo form_input($password); ?>
                    </div>
                    <div class="col-xs-6">
                      <?php echo form_input($confirm_password); ?>
                    </div>
                  </div>
	<div class="form-group xs-pt-10">
                    
					<?php echo form_submit(array('value'=>'Sign Up','type'=>"submit",'class'=>"btn btn-block btn-primary btn-xl")); ?>
                  </div>
	
			
<?php echo form_close(); ?>
</div>
            </div>
            <div class="splash-footer"><span>Already Sign Up <?php echo anchor('/auth/login/', 'Login here'); ?>
		</span></div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php  echo base_url(); ?>assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="<?php  echo base_url(); ?>assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="<?php  echo base_url(); ?>assets/js/main.js" type="text/javascript"></script>
    <script src="<?php  echo base_url(); ?>assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });
      
    </script>
  </body>
</html>