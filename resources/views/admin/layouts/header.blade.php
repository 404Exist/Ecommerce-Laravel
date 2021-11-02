<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ url('storage/' . website_setting()->icon) }}">
  <title>@yield('title') | {{ website_setting()->sitename }} - Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="{{ url('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/jqvmap/jqvmap.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('assets/adminlte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- rtl style -->
  @if (lang() == 'ar')
    <link rel="stylesheet" href="{{ url('assets/adminlte/dist/css/rtl/bootstrap-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/adminlte/dist/css/rtl/custom.css') }}">
  @endif
  @stack('css')
  <!-- Dark Mode-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/dark-mode.css') }}" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ url('assets/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
        height="60" width="60">
    </div>
