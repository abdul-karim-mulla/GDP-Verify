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

    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/custom/css/style.css">
    <script src="<?php echo base_url(); ?>assets/custom/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom/js/jquery.timer.js"></script> -->
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <?php
    foreach($css_files as $file): ?>
    	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <?php foreach($js_files as $file): ?>
    	<script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

  </head>
 <body>