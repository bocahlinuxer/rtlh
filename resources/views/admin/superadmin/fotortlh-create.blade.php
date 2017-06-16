@extends('admin.superadmin.template')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Foto RTLH
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('superadmin/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('superadmin/rtlh/'.$idrtlh)}}">Foto RTLH</a></li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    {!! Form::open(array('url' => url('superadmin/rtlh/'.$idrtlh.'/fotortlh'), 'role' => 'form', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
      <div class="box box-success" style="width: 50%">
        <div class="box-header with-border">
          <h3 class="box-title">Form Foto RTLH</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- text input -->
          <div class="form-group {{ $errors->has('file_fotortlh') ? ' has-error' : '' }}">
            <label class="control-label" for="file_fotortlh">Foto RTLH</label>
            <input type="file" class="form-control" id="file_fotortlh" name="file_fotortlh" required="true">
            @if ($errors->has('file_fotortlh'))
            <span class="help-block">
                <strong>{{ $errors->first('file_fotortlh') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-danger" href="{{url('superadmin/rtlh/'.$idrtlh)}}">Kembali</a>
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