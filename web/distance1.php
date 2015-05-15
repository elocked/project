 <!DOCTYPE html>
 <html> 
<head>

<script type="text/javascript" >
if (navigator.geolocation)
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {enableHighAccuracy : true, timeout:10000, maximumAge:600000});
else
  alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
   
function successCallback(position){
  var latuser = position.coords.latitude; var lonuser = position.coords.longitude;
  top.document.location = "distance.php?var1="+latuser+"&var2="+lonuser; 
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
 
//xhr.open("POST", "distance.php", true); // true pour asynchrone
//xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // seulement si t'as choisi la méthode POST !
//xhr.send(latuser & lonuser); // éventuellement t'envois plusieurs variables séparées par un &
xhr.open("GET", "distance.php?var1="+latuser+"&var2="+lonuser, true);
xhr.send(null);

alert("Latitude : " + latuser + ", longitude : " + lonuser);
};  
 
function errorCallback(error){
  switch(error.code){
    case error.PERMISSION_DENIED:
      alert("L'utilisateur n'a pas autorisé l'accès à sa position");
      break;      
    case error.POSITION_UNAVAILABLE:
      alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
      break;
    case error.TIMEOUT:
      alert("Le service n'a pas répondu à temps");
      break;
    }
};

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
</script>
</head>