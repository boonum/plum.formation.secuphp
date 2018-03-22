<?php
/**
 * fonctions.php Bibliothèque de fonctions
 * 
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/

//----------------------------- session -------------------------------------------

/**
 * source : http://sebsauvage.net/wiki/doku.php?id=php:session
 *
 *  Returns the IP address of the client (Used to prevent session cookie hijacking.)
*/
function getIP()
{
    $ip = $_SERVER["REMOTE_ADDR"];
	
    // Then we use more HTTP headers to prevent session hijacking from users behind the same proxy.
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip=$ip.'_'.$_SERVER['HTTP_X_FORWARDED_FOR']; }
	
    if (isset($_SERVER['HTTP_CLIENT_IP'])) { $ip=$ip.'_'.$_SERVER['HTTP_CLIENT_IP']; }
	
    return $ip;
}


/**
* AUTORISE le passage de SID dans l'URL
*
* source : thbogusz@yahoo.fr
*	
*/
function use_session_trans_url(){
	ini_set('session.use_cookies', 0);       // Don't Use cookies to store session.
	ini_set('session.use_only_cookies', 0);  // phpsessionID autorisé in URL)
	ini_set('session.use_trans_sid', 1); //Support SID transparent. Le SID apparait dans l'URL
	session_start();
}

/**
* Stockage du SID UNIQUEMENT par cookie
*
* source : thbogusz@yahoo.fr
*
*/
function use_session_only_cookie(){
	ini_set('session.use_cookies', 1);       // Use cookies to store session.
	ini_set('session.use_only_cookies', 1);  // phpsessionID interdit via URL
	ini_set('session.use_trans_sid', 0); // Éviter d'utiliser php sessionID dans l'URL si les cookies sont désactivés.
	
	$path=strstr($_SERVER['PHP_SELF'],"index.php",true);//par exemple $path="/2014/formation.lycée/claude/"
	session_set_cookie_params(0,$path);//chaque sous-répertoire du domaine dispose d'un PHPSESSID différent, par défaut path="/"
	
	session_start();
}

/**
 * autoriser()
 *
 * return true :
 *   si [user] existe
 *   si Jeton existe
 *   si jeton transmis par le client est identitique au jeton stocké
 *
 * retourne false : la demande n'est pas autorisée
 *
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/
function is_authorised(){

	if( !isset($_SESSION['user']) ) {
		return false;
	}

	if( !isset( $_SESSION['myJeton'] ) ){
		return false;
	}

	$myJeton_post_get="";
	
	if( isset($_GET['myJeton']) ) {$myJeton_post_get=$_GET['myJeton'];}
	
	if( isset($_POST['myJeton']) ) {$myJeton_post_get=$_POST['myJeton'];}
	
	if ( $myJeton_post_get != $_SESSION['myJeton'] ){
		return false;
	}

	return true; // tout est clair
}

/**
 * deconnecter_user()
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/
function deconnecter_user(){
	$params = session_get_cookie_params();
	
	// Destruction du cookie client
	setcookie(session_name(), '', time() - 42000,
      $params["path"], $params["domain"],
      $params["secure"], $params["httponly"]);

	// Destuction de la session
	session_destroy();
	print_debug("session_destroy, contenu de \$_SESSION",$_SESSION);
		
	// Effacer le contenu de $_SESSION
	$_SESSION = array();
	print_debug("\$SESSION=array();contenu de \$_SESSION",$_SESSION);
		
	
}

/**
 * connecter_user()
 *
 * @project	   formation.session
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thierry Bogusz <thbogusz@yahoo.fr>
*/
function connecter_user(){
	$database=connectDb();
	
	$sql="select * from fs_user where user = ?";
		
	$param = array( $_POST['user'] );
	$sth = executeDb( $database, $sql, $param );
		
	$result = $sth->fetch();
		
	if( $result == true && 
		$result['user'] == $_POST['user'] && 
		$result['pwd'] == $_POST['password'] ){
			
		//mémorisation des données de sécurité
		$_SESSION['user']=$_POST['user'];
		$_SESSION['myJeton'] = sha1( uniqid('',true).'_'.mt_rand() );
			
		return "Vous êtes connectés!! Choisissez un menu";
	}
	else {
		$_SESSION = array();
		
		return "Echec authentification...";
	}
	
}

//----------------------------- utilitaires -------------------------------------------

/**
* source : thbogusz@yahoo.fr
*
* Affiche l'arborescence en profondeur d'un tableau
*/
function print_array_arbo( $arr , $niveau = "" ){
	$arbo = "";//
	$decalage = "....";
	$LF = "<br>";
	
	foreach( $arr as $key => $value ){
		print( $LF.$niveau.$arbo."<strong>[".$key."]</strong>" );
		
		if( is_array( $value ) ){
			print_array_arbo( $value, $niveau.$decalage );
		}
		else{
			print( "<strong>=></strong>".$value );
		}
	}
}

/**
* source : thbogusz@yahoo.fr
*
* Debug d'une variable
*/
function print_debug($titre,$var){
	
	print( '<div class="debug" style="margin-top:3px;font-size: 12px;background-color:#C0C0C0;">' );
	
	print( '<h3>'.$titre.'</h3>' );
	
	if( is_array($var) ) { print_array_arbo($var); }
	else { print($var );}
	
	print( '</div>' );
}


//----------------------------- base de données -------------------------------------------

/**
* source : thbogusz@yahoo.fr
*
*/
function connectDb(){
	
		if(getIP()!= "127.0.0.1" ){
			$confDb['driver'] = "mysql";
			$confDb['host'] = "";
			$confDb['dbname']='';
			$confDb['user']='';
			$confDb['pwd']='';
		}
		else{
			$confDb['driver'] = "mysql";
			$confDb['host'] = "localhost";
			$confDb['dbname']='formationsession';
			$confDb['user'] = 'root';
			$confDb['pwd'] = '';
		}
		
		$dsn=$confDb['driver'].':host='.$confDb['host'].';dbname='.$confDb['dbname'];
		
		try{
			$dbh = new PDO( $dsn, $confDb['user'], $confDb['pwd'],array( PDO::ATTR_PERSISTENT => true));
		}catch(PDOException $e){
			print "<br>Erreur fonction::connectDb() : ". $e->getMessage() . "<br/>";
			die();
		}
		
		return $dbh;
}

/**
* source : thbogusz@yahoo.fr
*
*/	
function executeDb( &$database, $sql, $param = array() ){
		$sth = $database->prepare($sql);
		
		$t = $sth->execute($param);
		
		if(!$t) {
			print( "<br>Erreur PDO::executeDb()<br>" );
			print_r( $sth->errorInfo() );
			die("");
		}
		
		return $sth;
}

//----------------------------- faille SQL -------------------------------------------
function connecter_user_faille_sql(){
		$database = connectDb();
		
		//faille mot de passe:eee' or '1'='1
		$sql = "select * from fs_user where user='".$_POST['user']."' and pwd='".$_POST['password']."'";
		
		print_debug( "SQL",$sql );
		
		$sth = executeDb($database,$sql);
		
		$result = $sth->fetch();
		
		if( $result==false ){
			return false;
		}
		else{
			$_SESSION['user'] = $_POST['user'];
			return true;
		}
}