<?php
/**
 * ajouterUser.php
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/
if ( !isset($_SESSION["user"] ) exit(0);

$database=connectDb();
 
$sql="insert into fs_user Values(null,?,?)";
 
$param=array($_GET['user'],$_GET['pwd']);
 
$sth=executeDb($database,$sql,$param);
 
?>
<h3>Un utilisateur a été ajouté par... <?php echo $_SESSION['user'];?></h3>