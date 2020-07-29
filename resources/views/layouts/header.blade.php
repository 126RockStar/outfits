
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/templatetry/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/templatetry/css/animate.css">
  <link rel="stylesheet" href="{{asset('public/frontEnd')}}/templatetry/css/style.css?v=7d27a">

<style>
.nav-link {
    display: block;
    padding: .5rem 1rem;
    height: 30px;
    width: 70px;
}
.btn-outline-info:hover {
    color: #fff;
    background-color: #00ceb8;
    border-color: #00ceb8;
}
body {margin-top:80px}
</style>

	<!-- ****************************** Sidebar ************************** -->

	<nav id="sidebar-wrapper">
		<a id="menu-close" href="#" class="close-btn toggle"><i class="ion-ios-close-empty"></i></a>
	    <ul class="sidebar-nav">

			<li><a href="{{ route('contests') }}">Contests</a></li>
			<li><a href="{{route('contests.prizes')}}">Prizes</a></li>
			<li><a href="{{route('contests.quickview')}}">Quickview</a></li>
			<li><a href="{{route('games.wheel')}}">Games</a></li>
			<li><a href="{{route('faq')}}">FAQ</a></li>
			<li><a href="{{route('contact')}}">Contact us</a></li>
			<li><a href="{{route('terms')}}">Terms</a></li>
	    </ul>
	</nav>

	<!-- ****************************** Header ************************** -->
	<header class="sticky" id="header">
		<section class="container">
			<section class="row">
				<section class="col"><a id="menu-toggle" style="color:fff; border:1px solid #00ceb8" href="#" class="toggle wow rotateIn" data-wow-delay="1s"><i class="ion-navicon"></i></a></section>
				<section class="col row justify-content-center"><a class="logo" href="/">OutfitsZone</a></section> 
				<section class="col row mt-2" style="justify-content: flex-end;">
				@guest
                            
                                <a class="nav-link btn btn-outline-info btn-sm text-white" style="padding: .1rem;margin-right:15px;" href="{{ route('login') }}">{{ __('Login') }}</a>
                            
                            @if (Route::has('register'))
                               
                                    <a class="nav-link btn btn-outline-info btn-sm text-white" style="padding: .1rem" href="{{ route('register') }}">{{ __('Register') }}</a>
                               
                            @endif
                        @else
                            <li class="nav-item dropdown" style="list-style:none;color:#fff">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color:#fff" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        Edit Profile
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
				</section> 
			</section>
		</section>
    </header>
    
    
    <script src="{{asset('public/frontEnd')}}/templatetry/js/jquery-2.1.3.min.js"></script>
    <script src="{{asset('public/frontEnd')}}/templatetry/js/wow.min.js"></script>
    <script src="{{asset('public/frontEnd')}}/templatetry/js/script.js"></script>
    
    <script src="{{asset('public/vendors')}}/sweetalert2/sweetalert2.all.min.js"></script>

 @if(session('success'))
 <script>
    Swal.fire({
        position: 'bottom-end',
        icon: 'success',
        title: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 5500
    });
 </script>

@endif

@if(session('error'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 5500
    });


 </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '{{ $error }}',
            showConfirmButton: false,
            timer: 5500
        });
     </script>
    @endforeach
@endif