<!doctype html>
<html lang="{{ lang() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('storage/'.website_setting()->icon) }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{  website_setting()->sitename }}</title>

    <!-- Scripts -->
    <script src="{{ url('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">


	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/css/flexslider.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/css/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/css/color-01.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/dark-mode.css') }}" />
    @if (lang() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style-rtl.min.css') }}" />
    @endif

</head>
<body class="home-page home-01 {{lang() == 'ar' ? 'rtl' : ''}}">
    <div id="app">

        <!-- mobile menu -->
        <div class="mercado-clone-wrap">
            <div class="mercado-panels-actions-wrap">
                <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
            </div>
            <div class="mercado-panels"></div>
        </div>
