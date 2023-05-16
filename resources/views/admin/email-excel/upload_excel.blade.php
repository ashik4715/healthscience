@extends('admin.layouts.app')

@section('title','Upload Email from Excel')

@push('css')
    <link rel="stylesheet" href="{{asset('css/dropify.min.css')}}">
@endpush

@section('page-heading')
    Author Emails
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="alert alert-warning">
                        <h4>Notice!</h4>
                        <p style="font-weight: bold; color: black;">
                            To Upload Email from Excel successfully, you have to maintain predefined Excel format(XLSX) accordingly to our Sample.
                        </p>
                        <p>
                            <a type="button" class="btn btn-pinterest" href="{{ asset('admin/data/author_emails.xlsx') }}" download>
                                <i class="fa fa-download"> Sample Author Emails List Format</i>
                            </a>
                        </p>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (\Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div>
                    @endif
                    @if (\Session::get('failure'))
                        <div class="alert alert-danger">
                            <p>{{ \Session::get('failure') }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('message'))
                        <div class="alert alert-{{ Session::get('level') }} m-t-20">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    <form id="point_upload_form" method="post" enctype="multipart/form-data" action="{{ route('admin.email-excel.store') }}">
                        <div class="row m-t-20">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <label for="file" class="col-form-label">Upload Excel</label>
                                <input name="file" required type="file" class="dropify" id="file"
                                       data-allowed-file-extensions="xlsx">
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('admin.email-excel.index')}}" class="btn btn-danger"> <i
                                            class="fa fa-arrow-circle-left"></i> Back</a>
                                <button class="btn btn-success pull-right" id="upload" style="margin-right: 5px;">
                                    <span>Upload data </span> <i class="fa fa-upload m-l-5"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{--    <script src="{{asset('admin/pages/jquery.dashboard_3.js')}}"></script>--}}
    <script src="{{asset('js/dropify.min.js')}}"></script>
    <script src="{{asset('js/notifyjs/js/notify.js')}}"></script>
    <script src="{{asset('js/notifications/notify-metro.js')}}"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
            }
        });

    </script>

@endpush
