<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Portal Fakultas Teknik Unsrat</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link href="<?php echo base_url("assets/beautiful-login/bootstrap/css/bootstrap.min.css");?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/beautiful-login/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/beautiful-login/css/form-elements.css");?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/beautiful-login/css/style.css");?>" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link href="<?php echo base_url("images/favicon.ico");?>" rel="icon" type="image/x-icon">

    </head>

    <body>

        <!-- Content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><i class="fa fa-users fa-fw"></i> Portal Fakultas Teknik</h1>
                            <div class="description">
                            	<p>
	                            	Welcome to Portal Fakultas Teknik Universitas Sam Ratulangi. We currently developing portal-fatek ver.2.0. Please click button below to begin!
                            	</p>
                            </div>
                            <div class="top-big-link">
                            	<a class="btn btn-link-2 launch-modal" href="#" data-modal-id="modal_mhs"><i class="fa fa-male"></i> Mahasiswa</a>
                            	<a class="btn btn-link-2 launch-modal" href="#" data-modal-id="modal_dosen"><i class="fa fa-university"></i> Dosen</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        
        <!-- MODAL -->
        <div class="modal fade" id="modal_mhs" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">
        					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        				</button>
        				<h3 class="modal-title" id="modal-login-label">Login Mahasiswa to Portal Fatek</h3>
        				<p>Enter your username and password to log on:</p>
        			</div>
        			
        			<div class="modal-body">
        				<?php if($this->session->flashdata('message_login_mhs')) {?>
							<div class="error-message"><?php echo $this->session->flashdata('message_login_mhs');?></div>
						<?php }?>
        				
	                    <?php echo form_open('login/mahasiswa');?>
	                    	<div class="form-group">
	                    		<label class="sr-only" for="form-username" name="identity">Username</label>
	                        	<input type="text" name="namepf" placeholder="Username..." class="form-username form-control" id="form-username" required>
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-password">Password</label>
	                        	<input type="password" name="passpf" placeholder="Password..." class="form-password form-control" id="form-password" required>
	                        </div>
	                        <button type="submit" class="btn">Login</button>
	                    </form>
	                    
        			</div>
        			
        		</div>
        	</div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="modal_dosen" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">
        					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        				</button>
        				<h3 class="modal-title" id="modal-login-label">Login Dosen to Portal Fatek</h3>
        				<p>Enter your username and password to log on:</p>
        			</div>
        			
        			<div class="modal-body">
        				<?php if($this->session->flashdata('message_login_dosen')) {?>
							<div class="error-message"><?php echo $this->session->flashdata('message_login_dosen');?></div>
						<?php }?>
        				
	                    <?php echo form_open('login/dosen');?>
	                    	<div class="form-group">
	                    		<label class="sr-only" for="form-username" name="identity">Username</label>
	                        	<input type="text" name="namepf" placeholder="Username..." class="form-username form-control" id="form-username" required>
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-password">Password</label>
	                        	<input type="password" name="passpf" placeholder="Password..." class="form-password form-control" id="form-password" required>
	                        </div>
	                        <button type="submit" class="btn">Login</button>
	                    </form>
	                    
        			</div>
        			
        		</div>
        	</div>
        </div>
        <?php //if (ENVIRONMENT != 'production')  $this->load->view('debug'); //display debug page ?> 

		<script type="text/javascript">
		    <?php if($this->session->flashdata('message_login_dosen')) {?>
		        var message_login_dsn = "true";
		    <?php }?>
		    <?php if($this->session->flashdata('message_login_mhs')) {?>
		        var message_login_mhs = "true";
		    <?php }?>
		</script>


        <!-- Javascript -->
        <script src="<?php echo base_url("assets/beautiful-login/js/jquery-1.11.1.min.js");?>"></script>
        <script src="<?php echo base_url("assets/beautiful-login/bootstrap/js/bootstrap.min.js");?>"></script>
        <script src="<?php echo base_url("assets/beautiful-login/js/jquery.backstretch.min.js");?>"></script>
        <script src="<?php echo base_url("assets/beautiful-login/js/scripts.js");?>"></script>
        
        <!--[if lt IE 10]>
        	<script src="<?php echo base_url("assets/beautiful-login/js/placeholder.js");?>"></script>
        <![endif]-->

    </body>

</html>