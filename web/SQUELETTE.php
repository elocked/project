<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">


<?php 
// récupération de la longitude et la latitude de l'utilisateur 
if(empty($_GET['var1']) AND empty($_GET['var2'])){
?>
<script type="text/javascript" >
if (navigator.geolocation)
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {enableHighAccuracy : true, timeout:10000, maximumAge:600000});
else
  alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
   
function successCallback(position){
  var latuser = position.coords.latitude; var lonuser = position.coords.longitude; //degree decimal
  top.document.location = "squelette.php?var1="+latuser+"&var2="+lonuser; 
};  
 
function errorCallback(error){
  switch(error.code){
    case error.PERMISSION_DENIED:
      alert("L'utilisateur n'a pas autorisé l'accès à sa position");
      break;      
    case error.POSITION_UNAVAILABLE:
      alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
      break;
    case error.TIMEOUT:
      alert("Le service n'a pas répondu à temps");
      break;
    }
};
<?php } ?>
</script>


<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="E-LOCKED TEAM">
	<meta name="description" content="E-LOCKED PROJECT">
	<meta name="keywords" content="lock, e-lock, cadnas, project">
	<meta name="copyright" content="Tous droits reserves">
	<meta name="subject" content="Projet E3 Cadenas Connecté">
	<title>E-LOCKED</title>
	
	
	<script type="text/javascript">
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
var ajaxurl = '/wp-admin/admin-ajax.php',
	pagenow = 'dashboard',
	typenow = '',
	adminpage = 'index-php',
	thousandsSeparator = ',',
	decimalPoint = '.',
	isRtl = 0;
