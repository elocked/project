<!DOCTYPE html>


<html> 

<?php 
if(isset($_GET['var1']) AND isset($_GET['var2'])){
  $latuser=htmlspecialchars($_GET['var1']);
  $lonuser=htmlspecialchars($_GET['var2']);


//instruction de la page 

 include('GoogleMapAPI.class.php');
  //require 'C:\Users\Alex\Documents\GitHub\project\web\GoogleMapAPI.class.php';
  $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 
  $req = $bdd -> query("SELECT Latitude, Longitude FROM etatcadenas WHERE Dispo=1 ");
  
        $K = new GoogleMapAPI();
        while($donnee=$req -> fetch()){
          if($donnee==TRUE and !empty($donnee)){
            echo $donnee['Latitude'].' '.$donnee['Longitude'].'</br>';
            echo 'distance = '.$K->geoGetDistanceInKM($donnee['Latitude'],$donnee['Longitude'],$latuser, $lonuser).' KM</br>';}
          else echo 'Pas de velo disponible </br>';
                           }
  $req->closecursor();
}
else{?>

<script type="text/javascript" >
if (navigator.geolocation)
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {enableHighAccuracy : true, timeout:10000, maximumAge:600000});
else
  alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
   
function successCallback(position){
  var latuser = position.coords.latitude; var lonuser = position.coords.longitude; //degree decimal
  top.document.location = "distance.php?var1="+latuser+"&var2="+lonuser; 
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
<?php } ?>

</script>

</html>