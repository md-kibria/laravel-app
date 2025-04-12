<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-body-image="none">

<head>
    <meta charset="utf-8">
    <title>@yield('title') | {{ config('site_title') }} Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="eCommerce + Admin HTML Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('favicon') }}">

    <!-- head css -->
    @include('layouts.admin.head-css')
    <script src="/tinymce/tinymce.min.js"></script>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- top tagbar -->
        @include('layouts.admin.top-tagbar')
        <!-- topbar -->
        @include('layouts.admin.topbar')
        @include('layouts.admin.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!-- footer -->
            @include('layouts.admin.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <x-flash-message />

    <!-- customizer -->
    @include('layouts.admin.customizer')
    <!-- scripts -->
    @include('layouts.admin.vendor-scripts')

</body>

</html>
