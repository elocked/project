<?php 
session_start();
$_SESSION['idPersonne']=1;
$idPersonne=$_SESSION['idPersonne'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<?php  
$bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 //reservation()

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
              }}
?>


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="E-LOCKED TEAM">
	<meta name="description" content="E-LOCKED PROJECT">
	<meta name="keywords" content="lock, e-lock, cadenas, project">
	<meta name="copyright" content="Tous droits reserves">
	<meta name="subject" content="Projet E3 Cadenas Connecté">
	<title>E-LOCKED</title>	
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="stylecss.css">
<link rel="stylesheet" href="http://www.hotelmoulin.com/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load=dashicons,admin-bar,wp-admin,buttons,wp-auth-check&amp;ver=4.1.5" type="text/css" media="all">
<link rel="stylesheet" id="toolset-font-awesome-css" href="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/css/font-awesome.min.css?ver=d0dccd3d170fb7c50a6818bab3129bbc" type="text/css" media="all">
<link rel="stylesheet" id="thickbox-css" href="http://www.hotelmoulin.com/wp-includes/js/thickbox/thickbox.css?ver=9c87c8c05733cefe4a108603b9c0994b" type="text/css" media="all">
<link rel="stylesheet" id="wpml-tm-styles-css" href="http://www.hotelmoulin.com/wp-content/plugins/wpml-translation-management/res/css/style.css?ver=378c91f4296676045fa2ab20ec5fb7bc" type="text/css" media="all">
<link rel="stylesheet" id="wpml-tm-queue-css" href="http://www.hotelmoulin.com/wp-content/plugins/wpml-translation-management/res/css/translations-queue.css?ver=378c91f4296676045fa2ab20ec5fb7bc" type="text/css" media="all">
<link rel="stylesheet" id="installer-admin-css" href="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/inc/installer/res/css/admin.css?ver=cdc8b6532f5c06e7f8306b5e9178d8cd" type="text/css" media="all">
<link rel="stylesheet" id="open-sans-css" href="//fonts.googleapis.com/css?ver=a21ee7abb643eea5891a2a5dde24c135" type="text/css" media="all">
<link rel="stylesheet" id="colors-css" href="?ver=e8125d7eca939a7bde4880755f8f0229" type="text/css" media="all">
<!--[if lte IE 7]>
<link rel='stylesheet' id='ie-css'  href='http://www.hotelmoulin.com/wp-admin/css/ie.min.css?ver=9c87c8c05733cefe4a108603b9c0994b' type='text/css' media='all' />
<![endif]-->
<link rel="stylesheet" id="sitepress-style-css" href="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/css/style.css?ver=d0dccd3d170fb7c50a6818bab3129bbc" type="text/css" media="all">
<link rel="stylesheet" id="translate-taxonomy-css" href="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/css/taxonomy-translation.css?ver=d0dccd3d170fb7c50a6818bab3129bbc" type="text/css" media="all">
<link rel="stylesheet" id="wpml-sticky-links-css-css" href="http://www.hotelmoulin.com/wp-content/plugins/wpml-sticky-links/res/css/management.css?ver=bbec7b9ac1c4a402d497d61991fa148c" type="text/css" media="all">

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <!-- Inclusion de l'API Google MAPS -->
    <?php include('GoogleMapAPI.class.php'); ?>
    <!-- Le paramètre "sensor" indique si cette application utilise détecteur pour déterminer la position de l'utilisateur -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>


