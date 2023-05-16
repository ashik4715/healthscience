@extends('admin.layouts.app')

@section('title', 'Create Privacy Policy')

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Fill-Up About Us Form</h3>
                </div>
                <form action="{{route('admin.privacy.store')}}" role="form"
                      enctype="multipart/form-data" method="post">

                    {{csrf_field()}}
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-2 col-form-label">Privacy Policy Title</label>
                            <div class="col-10">
                                <input name="privacy_title" type="text" placeholder="Enter Privacy Policy Title"
                                       class="form-control" required>
                                @if($errors->has('privacy_title'))
                                    {{ $errors->privacy_title }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Privacy Policy Description</label>
                            <div class="col-10">
                                <textarea name="privacy_description" id="editor1" class="form-control ckeditor" cols="5"
                                          rows="2"
                                          placeholder="Enter Privacy Policy Description"></textarea>
                                @if($errors->has('privacy_description'))
                                    {{ $errors->privacy_description }}
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

                        <a href="{{route('admin.privacy.index')}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
                        <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Create</button>

                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            CKEDITOR.replace('editor1');
            // $('.textarea').wysihtml5();
        })
    </script>
@endpush