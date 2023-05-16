@extends('admin.layouts.app')

@section('title', 'Edit slider-image')

@push('css')
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form action="{{route('admin.slider-image.update',$image->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" value="{{$image->title}}" name="title">
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="description" id="description" class="form-control" cols="5" rows="3" style="resize:none"
                                      value="{{$image->description}}" placeholder="Enter Description" required>{{$image->description}}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Image:</label>
                            <input type="file" name="image">

                            <img width="100" src="{{asset('images/slider_images/'.$image->image)}}" alt="">
                        </div>
                        <a href="{{route('admin.slider-image.index')}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
                        <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>

                    </div>
                </form>
            </div>
        </div>
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