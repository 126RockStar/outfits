@extends('layouts.app')
@section('title') 
  Edit Profile
@endsection
@section('styles') 
  <style>
    .fakeimg {
      height: 200px;
      background: #aaa;
    }

    .GeneratedMarquee {
      font-family:'Comic Sans MS';
      font-size:1em;
      line-height:1.3em;
      color:white;
      // background-color:#CCFFFF;
      padding:1.5em;

    }

    
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
        background-color: #a9a9a9;
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

@section('scripts') 
<script>
  
  $('#change-password').click(function(){
      $("#changenewPassword").toggleClass('d-none');
      $("#changeConfirmPassword").toggleClass('d-none');

        if($(this).prop('checked')){
            $("#changenewPassword").removeClass('d-none');
            $("#changeConfirmPassword").removeClass('d-none');
        }else{
            $("#changenewPassword").addClass('d-none');
            $("#changeConfirmPassword").addClass('d-none');
        }
  });
</script>
@endsection

@section('content')
  <div class="container" style="margin-top:30px;min-height:60vh">
    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="page-section">
                    <h4>{{__('Edit Profile')}}</h4>
                    <div class="list-group">
                        {{-- <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">{{__('Your photo')}}</label>
                                <div class="col-sm-9 media align-items-center">
                                    <a href="{{asset('public/storage/'.Auth::user()->profile_picture)}}" class="media-left mr-16pt">
                                        <img src="{{asset('public/storage/'.Auth::user()->profile_picture)}}" id="profilePic" alt="people" width="56" class="" />
                                    </a>
                                    <div class="media-body">
                                        <div class="custom-file">
                                            <input type="file" name="profile_picture" class="form-control-file" onchange="priviewIMG(this)" id="inputGroupFile01">
                                            <!-- <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="list-group-item  bg-dark">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3 text-right">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" value="{{Auth::user()->username}}" placeholder="Your username ..." required>
                                    <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item  bg-dark">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3 text-right">{{__('Email')}}</label>
                                <div class="col-sm-9">
                                    <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" class="form-control" value="{{Auth::user()->email}}" placeholder="{{__('Your profile email')}} ..." required>
                                    <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item  bg-dark">
                          <div class="row">
                           <div class="col-md-3 text-right">
                            Change Password? <label class="switch"> 
                                    <input type="checkbox" name="prize" id="change-password" {{empty($contest->prize_description)?'':'checked'}}>
                                    <span class="slider round"></span>
                                </label>
                           </div>
                            <div class="form-group col-md-4 d-none"id="changenewPassword">
                              <label for="newPassword">New Password</label>
                              <input type="password" name="password" class="form-control" id="newPassword" placeholder="Keep blank for not changing password"/>
                              @if ($errors->has('password'))
                                  <span class="help-block text-danger">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                            </div>
                            <div class="form-group col-md-4 d-none" id="changeConfirmPassword">
                              <label for="confirmPassword">Re-type New Password</label>
                              <input type="password"  name="password_confirmation" class="form-control" id="confirmPassword" placeholder="Keep blank for not changing password"/>

                              @if ($errors->has('password_confirmation'))
                                  <span class="help-block text-danger">
                                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                                  </span>
                              @endif
                            </div>

                          </div>
                        </div>
                        <div class="list-group-item  bg-dark">
                            <button type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    
  </div>
@endsection
