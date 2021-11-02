<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | {{ __('admin.reset-password') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
    <div class="login-box" style="margin: auto">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <a href="index2.html" class="h1"><b>Admin</b>LTE</a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">{{ __('admin.reset-password') }}</p>
            {{-- @if ($errors->all())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <b>{{$error}}</b><br>
                    @endforeach
                </div>
            @endif --}}

            <form method="post">
              @csrf
              <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{$data->email}}" readonly>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="input-group mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @error('password_confirmation')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="row">
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Reset</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <p class="mb-1">
              <a href="{{ admin_url('login') }}">Sign in</a>
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
