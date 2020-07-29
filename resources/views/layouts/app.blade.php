<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Stylesheet -->
  <link href="{{asset('public/frontEnd')}}/css/preloader.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/css/bootstrap.min.css?v=1b04">
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/css/all.min.css">
  <!-- Custom Stylesheet after this line -->

     <style>
        .select2-results__option[aria-selected] {color:black}
        .select2-container--classic .select2-results__group {color:black}
        .cursor-pointer{cursor:pointer}
        a{text-decoration: none!important;}
     </style>
     @yield('styles')
@include('layouts.header')	 
</head>

<body>


 @yield('content')
    <!-- Scripts -->
    <script src="{{asset('public/frontEnd')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('public/frontEnd')}}/js/popper.min.js"></script>
    <script src="{{asset('public/frontEnd')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/vendors')}}/sweetalert2/sweetalert2.all.min.js"></script>


    {{-- <script>
        $(document).ready(function() {
            setTimeout(function(){
                $('#preloader').hide();
            }, 3000);
        });
    </script> --}}
    <script>
       
     
       

    </script>
    @yield('scripts')
</body>
</html>
