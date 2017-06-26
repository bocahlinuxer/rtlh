@extends('admin.verifikasi.template')
@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Usulan Rumah Tidak Layak Huni 
        @if($rtlh->status == 1)
        <a type="button" class="btn btn-primary pull-right" href="{{url('adminverifikasi/verifikasi/'.$rtlh->id_rtlh.'/crosscheck')}}"><i class="fa fa-check"> Verifikasi</i></a>
        @endif
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

              <br>
              <strong>Jenis Penanganan</strong>
              <br>
              &nbsp {{$rtlh->jenis_penanganan or 'Tidak Ada'}}
              <br>

              <br>
              <strong>Sumber Data</strong>
              <br>
              &nbsp {{$rtlh->sumber_data or 'Tidak Ada'}}
              <br>

              <br>
              <strong>Status</strong>
              <br>
              @if($rtlh->status == 1)
              &nbsp Usulan
              @elseif($rtlh->status == 2)
              &nbsp Verifikasi
              @elseif($rtlh->status == 3)
              &nbsp Program
              @elseif($rtlh->status == 4)
              &nbsp Publish
              @endif
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
              <a type="button" class="btn btn-primary pull-right" style="margin-top: -5px" href="{{url('adminverifikasi/verifikasi/'.$rtlh->id_rtlh.'/fotortlh/create')}}"><i class="fa fa-plus"> Tambah Foto</i></a>
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
                    <th style="width: 10%">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($rtlh->foto_rtlh as $u)
                  <tr>
                    <td>{{ $no }}</td>
                    <td><img src="{{asset('img/rtlh/'.$u-> file_fotortlh)}}" class="img-responsive" style="max-height: 300px"></td>
                    <td>{{ $u -> created_at or ''}}</td>
                    <td>{{ $u -> updated_at or ''}}</td>
                    <td align="center">
                      <div class="btn-group-vertical">
                        <a type="button" class="btn btn-default" href="{{url('adminverifikasi/verifikasi/'.$rtlh->id_rtlh.'/fotortlh/'.$u->id_fotortlh.'/edit')}}"><i class="fa fa-edit"> Ubah</i></a>
                        {!! Form::open(array('url' => 'adminverifikasi/verifikasi/'.$rtlh->id_rtlh.'/fotortlh/'.$u->id_fotortlh, 'method' => 'delete')) !!}
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
                    <th>Foto</th>
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
    $('#rtlh-menu').addClass('active');
  });
</script>
@endsection