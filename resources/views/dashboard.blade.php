@extends('template')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Beranda
        <small>Rumah Tidak Layak Huni</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$rtlh}}</h3>

              <p>RTLH</p>
            </div>
            <div class="icon">
              <i class="fa fa-home"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{$penanganan}}</h3>

              <p>Penanganan</p>
            </div>
            <div class="icon">
              <i class="fa fa-wrench"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Foto RTLH
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel1" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php $count = 0?>
                  @foreach($slideshow as $s)
                    @if($count == 0)
                    <li data-target="#carousel1" data-slide-to="{{$count}}" class="active"></li>
                    @else
                    <li data-target="#carousel1" data-slide-to="{{$count}}"></li>
                    @endif
                  <?php $count++?>
                  @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                <?php $count = 0?>
                  @foreach($slideshow as $s)
                    @if($count == 0)
                    <div class="item active" style="max-height: 300px">
                      <img src="{{asset('img/rtlh/'.$s->file_fotortlh)}}" style="object-fit: cover;">
                    </div>
                    @else
                    <div class="item" style="max-height: 300px">
                      <img src="{{asset('img/rtlh/'.$s->file_fotortlh)}}" style="object-fit: cover;">
                    </div>
                    @endif
                  <?php $count++?>
                  @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>  
            </div>
          </div>
        </div>
        {{-- row --}}
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Foto Penanganan
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel2" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php $count = 0?>
                  @foreach($slideshow2 as $s)
                    @if($count == 0)
                    <li data-target="#carousel2" data-slide-to="{{$count}}" class="active"></li>
                    @else
                    <li data-target="#carousel2" data-slide-to="{{$count}}"></li>
                    @endif
                  <?php $count++?>
                  @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                <?php $count = 0?>
                  @foreach($slideshow2 as $s)
                    @if($count == 0)
                    <div class="item active" style="max-height: 300px">
                      <img src="{{asset('img/penanganan/'.$s->foto100)}}" style="object-fit: cover;">
                    </div>
                    @else
                    <div class="item" style="max-height: 300px">
                      <img src="{{asset('img/penanganan/'.$s->foto100)}}" style="object-fit: cover;">
                    </div>
                    @endif
                  <?php $count++?>
                  @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel2" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel2" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>  
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    $(function () {
      //active tree and menu
      $('#dashboard-menu').addClass('active');
    });
  </script>
@endsection