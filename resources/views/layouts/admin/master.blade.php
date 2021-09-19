<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | @yield('title', 'Pagina')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/favicons/apple-touch-icon_2.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('img/favicons/favicon-32x32_2.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('img/favicons/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <link rel="manifest" href="{{ asset('img/favicons/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('img/favicons/safari-pinned-tab.svg') }}" color="#563d7c">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/v4-shims.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adminlte/ionicons.min.css') }}">
    <!-- pace-progress -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/pace-progress/themes/white/pace-theme-flash.css') }}">
    <!-- adminlte-->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <!-- Google Font: Source Sans Pro -->
    {{--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
    <link href="{{ asset('adminlte/fonts.googleapis.css') }}" rel="stylesheet">

    <script src="{{ asset('js/master.js') }}"></script>

    @yield('link')
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-navbar-fixed layout-fixed pace-primary">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
        @include('layouts.admin.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar {{--sidebar-dark-primary--}} sidebar-dark-lightblue bg-navy elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            {{--<img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}"--}}
            <img src="{{ asset('img/favicons/apple-touch-icon_2.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <!-- Sidebar -->
            @include('layouts.admin.sidebar')
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('header', 'Page')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                            {{--<li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pace</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include('sweetalert::alert')
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        @include('layouts.admin.footer')
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        @include('layouts.admin.control-sidebar')
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- pace-progress -->
<script src="{{ asset('adminlte/plugins/pace-progress/pace.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>--}}
<!-- Bootbox -->
<script src="{{ asset('plugins/bootbox/bootbox.all.min.js') }}"></script>
<!-- Sweetalert2-->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    /*$(document).ready(function () {
        $('div.alert').not('alert-important').delay(3000).fadeOut(350);
        /!*$('#flash-overlay-modal').modal();*!/
    })*/

</script>

@yield('script')
@livewireScripts
<x-livewire-alert::scripts />
</body>
</html>
