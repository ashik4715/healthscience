@extends('admin.layouts.app')

@section('title', 'Edit Certifications')

@push('css')
@endpush

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form action="{{route('admin.certifications.update',$image->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" value="{{$image->title}}" name="title">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Image:</label>
                            <input type="file"  value="{{$image->image}}" name="image">

                            <img width="100" src="{{asset('images/certifications/'.$image->image)}}" alt="">
                        </div>
                        <div class="form-group">

                            <label class="col-md-2">Status: </label>
                            <div>
                                <label class="col-md-2">Inactive: <input type="radio" name="status" value="0" {{$image->status == 0 ? 'checked':''}}></label>

                            </div>
                            <div>
                                <label class="col-md-2">Active: <input type="radio" name="status" value="1" {{$image->status == 1 ? 'checked':''}}></label>

                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-1">
                                <a href="{{route('admin.certifications.index')}}" class="btn btn-sm btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Cancel</a>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

@endpush