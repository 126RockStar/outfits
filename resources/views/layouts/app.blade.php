<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Stylesheet -->
  <link href="{{asset('public/frontEnd')}}/css/preloader.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/css/bootstrap.min.css?v=1a04">
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/css/all.min.css">
  <!-- Custom Stylesheet after this line -->

     <style>
        .select2-results__option[aria-selected] {color:black}
        .select2-container--classic .select2-results__group {color:black}
        .cursor-pointer{cursor:pointer}
        a{text-decoration: none!important;}
     </style>
     @yield('styles')
</head>
<body>
    <div id="app" class="bg-dark">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" style="padding: .1rem" href="{{ route('contests') }}">Contests</a>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-info btn-sm mr-1" style="padding: .1rem" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-info btn-sm" style="padding: .1rem" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        Dashboard
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container text-white">
                @if(session('success'))
                    <div class="alert bg-success alert-icon-left alert-dismissible mb-2 mt-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>{{__('Well done')}}!</strong> {{__(session('success'))}}
                    </div>
                @endif 
                @if(session('error'))
                    <div class="alert bg-danger alert-icon-left alert-dismissible mb-2 mt-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>{{__('Oh snap')}}!</strong>{{__(session('error'))}}
                    </div>
                @endif

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert bg-danger alert-icon-left alert-dismissible mb-2 mt-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>{{__('Oh snap')}}!</strong>{{__($error)}}
                        </div>
                    @endforeach
                @endif
            </div>

            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{asset('public/frontEnd')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('public/frontEnd')}}/js/popper.min.js"></script>
    <script src="{{asset('public/frontEnd')}}/js/bootstrap.min.js"></script>


    {{-- <script>
        $(document).ready(function() {
            setTimeout(function(){
                $('#preloader').hide();
            }, 3000);
        });
    </script> --}}
    <script>
       
     
       

        $(document).ready(function() {
            $('.select2').select2({width: 'resolve',theme: "classic"});
        });
    </script>
    @yield('scripts')
</body>
</html>
