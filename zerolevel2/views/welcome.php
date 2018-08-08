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
	
	<!-- Modal -->
	<div class="modal fade" id="loginMahasiswa" tabindex="-1" role="dialog" aria-labelledby="Login Mahasiswa">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">
						<i class="fa fa-unlock-alt fa-fw"></i> Verifikasi Akses
					</h3>
				</div>
				<div class="modal-body">									
					<div class="row">
						<div class="col-md-12">
							<small>Verifikasi status kemahasiswaan anda. Masukkan <strong>NIM dan Password portal akademik universitas</strong></small>
						</div>
					</div>
					<br/>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputUser" class="sr-only">NIM</label>
								<input type="text" id="nim" class="form-control" value="" placeholder="NIM" required>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputPassword" class="sr-only">Password</label>
								<input type="password" id="pass" class="form-control" placeholder="Password" required>
							</div>
						</div>
					</div>

					<div id="error-msg"></div>
				</div>
					
				<div class="modal-footer">
					<button type="submit" id="verified" class="btn btn-lg btn-success">
						<i class="fa fa-unlock-alt fa-fw"></i> Verifikasi
					</button>
				</div>
				

			</div>
		</div>
	</div>		
	
	<!-- jQuery -->
    <script src="<?php echo base_url("assets/welcome/js/jquery.min.js");?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/welcome/js/bootstrap.min.js");?>"></script>
		
</body>

</html>

