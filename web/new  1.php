
<?php
session_start();
?>



<!DOCTYPE html> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="E-LOCKED TEAM">
<meta name="description" content="E-LOCKED PROJECT">
<meta name="keywords" content="lock, e-lock, cadnas, project">
<meta name="copyright" content="Tous droits reserves">
<meta name="subject" content="Projet E3 Cadenas Connecté">
<title>E-LOCKED</title>
<script src="/swf/js/flashObj.js" type="text/javascript"></script>
<link rel="stylesheet" href="A_NOMMER_PLUS_TARD.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
</script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen">
</head>
<!-- <script language="javascript">
jQuery.noConflict();
(function($) {
	$(document).ready(function() {
		$("a#single_image").fancybox();
		$("a#inline").fancybox({
			'hideOnContentClick': true
		});	
		$("a.group").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	false
		});
	});
})(jQuery);
</script> -->

<body>
<!--top_utility-->

<style type="text/css">
<!--
#text1 { position: absolute; top: 0; left: 0; width: 240; height: 25;visibility: hidden;}
-->
</style>

<table border="0" cellpadding="0" cellspacing="0" width="964" align="center">
<tr>
	<td	valign="top" align="center"> <!-- Tete de page + MENU -->
		<img src="image/logo.jpg"/>
		<!-- Menu Deroulant -->
		<div style="margin:5px 0px 20px 0px">
	<table border="0">
		<tr>
			<td><a class="rollover" href="presentation.htm"><img src="image/pres1.jpg" border="0"><!-- <img src="image/pres1-1.png" border="0" class="rollover"> --></a></td>
			<td><a class="rollover" href="preter.htm"><img src="image/preter.jpg" border="0"><!--img src="../new_menu/2-1.png" border="0" class="rollover"--></a></td>
			<td><a class="rollover" href="emprunter.htm"><img src="image/emprunter.jpg" border="0"><!--img src="../new_menu/3-1.png" border="0" class="rollover"--></a></td>	
			<td><a class="rollover" href="contact.htm"><img src="image/contact.jpg" border="0"><!--img src="../new_menu/3-1.png" border="0" class="rollover"--></a></td>
		</tr>
	</table>
</div>	</td>
</tr>
</table>

<!-- Ligne de Separation -->
avant la ligne
<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td height="1" bgcolor="fedcba"></td></tr></table>
apres la ligne<br/>
<!-- Fin Ligne de Separation -->

<!-- Main Partie GAUCHE -->
<table border="0" cellpadding="0" cellspacing="0" width="964" align="center" style="background:url(/image/bg_sub.jpg) top left no-repeat;">
	<table border="0" cellpadding="0" cellspacing="0" style="margin-top:31px;">
		<tr>
			<td width="120" valign="top">
				<!-- Menu du GAUCHE -->
				<table width="190" border="0" cellpadding="0" cellspacing="0" style="margin-left:20px;">
				<tr><td valign="top"><a href="index.htm"><img src="image/btn_m01_s0102.jpg" border="0" alt="contenuA"></a></td></tr>
				<tr><td><a href="index02.htm" class="rollover"><img src="image/btn_m01_s0201.jpg" border="0" alt="contenuB"></a></td></tr>
				<tr><td><a href="index03.htm" class="rollover"><img src="image/btn_m01_s0301.jpg" border="0" alt="contenuC"></a></td></tr>
				<tr><td height="30" style="background:url(/image/bg_lnb_dot.jpg) no-repeat bottom left;"></td></tr>
				</table>
				<!-- Fin du Menu du Gauche -->
				<!-- Espace du bas -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr><td height="21"></td></tr>
				</table>
				<!-- Fin Espace du bas -->
			</td>
			<td width="100%" valign="top">
				<!--PARTIE CENTRALE A COMPLETER POUR CHAQUE FEUILLE-->
				ICI !!! <br/>
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
<tr>
	
	<td width="20"></td></tr>
</table>
<!-- Fin Main Partie GAUCHE -->

<!--pied de page-->
<td width="100%">
				debut
				<HR width="100%" align=left color="abcdef">
				fin
				<!-- Fin Ligne Separation -->

				<table border="0" cellpadding="0" cellspacing="0" width="674" style="margin-left:20px;"></table>
		</tbody></table>

				<table border="0" cellpadding="0" cellspacing="0">
				<tbody><tr>
					<td height="20">ou</td></tr>
				</tbody></table>
			</td>
		</tr>
		</tbody></table>
	</td>
<!-- FIN DE LA PARTIE CENTRALE A COMPLETER POUR CHAQUE PAGE-->

<table border="0" cellpadding="0" cellspacing="0" width="964" align="left">
<tr>
	<td width="434"><a href="index.htm"><img src="image/logo.jpg" border="0" alt="logo"></a></td>
	<td width="530" align="right" valign="top"></td>
</tr>
</table>
<!-- Fin Pied de Page -->

</body>
</html>