<?php
/**
 * newInfo.php
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/
$database = connectDb();

if( isset( $_GET['ajouter'] ) ){

	$sql = "insert into fs_info Values(null ,?)";
		
	$param = array($_GET['info']);
	
	$sth = executeDb($database,$sql,$param);
}

?>
<div>
<form method="get" action="index.php?form=newInfo" name="newLogin">

	<input name="myJeton" type="hidden" value="<?php echo $_SESSION['myJeton'];?>">
	<table cellspacing="0" cellpadding="2" border="0" align="left">

    <tbody>
        <tr>
            <td>Nouvelle info</td>
        </tr>
        <tr>
            <td>
		<textarea rows="4" cols="50" name="info"></textarea>
                
            </td>
        </tr>
        	<tr>
			<td>
				<input type="submit" name="ajouter" value="Ajouter">
			</td>
		</tr>
    </tbody>
	</table>
</form>
</div>

<div class='info'>

	
<?php

$sql = "select info from fs_info order by idinfo";
		
$sth = executeDb($database, $sql, array());

$info = $sth->fetchAll();

?>
		<ul class='liste'>
			<?php 
			$un = "background-color : #b4b4b4;";
			$deux = "background-color : #f0f0f0;";
			
				$styleinfo = $un;
				foreach($info as $uneInfo){	
					$li = "<li style='" . $styleinfo . "'>"
							."<b>".$uneInfo["info"]."</b>"
						."</li>";
					
					echo $li;
					
					if ( $styleinfo == $un ) $styleinfo = $deux;
					else $styleinfo = $un;
				}
			?>
		</ul>
		
</div>