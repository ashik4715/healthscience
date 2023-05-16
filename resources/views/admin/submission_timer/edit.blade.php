@extends('admin.layouts.app')

@section('title', 'Edit Submission Timer')

@push('css')
    <link rel="stylesheet" href="{{asset('datetime_picker/bootstrap.min.css')}}">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('datetime_picker/jquery.min.js')}}"></script>
    <style type="text/css">
        .top-buffer {
            margin-top: 50px;
        }
		.bottom-buffer {
            margin-bottom: 50px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {

			//DatePicker Example
			$('#datetimepicker').datetimepicker({
                format:'Y-m-d H:i:s'
            });
		});
    </script>


@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Issue</h3>
                    <a href="{{route('admin.submission-timer.index')}}" class="btn btn-xs btn-info pull-right"> <i class="fa fa-list"></i> All</a>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Opps! {{$error}}
                        </div>
                    @endforeach
                @endif
                <div class="box-body">
                    <form action="{{route('admin.submission-timer.update',$submission_timer->id)}}" role="form"
                            enctype="multipart/form-data" method="post">
                        {{method_field('PUT')}}
                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="volume">Volume</label>
                                <input type="text" name="volume" value="{{$submission_timer->volume}}" class="form-control" id="volume" placeholder="Enter volume">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="issue">Issue</label>
                                <input type="text" name="issue" value="{{$submission_timer->issue}}" class="form-control" id="issue" placeholder="Enter Issue">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{$category->id == $submission_timer->category_id? 'selected':''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="datetimepicker">Submission Deadline</label>
                                <input id="datetimepicker" name="deadline" value="{{$submission_timer->deadline}}" type="text" placeholder="Enter deadline" class="form-control" required>
                                @if($errors->has('deadline'))
                                    {{ $errors->deadline }}
                                @endif
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                <label for="publish">Publish On</label>
                                <input id="publish" name="publish" value="{{$submission_timer->publish_on}}" type="text" placeholder="Enter publish Date" class="form-control" required>
                                @if($errors->has('publish'))
                                    {{ $errors->publish }}
                                @endif
                                </div>
                            </div> --}}
                        </div>
                        <div class="form-group">

                            <label class="col-md-2">Status: </label>
                            <div>
                                <label class="col-md-2">Inactive: <input type="radio" name="status" value="0" {{$submission_timer->status==0 ? 'checked':''}}></label>

                            </div>
                            <div>
                                <label class="col-md-2">Active: <input type="radio" name="status" value="1" {{$submission_timer->status==1 ? 'checked':''}}></label>

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-refresh"></i> Update</button>
                            <a href="{{route('admin.submission-timer.index')}}" class="btn btn-sm btn-default  pull-right" style="margin-right: 5px;">Cancel</a>
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
            // $('.textarea').wysihtml5();
        })
    </script>
    <script type="text/javascript">
        $(function () {
            $('#publish').datetimepicker({
                format:'Y-m-d H:i:s'
            });
        })
    </script>
	<link rel="stylesheet" type="text/css" href="{{asset('datetime_picker/jquery.datetimepicker.min.css')}}"/>
    <script src="{{asset('datetime_picker/bootstrap.min.js')}}"></script>
	<script src="{{asset('datetime_picker/jquery.datetimepicker.js')}}"></script>

@endpush
