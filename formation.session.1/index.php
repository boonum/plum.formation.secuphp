﻿<?php
/**
 * index.php
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/
include ('fonctions.php');

//------------------ session -------------------------

session_start();

//------------------- pas de message ------------------
$message="";

//------------------ mémorisation script demandé --------------

if( isset( $_GET['form'] ) ){
	$_SESSION['form'] = $_GET['form'];
}

$form = "login.php";

if( isset($_SESSION['form'] ) ) {
	$form = $_SESSION['form'];
}

if( isset( $_GET['form'] ) ) {
	$form = $_GET['form'];
}

//------------------- connexion -------------------------



//------------------- contrôle autorisation script ------

$auto_OK = false;

switch ($form){
	case "login.php" : 
		$auto_OK = true;
		break;
}
?>

<!-- - - - - - - - - - - - - AFFICHAGE ENTETE/FORM/BASPAGE - - - - - - - - - - - -->
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
		<meta charset="iso-8859-1" />
		<title>formation.session</title>
		<link rel="shortcut icon" type="image/x-icon" href="image/favicon_0.ico"/>
		<link rel="stylesheet" href="css/a1.css" type="text/css" />
		<script src="js/a1.js" type="text/javascript"></script>
</head>

<body onload="">

<div class='content'>

	<div class='entete'>
		<div class='titre'>
			Sécurité des sessions PHP
			<?php
		if( $message != "" ){
			echo "<span class='message'>"
				.$message
				."</span>";
		}
		?>
		</div>
	</div>
		
	
		<div class='menu'>
		<?php include ('menu.php');?>
		</div>
		
		<div class='form'>
		<?php include ( $form );?>
		</div>
	
	<div class='baspage'>
	<?php include ('baspage.php');?>
	</div>
	
</div>
</body>
</html>