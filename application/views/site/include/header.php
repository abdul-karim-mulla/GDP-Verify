<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.min.<?php echo $curr_lang; ?>.css" rel="stylesheet">

    <!-- Custom CSS -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        @media only screen and (min-width: 1000px) and (max-width: 1400px){.mxm_btn{width: 550px; font-size: 35px}}
        @media only screen and (min-width: 768px) and (max-width: 999px){.mxm_btn{width: 400px; font-size: 27px}}
        @media only screen and (min-width: 480px) and (max-width: 767px){.mxm_btn{width: 400px; font-size: 22px}}
        @media only screen and (max-width: 479px){ .mxm_btn{width: 300px; font-size: 18px}}
    </style>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse " style="margin-bottom: 0px" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/frontend/images/gdp-cert-logo<?php echo $curr_lang == "english"?"-en":"";?>.png">
                </a>
            </div>
            <div class="col-lg-8 text-center">
            <h1 style="margin-top: 37px;color: #fff;"><?php echo lang('CHECK_CERTIFICATE'); ?></h1>
            </div>
            <div class="col-lg-2">
                <img style="margin-top: 27px;" src="<?php echo base_url(); ?>assets/frontend/images/syria_wave.gif">
            </div>
        </div>

    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
