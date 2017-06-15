@extends('admin.template')
@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Rumah Tidak Layak Huni Terverifikasi
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
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
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Data Penghuni
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong>Nama</strong>
              <br>
              &nbsp {{$rtlh->nama}}
              <br>

              <br>
              <strong>NIK</strong>
              <br>
              &nbsp {{$rtlh->nik}}
              <br>

              <br>
              <strong>Alamat</strong>
              <br>
              &nbsp {{$rtlh->alamat}}
              <br>

              <br>
              <strong>Daerah</strong>
              <br>
              &nbsp {{$rtlh->desa->kecamatan->kecamatan.', '.$rtlh->desa->desa}}
              <br>

              <br>
              <strong>Pekerjaan</strong>
              <br>
              &nbsp {{$rtlh->pekerjaan->pekerjaan}}
              <br>

              <br>
              <strong>Jumlah Tanggungan</strong>
              <br>
              &nbsp {{$rtlh->jumlah_tanggungan}}
              <br>

              <br>
              <strong>Penghasilan</strong>
              <br>
              &nbsp {{$rtlh->penghasilan}}
              <br>

              <br>
              <strong>Bukti</strong>
              <br>
              @if($rtlh->bukti == 1)
              &nbsp Sertifikat Hak Atas Tanah
              @elseif($rtlh->bukti == 2)
              &nbsp Surat Keterangan Pejabat
              @elseif($rtlh->bukti == 3)
              &nbsp Bukti Lain
              @endif
              <br>

              <br>
              <strong>Data Lainnya</strong>
              <br>
              &nbsp {{$rtlh->data_lainnya or 'Tidak Ada'}}
              <br>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Data Rumah
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong>Luas Rumah</strong>
              <br>
              &nbsp {{$rtlh->luas_rumah}}
              <br>

              <br>
              <strong>Kondisi Lantai</strong>
              <br>
              @if($rtlh->kondisi_lantai == 1)
              &nbsp Layak
              @else
              &nbsp Tidak Layak
              @endif
              <br>

              <br>
              <strong>Kondisi Atap</strong>
              <br>
              @if($rtlh->kondisi_atap == 1)
              &nbsp Layak
              @else
              &nbsp Tidak Layak
              @endif
              <br>

              <br>
              <strong>Kondisi Dinding</strong>
              <br>
              @if($rtlh->kondisi_dinding == 1)
              &nbsp Layak
              @else
              &nbsp Tidak Layak
              @endif
              <br>

              <br>
              <strong>Utilitas Listrik</strong>
              <br>
              @if($rtlh->utilitas_listrik == 1)
              &nbsp Ada
              @else
              &nbsp Tidak Ada
              @endif
              <br>

              <br>
              <strong>Utilitas Air</strong>
              <br>
              @if($rtlh->utilitas_air == 1)
              &nbsp Ada
              @else
              &nbsp Tidak Ada
              @endif
              <br>

              <br>
              <strong>Utilitas MCK</strong>
              <br>
              @if($rtlh->utilitas_mck == 1)
              &nbsp Ada
              @else
              &nbsp Tidak Ada
              @endif
              <br>

              <br>
              <strong>Koordinat</strong>
              <br>
              &nbsp {{$rtlh->latitude.', '.$rtlh->longitude}}
              <br>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Foto RTLH
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Tgl Input</th>
                    <th>Tgl Ubah</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($rtlh->foto_rtlh as $u)
                  <tr>
                    <td>{{ $no }}</td>
                    <td><img src="{{asset('img/rtlh/'.$u-> file_fotortlh)}}" class="img-responsive" style="max-width: 150px"></td>
                    <td>{{ $u -> created_at or ''}}</td>
                    <td>{{ $u -> updated_at or ''}}</td>
                  </tr>
                @php
                  $no++;
                @endphp
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Tgl Input</th>
                    <th>Tgl Ubah</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Penanganan RTLH
              </h3>
              <a type="button" class="btn btn-primary pull-right" style="margin-top: -5px" href="{{url('admin/terverifikasi/'.$rtlh->id_rtlh.'/penanganan/create')}}"><i class="fa fa-plus"> Tambah Penanganan</i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto 0%</th>
                    <th>Foto 100%</th>
                    <th>OPD</th>
                    <th>Tgl Input</th>
                    <th>Tgl Ubah</th>
                    <th style="width: 10%">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($rtlh->penanganan as $p)
                  <tr>
                    <td>{{ $no }}</td>
                    <td><img src="{{asset('img/penanganan/'.$p-> foto0)}}" class="img-responsive" style="max-width: 150px"></td>
                    <td><img src="{{asset('img/penanganan/'.$p-> foto100)}}" class="img-responsive" style="max-width: 150px"></td>
                    <td>{{ $p -> opd -> opd or ''}}</td>
                    <td>{{ $p -> created_at or ''}}</td>
                    <td>{{ $p -> updated_at or ''}}</td>
                    <td align="center">
                      <div class="btn-group-vertical">
                        <a type="button" class="btn btn-default" href="{{url('admin/terverifikasi/'.$rtlh->id_rtlh.'/penanganan/'.$p->id_penanganan.'/edit')}}"><i class="fa fa-edit"> Ubah</i></a>
                        {!! Form::open(array('url' => 'admin/terverifikasi/'.$rtlh->id_rtlh.'/penanganan/'.$p->id_penanganan, 'method' => 'delete')) !!}
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
                    <th>Foto 0%</th>
                    <th>Foto 100%</th>
                    <th>OPD</th>
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
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(function(){
    $('#terverifikasi-menu').addClass('active');
  });
</script>
@endsection