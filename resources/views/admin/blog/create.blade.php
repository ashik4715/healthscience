@extends('admin.layouts.app')

@section('title', 'Create Blog | SDIP')

@push('css')
{{--    <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('admin/bower_components/ckeditor/contents.css')}}">--}}
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Fill-Up Blog Form</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('admin.blog.store')}}" role="form"
                          enctype="multipart/form-data" method="post">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-2 col-form-label">Title <span style="color: red;">*</span></label>
                            <div class="col-10">
                                <input name="title" type="text" placeholder="Enter Blog Title" class="form-control" required>
                                @if($errors->has('title'))
                                    {{ $errors->title }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Image:</label>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Description <span style="color: red;">*</span></label>
                            <div class="col-10">
                                <textarea name="description" id="editor1" class="form-control ckeditor" cols="5" rows="2" required></textarea>
                                @if($errors->has('description'))
                                    {{ $errors->description }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   placeholder="Enter Meta Title">
                        </div>

                        <div class="form-group">
                            <label>Meta Description:</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" cols="5" rows="3" style="resize:none" placeholder="Enter Description" required=""></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @parent
    <script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            CKEDITOR.replace('editor1');
            // $('.textarea').wysihtml5();
        })
    </script>
@endpush
