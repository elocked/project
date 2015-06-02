
<?php 
//important pour utiliser des variables de SESSION
session_start();
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
    </head>
 
    <body>
    <center>
 
    <table width=900 height=600 border=0> 
    <tr>
    <td align=center>
 
     
 
<p>Bonjour <?php $_SESSION['prenom']= htmlspecialchars($_POST['prenom']) ;
                 echo $_SESSION['prenom'];?></p>
<p><a href="index.php" onclick="<?php session_destroy();?>">revenir sur la page d'accueil</a></p>


<?php
    //connexion bdd
    try
    {
    $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    //recuperation des données
    $compteur=0;
    $mdp=htmlspecialchars($_POST['mdp']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $nom=htmlspecialchars($_POST['nom']);
    

    //cryptage de mdp
    $hashed_mdp=password_hash($mdp,PASSWORD_BCRYPT);






    /*if (isset($_POST['nom']))
    {
        $nom=htmlspecialchars($_POST['nom']);
        echo 'je post nom';
    }
    else {$compteur++;}

    if (isset($_POST['prenom']))
    {
        $nom=htmlspecialchars($_POST['prenom']);
        echo 'je post prenom';
    }
    else {$compteur++;}

    if (isset($_POST['mdp']))
    {

        $nom=htmlspecialchars($_POST['mdp']);
        echo 'je post mdp';
    }
    else {$compteur++;}
    */

    //Vérification de numero de telephone
    if (isset($_POST['numtel']))
    {
     if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#",htmlspecialchars($_POST['numtel'])))
    {
        $numtel=$_POST['numtel'];
    }
    else
    {
        echo 'Le ' . $_POST['numtel'] . ' n\'est pas valide, recommencez !';
        $compteur ++;
    }
    }


    //vérification du mail
    if (isset($_POST['mail']))
    {
    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", htmlspecialchars($_POST['mail'])))
    {
        $mail=$_POST['mail'];
    }
    else
    {
        echo 'L\'adresse ' . $_POST['mail'] . ' n\'est pas valide, recommencez !';
        $compteur ++;
    }
    }


    //vérification de la CB
    if(isset($_POST['numcb'])){
    if (preg_match("#^([0-9]{13,16})$#", htmlspecialchars($_POST['numcb'])))
    {
        $numcb=$_POST['numcb'];
        $hashed_numcb=password_hash($numcb,PASSWORD_BCRYPT);
    }
    else
    {
        echo 'Le numero de cb : ' . $_POST['numcb'] . ' n\'est pas valide, recommencez !';
        $compteur ++;
    }
    }
    ?>
    <br/>



    <?php

    //insertion des variables récuperé par POST dans des variable de SESSION (pas nécessaire, utile pour maintenir la connexion)
    $_SESSION['nom']=$nom ;
    $_SESSION['mail']=$mail;
    $_SESSION['numtel']=$numtel ;
    $_SESSION['mdp']=$mdp ;
    $_SESSION['numcb']=$numcb ;

    //s'il n'y a pas d'erreur dans les vérification ($compteur=0), prépare une requete d'insertion dans la table "personne" puis on insere les variables vérifié dans les values.
    if($compteur==0){
    $req = $bdd->prepare('INSERT INTO personne(nom, prenom, mail, numtel, note, mdp, numcb, DateCrea) VALUES(:nom, :prenom, :mail, :numtel, NULL, :mdp, :numcb, NOW())');
    $req->execute(array(
    'nom' => $nom,
    'prenom' => $prenom,
    'mail' => $mail,
    'numtel' => $numtel,
    'mdp' => $hashed_mdp,
    'numcb' => $hashed_numcb
    ));
    }

    ?>
  
    <p>Merci !<p>
    
 
   
</td> 
</tr>
</table>
</center> 
     
 
    </body>
</html>