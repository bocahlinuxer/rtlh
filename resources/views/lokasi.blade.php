@extends('template')
@section('content')

<link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Lokasi Rumah Tidak Layak Huni
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Lokasi</li>
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
<script>var baseurl = "{{url('')}}" + '/'</script>
<script src="{{asset('leaflet/meong.js')}}"></script>
<script>
  $(function () {
    $('#lokasi-menu').addClass('active');

    $.getJSON("{{url('ajax/rumah')}}",function(data){
      var markers = [];
      $.each(data, function(key, value){
        if(value.status == 1)
        {
          markers.push(L.marker([parseFloat(value.latitude), parseFloat(value.longitude)], {icon: redIcon})
            .bindPopup('<a href="{{url('rtlh')}}/'+value.id_rtlh+'">'+value.nama+'</a>'));
        } else if(value.status == 2)
        {
          markers.push(L.marker([parseFloat(value.latitude), parseFloat(value.longitude)], {icon: blueIcon})
            .bindPopup('<a href="{{url('rtlh')}}/'+value.id_rtlh+'">'+value.nama+'</a>'));
        } else if(value.status == 3)
        {
          markers.push(L.marker([parseFloat(value.latitude), parseFloat(value.longitude)], {icon: greenIcon})
            .bindPopup('<a href="{{url('rtlh')}}/'+value.id_rtlh+'">'+value.nama+'</a>'));
        } else if(value.status == 4)
        {
          markers.push(L.marker([parseFloat(value.latitude), parseFloat(value.longitude)], {icon: yellowIcon})
            .bindPopup('<a href="{{url('rtlh')}}/'+value.id_rtlh+'">'+value.nama+'</a>'));
        }
      });

      var layerGroup = L.layerGroup(markers);
      layerGroup.addTo(map);
      control.addOverlay(layerGroup, "RTLH");
    });
  });
</script>
@endsection