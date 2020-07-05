@extends('layouts.app')

@section('styles')
     <!-- SmartMenus core CSS (required) -->
     <link href="{{asset('public/frontEnd')}}/css/sm-core-css.css" rel="stylesheet" type="text/css" />
     <link href="{{asset('public/frontEnd')}}/css/sm-clean/sm-clean.css" rel="stylesheet" type="text/css" />
@endsection
@section('scripts')

 <!-- SmartMenus core CSS (required) -->
 <script src="{{asset('public/frontEnd')}}/js/jquery.smartmenus.min.js"></script>
    <script>
         $('#categoryMenu').smartmenus({
          subMenusSubOffsetX: 1,
          subMenusSubOffsetY: -8
      });
    </script>
@endsection
@section('content')
 <div class="container">
    <ul class="sm sm-clean"id="categoryMenu">
        <li><a href="#">Categories</a>
            <ul>
                @forelse($categories as $key=>$category)
                    <li>
                        <a class="@if(isset($_GET['category'])) {{$category->id==$_GET['category']?'bg-success text-white ':''}} @endif" href="{{route('contests','category='.$category->id)}}" >{{$category->name}}</a>
                        @if(count($category->getSubCategories)>0)
                            <ul>
                                @forelse($category->getSubCategories as $subCategory)
                                    <li class="">
                                        <a class="@if(isset($_GET['subCategory'])) {{$subCategory->id==$_GET['subCategory']?'bg-success text-white ':''}} @endif" href="{{route('contests','category='.$category->id.'&subCategory='.$subCategory->id)}}">{{$subCategory->name}}</a>
                                    </li>
                                @empty
                                    <li class="text-danger"> {{__('No sub-category found')}}</li>
                                @endforelse
                            </ul>
                        @endif
                    </li>
                @empty 
                    {{-- <li class="text-danger">{{__('No categories found.')}}</li> --}}
                @endforelse
            </ul>
        </li>
        <li>
            <a href="#">Type</a>
            <ul>
                <li> <a href="">Image</a></li>
                <li> <a href="">Video</a></li>
            </ul>
        </li>
        <li>
            <div class="custom-control custom-switch mt-2  text-dark">
                <input type="checkbox" class="custom-control-input" id="switch1">
                <label class="custom-control-label text-dark" for="switch1">Prize</label>
              </div>
        </li>
      </ul> 
      

    
	
	
<section id="team" class="pb-5">
    <div class="container">
        <div class="row">
		@forelse($contests as $contest)
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center p-0">
								      <div class="view">
                    @if($contest->file_type=='image')
                        <i class="fa fa-image position-absolute p-2 bg-info text-white"></i>
                        <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail posiiton-relative">
                    @else
                        <i class="fa fa-video position-absolute p-2 bg-info text-white"></i>
                        <video src="{{asset('public/storage/'.$contest->file)}}" class="posiiton-relative" style="height:200px"></video>
                    @endif
                    <h6 class="text-white">{{$contest->title}}</h6>
                    <p class="text-muted">by <b>{{$contest->getCreator->username}}</b></p>

                    
                    
                    
									</div>                                                      
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-0 p-.25">
									<ul class="list-group list-group-flush">
									{{--<li class="list-group-item"><h6>RULES:<br>{{$contest->description}}</h6></li>--}}
										<li class="list-group-item"><h6>PRIZE:<br>
										@if(empty($contest->prize_description))
											<p class="text-warning">Prizeless</p>
										@else
											<p class="text-white">{{$contest->prize_description}}</p>
										@endif</h6></li>
										<li class="list-group-item"><h6>CATEGORY:<br>{{$contest->getCategory->name}} 
									{{!empty($contest->getSubCategory)? ' > '.$contest->getSubCategory->name :''}}</h6></li>
										<li class="list-group-item"><h6>Max {{$contest->participants}} contestants</h6></li>
									  </ul>

                                </div>
								 
    <a href="{{route('contest.show',$contest->id)}}">Details</a>

  
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        @empty 
            <h3 class="text-danger text-center">No contest found</h3>
        @endforelse
        {{$contests->links()}}
    </div>
</div>
</section>
<style>

	.img-thumbnail {
		padding: 0;
		background-color:transparent;
		border: none;
		border-radius: .25rem;
		max-width: 100%;
		height: auto;
	}

	.list-group-item {
		display: block;
		padding: .75rem 1.25rem;
		// margin-bottom: -1px;
		background-color: transparent;
		border: 1px solid #17a2b8;
	}
    .btn-primary:hover,
    .btn-primary:focus
    {
        background-color: #108d6f;
        border-color: #108d6f;
        box-shadow: none;
        outline: none;
    }

    .btn-primary
    {
        color: #fff;
        background-color: #305891;
        border-color: #305893;
    }

    section
    {
        padding: 60px 0;
    }

        section .section-title
        {
            text-align: center;
            color: #305893;
            margin-bottom: 50px;
            text-transform: uppercase;
        }

    #team .card
    {
        // border: none;
        // background: #ffffff;
    }

    .image-flip:hover .backside,
    .image-flip.hover .backside
    {
        -webkit-transform: rotateY(0deg);
        -moz-transform: rotateY(0deg);
        -o-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        transform: rotateY(0deg);
        border-radius: .25rem;
    }

    .image-flip:hover .frontside,
    .image-flip.hover .frontside
    {
        -webkit-transform: rotateY(180deg);
        -moz-transform: rotateY(180deg);
        -o-transform: rotateY(180deg);
        transform: rotateY(180deg);
    }

    .mainflip
    {
        -webkit-transition: 1s;
        -webkit-transform-style: preserve-3d;
        -ms-transition: 1s;
        -moz-transition: 1s;
        -moz-transform: perspective(1000px);
        -moz-transform-style: preserve-3d;
        -ms-transform-style: preserve-3d;
        transition: 1s;
        transform-style: preserve-3d;
        position: relative;
    }

    .frontside
    {
        position: relative;
        -webkit-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        z-index: 2;
        margin-bottom: 30px;
		overflow:hidden;
    }

    .backside
    {
        position: absolute;
        top: 0;
        left: 0;
        background: white;
        -webkit-transform: rotateY(-180deg);
        -moz-transform: rotateY(-180deg);
        -o-transform: rotateY(-180deg);
        -ms-transform: rotateY(-180deg);
        transform: rotateY(-180deg);
        -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    }

    .frontside,
    .backside
    {
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -ms-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transition: 1s;
        -webkit-transform-style: preserve-3d;
        -moz-transition: 1s;
        -moz-transform-style: preserve-3d;
        -o-transition: 1s;
        -o-transform-style: preserve-3d;
        -ms-transition: 1s;
        -ms-transform-style: preserve-3d;
        transition: 1s;
        transform-style: preserve-3d;
    }

        .frontside .card,
        .backside .card
        {
            min-height: 300px;
			max-height: 300px;
        }

            .backside .card a
            {
                font-size: 18px;
                color: #305893 !important;
            }

            .frontside .card .card-title,
            .backside .card .card-title
            {
                color: #305893 !important;
            }

            .frontside .card .card-body img
            {
                width: 100%;
                height: 200px;
                // border-radius: 50%;
            }
</style>


@endsection