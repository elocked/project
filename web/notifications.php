<?php/*
session_start();
$_SESSION['idPersonne']=1;
$idPersonne=$_SESSION['idPersonne'];*/

//include('reserver.php');?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php
//$bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 

//envoie du message (coté user)
function insertnotif($bdd,$idPersonne){
global $bdd;
$req = $bdd -> query("SELECT id_demande FROM demande WHERE idpersonne='$idPersonne' ORDER BY Date_demande DESC LIMIT 1");
        while($donnee=$req -> fetch()){
        $id_demande=$donnee['id_demande'];}
        $req->closecursor();

$req1 = $bdd ->prepare('INSERT INTO `notif`(`id_demande`, `vu`, `Date_notif`) VALUES (:id_demande,:vu,NOW())');
   		$req1->execute(array(
        'id_demande' => $id_demande,
        'vu' => 0
         ));
   		$req1->closecursor();
}

//reception message (proprio) , $idpersonne est le proprio / COUNT(n.id-notif)
function notifproprio($bdd,$idPersonne){
global $bdd;
$req = $bdd -> query("SELECT COUNT(n.id_notif) AS nb_notif,n.id_notif, d.idPersonne,d.idCadenas,d.Heure_debut,d.Heure_fin FROM notif AS n
					  		INNER JOIN demande AS d ON n.id_demande=d.id_demande
					  		INNER JOIN cadenas AS c ON d.idCadenas=c.idCadenas
					  		WHERE c.idProprio='$idPersonne' AND n.vu=0 
					  		ORDER BY n.Date_notif DESC");
		while($donnee=$req -> fetch()){
			$personne=$donnee['idPersonne'];
			//echo 'Nb notification : '.$donnee['nb_notif'].'</br>';
			$req1= $bdd -> query("SELECT nom,prenom FROM personne WHERE idPersonne='$personne'");
			while($donnee1=$req1 -> fetch()){
				if(isset($donnee1['nom']) AND isset($donnee1['prenom'])){
					$time = gmdate('H:i',strtotime($donnee['Heure_fin']) - strtotime($donnee['Heure_debut']));
					//echo 'Le sharelocker '.ucfirst($donnee1['nom']).' '.ucfirst($donnee1['prenom']).' souhaite emprunter votre vélo pour '.$time.' h</br>';
					valide($bdd,$donnee['id_notif'],$donnee['idCadenas'],$donnee['Heure_debut'],$donnee['Heure_fin'],$time,$personne);
					//refuse($bdd,$donnee['id_notif']);
				}
				else echo 'Pas de notifications</br>';
			}
		}
		$req->closecursor();
		$req1->closecursor();
}
//notifproprio($bdd,$idPersonne);

//$id_notif=$donnee['id_notif'] / $idCadenas=$donnee['idCadenas'] / $heure_debut=$donnee['Heure_debut'] / $heure_fin=$donnee['Heure_fin']
function valide($bdd,$id_notif,$idCadenas,$heure_debut,$heure_fin,$time,$personne){
	global $bdd;
	$notif = $bdd -> exec("UPDATE notif SET vu=1, valide=1 WHERE id_notif='$id_notif' ");
	$etat= $bdd -> exec("UPDATE etatcadenas SET Dispo=0 WHERE idCadenas='$idCadenas'");
	$emprunt= $bdd -> prepare('INSERT INTO `emprunt`(`DebutEmprunt`, `FinEmprunt`, `Duree`, `idCadenas`,`idPersonne`) VALUES (:date_debut,:date_fin,:duree,:idCadenas,:idPersonne)');
		$emprunt ->execute(array(
        'date_debut' =>$heure_debut,
        'date_fin' => $heure_fin,
        'duree' => $time,
        'idCadenas' =>$idCadenas,
        'idPersonne' =>$personne
                 ));
	$emprunt->closecursor();
}


function refuse($bdd,$id_notif){
	global $bdd;
	$notif = $bdd -> exec("UPDATE notif SET vu=1, valide=0 WHERE id_notif='$id_notif' ");
}

function deleteDemande($bdd,$idPersonne){
	global $bdd;
	$date_hier=date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." - 1 day"));
	$del = $bdd -> exec("DELETE FROM demande WHERE date_demande <'$date_hier' AND idPersonne='$idPersonne'");
}

function notifuser($bdd,$idPersonne){
	global $bdd;
	$date_hier=date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." - 1 day"));
	$del= $bdd-> exec("DELETE FROM notif WHERE Date_notif <'$date_hier' AND vu=1");
	$del = $bdd -> exec("DELETE FROM demande WHERE date_demande <'$date_hier' AND idPersonne='$idPersonne'");
	$req = $bdd ->query("SELECT COUNT(id_notif) AS nb_notif FROM notif AS n 
								INNER JOIN demande AS d ON n.id_demande=d.id_demande
								WHERE d.idPersonne='$idPersonne' AND n.valide=0");
	while($donnee=$req -> fetch()){
		if($donnee['nb_notif']!=0)
			{echo 'Vous avez '.$donnee['nb_notif'].' demande(s) non validée(s)</br>';}
	}
	$req->closecursor();

	$req1 = $bdd ->query("SELECT COUNT(e.idCadenas) AS nb_cadenas FROM emprunt AS e
									INNER JOIN demande AS d ON e.idCadenas=d.idCadenas
									INNER JOIN notif AS n ON n.id_demande=d.id_demande
									WHERE d.idPersonne='$idPersonne' AND n.valide=1 ");
		while($donnee=$req1 -> fetch()){
			if($donnee['nb_cadenas']!=0){echo 'Vous avez '.$donnee['nb_cadenas'].' demande(s) validée(s)</br>';}
		}
	$req1->closecursor();
}

//notifuser($bdd,$idPersonne);




?>