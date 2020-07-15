@extends('admin/master')

@section('title')
  Edit Page
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{route('admin.pages.index')}}">{{__('Pages')}}</a></li>
  <li class="breadcrumb-item active">{{__('Edit')}}</li>
  @endsection

@section('contents')
<!-- Start Content-->
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
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
                      <form action="{{ route('admin.pages.update',$page->id)}}" method="post" class="pl-3 pr-3">
                        @csrf
                        @method('PUT')
                          <div class="form-group">
                              <label for=""> Name</label>
                              <input class="form-control" name="name" type="text" value="{{$page->name}}" id="" required="" placeholder="Write Category name here" required>
                          </div>

                          <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-3">
                                    <label for="example-textarea">Details<span class="text-danger">*</span></label>
                                    <textarea class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" rows="3" name="details" id="editor" placeholder="Write the page details here.." >{{  $page->details }}</textarea>
                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div> <!-- end row -->

                          <div class="form-group text-center">
                          <button class="btn btn-rounded btn-primary float-right mt-4" type="submit">Update</button>
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
<script src="https://cdn.tiny.cloud/1/cxdzswsxk6toyfpdqsb8o1qw0gymft77yxorevw20xaprmsn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        content_css: '//www.tiny.cloud/css/codepen.min.css',
        link_list: [
            { title: 'My page 1', value: 'http://www.tinymce.com' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'http://www.tinymce.com' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'Some class', value: 'class-name' }
        ],
        importcss_append: true,
        height: 400,
        file_picker_callback: function (callback, value, meta) {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
            callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
            }
        },
        templates: [
                { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
            { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
            { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: "mceNonEditable",
        toolbar_mode: 'sliding',
        contextmenu: "link image imagetools table",
    });

  </script>
@endsection
