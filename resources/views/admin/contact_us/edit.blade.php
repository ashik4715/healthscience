@extends('admin.layouts.app')

@section('title', 'Edit Contact | International Medical Journal')

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
                    <form action="{{route('admin.contact.update',$contact)}}" role="form"
                          enctype="multipart/form-data" method="post">

                        {{method_field('PUT')}}
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-2 col-form-label">Office Photo</label>
                            <div class="col-10">
                                <input name="office_photo" type="file" class="form-control">
                                <img style="max-width: 250px; max-height: 200px" id=""
                                     src="{{asset($contact->office_photo)}}" alt="{{$contact->office_name}}" class="mt-1">
                            </div>
                            @if($errors->has('office_photo'))
                                {{ $errors->office_photo }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Office Name</label>
                            <div class="col-10">
                                <input name="office_name" type="text" placeholder="Enter Office Name"
                                       value="{{$contact->office_name}}" class="form-control" required>
                            </div>
                            @if($errors->has('office_name'))
                                {{ $errors->office_name }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Location Name</label>
                            <div class="col-10">
                                <input name="location_name" type="text" placeholder="Enter Location Name"
                                       value="{{$contact->location_name}}" class="form-control">
                            </div>
                            @if($errors->has('location_name'))
                                {{ $errors->location_name }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Location URL</label>
                            <textarea name="location_url" id="location_address" class="form-control " style="resize:none"
                                      value="{{ $contact->location_url }}">{{ $contact->location_url }}</textarea>
                            @if($errors->has('location_url'))
                                {{ $errors->location_url }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Location Address</label>
                            <textarea name="location_address" id="location_address" class="form-control " style="resize:none"
                                      value="{{ $contact->location_address }}" required>{{ $contact->location_address }}</textarea>
                            @if($errors->has('location_address'))
                                {{ $errors->location_address }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Telephone No.</label>
                            <div class="col-10">
                                <input name="telephone_no" type="text" placeholder="Enter Telephone No."
                                       value="{{$contact->telephone_no}}" class="form-control">
                            </div>
                            @if($errors->has('telephone_no'))
                                {{ $errors->telephone_no }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Fax No.</label>
                            <div class="col-10">
                                <input name="fax_no" type="text" placeholder="Enter Fax No."
                                       value="{{$contact->fax_no}}" class="form-control">
                            </div>
                            @if($errors->has('fax_no'))
                                {{ $errors->fax_no }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Office Hours</label>
                            <div class="col-10">
                                <input name="office_hours" type="text" placeholder="Enter Office Hours"
                                       value="{{$contact->office_hours}}" class="form-control">
                            </div>
                            @if($errors->has('office_hours'))
                                {{ $errors->office_hours }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   value="{{ $contact->meta_title }}" placeholder="Enter Meta Title">
                            @if($errors->has('meta_title'))
                                {{ $errors->meta_title }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Meta Description:</label>
                            <div class="col-10">
                                <textarea name="meta_description" class="form-control" cols="5" rows="5"
                                          value="{{ $contact->meta_description }}" >{{ $contact->meta_description }}</textarea>
                                @if($errors->has('meta_description'))
                                    {{ $errors->meta_description }}
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-refresh"></i> Update</button>
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
            //bootstrap WYSIHTML5 - text editor
            // $('.textarea').wysihtml5();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });

        });
    </script>
@endpush
