<?php
/**
 * bienvenu.php
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/


if ( isset( $_SESSION["user"] )) { ?>

  <h3>Bienvenu(e) <?php echo $_SESSION['user'];?></h3>
  
<?php }  else {?>
  <h3> Vous n'êtes pas authentifié ... </h3> 
  <a style = "color : grey " href="?form=login.php&connexion=">Connexion</a>
  
<?php } ?>
