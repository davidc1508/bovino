<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SGBL | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/css/blue.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        
      </div><!-- /.login-logo -->
      <div class="login-box-body">
          <div class="row">
              <div class="col-lg-12 text-center">
                  <img src="/img/logo.png" alt="logo" width="215">
              </div>
          </div>
          
              <hr/>
            <p class="login-box-msg">Identifique-se para acessar o sistema</p>
            @if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> Algo está incorreto.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
            <form action="{{ url('/auth/login') }}" method="post">
            	{!! csrf_field() !!}
              	<div class="form-group has-feedback">
	                <input type="email" class="form-control" name="usr_email" value="{{ old('usr_email') }}">
                	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              	</div>
              	<div class="form-group has-feedback">
	                <input type="password" class="form-control" name="password">
                	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
              	</div>
              	<div class="row">
	            	<div class="col-xs-8">
                  		<div class="checkbox icheck">
                		</div>
                	</div><!-- /.col -->
	                <div class="col-xs-4">
                  		<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                	</div><!-- /.col -->
              	</div>
            </form>
      	</div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="/js/jquery-2.2.0.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="/js/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>