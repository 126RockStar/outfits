@extends('layouts.app')
@section('title') 
  Home
@endsection
@section('styles') 
  <style>
    .fakeimg {
      height: 200px;
      background: #aaa;
    }

    .GeneratedMarquee {
      font-family:'Comic Sans MS';
      font-size:1em;
      line-height:1.3em;
      color:white;
      // background-color:#CCFFFF;
      padding:1.5em;

    }

  </style>
@endsection

@section('scripts') 

@endsection

@section('content')



<div class="card" style="margin-bottom:0">
  <div class="text-center" style="font-size:30px">Character Fashion Contests and more!</div>
</div>
<div class="container" style="margin-top:30px">
  <div class="row">
     <div class="col-sm-3">
        <div class="card p-2">
          <h5>Verified Users: <b>{{App\User::whereNotNull('email_verified_at')->get()->count()}}</b></h5>
          <h5>Open Contests: <b>{{App\Contest::where('status','open')->get()->count()}}</b></h5>
          <h5>Image Contests: <b>{{App\Contest::where('file_type','image')->get()->count()}}</b></h5>
          <h5>Video Contests: <b>{{App\Contest::where('file_type','video')->get()->count()}}</b></h5>
           <!-- HTML Code -->
           <marquee class="GeneratedMarquee" direction="left" scrollamount="4" behavior="scroll">Dog contest... Funny hair contest... Most bestest contest... Contest for poor people</marquee>
        </div>
        <h3>Some Links</h3>
        <ul class="nav nav-pills flex-column">
           <li class="nav-item">
              <a class="nav-link active" href="#">Link</a>
           </li>
           <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
           </li>
           <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
           </li>
           <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
           </li>
        </ul>
        <hr class="d-sm-none">
     </div>
     <div class="col-sm-9">
      <h2 class="mb-4"> Latests Contest <small><a  class="" href="{{route('contests')}}">Browse more</a></small></h2>
      <div class="row">
            @forelse ($latestContests as $latestContest)
              <div class="col-sm-4">
                <a href="{{route('contest.show',$latestContest->id)}}"class="card d-block position-absolute" style="height:240px;overflow:hidden">
                  @if($latestContest->file_type=='image')
                    <i class="fa fa-image position-absolute p-2 bg-info text-white"></i>
                    <img src="{{asset('public/storage/'.$latestContest->file)}}" class="img img-thumbnail posiiton-relative">
                  @else
                      <i class="fa fa-video position-absolute p-2 bg-info text-white"></i>
                      <video src="{{asset('public/storage/'.$latestContest->file)}}" class="img img-thumbnail posiiton-relative" style="height:200px"></video>
                  @endif
                  <h4>{{Str::limit($latestContest->title,20)}}</h4>
                </a>
              </div>
            @empty
                
            @endforelse
        
        </div>
     </div>
  </div>
</div>



@endsection
