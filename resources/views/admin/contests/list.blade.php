@extends('admin.master')

@section('title')
Contests
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">Contests</li>
@endsection

@section('extra-css')
      <!-- third party css -->
      <link href="{{asset('public/admin/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('public/admin/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
      <!-- third party css end -->

      <style>
        /* The switch - the box around the slider */
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    /* Hide default HTML checkbox */
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    } 
     </style>
@endsection

@section('contents')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{route('admin.contests.selected')}}" method="POST" class="card-body">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-sm-4">
                              {{-- <a href="javascript:void(0);" class="btn btn-info m-2" data-toggle="modal" data-target="#admin-add"><i class="mdi mdi-plus-circle mr-2"></i> {{__('Add Admin')}}</a> --}}
                              <button type="submit" onclick="return confirm('Are you sure to delete the selected contests?')" class="btn btn-danger m-2 float-left" ><i class="mdi mdi-delete-sweep  mr-2"></i> Delete Selected</button>
                            
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
                                        <th>Title</th>
                                        <th>Added By</th>
                                        <th>Featured</th>
                                        <th>Participants</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Prize</th>
                                        <th>Prize Featured?</th>
                                        <th>Post</th>
                                        <th>Status</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($contests as $contest)
                                    <tr>
                                        <td><input type="checkbox" name="checked_contests[]" value="{{$contest->id}}"></td>
                                        <td class="table-user">
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">
                                            {{-- <img src="{{asset('public/storage/'.$contest->profile_picture)}}" alt="table-user" class="mr-2 rounded-circle"> --}}
                                            {{$contest->title}}</a>
                                        </td>
                                        <td>{{$contest->getCreator->username}}</td>
                                        
                                        <td>
                                            <label class="switch">
                                            <input type="checkbox" class="feature-contest" data="{{$contest->id}}"{{$contest->is_featured==1?'checked':''}}>
                                            <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            {{count($contest->getParticipants)}} of {{$contest->participants}}
                                        </td>
                                        <td>{{$contest->description}}</td>
                                        <td>
                                            {{$contest->getCategory->name}} 
                                            {{!empty($contest->getSubCategory)? ' > '.$contest->getSubCategory->name :''}}
                                        </td>
                                        <td>
                                            {{$contest->prize_description}}
                                        </td>
                                        <td>
                                            @if(!empty($contest->prize_description))
                                                <label class="switch">
                                                    <input type="checkbox" class="feature-prize" data="{{$contest->id}}"{{$contest->is_prize_featured==1?'checked':''}}>
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
                                        </td>
                                        <td>{{$contest->post}}</td>

                                        <td>
                                            @if($contest->status =='open')
                                              <span class="badge badge-warning">Open</span>
                                            @else
                                              <span class="badge badge-info">Judge</span>
                                            @endif
                                        </td>

                                        <td>
                                            <!-- <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a> -->

                                        
                                            <a href="{{route('admin.contest.delete',$contest->id)}}" onclick="return confirm('Are you sure to delete the contest?')" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>
                                            <a href="{{route('admin.contest.edit',$contest->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                            <a href="{{route('admin.contest.show',$contest->id)}}" class="btn btn-info btn-sm">Manage/View Entries</a>
                                        
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td collspan="5" class="text-danger">No contest Found</td></tr>
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
        $('input:checkbox[name="checked_contests[]"]').not(this).prop('checked', this.checked);
     });

     $('.feature-contest').click(function(){
        var contest=$(this).attr('data');
    
        var _token=$('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '{{url("/admin/contest/feature")}}',
            type:"POST",
            data:{contest:contest,_token:_token},
            success:function(data) {
                alert('done');
            }

        });
    });
     $('.feature-prize').click(function(){
        var contest=$(this).attr('data');
    
        var _token=$('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '{{url("/admin/prize/feature")}}',
            type:"POST",
            data:{contest:contest,_token:_token},
            success:function(data) {
                alert('done');
            }

        });
    });
   </script>
@endsection
