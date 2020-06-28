@extends('admin/master')

@section('title')
  Edit Category
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
                      <form action="{{ route('admin.categories.update',$catByID->id)}}" method="post" class="pl-3 pr-3">
                        @csrf
                        @method('PUT')
                          <div class="form-group">
                              <label for="">Category Name</label>
                              <input class="form-control" name="name" type="text" value="{{$catByID->name}}" id="" required="" placeholder="Write Category name here" required>
                          </div>

                          
                          {{-- <hr>
                          <div class="form-group"  id="subCategory-fields">
                              <label for="emailaddress1">SubCategories</label>
                              @forelse($catByID->getSubCategories as $subCategory)
                                <div class="row">
                                  <div class="col-11">
                                    <input class="form-control mt-1" name="subCategories[{{$subCategory->id}}]" type="text" value="{{$subCategory->name}}" placeholder="Write SubCategory name here">
                              
                                  </div>
                                  <div class="col-1"><span data="{{$subCategory->id}}" class="delete-sub-category btn btn-danger btn-sm mt-1">x</span></div>
                                </div>
                               @empty
                              <p class="text-danger">No SubCategory is added yet under this Category.</p>
                              @endforelse
                              <div class="row">
                                <div class="col-11">
                                  <input class="form-control mt-1" name="subCategories[]" type="text" value="" placeholder="Write SubCategory name here">
                                </div>
                                <div class="col-1"><span data="0"class="delete-sub-category btn btn-danger btn-sm mt-1">x</span></div>
                              </div>
                          </div> --}}
                          {{-- <button type="button" id="add-subCategory" class="btn btn-icon btn-info btn-sm"> <i class="mdi mdi-plus"></i> New SubCategory</button> --}}

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
