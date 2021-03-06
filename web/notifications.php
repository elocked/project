<?php/*
session_start();
$_SESSION['idPersonne']=1;
$idPersonne=$_SESSION['idPersonne'];*/

//include('reserver.php');
include('fonctions.php');?>



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
$req = $bdd -> query("SELECT n.id_notif, d.idPersonne,d.idCadenas,d.Heure_debut,d.Heure_fin FROM notif AS n
					  		INNER JOIN demande AS d ON n.id_demande=d.id_demande
					  		INNER JOIN cadenas AS c ON d.idCadenas=c.idCadenas
					  		WHERE c.idProprio='$idPersonne' AND n.vu=0 
					  		ORDER BY n.Date_notif DESC");
		while($donnee=$req -> fetch()){
			$personne=$donnee['idPersonne'];
			$req1= $bdd -> query("SELECT nom,prenom FROM personne WHERE idPersonne='$personne'");
			while($donnee1=$req1 -> fetch()){
				if(isset($donnee1['nom']) AND isset($donnee1['prenom'])){
					echo 'Le sharelocker '.'<b>'.ucfirst($donnee1['nom']).' '.ucfirst($donnee1['prenom']).' </b>souhaite emprunter votre vélo pour '.tempEmprunt($donnee['Heure_debut'],$donnee['Heure_fin']).'</br>';
					echo '_______________________________________________________________________________________________________';
					valide($bdd,$donnee['id_notif'],$donnee['idCadenas'],$donnee['Heure_debut'],$donnee['Heure_fin'],$personne);
					//refuse($bdd,$donnee['id_notif']);
				}
				else echo 'Pas de notifications</br>';
			}
			$req1->closecursor();
		}
		$req->closecursor();
		
}
//notifproprio($bdd,$idPersonne);

function nbrnotifProprio($bdd,$idPersonne){
global $bdd;
$req = $bdd -> query("SELECT COUNT(n.id_notif) AS nb_notif FROM notif AS n
					  		INNER JOIN demande AS d ON n.id_demande=d.id_demande
					  		INNER JOIN cadenas AS c ON d.idCadenas=c.idCadenas
					  		WHERE c.idProprio='$idPersonne' AND n.vu=0 ");
if($donnee=$req -> fetch()) $n =$donnee['nb_notif'];
$req->closecursor();
return $n;
}
//echo nbrnotifProprio($bdd,$idPersonne);



//$id_notif=$donnee['id_notif'] / $idCadenas=$donnee['idCadenas'] / $heure_debut=$donnee['Heure_debut'] / $heure_fin=$donnee['Heure_fin']
function valide($bdd,$id_notif,$idCadenas,$heure_debut,$heure_fin,$personne){
	global $bdd;
	$notif = $bdd -> exec("UPDATE notif SET vu=1, valide=1 WHERE id_notif='$id_notif' ");
	$etat= $bdd -> exec("UPDATE etatcadenas SET Dispo=0 WHERE idCadenas='$idCadenas'");
	$emprunt= $bdd -> prepare('INSERT INTO `emprunt`(`DebutEmprunt`, `FinEmprunt`,`idCadenas`,`idPersonne`) VALUES (:date_debut,:date_fin,:idCadenas,:idPersonne)');
		$emprunt ->execute(array(
        'date_debut' =>$heure_debut,
        'date_fin' => $heure_fin,
        'idCadenas' =>$idCadenas,
        'idPersonne' =>$personne
                 ));
	$emprunt->closecursor();
	annuleDemande($bdd,$personne,$idCadenas,$heure_fin);
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
//deleteDemande($bdd,$idPersonne);

function notifuser($bdd,$idPersonne){
	global $bdd;
	$date_hier=date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." - 1 day"));
	$del= $bdd-> exec("DELETE FROM notif WHERE Date_notif <'$date_hier' AND vu=1");
	$del = $bdd -> exec("DELETE FROM demande WHERE date_demande <'$date_hier' AND idPersonne='$idPersonne'");
	/*$req = $bdd ->query("SELECT COUNT(id_notif) AS nb_notif FROM notif AS n 
								INNER JOIN demande AS d ON n.id_demande=d.id_demande
								WHERE d.idPersonne='$idPersonne' AND n.valide=0");
		if($donnee=$req -> fetch())
			{echo 'Vous avez '.$donnee['nb_notif'].' demande(s) non validée(s)</br>';}
	$req->closecursor();

	$req1 = $bdd ->query("SELECT COUNT(e.idCadenas) AS nb_cadenas FROM emprunt AS e
									INNER JOIN demande AS d ON e.idCadenas=d.idCadenas
									INNER JOIN notif AS n ON n.id_demande=d.id_demande
									WHERE d.idPersonne='$idPersonne' AND n.valide=1 ");
		
	if($donnee=$req1 -> fetch()){echo 'Vous avez '.$donnee['nb_cadenas'].' demande(s) validée(s)</br>';}
	$req1->closecursor();*/
	}

//notifuser($bdd,$idPersonne);

function nbrnotifUser($bdd,$idPersonne,$date){
		global $bdd;
	$req1 = $bdd ->query("SELECT COUNT(e.idCadenas) AS nb_cadenas FROM emprunt
									WHERE idPersonne='$idPersonne' AND FinEmprunt>'$date'");
	if($donnee=$req1 -> fetch()) $p=$donnee['nb_cadenas'];
	$req1->closecursor();	
	return $p;
}
//echo nbrnotifUser($bdd,$idPersonne);

function tempEmprunt($h1,$h2){
$date1=new DateTime($h1);
$date2=new DateTime($h2);
$daten=$date1->diff($date2);
return $daten->format('%a jour(s), %H heure(s) et %I minute(s) ');
}
//echo tempEmprunt($h1,$h2);

function annuleDemande($bdd,$idPersonne,$idCadenas,$heure_fin){
global $bdd;
$req = $bdd ->query("SELECT id_demande,Heure_debut FROM demande WHERE idPersonne ='$idPersonne' OR idCadenas='$idCadenas'");
while($donnee=$req->fetch()){
  if($donnee['Heure_debut']<$heure_fin){
  $demande=$donnee['id_demande'];
$del= $bdd-> exec("DELETE FROM notif WHERE id_notif ='$demande'");
}}
if($req->fetch()){
$del1= $bdd -> exec("DELETE FROM demande WHERE idPersonne ='$idPersonne' AND Heure_debut<'$heure_fin'");
}
$req ->closecursor();
}
?>

