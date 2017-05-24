@extends('template')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Rumah Tidak Layak Huni <a type="button" class="btn btn-primary pull-right" href="{{url('rtlh/'.$rtlh->id_rtlh.'/edit')}}"><i class="fa fa-edit"> Ubah Data</i></a>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
  $(function(){
    $('#rtlh-menu').addClass('active');
  });
</script>
@endsection