@extends('admin.master')

@section('title')
    Outbox
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">Outbox</li>
@endsection

@section('extra-css')
      <!-- third party css -->
      <link href="{{asset('public/admin/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('public/admin/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
      <!-- third party css end -->
      <style>

      </style>
@endsection

@section('contents')
<div class="content">
<form method="POST" action="{{route('admin.messages.selected')}}" class="container">
    @csrf
    <a href="javascript:void(0);" class="btn btn-info m-2" data-toggle="modal" data-target="#new-message"><i class="mdi mdi-plus-circle mr-2"></i> New Message</a>
    <button type="submit" onclick="return confirm('Are you sure to delete the selected contests?')" class="btn btn-danger m-2 float-left" ><i class="mdi mdi-delete-sweep  mr-2"></i> Delete Selected</button>
         
    <div class="table-responsive">
        <table class="table table-centered table-bordered dt-responsive nowrap w-100" id="myTable">
            <thead>
                <tr>
                    <th><input type="checkbox" name="check_all" id="check_all"> <label for="check_all">All</label></th>
                    <th>To</th>
                    <th>Message</th>
                    <th>Seen By</th>
                    <th>Deleted By</th>
                    <th style="width: 75px;">Action</th>
                </tr>
            </thead>
            <tbody>
              @forelse($messages as $message)
                <tr>
                    <td><input type="checkbox" name="checked_messages[]" value="{{$message->id}}"></td>
                    <td>
                        @if(count(json_decode($message->receivers))==1)
                            @foreach (json_decode($message->receivers) as $userID)
                                @php
                                    $thisUser=App\User::where('id',$userID)->first();
                                @endphp
                            @endforeach
                            @if(!empty($thisUser))
                                <h4>{{$thisUser->username}}</h4>
                            @else 
                                <h4 class="text-danger">User Deleted</h4>
                            @endif
                        @else
                            <h4>{{App\User::where('type','!=','admin')->get()->count()==count(json_decode($message->receivers))?'All':count(json_decode($message->receivers))}} Users</h4>
                        @endif    
                    </td>
                    
                    <td>{{$message->message}}</td>

                    <td>
                        {{-- @forelse(json_decode($message->seen) as $key=>$userID)
                        @php 
                            $userDetails=App\User::where('id',$userID)->first();
                        @endphp
                            <span>{{$key==0?'':','}}{{$userDetails->username}}</span>
                        @empty
                            <span class="text-danger">No Users</span>
                        @endforelse --}}
                        {{App\User::where('type','!=','admin')->get()->count()==count(json_decode($message->seen))?'All':count(json_decode($message->seen))}} Users
                    </td>
                    <td>
                        {{App\User::where('type','!=','admin')->get()->count()==count(json_decode($message->deleted))?'All':count(json_decode($message->deleted))}} Users
                    </td>

                    <td>
                        <a href="{{route('admin.message.delete',$message->id)}}" onclick="return confirm('Are you sure to delete the message?')" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td collspan="5" class="text-danger">No message Found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

  {{-- <div class="row">
        <div class="col-sm-3 col-1 border" style="height: 80vh;overflow-y:scroll">
            @forelse($messageUsers as $msg)
                @php 
                    $message=App\Message::where('receivers',$msg->receivers)->orderBy('id','DESC')->first();
                @endphp
                <div class="media border p-2">
                <img src="img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
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
            <h4 class="text-danger">Select a chat to show details</h4>
        </div>
    </div> --}}
</form>
    </div> <!-- content -->

<!-- New Message modal -->
<div id="new-message" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <form action="{{ route('admin.outbox.store')}}" method="post" class="pl-3 pr-3">
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

@endsection
@section('extra-scripts')

   <!-- demo app -->
   <script src="{{asset('public/admin/js/pages/demo.customers.js')}}"></script>
   <script src="{{asset('public/admin/js/jquery.dataTables.min.js')}}"></script>
   <!-- end demo js-->
   <script>
       function submitSelectedForm(){
           $('#selectedForm').submit();
       } 
    $(document).ready( function () {
       $('#myTable').DataTable({"pageLength": 50});
     });

     $("input[name=check_all]").click(function(){
        $('input:checkbox[name="checked_messages[]"]').not(this).prop('checked', this.checked);
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
