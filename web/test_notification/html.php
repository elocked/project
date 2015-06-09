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
<li><a href="#">Link1</a></li>
<li><a href="#">Link2</a></li>
<li><a href="#">Link3</a></li>
	<li id="notification_li">
		<span id="notification_count">3</span>
		<a href="#" id="notificationLink">Mes Notifications</a>

		<div id="notificationContainer">
		<div id="notificationTitle">Notifications</div>
		<div id="notificationsBody" class="notifications"></div>
		<div id="notificationFooter"><a href="#">See All</a></div>
		</div>
	</li>

<li><a href="#">Link4</a></li>
</ul>