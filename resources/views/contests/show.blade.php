@extends('layouts.app')

@section('styles')
    <style>
		.modal-backdrop.show {
			display: none;
		}
        #heading {
            text-transform: uppercase;
            color: #673AB7;
            font-weight: normal
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px
        }

        #msform fieldset {
            background: #4d5465;
            border: 1px solid #a9a9a9;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        .form-card {
            text-align: left
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform input,
        #msform textarea {
            padding: 8px 15px 8px 15px;
            border: 1px solid #ced4da;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            background-color: #a3aabb;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #673AB7;
            outline-width: 0
        }

        #msform .action-button {
            width: 100px;
            background: transparent;
            font-weight: bold;
            color: white;
            border: 1px solid #a9a9a9;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            float: right
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #17a2b8
        }

        #msform .action-button-previous {
            width: 100px;
            background: transparent;
            font-weight: bold;
            color: white;
            border: 1px solid #a9a9a9;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px 10px 0px;
            float: right
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            background-color: #000000
        }

        .card {
            z-index: 0;
            border: none;
            position: relative
        }

        .fs-title {
            font-size: 25px;
            color: #fff;
            margin-bottom: 15px;
            font-weight: normal;
            text-align: left
        }

        .purple-text {
            color: #673AB7;
            font-weight: normal
        }

        .steps {
            font-size: 25px;
            color: gray;
            margin-bottom: 10px;
            font-weight: normal;
            text-align: right
        }

        .fieldlabels {
            color: gray;
            text-align: left
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: white;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 16%;
            float: left;
            position: relative;
            font-weight: 400;
			color: #a9a9a9;
        }

        #progressbar #one:before {
            content: "1"
        }

        #progressbar #two:before {
            content: "2"
        }

        #progressbar #three:before {
            content: "3"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #a9a9a9;
            background: #4d5465;
			border: 1px solid #a9a9a9;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background:#17a2b8;
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #673AB7
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }
        .note-popover{display: none}

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
    <link rel="stylesheet" href="{{asset('public/vendors/magnific-popup/magnific-popup.css')}}">
