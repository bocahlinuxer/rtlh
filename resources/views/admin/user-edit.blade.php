@extends('admin.template')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ubah Pengguna
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/user')}}">Pengguna</a></li>
      <li class="active">Ubah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    {!! Form::open(array('url' => url('admin/user/'.$user->id_user), 'role' => 'form', 'method' => 'PUT')) !!}
      <div class="box box-success" style="width: 50%">
        <div class="box-header with-border">
          <h3 class="box-title">Form Pengguna</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- text input -->
          <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
            <label class="control-label" for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required="true" maxlength="50" readonly value="{{$user->username}}">
            @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
          </div>
          <!-- text input -->
          <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
            <label class="control-label" for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required="true" maxlength="100" value="{{$user->nama}}">
            @if ($errors->has('nama'))
            <span class="help-block">
                <strong>{{ $errors->first('nama') }}</strong>
            </span>
            @endif
          </div>
          <!-- text input -->
          <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" maxlength="100">
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            <span class="help-block">Kosongkan jika tidak merubah password
            </span>
          </div>
          <!-- text input -->
          <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="control-label" for="password_confirmation">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" maxlength="100">
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
            <span class="help-block">Kosongkan jika tidak merubah password
            </span>
          </div>
          <!-- select -->
          <div class="form-group">
            <label class="control-label" for="tipe">Status</label>
            <select class="form-control" id="tipe" name="tipe">
              <option value="1" @if($user->tipe == 1) selected @endif>Super Admin</option>
              <option value="2" @if($user->tipe == 2) selected @endif>Admin Perbekel</option>
              <option value="3" @if($user->tipe == 3) selected @endif>Admin Verifikasi</option>
              <option value="4" @if($user->tipe == 4) selected @endif>Admin Kepala</option>
            </select>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-danger" href="{{url('admin/user')}}">Kembali</a>
          <button type="submit" class="btn btn-primary pull-right">Simpan</button>
        </div>
      </div>
    </form>
  </section>
</div>

<script>
  $(function(){
    $('#user-menu').addClass('active');
  });
</script>
@endsection