@extends('admin.layouts.app')

@section('title', 'Edit Refund Policy')

@push('css')
    {{--    <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('admin/bower_components/ckeditor/contents.css')}}">--}}
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Fill-Up About Us Form</h3>
                </div>

                <div class="box-body">
                    <form action="{{route('admin.refundPolicy.update',$refundPolicy)}}" role="form"
                          enctype="multipart/form-data" method="post">

                        {{method_field('PUT')}}
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-2 col-form-label">Refund Policy Title</label>
                            <div class="col-10">
                                <input name="refund_title" type="text" placeholder="Enter Refund Policy Title"
                                       value="{{ $refundPolicy->refund_title }}" class="form-control" required>
                                @if($errors->has('refund_title'))
                                    {{ $errors->refund_title }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Refund Policy Description</label>
                            <div class="col-10">
                                <textarea name="refund_description" id="editor1" class="form-control ckeditor" cols="5" rows="2"
                                          value="{{ $refundPolicy->refund_description }}" required>{{ $refundPolicy->refund_description }}</textarea>
                                @if($errors->has('refund_description'))
                                    {{ $errors->refund_description }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   value="{{ $refundPolicy->meta_title }}" placeholder="Enter Meta Title">
                            @if($errors->has('meta_title'))
                                {{ $errors->meta_title }}
                            @endif       
                        </div>

                        <div class="form-group">
                            <label>Meta Description:</label>
                            <div class="col-10">
                                <textarea name="meta_description" class="form-control" cols="5" rows="5"
                                          value="{{ $refundPolicy->meta_description }}" >{{ $refundPolicy->meta_description }}</textarea>
                                @if($errors->has('meta_description'))
                                    {{ $errors->meta_description }}
                                @endif
                            </div>      
                        </div>
                        <a href="{{route('admin.refundPolicy.index')}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
                        <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>

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
            //bootstrap WYSIHTML5 - text editor
            // $('.textarea').wysihtml5();
        })
    </script>
@endpush