@endsection
@section('scripts')
<script src="{{asset('public/vendors/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script>
    //three steps product upload start
    $(document).ready(function(){

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function(){
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            var required = current_fs.find('input,textarea,select').filter('[required]');

            var allRequired = true;
            required.each(function(){
                if($(this).val() == ''){
                    allRequired = false;
                    $(this).addClass('border-danger');
                }
            });

            if(allRequired){
                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({'opacity': opacity});
                    },
                    duration: 500
                });
                setProgressBar(++current);
            }else{
                alert("No,no,no... You need to fill out each step before moving on.");
            }
        });

        $(".previous").click(function(){

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
                previous_fs.show();

            //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
            // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({'opacity': opacity});
                    },
                    duration: 500
                });
                setProgressBar(--current);
            });

            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                    .css("width",percent+"%")
            }

            $(".submit").click(function(){
                return false;
            })

    });
    //three steps product upload end

  $('#check-pirze').click(function(){
        var product=$(this).attr('data');
        if($(this).prop('checked')){
            $("#prize-description-row").removeClass('d-none');
            $("#prize_description").attr('required','');
        }else{
            $("#prize-description-row").addClass('d-none');
            $("#prize_description").removeAttr('required');
        }
  });

  function previewimage(input){
      $('#loadingPreview').removeClass('d-none');
        if (input.files){
            $('#photoGallery').empty('');
            var filetype = input.files[0].type;
            var reader = new FileReader();
            reader.onload = function (event) {
                if(filetype.indexOf("image") > -1){
                    $("#file_type").val('image');
                    $('#photoGallery').append("<img src='"+event.target.result+"'width='100%' style='border:1px solid gray' alt='' />");
                    $('#loadingPreview').addClass('d-none');
                }else{
                    $("#file").val('');
                    $('#loadingPreview').addClass('d-none');
                    alert('No,no,no... You need to choose a Photo');
                }
                
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    }

  function previewvideo(input){
      $('#loadingPreview').removeClass('d-none');
        if (input.files){
            $('#photoGallery').empty('');
            var filetype = input.files[0].type;
            var reader = new FileReader();
            reader.onload = function (event) {
                if(filetype.indexOf("video") > -1){
                    $("#file_type").val('video');
                   
                   // create the video element but don't add it to the page
                    var vid = document.createElement('video');
                    var fileURL = URL.createObjectURL(input.files[0]);
                    vid.src = fileURL;
                    // wait for duration to change from NaN to the actual duration
                    vid.ondurationchange = function() {
                        if(this.duration>=31){
                            $("#file").val('');
                            $('#loadingPreview').addClass('d-none');
                            alert('The video duration is greater than 30 seconds, please choose another');
                        }else{
                            $('#photoGallery').append("<video src='"+event.target.result+"'width='100%' style='border:1px solid gray' controls></video>");
                            $('#loadingPreview').addClass('d-none');
                        }
                    };
                }else{
                    $("#file").val('');
                    $('#loadingPreview').addClass('d-none');
                    alert('No,no,no... You need to choose a Video');
                }
                
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    }


    function checkFile(){
        var hasFile = $("#file").val();
        if(!hasFile) {
            alert('No,no,no... You need to choose a {{$contest->file_type}}');
        }else{
            $('#loadingPreview').removeClass('d-none');
        }
    }

    $('.parent-container').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery:{
            enabled:true
        }
        // other options
    });
</script>
@endsection
@section('content')
<div class="container">
<div class="card">
  <div class="card-body">
    <div class="row">
       <div class="col-md-5">
            <h3 class="text-white">{{$contest->title}}<span class="text-muted">...by <b>{{$contest->getCreator->username}}</b></span></h3>
			<br>
			    <p class="text-white">RULES: {{$contest->description}}</p>
            
            @if(empty($contest->prize_description))
                <p class="text-warning">PRIZE: No Prize</p>
            @else
                <p class="text-white">PRIZE: {{$contest->prize_description}}</p>
            @endif

            @auth 
                @if($contest->user_id!=Auth::id())
                    @if(count($participants)<$contest->participants)
                        @if(empty($isParticipated))
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Join Contest
                            </button>
                            
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                            
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                    <h4 class="modal-title text-dark">{{$contest->title}}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                            
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                
                                        <form id="msform" action="{{route('user.contest.participate')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden"  name="id" value="{{$contest->id}}">
                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li id="one" class="active"><strong>Type</strong></li>
                                            <li id="two"><strong>Rules</strong></li>
                                                <li id="three"><strong>Upload</strong></li>
                                            </ul>
                                            {{--<div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> <br> --}} 
            

                                            <fieldset>
                                                <div class="form-card p-3">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">This is a {{$contest->file_type}} contest.</h2>
                                                            <p class="text-muted">Make sure you have a {{$contest->file_type}} ready for step 3<br>Video can be max 30 seconds</p>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">{{ __('Step') }} 1 - 3</h2>
                                                        </div>
                                                    
                
                                                    </div>
                                                
                                                    </div>
                                                    <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card p-3">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Does your {{$contest->file_type}} follow these rules?</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">{{ __('Step') }} 2 - 3</h2>
                                                        </div>
                                                    
                
                                                    </div>
                                                
                                                    <p class="text-muted">{{$contest->description}}</p> 
                                                    </div>
                                                    <input type="button" name="next" class="next action-button mr-3" value="Next" />
                                                    
                                            </fieldset>

                                            <fieldset>
                                                <div class="form-card p-3">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Upload your {{$contest->file_type}}.</h2>
															 <p class="text-muted">After you preview your {{$contest->file_type}}, click save.</p>
                                                            @if($contest->file_type=='video')
                                                                <p class="text-muted">Maximum video duration is 30 seconds<br>After you preview your {{$contest->file_type}}, click save.</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">{{ __('Step') }} 3 - 3</h2>
                                                        </div>
                                                    </div>
                
                
                                                    <div class="row">
                                                    {{--   <label class="col-md-4 text-dark text-right">Photo<span class="required-star text-danger">*</span></label>--}}
                                                        <div class="col-md-3">
                                                            <i class="fas fa-spinner fa-pulse fa-8x d-none" id="loadingPreview"></i>
                                                            <div id="photoGallery"> </div>
                                                            <label for="file" class="btn  {{ $errors->has('file') ? ' is-invalid' : '' }} cursor-pointer">
                                                                <i class="fa fa-plus-circle text-info fa-6x"></i>
                                                            </label>
                                                            <input type="file" id="file" accept="{{$contest->file_type}}/*" onchange="preview{{$contest->file_type}}(this)" name="file" class="d-none" required>
                                                            @if ($errors->has('file'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('file') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" onclick="checkFile()" class="action-button mr-3" value="{{ __('Save') }}" />
                                                <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                                            </fieldset>
                                        </form>

                                    </div>
                            
                                    {{-- <!-- Modal footer -->
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div> --}}
                            
                                </div>
                                </div>
                            </div>
                        @else 
                            <div class="text-danger">You have joined this contest.</div>
                            <p class="text-muted">You can unjoin until contest is full.</p>
                            @if(count($participants)<$contest->participants)
                                <a href="{{route('user.contest.unjoin',$contest->id)}}" onclick="return confirm('Are you sure to delete your entry in this contest?')" class="btn btn-danger btn-sm">Unjoin</a>
                            @endif
                        @endif
                    @else 
                        <h3 class="text warning">Judging</h3>
                    @endif
                @else 
                    <p class="text-warning">You can't join in your created contest</p>
                @endif
            @else 
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Login
                </button>
                
                <!-- The Modal -->
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                    <div class="modal-content">
                
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title text-dark">Login</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" action="{{ route('login.continue') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right text-dark">{{ __('Username') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
        
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right text-dark">{{ __('Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label text-dark" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
        
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                
                    </div>
                    </div>
                </div>
            @endauth
        </div>
		
		
		<div class="col-md-7 pr-0">
		   <h6>Participants:  {{count($contest->getParticipants)}} of {{$contest->participants}}</h6>
			<div class="parent-container">
				@forelse($participants as $participant)
				<a href="{{asset('public/storage/'.$participant->file)}}" class="{{$contest->file_type=='video'?'mfp-iframe':''}}">
				@if($contest->file_type=='image')
					<img src="{{asset('public/storage/'.$participant->file)}}"  height="120px" title="{{$participant->getParticipant->username}}">
				@else
					<video src="{{asset('public/storage/'.$participant->file)}}"  height="120px" title="{{$participant->getParticipant->username}}"></video>
				@endif
				@empty 
				@endforelse
				</a>
			</div>
        </div>				
    </div>   
</div>
</div>
</div>
@endsection
