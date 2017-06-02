@extends('template')
@section('content')

<link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Peta Rumah Tidak Layak Huni
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
              <div id="mapid" style="height: 500px"></div>
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
<script src="{{asset('leaflet/shpjs/catiline.js')}}"></script>
<script src="{{asset('leaflet/shpjs/leaflet.shpfile.js')}}"></script>
<script>
  $(function () {
    $('#peta-menu').addClass('active');

    var mymap = L.map('mapid').setView([-8.346593, 115.520736], 10);

    L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/dark-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2ludGVyc2NhbGwiLCJhIjoiY2ozZno5MThsMDI2NjMycDhwZWw0cGNjNSJ9.A2Mgv6pcScFBxcHHI08JxA', {
      attribution: 'Imagery © <a href="http://mapbox.com">Mapbox</a>',
      maxZoom: 18
    }).addTo(mymap);
    
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

    //var group1 = L.layerGroup([shpfile, shpfile2, shpfile3]);

    var baseMaps = {

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
@endsection