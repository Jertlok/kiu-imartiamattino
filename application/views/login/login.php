<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 19/01/2018
 * Time: 13:04
 */
?>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | I MARTIA MATTINO</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/toastr/toastr.min.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url()?>assets/img/favicon.png">
    <!-- scripts -->
    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/scripts/klorofil-common.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/toastr/toastr.min.js"></script>

</head>

<body>
<!-- WRAPPER -->
<?php
    if(isset($status) && $status === -1) {
        $str = <<<HTML
        <script>toastr.error('Username o password errati, riprova.');</script>
HTML;
        echo $str;
    }
?>

<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <div class="auth-box ">
                <div class="left">
                    <div class="content">
                        <div class="header">
                            <div class="logo text-center"><img src="<?php echo base_url()?>assets/img/logo-dark.png" alt="Klorofil Logo"></div>
                            <p class="lead">Accedi al tuo account</p>
                        </div>
                        <?php

                        echo form_open('login/signin');?>
                            <div class="form-group <?php if(form_error('username') != null) echo 'has-error';?>">
                                <label for="username" class="control-label sr-only">Username</label>
                                <input type="input" name="username" class="form-control" id="username" value="" placeholder="Username">
                            </div>
                            <div class="form-group <?php if(form_error('password') != null) echo 'has-error';?>">
                                <label for="password" class="control-label sr-only">Password</label>
                                <input type="password" name="password" class="form-control" id="password" value="" placeholder="Password">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">ACCEDI</button>
                        </form>
                    </div>
                </div>
                <div class="right">
                    <div class="overlay"></div>
                    <div class="content text">
                        <h1 class="heading">Piattaforma per la gestione di impianti di sensori</h1>
                        <p>Realizzata con il <i class="lnr lnr-heart" style="font-size: 0.73em;"></i> da I MARTIA MATTINO</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- END WRAPPER -->
</body>

</html>