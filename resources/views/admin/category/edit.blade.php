@extends('admin.layouts.app')

@section('title', 'Edit Category')

@push('css')
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('admin.category.update', $category->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="col-xs-6 form-group">
                            <label for="recipient-name" class="col-form-label"> Logo:</label>
                            <input onchange="readliveImagebrows(this);" type="file" name="logo">
                            <img id="imageBrowsLive" height="50" width="200" src="{{asset('images/category_logo/'.$category->logo)}}" alt="">
                        </div>

                        <div class="col-xs-6 form-group">
                            <label>Category Color:</label>
                            <input type="text" name="category_color" value="{{$category->category_color}}" class="form-control my-colorpicker1 colorpicker-element">
                        </div>

                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" value="{{$category->name}}" name="name">
                        </div>

                        <div class="col-xs-6 form-group">
                            <label for="recipient-name" class="col-form-label">Tag:</label>
                            <input type="text" class="form-control" value="{{$category->tag}}" name="tag">
                        </div>

                        <div class="col-xs-6 form-group">
                            <label for="recipient-name" class="col-form-label">Price:</label>
                            <input type="text" class="form-control" value="{{$category->price}}" name="price">
                        </div>



                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Description:</label>

                            <textarea id="editor1" name="description" rows="10" cols="80">
                                                    {{$category->description}}
                            </textarea>
                        </div>
                        <br>
                        
                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   value="{{ $category->meta_title }}" placeholder="Enter Meta Title">
                            @if($errors->has('meta_title'))
                                {{ $errors->meta_title }}
                            @endif       
                        </div>

                        <div class="col-xs-12 form-group">
                            <label>Meta Description:</label>
                            <div class="col-10">
                                <textarea name="meta_description" class="form-control" cols="5" rows="5"
                                          value="{{ $category->meta_description }}" >{{ $category->meta_description }}</textarea>
                                @if($errors->has('meta_description'))
                                    {{ $errors->meta_description }}
                                @endif
                            </div>      
                        </div>
                        
                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Impact Factor:</label>
                            <input type="text" class="form-control" value="{{ $category->impact_factor }}" name="impact_factor">
                        </div>

                        <div class="col-xs-12 form-group">
                            <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-refresh"></i> Update</button>
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
            $('.textarea').wysihtml5();
        })

        $(function () {
            var cinput_color = $('.colorpicker-element')[0].value
            $(".colorpicker-element").css("background-color", cinput_color);
        })

        $('.colorpicker-element').change(function() {
            var cinput_color = $('.colorpicker-element')[0].value
            $(".colorpicker-element").css("background-color", cinput_color);
        });
    </script>
@endpush