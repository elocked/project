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
        <label>Nom : <input type="text" name="nom" value ="<?php if (isset($_GET['nom'])){echo $_GET['nom'];} ?>"/></label><br/>
        <br/>
        <label>Prénom : <input type="text" name="prenom" value="<?php if (isset($_GET['prenom'])){echo $_GET['prenom'];} ?>"/></label><br/>
        <br/>
        <label>Mail : <input type="text" name="mail" value="<?php if (isset($_GET['mail'])){echo $_GET['mail'];} ?>"/></label><br/>
        <br/>
        <label>Mot de passe : <input type="password" name="mdp" value="<?php if (isset($_GET['mdp'])){echo $_GET['mdp'];} ?>"/></label><br/>
        <br/>
        <label>Numéro de téléphone : <input type="text" name="numtel"value="<?php if (isset($_GET['numtel'])){echo $_GET['numtel'];} ?>" /></label><br/>
        <br/>
        <label>Numéro CB : <input type="text" name="numcb"  value ="<?php if (isset($_GET['numcb'])){echo $_GET['numcb'];} ?>"/></label><br/>
        </p>
        <p><input type="submit" name="valider" value="Envoyer" /></p>

 
 
        
             
    </form>
 
     
    </td> 
    </tr>
    </table>
    </center> 
    </body>
</html>


