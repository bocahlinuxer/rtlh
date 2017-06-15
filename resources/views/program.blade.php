@extends('template')
@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Rekap Penanganan RTLH
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Rekap</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Rumah</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Foto 0%</th>
                    <th>Foto 100%</th>
                    <th>OPD</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($rtlh as $p)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->desa->kecamatan->kecamatan }}</td>
                    <td>{{ $p->desa->desa }}</td>
                    <td><img src="{{asset('img/penanganan/'.$p-> foto0)}}" class="img-responsive" style="max-width: 150px"></td>
                    <td><img src="{{asset('img/penanganan/'.$p-> foto100)}}" class="img-responsive" style="max-width: 150px"></td>
                    <td>{{ $p -> opd -> opd or ''}}</td>
                  </tr>
                @php
                  $no++;
                @endphp
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Rumah</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Foto 0%</th>
                    <th>Foto 100%</th>
                    <th>OPD</th>
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
    $('#program-menu').addClass('active');

    $("#example1").DataTable();
  });
</script>
@endsection