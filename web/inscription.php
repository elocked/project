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
    <td align=left>

        <form action='cible.php' method="POST">
        <p>
       <label>Nom : <input type="text" name="nom" value ="<?php if (isset($_SESSION['nom'])){echo $_SESSION['nom'];} ?>"/></label><br/>
        <br/>
        <label>Prénom : <input type="text" name="prenom" value="<?php if (isset($_SESSION['prenom'])){echo $_SESSION['prenom'];} ?>"/></label><br/>
        <br/>
        <label>Mail : <input type="email" name="mail" value="<?php if (isset($_SESSION['mail'])){echo $_SESSION['mail'];} ?>"/></label><br/>
        <br/>
        <label>Mot de passe : <input type="password" name="mdp" value="<?php if (isset($_SESSION['mdp'])){echo $_SESSION['mdp'];} ?>"/></label><br/>
        <br/>
        <label>Numéro de téléphone : <input type="tel" name="numtel"value="<?php if (isset($_SESSION['numtel'])){echo $_SESSION['numtel'];} ?>" /></label><br/>
        <br/>
        <label>Numéro CB : <input type="text" name="numcb"  value ="<?php if (isset($_SESSION['numcb'])){echo $_SESSION['numcb'];} ?>"/></label><br/>
        </p>
        <p><input type="submit" name="valider" value="Envoyer" /></p>

    
 
        
             
    </form>
 
     
    </td> 
    </tr>
    </table>
    </center> 
    </body>
</html>


