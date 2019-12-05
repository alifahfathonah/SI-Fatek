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

    <title>Portal Fatek Unsrat</title>
	
	<link href="<?php echo base_url("images/favicon.ico");?>" rel="icon" type="image/x-icon">

	<!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/welcome/css/bootstrap.min.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/welcome/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("assets/welcome/css/welcome.css");?>" rel="stylesheet" type="text/css">

</head>

<body>

	<div class="container">
		<div class="row title-text">
			<div class="col-md-12">
				<h1><i class="fa fa-users fa-fw"></i> Portal Fakultas Teknik</h1>
				<h4>Universitas Sam Ratulangi</h4>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-5x fa-male"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $jlh_mahasiswa;?></div>
										<div>Mahasiswa</div>
									</div>
								</div>
								
							</div>
							<div class="panel-footer">
								<a href="<?php echo site_url('login/mahasiswa');?>" class="btn btn-primary" role="button">
									Masuk
								</a>						
							</div>

						</div>
					</div>

					<div class="col-lg-4 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-university fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $jlh_dosen;?></div>
										<div>Dosen</div>
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<a href="<?php echo site_url('login/dosen');?>" class="btn btn-warning" role="button">
									<span style="color:white;">Masuk</span>
								</a>
							</div>
						</div>
					</div>					
					
					<div class="col-lg-4 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<i class="fa fa-shield fa-5x"></i>
								</div>
							</div>
							<div class="panel-footer">
								<a href="<?php echo site_url('login');?>" class="btn btn-success" role="button">
									<span style="color:white;">Administrator</span>
								</a>
							</div>
						</div>
					</div>						
						
				</div>
			</div>					
		</div>	
	</div>
	<!-- /Container -->
	
	<!-- jQuery -->
    <script src="<?php echo base_url("assets/welcome/js/jquery.min.js");?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/welcome/js/bootstrap.min.js");?>"></script>
		
</body>

</html>

