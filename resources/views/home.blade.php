@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Welcome <b>{{Auth::user()->username}}</b></h1>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link text-info {{!isset($_GET['joined'])?'active':''}}" href="{{route('user.dashboard')}}">My Created</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-info {{isset($_GET['joined'])?'active':''}}" href="{{route('user.dashboard','joined')}}">Joined({{count($participatedContests)}})</a>
        </li>
      </ul> 
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-capitalize">Contests <a href="{{route('user.contests.create')}}"class="btn btn-success btn-lg float-right">Create Contest</a></div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        @forelse($contests as $contest)
                        <div class="col-md-4">
                            <div class="card">
                            <div class="card-header text-capitalize">{{$contest->getCategory->name}} 

                                {{!empty($contest->getSubCategory)? ' > '.$contest->getSubCategory->name :''}}
                                ({{count($contest->getParticipants)}} of {{$contest->participants}} participants)</div>
                                <div class="card-body">
                                    <a href="{{route('contest.show',$contest->id)}}">
                                    @if($contest->file_type=='image')
                                        <i class="fa fa-image position-absolute p-2 bg-info text-white"></i>
                                        <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail posiiton-relative" style="width:100%">
                                    @else
                                        <i class="fa fa-video position-absolute p-2 bg-info text-white"></i>
                                        <video src="{{asset('public/storage/'.$contest->file)}}" class="posiiton-relative" width="100%"></video>
                                    @endif
                                    <h2 class="text-white">{{$contest->title}}</h2>
                                    <p class="text-muted">by <b>{{$contest->getCreator->username}}</b></p>
                                    <p class="text-white">{{$contest->description}}</p>
                                    @if(empty($contest->prize_description))
                                        <p class="text-warning">no prize for this contest</p>
                                    @else
                                        <p class="text-white">{{$contest->prize_description}}</p>
                                    @endif
                                    </a>
                                    <hr>
                                    @if(count($contest->getParticipants)<2 && $contest->user_id==Auth::id())
                                        <a href="{{route('user.contests.edit',$contest->id)}}" class="btn btn-info float-right"><i class="fa fa-edit"></i></a>
                                        <form action="{{route('user.contests.destroy',$contest->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure to delete the contest')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    @else
                                        @if(!isset($_GET['joined']))
                                            <p class="text-danger">Contest can't modifed as users participated</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty 
                            @isset($_GET['joined'])
                                <h3 class="text-danger text-center">You haven't joined any contest yet</h3>
                            @else
                                <h3 class="text-danger text-center">You haven't added any contest yet</h3>
                            @endisset
                        @endforelse
                        {{$contests->links()}}
                    </div>

                    {{-- @if(Auth::user()->type=='user')
                        <br><br>
                        <div class="col-sm-8 d-flex flex-column align-items-center justify-content-center">
                            <h4 class="text-dark mb-8pt">Refer your friends by this link and get bonus</h4>
                            <div class="input-group">
                            <input class="form-control" value="{{ route('register','refer='.Auth::user()->id) }}" id="copyLink" onclick="document.getElementById('copyLink').select();document.execCommand('copy');alert('link is copied to your clipboard')"  type="text">
                            <div class="input-group-prepend p-0">
                                <button class="btn btn-primary" type="button" onclick="document.getElementById('copyLink').select();document.execCommand('copy');alert('link is copied to your clipboard')" ><i class="fa fa-copy"></i> Copy</button>
                            </div>
                            </div>
                        </div>
                        <h4 class="mt-5 text-dark">Users who joined by your referral link</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Joined at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($referredUsers as $referredUser)
                                    <tr>
                                        <td>{{$referredUser->name}}</td>
                                        <td>{{date('d M Y',strtotime($referredUser->created_at))}}</td>
                                    </tr>
                                @empty 
                                    <tr><td colspan="2" class="text-danger">No users joined with your referral link</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    @endif --}}
			
                </div>
            </div>
        </div>
    </div>
 
</div>
@endsection
