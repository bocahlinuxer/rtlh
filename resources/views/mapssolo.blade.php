<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi RTLH</title>
  
  <style>
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0;}
      #mapid{ height: 100% }
    </style>
  <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">
  <script src="{{asset('assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <script src="{{asset('leaflet/leaflet.js')}}"></script>
  <script src="{{asset('leaflet/shpjs/catiline.js')}}"></script>
  <script src="{{asset('leaflet/shpjs/leaflet.shpfile.js')}}"></script>
</head>
<body>
  <div id="mapid"></div>  

  <script>
    $(function () {
      $('#peta-menu').addClass('active');

      var dark = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/dark-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2ludGVyc2NhbGwiLCJhIjoiY2ozZno5MThsMDI2NjMycDhwZWw0cGNjNSJ9.A2Mgv6pcScFBxcHHI08JxA', {
        attribution: 'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 18
      });

      var light = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/light-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2ludGVyc2NhbGwiLCJhIjoiY2ozZno5MThsMDI2NjMycDhwZWw0cGNjNSJ9.A2Mgv6pcScFBxcHHI08JxA', {
        attribution: 'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 18
      });

      //inject shp
      var kabupaten = new L.Shapefile('{{asset('shapefile/kabupaten.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      kabupaten.once("data:loaded", function() {
        console.log("finished loaded kabupaten");
      });

      var kecamatan = new L.Shapefile('{{asset('shapefile/kecamatan.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      kecamatan.once("data:loaded", function() {
        console.log("finished loaded kecamatan");
      });

      var desa = new L.Shapefile('{{asset('shapefile/desa.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      desa.once("data:loaded", function() {
        console.log("finished loaded desa");
      });

      var fasum = new L.Shapefile('{{asset('shapefile/fasum.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      fasum.once("data:loaded", function() {
        console.log("finished loaded fasum");
      });

      var jalan = new L.Shapefile('{{asset('shapefile/jalan.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      jalan.once("data:loaded", function() {
        console.log("finished loaded jalan");
      });

      var kontur = new L.Shapefile('{{asset('shapefile/kontur.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      kontur.once("data:loaded", function() {
        console.log("finished loaded kontur");
      });

      var sungailine = new L.Shapefile('{{asset('shapefile/sungailine.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      sungailine.once("data:loaded", function() {
        console.log("finished loaded sungailine");
      });

      var sungaipoly = new L.Shapefile('{{asset('shapefile/sungaipoly.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      sungaipoly.once("data:loaded", function() {
        console.log("finished loaded sungaipoly");
      });

      var tinggi = new L.Shapefile('{{asset('shapefile/tinggi.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      tinggi.once("data:loaded", function() {
        console.log("finished loaded tinggi");
      });
      
      var lahan = new L.Shapefile('{{asset('shapefile/lahan.zip')}}', {
        onEachFeature: function(feature, layer) {

          if (feature.properties) {
            layer.bindPopup(Object.keys(feature.properties).map(function(k) {
              return k + ": " + feature.properties[k];
            }).join("<br />"), {
              maxHeight: 200
            });
          }
        }
      });
      lahan.once("data:loaded", function() {
        console.log("finished loaded lahan");
      });

      //var mymap = L.map('mapid').setView([-8.346593, 115.520736], 10);

      var mymap = L.map('mapid', {
          center: [-8.346593, 115.520736],
          zoom: 11,
          layers: [dark, kabupaten]
      });

      var baseMaps = {
        "Dark": dark,
        "Light": light
      };

      var overlayMaps = {
        "Kabupaten": kabupaten,
        "Kecamatan": kecamatan,
        "Desa": desa,
        "Fasilitas Umum": fasum,
        "Jalan": jalan,
        "Kontur": kontur,
        "Sungai Line": sungailine,
        "Sungai Poly": sungaipoly,
        "Tinggi": tinggi,
        "Lahan": lahan  
      };

      L.control.layers(baseMaps, overlayMaps).addTo(mymap);
    });
  </script>

</body>
</html>