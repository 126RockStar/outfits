@extends('admin.master')

@section('title')
  {{ __('Categories') }}
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">Categories</li>
  @endsection

@section('contents')
<!-- Start Content-->
<a href="javascript:void(0);" class="btn btn-info m-2" data-toggle="modal" data-target="#category-add"><i class="mdi mdi-plus-circle mr-2"></i> {{__('Add Category')}}</a>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="all">Category Name</th>
                                    <th>Sub Categories</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm btn-icon p-1"> <i class="mdi mdi-square-edit-outline text-white"></i></a>
                                        <form class="action-icon" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" onclick="return confirm('Are you sure to delete the Category and related subcategories?')" class="btn btn-danger btn-sm btn-icon p-1"> <i class="mdi mdi-delete text-white"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                      <ul>
                                        @forelse($category->getSubCategories as $subCategory)
                                          <li> 
                                              {{ $subCategory->name }}
                                              <a href="{{ route('admin.sub-category.edit', $subCategory->id) }}" class="badge bg-primary"> <i class="mdi mdi-square-edit-outline text-white"></i></a>
                                              <a href="{{ route('admin.sub-category.delete', $subCategory->id) }}" class="badge bg-danger" onclick="return confirm('Are you sure to delete the subcategory?')"> <i class="mdi mdi-delete text-white"></i></a>
                                            </li>
                                        @empty
                                          <li class="text-danger"> No SubCategory added</li>
                                        @endforelse
                                      </ul>
                                    <form action="{{route('admin.sub-category.add')}}" method="POST">
                                        @csrf 
                                        <input type="hidden" name="category_id" value="{{$category->id}}">
                                        <div class="input-group mb-3">
                                          <input type="text" name="sub_category" class="form-control" placeholder="Sub-category Name">
                                          <div class="input-group-append">
                                            <button type="submit" class="input-group-text">Add New</button>
                                          </div>
                                        </div>
                                    </form>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    {{$categories->links()}}
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- container -->


<!-- category add modal -->
<div id="category-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="18"></span>
                    </a>
                </div>

                <form action="{{ route('admin.categories.store')}}" method="post" class="pl-3 pr-3">
                  @csrf
                    <div class="form-group">
                        <label for="">{{__('Category Name')}}</label>
                        <input class="form-control" name="name" type="text" value="" id="" required="" placeholder="{{__('Write category name here')}}" required>
                    </div>
    
                    <hr>

                    <div class="form-group"  id="subCategory-fields">
                        <label for="">{{__('Subcategories')}}</label>
                        <input class="form-control mt-1" name="subCategories[]" type="text" value="" id="subCategory-field" placeholder="{{__('Write SubCategory name here')}}">
                    </div>

                    <button type="button" id="add-subCategory" class="btn btn-icon btn-info btn-sm"> <i class="mdi mdi-plus"></i>{{__('New SubCategory')}}</button>

                    <div class="form-group text-center">
                        <button class="btn btn-rounded btn-primary btn-block mt-4" type="submit">{{__('Add Category')}}</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('extra-scripts')
  <script>
    $('#add-subCategory').click(function(){
       $("#subCategory-field").clone().appendTo("#subCategory-fields").val('');
    });
  </script>
@endsection
