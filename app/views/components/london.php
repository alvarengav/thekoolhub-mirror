<div class="map-container wow2 w2FadeIn" data-wow2-delay="300">
    <div class="map-details">
        <div class="center">
            <div class="center2">

                <div class="text"><?= $this->Data->Content('map-location-text') ?></div>
                <div class="text2"><?= $this->Data->Content('map-location-address') ?></div>
                <hr>
                <div class="phone"><?= $this->Data->Content('phone') ?></div>
            </div>
        </div>
    </div>
<div id="map"></div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxsmkXnzCYIiYrcD6QMW2zNqI8U_VuBSk"></script>
<script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        var mapOptions = {
            zoom: 15,
            disableDefaultUI: true,
            center: new google.maps.LatLng(40.4215871,-3.7241079), 
            styles: [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.locality",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#bdbdbd"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#181818"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1b1b1b"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#2c2c2c"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8a8a8a"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#373737"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#3c3c3c"
      }
    ]
  },
  {
    "featureType": "road.highway.controlled_access",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#4e4e4e"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#000000"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#3d3d3d"
      }
    ]
  }
]
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        var template = "%3Csvg xmlns='http://www.w3.org/2000/svg' width='40.505' height='47.905' viewBox='0 0 40.505 47.905'%3E%3Cg id='Grupo_83' data-name='Grupo 83' transform='translate(-1081.639 -752.864)'%3E%3Cg id='Grupo_80' data-name='Grupo 80' transform='translate(1081.639 752.864)'%3E%3Cpath id='Trazado_332' data-name='Trazado 332' d='M1101.891,800.769a1.971,1.971,0,0,1-1.282-.472c-1.94-1.656-18.97-16.481-18.97-27.182a20.252,20.252,0,0,1,40.5,0c0,10.7-17.028,25.527-18.972,27.182a1.961,1.961,0,0,1-1.28.472Zm0-43.954a16.32,16.32,0,0,0-16.3,16.3c0,6.938,10.784,18.081,16.3,23.05,5.517-4.968,16.3-16.112,16.3-23.05a16.319,16.319,0,0,0-16.3-16.3Z' transform='translate(-1081.639 -752.864)' fill='%23ffa900'/%3E%3C/g%3E%3Cg id='Grupo_81' data-name='Grupo 81' transform='translate(1092.014 763.237)'%3E%3Cpath id='Trazado_333' data-name='Trazado 333' d='M1096.768,777.87a9.877,9.877,0,1,1,9.877-9.877,9.89,9.89,0,0,1-9.877,9.877Zm0-15.8a5.926,5.926,0,1,0,5.926,5.926,5.932,5.932,0,0,0-5.926-5.926Z' transform='translate(-1086.891 -758.115)' fill='%23ffa900'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E%0A";
            

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(40.4212673,-3.7063208),
            map: map,
            title: 'Dynamic SVG Marker',
            icon: { url: 'data:image/svg+xml;charset=UTF-8,' + template },
            optimized: false
        });
    }
</script>
</div>