@extends('admin.layouts.app')

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.submission-timer.index')}}">Submission Timer</a></li>
@endsection

@section('title', 'Submission Timer')

@push('css')
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables-bs/css/dataTables.bootstrap.min.css')}}">
    <style>
        .table-actions-bar .table-action-btn {
            color: #98a6ad;
            display: inline-block;
            width: 28px;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            font-size: 20px;
        }
    </style>
@endpush

@section('content')

    <div class="row">
        @if(session()->has('message'))
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <div class="alert alert-danger">
                        {{session('message')}}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{route('admin.submission-timer.create')}}" class="pull-right btn btn-xs btn-primary"> <i
                                class="fa fa-plus"></i> Add New</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Volume</th>
                            <th>Issue</th>
                            <th>Folder</th>
                            <th>Creation Date</th>
                            <th>deadline</th>
                            {{-- <th>Publish On</th> --}}
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($submission_timers as $submission_timer)
                                <tr>
                                    <td><a href="#">{{$loop->index+1}}</a></td>
                                    <td>{{$submission_timer->volume}}</td>
                                    <td>{{$submission_timer->issue}}</td>
                                    <td>{{$submission_timer->cat_folder}}</td>
                                    <td>{{$submission_timer->created_at->format('d M Y')}}</td>
                                    <td>{{ date('d M Y', strtotime($submission_timer->deadline))}}</td>
                                    {{-- <td>{{ date('d M Y', strtotime($submission_timer->publish_on))}}</td> --}}
                                    <td>
                                        @if($submission_timer->status == 0)
                                            <button class="btn btn-xs btn-danger">Inactive</button>
                                        @else
                                            <button class="btn btn-xs btn-success">Active</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.submission-timer.edit',$submission_timer->id)}}"
                                        class="btn btn-xs btn-info table-action-btn"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                        <form id="on_delete{{$loop->index+1}}"
                                            action="{{route('admin.submission-timer.destroy',$submission_timer->id)}}"
                                            method="post" class="delete"
                                            data-content="{{$submission_timer->id}}"
                                            style="display: none;">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/bootbox.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>

    <script>
        $(document).on("click", ".on_delete", function (e) {
            var index = $(this).data('content');

            bootbox.confirm({
                message: "Do you want to remove this?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-vinndo'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-default'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $("#on_delete" + index).submit();
                    }
                }
            });
        });
    </script>
@endpush
