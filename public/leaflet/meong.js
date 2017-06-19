var dark = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/dark-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2ludGVyc2NhbGwiLCJhIjoiY2ozZno5MThsMDI2NjMycDhwZWw0cGNjNSJ9.A2Mgv6pcScFBxcHHI08JxA', {
  attribution: 'Imagery © <a href="http://mapbox.com">Mapbox</a>',
  maxZoom: 18
});

var light = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/light-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2ludGVyc2NhbGwiLCJhIjoiY2ozZno5MThsMDI2NjMycDhwZWw0cGNjNSJ9.A2Mgv6pcScFBxcHHI08JxA', {
  attribution: 'Imagery © <a href="http://mapbox.com">Mapbox</a>',
  maxZoom: 18
});

var MarkerIcon = L.Icon.extend({
    options: {
        iconSize:     [30, 30],
        iconAnchor:   [15, 30],
        popupAnchor:  [0, -24]
    }
});

var redIcon = new MarkerIcon({iconUrl: baseurl + 'leaflet/images/merah.png' }),
blueIcon = new MarkerIcon({iconUrl: baseurl + 'leaflet/images/biru.png' }),
greenIcon = new MarkerIcon({iconUrl: baseurl + 'leaflet/images/hijau.png' }),
yellowIcon = new MarkerIcon({iconUrl: baseurl + 'leaflet/images/kuning.png' });

var map = L.map('mapid', {
    center: [-8.346593, 115.520736],
    zoom: 11,
    layers: [dark]
});

var baseMap = {
  "Dark": dark,
  "Light": light
};

// Create the control and add it to the map;
var control = L.control.layers(baseMap); // Grab the handle of the Layer Control, it will be easier to find.
control.addTo(map);

// load GeoJSON from an external file
$.getJSON(baseurl + "geojson/kabupaten.geojson",function(data){
  // add GeoJSON layer to the map once the file is loaded
  var kabupaten = L.geoJson(data, {
    style: function(feature){
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++ ) {
          color += letters[Math.floor(Math.random() * 16)];
      }
      return { color: "#999", weight: 1, fillColor: color, fillOpacity: .6 };
    },
    onEachFeature: function( feature, layer ){
      layer.bindPopup( 
        "Kabupaten: <strong>" + feature.properties.KABKOT + "</strong><br>"
        )
    }
  }).addTo(map);

  control.addOverlay(kabupaten, "Kabupaten");
});

$.getJSON(baseurl + "geojson/kecamatan.geojson",function(data){
  // add GeoJSON layer to the map once the file is loaded
  var kecamatan = L.geoJson(data, {
    style: function(feature){
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++ ) {
          color += letters[Math.floor(Math.random() * 16)];
      }
      return { color: "#999", weight: 1, fillColor: color, fillOpacity: .6 };
    },
    onEachFeature: function( feature, layer ){
      layer.bindPopup(
        "Kabupaten: <strong>Karangasem</strong><br>" +
        "Kecamatan: <strong>" + feature.properties.KECAMATAN + "</strong><br>"
        )
    }
  })

  control.addOverlay(kecamatan, "Kecamatan");
});

$.getJSON(baseurl + "geojson/desa.geojson",function(data){
  // add GeoJSON layer to the map once the file is loaded
  var desa = L.geoJson(data, {
    style: function(feature){
      return { color: '#F22', weight: 1, fillColor: '#F22', fillOpacity: 0 };
    },
    onEachFeature: function( feature, layer ){
      layer.bindPopup(
        "Kabupaten: <strong>" + feature.properties.KABKOT + "</strong><br>" +
        "Kecamatan: <strong>" + feature.properties.KECAMATAN + "</strong><br>" +
        "Desa: <strong>" + feature.properties.DESA + "</strong><br>"
        )
    }
  })

  control.addOverlay(desa, "Desa");
});

$.getJSON(baseurl + "geojson/jalan.geojson",function(data){
  // add GeoJSON layer to the map once the file is loaded
  var jalan = L.geoJson(data, {
    style: function(feature){
      return { color: '#FFF', weight: 1};
    },
    onEachFeature: function( feature, layer ){
      layer.bindPopup(
        "Pangkal Ruas: <strong>" + feature.properties.PGKL_RUAS + "</strong><br>" +
        "Ujung Ruas: <strong>" + feature.properties.UJUNG_RUAS + "</strong><br>"
        )
    }
  })

  control.addOverlay(jalan, "Jalan");
});