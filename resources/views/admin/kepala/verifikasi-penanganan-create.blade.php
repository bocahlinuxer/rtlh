@extends('admin.template')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Penanganan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/terverifikasi/'.$idrtlh.'/penanganan')}}">Penanganan</a></li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    {!! Form::open(array('url' => url('admin/terverifikasi/'.$idrtlh.'/penanganan'), 'role' => 'form', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
      <div class="box box-success" style="width: 50%">
        <div class="box-header with-border">
          <h3 class="box-title">Form Penanganan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- text input -->
          <div class="form-group {{ $errors->has('foto0') ? ' has-error' : '' }}">
            <label class="control-label" for="foto0">Foto 0%</label>
            <input type="file" class="form-control" id="foto0" name="foto0" required="true">
            @if ($errors->has('foto0'))
            <span class="help-block">
                <strong>{{ $errors->first('foto0') }}</strong>
            </span>
            @endif
          </div>

          <!-- text input -->
          <div class="form-group {{ $errors->has('foto100') ? ' has-error' : '' }}">
            <label class="control-label" for="foto100">Foto 100%</label>
            <input type="file" class="form-control" id="foto100" name="foto100" required="true">
            @if ($errors->has('foto100'))
            <span class="help-block">
                <strong>{{ $errors->first('foto100') }}</strong>
            </span>
            @endif
          </div>

          <!-- select -->
          <div class="form-group">
            <label class="control-label" for="id_opd">OPD</label>
            <select class="form-control" id="id_opd" name="id_opd">
              @foreach($opd as $o)
              <option value="{{$o->id_opd}}">{{$o->opd}}</option>
              @endforeach
            </select>
          </div>
          <!-- select -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-danger" href="{{url('admin/terverifikasi/'.$idrtlh.'/penanganan')}}">Kembali</a>
          <button type="submit" class="btn btn-primary pull-right">Simpan</button>
        </div>
      </div>
    </form>
  </section>
</div>

<script>
  $(function(){
    $('#terverifikasi-menu').addClass('active');
  });
</script>
@endsection