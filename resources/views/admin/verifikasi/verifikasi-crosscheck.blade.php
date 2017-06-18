@extends('admin.verifikasi.template')
@section('content')

<link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crosscheck Verifikasi
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('adminverifikasi/')}}"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li><a href="{{url('adminverifikasi/terverifikasi/'.$rtlh->id_rtlh)}}">Detail RTLH</a></li>
      <li class="active">Verifikasi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    {!! Form::open(array('url' => url('adminverifikasi/verifikasi/'.$rtlh->id_rtlh.'/verify'), 'role' => 'form', 'method' => 'PUT', 'enctype' => 'multipart/form-data')) !!}
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Form Verifikasi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- text input -->
          <div class="form-group {{ $errors->has('latitude') ? ' has-error' : '' }}">
            <label class="control-label" for="latitude">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="latitude" required="true" onblur="checklatlong()" value="{{$rtlh->latitude}}">
            @if ($errors->has('latitude'))
            <span class="help-block">
                <strong>{{ $errors->first('latitude') }}</strong>
            </span>
            @endif
          </div>
          <!-- text input -->

          <!-- text input -->
          <div class="form-group {{ $errors->has('longitude') ? ' has-error' : '' }}">
            <label class="control-label" for="longitude">Longitude</label>
            <input type="text" class="form-control" id="longitude" name="longitude" required="true" onblur="checklatlong()" value="{{$rtlh->longitude}}">
            @if ($errors->has('longitude'))
            <span class="help-block">
                <strong>{{ $errors->first('longitude') }}</strong>
            </span>
            @endif
          </div>
          <!-- text input -->
          <h5>Drag marker pada peta untuk menentukan posisi</h5>
          <div id="mapid" style="height: 400px"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-danger" href="{{url('adminverifikasi/verifikasi/'.$rtlh->id_rtlh)}}">Kembali</a>
          <button type="submit" class="btn btn-primary pull-right">Simpan</button>
        </div>
      </div>
    </form>
  </section>
</div>

<script src="{{asset('leaflet/leaflet.js')}}"></script>
<script>
  var latitude = $('#latitude');
  var longitude = $('#longitude');
  var marker;
  var map;

  $(function () {
    $('#verifikasi-menu').addClass('active');

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

    var redIcon = new MarkerIcon({iconUrl: '{{asset('leaflet/images/merah.png')}}' }),
    blueIcon = new MarkerIcon({iconUrl: '{{asset('leaflet/images/biru.png')}}' }),
    greenIcon = new MarkerIcon({iconUrl: '{{asset('leaflet/images/hijau.png')}}' }),
    yellowIcon = new MarkerIcon({iconUrl: '{{asset('leaflet/images/kuning.png')}}' });

    map = L.map('mapid', {
        center: [-8.346593, 115.520736],
        zoom: 11,
        layers: [dark]
    });

    marker = L.marker([parseFloat("{{$rtlh->latitude}}"), parseFloat("{{$rtlh->longitude}}")], {icon: redIcon, draggable: true}).bindPopup("{{$rtlh->nama}}");
    marker.on('drag', function(e) {
      latitude.val(e.target.getLatLng().lat);
      longitude.val(e.target.getLatLng().lng);
    });
    marker.addTo(map);

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
          return { color: '#F22', weight: 1, fillColor: color, fillOpacity: 0 };
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
  });

  function checklatlong()
  {
    if(latitude.val() != "" && longitude.val() != "")
    {
      marker.setLatLng([parseFloat(latitude.val()), parseFloat(longitude.val())]);
    }
  }
</script>
@endsection