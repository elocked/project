<?php 
session_start();
if(!empty($_SESSION['prenom'])){$prenom=$_SESSION['prenom'];}

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


<script> 
    $(function(){
      $("#includedContent").load("html.css"); 
    });
    </script>

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
    <script type="text/javascript">
      function initialiser() {
        <?php
        $latuser=htmlspecialchars($_GET['var1']);
        $lonuser=htmlspecialchars($_GET['var2']);
        ?>
        var latlng = new google.maps.LatLng('<?php echo $latuser ;?>','<?php echo $lonuser; ?>');
        //objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
        //de définir des options d'affichage de notre carte
        var options = {
          center: latlng,
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        //constructeur de la carte qui prend en paramêtre le conteneur HTML
        //dans lequel la carte doit s'afficher et les options
        var carte = new google.maps.Map(document.getElementById("carte"), options);

        <?php
        $req = $bdd -> query("SELECT idCadenas,Latitude, Longitude FROM etatcadenas WHERE Dispo=1 ");
        $K = new GoogleMapAPI();
        while($donnee=$req -> fetch()){
          if($donnee==TRUE and isset($donnee)){?>
            //création du marqueur
           setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>','<?php echo $donnee['idCadenas'];?>','<?php echo $K->geoGetDistanceInKM($donnee['Latitude'],$donnee['Longitude'],$latuser, $lonuser)?>');
            
         <?php }
          else echo 'Pas de velo disponible </br>';
                           }
        $req->closecursor();
        ?>

        function setmarqueur(latitude , longitude ,idCadenas, distance){
          
          var image = {
        url: 'image/marqueur.png',
        // This marker is 68 pixels wide by 61 pixels tall.
        size: new google.maps.Size(68, 61),
        // The origin for this image is 0,0.
        origin: new google.maps.Point(0,0),
        // The anchor for this image is the base of the bike at 0,32.
        anchor: new google.maps.Point(34,61)
        };

        var shape = {
        coords: [0 , 0, 68, 45],
        type: 'rect'
        };
        
        var marqueur = new google.maps.Marker({
            position: new google.maps.LatLng(latitude,longitude),
            map: carte,
            icon: image,
            shape: shape
            });

		var content ='<form name="resaform" action="index.php" method="POST"><b>Reservation : </b>'+distance+' m<table><tr><td>Heure debut&nbsp;:</td><td><input type="time" name="heure_debut" /></td></tr><tr><td>Heure fin&nbsp;:</td><td><input type="time" name="heure_fin" /><input type="hidden" name="idCadenas" value='+idCadenas+'></td></tr><tr><td><input type="submit" name="valider" value="Envoyer" /></form>';
			
        var infowindow = new google.maps.InfoWindow({
            content: content,
            size: new google.maps.Size(100, 100),
            position: new google.maps.LatLng(latitude,longitude)
            });
            google.maps.event.addListener(marqueur, 'click', function(){
            infowindow.open(carte,marqueur);
            });

      }



      }
    </script>

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

		<div id="adminmenuwrap" style="">

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
					<a href="visionnage.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-page"><br></div><div class="wp-menu-name">Louer un Velo</div></a>
					<ul class="wp-submenu wp-submenu-wrap"></ul>
				</li>
				<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" id="menu-pages">
					<a href="#" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" aria-haspopup="true">
					<div class="wp-menu-arrow">
					<div></div></div>
					<div class="wp-menu-image dashicons-before dashicons-admin-page"><br></div>
					<div class="wp-menu-name">Notification <span id="notification_count">3</span> </div></a>
					<ul class="wp-submenu wp-submenu-wrap">
						NOTIFICATION PAR LA
						
					</ul>
				</li>
				<li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" id="toplevel_page_wpcf7"><a href="contact.php" class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-email"><br></div><div class="wp-menu-name">Contact</div></a>
					<ul class="wp-submenu wp-submenu-wrap"></ul>
				</li>
			</ul>

	
		</div>
		<div id="wpcontent">
			<div id="wpadminbar" class="" role="navigation">
			<a class="screen-reader-shortcut" href="#wp-toolbar" tabindex="1">Skip to toolbar</a>
			<div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Top navigation toolbar." tabindex="0">
				<ul id="wp-admin-bar-root-default" class="ab-top-menu">
		
					<li id="wp-admin-bar-menu-toggle">
						<a class="ab-item" href="#" aria-expanded="false">
							<span class="ab-icon"></span>
							<span class="screen-reader-text">Menu</span>
						</a>
					</li>
					<li id="wp-admin-bar-wp-logo" class="menupop">
						<a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/wp-admin/about.php" title="About WordPress">
							<span class="ab-icon"></span>
						</a>
						<div class="ab-sub-wrapper">
							<ul id="wp-admin-bar-wp-logo-default" class="ab-submenu">
								<li id="wp-admin-bar-about">
									<a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/about.php">About WordPress</a>		
								</li>
							</ul>
							<ul id="wp-admin-bar-wp-logo-external" class="ab-sub-secondary ab-submenu">
								<li id="wp-admin-bar-wporg">
									<a class="ab-item" href="https://wordpress.org/">WordPress.org</a>
								</li>
								<li id="wp-admin-bar-documentation">
									<a class="ab-item" href="http://codex.wordpress.org/">Documentation</a>		
								</li>
								<li id="wp-admin-bar-support-forums">
									<a class="ab-item" href="https://wordpress.org/support/">Support Forums</a>		
								</li>
								<li id="wp-admin-bar-feedback">
									<a class="ab-item" href="https://wordpress.org/support/forum/requests-and-feedback">Feedback</a>		
								</li>
							</ul>
						</div>
					</li>
					<li id="wp-admin-bar-site-name" class="menupop">
						<a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/">Hotel Du Moulin</a>
							<div class="ab-sub-wrapper">
							<ul id="wp-admin-bar-site-name-default" class="ab-submenu">
								<li id="wp-admin-bar-view-site">
								<a class="ab-item" href="http://www.hotelmoulin.com/">Visit Site</a>
								</li>
							</ul>
							</div>
							</li>
						<li id="wp-admin-bar-updates">
						<a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/update-core.php" title="1 WordPress Update, 7 Plugin Updates, 3 Theme Updates">
							<span class="ab-icon"></span>
							<span class="ab-label">11</span>
							<span class="screen-reader-text">1 WordPress Update, 7 Plugin Updates, 3 Theme Updates</span>
						</a>
					</li>
					<li id="wp-admin-bar-comments">
						<a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/edit-comments.php" title="0 comments awaiting moderation">
							<span class="ab-icon"></span>
							<span id="ab-awaiting-mod" class="ab-label awaiting-mod pending-count count-0">0</span>
						</a>
					</li>

					
					<li id="wp-admin-bar-WPML_ALS" class="menupop"><div class="ab-item ab-empty-item" aria-haspopup="true" title="Showing content in: EN"><img class="icl_als_iclflag" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png" alt="en" width="18" height="12">&nbsp;EN&nbsp;&nbsp;<img title="help" id="wpml_als_help_link" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/img/question1.png" alt="help" width="16" height="16"></div><div class="ab-sub-wrapper"><ul id="wp-admin-bar-WPML_ALS-default" class="ab-submenu">
					<li id="wp-admin-bar-WPML_ALS_fr"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/index.php?lang=fr&amp;admin_bar=1" title="Show content in: FR"><img class="icl_als_iclflag" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/fr.png" alt="fr" width="18" height="12">&nbsp;FR</a>		</li>
					<li id="wp-admin-bar-WPML_ALS_ko"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/index.php?lang=ko&amp;admin_bar=1" title="Show content in: 한국어"><img class="icl_als_iclflag" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/ko.png" alt="ko" width="18" height="12">&nbsp;한국어</a>		</li>
					<li id="wp-admin-bar-WPML_ALS_all"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/index.php?lang=all" title="Show content in: All languages"><img class="icl_als_iclflag" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/img/icon16.png" alt="all" width="16" height="16">&nbsp;All languages</a>		</li></ul></div>		</li></ul><ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
					
					<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/wp-admin/profile.php" title="My Account">Bonjour,<img alt="" src="http://1.gravatar.com/avatar/7a73b30510c9b67ba688b0d80b6551e8?s=26&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D26&amp;r=G" class="avatar avatar-26 photo" height="26" width="26"></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class="ab-submenu">
					<li id="wp-admin-bar-user-info"><a class="ab-item" tabindex="-1" href="http://www.hotelmoulin.com/wp-admin/profile.php"><img alt="" src="http://1.gravatar.com/avatar/7a73b30510c9b67ba688b0d80b6551e8?s=64&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D64&amp;r=G" class="avatar avatar-64 photo" height="64" width="64"><span class="display-name">hotelmoulin-admin</span></a>		</li>
					<li id="wp-admin-bar-edit-profile"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/profile.php">Edit My Profile</a>		</li>
					<li id="wp-admin-bar-logout"><a class="ab-item" href="http://www.hotelmoulin.com/wp-login.php?action=logout&amp;_wpnonce=e649fee277">Log Out</a>		</li></ul></div>		</li></ul>			</div>
						<a class="screen-reader-shortcut" href="http://www.hotelmoulin.com/wp-login.php?action=logout&amp;_wpnonce=e649fee277">Log Out</a>
					</div>
						<!--NOTIFICATION-->
						
				<link rel="stylesheet" type="text/css" href="css.css">
				<script type="text/javascript" src="jquery.js"></script>
				<script type="text/javascript" >
				$(document).ready(function()
				{
				$("#notificationLink").click(function()
				{
				$("#notificationContainer").fadeToggle(300);
				$("#notification_count").fadeOut("slow");
				return false;
				});

				//Document Click hiding the popup 
			$(document).click(function()
				{
					$("#notificationContainer").hide();
				});

			//Popup on click
			$("#notificationContainer").click(function()
				{
				return false;
				});

				});
				</script>
<ul id="nav">
	<li id="notification_li">
	<span id="notification_count">3</span>
	<a href="#" id="notificationLink">Mes Notifications</a>	
	<div id="notificationContainer">	
	<div id="notificationTitle">Notifications</div>	
	<div id="notificationsBody" class="notifications"></div>
	<div id="notificationFooter">
	<a href="#">See All</a>
	</div>
	</div>
	</li>
</ul>
						
						<!--FIN NOTIFICATION-->
						<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" aria-haspopup="true" title="My Account">Bonjour, <img alt="" src="image/photo_pers.jpg" class="avatar avatar-26 photo" height="26" width="26"></a><div class="ab-sub-wrapper"></div></li>
					</ul>			
				</div>
			<div id="wpbody">
				<div id="wpbody-content" aria-label="Main content" tabindex="0" style="overflow: hidden;">
					<div class="wrap">
						<br/><h1>Titre de la page</h1>
						<?php   
						if(isset($prenom)AND !empty($prenom)) { echo 'Bonjour '.$prenom;}

						else {?><form action='index_post.php' method="POST">
       				 <p>
       				<label>Mail : <input type="email" name="mail"/></label><br/>
        			<br/>
        			<label>Mot de passe : <input type="password" name="mdp" /></label><br/>
        			<br/>
        	        <p><input type="submit" name="valider" value="Envoyer" /></p> 
             
   				 	</form>		 
							<?php echo 'Veuillez vous identifier, si ce n\'est pas déjà fait, dirigez vous sur ce lien : <a href=\formulaire.php >Inscription';}?></a><br/>

						
					<form action='index_post.php' method="POST">
					<p><input type="submit" name="deconnecter" value="Deconnecter"/><input type="hidden" name="deco" value="deco"></p>
					</form>
	<div id="dashboard-widgets-wrap">
	</div><!-- dashboard-widgets-wrap -->

</div><!-- wrap -->


			<div class="clear"></div>
				</div><!-- wpbody-content -->
			<div class="clear"></div>
			</div><!-- wpbody -->
			<div class="clear"></div>

<div id="wp-responsive-overlay" style="display: none;"></div><!-- wpcontent -->

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