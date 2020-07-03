@extends('layouts.app')

@section('styles')
@endsection
@section('scripts')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if($contest->file_type=='image')
            <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail" style="width:100%">
        @else
            <video src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail" width="100%" controls></video>
        @endif
        </div>
        <div class="col-md-6">
            <h1 class="text-white">{{$contest->title}}</h1>
            <p class="text-muted">by <b>{{$contest->getCreator->username}}</b></p>
            @if(empty($contest->prize_description))
                <p class="text-warning">no prize for this contest</p>
            @else
                <p class="text-white">{{$contest->prize_description}}</p>
            @endif
            <button type="button" class="btn btn-success">Join</button>
        </div>
    </div>
   
   
</div>
 <div class="container">
    
    <hr>
    <p class="text-white">{{$contest->description}}</p>
</div>
@endsection
