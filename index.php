<!DOCTYPE html>
<?php


	require ('steamauth/steamauth.php');
	include ('steamauth/userInfo.php');
	require ('steamauth/LoginControl.php');
	
?>
<?php

$config = array 
    ( 
    'ftp_user'  => 'x', 
    'ftp_pass'  => 'x', 
    'domain'    => 'x', 
    'file'      => 'x',       # relative to 'domain' 
    ); 

if(isset($_POST['submit'])) 
    { 
    $fp = fopen($config['file'],'w'); 
    fwrite($fp,stripslashes($_POST['newd'])); 
    fclose($fp); 

    $ftp = ftp_connect($config['domain']); 
    ftp_login($ftp,$config['ftp_user'],$config['ftp_pass']); 
    ftp_put($ftp,$config['file'],$config['file'],FTP_ASCII); 
    ftp_close($ftp); 
    } 

?>

<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Whitelist Düzenleme</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
       

        <!-- MENU SIDEBAR-->
		<?php include("menu-sidebar.php"); ?>
        <!-- END MENU SIDEBAR-->


        <!-- PAGE CONTAINER-->
        <div class="page-container">
		
			<!-- HEADER DESKTOP-->
            <?php include("header.php"); ?>
            <!-- HEADER DESKTOP-->
			
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            
						<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Whitelist
                                            <small>
                                                <span class="badge badge-danger float-right mt-1">49</span>
                                            </small>
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
										<form method="post" action="<?=( $_SERVER['PHP_SELF'] )?>"> 
										<textarea class="col-md-12" rows="8"  name="newd"><?=( file_get_contents('ftp://'.$config['ftp_user'].':'.$config['ftp_pass'].'@'.$config['domain'].'/'.$config['file']) )?></textarea>										
                                        </p>
										
                                    </div>
									<?php echo "<a href='rcon.php?action=restart&sid=0' class='btn btn-danger btn-xs'>Restart Sira</a>" ?>
									<input type="submit" name="submit" class="btn btn-primary btn-sm" value="Kaydet"> 
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright <a href="https://berkpekatik.com">vNoisy</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
