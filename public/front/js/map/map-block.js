var Map = (function () {

  var markersArray = [];
  var infoWindows = [];
  var isOpen = false;

  var clearOverlays = function () {
    for (var i = 0; i < markersArray.length; i++) {
      markersArray[i].setMap(null);
    }
    markersArray = [];
    infoWindows = [];
  }

  var placeAllMarkers = function (map) {
    var pageType = window.pageType != undefined ?
      window.pageType
      : 'none';
    var catId = window.mapCatalogId != undefined
      ? window.mapCatalogId
      : '-1';
    $.ajax({
      url : "/map-all",
      data : JSON.stringify({ 'catId' : catId, 'pageType' : pageType}),
      type : 'post',
     // async : false,
      dataType : 'json',
      contentType : 'application/json; charset=utf-8'
    })
      .done(function (res) {
        for (var i = 0; i < res.length; i++) {
          addMarkerByLatLng(res[i].latlng, res[i].title, res[i].html, map, res[i].unionHtml);
        }

        var clusterStyles = [
          {
            textColor : 'white',
            url : '/front/images/cluster-x1.png',
            height : 42,
            width : 43,
            textSize : 12
          },
          {
            textColor : 'white',
            url : '/front/images/cluster-x2.png',
            height : 56,
            width : 57,
            textSize : 13
          },
          {
            textColor : 'white',
            url : '/front/images/cluster-x3.png',
            height : 68,
            width : 69,
            textSize : 14
          }
        ];
        var markerCluster = new MarkerClusterer(map, markersArray,
          {
            maxZoom : 25,
            gridSize : 20,
            zoomOnClick : false,
            averageCenter : true,
            styles : clusterStyles,
            icon : '/front/images/map-pin.png'
            // imagePath : 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
          });
        var infowindow2 = new google.maps.InfoWindow();
        infoWindows.push(infowindow2);
        google.maps.event.addListener(markerCluster, "click", function (mCluster) {
          var markers = mCluster.getMarkers();
          var content = populateClusterHtml(markers);
          infowindow2.setContent(content);
          infowindow2.setPosition(mCluster.getCenter());
		  
		  if (infoWindows.length > 0) {
        for (var i = 0; i < infoWindows.length; i++) {
          infoWindows[i].close();
        }
      }
	  
	  
          infowindow2.open(map);
        });


      });

  }

  var populateClusterHtml = function (markers) {
    var content = "<div class='cluster-window js-reviews-scroll'>";
    for (var i = 0; i < markers.length; i++) {
      content += '' + markers[i].infoContent + '';
    }
    content += "</div>";
    return content;
  }

  var addMarkerByLatLng = function (latlng, title, html, theMap, unionHtml) {
    var pos = JSON.parse(latlng);
    var currentConent = '<div class="cluster-window js-reviews-scroll">'
      +html;

    var marker = new google.maps.Marker({
      position : pos,
      map : theMap,
      title : title,
      icon : '/front/images/map-pin.png'
    });

    if (markersArray.length > 0) {
      for (var i = 0; i < markersArray.length; i++) {
        if (
          pos.lat != 0
          && pos.lng != 0
          && pos.lat.toFixed(7) == markersArray[i].position.lat().toFixed(7)
          && pos.lng.toFixed(7) == markersArray[i].position.lng().toFixed(7)
          ) {
          currentConent += markersArray[i].infoContent;
        }

      }
      currentConent+='</div>';

      var infowindow = new google.maps.InfoWindow();
      infoWindows.push(infowindow);
      if (html != undefined) {
        google.maps.event.addListener(marker, 'click', function () {
          infowindow.setContent(currentConent);
		  
		if (infoWindows.length > 0) {
			for (var i = 0; i < infoWindows.length; i++) {
				infoWindows[i].close();
			}
		}
	  
          infowindow.open(theMap, marker);
        });
      }
    }


    marker.unionHtml = unionHtml;
    marker.infoContent = html;
    markersArray.push(marker);
    return this;
  }

  var resolveFirstLocation = function () {
    var latlan = {};
    var currentLocation = $(".select-city-onbar").val();
    if (currentLocation == "1") {
      latlan = {lat : 25.128112, lng : 55.187540};
    } else if (currentLocation == "2") {
      latlan = {lat : 24.480458, lng : 54.373408};
    }
    else if (currentLocation == "3") {
      latlan = {lat : 25.355802, lng : 55.385371};
    }
    else if (currentLocation == "4") {
      latlan = {lat : 24.200444, lng : 55.726943};
    }
    else if (currentLocation == "5") {
      latlan = {lat : 25.401321, lng : 56.187087};
    }
    else if (currentLocation == "6") {
      latlan = {lat : 25.407854, lng : 55.487185};
    }
    else if (currentLocation == "7") {
      latlan = {lat : 25.786549, lng : 55.973760};
    }
	else if (currentLocation == "8") {
      latlan = {lat : 25.457389, lng : 55.587338};
    }
    return latlan;
  }

  //mathod that should be used to initiate map on advert or company
  var initMap = function (modal) {
    clearOverlays();
    var isModal = $(".ad-modal.open").length > 0;


    var locations = window.dynamicLocations;
    _initMap(isModal);
    var firstLocation = locations ? {
      lat : locations[0].gps_lat,
      lng : locations[0].gps_lan
    }
      : resolveFirstLocation();

    var map = new google.maps.Map(document.getElementById(isModal ? 'map_div' : 'search-map'), {
      zoom : 12,
      styles : [
        {"featureType" : "administrative", "elementType" : "labels.text.fill", "stylers" : [
          {"color" : "#444444"}
        ]},
        {"featureType" : "landscape", "elementType" : "all", "stylers" : [
          {"color" : "#f2f2f2"}
        ]},
        {"featureType" : "poi", "elementType" : "all", "stylers" : [
          {"visibility" : "off"}
        ]},
        {"featureType" : "road", "elementType" : "all", "stylers" : [
          {"saturation" : -100},
          {"lightness" : 45}
        ]},
        {"featureType" : "road.highway", "elementType" : "all", "stylers" : [
          {"visibility" : "simplified"}
        ]},
        {"featureType" : "road.arterial", "elementType" : "labels.icon", "stylers" : [
          {"visibility" : "off"}
        ]},
        {"featureType" : "transit", "elementType" : "all", "stylers" : [
          {"visibility" : "off"}
        ]},
        {"featureType" : "water", "elementType" : "all", "stylers" : [
          {"color" : "#46bcec"},
          {"visibility" : "on"}
        ]}
      ],
      center : firstLocation // center map via first location
    });
    google.maps.event.addListener(map, 'click', function (event) {
      if (infoWindows.length > 0) {
        for (var i = 0; i < infoWindows.length; i++) {
          infoWindows[i].close();
        }
      }

    });


    if (locations) {
      for (var i = 0; i < locations.length; i++) {
        var marker = new google.maps.Marker({
          position : {lat : locations[i].gps_lat, lng : locations[i].gps_lan},
          map : map
        });
        markersArray.push(marker);
      }
    }
    else {
      if (!window.isFront && !isOpen) {
        placeAllMarkers(map);
        isOpen = true;
      } else {
        isOpen = false;
      }
    }
    return map;
  }

  //Method that initiates the map functionality for right button panel map button
  var initCabinetMap = function () {
    $(".js-open-maps").on("click", function () {
      var isModal = $(".ad-modal.open").length > 0;
      if (isModal) {
        $(".ad_head_buttons__b.ad_b_map.tab-link").click();
      }

      if ($(this).hasClass('open'))
        $(this).removeClass('open');

      else
        $(this).addClass('open');

      console.log($(".map-block.shadow").css('dispay'));
      if ($(this).hasClass('open')) {
        $('.body').append('<span class="close-map-mobile"></span>');
        $('.wrapper').addClass('total_blur');
      }
      else {
        //$(".js_map_back").remove();
         $('.close-map-mobile').remove();
        $('.wrapper').removeClass('total_blur');
      }

      initMap();
    });
  }

  $(document).on('click', '.close-map-mobile', function () {
        $('.wrapper').removeClass('total_blur');

        if ($(".js-open-maps").hasClass('open'))
            $(".js-open-maps").click();
    });

  $(document).on('click', '.js_right_block_bg', function () {
    $('.wrapper').removeClass('total_blur');

    if ($(".js-open-maps").hasClass('open'))
      $(".js-open-maps").click();
  });


  var _initMap = function (isModal) {
    if (!isModal) {
      if ($('.js-right-buttons.open:not(".js-open-maps")'))
        $('.js-right-buttons.open:not(".js-open-maps")').click();

      if ($('.js-open-maps').hasClass('open')) {
        $('.js-open-maps').addClass('open');
		
		if ($('.m-right-buttons').hasClass('open')) {
			$('.m-right-buttons').removeClass('open');
			$('.get_right_buttons').removeClass('open');
		}
		if ($('.menu-bar').hasClass('open')) {
			$('.menu-bar').removeClass('open');
			$('body').removeClass( "modal_open" );
		}
		if ($('.bar-com').hasClass('open')) {
			$('.bar-com').removeClass('open');
		}
		if ($('.bar-adv').hasClass('open')) {
			$('.bar-adv').removeClass('open');
		}
        $('.inquiry').addClass('hide');
        $('.watchs').addClass('hide');
        $('.adverts').addClass('hide');
        $('.radio').addClass('hide');
        $('.map-block').addClass('open');
        $('.body').append('<div style="width: 100%;  position: fixed; height: 100%; z-index: 990; top: 0;" class="js_right_block_bg"></div>');
      }
      else {
        $('.map-block').removeClass('open');
		$('.inquiry').removeClass('hide');
        $('.watchs').removeClass('hide');
        $('.adverts').removeClass('hide');
        $('.radio').removeClass('hide');
        $('.m-right-buttons').addClass('open');
        $('.get_right_buttons').addClass('open');
        $(this).removeClass('open');
        $('.js_right_block_bg').remove();
      }
    }
  }


  return{
    initMap : initMap,
    initCabinetMap : initCabinetMap
  }
})();

jQuery(document).ready(function ($) {
  Map.initCabinetMap();
});


