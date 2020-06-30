@extends('layouts.app')

@section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="text-center" style="font-size:30px">Character Fashion Contests and more!</div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        @forelse($contests as $contest)
        <div class="col-md-4">
            <div class="card">
            <div class="card-header text-capitalize">{{$contest->getCategory->name}} 

                {{!empty($contest->getSubCategory)? ' > '.$contest->getSubCategory->name :''}}
                ({{$contest->participants}} participants)</div>
                <div class="card-body">
                    
                    <img src="{{asset('public/storage/'.$contest->photo)}}" class="img img-thumbnail" style="width:100%">
                    <h1>{{$contest->title}}</h1>
                    <p>{{$contest->description}}</p>
                    <p>{{$contest->prize_description}}</p><hr>
                 
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
