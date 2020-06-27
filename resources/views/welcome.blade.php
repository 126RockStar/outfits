<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('public/js/app.js') }}" defer></script>
    
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

        <title>OutfitsZone</title>


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        <style>

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }
            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
				color: #3850c7;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

 <!-- Begin page -->

        <div class="wrapper-page">
          <div class="flex-center position-ref ">
            <div class="content">
                @if(session('success'))
                    <div class="alert bg-success alert-icon-left alert-dismissible mb-2 mt-2 text-white" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong class="text-white">{{__('Well done')}}!</strong> {{__(session('success'))}}
                    </div>
                @endif 
                @if(session('error'))
                    <div class="alert bg-danger alert-icon-left alert-dismissible mb-2 mt-2 text-white" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong class="text-white">{{__('Oh snap')}}!</strong>{{__(session('error'))}}
                    </div>
                @endif

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert bg-danger alert-icon-left alert-dismissible mb-2 mt-2 text-white" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong class="text-white">{{__('Oh snap')}}!</strong>{{__($error)}}
                        </div>
                    @endforeach
                @endif
                <div class="title m-b-md">
                    OutfitsZone			
                </div>
				<p>This is the landing page. (home page)  We will have some stats,some highlights,some announcements etc<br>Just need to figure out the layout</p>
            </div>
        </div>
             
        </div>
        </div>
    </body>
</html>
