<?php 
session_start();
$_SESSION['idPersonne']=2;
$_SESSION['prenom']="nelson";
if(!empty($_SESSION['prenom'])){$prenom=$_SESSION['prenom'];
$idPersonne = $_SESSION['idPersonne'];
}
?>
<?php include('notifications.php');?>
<?php include('fonctions.php');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<?php  
	$bdd = new PDO('mysql:host=localhost;dbname=elocked','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	//reservation()
?>

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
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript">
		/* <![CDATA[ */
		var thickboxL10n = {"next":"Next >","prev":"< Prev","image":"Image","of":"of","close":"Close","noiframes":"This feature requires inline frames. You have iframes disabled or your browser does not support them.","loadingAnimation":"http:\/\/www.hotelmoulin.com\/wp-includes\/js\/thickbox\/loadingAnimation.gif"};var commonL10n = {"warnDelete":"You are about to permanently delete the selected items.\n  'Cancel' to stop, 'OK' to delete."};var wpAjax = {"noPerm":"You do not have permission to do that.","broken":"An unidentified error has occurred."};var quicktagsL10n = {"closeAllOpenTags":"Close all open tags","closeTags":"close tags","enterURL":"Enter the URL","enterImageURL":"Enter the URL of the image","enterImageDescription":"Enter a description of the image","fullscreen":"fullscreen","toggleFullscreen":"Toggle fullscreen mode","textdirection":"text direction","toggleTextdirection":"Toggle Editor Text Direction","dfw":"Distraction-free writing mode"};var adminCommentsL10n = {"hotkeys_highlight_first":"","hotkeys_highlight_last":"","replyApprove":"Approve and Reply","reply":"Reply"};var _wpCustomizeLoaderSettings = {"url":"http:\/\/www.hotelmoulin.com\/wp-admin\/customize.php","isCrossDomain":false,"browser":{"mobile":false,"ios":false},"l10n":{"saveAlert":"The changes you made will be lost if you navigate away from this page."}};var plugininstallL10n = {"plugin_information":"Plugin Information:","ays":"Are you sure you want to install this plugin?"};var heartbeatSettings = {"nonce":"5a711e7353"};var authcheckL10n = {"beforeunload":"Your session has expired. You can log in again from this page or go to the login page.","interval":"180"};/* ]]> */
	</script>
	<script type="text/javascript" src="http://www.hotelmoulin.com/wp-admin/load-scripts.php?c=1&amp;load%5B%5D=thickbox,hoverIntent,common,admin-bar,jquery-form,wp-ajax-response,jquery-color,wp-lists,quicktags,jquery-query,admin-comments,j&amp;load%5B%5D=query-ui-core,jquery-ui-widget,jquery-ui-mouse,jquery-ui-sortable,postbox,dashboard,customize-base,customize-loader,plugin-insta&amp;load%5B%5D=ll,shortcode,media-upload,svg-painter,heartbeat,wp-auth-check&amp;ver=4.1.5"></script>
	<script type="text/javascript" src="http://www.hotelmoulin.com/wp-content/plugins/wordpress-seo/js/wp-seo-admin-global.min.js?ver=450bf84a432b37ff9714ba070da35ef7"></script>
	<script type="text/javascript" src="http://www.hotelmoulin.com/wp-content/plugins/sitepress-multilingual-cms/res/js/icl-admin-notifier.js?ver=d0dccd3d170fb7c50a6818bab3129bbc"></script>
	<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/main.js"></script>
	<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/common.js"></script>
	<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/util.js"></script>
	<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/fr_ALL/stats.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">$(document).ready(function()
										{
											$("#MenuOnClick").click(function()
											{
												$(".AffichageOnClick").fadeToggle(300);
												return false;
											});
											$(document).click(function()
											{
												$(".AffichageOnClick").hide();
											});
												//Popup on click
											$(".AffichageOnClick").click(function()
											{
												return false;
											});
										});
	</script>
</head>


