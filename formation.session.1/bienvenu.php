<?php
/**
 * bienvenu.php
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/


if ( !isset( $_SESSION["user"] )) { 
 exit(0); // tentative d'accès hors index...
}
?>

  <h3>Bienvenu(e) <?php echo $_SESSION['user'];?></h3>
  