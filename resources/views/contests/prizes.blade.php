@extends('layouts.app')
@section('title') 
  Prizes
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
      @forelse($prizedContests as $contest)
        <a href="{{route('contest.show',$contest->id)}}" class="list-group-item list-group-item-action">
          <img src="{{asset('public/storage/'.$contest->thumbnail)}}" alt="{{$contest->title}}" title="{{$contest->title}}" class="mr-3 mt-3 rounded-circle float-left" style="width:60px;">
          {{$contest->prize_description}}
          @if($contest->is_prize_featured==1)
            <i class="fa fa-certificate fa-4x float-right text-warning"></i>
          @endif
        </a>
      @empty 

      @endforelse
    </div> 
    {{$prizedContests->links()}}
    
  </div>
@endsection
