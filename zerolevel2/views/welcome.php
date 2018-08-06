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

    <title>Portal Fatek Unsrat</title>
	
	<link href="<?php echo base_url("images/favicon.ico");?>" rel="icon" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">
	
    <!-- Custom CSS -->
	<link href="<?php echo base_url("assets/css/welcome.css");?>" rel="stylesheet">

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
								<a href="<?php echo site_url('mahasiswa');?>" class="btn btn-primary" role="button">
									Masuk
								</a>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginMahasiswa">
								  Registrasi
								</button>									
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
								<a href="<?php echo site_url('dosen');?>" class="btn btn-warning" role="button">
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
								<a href="<?php echo site_url('admin');?>" class="btn btn-success" role="button">
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
	
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
	
<script type="text/javascript">

$(document).ready(function () {

	$('#verified').click(function()
    {
		$('#error-msg').empty();
		$('#error-msg').removeClass('alert alert-danger');
		
		$.ajax({
			url: "<?php echo site_url('welcome/verifikasi');?>",
			type: "POST",
			data: {
				'nim': $('#nim').val(),
				'pass': $('#pass').val()
			},	
			dataType: "json",
			success: function(data) {
				if (data.status == false) {
					$('#error-msg').addClass('alert alert-danger');
					$('#error-msg').append('<i class="fa fa-warning fa-fw"></i> ' + data.messages);
				} else {
					$('#error-msg').addClass('alert alert-success');
					$('#error-msg').append('<i class="fa fa-check fa-fw"></i> ' +data.messages);
					window.location = data.url;
				}
			}
		});
	});
});
</script>	
	
</body>

</html>

