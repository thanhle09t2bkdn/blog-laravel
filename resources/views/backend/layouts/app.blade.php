@php
$v = time();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Administrator | Blog Laravel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ $v }}">

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('backend.layouts.header')

    @include('backend.layouts.left-bar')

    <div class="content-wrapper">
        @yield('content')
    </div>
    @include('backend.layouts.footer')
</div>

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Select 2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<!-- Laravel File Manager -->
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

<!-- Script for element -->
<script src="{{ asset('js/script.js') }}?v={{ $v }}"></script>
<script src="{{ asset('js/common.js') }}?v={{ $v }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>
