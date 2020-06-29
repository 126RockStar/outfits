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
            color: #673AB7
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar #account:before {
            font-family: FontAwesome;
            content: "\f15c"
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "\f155"
        }

        #progressbar #payment:before {
            font-family: FontAwesome;
            content: "\f0d1"
        }

        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "\f2b5"
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
            background: #673AB7
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
</script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            




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
                                        <li class="active" id="account"><strong>{{__('Product Information')}}</strong></li>
                                        <li id="personal"><strong>{{__('price & Quantity')}}</strong></li>
                                        <li id="payment"><strong>{{__('Sample & Shipping')}}</strong></li>
                                        <li id="confirm"><strong>{{__('Trade & Payment')}}</strong></li>
                                    </ul>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> <br> <!-- fieldsets -->
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="fs-title">{{__('Product Information')}}</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">{{ __('Step') }} 1 - 4</h2>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>{{__('Product Name')}} <span class="required-star text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control mb-3 {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{old('name')}}" name="name" placeholder="{{__('Product Name')}}" required>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div> <input type="button" name="next" class="next action-button" value="{{ __('Next') }}" />
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="fs-title">{{ __('Price & Quantity') }}:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">{{ __('Step') }} 2 - 4</h2>
                                                </div>
                                            </div>

                               


                                        </div>
                                        <input type="button" name="next" class="next action-button" value="{{ __('Next') }}" />
                                        <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="fs-title">{{('Sample & Shipping')}}:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">{{ __('Step') }} 3 - 4</h2>
                                                </div>
                                            </div>

                                      
                                            </div>
                                            <input type="button" name="next" class="next action-button" value="{{ __('Next') }}" />
                                            <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="fs-title">{{ __('Trade & Payment') }}:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">{{ __('Step') }} 4 - 4</h2>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="fieldlabels">{{__('Certifications')}}:</label>
                                                </div>
                                                <div class="col-md-8">

                                                    <div class="p-4 bg-light">
                                                        <div id="certificatesGallery"> </div>
                                                        <label for="images" class="btn  {{ $errors->has('certifications') ? ' is-invalid' : '' }}" value="{{old('certifications')}}"><i class="fa fa-plus-circle fa-4x"></i></label>
                                                        <input type="file" id="images" onchange="previewCertificates(this)" name="certifications[]" class="d-none" multiple>
                                                        @if ($errors->has('certifications'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('certifications') }}</strong>
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
                                        <input type="submit" class="action-button" value="{{ __('Save') }}" />
                                        <input type="button" name="previous" class="previous action-button-previous" value="{{ __('Previous') }}" />
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         




















        </div>
    </div>
</div>
@endsection
