@extends('template')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ubah Rumah Tidak Layak Huni
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('rtlh')}}">RTLH</a></li>
      <li class="active">Ubah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    {!! Form::open(array('url' => url('rtlh/'.$rtlh->id_rtlh), 'role' => 'form', 'method' => 'PUT')) !!}
      <div class="box box-success" style="width: 50%">
        <div class="box-header with-border">
          <h3 class="box-title">Form RTLH</h3>

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
            <label class="control-label" for="jumlah_tanggungan">Jumlah Tanggungan</label>
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
            <label class="control-label" for="penghasilan">Penghasilan</label>
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
            <label class="control-label" for="luas_rumah">Luas Rumah</label>
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
                Layak
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="utilitas_listrik" value="0" @if($rtlh->utilitas_listrik == 0) checked @endif>
                Tidak Layak
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
                Layak
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="utilitas_air" value="0" @if($rtlh->utilitas_air == 0) checked @endif>
                Tidak Layak
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
                Layak
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="utilitas_mck" value="0" @if($rtlh->utilitas_mck == 0) checked @endif>
                Tidak Layak
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
          <div class="form-group {{ $errors->has('latitude') ? ' has-error' : '' }}">
            <label class="control-label" for="latitude">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="latitude" required="true" value="{{$rtlh->latitude}}">
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
            <input type="text" class="form-control" id="longitude" name="longitude" required="true" value="{{$rtlh->longitude}}">
            @if ($errors->has('longitude'))
            <span class="help-block">
                <strong>{{ $errors->first('longitude') }}</strong>
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
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-danger" href="{{url('user')}}">Kembali</a>
          <button type="submit" class="btn btn-primary pull-right">Simpan</button>
        </div>
      </div>
    </form>
  </section>
</div>

<script>
  $(function(){
    $('#rtlh-menu').addClass('active');
  });
</script>
@endsection