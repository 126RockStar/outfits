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
.text-info {
    color: #ffffff!important;
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
<div class="container">
                  <div class="float-right">Contests({{count($allCreatedContests)}} of {{Auth::user()->max_contests}}) 
                    @if(count($allCreatedContests)<Auth::user()->max_contests) 
                        <a href="{{route('user.contests.create')}}"class="btn btn-primary float-right" style="width:8rem;margin-left: 1rem;"> Create Contest</a>
                    @endif
                </div> 

    <ul class="nav nav-tabs">

        <li class="nav-item">
          <a class="nav-link text-info " href="{{route('user.dashboard')}}">Created</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-info" href="{{route('user.contests.joinded')}}">Joined</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-info active" href="{{route('user.messages')}}">Message</a>
          </li>		
    </ul> 
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
                        <div class=" col-md-4">
                            <div class="card mb-3" style="min-height:8.5rem">
                                      <!-- Button to Open the Modal -->			
                            <div class="card-header text-center pt-1 pb-1"><h5>{{count($contest->getParticipants)}} of {{$contest->participants}} players</h5>
                            </div>
                                <div class="card-body pb-0">
								
<!--                                    <a href="{{route('contest.show',$contest->id)}}">
                                    @if($contest->file_type=='image')
                                        <i class="fa fa-image position-absolute p-2 bg-info text-white"></i>
                                        <img src="{{asset('public/storage/'.$contest->file)}}" class="img img-thumbnail posiiton-relative" style="width:100%">
                                    @else
                                        <i class="fa fa-video position-absolute p-2 bg-info text-white"></i>
                                        <video src="{{asset('public/storage/'.$contest->file)}}" class="posiiton-relative" width="100%"></video>
                                    @endif
-->									
                                
                                    <h6 class="text-white text-center" style="min-height:43px">{{$contest->title}}</h6>
 <!--                                   @if(empty($contest->prize_description))
                                        <p class="text-warning">no prize for this contest</p>
                                    @else
                                        <p class="text-white">{{$contest->prize_description}}</p>
                                    @endif -->
<!--                                    </a>  -->
                                    <div class="card-footer">
                                    @if(count($contest->getParticipants)<2)
                                        <a href="{{route('user.contests.edit',$contest->id)}}" class="btn btn-info float-right"><i class="fa fa-edit"></i></a>
                                        <form action="{{route('user.contests.destroy',$contest->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
											 </form>
											 @else
                                        <span class="text-danger">No Edit</span>
                                    @endif
									@if(count($contest->getParticipants)<2)
										
                                            <button type="submit" onclick="return confirm('Are you sure to delete the contest')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
											
											 @else
                                        
                                    @endif
											<button type="button" class="btn btn-primary editPost" data-id="{{$contest->id}}" data-post="{{$contest->post}}" data-toggle="modal" data-target="#editPost">
                                        Post
                                    </button>
									<a href="{{route('contest.show',$contest->id)}}" class="btn btn-primary">
                                        View
                                    </a>
                                        

									</div>
                                </div>
                            </div>
                        </div>
                        @empty 
                            <h3 class="text-danger text-center">You haven't added any contest yet</h3>
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

                     <!-- The Modal -->
                     <div class="modal fade" id="editPost">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" class="modal-content" action="{{ route('user.contest.post.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$contest->id}}">
                    
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Post</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                    <div class="form-group">
                                            <textarea id="post" type="text" class="form-control @error('post') is-invalid @enderror" name="post" required autocomplete="post" autofocus>{{$contest->post}}</textarea>
                                            @error('post')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                            </div>
                    
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>
				</div>
			</div>	
        </div>
    </div>
 </div>
</div>
@endsection
