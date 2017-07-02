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

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data RTLH</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- text input -->
              <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                <label class="control-label" for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required="true" maxlength="100" value="{{$rtlh->nama}}">
                @if ($errors->has('nama'))
                <span class="help-block">
                    <strong>{{ $errors->first('nama') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->

              <!-- text input -->
              <div class="form-group {{ $errors->has('nik') ? ' has-error' : '' }}">
                <label class="control-label" for="nik">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" required="true" maxlength="20" value="{{$rtlh->nik}}">
                @if ($errors->has('nik'))
                <span class="help-block">
                    <strong>{{ $errors->first('nik') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->

              <!-- text input -->
              <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                <label class="control-label" for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required="true" maxlength="100" value="{{$rtlh->alamat}}">
                @if ($errors->has('alamat'))
                <span class="help-block">
                    <strong>{{ $errors->first('alamat') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->

              <!-- select -->
              <div class="form-group">
                <label class="control-label" for="desa">Desa</label>
                <select class="form-control" id="desa" name="desa">
                  @foreach($kecamatan as $kec)
                  <optgroup label="{{$kec->kecamatan}}">
                    @foreach($kec->desa as $des)
                    <option value="{{$des->id_desa}}" @if($rtlh->id_desa == $des->id_desa) selected @endif>{{$des->desa}}</option>
                    @endforeach
                  </optgroup>
                  @endforeach
                </select>
              </div>
              <!-- select -->

              <!-- select -->
              <div class="form-group">
                <label class="control-label" for="pekerjaan">Pekerjaan</label>
                <select class="form-control" id="pekerjaan" name="pekerjaan">
                  @foreach($pekerjaan as $p)
                  <option value="{{$p->id_pekerjaan}}" @if($rtlh->id_pekerjaan == $p->id_pekerjaan) selected @endif>{{$p->pekerjaan}}</option>
                  @endforeach
                </select>
              </div>
              <!-- select -->

              <!-- text input -->
              <div class="form-group {{ $errors->has('jumlah_tanggungan') ? ' has-error' : '' }}">
                <label class="control-label" for="jumlah_tanggungan">Jumlah Tanggungan (Orang)</label>
                <input type="number" class="form-control" id="jumlah_tanggungan" name="jumlah_tanggungan" required="true" value="{{$rtlh->jumlah_tanggungan}}">
                @if ($errors->has('jumlah_tanggungan'))
                <span class="help-block">
                    <strong>{{ $errors->first('jumlah_tanggungan') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->

              <!-- text input -->
              <div class="form-group {{ $errors->has('penghasilan') ? ' has-error' : '' }}">
                <label class="control-label" for="penghasilan">Penghasilan (Rp)</label>
                <input type="number" class="form-control" id="penghasilan" name="penghasilan" required="true" value="{{$rtlh->penghasilan}}">
                @if ($errors->has('penghasilan'))
                <span class="help-block">
                    <strong>{{ $errors->first('penghasilan') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->

              <!-- text input -->
              <div class="form-group {{ $errors->has('luas_rumah') ? ' has-error' : '' }}">
                <label class="control-label" for="luas_rumah">Luas Rumah (M<sup>2</sup>)</label>
                <input type="number" class="form-control" id="luas_rumah" name="luas_rumah" required="true" value="{{$rtlh->luas_rumah}}">
                @if ($errors->has('luas_rumah'))
                <span class="help-block">
                    <strong>{{ $errors->first('luas_rumah') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->
              
              <!-- radio -->
              <div class="form-group">
                <label class="control-label">Kondisi Lantai</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="kondisi_lantai" value="1" @if($rtlh->kondisi_lantai == 1) checked @endif>
                    Layak
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="kondisi_lantai" value="0" @if($rtlh->kondisi_lantai == 0) checked @endif>
                    Tidak Layak
                  </label>
                </div>
              </div>
              <!-- radio -->

              <!-- radio -->
              <div class="form-group">
                <label class="control-label">Kondisi Dinding</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="kondisi_dinding" value="1" @if($rtlh->kondisi_dinding == 1) checked @endif>
                    Layak
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="kondisi_dinding" value="0" @if($rtlh->kondisi_dinding == 0) checked @endif>
                    Tidak Layak
                  </label>
                </div>
              </div>
              <!-- radio -->

              <!-- radio -->
              <div class="form-group">
                <label class="control-label">Kondisi Atap</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="kondisi_atap" value="1" @if($rtlh->kondisi_atap == 1) checked @endif>
                    Layak
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="kondisi_atap" value="0" @if($rtlh->kondisi_atap == 0) checked @endif>
                    Tidak Layak
                  </label>
                </div>
              </div>
              <!-- radio -->

              <!-- radio -->
              <div class="form-group">
                <label class="control-label">Utilitas Listrik</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="utilitas_listrik" value="1" @if($rtlh->utilitas_listrik == 1) checked @endif>
                    Ada
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="utilitas_listrik" value="0" @if($rtlh->utilitas_listrik == 0) checked @endif>
                    Tidak Ada
                  </label>
                </div>
              </div>
              <!-- radio -->

              <!-- radio -->
              <div class="form-group">
                <label class="control-label">Utilitas Air</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="utilitas_air" value="1" @if($rtlh->utilitas_air == 1) checked @endif>
                    Ada
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="utilitas_air" value="0" @if($rtlh->utilitas_air == 0) checked @endif>
                    Tidak Ada
                  </label>
                </div>
              </div>
              <!-- radio -->

              <!-- radio -->
              <div class="form-group">
                <label class="control-label">Utilitas MCK</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="utilitas_mck" value="1" @if($rtlh->utilitas_mck == 1) checked @endif>
                    Ada
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="utilitas_mck" value="0" @if($rtlh->utilitas_mck == 0) checked @endif>
                    Tidak Ada
                  </label>
                </div>
              </div>
              <!-- radio -->

              <!-- radio -->
              <div class="form-group">
                <label class="control-label">Bukti</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="bukti" value="1" @if($rtlh->bukti == 1) checked @endif>
                    Sertifikat Hak Atas Tanah
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="bukti" value="2" @if($rtlh->bukti == 2) checked @endif>
                    Surat Keterangan Pejabat
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="bukti" value="3" @if($rtlh->bukti == 3) checked @endif>
                    Bukti Lain
                  </label>
                </div>
              </div>
              <!-- radio -->

              <!-- text input -->
              <div class="form-group {{ $errors->has('jenis_penanganan') ? ' has-error' : '' }}">
                <label class="control-label" for="jenis_penanganan">Jenis Penanganan</label>
                <input type="text" class="form-control" id="jenis_penanganan" name="jenis_penanganan" maxlength="255" value="{{$rtlh->jenis_penanganan}}">
                @if ($errors->has('jenis_penanganan'))
                <span class="help-block">
                    <strong>{{ $errors->first('jenis_penanganan') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->

              <!-- text input -->
              <div class="form-group {{ $errors->has('sumber_data') ? ' has-error' : '' }}">
                <label class="control-label" for="sumber_data">Sumber Data</label>
                <input type="text" class="form-control" id="sumber_data" name="sumber_data" maxlength="255" value="{{$rtlh->sumber_data}}">
                @if ($errors->has('sumber_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('sumber_data') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->

              <!-- text input -->
              <div class="form-group {{ $errors->has('data_lainnya') ? ' has-error' : '' }}">
                <label class="control-label" for="data_lainnya">Data Lainnya</label>
                <input type="text" class="form-control" id="data_lainnya" name="data_lainnya" maxlength="255" value="{{$rtlh->data_lainnya}}">
                @if ($errors->has('data_lainnya'))
                <span class="help-block">
                    <strong>{{ $errors->first('data_lainnya') }}</strong>
                </span>
                @endif
              </div>
              <!-- text input -->
            </div>
          </div>
        </div>
      </div>

      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Form Geografis</h3>

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

    if(latitude.val() != "" && longitude.val() != "")
    {
      marker = L.marker([parseFloat("{{$rtlh->latitude}}"), parseFloat("{{$rtlh->longitude}}")], {icon: redIcon, draggable: true}).bindPopup("{{$rtlh->nama}}");
      marker.on('drag', function(e) {
        latitude.val(e.target.getLatLng().lat);
        longitude.val(e.target.getLatLng().lng);
      });
      marker.addTo(map);
    }
  });

  function checklatlong()
  {
    if(latitude.val() != "" && longitude.val() != "")
    {
      if(marker == null)
      {
        marker = L.marker([parseFloat(latitude.val()), parseFloat(longitude.val())], {icon: redIcon, draggable: true}).bindPopup("{{$rtlh->nama}}");
        marker.on('drag', function(e) {
          latitude.val(e.target.getLatLng().lat);
          longitude.val(e.target.getLatLng().lng);
        });
        marker.addTo(map);
      }
      else
      {
        marker.setLatLng([parseFloat(latitude.val()), parseFloat(longitude.val())]);
      }
    }
  }
</script>
@endsection