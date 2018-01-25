<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 20/01/2018
 * Time: 11:08
 */
?>

<head>
	<title>I MARTIA MATTINO</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/chartist/css/chartist-custom.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/chartist/css/chartist-custom.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url()?>assets/img/favicon.png">

    <!-- SCRIPTS -->

    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url()?>assets/scripts/klorofil-common.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/toastr/toastr.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/chartist/js/chartist.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="<?=site_url('');?>"><img src="<?php echo base_url()?>assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-user"></i> <span><?php $this->session->username = 'string';
							echo $this->session->username?>
                                </span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo site_url('logout');?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>