<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>404 | Portal Fakultas Teknik</title>
    <!-- Favicon-->
    <link href="<?php echo config_item('base_url');?>/images/favicon.ico" rel="icon" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo config_item('base_url');?>/assets/adminbsb/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo config_item('base_url');?>/assets/adminbsb/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Custom Css -->
     <link href="<?php echo config_item('base_url');?>/assets/adminbsb/css/style.min.css" rel="stylesheet" />
</head>

<body class="four-zero-four">
    <div class="four-zero-four-container">
        <div class="error-code">404</div>
        <div class="error-message"><?php echo $message;?></div>
        <div class="button-place">
            <a href="javascript: history.go(-1)" class="btn btn-primary btn-lg waves-effect">BACK TO PORTAL</a>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo config_item('base_url');?>/assets/adminbsb/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo config_item('base_url');?>/assets/adminbsb/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo config_item('base_url');?>/assets/adminbsb/plugins/node-waves/waves.js"></script>
</body>

</html>