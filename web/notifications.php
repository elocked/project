<?php 

//envoie du message (coté user)
function insertnotif($bdd,$idpersonne){
global $bdd;
$req = $bdd -> query("SELECT id_demande FROM demande WHERE idpersonne='$idpersonne' ORDER BY Date_demande DESC LIMIT 1");
        while($donnee=$req -> fetch()){
        $id_demande=$donnee['id_demande'];}
$req1 = $bdd ->prepare('INSERT INTO `notif`(`id_demande`, `vu`, `Date_notif`) VALUES (:id_demande,:vu,NOW())');
    $req1->execute(array(
        'id_demande' => $id_demande,
        'vu' => 0
         ));
}

//reception message (proprio)
function notifproprio($bdd,$idpersonne){
	
}

?>