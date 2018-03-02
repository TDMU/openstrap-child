(function($){
  //define dialog
  $(function() {
      $('#dialog-sw-canvas').dialog({
          title: '3D Tour',
          width: 600,
          height: 400,
          closed: true,
          cache: false,
          modal: true,
          onClose: function() {
              $('#dialog-sw-canvas').empty();
          }
      });
      $('#dialog-sw-canvas').dialog('close');
  });

  //Default to GEOSS
  var client_lat = 49.5503421;
  var client_lon = 25.5904394;
  
  var templateUrl = theme_path.templateUrl;
  var map;
  var panoramaOptions;
  var panorama;
  var windows = [];
  var sv = new google.maps.StreetViewService();

  function initialize() {
      map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 14,
          center: new google.maps.LatLng(client_lat, client_lon),
          streetViewControl: false
      });

      // Icons
      var iconBase = 'https://maps.google.com/mapfiles/kml/pal2/';
      var icons = {
          hq: {
              name: 'HQ',
              icon: iconBase + 'icon2.png'
          },
          shop: {
              name: 'Shop',
              icon: iconBase + 'icon10.png'
          }
      };

      //Create Map markers
      function addMarker(feature) {
          var marker = new google.maps.Marker({
              position: feature.position,
              map: map,
              icon: feature.icon
          });
          //Create Infowindow
          var infowindow = new google.maps.InfoWindow();
          windows.push(infowindow);

          var content = '<h1 id="Heading" class="Heading">' + feature.shopName + '</h1>' +
              '<div id="iwcontent" class="iwcontent">' +
              '<p><b>Address : </b>' + feature.shopAddress + '</br>' +
              '</div>' +
              '<div id="iwsw" class="iwsw">Open 3D tour</div>';
          //Call StreetView
          google.maps.event.addDomListener(infowindow, 'domready', function() {
              $('.iwsw').click(function() {
                  showStreetView(feature);
              });
          });

          google.maps.event.addListener(marker, 'click', (function(marker, content, infowindow) {
              return function() {
		  // Close all
                  for (win of windows) {
                    win.close();
                  }
		      
                  infowindow.setContent(content);
                  infowindow.open(map, marker);
              };
          })(marker, content, infowindow));

      }

    var features = [
		{
			position: new google.maps.LatLng(49.5503987,25.5880084),
			type: 'university',
			shopName: 'TSMU, Institute of Morphology',
			shopAddress: '12 Ruska Street, Ternopil, 46001, Ukraine',
			icon: templateUrl+"/images/academic-building.png",
			heading: 208
		},
		{
			position: new google.maps.LatLng(49.5445811,25.6121596),
			type: 'university',
			shopName: 'TSMU, Institute of Pathological Processes Simulation and Analysis',
			shopAddress: '7 Doroshenka Street, Ternopil, 46000, Ukraine',
  			icon: templateUrl+"/images/academic-building.png",
			heading: 214
		},
		{
			position: new google.maps.LatLng(49.5521107,25.5906239),
			type: 'university',
			shopName: 'TSMU, M.P. Skakun Institute of Pharmacology, Hygiene and Medical Biochemistry',
			shopAddress: 'Maidan Voli, 1, Ternopil, 46001, Ukraine',
			icon: templateUrl+"/images/academic-building.png",
			heading: 175
		},
		{
			position: new google.maps.LatLng(49.5498643,25.5968433),
			type: 'university',
			shopName: 'TSMU, Library',
			shopAddress: '8 Sichovi Striltsi Street, Ternopil, 46001, Ukraine',
			icon: templateUrl+"/images/academic-building.png",
			heading: 197
		},
		{
			position: new google.maps.LatLng(49.5511261,25.5970054),
			type: 'university',
			shopName: 'TSMU, Pharmaceutical faculty',
			shopAddress: '36 Ruska Street, Ternopil, 46001, Ukraine',
			icon: templateUrl+"/images/academic-building.png",
			heading: 172
		},
		{
			position: new google.maps.LatLng(49.560212,25.5950123),
			type: 'university',
			shopName: 'TSMU, Department of Therapeutic Dentistry',
			shopAddress: '3 Chekhova Street, Ternopil, 46003, Ukraine',
			icon: templateUrl+"/images/academic-building.png",
			heading: 26
		},
		{
			position: new google.maps.LatLng(49.5606896,25.595121),
			type: 'university',
			shopName: 'TSMU, Faculty Of Dentistry',
			shopAddress: '7 Chekhova Street, Ternopil, 46003, Ukraine',
			icon: templateUrl+"/images/academic-building.png",
			heading: 242
		},
		{
			position: new google.maps.LatLng(49.5531571,25.5941792),
			type: 'university',
			shopName: 'TSMU, Institute of Biomedical Problems',
			shopAddress: '2 Slovatsky Street, Ternopil, 46001, Ukraine',
			icon: templateUrl+"/images/academic-building.png",
			heading: 275
		}];

      for (var i = 0, feature; feature = features[i]; i++) {
          addMarker(feature);
      }
  }

  google.maps.event.addDomListener(window, 'load', initialize);

  //Display dialog with streetview
  function showStreetView(feature) {
      var panoramaOptions = {
          position: feature.position,
          zoom: 1,
          pov: {
              heading: feature.heading,
              pitch: 0,
              zoom: 1
          },
          visible: true
      };
      var panorama = new google.maps.StreetViewPanorama(document.getElementById("dialog-sw-canvas"), panoramaOptions);

      map.setStreetView(panorama);
      $("#dialog-sw-canvas").dialog("open");
      google.maps.event.trigger(panorama,'resize');
          }
  })(jQuery);
