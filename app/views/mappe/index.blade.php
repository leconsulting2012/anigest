@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop

@section('bodyOnLoad')
<body onload="initMap()" class="skin-blue fixed">
@stop

{{-- Content --}}
@section('content')
<div class="col-xs-12">
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Mappa dei tuoi Interventi non Completati</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div id='map-canvas'></div>
    </div>
  </div>
</div>
@stop


@section('jsEsterniBefore')
<style type="text/css">
  #map-canvas {  width: 100%; 
          height: 400px; }
      
</style>
  
<script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>

<script type='text/javascript'>
var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
  new google.maps.Size(32, 32), 
  new google.maps.Point(0, 0),
  new google.maps.Point(16, 32));
var center = null;
var map = null;
var currentPopup;
var bounds = new google.maps.LatLngBounds();
function addMarker(lat, lng, info) {
  var pt = new google.maps.LatLng(lat, lng);
  bounds.extend(pt);
  var marker = new google.maps.Marker({
    position: pt,
    icon: icon,
    map: map
  });
  var popup = new google.maps.InfoWindow({
    content: info,
    maxWidth: 400
  });
  google.maps.event.addListener(marker, "click", function() {
    if (currentPopup != null) {
      currentPopup.close();
      currentPopup = null;
    }
    popup.open(map, marker);
    currentPopup = popup;
  });
  google.maps.event.addListener(popup, "closeclick", function() {
    map.panTo(center);
    currentPopup = null;
  });
}
function initMap() {
  map = new google.maps.Map(document.getElementById("map-canvas"), {
    center: new google.maps.LatLng(0, 0),
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
    },
    disableDefaultUI: true,
    navigationControl: true,
    navigationControlOptions: {
      style: google.maps.NavigationControlStyle.SMALL
    }
  });
@foreach ($elenco as $riga)
  addMarker({{$riga['lat']}}, {{$riga['lon']}},'<div class="popup"><h2 id="{{$riga['nominativo']}}">{{$riga['nominativo']}}</h2><p><b>{{$riga['descrizione']}}</b><br/>{{$riga['indirizzo']}}<br/>{{$riga['citta']}}<br/><small><b>Lat.</b> 52.520196, <b>Lon.</b> 13.406067</small></p></div>');

@endforeach

  center = bounds.getCenter();
  map.fitBounds(bounds);

}
</script>

@stop
