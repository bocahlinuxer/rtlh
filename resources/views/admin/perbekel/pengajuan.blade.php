@extends('admin.perbekel.template')
@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css
">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Daftar Usulan Rumah Tidak Layak Huni
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminperbekel//')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Usulan RTLH</li>
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
              <a type="button" class="btn btn-primary" href="{{url('adminperbekel/pengajuan/create')}}"><i class="fa fa-plus"> Usulan Baru</i></a>
            </div>
            <!-- /.box-header -->
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
                      Diajukan
                      @elseif($r -> status == 2)
                      Diverifikasi
                      @endif
                    </td>
                    <td align="center">
                      <div class="btn-group-vertical">
                        <a type="button" class="btn btn-default" href="{{url('adminperbekel/pengajuan/'.$r->id_rtlh)}}"><i class="fa fa-eye"> Detail</i></a>
                        {!! Form::open(array('url' => 'adminperbekel/pengajuan/'.$r->id_rtlh, 'method' => 'delete')) !!}
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
                    <th>Nik</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Daerah</th>
                    <th>Status</th>
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
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

<script>
  $(function () {
    $('#pengajuan-menu').addClass('active');

    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
  });
</script>
@endsection