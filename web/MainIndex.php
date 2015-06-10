<?php 
session_start();
$_SESSION['idPersonne']=1;
$idPersonne=$_SESSION['idPersonne'];
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="E-LOCKED TEAM">
	<meta name="description" content="E-LOCKED PROJECT">
	<meta name="keywords" content="lock, e-lock, cadenas, project">
	<meta name="copyright" content="Tous droits reserves">
	<meta name="subject" content="Projet E3 Cadenas Connecté">
	<title>E-LOCKED</title>	
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="stylecss.css">

<!--[if lte IE 7]>
<link rel='stylesheet' id='ie-css'  href='http://www.hotelmoulin.com/wp-admin/css/ie.min.css?ver=9c87c8c05733cefe4a108603b9c0994b' type='text/css' media='all' />
<![endif]-->

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <!-- Inclusion de l'API Google MAPS -->
        <!-- Le paramètre "sensor" indique si cette application utilise détecteur pour déterminer la position de l'utilisateur -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script><script src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
      function initialiser() {
        var latlng = new google.maps.LatLng('','');
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

<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/common.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/util.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/stats.js"></script>
</head>
<!----------------------------------------------------- FIN HEADER----------------------------------------------------------->
<!------------------------------------------------------DEBUT BODY----------------------------------------------------------->
<body class="wp-admin wp-core-ui js  index-php auto-fold admin-bar branch-4-1 version-4-1-5 admin-color-fresh locale-en-us customize-support svg sticky-menu" onload="initialiser()">
<div id="wpwrap">
	<div id="adminmenuback"></div>
		<div id="adminmenuwrap">
		<ul id="adminmenu" role="navigation">
			<li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true">
				<div class="separator"></div></li>
				<li class="wp-has-submenu wp-not-current-submenu open-if-no-js menu-top menu-icon-post menu-top-first" id="menu-posts">
				<a href="profil.php" class="wp-has-submenu wp-not-current-submenu open-if-no-js menu-top menu-icon-post menu-top-first" aria-haspopup="true">
				<div class="wp-menu-arrow"></div>
				<div class="wp-menu-image dashicons-before dashicons-admin-post"><br></div>
				<div class="wp-menu-name">Mon Profil</div></a>
				<ul class="wp-submenu wp-submenu-wrap"></ul>
				</li>
			<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" id="menu-media">
				<a href="velos.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" aria-haspopup="true">
					<div class="wp-menu-arrow"></div>
					<div class="wp-menu-image dashicons-before dashicons-admin-media"><br></div>
					<div class="wp-menu-name">Mes Velos</div>
				</a>
				<ul class="wp-submenu wp-submenu-wrap"></ul>
			</li>
			<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" id="menu-pages">
				<a href="visionnage.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" aria-haspopup="true">
				<div class="wp-menu-arrow"></div>
				<div class="wp-menu-image dashicons-before dashicons-admin-page"><br></div>
				<div class="wp-menu-name">Louer un Velo</div></a>
				<ul class="wp-submenu wp-submenu-wrap"></ul>
			</li>
			<li class="wp-not-current-submenu menu-top menu-icon-comments" id="menu-comments">
				<a href="#" class="wp-not-current-submenu menu-top menu-icon-comments">
				<div class="wp-menu-arrow"></div>
				<div class="wp-menu-image dashicons-before dashicons-admin-comments"><br/></div>
				<div class="wp-menu-name">Notification♣ <span id="notification_counter">3</span></div></a>
				<ul class="wp-submenu wp-submenu-wrap">
						<link rel="stylesheet" type="text/css" href="css.css">
										<script type="text/javascript" src="jquery.js"></script>
										<script type="text/javascript" >
										$(document).ready(function()
										{
										$("#notificationLink").click(function()
										{
										$("#notificationContainer").fadeToggle(300);
										$("#notification_count").fadeOut("slow");
										$("#notification_counter").fadeOut("slow");
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
								<span id="notification_count">3</span>
								<li id="notification_li">
									<a href="#" id="notificationLink">Notification★</a>
									<div id="notificationContainer">
										<div id="notificationTitle">Notifications♥</div>
										<div id="notificationsBody" class="notifications">jen ai un</div>
										<div id="notificationFooter"><a href="#">See All</a></div>
									<!--<div id="notifications" style="top: 147px; left: 201.971374511719px; display: block;">
										<ul class="notifications-list list-unstyled">
											<li class="" data-id="LD83vF7rR2qNwIGShHTN0w" data-target="/show/279121/episode/5042818/comment/677993">
												<a href="/user/66302/profile" class="user">J.U.L</a> a commenté l'épisode <a href="/show/279121/episode/5042818" class="episode">S01E09</a> de <a href="/show/279121" class="show">The Flash (2014)</a>
												<div class="time-ago">5 days ago</div>
											</li>
    
											<li class="" data-id="8ntvmB5bQbuSc5n-y3iOqw" data-target="/show/279121/episode/5028739/comment/675280">
												<a href="/user/66302/profile" class="user">J.U.L</a> a commenté l'épisode <a href="/show/279121/episode/5028739" class="episode">S01E08</a> de <a href="/show/279121" class="show">The Flash (2014)</a>
												<div class="time-ago">6 days ago</div>
											</li>
    
											<li class="" data-id="oKKOitUPQQ6b8zAQ4A56iA" data-target="/user/66302/profile">
												<a href="/user/66302/profile" class="user">J.U.L</a> veut devenir votre ami sur TVShow Time
												<div class="time-ago">16 days ago</div>
											</li>
										</ul>
									</div>-->
									</div>
								</li>
							</ul>
					</ul>
			</li>
			<li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" id="toplevel_page_wpcf7">
			<a href="contact.php" class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" aria-haspopup="true">
			<div class="wp-menu-arrow"></div>
			<div class="wp-menu-image dashicons-before dashicons-email"><br></div>
			<div class="wp-menu-name">Contact</div></a>
				<ul class="wp-submenu wp-submenu-wrap"></ul>
			</li>
		</ul>
	</div>
	
	<div id="wpcontent">
		<div id="wpadminbar" class="" role="navigation">
			<div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Top navigation toolbar." tabindex="0">
				<ul id="wp-admin-bar-root-default" class="ab-top-menu">		
					<li id="wp-admin-bar-site-name" class="menupop">
						<a class="ab-item" aria-haspopup="true" href="#">Mes Notifications !</a>
							<div class="ab-sub-wrapper">
							<ul id="wp-admin-bar-site-name-default" class="ab-submenu">
								<li id="wp-admin-bar-view-site">
								<a class="ab-item" href="http://www.hotelmoulin.com/">Visit Site</a>
								</li>
									<li id="notification_li">
									<span id="notification_count">3</span>
									<a href="#" id="notificationLink">Mes Notifications</a>
									<div id="notificationContainer">
										<div id="notificationTitle">Notifications</div>
										<div id="notificationsBody" class="notifications"></div>
										<div id="notificationFooter"><a href="#">See All</a></div>
									</div>	
									</li>
							</ul>
							</div>
					</li>
				</ul>
				
				<ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
					
					<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/wp-admin/profile.php" title="My Account">Bonjour,<img alt="" src="http://1.gravatar.com/avatar/7a73b30510c9b67ba688b0d80b6551e8?s=26&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D26&amp;r=G" class="avatar avatar-26 photo" height="26" width="26"></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class="ab-submenu">
					<li id="wp-admin-bar-user-info"><a class="ab-item" tabindex="-1" href="http://www.hotelmoulin.com/wp-admin/profile.php"><img alt="" src="http://1.gravatar.com/avatar/7a73b30510c9b67ba688b0d80b6551e8?s=64&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D64&amp;r=G" class="avatar avatar-64 photo" height="64" width="64"><span class="display-name">hotelmoulin-admin</span></a>		</li>
					<li id="wp-admin-bar-edit-profile"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/profile.php">Edit My Profile</a>		</li>
					<li id="wp-admin-bar-logout"><a class="ab-item" href="http://www.hotelmoulin.com/wp-login.php?action=logout&amp;_wpnonce=e649fee277">Log Out</a>		</li></ul></div>		</li>
				</ul>			
			</div>
		</div>
		<div id="wpbody">
			<div id="wpbody-content" aria-label="Main content" tabindex="0" style="overflow: hidden;">
				<div class="wrap">
					<br/><h1>Titre de la page</h1>
					<div id="dashboard-widgets-wrap">
						<h1>OOOOOOOOOOOOOOOOOOH PUTIN</h1>
					</div><!-- dashboard-widgets-wrap -->
				</div><!-- wrap -->
				<div class="clear"></div>
			</div><!-- wpbody-content -->
				<div class="clear"></div>
		</div><!-- wpbody -->
	</div>
<div id="wp-responsive-overlay" style="display: none;"></div><!-- wpcontent -->

<div id="wpfooter">
		<p id="footer-left" class="alignleft">
			© Copyrights. ALL RIGHTS RESERVED</p>
	<div class="clear"></div>
</div>
	
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-admin/load-scripts.php?c=1&amp;load%5B%5D=thickbox,hoverIntent,common,admin-bar,jquery-form,wp-ajax-response,jquery-color,wp-lists,quicktags,jquery-query,admin-comments,j&amp;load%5B%5D=query-ui-core,jquery-ui-widget,jquery-ui-mouse,jquery-ui-sortable,postbox,dashboard,customize-base,customize-loader,plugin-insta&amp;load%5B%5D=ll,shortcode,media-upload,svg-painter,heartbeat,wp-auth-check&amp;ver=4.1.5"></script>
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-content/plugins/wordpress-seo/js/wp-seo-admin-global.min.js?ver=450bf84a432b37ff9714ba070da35ef7"></script>
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/js/icl-admin-notifier.js?ver=d0dccd3d170fb7c50a6818bab3129bbc"></script>

<div class="clear"></div></div>

</body>