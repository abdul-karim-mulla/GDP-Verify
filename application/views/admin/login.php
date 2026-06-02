<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>GDP Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/lineicons/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/css/to-do.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/css/style-responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/css/aristo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/css/custom.css">

    <?php
    foreach($css_files as $file): ?>
    	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <?php foreach($js_files as $file): ?>
    	<script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
  </head>
 <body>

	  <div id="login-page">
	  	<div class="container">

		      <?php echo form_open("admin/login", array('class'=> 'form-login'));?>
		        <h2 class="form-login-heading">sign in now</h2>
                <?php if($message != '') : ?>
        			<div class="alert alert-danger alert-dismissible" role="alert">
        	            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	            <p class="text-center"><?php echo $message;?></p>
        	         </div>
                <?php endif; ?>
		        <div class="login-wrap">
		            <?php echo form_input($username);?>
                    <span id="helpBlock1" class="help-block red"></span>
		            <br>
		            <?php echo form_input($password);?>
                    <span id="helpBlock1" class="help-block red"></span>
                    <button class="btn btn-theme btn-block sign-in" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>

		            <div class="registration">
		                
		            </div>

		        </div>

		      <?php echo form_close();?>

	  	</div>
	  </div>

    <script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("<?php echo base_url(); ?>assets/dashboard/img/login-bg.jpg", {speed: 500});
    </script>

  </body>
</html>