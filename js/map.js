var markerClicked;
var markers = [];
var map = L.map('map').setView([55.8642, -4.2518], 12);

L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=3GpPcDV1tQlWZwH6rYla',{
  tileSize: 512,
  zoomOffset: -1,
  minZoom: 1,
  attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
  crossOrigin: true
}).addTo(map);

map.on('click', function(e){
  var latlng = map.mouseEventToLatLng(e.originalEvent);
  var lat = latlng.lat.toFixed(6);
  var long = latlng.lng.toFixed(6);

  document.getElementById("lat").value = lat;
  document.getElementById("long").value = long;

  if(markerClicked != null){
    map.removeLayer(markerClicked);
  }
  markerClicked = L.marker([lat, long]).addTo(map);
});

