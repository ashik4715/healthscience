@extends('admin.layouts.app')

@section('title', 'Edit About Us | International Medical Journal')

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
                    <h3 class="box-title">Fill-Up About Us Form</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{route('admin.about-us.update',$about->id)}}" role="form"
                          enctype="multipart/form-data" method="post">

                        {{method_field('PUT')}}
                        {{csrf_field()}}

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control ckeditor" style="resize:none"
                                      value="{{ $about->description }}" required>{{ $about->description }}</textarea>
                            @if($errors->has('description'))
                                {{ $errors->description }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Peer Review</label>
                            <textarea name="peer_review" id="description" class="form-control ckeditor" rows="3" style="resize:none"
                                      value="{{ $about->peer_review }}" required>{{ $about->peer_review }}</textarea>
                            @if($errors->has('peer_review'))
                                {{ $errors->peer_review }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Broad Scope</label>
                            <textarea name="broad_scope" id="description" class="form-control ckeditor" rows="3" style="resize:none"
                                      value="{{ $about->broad_scope }}" required>{{ $about->broad_scope }}</textarea>
                            @if($errors->has('broad_scope'))
                                {{ $errors->broad_scope }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Indexed</label>
                            <textarea name="indexed" id="description" class="form-control ckeditor" rows="3" style="resize:none"
                                      value="{{ $about->indexed }}" required>{{ $about->indexed }}</textarea>
                            @if($errors->has('indexed'))
                                {{ $errors->indexed }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Open Access</label>
                            <textarea name="open_access" id="description" class="form-control ckeditor" rows="3" style="resize:none"
                                      value="{{ $about->open_access }}" required>{{ $about->open_access }}</textarea>
                            @if($errors->has('open_access'))
                                {{ $errors->open_access }}
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Fast Track Peer-Review</label>
                            <textarea name="fast_track_peer" id="description" class="form-control ckeditor" rows="3" style="resize:none"
                                      value="{{ $about->fast_track_peer }}" required>{{ $about->fast_track_peer  }}</textarea>
                            @if($errors->has('fast_track_peer'))
                                {{ $errors->fast_track_peer }}
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Membership Image URL Link</label>
                            <input name="membership_image" type="text" placeholder="Membership Image URL Link"
                                   value="{{$about->membership_image}}" class="form-control">

                            <label>Upload Memebership Images</label>
                            <div class="col-10">
                                <input name="filename[]" type="file" class="form-control" multiple="multiple">
                                @foreach($pictures as $photo)
                                    @foreach(json_decode($photo->image, true) as $images)
                                        <img style="max-height: 150px; max-width: 150px !important;" src="{{asset($images)}}">
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title" value="{{$about->meta_title}}"
                                   placeholder="Enter Meta Title">
                        </div>

                        <div class="form-group">
                            <label>Meta Description:</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" cols="5" rows="3" style="resize:none" placeholder="Enter Description" required="">
                                {{$about->meta_description}}
                            </textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-refresh"></i> Update</button>
                        <a href="{{route('admin.about-us.index')}}" class="btn btn-sm btn-default  pull-right" style="margin-right: 5px;">Cancel</a>
{{--                        <button type="submit" class="btn btn-primary">Submit</button>--}}

                    </form>
                </div>
                <!-- /.box-body -->
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
