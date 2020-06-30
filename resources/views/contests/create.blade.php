@extends('layouts.app')

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
            background: white;
            border: 0 none;
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
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            background-color: #ECEFF1;
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
            background: #673AB7;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            float: right
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #311B92
        }

        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
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
            color: #673AB7;
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
            font-weight: 400
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
            color: #ffffff;
            background: lightgray;
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
            background:green;
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
@section('scripts')
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
            showFrontendAlert('error', '{{ ("some required fields are missing, please fill star marked fields") }}');
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



$('#contest-category').on('change', function(){
      var catID = $(this).val();
      if(catID) {
        $("#sub-category-column").removeClass('d-none');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
              url: '{{url("/fetch-sub_category")}}',
              type:"POST",
              data:{catID:catID},
              dataType:"json",
              // beforeSend: function(){
              //     $('#loader').css("visibility", "visible");
              // },
              success:function(data) {
                  $('#contest-sub_category').empty();
                  $('#contest-sub_category').append('<option value="">Select SubCategory</option>');
                  $.each(data, function(key, value){
                      $('#contest-sub_category').append('<option value="'+ key +'">' + value + '</option>');
                  });
              }//,
              // complete: function(){
              //     $('#loader').css("visibility", "hidden");
              // }
          });
      } else {
          $('#contest-sub_category').empty();
            $("#sub-category-column").addClass('d-none');
      }
  });

  $('#check-pirze').click(function(){
        var product=$(this).attr('data');
        if($(this).prop('checked')){
            $("#prize-description-row").removeClass('d-none');
        }else{
            $("#prize-description-row").addClass('d-none');
        }
  });

  function previewCertificates(input){
        if (input.files){
            $('#certificatesGallery').empty('');
            var totalFiles=input.files.length;

            //preview multiple file
            for(i=0;i < totalFiles; i++){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#certificatesGallery').append("<img src='"+e.target.result+"'width='100%' style='border:1px solid gray' alt='' />");
                };
                reader.readAsDataURL(input.files[i]);
            }

            //ajax multiple upload

        }
    }
</script>
@endsection
@section('content')
<div class="container">
     

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-12 text-center p-0 mb-2">
                    <div class="card px-0  pb-0 mb-3">
                        {{--<h2 id="heading">Sign Up Your User Account</h2>--}}
                        {{-- <p>Fill all form field to go to next step</p>--}}
                        <form id="msform" action="{{route('user.contests.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="added_by" value="seller">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="one"><strong>Title</strong></li>
                                <li id="two"><strong>Category</strong></li>
                                <li id="three"><strong>Discription</strong></li>
                                <li id="four"><strong>Participants</strong></li>
                                <li id="five"><strong>Prize</strong></li>
                                <li id="six"><strong>Photo</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> <br> <!-- fieldsets -->
                            <fieldset>
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
                                        <div class="col-md-4">
                                            <label>Title <span class="required-star text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control mb-3 {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{old('title')}}" name="title" placeholder="Title of contest" required>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div> <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                            </fieldset>

                            <fieldset>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Category<span class="text-danger">*</span></label>
                                                <select data-toggle="select2" class="{{ $errors->has('category') ? ' is-invalid' : '' }} form-control" id="contest-category" name="category" title="category" required>
                                                    <option value="">Select Category</option>
                                                    @forelse($categories as $category)
                                                    <option value="{{$category->id}}" {{ old('category')==$category->id?'selected':'' }}>{{$category->name}}</option>
                                                    @empty
                                                    <option class="text-danger" value=""> No Category Found</option>
                                                    @endforelse
                                                </select>
                                                @if ($errors->has('category'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('category') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none" id="sub-category-column">
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
                                        </div>
                        
                                    </div>

                                </div>
                                <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                                <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                            </fieldset>
                            <fieldset>
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
                                        <div class="col-md-4">
                                            <label>Description <span class="required-star text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control mb-3 {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" placeholder="Description of contest" required>{{old('description')}}</textarea>
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
                            <fieldset>
                                <div class="form-card p-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">How many people do you want in your contest?</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">{{ __('Step') }} 4 - 6</h2>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Participants</label>
                                            <select data-toggle="select2" class="{{ $errors->has('participants') ? ' is-invalid' : '' }} form-control" id="contest-sub_category" name="participants" title="participants">
                                                <option value="0">Select Participants</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="500">500</option>
                                            </select>
                                            @if ($errors->has('participants'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('participants') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                
                                    </div>
                                    <input type="button" name="next" class="next action-button mr-3" value="{{ __('Next') }}" />
                                    <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card p-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Would you like to supply the prize?</h2>
                                            <p class="text-muted">Keep in mind that you will be paying the winner.If you win, we will pay you. This will come with perks in the future.</p>
                                    
                                            <label class="switch">
                                                <input type="checkbox" name="prize" id="check-pirze">
                                                <span class="slider round"></span>
                                            </label>   
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">{{ __('Step') }} 5 - 6</h2>
                                        </div>
                                       

                                    </div>
                                    <div class="row d-none" id="prize-description-row">
                                        <div class="col-md-4">
                                            <label>Prize Description <span class="required-star text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control mb-3 {{ $errors->has('prize_description') ? ' is-invalid' : '' }}" name="prize_description" placeholder="Description of contest prize">{{old('prize_description')}}</textarea>
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
                            <fieldset>
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
                                        <div class="col-md-4">
                                            <label class="fieldlabels">Photo</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="p-4 bg-light">
                                                <div id="certificatesGallery"> </div>
                                                <label for="image" class="btn  {{ $errors->has('photo') ? ' is-invalid' : '' }}" value="{{old('photo')}}"><i class="fa fa-plus-circle fa-4x"></i></label>
                                                <input type="file" id="image" onchange="previewCertificates(this)" name="photo" class="d-none">
                                                @if ($errors->has('photo'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('photo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
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
