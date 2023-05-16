@extends('admin.layouts.app')

@section('title', 'Create Contact Us | International Medical Journal')

@push('css')
    {{--    <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('admin/bower_components/ckeditor/contents.css')}}">--}}
@endpush

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Fill-Up Contact Us Form</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{route('admin.contact.store')}}" role="form"
                          enctype="multipart/form-data" method="post">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-2 col-form-label">Office Photo</label>
                            <div class="col-10">
                                <input name="office_photo" type="file" class="form-control">
                            </div>
                            @if($errors->has('office_photo'))
                                {{ $errors->office_photo }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Office Name</label>
                            <div class="col-10">
                                <input name="office_name" type="text" placeholder="Enter Office Name"
                                       class="form-control" required>
                            </div>
                            @if($errors->has('office_name'))
                                {{ $errors->office_name }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Location Name</label>
                            <div class="col-10">
                                <input name="location_name" type="text" placeholder="Enter Location Name"
                                       class="form-control" required>
                            </div>
                            @if($errors->has('location_name'))
                                {{ $errors->location_name }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Location URL</label>
                            <textarea name="location_url" id="location_url" class="form-control" cols="4" rows="2" style="resize:none"
                                      placeholder="Enter Location URL"></textarea>
                            @if($errors->has('location_url'))
                                {{ $errors->location_url }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Location Address</label>
                            <textarea name="location_address" id="location_address" class="form-control" cols="5" rows="3" style="resize:none"
                                      placeholder="Enter Location Address" required></textarea>
                            @if($errors->has('location_address'))
                                {{ $errors->location_address }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Telephone No.</label>
                            <div class="col-10">
                                <input name="telephone_no" type="text" placeholder="Enter Telephone No."
                                       class="form-control">
                            </div>
                            @if($errors->has('telephone_no'))
                                {{ $errors->telephone_no }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Fax No.</label>
                            <div class="col-10">
                                <input name="fax_no" type="text" placeholder="Enter Fax No."
                                       class="form-control">
                            </div>
                            @if($errors->has('fax_no'))
                                {{ $errors->fax_no }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Office Hours</label>
                            <div class="col-10">
                                <input name="office_hours" type="text" placeholder="Enter Office Hours"
                                       class="form-control">
                            </div>
                            @if($errors->has('office_hours'))
                                {{ $errors->office_hours }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   placeholder="Enter Meta Title">
                        </div>

                        <div class="form-group">
                            <label>Meta Description:</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" cols="5" rows="3" style="resize:none" placeholder="Enter Description"></textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-plus-circle"></i> Create</button>
                        <a href="{{route('admin.contact.index')}}" class="btn btn-sm btn-default  pull-right" style="margin-right: 5px;">Cancel</a>
{{--                        <button type="submit" class="btn btn-primary">Submit</button>--}}

                    </form>
                </div>
                <!-- /.box-body -->
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
    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-success").click(function () {
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click", ".btn-danger", function () {
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endpush
