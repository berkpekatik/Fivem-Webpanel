<!DOCTYPE html>
<?php


	require ('steamauth/steamauth.php');
	include ('steamauth/userInfo.php');
	require ('steamauth/LoginControl.php');
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
    <title>Rcon</title>

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
						<div class="col-lg-12">
						<?php

// Edit this to your own server details (last one doesnt need a , at the end).
$serverinfo = array
	(
//  array("ID","NAME","IP","PORT","RCONPASSWORD"). First server id is always 0!
	array("0","Turkuaz","127.0.0.1","30120","xxxx")
	);

// Messages for kick & ban
$kickmessage = "You got kicked by an admin. You should know why. If not, ask an admin at Discord.";
$banmessage = "You got banned by an admin. You should know why. If not, ask an admin at Discord.";

// DO YOUR LOGIN PROTECTION HERE



// DONT EDIT AFTER HERE
require("./rcon/q3query.class.php");
if (isset($_GET['action'])) {
    $action = $_GET['action'];
	$user_id = $_GET['uid'];
	$server_id = $_GET['sid'];
}
		
	// Check for action in url, imports the variables and do command.	
	if($action == "kick") {
			   
		foreach ($serverinfo as $server) {
			if($server['0'] == $server_id){
				
				$con = new q3query($server['2'], $server['3'], $success);
				if (!$success) {
					die ("Fehler bei der Verbindungherstellung");
				}
				$con->setRconpassword($server['4']);
				$con->rcon("clientkick $user_id $kickmessage");
				echo "You successfully should have kicked the user with ID $user_id. Redirect after 3 seconds.";
				header( "refresh:3;url=rcon.php" );
				die();
			}		
		}
	} else if ($action == "ban") {
		foreach ($serverinfo as $server) {
			if($server['0'] == $server_id){
				$con = new q3query($server['2'], $server['3'], $success);
				if (!$success) {
					die ("Fehler bei der Verbindungherstellung");
				}
				$con->setRconpassword($server['4']);
				echo $con->rcon("ban $user_id $banmessage");
				echo "You successfully should have banned the user with ID $user_id. Redirect after 3 seconds.";
				header( "refresh:3;url=rcon.php" );
				die();
			}
		}
	}
		else if($action == "restart") {
			   
		foreach ($serverinfo as $server) {
			if($server['0'] == $server_id){
				
				$con = new q3query($server['2'], $server['3'], $success);
				if (!$success) {
					die ("Fehler bei der Verbindungherstellung");
				}
				$con->setRconpassword($server['4']);
				$con->rcon("restart sira");
				echo "You successfully should have kicked the user with ID $user_id. Redirect after 3 seconds.";
				header( "refresh:3;url=rcon.php" );
				die();
			}		
		}
	}
?>


<?php		

	foreach ($serverinfo as $server) {
		echo "<div class='row'>";	
		echo "<div class='col-md-12'>";
		$con = new q3query($server['2'], $server['3'], $success);
		if (!$success) {
			die ("Fehler bei der Verbindungherstellung");
		}
		$con->setRconpassword($server['4']);
	
		$server_players_array=explode("\n",$con->rcon("status"));
		$xpop = array_pop($server_players_array);
		$server_players_total = count($server_players_array);
	
		
		
		
		echo "<div class='table-responsive table--no-card m-b-30'>";		
		echo "<table class='table table-borderless table-striped table-earning'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>SteamID</th>
						<th>IP</th>
						<th>Ping</th>
						<th>KICK</th>
						<th>BAN</th>
					</tr>
			  </thead>
			  <tbody>";

	// Splitting the multiple lines of status command into arrays and split them into arrays seperated by " "
	// the mess is because playernames can have spaces. So we remove every entry before and after name
	// and put the rest together as name string.
	foreach ($server_players_array as $server_player) {
		$playerinfo=explode(" ",$server_player);
		$player_id = array_shift($playerinfo);
		$player_ipsteam = array_shift($playerinfo);
		$player_ipsteam2 = explode(":", $player_ipsteam);
		if($player_ipsteam2[0] == "steam"){
			$player_ipsteam3 = $player_ipsteam2[1];
		}else{
			$player_ipsteam3 = "-";
		}
		$player_ping = array_pop($playerinfo);
		$player_ip = array_pop($playerinfo);
		$player_name = implode(" ", $playerinfo);
		echo "<tr>
				<td>$player_id</td>
				<td>$player_name</td>
				<td>$player_ipsteam3</td>
				<td>$player_ip</td>
				<td>$player_ping</td>
				<td><a href='rcon.php?action=kick&uid=$player_id&sid=$server[0]' class='btn btn-warning btn-xs'> KICK</a></td>
				<td><a href='rcon.php?action=ban&uid=$player_id&sid=$server[0]' class='btn btn-danger btn-xs'> BAN</a></td></tr>
				
			  </tr>";				  
		}
		echo "</tbody>
		</table>";
	
	
	echo"</div>";
	echo"</div>";
	echo"</div>";
	
}
?>
		
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
