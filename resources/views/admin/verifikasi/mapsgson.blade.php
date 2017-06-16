@extends('admin.verifikasi.template')
@section('content')

<link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Peta Rumah Tidak Layak Huni
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminverifikasi//')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Peta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            {{-- <div class="box-header">
              <h3 class="box-title">
                Peta
              </h3>
            </div> --}}
            <!-- /.box-header -->
            <div class="box-body">
              <div id="mapid" style="height: 550px"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script src="{{asset('leaflet/leaflet.js')}}"></script>
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

    var MarkerIcon = L.Icon.extend({
        options: {
            iconSize:     [42, 42],
            iconAnchor:   [21, 42],
            popupAnchor:  [0, -36]
        }
    });

    var redIcon = new MarkerIcon({iconUrl: '{{asset('leaflet/images/merah.png')}}' }),
    blueIcon = new MarkerIcon({iconUrl: '{{asset('leaflet/images/biru.png')}}' }),
    greenIcon = new MarkerIcon({iconUrl: '{{asset('leaflet/images/hijau.png')}}' }),
    yellowIcon = new MarkerIcon({iconUrl: '{{asset('leaflet/images/kuning.png')}}' });

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
    $.getJSON("{{asset('geojson/kabupaten.geojson')}}",function(data){
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

    $.getJSON("{{asset('geojson/kecamatan.geojson')}}",function(data){
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

    $.getJSON("{{asset('geojson/desa.geojson')}}",function(data){
      // add GeoJSON layer to the map once the file is loaded
      var desa = L.geoJson(data, {
        style: function(feature){
          var letters = '0123456789ABCDEF';
          var color = '#';
          for (var i = 0; i < 6; i++ ) {
              color += letters[Math.floor(Math.random() * 16)];
          }
          return { color: color, weight: 1, fillColor: color, fillOpacity: 0 };
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

    $.getJSON("{{asset('geojson/jalan.geojson')}}",function(data){
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

    $.getJSON("{{url('adminverifikasi/ajax/rumah')}}",function(data){
      var markers = [];
      $.each(data, function(key, value){
        if(value.status == 1)
        {
          markers.push(L.marker([parseFloat(value.latitude), parseFloat(value.longitude)], {icon: redIcon}).bindPopup(value.nama));
        } else if(value.status == 2)
        {
          markers.push(L.marker([parseFloat(value.latitude), parseFloat(value.longitude)], {icon: blueIcon}).bindPopup(value.nama));
        } else if(value.status == 3)
        {
          markers.push(L.marker([parseFloat(value.latitude), parseFloat(value.longitude)], {icon: greenIcon}).bindPopup(value.nama));
        } else if(value.status == 4)
        {
          markers.push(L.marker([parseFloat(value.latitude), parseFloat(value.longitude)], {icon: yellowIcon}).bindPopup(value.nama));
        }
      });
      control.addOverlay(L.layerGroup(markers), "RTLH");
    });
  });
</script>
@endsection