<body class="wp-admin wp-core-ui js  index-php auto-fold admin-bar branch-4-1 version-4-1-5 admin-color-fresh locale-en-us customize-support svg sticky-menu" onload="initialiser()">
<div id="wpwrap">
	<div id="adminmenuback"></div>
		<div class="AffichageOnClick">
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
					
				</li>
				<!--<li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" id="menu-pages">
					<a href="#" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" aria-haspopup="true">
					<div class="wp-menu-arrow"></div>
					<div class="wp-menu-image dashicons-before dashicons-admin-page"><br></div>
					<div class="wp-menu-name">Notification♣ <span id="notification_counter">3</span></div></a>
					<ul class="wp-submenu wp-submenu-wrap">
						
							<ul id="nav">
								<span id="notification_count">3</span>
								<li id="notification_li">
									<a href="#" id="notificationLink">Notification★</a>
									<div id="notificationContainer">
										<div id="notificationTitle">Notifications♥</div>
										<div id="notificationsBodyBody" class="notifications">jen ai un</div>
										<div id="notificationFooterFooter"><a href="#">See All</a></div>
									</div>
								</li>
							</ul>
					</ul>
				</li>-->
				<li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" id="toplevel_page_wpcf7">
				<a href="contact.php" class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wpcf7" aria-haspopup="true">
				<div class="wp-menu-arrow"></div>
				<div class="wp-menu-image dashicons-before dashicons-email"><br></div>
			<div class="wp-menu-name">Contact</div></a>
				<ul class="wp-submenu wp-submenu-wrap"></ul>
				</li>
			</ul>
		</div>
		</div>
	<div id="wpcontent">
	<ul id="adroite">
		<li id="wp-admin-bar-site-name">
			<span class="ab-item" id="Connex">Connexion</span>
			<div id="ConnexContainer">
				<div id="notificationTitle">Connecte-Toi</div></br>
				<div id="notificationsBodyBody" class="notifications">
					<div class="contain">  
						<?php   
						if(isset($prenom)AND !empty($prenom)) { echo 'Bonjour '.$prenom;
						echo'<form action="index_post.php" method="POST">
						<p><input type="submit" name="deconnecter" value="Deconnecter"/>
						<input type="hidden" name="deco" value="deco"></p>
						</form>';}
						else {?><form action='index_post.php' method="POST">
						<p></br>
						<label>Mail : <input type="email" name="mail"style="margin-left: 56px;"/></label>
						<br/>
						<label>Mot de passe : <input type="password" name="mdp" /></label>
						<br/>
						<p><input type="submit" name="valider" value="Envoyer" /></p> 
						</form>		 
						<?php echo 'si vous n\'etes pas inscrit :<a href=\formulaire.php>Inscription';}?></a>
					</div>
				</div>
			</div>
		</li>				
	</ul>
	<div id="wpadminbar" class="" role="navigation">
		<div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Top navigation toolbar." tabindex="0">
				<ul id="wp-admin-bar-root-default" class="ab-top-menu">	
					<li id="wp-admin-bar-site-name" class="menupop">
						<a class="ab-item" id="MenuOnClick">MENU</a>
					</li>
					<li id="wp-admin-bar-updates">
						
						<span class="ab-icon"></span>
						<span href="#" id="notificationLink2">Notif★Notif★<span id="notification_count2">4</span></span>
							<div id="notificationContainer2">
							<div id="notificationTitle">Notif♥</div>
							<div id="notificationsBodyBody" class="notifications">
								<div class="contain">  
									<ul id="notificationMenu" class="notifications">
										<div class="contain">
											<ul id="notificationMenu" class="notifications">
												<div class="notifbox">
													<?php notifproprio($bdd,$idPersonne); ?>
												</div>
											</ul>
										</div>
									</ul>
								</div>
							</div>
							<div id="notificationFooterFooter"><a href="#">See All</a></div>
							</div>

					</li>					
				</ul>
							
		</div>
	</div>		
		<div id="wpbody">
			<div id="wpbody-content" aria-label="Main content" tabindex="0" style="overflow: hidden;">
				<div class="wrap">
						</br>
							<script type="text/javascript" src="jquery.js"></script>
									<script type="text/javascript">
										$(document).ready(function()
										{
											$("#notificationLink2").click(function()
											{
												$("#notificationContainer2").fadeToggle(300);
												$("#notification_count2").fadeOut("slow");
												$("#notification_counter").fadeOut("slow");
												return false;
											});
											//Document Click hiding the popup 
											$(document).click(function()
											{
												$("#notificationContainer2").hide();
											});
												//Popup on click
											$("#notificationContainer2").click(function()
											{
												return false;
											});
											
											$("#Connex").click(function()
											{
												$("#ConnexContainer").fadeToggle(300);
												return false;
											});
											$(document).click(function()
											{
												$("#ConnexContainer").hide();
											});
												//Popup on click
											$("#ConnexContainer").click(function()
											{
												return false;
											});
										});
									</script>
							</ul>
					<br/>
					<div id="dashboard-widgets-wrap">
						</br> <?php
						if(isset($idPersonne) AND !empty($idPersonne)) include('carte.php');
						else echo '<p id="noconnect"><b>Vous n\'êtes pas connecté</b></p><p id="nbruser" >Aujourd\'hui '.countuser($bdd).' Sherlockers sont inscrits<br />et '.countcadenas($bdd).' vélos sont en services</p><br />
							<form action="formulaire.php" id="inscription" method="POST"><input type="submit" name="inscription" value="S\'inscrire" /></form>';?>
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
		<span id="footer-thankyou">
			<b>© Copyrights. ALL RIGHTS RESERVED</b></span>
		</p>
	<div class="clear"></div>
</div>

<div class="clear"></div>
</div><!-- wpwrap -->
<script type="text/javascript">if(typeof wpOnload=='function')wpOnload();</script>
</body>
</html>