<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">



<?php 
// récupération de la longitude et la latitude de l'utilisateur 
if(empty($_GET['var1']) AND empty($_GET['var2'])){
?>
<script type="text/javascript" >
if (navigator.geolocation)
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {enableHighAccuracy : true, timeout:10000, maximumAge:600000});
else
  alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
   
function successCallback(position){
  var latuser = position.coords.latitude; var lonuser = position.coords.longitude; //degree decimal
  top.document.location = "reserver.php?var1="+latuser+"&var2="+lonuser; 
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

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="author" content="E-LOCKED TEAM">
<meta name="description" content="E-LOCKED PROJECT">
<meta name="keywords" content="lock, e-lock, cadnas, project">
<meta name="copyright" content="Tous droits reserves">
<meta name="subject" content="Projet E3 Cadenas Connect챕">
<title>E-LOCKED</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <!-- Inclusion de l'API Google MAPS -->
    <?php include('GoogleMapAPI.class.php'); ?>
    <!-- Le paramètre "sensor" indique si cette application utilise détecteur pour déterminer la position de l'utilisateur -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript">
      function initialiser() {
        <?php
        $latuser=htmlspecialchars($_GET['var1']);
        $lonuser=htmlspecialchars($_GET['var2']);
        ?>
        var latlng = new google.maps.LatLng('<?php echo $latuser ;?>','<?php echo $lonuser; ?>');
        //objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
        //de définir des options d'affichage de notre carte
        var options = {
          center: latlng,
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        //constructeur de la carte qui prend en paramêtre le conteneur HTML
        //dans lequel la carte doit s'afficher et les options
        var carte = new google.maps.Map(document.getElementById("carte"), options);

        <?php
        $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $req = $bdd -> query("SELECT Latitude, Longitude FROM etatcadenas WHERE Dispo=1 ");
        //$K = new GoogleMapAPI();
        while($donnee=$req -> fetch()){
          if($donnee==TRUE and isset($donnee)){?>
            //création du marqueur
           setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>');
            
         <?php }
          else echo 'Pas de velo disponible </br>';
                           }
        $req->closecursor();
        ?>

        function setmarqueur(latitude , longitude){
          
          var image = {
        url: 'image/marqueur.png',
        // This marker is 68 pixels wide by 61 pixels tall.
        size: new google.maps.Size(68, 61),
        // The origin for this image is 0,0.
        origin: new google.maps.Point(0,0),
        // The anchor for this image is the base of the bike at 0,32.
        anchor: new google.maps.Point(34,61)
        };

        var shape = {
        coords: [0 , 0, 68, 45],
        type: 'rect'
        };
        
        var marqueur = new google.maps.Marker({
            position: new google.maps.LatLng(latitude,longitude),
            map: carte,
            icon: image,
            shape: shape
            });

        var infowindow = new google.maps.InfoWindow({
            content: '<a href="reserver.php">reserver</a></br>',
            size: new google.maps.Size(100, 100),
            position: new google.maps.LatLng(latitude,longitude)
            });
            google.maps.event.addListener(marqueur, 'click', function(){
            infowindow.open(carte,marqueur);
            });

      }



      }
    </script>




</head>

<body onload="initialiser()">
<style type="text/css">

</style>

<table border="0" cellpadding="0" cellspacing="0" width="964" align="center">
<tr>
  <td valign="top" align="center">
    <img src="image/logo.jpg"/>
    <div style="margin:5px 0px 20px 0px">
  <table border="0">
    <tr>
      <td><a class="rollover" href="presentation.htm"><img src="image/pres1.jpg" border="0"><!-- <img src="image/pres1-1.png" border="0" class="rollover"> --></a></td>
      <td><a class="rollover" href="preter.htm"><img src="image/preter.jpg" border="0"><!--img src="../new_menu/2-1.png" border="0" class="rollover"--></a></td>
      <td><a class="rollover" href="emprunter.htm"><img src="image/emprunter.jpg" border="0"><!--img src="../new_menu/3-1.png" border="0" class="rollover"--></a></td>  
      <td><a class="rollover" href="contact.htm"><img src="image/contact.jpg" border="0"><!--img src="../new_menu/3-1.png" border="0" class="rollover"--></a></td>
    </tr>
  </table>
</div>  </td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td height="1" bgcolor="fedcba"></td>
  </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%" height="2px" align="center" style="background:url(/image/bg_sub.jpg) top left no-repeat;">
  <table border="0" cellpadding="100%" cellspacing="100%" width="100%" height="100%" style="margin-top:31px;">
    <tr width="100%" height="100%">     
      <!-- MODIFIER ICI !!!!!!!!!!!!!!!!!!!!!!!!!!!-->
      <td width="100%" height="100%">
      <div id="carte" style="width:100%; height:500px"></div>
      </td>
    </tr>
  </table>
<tr>
  
  <td width="20"></td></tr>
</table>
<td width="100%">
        <HR width="100%" align=left color="abcdef">
        <table border="0" cellpadding="0" cellspacing="0" width="674" style="margin-left:20px;"></table>
    </tbody></table>

        <table border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
          <td height="20">ou</td></tr>
        </tbody></table>
      </td>
    </tr>
    </tbody></table>
  </td>
<table border="0" cellpadding="0" cellspacing="0" width="964" align="left">
<tr>
  <td width="434"><a href="index.htm"><img src="image/logo.jpg" border="0" alt="logo"></a></td>
  <td width="530" align="right" valign="top"></td>
</tr>
</table>

</body>
</html>