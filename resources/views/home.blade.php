@extends('layouts.app')
@section('title') 
  Dashboard
@endsection
@section('styles') 
<style>
.btn {
    padding: .05rem .5rem;
    border-radius: 1rem;
}
.btn-primary {
    width: 37%;
	margin-bottom: .5rem;
}
.card-body {
    padding: .75rem;
}
.card-footer {
    padding: 0;
}
.nav-tabs {
    border-bottom: none;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    background-color: #17a2b8;
    border:none;
}
</style>
@endsection
@section('scripts') 
 <script>
     $('.editPost').click(function(){
        var id=$(this).attr('data-id');
        var post=$(this).attr('data-post');
        $("input[name=id]").val(id);
        $("textarea[name=post]").val(post);
     });

 </script>
@endsection
@section('content')
<div class="container"><br><br>
    

    <ul class="nav nav-pills">
        <li class="mr-2 p-1 border">
            <a class="text-white" href="{{route('user.contests.judging')}}">Contests in Judge</a>
        </li>
        <li class="mr-2 p-1 border">
            <a class="text-white" href="{{route('user.contests.created')}}">Created Contests</a>
        </li>
        <li class="border p-1">
            <a class="text-white" href="{{route('user.contests.joined')}}">Joined Contests</a>
        </li>
        <li class="mr-2 p-1 border">
            <a class="text-white" href="{{route('user.messages')}}">Messages</a>
        </li>		
    </ul><br><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
		   <div class="card">
                <div class="card-header text-capitalize">Dashboard</div>
					<div class="card-body">
                       
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
</div>
@endsection
