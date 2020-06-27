<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | Outfits</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="public/admin/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('public/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet" type="text/css" />

        @yield('extra-css')
    </head>

    <body>

        <!-- Begin page -->
        <div class="wrapper">
            @include('admin/inc/sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    @include('admin/inc/header')
                    @yield('contents')

                </div>
                <!-- content -->

                @include('admin/inc/footer')

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        @include('admin/inc/right-sidebar')
        <!-- bundle -->
        <script src="{{ asset('public/admin/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Scripts -->
        <script src="{{ asset('public/admin/js/app.min.js') }}"></script>

        @yield('extra-scripts')
    </body>

</html>
