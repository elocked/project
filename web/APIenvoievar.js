

function affiche(){
	alert('ok');
}

//<script type="text/javascript">
function getXMLHttpRequest() {
        var xhr = null;
  
        if(window.XMLHttpRequest || window.ActiveXObject) {
                if(window.ActiveXObject) {
                        try {
                                xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch(e) {
                                xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                } else {
                        xhr = new XMLHttpRequest();
                }
        } else {
                alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
                return null;
        }
  
        return xhr;
}




function envoievariablejs(var var1 , var var2){
// tu crée l'objet :
var xhr = getXMLHttpRequest();
// t'as codé ce constructeur précédemment
 
if(xhr && xhr.readyState != 0){
   xhr.abort();
}
 
xhr.onreadystatechange = function(){
   if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
      // tu peux récupérer en JS le résultat du traitement avec xhr.responseText;
   }
   else if(xhr.readyState == 2 || xhr.readyState == 3){ // traitement non fini
      // tu peux mettre un message ou un gif de chargement par exemple
   }
}
 
xhr.open("POST", "distance.php", true); // true pour asynchrone
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // seulement si t'as choisi la méthode POST !
xhr.send(var1 & var2); // éventuellement t'envois plusieurs variables séparées par un &
alert("coucou");
}


//</script>