<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- 
Crafted by: 
Xaverius Najoan
http://xaverius.najoan.net
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal Fakultas Teknik Unsrat">
    <meta name="author" content="Xaverius Najoan">
	<meta name="robots" content="noindex, nofollow">

    <title>Administrator | Portal Fatek Unsrat</title>
	
	<link href="<?php echo base_url("images/favicon.ico");?>" rel="icon" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">
	
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("assets/css/metisMenu.min.css");?>" rel="stylesheet">
	
    <!-- Plugin CSS -->
    <?php if (isset($link_tag)) {
		foreach ($link_tag as $link) {
            echo link_tag("assets/css/".$link);
		}
	}?>
	
    <!-- Custom CSS -->
	<link href="<?php echo base_url("assets/css/portal.css");?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <!-- jQuery -->
    <script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>

</head>

<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url();?>">
					<span class="logo-text"><i class="fa fa-users fa-fw"></i> Portal Fakultas Teknik</span>
				</a>
			</div>

			<ul class="nav navbar-top-links navbar-right" id="user-menu">
				<li>
					<a href="<?php echo site_url("admin/dashboard");?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
				</li>	
				<li>
					<a href="<?php echo site_url("admin/dashboard/profile"); ?>"><i class="fa fa-user fa-fw"></i> My Profile</a>
				</li>
				
				<li><a href="<?php echo site_url("admin/logout"); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
			</ul>

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">	
						<li>
							<a href="<?php echo site_url("admin/data-mahasiswa");?>"><i class="fa fa-fw fa-male"></i> Data Mahasiswa</a>
						</li>
						<li>
							<a href="<?php echo site_url("admin/data-alumni");?>"><i class="fa fa-fw fa-graduation-cap"></i> Data Alumni</a>
						</li>
						<li>
							<a href="<?php echo site_url("admin/data-dosen");?>"><i class="fa fa-university fa-fw"></i> Data Dosen</a>
						</li>
						<li>
							<a href="<?php echo site_url("admin/data-dokumen");?>"><i class="fa fa-folder fa-fw"></i> Dokumen Dosen</a>
						</li>
						<?php if($this->session->userdata['logged_in_admin']['curr_id'] == "1") {?>
						<li>
							<a href="<?php echo site_url("admin/user");?>"><i class="fa fa-users fa-fw"></i> Kelola User</a>
						</li>
						<?php }?>
						
					</ul>
				</div>
			</div>
		</nav>

		<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
						<?php echo $title;?> <?php if(!empty($subtitle)) echo "<small>".$subtitle."</small>";?>
						</h1>
					</div>
				</div>
				<!-- /.row -->
				
				<?php if($body_page) $this->load->view($body_page);?>

			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->
		
		<footer>
		<div class="text-center">
			Fakultas Teknik Universitas Sam Ratulangi - Copyright &copy; 2017 - All Rights Reserved
		</div>
		</footer>
		
    </div>
    <!-- /#wrapper -->
	
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("assets/js/metisMenu.min.js");?>"></script>
	
    <!-- Custom JavaScript -->
    <script src="<?php echo base_url("assets/js/portalMenu.js");?>"></script>
	
</body>

</html>
<?php //include("debug.php");?>
