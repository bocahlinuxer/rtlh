@extends('template')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Kontak
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Kontak</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> BADAN PERENCANAAN, PENELITIAN DAN PENGEMBANGAN DAERAH KABUPATEN KARANGASEM
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <b>Kantor</b>
          <address>
            Alamat: Jalan Diponogoro No 52 Amlapura<br>
            Telp/Fax: (0363) 21013
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th style="width: 40%">Jabatan</th>
              <th style="width: 40%">Nama</th>
              <th style="width: 20%">Kontak</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Kepala Badan Perencanaan, Penelitian dan Pengembangan Daerah Kabupaten Karangasem</td>
              <td>Drs. I Made Sujana Erawan</td>
              <td>+6281236768686</td>
            </tr>
            <tr>
              <td>Sekretaris Badan Perencanaan, Penelitian dan Pengembangan Daerah Kabupaten Karangasem</td>
              <td>I Nyoman Siki Ngurah, ST., MT</td>
              <td>+6282144379036</td>
            </tr>
            <tr>
              <td>Kabid Infrastruktur dan Pengembangan Wilayah (IPW)</td>
              <td>I Gusti Bagus Budiadnyana, ST., MT.</td>
              <td>+6281338661578</td>
            </tr>
            <tr>
              <td>Kasubid IPW Urusan Perumahan dan Kawasan Permukiman dan Pemadam Kebakaran</td>
              <td>I Made Agus Budi Payana, ST.,M.Si</td>
              <td>+6287861041904</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> DINAS PERUMAHAN DAN KAWASAN PERMUKIMAN KABUPATEN KARANGASEM
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <b>Kantor</b>
          <address>
            Alamat: Jln. Ngurah Rai No 21 Amlapura<br>
            Telp/Fax: (0363) 21146/22035
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th style="width: 40%">Jabatan</th>
              <th style="width: 40%">Nama</th>
              <th style="width: 20%">Kontak</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Kepala Dinas Perumahan Dan Kawasan Pemukiman</td>
              <td>I Made Suama, SH.</td>
              <td>+6282174590272</td>
            </tr>
            <tr>
              <td>Kepala Bidang Perumahan</td>
              <td>I Ketut Jaya Putra, ST.,MT.</td>
              <td>+6281246923355</td>
            </tr>
            <tr>
              <td>Kepala Seksi Perencanaan dan Pengawasan Perumahan</td>
              <td>Ni Kadek Noviyati, ST.</td>
              <td>+6282147499619</td>
            </tr>
            <tr>
              <td>Kepala Seksi  Peningkatan Kualitas Perumahan</td>
              <td>I Wayan Sada, SE.</td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

<script>
  $(function () {
    $('#kontak-menu').addClass('active');
  });
</script>
@endsection