@extends('admin.layouts.app')

@section('title', 'Add New Slider Image')

@push('css')
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form action="{{route('admin.slider-image.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title"
                                   placeholder="Enter slider image Title">
                        </div>
                        {{--                        <div class="box-header">--}}
                        {{--                            <label for="recipient-name" class="col-form-label">Description:</label>--}}
                        {{--                        </div>--}}
                        {{--                        <div>--}}
                        {{--                            <textarea id="_editor1" name="description" rows="5" cols="150" >--}}
                        {{--                        </textarea>--}}
                        {{--                        </div>--}}

                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="description" id="description" class="form-control" cols="5" rows="3" style="resize:none"
                                      placeholder="Enter Description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Image:</label>
                            <input type="file" name="image">
                        </div>
                        <br>
                        <a href="{{route('admin.slider-image.index')}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
                        <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Create</button>
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