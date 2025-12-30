<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Tambahkan ini -->
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="asset-url" content="{{ asset('') }}">
    
    <!-- Script untuk set global variable -->
    <script>
        window.appBaseUrl = '{{ url("/") }}';
        window.assetUrl = '{{ asset("") }}';
        
        // Atau buat object global
        window.Laravel = {
            baseUrl: '{{ url("/") }}',
            assetUrl: '{{ asset("") }}',
            csrfToken: '{{ csrf_token() }}'
        };
    </script>
    
    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body data-sidebar="light" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <x-header />

        <!-- ========== Left Sidebar Start ========== -->
        <x-sidebar />
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                {{ $slot }}
            </div>
            <!-- End Page-content -->

            <x-footer />
        </div>
        <!-- end main content-->

        <!-- Right Sidebar -->
        <x-right-sidebar />
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

    @stack('scripts')
    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    @livewireScripts
</body>

</html>