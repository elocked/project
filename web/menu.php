
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=1040">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta name="MobileOptimized" content="1040">
    <meta http-equiv="content-language" content="fr">

    </script>
  <script type="text/javascript">
  window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));
  </script>
    <script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>

  </head>



<body id="container" class="home no-touch white   alt ">
	<div class="body-inner">
		<div id="loading-slider" class="slider">
			<div class="line"></div>
		  <div class="break dot1"></div>
		  <div class="break dot2"></div>
		  <div class="break dot3"></div>
		</div>
				<div class="page-left page-sidebar page-column ">
			<a href="#" class="extend-left-link"><i class="icon-reorder"></i></a>
<div class="scrollable scrolling-element">
  <div class="wrapper">
    <a id="home-link" href="/fr">
      <img class="logo" src="/images/logo_flat.png" alt="TVShow Time">
    </a>
    <a href="#" class="left-sidebar-link sidebar-link"><i class="icon-caret-left reduce-icon"></i><i class="icon-caret-right expand-icon"></i></a>
        <form id="global-search" class="navbar-form form-search" action="#">
      <i class="icon-tvst-search popover-link"></i>
      <input style="display:none" type="text" name="search">
      <input type="text" id="global-search-input" name="search" class="show-search" placeholder="Rechercher">
      <a href="#" class="cancel-search">&times;</a>
    </form>
    <div id="global-search-results"></div>
        <div class="all-left-navs">
      <section id="user-nav">
          <h1>Alexandre Padel</h1>
    <div class="alt-user-nav">
      <a href="#" class="friend-requests-btn icon-btn"><i class="icon-tvst-friends"></i><div class="badge zero">0</div></a>
      <a href="#" class="notifications-btn icon-btn"><i class="icon-tvst-notifications"></i><div class="badge zero">0</div></a>
    </div>
    <ul class="menu list-unstyled">
      <li class="profile ">
        <a href="/fr/user/1278026/profile" title="Profil">
          <i class="icon-tvst-user"></i>
          <span>Profil</span></a>
      </li>
      <li class="account ">
        <a href="/fr/user/1278026/account" title="Paramètres">
          <i class="icon-gear"></i>
          <span>Paramètres</span></a>
      </li>
      <li class="add-shows ">
        <a href="/fr/add-shows?nr=1" title="Ajouter des séries">
          <i class="icon-plus-sign"></i>
          <span>Ajouter des séries</span></a>
      </li>
    </ul>
  
</section>  
</div>
      </div>
    </div>
    <div class="page-right page-sidebar page-column ">
            <section id="community-feed">
  <div class="scrollable scrolling-element">
    <div class="wrapper"> 
      <h1>Communauté</h1>
      <ul class="community-feed-list small-list list-unstyled">
      </ul>
      <div class="loader rotating small dark visible"></div>
    </div>
  </div>
</section>      </div>
          <div class="modal" id="new-event" style="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">New event</h4>
      </div>
      <div class="modal-body">
        <form id="event-form" class="event-infos" data-parsley-validate>
          <div class="form-group">
            <label>Title of your event</label>
            <input type="text" class="event-title form-control" data-parsley-trigger="change" required>
          </div>
          <div class="form-group">
            <label>Details of your event</label>
            <textarea class="event-details form-control"></textarea>
          </div>
          <div class="form-group">
            <label>What TV show or episode do you want to talk about?</label>
            <div id="related-objects-select"></div>
          </div>
          <div class="form-group">
            <label>Dates or your event:</label>
            <select class="event-dates-select">
              <option value="now" selected>Now</option>
              <option value="later">Later</option>
            </select>
            <div class="input-daterange input-group hide" id="event-datepicker">
                <input type="text" class="event-start-date input-sm form-control" name="start"  data-parsley-trigger="change" required>
                <span class="input-group-addon">to</span>
                <input type="text" class="event-end-date input-sm form-control" name="end" >
            </div>
          </div>
          <div class="show-select"></div>
        </form>
        <div id="invite-people" class="invites">
          <input class="form-control search-friends-input" type="text" placeholder="Type a name">
          <div class="loader rotating small dark visible"></div>
          <ul class="friends-list list-unstyled list-inline scrolling-element">
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <div class="event-infos">
          <a href="#" class="create-event-btn btn-tvst">Create</a>
        </div>
        <div class="invites">
          <a href="#" class="confirm-invite btn-tvst">Inviter</a>
        </div>
      </div>
    </div>
  </div>
