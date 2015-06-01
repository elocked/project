<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Index</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
 
    <body>
         
    <?php
    $mail=htmlspecialchars($_POST['mail']);
    $mdp=htmlspecialchars($_POST['mdp']);
    $deco=$_POST['deco'];
    
    $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if(isset($mail) AND isset($mdp) AND !empty($mail) AND !empty($mdp))
    {
         
        $req = $bdd -> query("SELECT idPersonne, prenom, mail, mdp FROM personne WHERE mail ='$mail'") or die('erreur');
            while ($donnee = $req -> fetch())
        {
            if ($mail==$donnee['mail'] AND password_verify($mdp,$donnee['mdp']))
            {
                $_SESSION['prenom'] = $donnee['prenom'];
                $_SESSION['idPersonne'] = $donnee['idPersonne'];
            }

            elseif ($mail!=$donnee['mail'] OR password_verify($mdp,$donnee['mdp'])==false)
            {
                echo '<p><strong> L\'email ou le mot de passe est incorrect </strong></p>';
            }
        }
 
        $req->closecursor();
         
    }
 
    if(isset($deco))session_destroy();
 
        //redirection
    header('Location: index.php');
    ?>
 
</html>