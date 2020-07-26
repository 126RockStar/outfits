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
                            {{-- <div class="col-sm-3">

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
                                        <td><a href="{{route('contest.show',$report->contest_id)}}" target="_blank">{{$report->getContest->title}}</a></td>
                                        <td>
                                            <a href="#" class="show-preview" data-toggle="modal" data-target="#show-preview-modal" data-type="{{$report->getContest->file_type}}" data-source="{{asset('public/storage/'.$report->getEntry->file)}}">See Reported Entry</a>
                                        </td>
                                        <td>{{$report->reason}}</td>

                                        <td>
                                            @if(!empty($report->attachment))
                                                <a href="#" class="show-preview" data-toggle="modal" data-target="#show-preview-modal"  data-type="{{$report->getContest->file_type}}" data-source="{{asset('public/storage/'.$report->attachment)}}">See Attachment</a>
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


<!-- show preview modal -->
<div id="show-preview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="showPrivew">

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

     $('.show-preview').click(function(){
        var type=$(this).attr('data-type');
        var source=$(this).attr('data-source');
        if(type=='image'){
            $("#showPrivew").html("<img src='"+source+"' style='width:100%' class='img-thumbnail'>");
        }else{
            $("#showPrivew").html("<video src='"+source+"' width='100%' class='img-thumbnail'></video>");
        }
     });
   </script>
@endsection
