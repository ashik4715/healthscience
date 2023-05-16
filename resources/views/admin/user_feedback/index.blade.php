@extends('admin.layouts.app')

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.user-feedback.index')}}">User Feedbacks</a></li>
@endsection

@section('title', 'User | Feedbacks')

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
                    <br>
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Submit Date</th>
                            <th>status</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($user_feedbacks as $user_feedback)
                            <tr>
                                <td><a href="#">{{$loop->index+1}}</a></td>
                                <td>{{$user_feedback->name}}</td>
                                <td>{{$user_feedback->email}}</td>
                                <td>{{$user_feedback->created_at->format('d M Y')}}</td>
                                <td>
                                    @if($user_feedback->status == 0)
                                        <form action="{{route('admin.feedback_show_admin', $user_feedback->id)}}" method="post" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-danger" type="submit" ><i class="fa fa-eye"></i></button>
                                        </form>
                                    @elseif($user_feedback->status == 1)
                                        <a href="{{ route('admin.user-feedback.show',$user_feedback->id)}}" class="btn btn-sm btn-success">
                                           <i class="fa fa-eye"></i>
                                        </a>
                                    @endif

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
        $(document).on("click", ".about_us_delete", function (e) {
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
                        $("#about_us_delete" + index).submit();
                    }
                }
            });
        });
    </script>
@endpush