@extends('admin.master')

@section('title')
  {{$contest->title}}
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">View Entries</li>
@endsection
@section('extra-css')
    {{-- <link href="{{ asset('public/admin/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/css/vendor/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/vendors/select2/select2.min.css')}}"> --}}
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
<!-- Header Layout Content -->
     <div class="mdk-header-layout__content page-content pt-3">
         <div class="container page__container">
             <div class="row">
                <div class="col-md-3">
                    <a href="{{asset('public/storage/'.$contest->file)}}" class="media-left mr-16pt">
                        @if($contest->file_type=='image')
                            <i class="mdi mdi-image position-absolute p-1 bg-info text-white"></i>
                            <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail posiiton-relative" style="width:100%">
                        @else
                            <i class="mdi mdi-video position-absolute p-1 bg-info text-white"></i>
                            <video src="{{asset('public/storage/'.$contest->file)}}" class="posiiton-relative" width="100%"></video>
                        @endif
                    </a>
                    <h3>{{$contest->title}}</h3>
                    <p>{{$contest->description}}</p>
                    @if(empty($contest->prize_description))
                        <p class="text-warning">no prize for this contest</p>
                    @else
                        <p class="text-secondary">{{$contest->prize_description}}</p>
                    @endif
                </div>
                <div class="col-md-9">
                    <h2>Participants:  {{count($contest->getParticipants)}} of {{$contest->participants}}</h2>
                    <div class="list-group list-group-form">
                        @forelse ($contest->getParticipants as $participant)
                            <div class="list-group-item">
                                <div class="form-group row mb-0">
                                    <label class="col-form-label col-md-3">{{$participant->getParticipant->username}}</label>
                                    <div class="col-md-3">
                                        <a href="{{asset('public/storage/'.$contest->file)}}" target="_blank" class="media-left mr-16pt">
                                            @if($contest->file_type=='image')
                                                <i class="mdi mdi-image position-absolute p-1 bg-info text-white"></i>
                                                <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail posiiton-relative" style="width:80px">
                                            @else
                                                <i class="mdi mdi-video position-absolute p-1 bg-info text-white"></i>
                                                <video src="{{asset('public/storage/'.$contest->file)}}" class="posiiton-relative" width="80px"></video>
                                            @endif
                                         </a>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{route('admin.contest.entry.update')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$participant->id}}">
                                            <input type="file" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$contest->title}}">
                                            <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                        </form>
                                    
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3 class="text-danger">No user participated in this contest</h3>
                        @endforelse
                      
                        {{-- <div class="list-group-item">
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div> --}}
                    </div>
                </div>
             </div>
         </div>
     </div>
     <!-- // END Header Layout Content -->
@endsection

@section('extra-scripts')

    {{-- <script src="{{asset('public/vendors/select2/select2.min.js')}}"></script> --}}
    <script>
        $('.select2').select2();
        $('#check-pirze').click(function(){
                var product=$(this).attr('data');
                if($(this).prop('checked')){
                    $("#prize-description-row").removeClass('d-none');
                }else{
                    $("#prize-description-row").addClass('d-none');
                }
        });



    </script>
@endsection
