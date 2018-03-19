<?php
/**
 * baspage.php
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/
?>
<table style="font-size: 12px;color:grey;">
    <tbody>
        <tr>
            <td>Adresse IP : </td>
			<td><?php print(getIP());?> </td>
        </tr>
		<tr>
			<td>User agent : </td>
			<td><?php print($_SERVER['HTTP_USER_AGENT']);?></td>
        </tr>
		<tr>
            <td>Langue: </td>
			<td><?php print($_SERVER['HTTP_ACCEPT_LANGUAGE']);?> </td>
        </tr>
		<tr>
            <td>Serveur: </td>
			<td><?php print($_SERVER['SERVER_NAME']);?> </td>
        </tr>
		<tr>
            <td>Session name: </td>
			<td><?php print(session_name());?> </td>
        </tr>
		<tr>
            <td>PHPSESSID </td>
			<td><?php print(session_id());?> </td>
        </tr>
		<tr>
            <td>$_SESSION </td>
			<td><?php print_array_arbo($_SESSION);?> </td>
        </tr>
 </tbody>
 </table>
 <?php
	$myJet="";
	if(isset($_SESSION["myJeton"])){$myJet=$_SESSION["myJeton"];};
	
	if(isset($_GET['baspage_plus'])){
		
		print('<a href="?baspage_moins=moins&myJeton='.$myJet.'">MOINS...</a>');
		
		print("<h2>\$_SERVEUR</strong></h2>");
		print_array_arbo($_SERVER);
		
		print("<h2>\$_COOKIE</strong></h2>");
		print_array_arbo($_COOKIE);
		
		print("<h2>Paramètres cookie session</strong></h2>");
		print_array_arbo(session_get_cookie_params());
		
		print("<h2>\$_SESSION[name=".session_name()."]</strong></h2>");
		print_array_arbo($_SESSION);
		
		print("<h2>\$_POST</strong></h2>");
		print_array_arbo($_POST);
		
		print("<h2>\$_GET</strong></h2>");
		print_array_arbo($_GET);
		
		print("<h2>\Configuration php.ini</strong></h2>");
		print_array_arbo(ini_get_all());
	}
	else{
		print('<a href="?baspage_plus=plus&myJeton='.$myJet.'">PLUS...</a>');
	}
?>