@extends('admin.master')

@section('title')
  Users
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">{{__('Users')}}</li>
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
                    <form action="{{route('admin.users.selected')}}" method="POST" class="card-body">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <button type="button" onclick="checkUnBlock(this)" class="btn btn-success m-2 float-left" ><i class=" mdi mdi-account-multiple-plus mr-2"></i> UnBlock Selected</button>
                                <button type="button" onclick="checkBlock(this)" class="btn btn-warning m-2 float-left" ><i class=" mdi mdi-account-multiple-minus mr-2"></i> Block Selected</button>
                                <button type="submit" onclick="return confirm('Are you sure to delete the selected users?')" class="btn btn-danger m-2 float-left" ><i class="mdi mdi-delete-sweep  mr-2"></i> Delete Selected</button>
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
                                        <th><input type="checkbox" name="check_all" id="check_all"> <label for="check_all">All</label></th>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Joinded Contest</th>
                                        <th>Created Contest</th>
                                        <th>Regstered</th>
                                        <th>Status</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($users as $user)
                                    <tr>
                                        <td>@if($user->id !=1)<input type="checkbox" name="checked_user[]" value="{{$user->id}}">@endif</td>
                                        <td>{{$user->id}}</td>
                                        <td class="table-user">
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">
                                            {{-- <img src="{{asset('public/storage/'.$user->profile_picture)}}" alt="table-user" class="mr-2 rounded-circle"> --}}
                                            {{$user->username}}</a>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{count($user->getJoinedContests)}}</td>
                                        <td>{{count($user->getCreatedContests)}} of {{$user->max_contests}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>
                                          @if($user->deleted_at != '')
                                            <span class="badge badge-danger-lighten">Blocked</span>
                                          @else
                                            @if($user->id ==1)
                                              <span class="badge badge-primary">Admin</span>
                                            @else
                                              <span class="badge badge-success-lighten">Active</span>
                                            @endif
                                          @endif
                                        </td>

                                        <td>
                                            <!-- <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a> -->

                                            @if($user->id !=1)
                                                @if($user->deleted_at == '')
                                                    <a href="{{route('admin.users.block',$user->id)}}" onclick="return confirm('Are you sure to block the user?')" class="btn btn-warning btn-sm"> <i class="mdi mdi-block-helper"></i></a>
                                                
                                                @else
                                                    <a href="{{route('admin.users.unblock',$user->id)}}" class="btn btn-success btn-sm"> <i class="mdi mdi-restore"></i></a>
                                                @endif
                                                <a href="{{route('admin.users.delete',$user->id)}}" onclick="return confirm('Are you sure to delete the user?')" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>
                                                <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td collspan="5" class="text-danger">No Users Found</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

    </div> <!-- content -->

    {{-- <!-- category add modal -->
    <div id="admin-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <a href="index.html" class="text-success">
                            <h3>Add New Admin</h3>
                        </a>
                    </div>

                    <form method="POST" action="">
                        @csrf
                        <input type="hidden" name="type" value="admin">
                        <div class="form-group">
                            <label for="name" class=" col-form-label text-md-right">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{str_random(6)}}" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <p class="text-danger"><b>Note:</b> The upper password is automatically generated and you can modify it. This credentials will automatically sent to the given email.</p>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Admin') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> --}}

@endsection
@section('extra-scripts')

   <!-- demo app -->
   <script src="{{asset('public/admin/js/pages/demo.customers.js')}}"></script>
   <script src="{{asset('public/admin/js/jquery.dataTables.min.js')}}"></script>
   <!-- end demo js-->
   <script>
     $(document).ready( function () {
       $('#myTable').DataTable({"pageLength": 50});
     });


     $("input[name=check_all]").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
     });

     function checkBlock(block){
        $("#check_all").parent().append('<input type="hidden" name="type" value="block">');
        block.form.submit();
     }
     function checkUnBlock(unblock){
        $("#check_all").parent().append('<input type="hidden" name="type" value="unblock">');
        unblock.form.submit();
     }
   </script>
@endsection
