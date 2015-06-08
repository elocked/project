<?php

$bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

function recuperernfc($bdd,$idCadenas){
	global $bdd;
	$nfc= $bdd -> query("SELECT cleNFC FROM cadenas WHERE idCadenas='$idCadenas'");
	while($donnee=$nfc ->fetch()){
		echo $donnee['cleNFC'];
	}
}

function achatcadenas($bdd,$idPersonne){
	global $bdd;
	$cleNFC=1769;
	$verif=$bdd->query("SELECT idProprio FROM proprietaire WHERE idProprio='$idPersonne'");
         //vérifie si la personne fait partie de la base proprio et creer le cadenas dans la bdd
          if($verif -> fetch()){$achat=$bdd-> prepare("INSERT INTO cadenas(idProprio,cleNFC) VALUES (:idProprio,:cleNFC)");
		$achat ->execute(array('idProprio'=>$idPersonne,'cleNFC'=>$cleNFC));}
		//sinon la rajoute et creer le cadenas
		else {$verif=$bdd-> prepare("INSERT INTO proprietaire(idProprio) VALUES (:idPersonne)");
		$verif ->execute(array('idPersonne'=>$idPersonne));
		$achat=$bdd-> prepare("INSERT INTO cadenas(idProprio,cleNFC) VALUES (:idProprio,:cleNFC)");
		$achat ->execute(array('idProprio'=>$idPersonne,'cleNFC'=>$cleNFC));
		;}
}

function ajoutEtat($bdd,$idCadenas){
	global $bdd;
	$valide=$bdd->prepare("INSERT INTO etatcadenas(idCadenas,Longitude,Latitude,Dispo)VALUES(:idCadenas,NULL,NULL,NULL) ");
	$valide ->execute(array('idCadenas'=>$idCadenas));
}

function rendDisponible($bdd,$idCadenas,$Latitude,$Longitude){
	global $bdd;
	$etat= $bdd -> exec("UPDATE etatcadenas SET Longitude='$Longitude',Latitude='$Latitude', Dispo=1 WHERE idCadenas='$idCadenas'");

}

?>