@extends('admin.kepala.template')
@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Daftar Rumah Tidak Layak Huni
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminkepala/')}}"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">RTLH</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nik</th>
                    <th>Nama</th>
                    <th>Pekerjaan</th>
                    <th>Alamat</th>
                    <th>Daerah</th>
                    <th>Status</th>
                    <th>Publikasi</th>
                    <th style="width: 10%">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($rtlh as $r)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $r -> nik or '' }}</td>
                    <td>{{ $r -> nama or ''}}</td>
                    <td>{{ $r -> pekerjaan -> pekerjaan or ''}}</td>
                    <td>{{ $r -> alamat or ''}}</td>
                    <td>{{ $r -> desa -> kecamatan -> kecamatan.', '.$r -> desa -> desa}}</td>
                    <td>
                      @if($r -> status == 1)
                      Diusulkan
                      @elseif($r -> status == 2)
                      Terverifikasi
                      @elseif($r -> status == 3)
                      Mendapat Penanganan
                      @endif
                    </td>
                    <td>
                      @if($r -> publish_at != null)
                      Publikasi
                      @else
                      Belum
                      @endif
                    </td>
                    <td align="center">
                      <div class="btn-group-vertical">
                        <a type="button" class="btn btn-default" href="{{url('adminkepala/rtlh/'.$r->id_rtlh)}}"><i class="fa fa-eye"> Detail</i></a>
                        @if($r->status == 2)
                        <a type="button" class="btn btn-success" href="{{url('adminkepala/rtlh/'.$r->id_rtlh.'/program')}}"><i class="fa fa-wrench"> Penanganan</i></a>
                        @endif
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
                    <th>Nik</th>
                    <th>Nama</th>
                    <th>Pekerjaan</th>
                    <th>Alamat</th>
                    <th>Daerah</th>
                    <th>Status</th>
                    <th>Publikasi</th>
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
    $('#rtlh-menu').addClass('active');

    $("#example1").DataTable();
  });
</script>
@endsection