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
<script>var baseurl = "{{url('')}}" + '/'</script>
<script src="{{asset('leaflet/meong.js')}}"></script>
<script>
  var latitude = $('#latitude');
  var longitude = $('#longitude');
  var marker;
  var map;

  $(function () {
    $('#verifikasi-menu').addClass('active');

    marker = L.marker([parseFloat("{{$rtlh->latitude}}"), parseFloat("{{$rtlh->longitude}}")], {icon: redIcon, draggable: true}).bindPopup("{{$rtlh->nama}}");
    marker.on('drag', function(e) {
      latitude.val(e.target.getLatLng().lat);
      longitude.val(e.target.getLatLng().lng);
    });
    marker.addTo(map);
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