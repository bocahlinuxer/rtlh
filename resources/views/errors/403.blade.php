@extends('template')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        403 Error Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">403 error</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-green"> 403</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Pengguna tidak memiliki akses.</h3>

          <p>
            Pengguna saat ini tidak memiliki akses untuk melihat halaman ini.
            <a href="{{url()->previous()}}">Kembali</a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection