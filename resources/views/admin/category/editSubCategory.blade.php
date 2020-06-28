@extends('admin/master')

@section('title')
  Edit SubCategory
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">{{__('Categories')}}</a></li>
  <li class="breadcrumb-item active">{{__('Edit')}}</li>
  @endsection

@section('contents')
<!-- Start Content-->
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <!-- <a href="javascript:void(0);" class="btn btn-danger mb-2" data-toggle="modal" data-target="#department-add"><i class="mdi mdi-plus-circle mr-2"></i> Add Department</a> -->
                        </div>
                        <div class="col-sm-8">
                            <!-- <div class="text-sm-right">
                                <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                <button type="button" class="btn btn-light mb-2">Export</button>
                            </div> -->
                        </div><!-- end col-->
                    </div>
                      <form action="{{ route('admin.sub-category.update',$subCatByID->id)}}" method="post" class="pl-3 pr-3">
                        @csrf
                          <div class="form-group">
                              <label for="">SubCategory Name</label>
                              <input class="form-control" name="sub_category" type="text" value="{{$subCatByID->name}}" id="" required="" placeholder="Write Category name here" required>
                          </div>
                
                          <div class="form-group text-center">
                          <button class="btn btn-rounded btn-primary btn-block mt-4" type="submit">Update Category</button>
                          </div>
                      </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- container -->

@endsection

@section('extra-scripts')
  <script>
    $('#add-subCategory').click(function(){
       $("#subCategory-field").clone().appendTo("#subCategory-fields").val('');
    });

    $('.delete-sub-category').click(function(){
      var subCatID=$(this).attr('data');
      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
              url: '{{url("/admin/delete-sub-category")}}',
              type:"POST",
              data:{subCatID:subCatID},
              success:function(data) {
                  $(this).parent().parent().remove();
              }
          });
          $(this).parent().parent().remove();
    });
  </script>
@endsection
