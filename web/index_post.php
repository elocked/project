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
    
    $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if(isset($mail) AND isset($mdp) AND !empty($mail) AND !empty($mdp))
    {
         
        $req = $bdd -> query('SELECT prenom, mail, mdp FROM personne WHERE mail ='.$mail);
            while ($donnee = $req -> fetch())
        {
            if ($mail==$donnee['mail'] AND $mdp==$donnee['mdp'] )
            {
                $_SESSION['prenom'] = $donnee['prenom'];
            }

            elseif ($mail!=$donnee['mail'] OR $mdp!=$donnee['mdp'] )
            {
                echo '<p><strong> L\'email ou le mot de passe est incorrect </strong></p>';
            }
        }
 
        $req->closecursor();
         
    }
 
    else echo 'Un des champs est vide, veuillez le remplir !';
 
     
        // Puis rediriger vers minichat.php comme ceci :
    header('Location: index.php');
    ?>
 
</html>