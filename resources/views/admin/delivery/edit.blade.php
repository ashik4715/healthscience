@extends('admin.layouts.app')

@section('title', 'Edit Delivery Policy')

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-body">
                    <form action="{{route('admin.delivery-policy.update',$delivery->id)}}" role="form"
                          enctype="multipart/form-data" method="post">

                        {{method_field('PUT')}}
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-2 col-form-label">FAQ Question</label>
                            <div class="col-10">
                                <input name="title" type="text" placeholder="Enter title"
                                       value="{{ $delivery->title }}" class="form-control" required>
                                @if($errors->has('title'))
                                    {{ $errors->title }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">FAQ Answer</label>
                            <div class="col-10">
                                <textarea name="description" id="editor1" class="form-control ckeditor" cols="5" rows="2"
                                          value="{{ $delivery->description }}" required>{{ $delivery->description }}</textarea>
                                @if($errors->has('description'))
                                    {{ $errors->description }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-md-2">Status: </label>
                            <div>
                                <label class="col-md-2">Inactive: <input type="radio" name="status" value="0" {{$delivery->status == 0 ? 'checked':''}}></label>

                            </div>
                            <div>
                                <label class="col-md-2">Active: <input type="radio" name="status" value="1" {{$delivery->status == 1 ? 'checked':''}}></label>

                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-1">
                                <a href="{{route('admin.delivery-policy.index')}}" class="btn btn-sm btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Cancel</a>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>
                            </div>
                        </div>

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