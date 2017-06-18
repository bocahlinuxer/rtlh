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
              <th>Jabatan</th>
              <th>Nama</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Kepala Dinas Perumahan Dan Kawasan Pemukiman</td>
              <td>I Made Suama, SH.</td>
            </tr>
            <tr>
              <td>Kepala Bidang Perumahan</td>
              <td>I Ketut Jaya Putra, ST.,MT.</td>
            </tr>
            <tr>
              <td>Kepala Seksi Perencanaan dan Pengawasan Perumahan</td>
              <td>Ni Kadek Noviyati, ST.</td>
            </tr>
            <tr>
              <td>Kepala Seksi  Peningkatan Kualitas Perumahan</td>
              <td>I Wayan Sada, SE.</td>
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