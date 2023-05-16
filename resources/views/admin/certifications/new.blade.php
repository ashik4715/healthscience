@extends('admin.layouts.app')

@section('title', 'Add New Certification')

@push('css')
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form action="{{route('admin.certifications.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title"
                                   placeholder="Enter Certification Title">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Image:</label>
                            <input type="file" name="image">
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
                                <a href="{{route('admin.certifications.index')}}" class="btn btn-sm btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Cancel</a>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Create</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col-->
    </div>

@endsection

@push('scripts')

@endpush