<body class="wp-admin wp-core-ui js  index-php auto-fold admin-bar branch-4-1 version-4-1-5 admin-color-fresh locale-en-us customize-support svg sticky-menu" onload="initialiser()">
	<style type="text/css"></style>
	
	<!-- Script de récupération de la résolution du body -->
	<script type="text/javascript">
	if (document.body)
		{
		var larg = (document.body.clientWidth);
		var haut = (document.body.clientHeight);
		}
		else
		{
		var larg = (window.innerWidth);
		var haut = (window.innerHeight);
		}
	</script>
	
	<div id="wpwrap">

		<div id="adminmenuwrap">

			<ul id="adminmenu" role="navigation">
				<li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true">
					<div class="separator"></div></li>
					<li class="wp-has-submenu wp-not-current-submenu open-if-no-js menu-top menu-icon-post menu-top-first" id="menu-posts">
					<a href="profil.php" class="wp-has-submenu wp-not-current-submenu open-if-no-js menu-top menu-icon-post menu-top-first" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-post"><br></div><div class="wp-menu-name">Mon Profil</div></a>
					<ul class="wp-submenu wp-submenu-wrap"></ul>
					</li>
				<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" id="menu-media">
					<a href="velos.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-media"><br></div><div class="wp-menu-name">Mes Velos</div></a>
					<ul class="wp-submenu wp-submenu-wrap"></ul>
				</li>
				<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" id="menu-pages">
					<a href="GoogleMap.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-page"><br></div><div class="wp-menu-name">Louer un Velo</div></a>
					<ul class="wp-submenu wp-submenu-wrap"></ul>
				</li>
				<li class="wp-not-current-submenu menu-top menu-icon-comments" id="menu-comments">
					<a href="#" class="wp-not-current-submenu menu-top menu-icon-comments"><div class="wp-menu-arrow"></div><div class="wp-menu-image dashicons-before dashicons-admin-comments"><br/></div><div class="wp-menu-name">Notification <span class="awaiting-mod count-0"><span class="pending-count">0</span></span></div></a>
				</li>
				<li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" id="toplevel_page_wpcf7"><a href="contact.php" class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-email"><br></div><div class="wp-menu-name">Contact</div></a>
					<ul class="wp-submenu wp-submenu-wrap"></ul>
				</li>
			</ul>

	
		</div>
<div id="wpcontent">
			<div id="wpadminbar" class="" role="navigation">
				<div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Top navigation toolbar." tabindex="0">
					<ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
						<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" aria-haspopup="true" title="My Account">Bonjour, E-Lockers<img alt="" src="image/photo_pers.jpg" class="avatar avatar-26 photo" height="26" width="26"></a><div class="ab-sub-wrapper"></div></li>
					</ul>			
				</div>
			</div>
			<div id="wpbody">
				<div id="wpbody-content" aria-label="Main content" tabindex="0" style="overflow: hidden;">
					<div class="wrap">
						<br/><h1>Inscription</h1>

	<div id="dashboard-widgets-wrap">
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
	</div><!-- dashboard-widgets-wrap -->

</div><!-- wrap -->


<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->
<div class="clear"></div></div><div id="wp-responsive-overlay" style="display: none;"></div><!-- wpcontent -->

<div id="wpfooter">
		<p id="footer-left" class="alignleft">
			© Copyrights. ALL RIGHTS RESERVED</p>
	<div class="clear"></div>
</div>
	
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-admin/load-scripts.php?c=1&amp;load%5B%5D=thickbox,hoverIntent,common,admin-bar,jquery-form,wp-ajax-response,jquery-color,wp-lists,quicktags,jquery-query,admin-comments,j&amp;load%5B%5D=query-ui-core,jquery-ui-widget,jquery-ui-mouse,jquery-ui-sortable,postbox,dashboard,customize-base,customize-loader,plugin-insta&amp;load%5B%5D=ll,shortcode,media-upload,svg-painter,heartbeat,wp-auth-check&amp;ver=4.1.5"></script>
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-content/plugins/wordpress-seo/js/wp-seo-admin-global.min.js?ver=450bf84a432b37ff9714ba070da35ef7"></script>
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/js/icl-admin-notifier.js?ver=d0dccd3d170fb7c50a6818bab3129bbc"></script>

<div class="clear"></div></div><!-- wpwrap -->
<script type="text/javascript">if(typeof wpOnload=='function')wpOnload();</script>


<div class="quick-draft-textarea-clone" style="display: none; font-family: 'Open Sans', sans-serif; font-size: 14px; line-height: 19.6000003814697px; padding: 6px 7px; white-space: pre-wrap; word-wrap: break-word;"></div>
<div id="customize-container"></div>

</body>
</html>