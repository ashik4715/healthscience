@extends('admin.layouts.app')

@section('title', 'Edit FAQ ')

@push('css')
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Fill-Up About Us Form</h3>
                </div>

                <div class="box-body">
                    <form action="{{route('admin.faq.update',$faq->id)}}" role="form"
                          enctype="multipart/form-data" method="post">

                        {{method_field('PUT')}}
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-2 col-form-label">FAQ Question</label>
                            <div class="col-10">
                                <input name="faq_question" type="text" placeholder="Enter FAQ Question"
                                       value="{{ $faq->faq_question }}" class="form-control" required>
                                @if($errors->has('faq_question'))
                                    {{ $errors->faq_question }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-2 col-form-label">FAQ Answer</label>
                            <div class="col-10">
                                <textarea name="faq_answer" id="editor1" class="form-control ckeditor" cols="5" rows="2"
                                          value="{{ $faq->faq_answer }}" required>{{ $faq->faq_answer }}</textarea>
                                @if($errors->has('faq_answer'))
                                    {{ $errors->faq_answer }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   value="{{ $faq->meta_title }}" placeholder="Enter Meta Title">
                            @if($errors->has('meta_title'))
                                {{ $errors->meta_title }}
                            @endif       
                        </div>

                        <div class="form-group">
                            <label>Meta Description:</label>
                            <div class="col-10">
                                <textarea name="meta_description" class="form-control" cols="5" rows="5"
                                          value="{{ $faq->meta_description }}" >{{ $faq->meta_description }}</textarea>
                                @if($errors->has('meta_description'))
                                    {{ $errors->meta_description }}
                                @endif
                            </div>      
                        </div>

                        <a href="{{route('admin.faq.index')}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
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