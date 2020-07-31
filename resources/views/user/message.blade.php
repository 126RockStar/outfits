@extends('layouts.app')
@section('title') 
  Messages
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
            <a class="text-white" href="{{route('user.contests.created')}}">Created Contests</a>
        </li>
        <li class="border p-1">
            <a class="text-white" href="{{route('user.contests.joined')}}">Joined Contests</a>
        </li>
        <li class="bg-success mr-2 p-1 border">
            <a class="text-white" href="{{route('user.messages')}}">Messages</a>
        </li>		
    </ul><br><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
		   <div class="card">
                <div class="card-header text-capitalize">Messages</div>
					<div class="card-body">
                        <ul class="list-group">
                            @forelse($messages as $message)
                                <li  class="list-group-item bg-secondary {{(in_array(Auth::id(),json_decode($message->seen))?'text-white':'text-muted bg-light')}}">
                                    {{$message->message}}
                                    <a class="btn btn-danger btn-sm float-right" href="{{route('user.message.delete',$message->id)}}" onclick="return confirm('are you sure to delete?')"><i class="fa fa-trash"></i></a>
                                </li>
                                @if(!in_array(Auth::id(),json_decode($message->seen)))
                                    @php 
                                        $seenList=json_decode($message->seen);
                                        array_push($seenList,Auth::id());
                                        $message->seen=json_encode($seenList);
                                        $message->save();
                                    @endphp
                                @endif
                            @empty 
                                <h3 class="text-danger text-center">No Message</h3>
                            @endforelse
                            {{$messages->links()}}
                        </ul>
					</div>
				</div>
			</div>
         </div>
    </div>
</div>
@endsection
