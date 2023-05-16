@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')

@push('css')
@endpush

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">

        <div class="col-md-12">

            <div class="box box-success">
                <div class="col-md-12" style="margin-top: 5px;">
                    <a href="{{route('admin.testimonial.index')}}" class="pull-right btn btn-xs btn-primary"> <i
                                class="fa fa-list"></i> All</a>
                </div>
                <form action="{{route('admin.testimonial.update',$testimonial->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="col-xs-12 form-group">
                            <label for="recipient-name" class="col-form-label">Description:</label>
                            <div>
                            <textarea id="editor1" name="description" rows="10">
                                {!! $testimonial->description !!}
                            </textarea>
                            </div>
                        </div>
                        <div class="col-xs-4 form-group">
                            <label for="recipient-name" class="col-form-label"> Photo:</label>
                            <input type="file" name="photo" onchange="readliveImagebrows(this);"  class="form-control">
                            <img src="{{asset('images/testimonials/'.$testimonial->photo)}}" id="imageBrowsLive" title="{{$testimonial->name}}" width="50">

                        </div>

                        <div class="col-xs-8 form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="recipient-name" name="name" value="{{$testimonial->name}}"
                                   placeholder="Enter Name">
                        </div>

                        <div class="col-xs-12 form-group">
                            <label>Designation:</label>
                            <input name="designation" id="designation" value="{{$testimonial->designation}}" class="form-control" cols="5" rows="3" style="resize:none" placeholder="Enter Designation" required>
                        </div>

                        <div class="col-xs-9 form-group">
                            <label for="institution" class="col-form-label">Institution:</label>
                            <input type="text" value="{{$testimonial->institution}}" class="form-control" id="institution" name="institution"
                                   placeholder="Enter Institution">
                        </div>
                        <div class="col-xs-3 form-group">
                            <label for="status" class="col-form-label">Status:</label> <br>
                            <label for="active" class="col-form-label text-green">Active:</label> <input type="radio" id="active" name="status" value="1" {{$testimonial->status == 1 ? 'checked':''}}>
                            <label for="inactive" class="col-form-label text-danger">Inactive:</label> <input type="radio" id="inactive" name="status" value="0" {{$testimonial->status == 0 ? 'checked':''}}>
                        </div>

                        <div class="col-xs-12 form-group">
                            <a href="{{route('admin.testimonial.index')}}" class="btn btn-primary btn-danger"> <i class="fa fa-arrow-circle-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary pull-right"> <i class="fa fa-refresh"></i> Update</button>
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