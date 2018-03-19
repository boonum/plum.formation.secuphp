//-------------------- cookies --------
//http://ppk.developpez.com/tutoriels/javascript/gestion-cookies-javascript/

/*
*  lire le contenu d'un cookie
*
*/
function readCookie(name) {
	
	var ca = document.cookie.split(';');
    
	for(var i=0;i < ca.length;i++) {
		
		cook=ca[i].split("=");
		
		if (name.trim()==cook[0].trim()) {
		 return cook[1];
		}
	}
	return null;
}

/*
*  mémoriser un cookie ; uniquement sur le domaine courant...http://www.thesitewizard.com/javascripts/cookies.shtml
*
*/
function newCookie(name,value) {
	document.cookie = name+"="+value+"; path=/;";
}