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
         <h5>Prizes: <b>{{App\Contest::whereNotNull('prize_description')->get()->count()}}</b></h5>		  
		  <h5>In Judging: <b>{{App\Contest::where('status','judge')->get()->count()}}</b></h5>
           <!-- HTML Code -->
           <marquee class="GeneratedMarquee" direction="left" scrollamount="4" behavior="scroll">Dog contest... Funny hair contest... Most bestest contest... Contest for poor people</marquee>
        </div>
        <hr class="d-sm-none">
     </div>
     <div class="col-sm-9">
      <h2 class="mb-4"> Latest Contests <small><a  class="" href="{{route('contests')}}">Browse more</a></small></h2>
      <hr style="border-color: lightgrey">
      <div class="row">
            @forelse ($latestContests as $latestContest)
              <div class="col-sm-4">
                <a href="{{route('contest.show',$latestContest->id)}}" class="border d-block">
                  <div class="position-relative" style="background: url({{asset('public/storage/'.$latestContest->thumbnail)}}); background-size:cover;background-position:center center;height:240px;filter:brightness(50%)" width="100%">
                    
                  </div>
                  @if($latestContest->file_type=='image')
                      <i class="fa fa-image p-2 bg-info text-white  position-absolute" style="top:0px"></i>
                  @else
                    <i class="fa fa-video p-2 bg-info text-white position-absolute" style="top:0px"></i>
                  @endif
                  <h4 class="mt-1 text-white position-absolute" style="bottom:0px;">{{Str::limit($latestContest->title,20)}}</h4>
                </a>
              </div>
            @empty
            <p class="text-danger">No contests found</p>
            @endforelse
      </div>
      

      <h2 class="mb-4 mt-4"> Featured Contests <small><a  class="" href="{{route('contests')}}">Browse more</a></small></h2>
      <hr style="border-color: lightgrey">
      <div class="row">
            @forelse ($featuredContests as $featuredContest)
              <div class="col-sm-4">
                <a href="{{route('contest.show',$featuredContest->id)}}" class="border d-block">
                  <div class="" style="background: url({{asset('public/storage/'.$featuredContest->thumbnail)}}); background-size:cover;background-position:center center;height:240px;" width="100%">
                  </div>
                  @if($featuredContest->file_type=='image')
                    <h4 class="mt-1 text-white"><i class="fa fa-image p-2 bg-info text-white"></i>
                  @else
                   <h4 class="mt-1 text-white"> <i class="fa fa-video p-2 bg-info text-white"></i>
                  @endif
                  {{Str::limit($featuredContest->title,20)}}</h4>
                </a>
              </div>
            @empty
                <p class="text-danger">No contests found</p>
            @endforelse
      </div>
    </div>
  </div>
</div>



@endsection
