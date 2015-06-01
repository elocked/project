<?php 
session_start();
$_SESSION['idPersonne']=1;
$idPersonne=$_SESSION['idPersonne'];
?>

 <?php        
         function reserver(){
            $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $req1 = $bdd -> query("SELECT idPersonne, idCadenas FROM demande WHERE idPersonne='$idPersonne'");
           while($donnee1=$req1 -> fetch()){
            if(isset($donnee1['idCadenas']) AND $donnee1['idCadenas']==$_POST['idCadenas']){
              echo 'Votre demande à bien été prise en compte';
            }
           elseif(isset($_POST['heure_debut']) AND isset($_POST['heure_fin']) ){
              $heure_debut=htmlspecialchars($_POST['heure_debut']);
              $heure_fin=htmlspecialchars($_POST['heure_fin']);
              if(preg_match('#^[0-9]{2}\:[0-9]{2}$#', $heure_debut) AND preg_match('#^[0-9]{2}\:[0-9]{2}$#', $heure_fin))
              {
                $heure = date("H:i");
                $heure_suivante=date("H:i", strtotime($heure." + 1 hours"));
                if($heure_debut <= $heure_suivante){
                  echo $heure_debut.' '.$heure_fin.' '.$idPersonne.' '.$donnee['idCadenas'].'<br/>';
                  $req2 = $bdd ->prepare('INSERT INTO `demande`(`idPersonne`, `idCadenas`, `Heure_debut`, `Heure_fin`, `Date_demande`) VALUES (:idPersonne, :idCadenas, :heure_debut, :heure_fin ,NOW())');
                  $req2->execute(array(
                  'idPersonne' => $idPersonne,
                  'idCadenas' => $_POST['idCadenas'],
                  'heure_debut' => $heure_debut,
                  'heure_fin' => $heure_fin
                  ));
                echo 'Merci, à bientôt !';
                }
                else echo 'Heure de début n\'est pas valide';
              }
              else echo 'Veuilliez entrer une heure valide';
            }
            else {?>
              <form action='reserver.php' method="POST" id="form">
              <label>Heure fin : <input type="time" name="heure_fin"/></label><br/>
              <br/>
              <label>Heure début : <input type="time" name="heure_debut" /></label><br/>
              <br/>
              <p><input type="submit" name="valider" value="Envoyer" /></p> 
              </form> 
          <?php }
            }   }

            //reserver();
            //header('Location: reserver.php');
            ?>


             <?php/*
             $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          if(isset($_POST['heure_debut']) AND isset($_POST['heure_fin']) ){
              $heure_debut=htmlspecialchars($_POST['heure_debut']);
              $heure_fin=htmlspecialchars($_POST['heure_fin']);
              if(preg_match('#^[0-9]{2}\:[0-9]{2}$#', $heure_debut) AND preg_match('#^[0-9]{2}\:[0-9]{2}$#', $heure_fin))
              {
                $heure = date("H:i");
                $heure_suivante=date("H:i", strtotime($heure." + 1 hours"));
                if($heure_debut <= $heure_suivante){
                  $req2 = $bdd ->prepare('INSERT INTO `demande`(`idPersonne`, `idCadenas`, `Heure_debut`, `Heure_fin`, `Date_demande`) VALUES (:idPersonne, :idCadenas, :heure_debut, :heure_fin ,NOW())');
                  $req2->execute(array(
                  'idPersonne' => $idPersonne,
                  'idCadenas' => $_POST['idCadenas'],
                  'heure_debut' => $heure_debut,
                  'heure_fin' => $heure_fin
                  ));
                  }           
              }
              
          }*/?>
            
             function verifier(){
        <?php
        $req1 = $bdd -> query("SELECT idPersonne, idCadenas FROM demande WHERE idPersonne='$idPersonne'");
           while($donnee1=$req1 -> fetch()){
            if(isset($donnee1['idCadenas']) AND $donnee1['idCadenas']==8){?>
              content ='Votre demande à bien été prise en compte';
            <?php}
            else {?>
              
                 <?php}
               }?>

             return content;  
             }
