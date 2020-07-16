@extends('admin.master')

@section('title')
  Edit Contest
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">Edit Contest</li>
@endsection
@section('extra-css')
    <link href="{{ asset('public/admin/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/css/vendor/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/vendors/select2/select2.min.css')}}">
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
             <form action="{{route('admin.contest.update')}}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="{{$contest->id}}">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="page-section">
                             <div class="list-group list-group-form">
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Contest File</label>
                                         <div class="col-sm-9 media align-items-center">
                                             <a href="{{asset('public/storage/'.$contest->file)}}" class="media-left mr-16pt">
                                                @if($contest->file_type=='image')
                                                    <i class="mdi mdi-image position-absolute p-1 bg-info text-white"></i>
                                                    <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail posiiton-relative" style="width:80px">
                                                @else
                                                    <i class="mdi mdi-video position-absolute p-1 bg-info text-white"></i>
                                                    <video src="{{asset('public/storage/'.$contest->file)}}" class="posiiton-relative" width="80px"></video>
                                                @endif
                                             </a>
                                             <div class="media-body">
                                                <div class="custom-file">
                                                    <input type="file" name="photo" class="custom-file-input" id="inputGroupFile01">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Title</label>
                                         <div class="col-sm-9">
                                             <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$contest->title}}" placeholder="Title of the contest ...">
                                             <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                     </div>
                                 </div>

                                 
                                 <div class="list-group-item">
                                    <div class="form-group row mb-0">
                                        <label class="col-form-label col-sm-3">Category</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select  style="width: 100%" class="select2 {{ $errors->has('sub_category') ? ' is-invalid' : '' }} form-control" id="contest-category" name="sub_category" title="sub_category" required>
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
                                    </div>
                                </div>

                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Description</label>
                                         <div class="col-sm-9">
                                            <textarea class="form-control mb-3 {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" placeholder="Description of contest" required>{{$contest->description}}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                     </div>
                                 </div>
                                
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Participants</label>
                                         <div class="col-sm-9">
                                            <select  class="{{ $errors->has('participants') ? ' is-invalid' : '' }} form-control" id="contest-sub_category" name="participants" title="participants">
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
                                
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Prize</label>
                                         <div class="col-sm-9">
                                            <label class="switch">
                                                <input type="checkbox" name="prize" id="check-pirze" {{empty($contest->prize_description)?'':'checked'}}>
                                                <span class="slider round"></span>
                                            </label> 
                                            <textarea id="prize-description-row" class="form-control {{empty($contest->prize_description)?'d-none':''}} mb-3 {{ $errors->has('prize_description') ? ' is-invalid' : '' }}" name="prize_description" placeholder="Description of contest prize">{{$contest->prize_description}}</textarea>
                                            @if ($errors->has('prize_description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('prize_description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Post</label>
                                         <div class="col-sm-9">
                                            <label class="switch">
                                                <input type="checkbox" name="hasPost" id="check-post" {{empty($contest->post)?'':'checked'}}>
                                                <span class="slider round"></span>
                                            </label> 
                                            <textarea type="text" id="post-description-row" class="form-control d-none @error('post') is-invalid @enderror" name="post" autocomplete="post" autofocus>{{$contest->post}}</textarea>
                                                @error('post')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                     </div>
                                 </div>

              
               
                   
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

    <script src="{{asset('public/vendors/select2/select2.min.js')}}"></script>
    <script>
        $('.select2').select2();
        $('#check-pirze').click(function(){
            if($(this).prop('checked')){
                $("#prize-description-row").removeClass('d-none');
            }else{
                $("#prize-description-row").addClass('d-none');
            }
        });
        $('#check-post').click(function(){
            if($(this).prop('checked')){
                $("#post-description-row").removeClass('d-none');
            }else{
                $("#post-description-row").addClass('d-none');
            }
        });



    </script>
@endsection
