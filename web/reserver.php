<?php 
session_start();
$_SESSION['idPersonne']=2;
$idPersonne=$_SESSION['idPersonne'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<?php  
$bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

include('notifications.php');
include('fonctions.php');

//reservation
if(isset($_POST['heure_debut']) AND isset($_POST['heure_fin']))reservation($bdd,$idPersonne);


?>

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
<meta name="subject" content="Projet E3 Cadenas Connecte">
<title>E-LOCKED</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <!-- Inclusion de l'API Google MAPS -->
    <?php include('GoogleMapAPI.class.php');?>
    <link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="./css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
    <!-- Le paramètre "sensor" indique si cette application utilise détecteur pour déterminer la position de l'utilisateur -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="./js/jquery-1.8.3.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.fr.js"></script>
    <script type="text/javascript" src="./js/respond.min.js"></script>
    <script type="text/javascript">
    
      $('#datetime').datetimepicker({
       todayBtn:"true",
        format:"yyyy-mm-dd hh:ii", 
        autoclose:"true",
        pickerPosition:"bottom-center",
        startView:"year",
        minView:"hour",
        language:"fr"
        });

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
        /////////////////////////////////////////////////////////////////////////
        //velo de la map
        /////////////////////////////////////////////////////////////////////////
        $req = $bdd -> query("SELECT et.idCadenas,et.Latitude, et.Longitude FROM etatcadenas AS et 
                                      INNER JOIN cadenas AS c ON et.idCadenas=c.idCadenas
                                      WHERE c.idProprio!='$idPersonne' AND Dispo=1 ");
        $K = new GoogleMapAPI();
        while($donnee=$req -> fetch()){
          if($donnee==TRUE and isset($donnee)){?>
            //création du marqueur
           setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>','<?php echo $donnee['idCadenas'];?>','<?php echo $K->geoGetDistanceInKM($donnee['Latitude'],$donnee['Longitude'],$latuser, $lonuser)?>','<?php echo stars($donnee['idCadenas'])?>',0);
              
         <?php }
          else echo 'Pas de velo disponible </br>';  }
        $req->closecursor();

          //////////////////////////////////////////////////////////////////////
          //affiche les vélos emmpruntés
          /////////////////////////////////////////////////////////////////////
          $date=date("Y-m-d");
          $emp = $bdd ->query("SELECT e.FinEmprunt, et.Longitude,et.Latitude FROM emprunt AS e
                  INNER JOIN demande AS d ON e.idCadenas=d.idCadenas
                  INNER JOIN etatcadenas AS et ON d.idCadenas=et.idCadenas
                  WHERE d.idPersonne='$idPersonne' AND et.Dispo=0 AND d.Date_demande>'$date' ");
          while($donnee=$emp -> fetch()){
          if($donnee['FinEmprunt']>date("H:i:s")){?>
            //marqueur réservé
            setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>',0,'<?php echo $K->geoGetDistanceInKM($donnee['Latitude'],$donnee['Longitude'],$latuser, $lonuser)?>',0,1);

          <?php }}
          $emp->closecursor();

        //////////////////////////////////////////////////////////////////////////
        //affiche les vélos du propriétaire
        /////////////////////////////////////////////////////////////////////////
        if(verifProprio($bdd,$idPersonne)){
         $vp = $bdd ->query("SELECT et.Dispo, et.idCadenas, et.Latitude, et.Longitude FROM etatcadenas AS et 
                                      INNER JOIN cadenas AS c ON et.idCadenas=c.idCadenas
                                      WHERE c.idProprio='$idPersonne'");
          while($donnee=$vp -> fetch()){
            if($donnee['Dispo']==1){?>
              //marqueur proprio disponible
              setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>','<?php echo $donnee['idCadenas'];?>','<?php echo $K->geoGetDistanceInKM($donnee['Latitude'],$donnee['Longitude'],$latuser, $lonuser)?>',0,2);

           <?php }
            else{?>
              //marqueur proprio indisponible
              setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>',0,0,0,3);
              
            <?php }      }
          $vp->closecursor();
        }

        ?>
        ///////////////////////////////////////////////////////////////////////////
        function setmarqueur(latitude ,longitude ,idCadenas, distance, note, mode){
        

          switch(mode){
            case 0:
              var image = {
              url: 'image/marqueur.png',
              // This marker is 68 pixels wide by 61 pixels tall.
              size: new google.maps.Size(40, 37),
               // The origin for this image is 0,0.
              origin: new google.maps.Point(0,0),
               // The anchor for this image is the base of the bike at 0,32.
              anchor: new google.maps.Point(20,37)
              };
              var content ='<form class="form-horizontal col-lg-4" role="form"><div class="form-group"><label for="datetime">Date Time</label><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span><span class="glyphicon glyphicon-time"></span></span><input class="form-control datetime" id="datetime" type="text" value="" readonly></div></div><button type="submit" class="btn btn-default">Submit</button></form>';
             /*var content ='<form name="resaform" action="reserver.php" method="POST"><b>Reservation : </b>'+distance+' m</div></br><img src="rating/'+note+'stars.gif" /></div></br><table><tr><td>Heure debut&nbsp;:</td><td><input type="datetime" name="heure_debut" /></td></tr><tr><td>Heure fin&nbsp;:</td><td><input type="datetime" name="heure_fin" /><input type="hidden" name="idCadenas" value='+idCadenas+'></td></tr><tr><td><input type="submit" name="valider" value="Envoyer" /></form>';*/
            break;

            case 1:
             var image = {
              url: 'image/marqueurr.png',
              // This marker is 68 pixels wide by 61 pixels tall.
              size: new google.maps.Size(40, 37),
              // The origin for this image is 0,0.
              origin: new google.maps.Point(0,0),
              // The anchor for this image is the base of the bike at 0,32.
              anchor: new google.maps.Point(20,37)
              };

             var content ='<b>Le vélo que vous avez réservé : </b>'+distance+' m';
            break;

            case 2:
            var image = {
              url: 'image/marqueurg.png',
              // This marker is 68 pixels wide by 61 pixels tall.
              size: new google.maps.Size(40, 37),
              // The origin for this image is 0,0.
              origin: new google.maps.Point(0,0),
              // The anchor for this image is the base of the bike at 0,32.
              anchor: new google.maps.Point(20,37)
              };

              var content ='<b>Votre vélo : </b>'+distance+' m';
            break;

            case 3:
            var image = {
              url: 'image/marqueurg.png',
              // This marker is 68 pixels wide by 61 pixels tall.
              size: new google.maps.Size(40, 37),
              // The origin for this image is 0,0.
              origin: new google.maps.Point(0,0),
              // The anchor for this image is the base of the bike at 0,32.
              anchor: new google.maps.Point(20,37)
              };

              var content ='<b>Ce vélo est acctuellement réservé </b>';
            break;

          }
          
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
            content: content ,
            size: new google.maps.Size(100, 100),
            position: new google.maps.LatLng(latitude,longitude),
            maxWidth: 350
        });
        google.maps.event.addListener(marqueur, 'click', function(){
        
            infowindow.open(carte,marqueur);
            });        
    }


      }
      
    </script>

  <!--<form class="form-horizontal col-lg-4" role="form"><div class="form-group">
    <label for="datetime">Date Time</label>
    <div class="input-group">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span><span class="glyphicon glyphicon-time"></span></span>
      <input class="form-control datetime" id="datetime" type="text" value="" readonly>
    </div>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>-->

</head>

<body onload="initialiser()">
<style type="text/css"></style>

<!-- Script de récupération de la résolution du body -->
<script type="text/javascript">
if (document.body)
{
var larg = (document.body.clientWidth);
var haut = (document.body.clientHeight);
}
else
{
var larg = (window.innerWidth);
var haut = (window.innerHeight);
}
//alert("La résolution de votre écran est : "+screen.width+" x "+screen.height+"\n\n");
//alert("Cette fenêtre fait " + larg + " de large et "+haut+" de haut");
</script>



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
      <div id="carte" style="width:1920px; height:1280px"></div>
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