</div>        <div id="fb-root"></div>
  </div>
    <div id="loading-mask">
    <div class="loading-container">
      <div class="loading"></div>
      <div id="loading-text">chargement</div>
    </div>
  </div>

  <!-- JavaScript Includes -->
  <!--[if IE]><script type="text/javascript" src="/js/dist/ie.js"></script><![endif]-->

  <script>


    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/fr_FR/sdk.js#version=v2.0&xfbml=1&appId=112713088809883";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>


  <!-- UserVoice JavaScript SDK (only needed once on a page) -->
  <script>
  // Include the UserVoice JavaScript SDK (only needed once on a page)
  UserVoice=window.UserVoice||[];(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/DrhxF0A1KUGeahsJXYOfA.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})();

  //
  // UserVoice Javascript SDK developer documentation:
  // https://www.uservoice.com/o/javascript-sdk
  //
  // Set colors
  UserVoice.push(['set', {
    accent_color: '#fbda38',
    trigger_color: 'white',
    trigger_background_color: 'rgba(100n, 100, 100, 0.6)',
    ticket_custom_fields: {
      'userId': "1278026"
    }
  }]);

  // Identify the user and pass traits
  // To enable, replace sample data with actual user traits and uncomment the line
  UserVoice.push(['identify', {
  }]);

  // Add default trigger to the bottom-right corner of the window:
  //UserVoice.push(['addTrigger', { mode: 'contact', trigger_position: 'top-left' }]);
  UserVoice.push(['addTrigger', '.help-btn', {}]);

  // Or, use your own custom trigger:
  //UserVoice.push(['addTrigger', '#id', { mode: 'contact' }]);

  // Autoprompt for Satisfaction and SmartVote (only displayed under certain conditions)
  UserVoice.push(['autoprompt', {}]);
  </script>

  <script>
    //videojs.options.flash.swf = "http://example.com/path/to/video-js.swf"
  </script>

  <script>
    // fb login function
    function fbConnect() {
      FB.login(function(response) {
        // handle the response
        if (response.authResponse) {
          $('#connect_fb_access_token').val(response.authResponse.accessToken);
          $('#connect-form').submit();
        }
        else {
          //TODO: handle error
          console.log('User cancelled login or did not fully authorize.');
        }
      }, {scope: 'email'});

      return false;
    }

    // twitter connect function
    function twitterConnect() {
      $('#connect_twitter_oauth').val(true);
      $('#connect-form').submit();

      return false;
    }

    // tvst connect function
    function tvstConnect() {
      $('#connect_tvst').val(true);
      $('#connect-form').submit();

      return false;
    }
  </script>

  
    <!-- start Mixpanel -->

                <script type="text/javascript">
              var tzl_pagename = "homepage";
              var connected = "1";
              var homeCookie = "";
              (function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f);b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==
              typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");for(g=0;g<i.length;g++)f(c,i[g]);
              b._i.push([a,e,d])};b.__SV=1.2}})(document,window.mixpanel||[]);
            </script>
            <script>
              mixpanel.init("d0e68f55195f612cc4f7f1f42123d680");
              mixpanelProperties = { user_id: "1278026"};
              if (tzl_pagename == "homepage") {
                if(connected == "1") mixpanelProperties['name'] = "homepage";
                else mixpanelProperties['name'] = "landing";
              }
              else if (tzl_pagename == "signup_with_bs_t" || tzl_pagename == "signup_with_bs") {
                // mixpanelProperties['name'] = tzl_pagename;
                // mixpanelProperties['message_id'] = "";
                mixpanelProperties['name'] = "bs_importing";
                mixpanelProperties['message_id'] = "";
                mixpanelProperties['bs_id'] = "";
              }
              else if (tzl_pagename == "bs") {
                mixpanelProperties['name'] = tzl_pagename;
                mixpanelProperties['message_id'] = "";
              }
              else mixpanelProperties['name'] = tzl_pagename
              mixpanelProperties.connected = connected;
              mixpanelProperties.home = homeCookie;
              mixpanel.track("Opened page", mixpanelProperties);

            </script>
        <!-- end Mixpanel -->

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-30156008-2']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

  
      <script type="text/javascript" src="/js/libs/require.js?v=5.3.13"></script>
<script type="text/javascript" src="/js/dist/config.js?v=5.3.13"></script>
<script type="text/javascript" src="/js/dist/pages/home.js?v=5.3.13"></script>
  </body>
  </html>
      