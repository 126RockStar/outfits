<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!-- LOGO -->
        <a href="{{url('/')}}" class="logo text-center">
            <span class="logo-lg">
                <img src="{{ asset('public/admin/image/logo.png')}}" alt="" height="32">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('public/admin/image/logo.png')}}" alt="" height="16">
            </span>
        </a>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-item {{Request::is('/admin')? 'active' : ''}}">
                <a href="{{route('admin.dashboard')}}" class="side-nav-link">
                    <i class="dripicons-meter"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item {{Request::is('/admin/categories')? 'active' : ''}}">
                <a href="{{route('admin.categories.index')}}" class="side-nav-link">
                    <i class="fa fa-list mr-2"></i>
                    <span>&nbsp;Categories </span>
                </a>
            </li>
            <li class="side-nav-item {{Request::is('/admin/users*')? 'active' : ''}}">
                <a href="{{route('admin.users.index')}}" class="side-nav-link">
                    <i class="mdi mdi-account-multiple"></i>
                    <span> Users </span>
                </a>
            </li>

            <!-- <li class="side-nav-item">
                <a href="{{route('admin.dashboard')}}" class="side-nav-link">
                    <i class="dripicons-message"></i>
                    <span class="badge badge-success float-right">7</span>
                    <span> Messages </span>
                </a>
            </li> -->
{{-- 
            <li class="side-nav-item {{Request::is('/verification*')? 'active' : ''}}">
              <a href="javascript: void(0);" class="side-nav-link">
                  <i class="mdi mdi-account-multiple"></i>
                  <span> {{ __('Users')}} </span>
                  <span class="menu-arrow"></span>
              </a>
              <ul class="side-nav-second-level" aria-expanded="false">
                  <li><a href="{{route('admin.users.list','admin')}}">{{ __('Admins') }}</a></li>
                  <li><a href="{{route('admin.users.list','individual')}}">{{ __('Individuals Persons') }}</a></li>
                  <li><a href="{{route('admin.users.list','social')}}">{{ __('Socials Organization') }}</a></li>
                  <li><a href="{{route('admin.users.list','business')}}">{{ __('Businesses Organization') }}</a></li>
              </ul>
          </li> --}}


        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
