@extends('layouts.app')
@section('title') 
Edit Contest
@endsection
@section('styles')
    <style>

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

        #progressbar #four:before {
            content: "4"
        }

        #progressbar #five:before {
            content: "5"
        }

        #progressbar #six:before {
            content: "6"
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
        #progressbar li[class=active]::before,#progressbar li[class=active] strong{
            cursor: pointer;
        }






    .br_dropzone {
        position: relative;
        border: 1px solid rgba(#000, 0.1);
        width: 100%;
        height: 256px;
        display: block;
        border-radius: 4px;
        box-sizing: border-box;
        
        background-image: linear-gradient(135deg,rgba(0,0,0,.03)25%, transparent 25%, transparent 50%, rgba(0,0,0,.03)50%, rgba(0,0,0,.03)75%, transparent 75%, transparent);
        background-color: #FAFCFD;
        background-size: 16px 16px;
        }

        .br_dropzone input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 0;
        font-size: 2rem;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        box-sizing: border-box;
        }

        .br_dropzone input[type=text] {
        background: none;
        border: none;
        padding: 0.5em;
        width: 100%;
        height: 100%;
        text-align: center;
        font-size: 2rem;
        box-sizing: border-box;
        }

        .br_dropzone.dragover {
        background-color: #eee;
        border: 6px dashed rgba(#000, 0.1);
        }
    </style>
    {{-- <link rel="stylesheet" href="{{asset('public/vendors/select2/select2.min.css')}}"> --}}
@endsection
@section('scripts')
{{-- <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css"> --}}
{{-- <script src="{{asset('public/vendors/select2/select2.min.js')}}"></script> --}}
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
            Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No,no,no... You need to fill out each step before moving on.'
                    });
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



// $('#contest-category').on('change', function(){
//       var catID = $(this).val();
//       if(catID) {
//         $("#sub-category-column").removeClass('d-none');
//         $.ajaxSetup({
//             headers: {
//               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//           });
//         $.ajax({
//               url: '{{url("/fetch-sub_category")}}',
//               type:"POST",
//               data:{catID:catID},
//               dataType:"json",
//               // beforeSend: function(){
//               //     $('#loader').css("visibility", "visible");
//               // },
//               success:function(data) {
//                   $('#contest-sub_category').empty();
//                   $('#contest-sub_category').append('<option value="">Select SubCategory</option>');
//                   $.each(data, function(key, value){
//                       $('#contest-sub_category').append('<option value="'+ key +'">' + value + '</option>');
//                   });
//               }//,
//               // complete: function(){
//               //     $('#loader').css("visibility", "hidden");
//               // }
//           });
//       } else {
//           $('#contest-sub_category').empty();
//             $("#sub-category-column").addClass('d-none');
//       }
//   });

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
  $('.custom-control-input').click(function(){
        var data=$(this).val();
        $("#prize_description").val(data);
        
  });

  function previewFile(input){
            $('#loadingPreview').removeClass('d-none');
        if (input.files){
            $('#photoGallery').empty('');
            var filetype = input.files[0].type;
            var ext = input.files[0].name.split('.').pop().toLowerCase();
            var reader = new FileReader();
            reader.onload = function (event) {
                if(filetype.indexOf("image") > -1){
                    $("#file_type").val('image');
                    $('#photoGallery').append("<img src='"+event.target.result+"'width='100%' style='border:1px solid gray' alt='' />");
                    $('#loadingPreview').addClass('d-none');
                }else if(filetype.indexOf("video") > -1 && $.inArray(ext, ['mp4','webm']) > -1){
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
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'The video duration is greater than 30 seconds, please choose another'
                            });
                        }else{
                            $('#photoGallery').append("<video src='"+event.target.result+"'width='100%' style='border:1px solid gray' controls></video>");
                            $('#loadingPreview').addClass('d-none');
                        }
                    };
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No,no,no... You need to choose either Photo or Video(mp4,webm)'
                    });
                }
                
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    }
    $("#progressbar li.active").click(function(){
        var item=$(this).attr('id');
        $('#msform').find('fieldset').hide();
        $("#step"+item).show();
    });


    
    var onDragEnter = function (event) {
        $(".br_dropzone").addClass("dragover");
    },
    
    onDragOver = function (event) {
        event.preventDefault();
        if (!$(".br_dropzone").hasClass("dragover"))
            $(".br_dropzone").addClass("dragover");
    },
    
    onDragLeave = function (event) {
        event.preventDefault();
        $(".br_dropzone").removeClass("dragover");
    },
    
    onDrop = function (event) {
        $(".br_dropzone").removeClass("dragover");
        $(".br_dropzone").addClass("dragdrop");
        debugger; console.log(event.originalEvent.dataTransfer.files);
    };
    
    $(".br_dropzone")
    .on("dragenter", onDragEnter)
    .on("dragover", onDragOver)
    .on("dragleave", onDragLeave)
    .on("drop", onDrop);
