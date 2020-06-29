@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome <b>{{Auth::user()->username}}</b></h1>
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
                        {{-- @forelse($contests as $contest)
                        <div class="col-md-4">
                            <div class="card">
                            <div class="card-header text-capitalize">{{$contest->getCategory->name}} > {{$contest->getSubCategory->name}}({{$contest->participants}} participants)</div>
                                <div class="card-body">
                                    
                                    <img src="{{asset('public/storage/'.$contest->photo)}}" class="img img-thumbnail" style="width:100%">
                                    <h1>{{$contest->title}}</h1>
                                    <p>{{$contest->description}}</p>
                                    <p>{{$contest->prize_description}}</p><hr>
                                    <form action="{{route('user.contests.destroy',$contest->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure to delete the contest')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                            
                                </div>
                            </div>
                        </div>
                        @empty 
                            <h3 class="text-danger text-center">You haven't added any contest yet</h3>
                        @endforelse
                        {{$contests->links()}} --}}
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
