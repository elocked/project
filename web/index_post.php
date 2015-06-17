<?php
//important pour utiliser des variables de SESSION
session_start();
//Pour utiliser des variables de SESSION:
//if(!empty($_SESSION['exemple']))
//{$variable=$_SESSION['exemple'];}
// 
//Si $_SESSION['exemple'] noin vide, enregistre la variable SESSION dans une variable locale. Utiliser $variable dans le reste du code. 
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
    //recuperation des valeurs POST
    $mail=htmlspecialchars($_POST['mail']);
    $mdp=htmlspecialchars($_POST['mdp']);
    $deco=$_POST['deco'];
    

    //ouverture de la bdd
    $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    //detection des variables $mail et $mdp. Si elles existent et ne sont pas vides
    if(isset($mail) AND isset($mdp) AND !empty($mail) AND !empty($mdp))
    {
        //recherche des champs dans "personne" où mail = $mail 
        $req = $bdd -> query("SELECT idPersonne, prenom, mail, mdp FROM personne WHERE mail ='$mail'") or die('erreur');
            while ($donnee = $req -> fetch())
        {   //Si $mail = mail trouvé dans la bdd et que la comparaison des mot de passe renvoie TRUE
            if ($mail==$donnee['mail'] AND password_verify($mdp,$donnee['mdp']))
            {   //insertion des donnee recupereés dans la bdd dans des variables de SESSION
                $_SESSION['prenom'] = $donnee['prenom'];
                $_SESSION['idPersonne'] = $donnee['idPersonne'];
            }
            //pas utile car jamais affiché pour l'instant
            elseif ($mail!=$donnee['mail'] OR password_verify($mdp,$donnee['mdp'])==false)
            {
                echo '<p><strong> L\'email ou le mot de passe est incorrect </strong></p>';
            }
        }
        //indispensable , ferme la recherche
        $req->closecursor();
         
    }
    
    //si la variable deco existe, ferme la session.
    if(isset($deco))session_destroy();
 
    //Charge la page index.php
    header('Location: codepen.php');
    ?>
 
</html>