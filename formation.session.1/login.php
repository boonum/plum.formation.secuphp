<?php
/**
 * login.php
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/


?>

<form method="post" action="index.php" name="login">

	<table cellspacing="0" cellpadding="2" border="0" align="left">
    <tbody>
        <tr>
            <td>Identifiant</td>
        </tr>
        <tr>
            <td>
                <input id="user" type="text" value="" size="30" name="user" value="">
            </td>
        </tr>
        <tr>
            <td>Mot de passe</td>
        </tr>
        <tr>
            <td>
                <input id="password" type="password" size="20" name="password" value="">
            </td>
        </tr>
        <tr>
			<td>
				<input type="submit" name="connexion" value="Connexion">
			</td>
		</tr>
    </tbody>
	</table>
</form>