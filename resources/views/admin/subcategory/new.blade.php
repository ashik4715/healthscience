@extends('admin.layouts.app')

@section('title', 'Add New Sub Category')

@push('css')
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form action="{{route('admin.sub-category.store')}}" method="post">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="box-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Hero Title:</label>
                            <input type="text" class="form-control" name="hero_title">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="box-header">
                            <label for="recipient-name" class="col-form-label">Description:</label>
                        </div>
                        <!-- /.box-header -->
                        <div>
                            <textarea id="editor1" name="description" rows="10" cols="80">
                            </textarea>
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
                        <br>
                        <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-plus-circle"></i> Create</button>
                        <a href="{{route('admin.sub-category.index')}}" class="btn btn-sm btn-default  pull-right" style="margin-right: 5px;">Cancel</a>

{{--                        <input type="submit" class="pull-right btn btn-sm btn-primary" id="recipient-name">--}}
                    </div>
                </form>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col-->
    </div>

@endsection

@push('scripts')
    <script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(function () {
            CKEDITOR.replace('editor1')
            $('.textarea').wysihtml5()
        })
    </script>
@endpush