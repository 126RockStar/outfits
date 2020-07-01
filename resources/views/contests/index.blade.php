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


<style>

.list-group-item {
    display: block;
    padding: .75rem 1.25rem;
    // margin-bottom: -1px;
    background-color: transparent;
    border: 1px solid #17a2b8;
}

</style>


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
										<img src="{{asset('public/storage/'.$contest->photo)}}" class="card-img-top" alt="photo">
										<a href="#">
										  <div class="mask rgba-white-slight"></div>
										</a>
									  </div>                                                      
                                   <h5>{{$contest->title}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-0 p-.25">
									<ul class="list-group list-group-flush">
									{{--<li class="list-group-item"><h6>RULES:<br>{{$contest->description}}</h6></li>--}}
										<li class="list-group-item"><h6>PRIZE:<br>{{$contest->prize_description}}</h6></li>
										<li class="list-group-item"><h6>CATEGORY:<br>{{$contest->getCategory->name}} 
									{{!empty($contest->getSubCategory)? ' > '.$contest->getSubCategory->name :''}}</h6></li>
										<li class="list-group-item"><h6>Max {{$contest->participants}} contestants</h6></li>
									  </ul>

                                </div>
								 
    <a href="#" class="card-link">Details</a>

  
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
        border: none;
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
            min-height: 375px;
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
                height: 300px;
                // border-radius: 50%;
            }
</style>


@endsection
