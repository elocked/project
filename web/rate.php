<?php


function stars(){

$bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$req = $bdd -> query("SELECT idCadenas,Latitude, Longitude FROM etatcadenas WHERE Dispo=1 ");
        while($donnee=$req -> fetch()){
          if($donnee==TRUE and isset($donnee)){
          	$idcadenas=$donnee['idCadenas'];
			$req2 = $bdd -> query("SELECT note FROM personne WHERE idpersonne=(SELECT idproprio FROM cadenas WHERE idCadenas='$idcadenas')");
			while($donnee=$req2 -> fetch()){
			$n=$donnee['note'];}
			echo '<img src="rating/'.$n.'stars.gif" /></div> ';
			//echo $n;
           }}
       }

?>