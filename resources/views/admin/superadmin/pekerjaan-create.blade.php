@extends('admin.superadmin.template')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Pekerjaan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('superadmin/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('superadmin/pekerjaan')}}">Pekerjaan</a></li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    {!! Form::open(array('url' => url('superadmin/pekerjaan'), 'role' => 'form', 'method' => 'POST')) !!}
      <div class="box box-success" style="width: 50%">
        <div class="box-header with-border">
          <h3 class="box-title">Form Pekerjaan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- text input -->
          <div class="form-group {{ $errors->has('pekerjaan') ? ' has-error' : '' }}">
            <label class="control-label" for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required="true" maxlength="100" value="{{old('pekerjaan')}}">
            @if ($errors->has('pekerjaan'))
            <span class="help-block">
                <strong>{{ $errors->first('pekerjaan') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-danger" href="{{url('superadmin/pekerjaan')}}">Kembali</a>
          <button type="submit" class="btn btn-primary pull-right">Simpan</button>
        </div>
      </div>
    </form>
  </section>
</div>

<script>
  $(function(){
    $('#pekerjaan-menu').addClass('active');
  });
</script>
@endsection