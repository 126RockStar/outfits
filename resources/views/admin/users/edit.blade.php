@extends('admin.master')

@section('title')
  Edit User
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">{{__('Edit User')}}</li>
@endsection
@section('extra-css')
    <link href="{{ asset('public/admin/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/css/vendor/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('contents')
<!-- Header Layout Content -->
     <div class="mdk-header-layout__content page-content pt-3">
         <div class="container page__container">
             <form action="{{route('admin.users.update',$user->id)}}" method="post" enctype="multipart/form-data">
               @csrf
               @method('PUT')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="page-section">
                             <div class="list-group list-group-form">
                                 {{-- <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Your photo</label>
                                         <div class="col-sm-9 media align-items-center">
                                             <a href="{{asset('public/storage/'.Auth::user()->profile_picture)}}" class="media-left mr-16pt">
                                                 <img src="{{asset('public/storage/'.Auth::user()->profile_picture)}}" alt="people" width="56" class="rounded-circle" />
                                             </a>
                                             <div class="media-body">
                                                 <div class="custom-file">
                                                     <input type="file" name="profile_picture" class="custom-file-input" id="inputGroupFile01">
                                                     <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div> --}}
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Username</label>
                                         <div class="col-sm-9">
                                             <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}" placeholder="Your user name ...">
                                             <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                     </div>
                                 </div>

                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Email</label>
                                         <div class="col-sm-9">
                                             <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" placeholder="Your email ...">
                                             <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                             @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                     </div>
                                 </div>

                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Maximum Contests</label>
                                         <div class="col-sm-9">
                                             <input type="number" name="max_contests" class="form-control @error('max_contests') is-invalid @enderror" value="{{$user->max_contests}}" placeholder="This user can create how many contests?">
                                             <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                             @error('max_contests')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                     </div>
                                 </div>
               
                   
                                 {{-- <div class="list-group-item">
                                   <div class="row">
                                     <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       <label for="oldPassword">Current Password</label>
                                       <input type="password"  name="oldPassword" class="form-control" id="oldPassword" placeholder="must provide to update profile" required />
                                       @if ($errors->has('oldPassword'))
                                           <span class="help-block  text-danger">
                                               <strong>{{ $errors->first('oldPassword') }}</strong>
                                           </span>
                                       @endif
                                     </div>


                                     <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       <label for="newPassword">New Password</label>
                                       <input type="password" name="password" class="form-control" id="newPassword" placeholder="Keep blank for not changing password"/>
                                       @if ($errors->has('password'))
                                           <span class="help-block text-danger">
                                               <strong>{{ $errors->first('password') }}</strong>
                                           </span>
                                       @endif
                                     </div>
                                 

                                   </div>
                                 </div> --}}
                                 <div class="list-group-item">
                                     <button type="submit" class="btn btn-success">Save changes</button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
     <!-- // END Header Layout Content -->
@endsection

@section('extra-scripts')

<script>

    $('#changePassword').click(function(){
        $("#changenewPassword").toggleClass('d-none');
        $("#changeConfirmPassword").toggleClass('d-none');
    });

</script>
@endsection
