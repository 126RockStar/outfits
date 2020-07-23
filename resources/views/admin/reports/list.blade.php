@extends('admin.master')

@section('title')
  Reports
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">Reports</li>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{route('admin.reports.selected')}}" method="POST" class="card-body">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <button type="button" onclick="checkUnRead(this)" class="btn btn-success m-2 float-left" ><i class="fa fa-eye-slash mr-2"></i> UnSeen Selected</button>
                                <button type="button" onclick="checkRead(this)" class="btn btn-warning m-2 float-left" ><i class="fa fa-eye mr-2"></i> Seen Selected</button>
                                
                                <button type="submit" onclick="return confirm('Are you sure to delete the selected messages?')" class="btn btn-danger m-2 float-left" ><i class="mdi mdi-delete-sweep  mr-2"></i> Delete Selected</button>
                            </div>
                            {{-- <div class="col-sm-8">
                                <!-- <div class="text-sm-right">
                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                    <button type="button" class="btn btn-light mb-2 mr-1">Edit Roles</button>
                                    <button type="button" class="btn btn-light mb-2">Edit Permissions</button>
                                </div> -->
                            </div><!-- end col--> --}}
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered dt-responsive nowrap w-100" id="myTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="check_all" id="check_all"> <label for="check_all">All</label></th>
                                        <th>ID</th>
                                        <th>Reporter</th>
                                        <th>Contest</th>
                                        <th>Entry</th>
                                        <th>Reason</th>
                                        <th>Attachment</th>
                                        <th>Sent At</th>
                                        <th>Status</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($reports as $report)
                                    <tr class="@if($report->status == 'unseen') bg-light @endif">
                                        <td><input type="checkbox" name="checked_reports[]" value="{{$report->id}}"></td>
                                        
                                        <td>{{$report->id}}</td>
                                        <td>{{$report->getCreator->username}}</td>
                                        <td><a href="{{route('contest.show',$report->contest_id)}}" target="_blanke">{{$report->getContest->title}}</a></td>
                                        <td>
                                            <a href="{{asset('public/storage/'.$report->file)}}" target="_blank">See Reported Entry</a>
                                        </td>
                                        <td>{{$report->reason}}</td>

                                        <td>
                                            @if(!empty($report->attachment))
                                                <a href="{{asset('public/storage/'.$report->file)}}" target="_blank">See Attachment</a>
                                            @endif
                                        </td>


                                        <td>{{$report->created_at}}</td>
                                        <td>
                                            @if($report->status =='seen')
                                              <span class="badge badge-success">Seen</span>
                                            @else
                                              <span class="badge badge-danger">Unseen</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($report->status == 'seen')
                                                <a href="{{route('admin.report.unseen',$report->id)}}"  class="btn btn-warning btn-sm"> <i class="fa fa-eye-slash"></i></a>
                                            @else
                                                <a href="{{route('admin.report.seen',$report->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>
                                            @endif
                                            <a href="{{route('admin.report.delete',$report->id)}}" onclick="return confirm('Are you sure to delete the message?')" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>
                                        
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td collspan="5" class="text-danger">No Messages Found</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

    </div> <!-- content -->

@endsection
@section('extra-scripts')

   <!-- demo app -->
   <script src="{{asset('public/admin/js/pages/demo.customers.js')}}"></script>
   <script src="{{asset('public/admin/js/jquery.dataTables.min.js')}}"></script>
   <!-- end demo js-->
   <script>
      $(document).ready( function () {
       $('#myTable').DataTable({"pageLength": 50});
     });

     $("input[name=check_all]").click(function(){
        $('input:checkbox[name="checked_reports[]"]').not(this).prop('checked', this.checked);
     });

     function checkRead(read){
        $("#check_all").parent().append('<input type="hidden" name="type" value="read">');
        read.form.submit();
     }
     function checkUnRead(unread){
        $("#check_all").parent().append('<input type="hidden" name="type" value="unread">');
        unread.form.submit();
     }
   </script>
@endsection
