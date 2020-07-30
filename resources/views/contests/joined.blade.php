@extends('layouts.app')
@section('title') 
  Joined Contests
@endsection
@section('content')
<div class="container">
        
        <ul class="nav nav-pills">

            <li class="mr-2 p-1 border">
                <a class="text-white" href="{{route('user.contests.created')}}">Created Contests</a>
            </li>
            <li class="bg-success border p-1">
                <a class="text-white" href="{{route('user.contests.joined')}}">Joined Contests</a>
            </li>
            <li class="mr-2 p-1 border">
                <a class="text-white" href="{{route('user.dashboard')}}">Messages</a>
            </li>			
        </ul><br><br>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-capitalize">Joined Contests</div>
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
                                </div>
                            </div>
                        </div>
                        @empty 
                            <h3 class="text-danger text-center">You haven't joined any contest yet</h3>
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
