@extends('admin.layouts.app')

@section('title', 'Edit Sub-Category')

@push('css')
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form action="{{route('admin.sub-category.update', $subcategory->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="box-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Hero Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="hero_title" value="{{$subcategory->hero_title}}">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title" value="{{$subcategory->title}}">
                        </div>
                        <div class="box-header">
                            <label for="recipient-name" class="col-form-label">Description:</label>
                        </div>
                        <!-- /.box-header -->
                        <div>
                            <textarea id="editor1" name="description" rows="10" cols="80">
                            {{$subcategory->description}}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   value="{{ $subcategory->meta_title }}" placeholder="Enter Meta Title">
                            @if($errors->has('meta_title'))
                                {{ $errors->meta_title }}
                            @endif       
                        </div>

                        <div class="form-group">
                            <label>Meta Description:</label>
                            <div class="col-10">
                                <textarea name="meta_description" class="form-control" cols="5" rows="5"
                                          value="{{ $subcategory->meta_description }}" >{{ $subcategory->meta_description }}</textarea>
                                @if($errors->has('meta_description'))
                                    {{ $errors->meta_description }}
                                @endif
                            </div>      
                        </div>
                        <br>
                        <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-refresh"></i> Update</button>
                        <a href="{{route('admin.sub-category.index')}}" class="btn btn-sm btn-default  pull-right" style="margin-right: 5px;">Cancel</a>
{{--                        <input type="submit" class="pull-right btn btn-sm btn-primary" id="recipient-name">--}}
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