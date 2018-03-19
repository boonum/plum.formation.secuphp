<?php
/**
 * menu.php
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/

// --- le jeton est calculé et mémorisé dans $_SESSION quand l'authentification a été réussie
//      Dans index.php : 
//         Si le jeton n'est pas valide la fonction is_authorised () retournera false
//
$myJeton = "";
if( isset($_SESSION['myJeton'])) {
	$myJet = $_SESSION['myJeton'];
}

?>
<ul>
	<li class="standard">
		<a href="?form=login.php&deconnexion=">Déconnexion</a>
	</li>
	
	<li class="standard">
		<a href="?form=bienvenu.php<?php echo "&myJeton=".$myJeton;?>">Bienvenu</a>
	</li>
</ul>