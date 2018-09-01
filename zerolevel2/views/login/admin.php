<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- 
Develop by: 
Tim pengembang PTI Fakultas Teknik Unsrat
http://fatek.unsrat.ac.id
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Portal Fakultas Teknik Unsrat">
    <meta name="author" content="Tim PTI Fatek">
    <meta name="robots" content="noindex, nofollow">
    
    <title>Administrator Login | Portal Fakultas Teknik</title>
    
    <!-- Favicon-->
    <link href="<?php echo base_url("images/favicon.ico");?>" rel="icon" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url("assets/adminbsb/plugins/bootstrap/css/bootstrap.css");?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url("assets/adminbsb/plugins/node-waves/waves.css");?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url("assets/adminbsb/plugins/animate-css/animate.css");?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url("assets/adminbsb/css/style.css");?>" rel="stylesheet" />
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a>Administrasi<b>Fatek</b></a>
        </div>
        <div class="card">
            <div class="body">
                <?php echo form_open('login','id="sign_in"');?>
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <?php if($this->session->flashdata('message_login_adm')) {?>
							<div class="alert alert-warning"><?php echo $this->session->flashdata('message_login_adm');?></div>
							<?php }?>
                    <div class="row">

                        <div class="col-xs-12">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url("assets/adminbsb/plugins/jquery/jquery.min.js");?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url("assets/adminbsb/plugins/bootstrap/js/bootstrap.js");?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url("assets/adminbsb/plugins/node-waves/waves.js");?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url("assets/adminbsb/plugins/jquery-validation/jquery.validate.js");?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url("assets/adminbsb/js/admin.js");?>"></script>
    <script src="<?php echo base_url("assets/adminbsb/js/pages/examples/sign-in.js");?>"></script>
</body>

</html>
<?php if (ENVIRONMENT != 'production')  $this->load->view('debug'); //display debug page ?>