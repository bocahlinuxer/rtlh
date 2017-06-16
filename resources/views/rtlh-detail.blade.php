@extends('template')
@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Rumah Tidak Layak Huni
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
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
                    <td><img src="{{asset('img/rtlh/'.$u-> file_fotortlh)}}" class="img-responsive" style="max-height: 300px"></td>
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

      @if($rtlh->penanganan_by != null)
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Program Penanganan
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <strong>OPD</strong>
                  <br>
                  &nbsp {{$rtlh->opd->opd}}
                  <br>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <strong>Foto 0%</strong>
                  <br>
                  <img src="{{asset('img/penanganan/'.$rtlh->foto0)}}" class="img-responsive" style="max-height: 400px">
                </div>
                <div class="col-md-6">
                  <strong>Foto 100%</strong>
                  <br>
                  <img src="{{asset('img/penanganan/'.$rtlh->foto100)}}" class="img-responsive" style="max-height: 400px">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      @endif
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