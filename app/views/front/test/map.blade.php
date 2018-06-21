<!--<div style="width: 100%">
	<iframe width="100%" height="600" src="http://www.maps.ie/create-google-map/map.php?width=100%&amp;height=600&amp;hl=en&amp;coord=-25.363,131.044&amp;q=+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=A&amp;output=embed" 
			frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
	</iframe>
</div><br />

<script type="text/javascript" src="http://www.webestools.com/google_map_gen.js?lati=37.0625&long=-95.6770&zoom=12&width=0&height=400&mapType=normal&map_btn_normal=yes&map_btn_satelite=yes&map_btn_mixte=yes&map_small=no&marqueur=yes&info_bulle="></script><br /><a href="http://www.webestools.com/google-maps-code-generator-insert-map-on-website-javascript-free-google-map-script.html">Google Maps code Generator</a>
-->
<!DOCTYPE html>
<html>
  <head>
    <style>
	#map {
        width: 100%;
        height: 400px;
    }
    </style>
  </head>
  <body>
    <h3 onclick="initMap(-25.363, 131.044)">My Google Maps Demo</h3>
    <div id="map" ></div>
	<script>
		function initMap(lat, lng) {
			var myLatLng = {lat: lat, lng: lng};

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 12,
				center: myLatLng
			});

			var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'Hello World!'
			});
		}
	</script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbgURoV1LvwGeVaY6xZtJRew-36M9fZGc">
    </script>
  </body>
</html>

<!--
<html> 
	<head> 
		<title>Google Maps и jQuery</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
		<script type="text/javascript" src="http://www.google.com/jsapi?key=AIzaSyAbgURoV1LvwGeVaY6xZtJRew-36M9fZGc"></script> 
		<script type="text/javascript"> 
		google.load("jquery", '1.3');
		google.load("maps", "2.x");
		</script>
		
		<script type="text/javascript" charset="utf-8"> 
			$(document).ready(function(){
				var map = new GMap2($("#map").get(0));
				var burnsvilleMN = new GLatLng(44.797916,-93.278046);
				map.setCenter(burnsvilleMN, 8);
				
				// setup 10 random points
				var bounds = map.getBounds();
				var southWest = bounds.getSouthWest();
				var northEast = bounds.getNorthEast();
				var lngSpan = northEast.lng() - southWest.lng();
				var latSpan = northEast.lat() - southWest.lat();
				var markers = [];
				for (var i = 0; i < 10; i++) {
				    var point = new GLatLng(southWest.lat() + latSpan * Math.random(),
				        southWest.lng() + lngSpan * Math.random());
					marker = new GMarker(point);
					map.addOverlay(marker);
					markers[i] = marker;
				}
				
				$(markers).each(function(i,marker){
					$("<li />")
						.html("Точка "+(i+1))
						.click(function(){
							displayPoint(marker, i);
						})
						.appendTo("#list");
					
					GEvent.addListener(marker, "click", function(){
						displayPoint(marker, i);
					});
				});
				
				$("#message").appendTo(map.getPane(G_MAP_FLOAT_SHADOW_PANE));
				
				function displayPoint(marker, index){
					$("#message").hide();
					
					var moveEnd = GEvent.addListener(map, "moveend", function(){
						var markerOffset = map.fromLatLngToDivPixel(marker.getLatLng());
						$("#message")
							.fadeIn()
							.css({ top:markerOffset.y, left:markerOffset.x });
					
						GEvent.removeListener(moveEnd);
					});
					map.panTo(marker.getLatLng());
				}
			});
		</script> 
		<style type="text/css" media="screen"> 
			#map { float:left; width:500px; height:500px; }
			#message { position:absolute; padding:10px; background:#555; color:#fff; width:95px; }
			#list { float:left; width:200px; background:#eee; list-style:none; padding:0; }
			#list li { padding:10px; }
			#list li:hover { background:#555; color:#fff; cursor:pointer; cursor:hand; }
		</style> 
	</head> 
	<body> 
		<div id="map"></div> 
		<ul id="list"></ul> 
		<div id="message" style="display:none;"> 
			Наш Текст
		</div> 
	</body> 
</html>

-->
