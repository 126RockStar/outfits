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
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/css/all.min.css">
  <!-- Custom Stylesheet after this line -->

     <!-- SmartMenus core CSS (required) -->
     <link href="{{asset('public/frontEnd')}}/css/sm-core-css.css" rel="stylesheet" type="text/css" />
     <link href="{{asset('public/frontEnd')}}/css/sm-clean/sm-clean.css" rel="stylesheet" type="text/css" />
     
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @php
                        $categories=App\Category::with('getSubCategories')->get();
                    @endphp
                    <ul class="navbar-nav mr-auto sm sm-clean"  id="categoryMenu">
                        
                        <li><a href="#">Categories</a>
                            <ul>
                                @forelse($categories as $key=>$category)
                                    <li>
                                        <a class="" href="{{route('index','category='.$category->id)}}" >{{$category->name}}</a>
                                        @if(count($category->getSubCategories)>0)
                                            <ul>
                                                @forelse($category->getSubCategories as $subCategory)
                                                    <li class="">
                                                        <a class="" href="{{route('index','category='.$category->id.'&subCategory='.$subCategory->id)}}">{{$subCategory->name}}</a>
                                                    </li>
                                                @empty
                                                    <li class="text-danger"> {{__('No sub-category found')}}</li>
                                                @endforelse
                                            </ul>
                                        @endif
                                    </li>
                                @empty 
                                    {{-- <li class="text-danger">{{__('No categories found.')}}</li> --}}
                                @endforelse
                            </ul>
                        </li>
                    </ul>

                   

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">


{{-- 
                        @forelse($categories as $key=>$category)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$category->name}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">All</a>
                                <div class="dropdown-divider"></div>
                                @forelse($category->getSubCategories as $subCategory)
                                    <a class="dropdown-item" href="#">{{$subCategory->name}}</a>
                                @empty
                                    <li class="text-danger"> {{__('No sub-category found')}}</li>
                                @endforelse
                                </div>
                            </li>
                        @empty 
                            <li class="text-danger">{{__('No categories found.')}}</li>
                        @endforelse --}}
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn btn-info mr-1" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-success" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

 <!-- SmartMenus core CSS (required) -->
    <script src="{{asset('public/frontEnd')}}/js/jquery.smartmenus.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            setTimeout(function(){
                $('#preloader').hide();
            }, 3000);
        });
    </script> --}}
    <script>
       
        $('#categoryMenu').smartmenus({
            subMenusSubOffsetX: 1,
            subMenusSubOffsetY: -8
        });
    </script>
</body>
</html>
