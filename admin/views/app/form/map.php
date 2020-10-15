<?php $uniqid = uniqid(); ?>
<div class="col-md-<?= $item['columns']  ?>" id="map_<?= $uniqid ?>"  style="height: 180px; margin: 10px;">

  <? $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => 'location',
    'label' => $this->lang->line('Ubicación'),
    'value' => '',
    'placeholder' => 'Busca la ubicación'
  ))) ?>

    <span style="margin-top:30px">Latitud: </span>
    <input type="text" style="border:none;margin-top:30px" readonly id="input_select_location_lat" name="lat" value="<?//= $dataItem['lat'] ? $dataItem['lat'] : '' ?>">
    <span style="margin-top:30px">Longitud: </span>
    <input type="text" style="border:none;margin-top:30px" readonly id="input_select_location_lng" name="lng" value="<?//= $dataItem['lng'] ? $dataItem['lng'] : '' ?>">
    <div class="col-12 col-xs-12 col" style="margin-bottom:20px;">
    <div class="select-location">
      <input id="pac-input" class="controls" type="text" placeholder="Search Box">
      <div id="select-location-map" class="map" style="height: 180px;"></div>
      <div class="clearfix"></div>
    </div>

    <script>
var initMapX = false;
$(document).ready(function() {
  
  $( document ).on( 'focus', '.form-post-location', function(){
    $( this ).attr( 'autocomplete', 'off' );
  });

  initMapX = function() { 
    var input = document.getElementById('locationForm<?= $wgetId ?>');
    var lat = $('#input_select_location_lat').val() == '' ? -60 : parseFloat($('#input_select_location_lat').val());
    var lng = $('#input_select_location_lng').val() == '' ? -60 : parseFloat($('#input_select_location_lng').val());


    var SLMAP = new google.maps.Map(document.getElementById('select-location-map'), {
      center: {lat: lat, lng: lng},
      zoom: 12
    });
    var myLatLng = { lat: lat, lng: lng };
    var marker = new google.maps.Marker({
      position: myLatLng,
      draggable: true,
      animation: google.maps.Animation.DROP,
      map: SLMAP,
    });

    var searchBox = new google.maps.places.SearchBox(input);
    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }
      place = places[0];

      $('#input_select_location_lat').val(place.geometry.location.lat());
      $('#input_select_location_lng').val(place.geometry.location.lng());

      var latlng = { lat: place.geometry.location.lat(), lng: place.geometry.location.lng() };
      marker.setPosition(latlng);
      SLMAP.setCenter(latlng);
    });    

     google.maps.event.addListener(marker, 'drag', function() {
       var p = marker.getPosition();
       $('#input_select_location_lat').val( p.lat() );
       $('#input_select_location_lng').val( p.lng() );
     });
  }

  $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyAxsmkXnzCYIiYrcD6QMW2zNqI8U_VuBSk&libraries=places&callback=initMapX", function () {});
  
});
</script>

</div>