@extends('admin.master')

@section('title')
    User Verification
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('User Verification')}}</li>
@endsection

@section('extra-css')
    <!-- third party css -->
    <link href="{{asset('public/admin/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/admin/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
@endsection

@section('contents')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Profile 2</li>
                        </ol>
                    </div>
                    <h4 class="page-title">User Verification Request</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{asset('public/storage/'.$user->profile_picture)}}" class="rounded-circle avatar-lg img-thumbnail"
                             alt="profile-image">

                        <h4 class="mb-0 mt-2">{{$user->nick_name}}</h4>
                        <p class="text-muted font-14">{{$user->designation}}</p>

{{--                        <button type="button" class="btn btn-success btn-sm mb-2">Follow</button>--}}
{{--                        <button type="button" class="btn btn-danger btn-sm mb-2">Message</button>--}}
                        @if($verification->status=='rejected')
                            <a href="{{route('admin.verify.user.approve',[$verification->id,$verification->user_id])}}" onclick="alet('are you sure to approve?')" class="btn btn-success btn-sm"></i>Approve</a>
                        @elseif($verification->status=='approved')
                            <a href="{{route('admin.verify.user.reject',[$verification->id,$verification->user_id])}}" onclick="alet('are you sure to reject?')" class="btn btn-warning btn-sm">Reject</a>
                        @else
                            <a href="{{route('admin.verify.user.reject',[$verification->id,$verification->user_id])}}" onclick="alet('are you sure to reject?')" class="btn btn-warning btn-sm">Reject</a>
                            <a href="{{route('admin.verify.user.block',[$verification->id,$verification->user_id])}}" onclick="alet('are you sure to block?')" class="btn btn-danger btn-sm">Block</a>
                        @endif

                        <div class="text-left mt-3">
                            <h4 class="font-13 text-uppercase">About:</h4>
{{--                            <p class="text-muted font-13 mb-3">--}}
{{--                                Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the--}}
{{--                                1500s, when an unknown printer took a galley of type.--}}
{{--                            </p>--}}


                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{$user->phone}}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$user->email}}</span></p>

                        </div>

                        <ul class="social-list list-inline mt-3 mb-0">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                        class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                        class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                        class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                        class="mdi mdi-github-circle"></i></a>
                            </li>
                        </ul>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->

            </div> <!-- end col-->

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">

                                <form action="{{route('admin.verify.user.approve')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$verification->user_id}}">
                                    <input type="hidden" name="verification_id" value="{{$verification->id}}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter first name" required>
                                            </div>
                                        </div>
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="message">Reply to User</label>
                                                <textarea class="form-control" id="message" name="message" rows="4"
                                                          placeholder="{{$verification->message}}" required></textarea>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="useremail">Email Address</label>--}}
{{--                                                <input type="email" class="form-control" id="useremail" placeholder="Enter email">--}}
{{--                                                <span class="form-text text-muted"><small>If you want to change email please <a href="javascript: void(0);">click</a> here.</small></span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="userpassword">Password</label>--}}
{{--                                                <input type="password" class="form-control" id="userpassword" placeholder="Enter password">--}}
{{--                                                <span class="form-text text-muted"><small>If you want to change password please <a href="javascript: void(0);">click</a> here.</small></span>--}}
{{--                                            </div>--}}
{{--                                        </div> <!-- end col -->--}}
{{--                                    </div> <!-- end row -->--}}

{{--                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Company Info</h5>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="companyname">Company Name</label>--}}
{{--                                                <input type="text" class="form-control" id="companyname" placeholder="Enter company name">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="cwebsite">Website</label>--}}
{{--                                                <input type="text" class="form-control" id="cwebsite" placeholder="Enter website url">--}}
{{--                                            </div>--}}
{{--                                        </div> <!-- end col -->--}}
{{--                                    </div> <!-- end row -->--}}

{{--                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth mr-1"></i> Social</h5>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="social-fb">Facebook</label>--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <div class="input-group-prepend">--}}
{{--                                                        <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>--}}
{{--                                                    </div>--}}
{{--                                                    <input type="text" class="form-control" id="social-fb" placeholder="Url">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="social-tw">Twitter</label>--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <div class="input-group-prepend">--}}
{{--                                                        <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>--}}
{{--                                                    </div>--}}
{{--                                                    <input type="text" class="form-control" id="social-tw" placeholder="Username">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div> <!-- end col -->--}}
{{--                                    </div> <!-- end row -->--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="social-insta">Instagram</label>--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <div class="input-group-prepend">--}}
{{--                                                        <span class="input-group-text"><i class="mdi mdi-instagram"></i></span>--}}
{{--                                                    </div>--}}
{{--                                                    <input type="text" class="form-control" id="social-insta" placeholder="Url">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="social-lin">Linkedin</label>--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <div class="input-group-prepend">--}}
{{--                                                        <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>--}}
{{--                                                    </div>--}}
{{--                                                    <input type="text" class="form-control" id="social-lin" placeholder="Url">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div> <!-- end col -->--}}
{{--                                    </div> <!-- end row -->--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="social-sky">Skype</label>--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <div class="input-group-prepend">--}}
{{--                                                        <span class="input-group-text"><i class="mdi mdi-skype"></i></span>--}}
{{--                                                    </div>--}}
{{--                                                    <input type="text" class="form-control" id="social-sky" placeholder="@username">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="social-gh">Github</label>--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <div class="input-group-prepend">--}}
{{--                                                        <span class="input-group-text"><i class="mdi mdi-github-circle"></i></span>--}}
{{--                                                    </div>--}}
{{--                                                    <input type="text" class="form-control" id="social-gh" placeholder="Username">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div> <!-- end col -->--}}
{{--                                    </div> <!-- end row -->--}}

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save And Approve</button>
                                    </div>
                                </form>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

                @foreach(json_decode($verification->files) as $file)
                    <a class="btn" target="_blank" href="{{asset('public/storage/'.$file)}}">
                        <img src="{{asset('public/storage/'.$file)}}" style="width:100%">
                    </a>
                @endforeach

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

    </div> <!-- content -->


@endsection
@section('extra-scripts')

    <!-- demo app -->
    <script src="{{asset('public/admin/js/pages/demo.customers.js')}}"></script>
    <!-- end demo js-->
    <script src="{{asset('public/admin/js/pages/demo.customers.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection
