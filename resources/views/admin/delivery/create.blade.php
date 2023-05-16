@extends('admin.layouts.app')

@section('title', 'Create Delivery Policy')

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Fill-Up Delivery Policy Form</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{route('admin.delivery-policy.store')}}" role="form" method="post">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-2 col-form-label">Title</label>
                            <div class="col-10">
                                <input name="title" type="text" placeholder="Enter Delivery Policy Title"
                                       class="form-control" required>
                                @if($errors->has('title'))
                                    {{ $errors->title }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <textarea name="description" id="editor1" class="form-control ckeditor" cols="5" rows="2"
                                          placeholder="Enter Description"></textarea>
                                @if($errors->has('description'))
                                    {{ $errors->description }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-md-2">Status: </label>
                            <div>
                                <label class="col-md-2">Inactive: <input type="radio" name="status" value="0"></label>

                            </div>
                            <div>
                                <label class="col-md-2">Active: <input type="radio" name="status" value="1"></label>

                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-1">
                                <a href="{{route('admin.delivery-policy.index')}}" class="btn btn-sm btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Cancel</a>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Create</button>
                            </div>
                        </div>

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
@endpush