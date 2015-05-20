

	<script type="text/javascript" >
	function initialize() {
	
		// Set the styles of the map (i.e. black and white)
		var map_styles = [
			{
				featureType: 'all',
				elementType: 'labels.text.fill',
				stylers: [
					{ color: '#000000' }
				]
			},
			{
				featureType: 'all',
				elementType: 'labels.text.stroke',
				stylers: [
					{ color: '#ffffff' }
				]
			},
			{
				featureType: 'administrative',
				elementType: 'labels.text.fill',
				stylers: [
					{ color: '#000000' }
				]
			},
			{
				featureType: 'administrative.country',
				stylers: [
					{ visibility: 'off' }
				]	
			},
			{
				featureType: 'administrative.land_parcel',
				stylers: [
					{ visibility: 'off' }
				]	
			},
			{
				featureType: 'administrative.locality',
				stylers: [
					{ visibility: 'off' }
				]	
			},
			{
				featureType: 'administrative.neighborhood',
				stylers: [
					{ visibility: 'off' }
				]	
			},
			{
				featureType: 'administrative.province',
				stylers: [
					{ visibility: 'off' }
				]	
			},
			{
				featureType: 'landscape',
				elementType: 'geometry',
				stylers: [
					{ color: '#ffffff' }
				]
			},
			{
				featureType: 'poi',
				elementType: 'labels',
				stylers: [
					{ visibility: 'off' }
				]
			},
			{
				featureType: 'poi',
				elementType: 'labels.icon',
				stylers: [
					{ visibility: 'off' }
				]
			},
			{
				featureType: 'poi',
				elementType: 'geometry.fill',
				stylers: [
					{ color: '#bbbbbb' }
				]
			},
			{
				featureType: 'road',
				elementType: 'geometry',
				stylers: [
					{ color: '#000000' },
					{ visibility: 'simplified' }
				]
			},
			{
				featureType: 'road',
				elementType: 'labels',
				stylers: [
				]
			},
			{
				featureType: 'road',
				elementType: 'labels.icon',
				stylers: [
					{ visibility: 'off' }
				]
			},
			{
				featureType: 'transit',
				stylers: [
					{ visibility: 'off' }
				]	
			},
			{
				featureType: 'water',
				stylers: [
					{ color: '#000000' }
				]
			},
			{
				featureType: 'water',
				elementType: 'labels.text.stroke',
				stylers: [
					{ color: '#ffffff' }
				]
			},
			{
				featureType: 'water',
				elementType: 'labels.text.fill',
				stylers: [
					{ color: '#000000' }
				]
			}
		];
		
				
			
		var mapOptions = {
			center: new google.maps.LatLng(-31.953004, 115.857469),
			zoom: 15,
			styles: map_styles,
			scrollwheel: false,
			mapTypeControl: false,
			streetViewControl: false
		};
		
		// Create map
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		
				
					var images = '<div class="image"><img src="http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_Mollie_Hewitt_0404-4-292x194.jpg" alt="Image of http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_Mollie_Hewitt_0404-4-292x194.jpg" /><img src="http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_Mollie_Hewitt_0404-12-292x194.jpg" alt="Image of http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_Mollie_Hewitt_0404-12-292x194.jpg" /><a href="#" class="arrow icn left-black-arrow"><span>&lt;</span></a><a href="#" class="arrow icn right-black-arrow"><span>&gt;</span></a></div>';		
					var marker_html = '<div class="pin public marker_1" data-lat="-31.955945" data-lng="115.856339" data-categories="public">' +'<div class="wrapper">' +'<div class="small">' +'<img src="http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_Mollie_Hewitt_0404-12-78x59.jpg" alt="" />' +'</div>' +'<div class="large">' +images +'<div class="text">' +'<p class="artist monteserrat"><strong>Reko Rennie</strong> <em>Melbourne</em></p>' +'<p><a target="_blank" href="http://http://rekorennie.com/" title="Visit the website of Reko Rennie for more details">http://rekorennie.com/</a></p>' +
						'<p class="title">Pink Kangaroo</p>' +
						'<p class="description">Reko Rennie is a Kamilaroi/Gamilaraay/Gummaroi man. His art and installations continually explore issues of identity, race, law and justice, land rights, stolen generations, and other issues affecting Aboriginal and Torres Strait Islanders in contemporary society.</p>' +
						'</div>' +'<a class="icn close" href="#" title="Close">Close</a>' +'</div>' +'</div>' +'<span></span>' +'</div>';
			
			var marker_1 = new RichMarker({
				position: new google.maps.LatLng(-31.955945, 115.856339),
				draggable: false,
				flat: true,
				anchor: RichMarkerPosition.BOTTOM,
				content: marker_html
			});			
			marker_1.setMap(map);
					
			google.maps.event.addListener(marker_1, 'click', function() {
				
				var modifier = 0.0178;
				if ($(window).width() < 768) {
					modifier = 0;
				}
				
				if (!$('.marker_1').hasClass('active')) {
					// map.setZoom(14);
					// var temp_lat = -31.955945 + modifier;
					// map.panTo(new google.maps.LatLng(temp_lat, 115.856339));
				}
				
				$('.pin').removeClass('active').css('z-index', 10);
				$('.marker_1').addClass('active').css('z-index', 200);
				
				$('.marker_1 .large .image').cycle({
					fx: 'scrollHorz',
					slides: '> img',
					prev: '> .left-black-arrow',
					next: '> .right-black-arrow'
				});
			
				$('.marker_1 .large .close').click(function(){
					$('.pin').removeClass('active');
					return false;
				});
				
			});
			
								var images = '<div class="image"><img src="http://www.form.net.au/wp-content/uploads/2014/03/P1190149-292x194.jpg" alt="Image of http://www.form.net.au/wp-content/uploads/2014/03/P1190149-292x194.jpg" /><img src="http://www.form.net.au/wp-content/uploads/2014/03/IMG_4917-292x194.jpg" alt="Image of http://www.form.net.au/wp-content/uploads/2014/03/IMG_4917-292x194.jpg" /><img src="http://www.form.net.au/wp-content/uploads/2014/03/IMG_4923-292x194.jpg" alt="Image of http://www.form.net.au/wp-content/uploads/2014/03/IMG_4923-292x194.jpg" /><img src="http://www.form.net.au/wp-content/uploads/2014/03/IMG_0227.jpg" alt="Image of http://www.form.net.au/wp-content/uploads/2014/03/IMG_0227.jpg" /><a href="#" class="arrow icn left-black-arrow"><span>&lt;</span></a><a href="#" class="arrow icn right-black-arrow"><span>&gt;</span></a></div>';			var marker_html = '<div class="pin public marker_2" data-lat="-31.951361" data-lng="115.854514" data-categories="public local">' +
			'<div class="wrapper">' +
				'<div class="small">' +
					'<img src="http://www.form.net.au/wp-content/uploads/2014/03/IMG_0227-78x59.jpg" alt="" />' +
				'</div>' +
				'<div class="large">' +
					images +
					'<div class="text">' +
						'<p class="artist monteserrat"><strong>Stormie Mills</strong> <em>Perth</em></p>' +
						'<p><a target="_blank" href="http://http://rekorennie.com/" title="Visit the website of Stormie Mills for more details">http://stormiemills.com/</a></p>' +
						'<p class="title"></p>' +
						'<p class="description">Stormie Mills has established an international following for his iconic, character-based work. His work explores the human condition and the notion of isolation, working in a restricted palette of black (representing dirt), white (the attempt to remove dirt), grey (as a metaphor for the cityscape), and silver (for dreams).</p>' +
					'</div>' +
					'<a class="icn close" href="#" title="Close">Close</a>' + 
				'</div>' +
			'</div>' +
			'<span></span>' +
			'</div>';
			
			var marker_2 = new RichMarker({
				position: new google.maps.LatLng(-31.951361, 115.854514),
				draggable: false,
				flat: true,
				anchor: RichMarkerPosition.BOTTOM,
				content: marker_html
			});			
			marker_2.setMap(map);
					
			google.maps.event.addListener(marker_2, 'click', function() {
				
				var modifier = 0.0178;
				if ($(window).width() < 768) {
					modifier = 0;
				}
				
				if (!$('.marker_2').hasClass('active')) {
					// map.setZoom(14);
					// var temp_lat = -31.951361 + modifier;
					// map.panTo(new google.maps.LatLng(temp_lat, 115.854514));
				}
				
				$('.pin').removeClass('active').css('z-index', 10);
				$('.marker_2').addClass('active').css('z-index', 200);
				
				$('.marker_2 .large .image').cycle({
					fx: 'scrollHorz',
					slides: '> img',
					prev: '> .left-black-arrow',
					next: '> .right-black-arrow'
				});
			
				$('.marker_2 .large .close').click(function(){
					$('.pin').removeClass('active');
					return false;
				});
				
			});
			
								var images = '<div class="image"><img src="http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_AmyPlant_Ibis-1-292x194.jpg" alt="Image of http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_AmyPlant_Ibis-1-292x194.jpg" /><img src="http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_AmyPlant_Ibis-3-292x194.jpg" alt="Image of http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_AmyPlant_Ibis-3-292x194.jpg" /><a href="#" class="arrow icn left-black-arrow"><span>&lt;</span></a><a href="#" class="arrow icn right-black-arrow"><span>&gt;</span></a></div>';			var marker_html = '<div class="pin public marker_3" data-lat="-31.951464" data-lng="115.8557" data-categories="public">' +
			'<div class="wrapper">' +
				'<div class="small">' +
					'<img src="http://www.form.net.au/wp-content/uploads/2014/03/PUBLIC_AmyPlant_Ibis-3-78x59.jpg" alt="" />' +
				'</div>' +
				'<div class="large">' +
					images +
					'<div class="text">' +
						'<p class="artist monteserrat"><strong>Phibs</strong> <em>Sydney</em></p>' +
						'<p><a target="_blank" href="http://http://rekorennie.com/" title="Visit the website of Phibs for more details">http://www.phibs.com/</a></p>' +
						'<p class="title"></p>' +
						'<p class="description">From an early age Phibs was active in community programs that helped refine the artistic potential of this now popular art form. He produces that reflect his own unique symbolism, multicultural references, and mythology. Largely inspired by nature, his works have spawned a menagerie of signature characters.</p>' +
					'</div>' +
					'<a class="icn close" href="#" title="Close">Close</a>' + 
				'</div>' +
			'</…'
</script>