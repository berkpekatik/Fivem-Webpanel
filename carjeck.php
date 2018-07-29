<!DOCTYPE html>
<?php


	require ('steamauth/steamauth.php');
	include ('steamauth/userInfo.php');
	require ('steamauth/LoginControl.php');
	include ('mysql/mysqlCon.php');

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
    <title>Forms</title>

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
						<div class="col-lg-3">
						
                                <div class="card">
                                    <div class="card-header">Galeriye Araç Ekleme</div>
                                    <div class="card-body">
                                        <form action="" method="post" novalidate="novalidate">
										                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label mb-1">Araç Adı</label>
                                                        <input id="name" name="name" type="tel" class="form-control cc-exp" value="" data-val="true"  >
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="model" class="control-label mb-1">Araç Modeli</label>
                                                    <div class="input-group">
                                                        <input id="model" name="model" type="tel" class="form-control cc-cvc" value="" >

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fiyat" class="control-label mb-1">Fiyatı</label>
                                                <input id="fiyat" name="fiyat" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                                            </div>
                                           <label for="category"> Kategori : </label>
											<select id="category" name="category" >
											<option value="ucuz">ucuz</option>											
											<option value="orta">orta</option>
											<option value="pahali">pahali</option>
											<option value="bagisci">bagisci</option>
											<option value="super">super</option>
											<option value="motor">motor</option>
											<option value="suv">suv</option>
											<option value="wh">wh</option>											

											
											</select>

                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-save"></i>&nbsp;
                                                    <span id="payment-button-amount">Kaydet</span>
                                                </button>
                                            </div>
                                        </form>
										<?php
if($_POST){
        
            // Formdan Gelen Kayıtlar
            $name        =    $_POST["name"];
            $model    =    $_POST["model"];
			$fiyat    =    $_POST["fiyat"];
			$category    =    $_POST["category"];
			
include ('mysql/mysqlCon.php');

$query = $db->prepare("INSERT INTO vehicles SET
name = ?,
model = ?,
price = ?,
category = ?");
$insert = $query->execute(array(
     $name, $model, $fiyat , $category
));
if ( $insert ){
    $last_id = $db->lastInsertId();
    print "Araç başarıyla eklendi.";
}

}
?>
                                    </div>							
                                </div>
                    </div>
					

											

                                                

                                    
										<table class="table-borderless table-striped table-earning">
										<thead>
										<tr>
											<th>Name</th>
											<th>Model</th>
											<th>Price</th>
											<th>Category</th>
											<th><?php //$nRows = $db->query("select count(*) from vehicles category = 'pahali' OR category = 'orta' OR category = 'ucuz' OR category = 'bagisci' OR category = 'super' OR category = 'motor' OR category = 'suv' OR category = 'wh' ")->fetchColumn(); echo $nRows; ?> Adet Kayıt Bulundu</th>
										</tr>
										</thead>
										<tbody>
										<?php
										$query = $db->query("SELECT * FROM vehicles where category = 'pahali' OR category = 'orta' OR category = 'ucuz' OR category = 'bagisci' OR category = 'super' OR category = 'motor' OR category = 'suv' OR category = 'wh'  ", PDO::FETCH_ASSOC);
										if ( $query->rowCount() ){
										foreach( $query as $row ){
										print "<tr>";
										print "<td>".$row['name']."</td>";
										print "<td>".$row['model']."</td>";
										print "<td>".$row['price']." TL</td>";
										print "<td>".$row['category']."</td>";
										print "<td><a href='sil.php?id=".$row['id']."'><button type='button' class='btn btn-danger btn-sm'>Sil</button></a>
										<a href='duzenle.php?id=".$row['id']."'><button type='button' class='btn btn-success btn-sm'>Düzenle</button></a></td>";
										print "</tr>";
										}
										}
										?>
										
										</tbody>
										</table>
                                        
                                </div>
							</div>
							                            
												
		
                        <div class="row">		
					
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p># <a href="https://berkpekatik.com">Berk Pekatik</a>.</p>
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
