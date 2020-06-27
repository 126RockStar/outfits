@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-capitalize">{{Auth::user()->type}} Dashboard</div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Welcome <b>{{Auth::user()->name}}</b></h1>
<!-- ---------------------------------------------------------referral link code not going to be used yet 
                    @if(Auth::user()->type=='user')
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
                    @endif
-->					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
