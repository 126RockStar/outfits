@extends('admin.master')

@section('title')
  Background Images
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">{{__('Posts')}}</li>
  <li class="breadcrumb-item active">{{__('Background Images')}}</li>
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
                              <form action="{{route('admin.posts.bgimages.store')}}" id="postbgFrom" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="bgimage" class="btn btn-info m-2"><i class="mdi mdi-plus-circle mr-2"></i> {{__('Add Background Images')}}</label>
                                <input type="file" id="bgimage" class="d-none" name="image[]" onchange="this.form.submit()" multiple>
                              </form>
                            </div>
                            <div class="col-sm-8">
                                <!-- <div class="text-sm-right">
                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                    <button type="button" class="btn btn-light mb-2 mr-1">Edit Roles</button>
                                    <button type="button" class="btn btn-light mb-2">Edit Permissions</button>
                                </div> -->
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($bgImages as $background)
                                    <tr>
                                        <td><img src="{{asset('public/storage/'.$background->image)}}" alt="Background-Image" class="mr-2" height="60px">
                                        </td>
                                        <td class="table-user">
                                            @if($background->user_id !='')
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">
                                            <img src="{{asset('public/storage/'.$background->getUser->profile_picture)}}" alt="table-user" class="mr-2 rounded-circle">
                                            {{$background->getUser->name}} {{$background->getUser->nick_name}}</a>
                                            @endif
                                        </td>
                                        <td>
                                          @if($background->deleted_at != '')
                                            <span class="badge badge-danger-lighten">InActive</span>
                                          @else
                                            <span class="badge badge-success-lighten">Active</span>

                                          @endif
                                        </td>

                                        <td>
                                            <!-- <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a> -->
                                            @if($background->deleted_at == '')
                                              <a href="{{route('admin.posts.bgimages.deactivate',$background->id)}}" onclick="return confirm('Are you sure to DeActive the background image?')" class="btn btn-warning btn-sm"> <i class="mdi mdi-block-helper"></i></a>
                                            @else
                                              <a href="{{route('admin.posts.bgimages.activate',$background->id)}}" class="btn btn-success btn-sm"> <i class="mdi mdi-restore"></i></a>
                                            @endif
                                            <a href="{{route('admin.posts.bgimages.delete',$background->id)}}" onclick="return confirm('Are you sure to delete the background image?')" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>

                                        </td>

                                    </tr>
                                    @empty
                                    <tr><td collspan="5" class="text-danger">No Background Images Found</td></tr>
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
   <script src="{{asset('public/admin/js/jquery.dataTables.min.js')}}"></script>
   <!-- end demo js-->
   <script>
     $(document).ready( function () {
       $('#myTable').DataTable();
     });
   </script>
@endsection
