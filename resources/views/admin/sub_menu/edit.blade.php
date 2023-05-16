@extends('admin.layouts.app')

@section('title', 'Edit Sub-menu')

@push('css')
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form action="{{route('admin.sub-menu.update', $sub_menu->id)}}" method="post">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="issue">Category</label>
                                    <select class="form-control" name="category_id" required>
                                        <option>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$sub_menu->category_id == $category->id? 'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="issue">Sub Category</label>
                                    <select class="form-control" name="sub_category_id" required>
                                        <option>Select Sub Category</option>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}" {{$sub_menu->sub_category_id == $subcategory->id? 'selected':''}}>{{$subcategory->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title" value="{{$sub_menu->title}}">
                        </div>
                        <div class="box-header">
                            <label for="recipient-name" class="col-form-label">Description:</label>
                        </div>
                        <!-- /.box-header -->
                        <div>
                            <textarea id="editor1" name="description" rows="10" cols="80">
                            {{$sub_menu->description}}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meta Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="meta_title"
                                   value="{{ $sub_menu->meta_title }}" placeholder="Enter Meta Title">
                            @if($errors->has('meta_title'))
                                {{ $errors->meta_title }}
                            @endif       
                        </div>

                        <div class="form-group">
                            <label>Meta Description:</label>
                            <div class="col-10">
                                <textarea name="meta_description" class="form-control" cols="5" rows="5"
                                          value="{{ $sub_menu->meta_description }}" >{{ $subcategory->meta_description }}</textarea>
                                @if($errors->has('meta_description'))
                                    {{ $errors->meta_description }}
                                @endif
                            </div>      
                        </div>
                        <br>
                        <button type="submit" class="btn btn-sm btn-primary  pull-right"><i class="fa fa-refresh"></i> Update</button>
                        <a href="{{route('admin.sub-menu.index')}}" class="btn btn-sm btn-default  pull-right" style="margin-right: 5px;">Cancel</a>
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