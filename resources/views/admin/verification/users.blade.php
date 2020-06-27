@extends('admin.master')

@section('title')
  User Verification
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">{{__('User Verification')}}</li>
@endsection

@section('extra-css')
      <!-- third party css -->
      <link href="{{asset('public/admin/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('public/admin/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
      <!-- third party css end -->
@endsection

@section('contents')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                              <!-- <a href="javascript:void(0);" class="btn btn-info m-2" data-toggle="modal" data-target="#Instructor-add"><i class="mdi mdi-plus-circle mr-2"></i> {{__('Add Instructor')}}</a> -->
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <a href="{{route('admin.verify.user')}}" class="btn btn-warning mb-2 mr-1"><i class="mdi mdi-account-alert"></i></a>
                                    <a href="{{route('admin.verify.user','type=approved')}}" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-account-check"></i></a>
                                    <a href="{{route('admin.verify.user','type=rejected')}}" class="btn btn-danger mb-2"><i class=" mdi mdi-account-off"></i></a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="myTable">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Message</th>
                                        <th>Documents Type</th>
                                        <th>Attachements</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($verifyRequests as $verifyRequest)
                                    <tr>
                                        <td class="table-user">
                                            <a href="" target="_blank" class="text-body font-weight-semibold">
                                              <img src="{{asset('public/storage/'.$verifyRequest->getUser->profile_picture)}}" alt="table-user" class="mr-2 rounded-circle">
                                              {{$verifyRequest->getUser->name}} {{$verifyRequest->getUser->nick_name}}
                                            </a><br>
                                            <a href="" target="_blank" class="text-muted">{{count($verifyRequest->getAllRequests)-1}} old requests</a>
                                        </td>
                                        <td>{{$verifyRequest->message}}</td>
                                        <td class="text-capitalize">{{$verifyRequest->type}}</td>
                                        <td>
                                          @foreach(json_decode($verifyRequest->files) as $file)
                                            <a class="btn" target="_blank" href="{{asset('public/storage/'.$file)}}"><i class="mdi mdi-eye"></i>View</a>
                                            @endforeach
                                        </td>
                                        <td>{{$verifyRequest->status}}</td>
                                        <td>
                                          <a href="{{route('admin.verify.user.view',[$verifyRequest->id,$verifyRequest->user_id])}}"  class="btn btn-danger btn-sm">View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td collspan="5" class="text-danger">No verification request found</td></tr>
                                    @endforelse

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

@endsection
@section('extra-scripts')

   <!-- demo app -->
   <script src="{{asset('public/admin/js/pages/demo.customers.js')}}"></script>
   <!-- end demo js-->
   <script src="{{asset('public/admin/js/pages/demo.customers.js')}}"></script>
   <script>
     $(document).ready( function () {
       $('#myTable').DataTable();
     });
   </script>
@endsection
