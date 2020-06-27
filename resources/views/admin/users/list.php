@extends('admin.master')

@section('title')
  Edit Settings
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">{{__('Settings')}}</li>
@endsection

@section('extra-css')
@endsection

@section('contents')
<!-- ============================================================== -->
          <!-- Start Page Content here -->
          <!-- ============================================================== -->

          <div class="content-page">
              <div class="content">

                  <!-- Topbar Start -->
                  <div class="navbar-custom">
                      <ul class="list-unstyled topbar-right-menu float-right mb-0">

                          <li class="dropdown notification-list topbar-dropdown">
                              <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                  <img src="assets/images/flags/us.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">English</span> <i class="mdi mdi-chevron-down"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu">

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <img src="assets/images/flags/germany.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">German</span>
                                  </a>

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <img src="assets/images/flags/italy.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Italian</span>
                                  </a>

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <img src="assets/images/flags/spain.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Spanish</span>
                                  </a>

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <img src="assets/images/flags/russia.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Russian</span>
                                  </a>

                              </div>
                          </li>

                          <li class="dropdown notification-list">
                              <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                  <i class="dripicons-bell noti-icon"></i>
                                  <span class="noti-icon-badge"></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">

                                  <!-- item-->
                                  <div class="dropdown-item noti-title">
                                      <h5 class="m-0">
                                          <span class="float-right">
                                              <a href="javascript: void(0);" class="text-dark">
                                                  <small>Clear All</small>
                                              </a>
                                          </span>Notification
                                      </h5>
                                  </div>

                                  <div class="slimscroll" style="max-height: 230px;">
                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon bg-primary">
                                              <i class="mdi mdi-comment-account-outline"></i>
                                          </div>
                                          <p class="notify-details">Caleb Flakelar commented on Admin
                                              <small class="text-muted">1 min ago</small>
                                          </p>
                                      </a>

                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon bg-info">
                                              <i class="mdi mdi-account-plus"></i>
                                          </div>
                                          <p class="notify-details">New user registered.
                                              <small class="text-muted">5 hours ago</small>
                                          </p>
                                      </a>

                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon">
                                              <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                          <p class="notify-details">Cristina Pride</p>
                                          <p class="text-muted mb-0 user-msg">
                                              <small>Hi, How are you? What about our next meeting</small>
                                          </p>
                                      </a>

                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon bg-primary">
                                              <i class="mdi mdi-comment-account-outline"></i>
                                          </div>
                                          <p class="notify-details">Caleb Flakelar commented on Admin
                                              <small class="text-muted">4 days ago</small>
                                          </p>
                                      </a>

                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon">
                                              <img src="assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                          <p class="notify-details">Karen Robinson</p>
                                          <p class="text-muted mb-0 user-msg">
                                              <small>Wow ! this admin looks good and awesome design</small>
                                          </p>
                                      </a>

                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon bg-info">
                                              <i class="mdi mdi-heart"></i>
                                          </div>
                                          <p class="notify-details">Carlos Crouch liked
                                              <b>Admin</b>
                                              <small class="text-muted">13 days ago</small>
                                          </p>
                                      </a>
                                  </div>

                                  <!-- All-->
                                  <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                      View All
                                  </a>

                              </div>
                          </li>

                          <li class="dropdown notification-list">
                              <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                  aria-expanded="false">
                                  <span class="account-user-avatar">
                                      <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                                  </span>
                                  <span>
                                      <span class="account-user-name">Dominic Keller</span>
                                      <span class="account-position">Founder</span>
                                  </span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                  <!-- item-->
                                  <div class=" dropdown-header noti-title">
                                      <h6 class="text-overflow m-0">Welcome !</h6>
                                  </div>

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <i class="mdi mdi-account-circle mr-1"></i>
                                      <span>My Account</span>
                                  </a>

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <i class="mdi mdi-account-edit mr-1"></i>
                                      <span>Settings</span>
                                  </a>

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <i class="mdi mdi-lifebuoy mr-1"></i>
                                      <span>Support</span>
                                  </a>

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <i class="mdi mdi-lock-outline mr-1"></i>
                                      <span>Lock Screen</span>
                                  </a>

                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <i class="mdi mdi-logout mr-1"></i>
                                      <span>Logout</span>
                                  </a>

                              </div>
                          </li>

                      </ul>
                      <button class="button-menu-mobile open-left disable-btn">
                          <i class="mdi mdi-menu"></i>
                      </button>
                      <div class="app-search">
                          <form>
                              <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Search...">
                                  <span class="mdi mdi-magnify"></span>
                                  <div class="input-group-append">
                                      <button class="btn btn-primary" type="submit">Search</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                  <!-- end Topbar -->

                  <!-- Start Content-->
                  <div class="container-fluid">

                      <!-- start page title -->
                      <div class="row">
                          <div class="col-12">
                              <div class="page-title-box">
                                  <div class="page-title-right">
                                      <ol class="breadcrumb m-0">
                                          <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                          <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                                          <li class="breadcrumb-item active">Customers</li>
                                      </ol>
                                  </div>
                                  <h4 class="page-title">Customers</h4>
                              </div>
                          </div>
                      </div>
                      <!-- end page title -->

                      <div class="row">
                          <div class="col-12">
                              <div class="card">
                                  <div class="card-body">
                                      <div class="row mb-2">
                                          <div class="col-sm-4">
                                              <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Customers</a>
                                          </div>
                                          <div class="col-sm-8">
                                              <div class="text-sm-right">
                                                  <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                                  <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                                  <button type="button" class="btn btn-light mb-2">Export</button>
                                              </div>
                                          </div><!-- end col-->
                                      </div>

                                      <div class="table-responsive">
                                          <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                              <thead>
                                                  <tr>
                                                      <th style="width: 20px;">
                                                          <div class="custom-control custom-checkbox">
                                                              <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                              <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                                          </div>
                                                      </th>
                                                      <th>Customer</th>
                                                      <th>Phone</th>
                                                      <th>Email</th>
                                                      <th>Location</th>
                                                      <th>Create Date</th>
                                                      <th>Status</th>
                                                      <th style="width: 75px;">Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>
                                                          <div class="custom-control custom-checkbox">
                                                              <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                              <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                                          </div>
                                                      </td>
                                                      <td class="table-user">
                                                          <img src="assets/images/users/avatar-4.jpg" alt="table-user" class="mr-2 rounded-circle">
                                                          <a href="javascript:void(0);" class="text-body font-weight-semibold">Paul J. Friend</a>
                                                      </td>
                                                      <td>
                                                          937-330-1634
                                                      </td>
                                                      <td>
                                                          pauljfrnd@jourrapide.com
                                                      </td>
                                                      <td>
                                                          New York
                                                      </td>
                                                      <td>
                                                          07/07/2018
                                                      </td>
                                                      <td>
                                                          <span class="badge badge-success-lighten">Active</span>
                                                      </td>

                                                      <td>
                                                          <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                          <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                      </td>
                                                  </tr>
                                                
                                              </tbody>
                                          </table>
                                      </div>
                                  </div> <!-- end card-body-->
                              </div> <!-- end card-->
                          </div> <!-- end col -->
                      </div>
                      <!-- end row -->

                  </div> <!-- container -->

              </div> <!-- content -->

              <!-- Footer Start -->
              <footer class="footer">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-6">
                              2018 - 2019 © Hyper - Coderthemes.com
                          </div>
                          <div class="col-md-6">
                              <div class="text-md-right footer-links d-none d-md-block">
                                  <a href="javascript: void(0);">About</a>
                                  <a href="javascript: void(0);">Support</a>
                                  <a href="javascript: void(0);">Contact Us</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </footer>
              <!-- end Footer -->

          </div>

          <!-- ============================================================== -->
          <!-- End Page content -->
          <!-- ============================================================== -->


@endsection
@section('extra-scripts')

</script>
@endsection
