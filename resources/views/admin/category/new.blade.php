@extends('admin.layouts.app')

@section('title', 'Add New Category')

@push('css')
@endpush

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="box box-success">
                <div class="col-md-12" style="margin-top: 5px;">
                    <a href="{{route('admin.category.index')}}" class="pull-right btn btn-xs btn-primary"> <i
                                class="fa fa-list"></i> All</a>
                </div>
                <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="col-xs-6 form-group">
                            <label for="recipient-name" class="col-form-label"> Logo:</label>
                            <input type="file" name="logo">
{{--                            onchange="readliveImagebrows(this);"  id="imageBrowsLive"--}}
                        </div>

                        <div class="col-xs-6 form-group">
                            <label>Category Color:</label>
                            <input type="text" name="category_color" value="#ffff" class="form-control my-colorpicker1 colorpicker-element">
                        </div>

                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Category Name:</label>
                            <input type="text" class="form-control" id="recipient-name" name="name"
                                   placeholder="Enter Category Title">
                        </div>
                        <div class="col-xs-6 form-group">
                            <label for="recipient-name" class="col-form-label">Category Tag:</label>
                            <input type="text" class="form-control" id="recipient-name" name="tag"
                                   placeholder="Enter Category Title">
                        </div>
                        <div class="col-xs-6 form-group">
                            <label for="recipient-name" class="col-form-label">Price:</label>
                            <input type="number" class="form-control"  name="price">
                        </div>

                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Category Description:</label>
                            <div>
                            <textarea id="editor1" name="description" rows="10">
                            </textarea>
                            </div>
                        </div>


                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   placeholder="Enter Meta Title">
                        </div>

                        <div class="col-xs-12 form-group">
                            <label>Meta Description:</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" cols="5" rows="3" style="resize:none" placeholder="Enter Description" required=""></textarea>
                        </div>

                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Impact Factor:</label>
                            <input type="text" class="form-control" id="recipient-name" name="impact_factor"
                                   placeholder="Enter Category Impact Factor">
                        </div>

                        <div class="col-xs-12 form-group">
                            <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-plus-circle"></i> Create</button>
                            <a href="{{route('admin.category.index')}}" class="btn btn-sm btn-default  pull-right" style="margin-right: 5px;">Cancel</a>
{{--                            <input type="submit" class="pull-right btn btn-sm btn-primary" id="recipient-name">--}}
                        </div>

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
            CKEDITOR.replace('editor2')
            CKEDITOR.replace('editor3')
            $('.textarea').wysihtml5()
        })

        $('.colorpicker-element').change(function() {
            var cinput_color = $('.colorpicker-element')[0].value
            $(".colorpicker-element").css("background-color", cinput_color);
        });


    </script>

@endpush