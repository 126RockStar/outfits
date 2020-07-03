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
     
    <div class="row">
        <ul class="navbar-nav mr-auto sm sm-clean col-2" id="categoryMenu">
                        
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
        </ul>
    </div>
    


     
    <br><br><br>
    <div class="row">
        @forelse($contests as $contest)
        <div class="col-md-4">
            <div class="card">
            <div class="card-header text-capitalize">{{$contest->getCategory->name}} 

                {{!empty($contest->getSubCategory)? ' > '.$contest->getSubCategory->name :''}}
                ({{$contest->participants}} participants)</div>
                <div class="card-body">
                    @if($contest->file_type=='image')
                        <i class="fa fa-image position-absolute p-2 bg-info"></i>
                        <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail posiiton-relative" style="width:100%">
                    @else
                        <i class="fa fa-video position-absolute p-2 bg-info"></i>
                        <video src="{{asset('public/storage/'.$contest->file)}}" class="posiiton-relative" width="100%"></video>
                    @endif
                    <h1>{{$contest->title}}</h1>
                    <p>{{$contest->description}}</p>
                    @if(empty($contest->prize_description))
                        <p class="text-warning">no prize for this contest</p>
                    @else
                        <p>{{$contest->prize_description}}</p>
                    @endif
                 
                </div>
            </div>
        </div>
        @empty 
            <h3 class="text-danger text-center">No contest found</h3>
        @endforelse
        {{$contests->links()}}
    </div>
</div>
@endsection
