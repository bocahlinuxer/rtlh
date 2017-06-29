<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi RTLH</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/assets/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('/assets/plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Sistem</b> RTLH</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login untuk masuk.</p>

    <form id="form" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
        <input id="username" type="text" class="form-control" placeholder="username" name="username" value="{{ old('username') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" name="password" placeholder="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="btnchechintegrity" onclick="integrity()" type="button" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Fakta Integritas</h4>
      </div>
      <div class="modal-body">
        <p id="modalBody"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak Setuju</button>
        <button id="btnintegritas" onclick="meong()" type="button" class="btn btn-primary">Setuju</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('/assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('/assets/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  function integrity(evt)
  {
    $.post( "{{url('/ajax/faktaintegritas')}}", { 
      u: $('#username').val(), 
      p: $('#password').val(),
      _token: "{{ csrf_token() }}" 
    })
    .done(function( data ) {
      var user = JSON.parse(data);
      if(user.tipe == 2)
      {
        $('#modalBody').html("");
        //$('#modalBody').html("dengan ini, apakah <b>"+user.nama+"</b> sebagai perbekel desa <b>"+user.desa+"</b> menyetujui untuk mengisi data RTLH di desa <b>"+user.desa+"</b>?");
        $('#modalBody').html("Saya yang memiliki akun, dengan ini menyatakan bahwa saya : <br><br> 1. Tidak akan melakukan praktek KKN;<br> 2. Akan melaporkan kepada pihak yang berwajib/berwenang apabila mengetahui ada indikasi KKN di dalam proses pendataan dan program penanganan RTLH ini;<br> 3. Dalam proses pendataan akan memberikan data yang sebenarnya dan memang membutuhkan bantuan sesuai ketentuan/ dalam proses verifikasi akan melakukan verifikasi sesuai dengan ketentuan dan kenyataan di lapangan;<br> 4. Apabila saya melanggar hal-hal yang telah saya nyatakan dalam FAKTA INTEGRITAS ini, saya bersedia dikenakan  sanksi moral, sanksi administrasi, serta dituntut ganti rugi dan pidana sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.");
        $('#myModal').modal('show');
      }
      else
      {
        meong();
      }
    });
  }

  

  function meong()
  {
    $('#form').submit();
  }
</script>
</body>
</html>
