<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- 
Develop by: 
Tim pengembang PTI Fakultas Teknik Unsrat
http://fatek.unsrat.ac.id
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal Fakultas Teknik Unsrat">
    <meta name="author" content="Tim PTI Fatek">
	<meta name="robots" content="noindex, nofollow">
	
    <title>Mahasiswa | Portal Fakultas Teknik</title>

	<link href="<?php echo base_url("images/favicon.ico");?>" rel="icon" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">

    <!-- Plugin CSS -->

    <!-- Custom CSS -->
	
	<!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css">	
	
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="<?php echo base_url();?>">
					<span class="logo-text"><i class="fa fa-users fa-fw"></i> Portal Fakultas Teknik</span>
				</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo site_url('mahasiswa/profile');?>"><i class="fa fa-user fa-fw"></i>Profile</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('mahasiswa/profile/edit');?>"><i class="fa fa-edit fa-fw"></i>Edit Profile</a>
                    </li>
					<li>
                        <a href="<?php echo site_url("mahasiswa/logout"); ?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
            
		<h1 class="page-header">
		Mahasiswa
		</h1>

		<div class="row">
			<div class="col-md-9">
			
				<?php if($body_page) $this->load->view($body_page);?>

			</div>
			
			<div class="col-md-3">
				
			</div>
		</div>
		<hr>
		<!-- Footer -->
		<footer>
			<div class="row">
				<div class="col-md-12">
					<p class="text-right">Fakultas Teknik Universitas Sam Ratulangi - Copyright &copy;<?php echo date('Y');?> - All Rights Reserved</p>
				</div>
			</div>
		</footer>

    </div>
	<!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>        
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>

</body>	
</html>
<?php //include("debug.php");?>