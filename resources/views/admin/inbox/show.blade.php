@extends('admin.master')

@section('title')
  Inbox
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">Inbox</li>
@endsection

@section('extra-css')
      <!-- third party css -->
      {{-- <link href="{{asset('public/admin/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('public/admin/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" /> --}}
      <!-- third party css end -->
      <style>
        /*/////////////////////////////////*/
/*/////////  chat styles  /////////*/
/*/////////////////////////////////*/
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 40px;
    padding-bottom: 5px;
    /* border-bottom: 1px dotted #B3A9A9; */
    margin-top: 10px;
    width: 80%;
}


.chat li .chat-body p
{
    margin: 0;
    /* color: #777777; */
}


.chat-care
{
    overflow-y: scroll;
    height: 350px;
}
.chat-care .chat-img
{
    width: 50px;
    height: 50px;
}
.chat-care .img-circle
{
    border-radius: 50%;
}
.chat-care .chat-img
{
    display: inline-block;
}
.chat-care .chat-body
{
    display: inline-block;
    max-width: 80%;
    background-color: #FFC195;
    border-radius: 12.5px;
    padding: 15px;
}
.chat-care .chat-body strong
{
  color: #0169DA;
}

.chat-care .admin
{
    text-align: right ;
    float: right;
}
.chat-care .admin p
{
    text-align: left ;
}
.chat-care .agent
{
    text-align: left ;
    float: left;
}
.chat-care .left
{
    float: left;
}
.chat-care .right
{
    float: right;
}

.clearfix {
  clear: both;
}




::-webkit-scrollbar-track
{
    box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
      </style>
@endsection

@section('contents')
<div class="content">
<div class="container">
    <a href="javascript:void(0);" class="btn btn-info m-2" data-toggle="modal" data-target="#new-message"><i class="mdi mdi-plus-circle mr-2"></i> New Message</a>

    <!-- New Message modal -->
    <div id="new-message" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                    <form action="{{ route('admin.inbox.store')}}" method="post" class="pl-3 pr-3">
                        @csrf
                        <div class="custom-control custom-checkbox float-right">
                            <input type="checkbox" class="custom-control-input" name="all_users" value="all" id="allUsers">
                            <label class="custom-control-label" for="allUsers">All Users?</label>
                        </div>
                        <div class="form-group" id="selected-users">
                            <label for="users">Users</label>
                            <select id="users" class="form-control select2 select2-multiple @error('users') is-invalid @enderror" name="users[]" placeholder="Write your message here" data-toggle="select2" multiple required>
                                @forelse ($users as $user)
                                    <option value="{{$user->id}}"{{old('message')}}>{{$user->username}}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @error('users')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Write your message here" required>{{old('message')}}</textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
        
                        <div class="form-group text-center">
                            <button class="btn btn-rounded btn-primary btn-block mt-4" type="submit">Send</button>
                        </div>

                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  <div class="row">
        <div class="col-sm-3 col-1" style="height: 80vh;overflow-y:scroll">
           
            @forelse($messageUsers as $msg)
                @php 
                    $message=App\Message::where('receivers',$msg->receivers)->orderBy('id','DESC')->first();
                @endphp
                <div class="media border p-2">
                {{-- <img src="img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;"> --}}
                <div class="media-body">
                    @if(count(json_decode($msg->receivers))==1)
                        @foreach (json_decode($msg->receivers) as $userID)
                            @php
                                $thisUser=App\User::where('id',$userID)->first();
                            @endphp
                        @endforeach
                        @if(!empty($thisUser))
                            <a href="{{route('admin.inbox.show',$message->id)}}"><h4>{{$thisUser->username}}<span class="badge badge-danger ml-1">2</span></h4></a>
                        @else 
                            <a href="{{route('admin.inbox.show',$message->id)}}"><h4 class="text-danger">User Deleted<span class="badge badge-danger ml-1">2</span></h4></a>
                        @endif
                    @else
                        <a href="{{route('admin.inbox.show',$message->id)}}"><h4>{{App\User::where('type','!=','admin')->get()->count()==count(json_decode($msg->receivers))?'All':count(json_decode($msg->receivers))}} Users<span class="badge badge-danger ml-1">2</span></h4></a>
                    @endif
                </div>
              </div>
            @empty 

            @endforelse
        </div>
        <div class="col-sm-9 col-11">
            <div class="card">
                <div class="card-header text-center">
                    <span>Chat Box</span>
                </div>
                <div class="card-body chat-care">
                    <ul class="chat">
                        <li class="agent clearfix">
                            <span class="chat-img left clearfix mx-2">
                                <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="Agent" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </li>
                        <li class="admin clearfix">
                            <span class="chat-img right clearfix  mx-2">
                                <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="Admin" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <small class="left text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="agent clearfix">
                            <span class="chat-img left clearfix mx-2">
                                <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="Agent" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </li>
                        <li class="admin clearfix">
                            <span class="chat-img right clearfix  mx-2">
                                <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="Admin" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <small class="left text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                    <strong class="right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-primary" id="btn-chat">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div> <!-- content -->


@endsection
@section('extra-scripts')

   <!-- demo app -->
   {{-- <script src="{{asset('public/admin/js/pages/demo.customers.js')}}"></script>
   <script src="{{asset('public/admin/js/jquery.dataTables.min.js')}}"></script> --}}
   <!-- end demo js-->
   <script>
     $(document).ready( function () {
       $('#myTable').DataTable();
     });

    $("#allUsers").click(function(){
        if($('input[name="all_users"]').is(':checked'))
        {
            $("#users").removeAttr('required');
            $("#selected-users").hide();
        }else{
            $("#users").attr('required','');
            $("#selected-users").show();
        }
     });
   </script>
@endsection