</script>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
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
<style type="text/css" media="print">#wpadminbar { display:none; }</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <!-- Inclusion de l'API Google MAPS -->
    <?php include('GoogleMapAPI.class.php'); ?>
    <!-- Le paramètre "sensor" indique si cette application utilise détecteur pour déterminer la position de l'utilisateur -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
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
        $bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $req = $bdd -> query("SELECT Latitude, Longitude FROM etatcadenas WHERE Dispo=1 ");
        //$K = new GoogleMapAPI();
        while($donnee=$req -> fetch()){
          if($donnee==TRUE and isset($donnee)){?>
            //création du marqueur
           setmarqueur('<?php echo $donnee['Latitude'];?>','<?php echo $donnee['Longitude'];?>');
            
         <?php }
          else echo 'Pas de velo disponible </br>';
                           }
        $req->closecursor();
        ?>

        function setmarqueur(latitude , longitude){
          
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

        var infowindow = new google.maps.InfoWindow({
            content: '<a href="reserver.php">reserver</a></br>',
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

<body class="whole">
	<div id="wpwrap">
<a tabindex="1" href="#wpbody-content" class="screen-reader-shortcut">Skip to main content</a>

<div id="adminmenuback"></div>
<div id="adminmenuwrap">
<ul id="adminmenu" role="navigation">


	<li class="wp-first-item wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-top-first menu-icon-dashboard menu-top-last" id="menu-dashboard">
	<a href="index.php" class="wp-first-item wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-top-first menu-icon-dashboard menu-top-last"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-dashboard"><br></div><div class="wp-menu-name">Dashboard</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Dashboard</li><li class="wp-first-item current"><a href="index.php" class="wp-first-item current">Home</a></li><li><a href="update-core.php">Updates <span class="update-plugins count-11" title="1 WordPress Update, 7 Plugin Updates, 3 Theme Updates"><span class="update-count">11</span></span></a></li></ul></li>
	<li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true"><div class="separator"></div></li>
	<li class="wp-has-submenu wp-not-current-submenu open-if-no-js menu-top menu-icon-post menu-top-first" id="menu-posts">
	<a href="edit.php" class="wp-has-submenu wp-not-current-submenu open-if-no-js menu-top menu-icon-post menu-top-first" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-post"><br></div><div class="wp-menu-name">Posts</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Posts</li><li class="wp-first-item"><a href="edit.php" class="wp-first-item">All Posts</a></li><li><a href="post-new.php">Add New</a></li><li><a href="edit-tags.php?taxonomy=category">Categories</a></li><li><a href="edit-tags.php?taxonomy=post_tag">Tags</a></li></ul></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" id="menu-media">
	<a href="upload.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-media"><br></div><div class="wp-menu-name">Media</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Media</li><li class="wp-first-item"><a href="upload.php" class="wp-first-item">Library</a></li><li><a href="media-new.php">Add New</a></li></ul></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" id="menu-pages">
	<a href="edit.php?post_type=page" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-page"><br></div><div class="wp-menu-name">Pages</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Pages</li><li class="wp-first-item"><a href="edit.php?post_type=page" class="wp-first-item">All Pages</a></li><li><a href="post-new.php?post_type=page">Add New</a></li></ul></li>
	<li class="wp-not-current-submenu menu-top menu-icon-comments" id="menu-comments">
	<a href="edit-comments.php" class="wp-not-current-submenu menu-top menu-icon-comments"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-comments"><br></div><div class="wp-menu-name">Comments <span class="awaiting-mod count-0"><span class="pending-count">0</span></span></div></a></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" id="toplevel_page_wpcf7"><a href="admin.php?page=wpcf7" class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-email"><br></div><div class="wp-menu-name">Contact</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Contact</li><li class="wp-first-item"><a href="admin.php?page=wpcf7" class="wp-first-item">Contact Forms</a></li><li><a href="admin.php?page=wpcf7-new">Add New</a></li></ul></li>
	<li class="wp-not-current-submenu menu-top menu-icon-generic toplevel_page_my-panel" id="toplevel_page_my-panel">
	<a href="admin.php?page=my-panel" class="wp-not-current-submenu menu-top menu-icon-generic toplevel_page_my-panel"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-generic"><br></div><div class="wp-menu-name">Booking block</div></a></li>
	<li class="wp-not-current-submenu menu-top menu-icon-generic toplevel_page_my-panel2" id="toplevel_page_my-panel2">
	<a href="admin.php?page=my-panel2" class="wp-not-current-submenu menu-top menu-icon-generic toplevel_page_my-panel2"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-generic"><br></div><div class="wp-menu-name">Offer block</div></a></li>
	<li class="wp-not-current-submenu menu-top menu-icon-generic toplevel_page_my-panel3 menu-top-last" id="toplevel_page_my-panel3">
	<a href="admin.php?page=my-panel3" class="wp-not-current-submenu menu-top menu-icon-generic toplevel_page_my-panel3 menu-top-last"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-generic"><br></div><div class="wp-menu-name">Rooms price</div></a></li>
	<li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true"><div class="separator"></div></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-appearance menu-top-first" id="menu-appearance">
	<a href="themes.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-appearance menu-top-first" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-appearance"><br></div><div class="wp-menu-name">Appearance</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Appearance</li><li class="wp-first-item"><a href="themes.php" class="wp-first-item">Themes</a></li><li class="hide-if-no-customize"><a href="customize.php?return=%2Fwp-admin%2F" class="hide-if-no-customize">Customize</a></li><li><a href="widgets.php">Widgets</a></li><li><a href="nav-menus.php">Menus</a></li><li class="hide-if-no-customize"><a href="customize.php?return=%2Fwp-admin%2F&amp;autofocus[control]=header_image" class="hide-if-no-customize">Header</a></li><li><a href="themes.php?page=custom-header">Header</a></li><li><a href="theme-editor.php">Editor</a></li></ul></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-plugins" id="menu-plugins">
	<a href="plugins.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-plugins" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-plugins"><br></div><div class="wp-menu-name">Plugins <span class="update-plugins count-7"><span class="plugin-count">7</span></span></div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Plugins <span class="update-plugins count-7"><span class="plugin-count">7</span></span></li><li class="wp-first-item"><a href="plugins.php" class="wp-first-item">Installed Plugins</a></li><li><a href="plugin-install.php">Add New</a></li><li><a href="plugin-editor.php">Editor</a></li></ul></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-users" id="menu-users">
	<a href="users.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-users" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-users"><br></div><div class="wp-menu-name">Users</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Users</li><li class="wp-first-item"><a href="users.php" class="wp-first-item">All Users</a></li><li><a href="user-new.php">Add New</a></li><li><a href="profile.php">Your Profile</a></li></ul></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-tools" id="menu-tools">
	<a href="tools.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-tools" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-tools"><br></div><div class="wp-menu-name">Tools</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Tools</li><li class="wp-first-item"><a href="tools.php" class="wp-first-item">Available Tools</a></li><li><a href="import.php">Import</a></li><li><a href="export.php">Export</a></li><li><a href="tools.php?page=redirection.php">Redirection</a></li></ul></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-settings menu-top-last" id="menu-settings">
	<a href="options-general.php" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-settings menu-top-last" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class="wp-menu-image dashicons-before dashicons-admin-settings"><br></div><div class="wp-menu-name">Settings</div></a>
	<ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head">Settings</li><li class="wp-first-item"><a href="options-general.php" class="wp-first-item">General</a></li><li><a href="options-writing.php">Writing</a></li><li><a href="options-reading.php">Reading</a></li><li><a href="options-discussion.php">Discussion</a></li><li><a href="options-media.php">Media</a></li><li><a href="options-permalink.php">Permalinks</a></li></ul></li>
	<li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true"><div class="separator"></div></li>
	<li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpseo_dashboard menu-top-first" id="toplevel_page_wpseo_dashboard"><a href="admin.php?page=wpseo_dashboard" class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpseo_dashboard menu-top-first" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div>

<div id="wpcontent">

		<div id="wpadminbar" class="" role="navigation">
			<a class="screen-reader-shortcut" href="#wp-toolbar" tabindex="1">Skip to toolbar</a>
			<div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Top navigation toolbar." tabindex="0">
				<ul id="wp-admin-bar-root-default" class="ab-top-menu">
		<li id="wp-admin-bar-menu-toggle"><a class="ab-item" href="#" aria-expanded="false"><span class="ab-icon"></span><span class="screen-reader-text">Menu</span></a>		</li>
		<li id="wp-admin-bar-wp-logo" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/wp-admin/about.php" title="About WordPress"><span class="ab-icon"></span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wp-logo-default" class="ab-submenu">
		<li id="wp-admin-bar-about"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/about.php">About WordPress</a>		</li></ul><ul id="wp-admin-bar-wp-logo-external" class="ab-sub-secondary ab-submenu">
		<li id="wp-admin-bar-wporg"><a class="ab-item" href="https://wordpress.org/">WordPress.org</a>		</li>
		<li id="wp-admin-bar-documentation"><a class="ab-item" href="http://codex.wordpress.org/">Documentation</a>		</li>
		<li id="wp-admin-bar-support-forums"><a class="ab-item" href="https://wordpress.org/support/">Support Forums</a>		</li>
		<li id="wp-admin-bar-feedback"><a class="ab-item" href="https://wordpress.org/support/forum/requests-and-feedback">Feedback</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-site-name" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/">Hotel Du Moulin</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-site-name-default" class="ab-submenu">
		<li id="wp-admin-bar-view-site"><a class="ab-item" href="http://www.hotelmoulin.com/">Visit Site</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-updates"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/update-core.php" title="1 WordPress Update, 7 Plugin Updates, 3 Theme Updates"><span class="ab-icon"></span><span class="ab-label">11</span><span class="screen-reader-text">1 WordPress Update, 7 Plugin Updates, 3 Theme Updates</span></a>		</li>
		<li id="wp-admin-bar-comments"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/edit-comments.php" title="0 comments awaiting moderation"><span class="ab-icon"></span><span id="ab-awaiting-mod" class="ab-label awaiting-mod pending-count count-0">0</span></a>		</li>
		<li id="wp-admin-bar-new-content" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/wp-admin/post-new.php" title="Add New"><span class="ab-icon"></span><span class="ab-label">New</span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-new-content-default" class="ab-submenu">
		<li id="wp-admin-bar-new-post"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/post-new.php">Post</a>		</li>
		<li id="wp-admin-bar-new-media"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/media-new.php">Media</a>		</li>
		<li id="wp-admin-bar-new-page"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/post-new.php?post_type=page">Page</a>		</li>
		<li id="wp-admin-bar-new-user"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/user-new.php">User</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-wpseo-menu" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_dashboard">SEO</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wpseo-menu-default" class="ab-submenu">
		<li id="wp-admin-bar-wpseo-kwresearch" class="menupop"><div class="ab-item ab-empty-item" aria-haspopup="true">Keyword Research</div><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wpseo-kwresearch-default" class="ab-submenu">
		<li id="wp-admin-bar-wpseo-adwordsexternal"><a class="ab-item" href="http://adwords.google.com/keywordplanner" target="_blank">AdWords External</a>		</li>
		<li id="wp-admin-bar-wpseo-googleinsights"><a class="ab-item" href="http://www.google.com/insights/search/#q=&amp;cmpt=q" target="_blank">Google Insights</a>		</li>
		<li id="wp-admin-bar-wpseo-wordtracker"><a class="ab-item" href="http://tools.seobook.com/keyword-tools/seobook/?keyword=" target="_blank">SEO Book</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-wpseo-settings" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_titles">SEO Settings</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wpseo-settings-default" class="ab-submenu">
		<li id="wp-admin-bar-wpseo-titles"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_titles">Titles &amp; Metas</a>		</li>
		<li id="wp-admin-bar-wpseo-social"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_social">Social</a>		</li>
		<li id="wp-admin-bar-wpseo-xml"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_xml">XML Sitemaps</a>		</li>
		<li id="wp-admin-bar-wpseo-permalinks"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_permalinks">Permalinks</a>		</li>
		<li id="wp-admin-bar-wpseo-internal-links"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_internal-links">Internal Links</a>		</li>
		<li id="wp-admin-bar-wpseo-rss"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_rss">RSS</a>		</li>
		<li id="wp-admin-bar-wpseo-import"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_import">Import &amp; Export</a>		</li>
		<li id="wp-admin-bar-wpseo_bulk-editor"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_bulk-editor">Bulk Editor</a>		</li>
		<li id="wp-admin-bar-wpseo-files"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_files">Edit Files</a>		</li>
		<li id="wp-admin-bar-wpseo-licenses"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/admin.php?page=wpseo_licenses">Extensions</a>		</li></ul></div>		</li></ul></div>		</li>
		<li id="wp-admin-bar-WPML_ALS" class="menupop"><div class="ab-item ab-empty-item" aria-haspopup="true" title="Showing content in: EN"><img class="icl_als_iclflag" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png" alt="en" width="18" height="12">&nbsp;EN&nbsp;&nbsp;<img title="help" id="wpml_als_help_link" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/img/question1.png" alt="help" width="16" height="16"></div><div class="ab-sub-wrapper"><ul id="wp-admin-bar-WPML_ALS-default" class="ab-submenu">
		<li id="wp-admin-bar-WPML_ALS_fr"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/index.php?lang=fr&amp;admin_bar=1" title="Show content in: FR"><img class="icl_als_iclflag" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/fr.png" alt="fr" width="18" height="12">&nbsp;FR</a>		</li>
		<li id="wp-admin-bar-WPML_ALS_ko"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/index.php?lang=ko&amp;admin_bar=1" title="Show content in: 한국어"><img class="icl_als_iclflag" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/ko.png" alt="ko" width="18" height="12">&nbsp;한국어</a>		</li>
		<li id="wp-admin-bar-WPML_ALS_all"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/index.php?lang=all" title="Show content in: All languages"><img class="icl_als_iclflag" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/img/icon16.png" alt="all" width="16" height="16">&nbsp;All languages</a>		</li></ul></div>		</li></ul><ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
		<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" aria-haspopup="true" href="http://www.hotelmoulin.com/wp-admin/profile.php" title="My Account">Howdy, hotelmoulin-admin<img alt="" src="http://1.gravatar.com/avatar/7a73b30510c9b67ba688b0d80b6551e8?s=26&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D26&amp;r=G" class="avatar avatar-26 photo" height="26" width="26"></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class="ab-submenu">
		<li id="wp-admin-bar-user-info"><a class="ab-item" tabindex="-1" href="http://www.hotelmoulin.com/wp-admin/profile.php"><img alt="" src="http://1.gravatar.com/avatar/7a73b30510c9b67ba688b0d80b6551e8?s=64&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D64&amp;r=G" class="avatar avatar-64 photo" height="64" width="64"><span class="display-name">hotelmoulin-admin</span></a>		</li>
		<li id="wp-admin-bar-edit-profile"><a class="ab-item" href="http://www.hotelmoulin.com/wp-admin/profile.php">Edit My Profile</a>		</li>
		<li id="wp-admin-bar-logout"><a class="ab-item" href="http://www.hotelmoulin.com/wp-login.php?action=logout&amp;_wpnonce=76ed5fdd37">Log Out</a>		</li></ul></div>		</li></ul>			</div>
						<a class="screen-reader-shortcut" href="http://www.hotelmoulin.com/wp-login.php?action=logout&amp;_wpnonce=76ed5fdd37">Log Out</a>
					</div>

		
<div id="GMap">

<div id="Gmap-content" aria-label="Main content" tabindex="0" style="overflow: hidden;">
		<div id="screen-meta" class="metabox-prefs">

			<div id="contextual-help-wrap" class="hidden" tabindex="-1" aria-label="Contextual Help Tab">
				<div id="contextual-help-back"></div>
				<div id="contextual-help-columns">
					<div class="contextual-help-tabs">
						<ul>
						
							<li id="tab-link-overview" class="active">
								<a href="#tab-panel-overview" aria-controls="tab-panel-overview">
									Overview								</a>
							</li>
						
							<li id="tab-link-help-navigation">
								<a href="#tab-panel-help-navigation" aria-controls="tab-panel-help-navigation">
									Navigation								</a>
							</li>
						
							<li id="tab-link-help-layout">
								<a href="#tab-panel-help-layout" aria-controls="tab-panel-help-layout">
									Layout								</a>
							</li>
						
							<li id="tab-link-help-content">
								<a href="#tab-panel-help-content" aria-controls="tab-panel-help-content">
									Content								</a>
							</li>
												</ul>
					</div>
					
				</div>
			</div>
				<div id="screen-options-wrap" class="hidden" tabindex="-1" aria-label="Screen Options Tab">
		</div>
				</div>
			<script type="text/javascript">
				jQuery('#rs-dismiss-notice').click(function(){
					var objData = {
									action:"revslider_ajax_action",
									client_action: 'dismiss_notice',
									nonce:'a8ec9b58b3',
									data:''
									};

					jQuery.ajax({
						type:"post",
						url:ajaxurl,
						dataType: 'json',
						data:objData
					});

					jQuery('.rs-update-notice-wrap').hide();
				});
			</script>
			
<div class="wrap">
	<h2>
		<table>
			<tr>
				<br/>
			</tr>
			<tr>
				Your Map
			</tr>
			<tr onload="initialiser()">
				<div id="carte" style="width:100%; height:500px"></div>
			</tr>
		</table>
	</h2>
	<!--INTEGRER ICI LA GOOGLE MAP-->

</div><!-- wrap -->


</div><!-- wpbody-content -->
</div><!-- wpbody -->

<div class="clear"></div></div><div id="wp-responsive-overlay" style="display: none;"></div><!-- wpcontent -->

<div id="wpfooter">
		<p id="footer-left" class="alignleft">
			<span id="footer">© All Rights Reserved</span>
		</p>
	<div class="clear"></div>
</div>

	
<script type="text/javascript">
/* <![CDATA[ */
var thickboxL10n = {"next":"Next >","prev":"< Prev","image":"Image","of":"of","close":"Close","noiframes":"This feature requires inline frames. You have iframes disabled or your browser does not support them.","loadingAnimation":"http:\/\/www.hotelmoulin.com\/wp-includes\/js\/thickbox\/loadingAnimation.gif"};var commonL10n = {"warnDelete":"You are about to permanently delete the selected items.\n  'Cancel' to stop, 'OK' to delete."};var wpAjax = {"noPerm":"You do not have permission to do that.","broken":"An unidentified error has occurred."};var quicktagsL10n = {"closeAllOpenTags":"Close all open tags","closeTags":"close tags","enterURL":"Enter the URL","enterImageURL":"Enter the URL of the image","enterImageDescription":"Enter a description of the image","fullscreen":"fullscreen","toggleFullscreen":"Toggle fullscreen mode","textdirection":"text direction","toggleTextdirection":"Toggle Editor Text Direction","dfw":"Distraction-free writing mode"};var adminCommentsL10n = {"hotkeys_highlight_first":"","hotkeys_highlight_last":"","replyApprove":"Approve and Reply","reply":"Reply"};var _wpCustomizeLoaderSettings = {"url":"http:\/\/www.hotelmoulin.com\/wp-admin\/customize.php","isCrossDomain":false,"browser":{"mobile":false,"ios":false},"l10n":{"saveAlert":"The changes you made will be lost if you navigate away from this page."}};var plugininstallL10n = {"plugin_information":"Plugin Information:","ays":"Are you sure you want to install this plugin?"};var heartbeatSettings = {"nonce":"5a5d5bfb96"};var authcheckL10n = {"beforeunload":"Your session has expired. You can log in again from this page or go to the login page.","interval":"180"};/* ]]> */
</script>
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-admin/load-scripts.php?c=1&amp;load%5B%5D=thickbox,hoverIntent,common,admin-bar,jquery-form,wp-ajax-response,jquery-color,wp-lists,quicktags,jquery-query,admin-comments,j&amp;load%5B%5D=query-ui-core,jquery-ui-widget,jquery-ui-mouse,jquery-ui-sortable,postbox,dashboard,customize-base,customize-loader,plugin-insta&amp;load%5B%5D=ll,shortcode,media-upload,svg-painter,heartbeat,wp-auth-check&amp;ver=4.1.5"></script>
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-content/plugins/wordpress-seo/js/wp-seo-admin-global.min.js?ver=450bf84a432b37ff9714ba070da35ef7"></script>
<script type="text/javascript" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/js/icl-admin-notifier.js?ver=d0dccd3d170fb7c50a6818bab3129bbc"></script>

</div>