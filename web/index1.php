<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon super site</title>
    </head>
 
    <body>
    <center>
    <table width=900 height=600 border=0> 
    <tr>
    <td align=center>
     
    <form action="cible.php" method="POST">
        <p><label>Prénom : <input type="texte" name="prenom" /></label></p>
        <p><input type="submit" /></p>
        <p><label>Etes-vous végétarien ? <input type="checkbox" name="vegetarien" /></label></p>
        <p><label>Etes-vous professeur ? <input type="checkbox" name="prof" checked ="checked" /></label></p>
 
        Aimez-vous les frites ?
        <input type="radio" name="frites" value="oui" id="oui" checked="checked" /> <label for="oui">Oui</label>
        <input type="radio" name="frites" value="non" id="non" /> <label for="non">Non</label>
         
        <p>Vous voulez laisser un commentaire? sortez votre plume :</p>
        <textarea name="message" rows="8" cols="45">
         
        </textarea>
 
    <p>De quel pays venez-vous ?</p>
        <select name="choix">
    <option value="France">France</option>
    <option value="Angleterre">Angleterre</option>
    <option value="USA" selected="selected">USA</option>
    <option value="Chine">Chine</option>
    </select>
    </form>
 
    <form action="cible_envoi.php" method="post" enctype="multipart/form-data">
        <p>
                Formulaire d'envoi de fichier :<br />
                <input type="file" name="monfichier" /><br />
                <input type="submit" value="Envoyer le fichier" />
        </p>
</form>
    </td> 
    </tr>
    </table>
    </center> 
    </body>
</html>