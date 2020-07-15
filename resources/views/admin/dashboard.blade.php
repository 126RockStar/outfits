@extends('admin.master')

@section('title')
  Dashboard
@endsection

@section('extra-css')
    <link href="{{ asset('public/admin/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/css/vendor/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('contents')
<!-- Start Content-->
<div class="container-fluid">
        <div class="row pt-3">

            
          <div class="col-md-3 ">
            <div class="card bg-warning widget-flat">
                <div class="card-body">
                    <div class="float-right">
                        <i class="mdi mdi-message-reply-text icon-lg"></i>
                    </div>
                    <h5 class="text-white font-weight-normal mt-0" title="Number of Customers">New Messages</h5>
                    <h3 class="mt-3 mb-3">{{$messages}}</h3>
                    <a href="{{route('admin.messages')}}" class="btn btn-light btn-sm text white">View Details</a>
                    <!-- <p class="mb-0 text-muted">
                        <span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p> -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        
            <div class="col-md-3 ">
              <div class="card bg-success widget-flat">
                  <div class="card-body">
                      <div class="float-right">
                          <i class="mdi mdi-account-multiple icon-lg"></i>
                      </div>
                      <h5 class="text-white font-weight-normal mt-0" title="Number of Customers">Users</h5>
                      <h3 class="mt-3 mb-3">{{$users}}</h3>
                      <a href="{{route('admin.users.index')}}" class="btn btn-light btn-sm text white">View Details</a>
                      <!-- <p class="mb-0 text-muted">
                          <span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                          <span class="text-nowrap">Since last month</span>
                      </p> -->
                  </div> <!-- end card-body-->
              </div> <!-- end card-->
          </div> <!-- end col-->

          <div class="col-md-3 ">
            <div class="card bg-info widget-flat">
                <div class="card-body">
                    <div class="float-right">
                        <i class="mdi mdi-account-multiple icon-lg"></i>
                    </div>
                    <h5 class="text-white font-weight-normal mt-0" title="Number of Customers">Contests</h5>
                    <h3 class="mt-3 mb-3">{{$contests}}</h3>
                    <a href="{{route('admin.contests')}}" class="btn btn-light btn-sm text white">View Details</a>
                    <!-- <p class="mb-0 text-muted">
                        <span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p> -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->


   
        </div>
        <!-- end row -->



</div>
<!-- container -->

@endsection

@section('extra-scripts')

  <!-- third party js -->
  <script src="{{ asset('public/admin/js/vendor/Chart.bundle.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ asset('public/admin/js/vendor/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/vendor/fullcalendar.min.js') }}"></script>
  <!-- third party js ends -->



  <!-- demo app -->
  <script src="{{ asset('public/admin/js/pages/demo.dashboard.js') }}"></script>
  <!-- <script src="{{ asset('public/admin/js/pages/demo.calendar.js') }}"></script> -->

@endsection