</script>
@endsection
@section('content')
<div class="container">
     

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-10 text-center p-0 mb-2">
                    <div class="card px-0  pb-0 mb-3">
                        {{--<h2 id="heading">Sign Up Your User Account</h2>--}}
                        {{-- <p>Fill all form field to go to next step</p>--}}
                        <form id="msform" action="{{route('user.contests.update',$contest->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="file_type" name="file_type" value="{{$contest->file_type}}">
                            @method('PUT')
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="one"><strong>Title</strong></li>
                                <li class="active" id="two"><strong>Category</strong></li>
                                <li class="active" id="three"><strong>Rules</strong></li>
                                <li class="active" id="four"><strong>Entries</strong></li>
                                <li class="active" id="five"><strong>Prize</strong></li>
                                <li class="active" id="six"><strong>Upload</strong></li>
                            </ul>
                            {{--<div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> <br> --}} 
							<!-- fieldsets -->
                            <fieldset id="stepone">
                                <div class="form-card p-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Think up a great title for your contest.</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">{{ __('Step') }} 1 - 6</h2>
                                        </div>
                                    </div>

                                    <div class="row">
									{{-- <label class="col-md-4 text-dark text-right">Title <span class="required-star text-danger">*</span></label>--}}
                                       
                                        <div class="col-md-8">
                                            <input type="text" maxlength="50" class="form-control mb-3 {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{$contest->title}}" name="title" placeholder="Title of contest" required>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div> <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                            </fieldset>

                            <fieldset id="steptwo">
                                <div class="form-card p-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Select the most suitable category.</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">{{ __('Step') }} 2 - 6</h2>
                                        </div>
                                    </div>
                                    <div class="row">
									{{--   <label  class="col-md-6 text-dark text-right">Category<span class="text-danger">*</span></label>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select  style="width: 100%" class="{{ $errors->has('sub_category') ? ' is-invalid' : '' }} form-control" id="contest-category" name="sub_category" title="sub_category" required>
                                                    <option value="">Select Category</option>
                                                    @forelse($categories as $category)
                                                    <optgroup label="{{$category->name}}">
                                                        @forelse($category->getSubCategories as $subCategory)
                                                            <option value="{{$subCategory->id}}" {{ $contest->sub_category==$subCategory->id?'selected':'' }}>{{$subCategory->name}}</option>
                                                        @empty 
                                                            <option value="">No sub-category found</option>
                                                        @endforelse
                                                    </optgroup>
                                                    @empty
                                                        <option class="text-danger" value=""> No Category Found</option>
                                                    @endforelse
                                                </select>
                                                @if ($errors->has('sub_category'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('sub_category') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        
                                        {{-- <div class="col-md-6 d-none" id="sub-category-column">
                                            <div class="form-group">
                                                <label>SubCategory<span class="text-danger">*</span></label>
                                                <select data-toggle="select2" class="{{ $errors->has('sub_category') ? ' is-invalid' : '' }} form-control" id="contest-sub_category" name="sub_category" title="sub_category" required>
                                                    <option value="0">Select SubCategory</option>
                                                </select>
                                                @if ($errors->has('sub_category'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('sub_category') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div> --}}
                        
                                    </div>

                                </div>
                                <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                                <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                            </fieldset>
                            <fieldset id="stepthree">
                                <div class="form-card p-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Describe what the pic should show</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">{{ __('Step') }} 3 - 6</h2>
                                        </div>
                                    </div>

                                    <div class="row">
									{{-- <label class="col-md-4 text-dark text-right">Description <span class="required-star text-danger">*</span></label>--}}
                                        
                                        <div class="col-md-8">
                                            <textarea class="form-control mb-3 {{ $errors->has('description') ? ' is-invalid' : '' }}" maxlength="250" name="description" placeholder="Description of contest" required>{{$contest->description}}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                
                                    </div>
                                    <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                                    <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                            </fieldset>
                            <fieldset id="stepfour">
                                <div class="form-card p-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">How many people do you want in your contest?</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">{{ __('Step') }} 4 - 6</h2>
                                        </div>
                                    </div>
                             
                                    <div class="row">
									{{--  <label  class="col-md-6 text-dark text-right">Participants</label>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="{{ $errors->has('participants') ? ' is-invalid' : '' }} form-control" id="contest-sub_category" name="participants" title="participants" required>
                                                    <option value="">Select Participants</option>
                                                    <option value="15"{{ $contest->participants=='15'?'selected':'' }}>15</option>
                                                    <option value="25"{{ $contest->participants=='25'?'selected':'' }}>25</option>
                                                    <option value="50"{{ $contest->participants=='50'?'selected':'' }}>50</option>
                                                    <option value="100"{{ $contest->participants=='100'?'selected':'' }}>100</option>
                                                </select>
                                                @if ($errors->has('participants'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('participants') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                
                                    </div>
                                    <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                                    <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                            </fieldset>
                            <fieldset id="stepfive">
                                <div class="form-card p-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Would you like to supply the prize?</h2>
                                            <p class="text-muted">Keep in mind that you will be paying the winner.If you win, we will pay you. This will come with perks in the future.</p>
                                    
                                            <label class="switch">
                                                <input type="checkbox" name="prize" id="check-pirze" {{empty($contest->prize_description)?'':'checked'}}>
                                                <span class="slider round"></span>
                                            </label>   
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">{{ __('Step') }} 5 - 6</h2>
                                        </div>
                                       

                                    </div>
                                    <div class="row {{empty($contest->prize_description)?'d-none':''}}" id="prize-description-row">
										{{--   <label  class="col-md-4 text-dark text-right">Prize Description <span class="required-star text-danger">*</span></label>--}}
                                        <div class="col-md-6 text-center">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customRadio1" name="dummy_prize" value="Prize Option 1"{{$contest->prize_description=='Prize Option 1'?'checked':''}}>
                                                <label class="custom-control-label" for="customRadio1">Prize Option 1</label>
                                              </div>
                                              <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customRadio2" name="dummy_prize" value="Prize Option 2"{{$contest->prize_description=='Prize Option 2'?'checked':''}}>
                                                <label class="custom-control-label" for="customRadio2">Prize Option 2</label>
                                              </div>
                                              <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customRadio3" name="dummy_prize" value="Prize Option 3"{{$contest->prize_description=='Prize Option 3'?'checked':''}}>
                                                <label class="custom-control-label" for="customRadio3">Prize Option 3</label>
                                              </div>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customRadio4" name="dummy_prize" value="Prize Option 4"{{$contest->prize_description=='Prize Option 4'?'checked':''}}>
                                                <label class="custom-control-label" for="customRadio4">Prize Option 4</label>
                                              </div>
                                              <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customRadio5" name="dummy_prize" value="Prize Option 5"{{$contest->prize_description=='Prize Option 5'?'checked':''}}>
                                                <label class="custom-control-label" for="customRadio5">Prize Option 5</label>
                                              </div>
                                              <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customRadio6" name="dummy_prize" value="Prize Option 6"{{$contest->prize_description=='Prize Option 6'?'checked':''}}>
                                                <label class="custom-control-label" for="customRadio6">Prize Option 6</label>
                                              </div>
                                        </div>
                                        
                                        <div class="col-md-8">
                                            <textarea id="prize_description" class="form-control mb-3 {{ $errors->has('prize_description') ? ' is-invalid' : '' }}" name="prize_description" maxlength="50" placeholder="Description of contest prize">{{$contest->prize_description}}</textarea>
                                            @if ($errors->has('prize_description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('prize_description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                
                                    </div>
                                    <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                                    <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                            </fieldset>
                            <fieldset id="stepsix">
                                <div class="form-card p-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Choose your photo. then Press 'Save' button.</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">{{ __('Step') }} 6 - 6</h2>
                                        </div>
                                    </div>


                                    <div class="row">
									{{--   <label class="col-md-4 text-dark text-right">Photo<span class="required-star text-danger">*</span></label>--}}
                                        
                                        <div class="col-md-6 offset-md-3">
                                                <i class="fas fa-spinner fa-pulse fa-8x d-none" id="loadingPreview"></i>
                                                <div id="photoGallery">
                                                    @if($contest->file_type=='image')
                                                        <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail" style="width:100%">
                                                    @else
                                                        <video src="{{asset('public/storage/'.$contest->file)}}" width="100%" controls></video>
                                                    @endif
                                                </div>
                                                {{-- <label for="image" class="btn  {{ $errors->has('photo') ? ' is-invalid' : '' }} cursor-pointer">
                                                    <i class="fa fa-plus-circle text-info fa-8x"></i>
                                                </label>
                                                <input type="file" id="image" onchange="previewFile(this)" name="photo" class="d-none">
                                                 --}}
                                                <label for="file" class="br_dropzone">
                                                    <input type="file" id="file" name="file" onchange="previewFile(this)">
                                                    <input type="text" placeholder="Drop Photo/Video to upload (or click)" readonly>
                                                </label>
                                                @if ($errors->has('file'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('file') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>


                                    {{--  <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>--}}
                                    {{-- <div class="row justify-content-center">--}}
                                    {{-- <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>--}}
                                    {{--   </div> <br><br>--}}
                                    {{-- <div class="row justify-content-center">--}}
                                    {{-- <div class="col-7 text-center">--}}
                                    {{--  <h5 class="purple-text text-center">Product Successfully Uploaded</h5>--}}
                                    {{--   </div>--}}
                                    {{--   </div>--}}
                                </div>
                                <input type="submit" class="action-button mr-3" value="{{ __('Save') }}" />
                                <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
         

</div>
@endsection
