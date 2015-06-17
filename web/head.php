
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
  top.document.location = "head.php?var1="+latuser+"&var2="+lonuser; 
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


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php include('GoogleMapAPI.class.php');?>
<link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="./css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <!-- Le paramètre "sensor" indique si cette application utilise détecteur pour déterminer la position de l'utilisateur -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="./js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="./js/bootstrap.js"></script>
<script type="text/javascript" src="./js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="./js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    <script type="text/javascript">
    //fonction date aujourd'hui, retourne : yyyy-mm-dd HH:ii
    function today(){
    var today = new Date();
    var month = today.getMonth()+1;
    var minutes = today.getMinutes();
    var hours = today.getHours();
    var jour = today.getDate();
    if(month<10){month="0"+month;}
    if(minutes<10){minutes="0"+minutes;}
    if(jour<10){jour="0"+jour;}
    if(hours<10){hours="0"+hours;}
    return today.getFullYear()+"-"+month+"-"+jour+" "+hours+":"+minutes; }

    function hoursone(){
      var date = new Date();
      var hours = date.getHours()+1;
      if(hours<10){hours="0"+hours;}
      return hours;}

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
        
        $K = new GoogleMapAPI();
        
          //////////////////////////////////////////////////////////////////////
          //affiche les vélos emmpruntés
          /////////////////////////////////////////////////////////////////////
          if(verifEmprunt($bdd,$idPersonne,date("Y-m-d H:i:s"))){
          $emp = $bdd ->query("SELECT e.FinEmprunt, et.Longitude,et.Latitude FROM emprunt AS e
                  INNER JOIN etatcadenas AS et ON e.idCadenas=et.idCadenas
                  WHERE e.idPersonne='$idPersonne' AND et.Dispo=0");
          while($donnee=$emp -> fetch()){
          if($donnee['FinEmprunt']>date("Y-m-d H:i:s")){?>
            //marqueur réservé
            setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>',0,'<?php echo $K->geoGetDistanceInKM($donnee['Latitude'],$donnee['Longitude'],$latuser, $lonuser)?>',0,1);

          <?php }}
          $emp->closecursor();}

          else{
          /////////////////////////////////////////////////////////////////////////
          //velo de la map
          ////////////////////////////////////////////////////////////////////////
                $req = $bdd -> query("SELECT et.idCadenas,et.Latitude, et.Longitude FROM etatcadenas AS et 
                                      INNER JOIN cadenas AS c ON et.idCadenas=c.idCadenas
                                      WHERE c.idProprio!='$idPersonne' AND Dispo=1 ");
                while($donnee=$req -> fetch()){
               if($donnee==TRUE and isset($donnee)){?>
               //création du marqueur
                setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>','<?php echo $donnee['idCadenas'];?>','<?php echo $K->geoGetDistanceInKM($donnee['Latitude'],$donnee['Longitude'],$latuser, $lonuser)?>','<?php echo stars($donnee['idCadenas'])?>',0);
              
              <?php }
               else echo 'Pas de velo disponible </br>';  }
              $req->closecursor();

           }

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
              url: 'image/holyblue.png',
               // This marker is 68 pixels wide by 61 pixels tall.
              size: new google.maps.Size(37, 40),
              // The origin for this image is 0,0.
              origin: new google.maps.Point(0,0),
              // The anchor for this image is the base of the bike at 0,32.
              anchor: new google.maps.Point(18.5,40)
              };

             var content ='<form  action="visionnage.php" class="form-horizontal"  method="POST"><div class="container"><fieldset><div class="form-group"><b>Reservation :</b>&nbsp;'+distance+' m<img src="rating/'+note+'stars.gif" ALIGN="right" /></div><label for="heure_debut" class="col-md-2 control-label">De : </label><div class="input-group date form_datetime col-md-10" data-date='+today()+' data-date-format="yyyy mm dd - hh:ii " data-link-field="heure_debut" id="heure_debut" value=""><input class="form-control" name="heure_debut" size="10" type="text" value="" ><span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span><span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span></div><br/></br><label for="heure_fin" class="col-md-2 control-label">Au : </label><div class="input-group date form_datetime col-md-10" data-date='+today()+' data-date-format="yyyy mm dd - hh:ii " data-link-field="heure_fin" id="heure_fin" value =""><input class="form-control" name="heure_fin" size="10" type="text" value="" ><span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span><span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span></div><input type="hidden" name="idCadenas" value='+idCadenas+'><br/></div></fieldset></br><p style="text-align: center;"><input type="submit" class="btn btn-default" value="Réserver" /></p></form></div>';
             /*var content ='<form name="resaform" action="reserver.php" method="POST"><b>Reservation : </b>'+distance+' m</div></br><img src="rating/'+note+'stars.gif" /></div></br><table><tr><td>Heure debut&nbsp;:</td><td><input type="datetime" name="heure_debut" /></td></tr><tr><td>Heure fin&nbsp;:</td><td><input type="datetime" name="heure_fin" /><input type="hidden" name="idCadenas" value='+idCadenas+'></td></tr><tr><td><input type="submit" name="valider" value="Envoyer" /></form>';*/
            break;

            case 1:
             var image = {
              url: 'image/tarlouz.png',
              // This marker is 68 pixels wide by 61 pixels tall.
              size: new google.maps.Size(37, 40),
              // The origin for this image is 0,0.
              origin: new google.maps.Point(0,0),
              // The anchor for this image is the base of the bike at 0,32.
              anchor: new google.maps.Point(18.5,40)
              };

             var content ='<b>Le vélo que vous avez réservé : </b>'+distance+' m';
            break;

            case 2:
            var image = {
              url: 'image/lagreen.png',
               // This marker is 68 pixels wide by 61 pixels tall.
              size: new google.maps.Size(37, 40),
              // The origin for this image is 0,0.
              origin: new google.maps.Point(0,0),
              // The anchor for this image is the base of the bike at 0,32.
              anchor: new google.maps.Point(18.5,40)
              };


              var content ='<b>Votre vélo : </b>'+distance+' m';
            break;

            case 3:
            var image = {
              url: 'image/lagreenresa.png',
               // This marker is 68 pixels wide by 61 pixels tall.
              size: new google.maps.Size(37, 40),
              // The origin for this image is 0,0.
              origin: new google.maps.Point(0,0),
              // The anchor for this image is the base of the bike at 0,32.
              anchor: new google.maps.Point(18.5,40)
              };

              var content ='<b>Ce vélo est acctuellement réservé </b>';
            break;

          }
          
        var shape = {
        coords: [0 , 0, 37, 40],
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
         if (typeof( window.infoopened ) != 'undefined') infoopened.close();
          infowindow.open(carte,marqueur);
          infoopened = infowindow;

            var hours = hoursone();
           $('.form_datetime').datetimepicker({
              language: "fr",
              pickerPosition:"bottom-left",
              format: "yyyy-mm-dd hh:ii",
              todayBtn: 1,
              autoclose :1,
              hourMax : hours,
              minView : "hour"
            });
            });
               

    }
      }
    </script>
	
	<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/common.js"></script>
	<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/util.js"></script>
	<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/stats.js"></script>
	<body onload="initialiser()">
	<div style="height:1500px" id="carte"></div>
	</body>
