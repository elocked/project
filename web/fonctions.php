<?php
//$bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

function reservation($bdd,$idPersonne){
			global $bdd;
              $heure_debut=htmlspecialchars($_POST['heure_debut']);
              $heure_fin=htmlspecialchars($_POST['heure_fin']);
              //if(preg_match('#^[0-9]{2}\:[0-9]{2}$#', $heure_debut) AND preg_match('#^[0-9]{2}\:[0-9]{2}$#', $heure_fin))
              //{
                //$heure = date("H:i");
                //$heure_suivante=date("H:i", strtotime($heure." + 1 hours"));
                //if($heure_debut <= $heure_suivante){
                  $req2 = $bdd ->prepare('INSERT INTO `demande`(`idPersonne`, `idCadenas`, `Heure_debut`, `Heure_fin`, `Date_demande`) VALUES (:idPersonne, :idCadenas, :heure_debut, :heure_fin ,NOW())');
                  $req2->execute(array(
                  'idPersonne' => $idPersonne,
                  'idCadenas' => $_POST['idCadenas'],
                  'heure_debut' => $heure_debut,
                  'heure_fin' => $heure_fin
                  ));
                  $req2->closecursor();
                  insertnotif($bdd,$idPersonne);
                  notifproprio($bdd,1);
                 // }           
              //}
          }

function stars($idCadenas){
        global $bdd;
        $req2 = $bdd -> query("SELECT note FROM personne WHERE idpersonne=(SELECT idproprio FROM cadenas WHERE idCadenas='$idCadenas')");
        while($donnee=$req2 -> fetch()){
        $n=$donnee['note'];}
        $req2->closecursor();
        return $n;
}

function recuperernfc($bdd,$idCadenas){
	global $bdd;
	$nfc= $bdd -> query("SELECT cleNFC FROM cadenas WHERE idCadenas='$idCadenas'");
	while($donnee=$nfc ->fetch()){
		echo $donnee['cleNFC'];
	}
}

function deverouillage($bdd,$idPersonne){
	global $bdd;
	$dev= $bdd -> query("SELECT e.DebutEmprunt,e.FinEmprunt,e.idCadenas FROM emprunt AS e
								INNER JOIN demande AS d ON e.idCadenas=d.idCadenas
								WHERE d.idPersonne='$idPersonne'");
	while($donnee=$dev -> fetch()){
		if($donnee['DebutEmprunt']<=date("Y-m-d H:i:s") AND $donnee['FinEmprunt']>=date("Y-m-d H:i:s")){
			recuperernfc($bdd,$donnee['idCadenas']);}
	}
}



function achatcadenas($bdd,$idPersonne,$cleNFC){
	global $bdd;
          if(verifProprio($bdd,$idPersonne)){$achat=$bdd-> prepare("INSERT INTO cadenas(idProprio,cleNFC) VALUES (:idProprio,:cleNFC)");
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
function changeEtat($bdd,$idCadenas,$Latitude,$Longitude){
	global $bdd;
	$etat= $bdd -> exec("UPDATE etatcadenas SET Longitude='$Longitude',Latitude='$Latitude', Dispo=CASE
 										WHEN Dispo=1 THEN 0
										WHEN Dispo=0 THEN 1
										END
										WHERE idCadenas='$idCadenas'");
}

function verifProprio($bdd,$idPersonne){
	global $bdd;
	$verif=$bdd->query("SELECT idProprio FROM proprietaire WHERE idProprio='$idPersonne'");
         //vérifie si la personne fait partie de la base proprio et creer le cadenas dans la bdd
     if($verif -> fetch()) $p=TRUE;
     else $p= FALSE;
     $verif->closecursor();
     return $p;
}


function verifEmprunt($bdd,$idPersonne,$date){
global $bdd;
$req=$bdd ->query("SELECT idEmprunt FROM emprunt WHERE idPersonne='$idPersonne' AND FinEmprunt>'$date'");
if($req->fetch()) return true;
else return false;
}


?>

