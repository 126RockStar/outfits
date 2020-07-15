<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topbar-right-menu float-right mb-0">

        <!-- <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-translate noti-icon"></i>
                 <span class="noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right ">
                <a class="dropdown-item" href="lang/en" id="en">English </a>
            </div>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">

                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-right">
                             <a href="javascript: void(0);" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Language
                    </h5>
                </div>

                <div class="slimscroll" style="max-height: 230px;">

                    <a href="" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">English
                        </p>
                    </a>
                    <a href="" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">বাংলা
                        </p>
                    </a>


                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                    Change Phrases
                </a>

            </div>
        </li> -->

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="{{asset('public/storage/avatar.jpg')}} " alt="user-image" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">{{Auth::user()->username}}</span>
                    <span class="account-position">{{Auth::user()->type}}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle"></i>
                    <span>Edit Profile</span>
                </a>


                <!-- item-->
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout"></i>
                    <span>{{ __('Logout') }}</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left disable-btn">
        <i class="mdi mdi-menu"></i>
    </button>
    <!-- <div class="app-search">
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="mdi mdi-magnify"></span>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div> -->
    <div class="page-title-box">
      <div class="page-title-right">
          <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Admin')}}</a></li>
              @yield('breadcrumb')
          </ol>
      </div>
        <h4 class="page-title">@yield('title')</h4>
    </div>
</div>
<!-- end Topbar -->

<div class="contatiner">
  <div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show mt-1" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Success - </strong> {{session('success')}}!
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show mt-1" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Error - </strong> {{session('error')}}!
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
    </div>
  </div>
</div>
