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
    <meta name="robots" content="index, follow">
	
    <title><?php echo $pageTitle;?></title>

    <link href="<?php echo base_url("images/favicon.ico");?>" rel="icon" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css"/>

    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+JP" rel="stylesheet">

    <style>
        body {font-family: 'Noto Serif JP', sans-serif;}
    </style>

</head>

<html>
<body>

    <div class="container">
        <?php if($body_page) $this->load->view($body_page);?>
        <footer>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center small">Faculty of Engineering Sam Ratulangi University, Indonesia &copy;<?php echo date('Y');?></p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /Container --> 

    <?php if (ENVIRONMENT != 'production')  $this->load->view('debug'); //display debug page ?>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabel-alumni').DataTable({
                "order": [[ 2, "asc" ]],
                "pageLength": 50,
            });

            $('#tabel-dosen').DataTable({
                "pageLength": 50,
            });

            $('#tabel-judul').DataTable({
                "pageLength": 25,
            });

        });
    </script>
    
</body>
</html>