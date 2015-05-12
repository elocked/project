
<?php 
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

    $_SESSION['nom']=$nom ;
    $_SESSION['mail']=$mail;
    $_SESSION['numtel']=$numtel ;
    $_SESSION['mdp']=$mdp ;
    $_SESSION['numcb']=$numcb ;
        //requete 
    if($compteur==0){
    $req = $bdd->prepare('INSERT INTO personne(nom, prenom, mail, numtel, note, mdp,numcb) VALUES(:nom, :prenom, :mail, :numtel, NULL, :mdp, :numcb)');
    $req->execute(array(
    'nom' => $nom,
    'prenom' => $prenom,
    'mail' => $mail,
    'numtel' => $numtel,
    'mdp' => $hashed_mdp,
    'numcb' => $hashed_numcb
    ));//array($_POST['nom'])
    }

    //session_destroy();
    ?>
  
    <p>Merci !<p>
    
 
   
</td> 
</tr>
</table>
</center> 
     
 
    </body>
</html>