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

var pluma1={};
var $p = pluma1;

/*
*   ----- ajax : Gestion HtttRequest
*
*	@rubrique String uri 	: url
*	@rubrique fcallback		: fonction à exécuter sur onreadystate.
*							  	format : fcallback(xmlhttp.responseText)  
*	
*/
pluma1.ajax={
	uri:"",
	fcallback:null,
	
	/* fonction : httpRequest(method,formData)
	*
	*	@param String method 		: GET ou POST
	*	@param formData 			: données à transmettre en POST ou GET ; sinon null
	*/
	
	httpRequest: function(method, formData){
		var xmlhttp;
		
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp = new XMLHttpRequest();
		}
		else{// code for IE6, IE5
		  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		//sur réponse : appel de la fonction fcallback
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				fcall=pluma1.ajax.fcallback;
				fcall(xmlhttp.responseText);
			}
		}
		  
		//send
		xmlhttp.open(method,this.uri,true);
		xmlhttp.send(formData);	
	},
	
	
	/* fonction : uploadOneFile(fileId)
	*
	*	@param String fileId 		: identifiant de l'élément type = 'file'
	*/
	
	uploadOneFile: function(fileId){
		// Get the selected files from the input.
			
		var fileSelect = document.getElementById(fileId);
		var files = fileSelect.files;
		
		if(files.length==0){
			alert('Veuillez sélectionner un fichier...');
			return false;
		}
		
		// Create a new FormData object.
		var formData = new FormData();
						
		//select file : Add the file to the request.
		var file = files[0];

		formData.append(fileId, file, file.name);
				
		this.httpRequest('POST',formData);
		
		return true;
	},
	
	/* fonction : displayInnerMethodGet(inner)
	*
	*	@param String inner 		: identifiant du inner
	*/
	displayInnerMethodGet: function(inner){
		
		this.fcallback = function(responseText){
			document.getElementById(inner).innerHTML=responseText;
		}
		
		this.httpRequest('GET',null);
	  },
	
	end: "end"
		
};