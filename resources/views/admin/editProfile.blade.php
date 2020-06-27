@extends('admin.master')

@section('title')
  Edit Profile
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">{{__('Edit Profile')}}</li>
@endsection
@section('extra-css')
    <link href="{{ asset('public/admin/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/css/vendor/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('contents')
<!-- Header Layout Content -->
     <div class="mdk-header-layout__content page-content pt-3">
         <div class="container page__container">
             <form action="{{route('user.updateProfile')}}" method="post" enctype="multipart/form-data">
               @csrf
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="page-section">
                             <div class="list-group list-group-form">
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Your photo</label>
                                         <div class="col-sm-9 media align-items-center">
                                             <a href="{{asset('public/storage/'.Auth::user()->profile_picture)}}" class="media-left mr-16pt">
                                                 <img src="{{asset('public/storage/'.Auth::user()->profile_picture)}}" alt="people" width="56" class="rounded-circle" />
                                             </a>
                                             <div class="media-body">
                                                 <div class="custom-file">
                                                     <input type="file" name="profile_picture" class="custom-file-input" id="inputGroupFile01">
                                                     <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Name</label>
                                         <div class="col-sm-9">
                                             <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" placeholder="Your profile name ...">
                                             <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">Email</label>
                                         <div class="col-sm-9">
                                             <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" placeholder="Your profile email ...">
                                             <!-- <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small> -->
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">School</label>
                                         <div class="col-sm-9">
                                           <div class="form-group">
                                               <select data-toggle="select2" class="{{ $errors->has('school') ? ' is-invalid' : '' }}" id="course-category" name="school" title="school" required>
                                                   <option value="">Select School</option>
                                                   @forelse($schools as $school)
                                                     <option value="{{$school->id}}" {{ Auth::user()->school ==  $school->id ? 'selected': ''}}>{{$school->name}}</option>
                                                   @empty
                                                     <option value=""class="text-danger"> No School Found</option>
                                                   @endforelse
                                               </select>
                                               @if ($errors->has('school'))
                                                   <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $errors->first('school') }}</strong>
                                                   </span>
                                               @endif
                                           </div>
                                           <a href="{{route('admin.schools.create')}}">Not finding your school? create new here</a>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="form-group row mb-0">
                                         <label class="col-form-label col-sm-3">About</label>
                                         <div class="col-sm-9">
                                             <textarea name="about" rows="3" id="editor" class="form-control" placeholder="About you ...">{{Auth::user()->about}}</textarea>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                   <div class="row">
                                     <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       <label for="oldPassword">Current Password</label>
                                       <input type="password"  name="oldPassword" class="form-control" id="oldPassword" placeholder="must provide to update profile" required />
                                       @if ($errors->has('oldPassword'))
                                           <span class="help-block  text-danger">
                                               <strong>{{ $errors->first('oldPassword') }}</strong>
                                           </span>
                                       @endif
                                     </div>


                                     <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       <label for="newPassword">New Password</label>
                                       <input type="password" name="password" class="form-control" id="newPassword" placeholder="Keep blank for not changing password"/>
                                       @if ($errors->has('password'))
                                           <span class="help-block text-danger">
                                               <strong>{{ $errors->first('password') }}</strong>
                                           </span>
                                       @endif
                                     </div>
                                     <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       <label for="confirmPassword">Re-type New Password</label>
                                       <input type="password"  name="password_confirmation" class="form-control" id="confirmPassword" placeholder="Keep blank for not changing password"/>

                                       @if ($errors->has('password_confirmation'))
                                           <span class="help-block text-danger">
                                               <strong>{{ $errors->first('password_confirmation') }}</strong>
                                           </span>
                                       @endif
                                     </div>

                                   </div>
                                 </div>
                                 <div class="list-group-item">
                                     <button type="submit" class="btn btn-accent">Save changes</button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
     <!-- // END Header Layout Content -->
@endsection

@section('extra-scripts')
<link href="{{ asset('public/admin/trumbowyg/ui/trumbowyg.min.css') }}" rel="stylesheet"><!-- editor for publishing post-->
<script src="{{ asset('public/admin/trumbowyg/trumbowyg.min.js') }}" ></script><!-- editor for publishing post-->

<link href="{{ asset('public/admin/trumbowyg/plugins/colors/ui/trumbowyg.colors.min.css')}}" rel="stylesheet"> <!-- color plugin-->
<script src="{{ asset('public/admin/trumbowyg/plugins/colors/trumbowyg.colors.min.js') }}" ></script><!-- color plugin-->

<link href="{{ asset('public/admin/trumbowyg/plugins/emoji/ui/trumbowyg.emoji.min.css')}}" rel="stylesheet"> <!-- emoji plugin-->
<script src="{{ asset('public/admin/trumbowyg/plugins/emoji/trumbowyg.emoji.min.js') }}" ></script><!-- emoji plugin-->

<link href="{{ asset('public/admin/trumbowyg/plugins/table/ui/trumbowyg.table.min.css')}}" rel="stylesheet"> <!-- table plugin-->
<script src="{{ asset('public/admin/trumbowyg/plugins/table/trumbowyg.table.min.js') }}" ></script><!-- table plugin-->

<link href="{{ asset('public/admin/trumbowyg/plugins/mention/ui/trumbowyg.mention.min.css')}}" rel="stylesheet"> <!-- mention plugin work further-->
<script src="{{ asset('public/admin/trumbowyg/plugins/mention/trumbowyg.mention.min.js') }}" ></script><!-- mention plugin-->


<script src="{{ asset('public/admin/trumbowyg/plugins/history/trumbowyg.history.min.js') }}" ></script><!-- undo redo plugin-->
<script src="{{ asset('public/admin/trumbowyg/plugins/fontfamily/trumbowyg.fontfamily.min.js') }}" ></script><!-- undo redo plugin-->

<script>
$('#editor').trumbowyg({
  btns: [
    ['historyUndo', 'historyRedo'],
    ['fontfamily'],
    ['strong', 'em', 'del',],
    ['superscript', 'subscript'],
    ['formatting'],
    ['foreColor', 'backColor'],
    ['link'],
    //['mention'], need to work further
    ['emoji'],
    ['horizontalRule'],
    ['unorderedList', 'orderedList'],
    ['table'],
    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
    ['removeformat']
  ]
});
</script>
@endsection
