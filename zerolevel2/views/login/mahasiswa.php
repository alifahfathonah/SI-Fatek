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
	<meta name="description" content="Portal Fakultas Teknik">
	<meta name="author" content="Tim PTI Fatek">
	<meta name="robots" content="noindex, nofollow">

	<title>Mahasiswa Login | Portal Fakultas Teknik</title>
	
	<link href="<?php echo base_url("images/favicon.ico");?>" rel="icon" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/login1/css/bootstrap.min.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/login1/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("assets/login1/css/login_user.css");?>" rel="stylesheet" type="text/css">
	
	<style type="text/css">
		/* Override some defaults */
		.intro {
			background: url(<?php echo base_url("images/intro-bg2.jpg");?>) no-repeat bottom center scroll;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			background-size: cover;
			-o-background-size: cover;
		}
	  
    </style>	
</head>

<body>

	<header class="intro">
		<div class="intro-body">
			<div class="container">
				<div class="row ">
					<div class="col-md-6 intro-text">
						<div class="col-xs-12 col-md-12">
							<h1>M A H A S I S W A</h1>
							<h4>Portal Fakultas Teknik</h4>

						</div>
					</div>	
					<div class="col-md-6 form-login">
					
						<?php echo form_open();?>
						
							<?php if($this->session->flashdata('message_login_mhs')) {?>
							<div class="error-message"><?php echo $this->session->flashdata('message_login_mhs');?></div>
							<?php }?>
							<input type="text" name="identity" value="" placeholder="NIM" rel="txtTooltip1" title="Nomor Induk Mahasiswa" data-toggle="tooltip" data-placement="right" required>
							<input type="password" name="password" placeholder="Password" rel="txtTooltip2" title="Password Portal Akademik Unsrat!" data-toggle="tooltip" data-placement="right" required>
							<button name="submit" class="btn btn-lg btn-success" type="submit">Login</button>


						</form>
					</div>
				</div>
			</div>
		</div>
		
	</header>

<!-- jQuery -->
<script src="<?php echo base_url("assets/login1/js/jquery.min.js");?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url("assets/login1/js/bootstrap.min.js");?>"></script>

<script>
$(document).ready(function(){
	$('input[rel="txtTooltip1"]').tooltip();
    $('input[rel="txtTooltip2"]').tooltip();
});
</script>

</body>
</html>
<?php $this->load->view('debug');?>