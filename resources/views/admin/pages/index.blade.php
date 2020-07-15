@extends('admin.master')

@section('title')
  Pages
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">{{__('Pages')}}</li>
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
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                              {{-- <a href="javascript:void(0);" class="btn btn-info m-2" data-toggle="modal" data-target="#page-add"><i class="mdi mdi-plus-circle mr-2"></i>Add Page</a> --}}

                              <!-- page add modal -->
                              <div id="page-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-body">
                                              <form action="{{ route('admin.pages.store')}}" method="post" class="pl-3 pr-3">
                                                @csrf
                                                  <div class="form-group">
                                                      <label for="">Name</label>
                                                      <input class="form-control" name="name" type="text" value="" id="" required="" placeholder="{{__('Write page name here')}}" required>
                                                  </div>

                                                  <div class="form-group text-center">
                                                    <button class="btn btn-rounded btn-primary btn-block mt-4" type="submit">{{__('Add Page')}}</button>
                                                </div>

                                              </form>
                                          </div>
                                      </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                              </div><!-- /.modal -->

                            </div>
                            <div class="col-sm-8">
                                <!-- <div class="text-sm-right">
                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                    <button type="button" class="btn btn-light mb-2 mr-1">Edit Roles</button>
                                    <button type="button" class="btn btn-light mb-2">Edit Permissions</button>
                                </div> -->
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($pages as $page)
                                    <tr>
                                        <td>{{$page->name}}</td>
                                        <td>{{Str::limit(strip_tags($page->details),100)}}</td>
                                        <td>
                                          {{-- <form class="action-icon" action="{{ route('admin.pages.destroy', $page->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" onclick="return confirm('Are you sure to delete the page?')" class="btn btn-danger btn-sm btn-icon p-1"> <i class="mdi mdi-delete text-white"></i></button>
                                          </form> --}}
                                          <a href="{{route('admin.pages.edit',$page->id)}}"  class="btn btn-primary btn-sm btn-icon p-1"> <i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td collspan="5" class="text-danger">No Pages Found</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
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
       $('#myTable').DataTable();
     });
   </script>
@endsection
