@extends('admin.superadmin.template')
@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Daftar Pengguna
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('superadmin/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @if(Session::has('msgsave'))
      <!-- Info alert -->
      <div id="alert" class="alert alert-success alert-styled-left alert-arrow-left alert-component animated shake">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <h6 class="alert-heading text-semibold">{{Session::get('msgsave')}}</h6>    
      </div>
      <!-- /info alert -->
      @endif
      @if(Session::has('msgedit'))
      <!-- Info alert -->
      <div id="alert" class="alert alert-info alert-styled-left alert-arrow-left alert-component animated shake">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <h6 class="alert-heading text-semibold">{{Session::get('msgedit')}}</h6>  
      </div>
      <!-- /info alert -->
      @endif
      @if(Session::has('msgdelete'))
      <!-- Info alert -->
      <div id="alert" class="alert alert-danger alert-styled-left alert-arrow-left alert-component animated shake">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <h6 class="alert-heading text-semibold">{{Session::get('msgdelete')}}</h6>
      </div>
      <!-- /info alert -->
      @endif

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              </h3>
              <a type="button" class="btn btn-primary" href="{{url('superadmin/user/create')}}"><i class="fa fa-plus"> Tambah Baru</i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Status</th>
                    <th>Tgl Input</th>
                    <th>Tgl Ubah</th>
                    <th style="width: 10%">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($users as $u)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $u ->username or '' }}</td>
                    <td>{{ $u -> nama or ''}}</td>
                    <td>{{ $u -> desa -> kecamatan -> kecamatan or ''}}</td>
                    <td>{{ $u -> desa -> desa or ''}}</td>
                    <td>
                      @if($u -> tipe == 1)
                      Super Admin
                      @elseif($u -> tipe == 2)
                      Admin Perbekel
                      @elseif($u -> tipe == 3)
                      Admin Verifikasi
                      @elseif($u -> tipe == 4)
                      Admin Kepala
                      @endif
                    </td>
                    <td>{{ $u -> created_at or ''}}</td>
                    <td>{{ $u -> updated_at or ''}}</td>
                    <td align="center">
                      <div class="btn-group-vertical">
                        <a type="button" class="btn btn-default" href="{{url('superadmin/user/'.$u->id_user.'/edit')}}"><i class="fa fa-edit"> Ubah</i></a>
                        {!! Form::open(array('url' => 'superadmin/user/'.$u->id_user, 'method' => 'delete')) !!}
                            <button type="submit" onclick="return confirm('Apakah anda yakin menghapus data?');" class="btn btn-danger"><i class="fa fa-trash-o"> Hapus</i></button>
                        {!! Form::close() !!}
                      </div>
                    </td>
                  </tr>
                @php
                  $no++;
                @endphp
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Status</th>
                    <th>Tgl Input</th>
                    <th>Tgl Ubah</th>
                    <th style="width: 10%">Opsi</th>
                  </tr>
                </tfoot>
              </table>
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

<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    $('#user-menu').addClass('active');

    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection