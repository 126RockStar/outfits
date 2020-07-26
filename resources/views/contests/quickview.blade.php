@extends('layouts.app')
@section('title') 
  Quickview
@endsection
@section('styles') 
  <style>

  </style>
@endsection

@section('scripts') 

@endsection

@section('content')
  <div class="container" style="margin-top:30px;min-height:60vh">
    <div class="list-group">
      @forelse($quickViewContests as $contest)
        <a href="{{route('contest.show',$contest->id)}}" class="list-group-item list-group-item-action">
          <img src="{{asset('public/storage/'.$contest->thumbnail)}}" alt="{{$contest->title}}" title="{{$contest->title}}" class="mr-3 mt-3 img-thumbnail float-left" style="width:60px;">
          @if(!empty($contest->prize_description))
            <i class="fa fa-award fa-4x float-right text-warning" title="Prized"></i>
          @endif
          <h4>
            {{$contest->title}} 
            @if(!empty($contest->amIjoined))
              <i class="fa fa-user-check text-success" title="joined"></i>
            @endif
          </h4>
          <p>{{$contest->participants-$contest->getParticipants->count()}} left</p>
          
        </a>
      @empty 

      @endforelse
    </div> 
    {{-- {{$quickViewContests->links()}} --}}
    
  </div>
@endsection
