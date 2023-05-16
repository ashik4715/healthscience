@extends('admin.layouts.app')

@section('title', 'Sent Email')

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
                    <a href="{{route('admin.email-excel.index')}}" class="btn btn-xs btn-danger"> <i
                                class="fa fa-arrow-circle-left"></i> Back</a>
                    <a href="{{route('admin.truncate')}}" class="btn btn-xs btn-danger"> <i class="fa fa-battery-empty"></i> Empty</a>
                    @if($row > 0)
                        <a href="{{route('admin.resend')}}" class="pull-right btn btn-xs btn-primary"> <i
                                    class="fa fa-repeat"></i> Again Send</a>
                    @endif
                    <br>
                    <br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Publisher</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Year</th>
                            <!-- <th>Action</th> -->
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($sents as $email)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$email->author_name}}</td>
                                    <td>{{$email->publisher}}</td>
                                    <td>{{$email->country}}</td>
                                    <td>{{$email->email}}</td>
                                    <td>{{$email->year}}</td>
{{--                                    <!-- <td> -->--}}
{{--                                        <!-- <a href="{{route('admin.email-excel.edit',$email->id)}}"--}}
{{--                                        class="btn btn-xs btn-success table-action-btn"><i--}}
{{--                                                    class="fa fa-pencil-square-o"></i></a>--}}

{{--                                        <a href="#" class="btn btn-xs btn-danger table-action-btn about_us_delete"--}}
{{--                                        data-content="{{$loop->index+1}}"><i--}}
{{--                                                    class="fa fa-trash-o"></i></a> -->--}}

{{--                                        <!-- <form id="about_us_delete{{$loop->index+1}}"--}}
{{--                                            action="{{route('admin.email-excel.destroy',$email->id)}}"--}}
{{--                                            method="post" class="delete"--}}
{{--                                            data-content="{{$email->id}}"--}}
{{--                                            style="display: none;">--}}
{{--                                            {{csrf_field()}}--}}
{{--                                            {{method_field('DELETE')}}--}}
{{--                                        </form>--}}

{{--                                    </td> -->--}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            $('#example1').DataTable();
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