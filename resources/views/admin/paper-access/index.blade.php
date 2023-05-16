@extends('admin.layouts.app')

@section('title', 'Paper Access Key Request')

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
        @if(Session::has('success'))
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                </div>
            </div>
        @endif
        @if(Session::has('danger'))
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <div class="alert alert-danger">
                        {{Session::get('danger')}}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <br>
                    <div class="table-responsive">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Input Country</th>
                            <th>System Country</th>
                            <th>Paper ID</th>
                            <th>Submit Date</th>
                            <th>VPN/Proxy</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($paperacces as $paperacc)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$paperacc->name}}</td>
                                <td>{{$paperacc->email}}</td>
                                <td>{{$paperacc->inputcountryname}}</td>
                                <td>{{$paperacc->systemcountryname}}</td>
                                <td>{{$paperacc->paper_id}}</td>
                                <td class="text-center">{{date('d M Y', strtotime($paperacc->created_at))}}</td>
                                <td class="text-center">
                                    @if($paperacc->use_proxy == 'yes')
                                        <span class="label label-danger">Yes</span>
                                    @else
                                        <span class="label label-success">No</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($paperacc->is_accept == 0 && $paperacc->is_denied == 0)
                                        <form action="{{route('admin.paper-access.update', $paperacc->subid)}}" method="post" style="display: inline;" onsubmit="return confirm('Are You Sure!')">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="article_id" value="{{$paperacc->subid}}">
                                            <input type="hidden" name="access_id" value="{{$paperacc->id}}">
                                            <button class="btn btn-xs btn-info" type="submit" ><i class="fa fa-check"></i></button>
                                        </form>
                                        <form action="{{route('admin.paper-access.show', $paperacc->id)}}" method="GET" style="display: inline;" onsubmit="return confirm('Are You Sure!')">
                                            <input type="hidden" name="article_id" value="{{$paperacc->subid}}">
                                            <input type="hidden" name="access_id" value="{{$paperacc->id}}">
                                            <button class="btn btn-xs btn-danger" type="submit" ><i class="fa fa-ban"></i></button>
                                        </form>
                                    @else
                                        @if($paperacc->is_accept == 1)
                                            <span class="label label-success">Sent</span>
                                        @endif
                                        @if($paperacc->is_denied == 1)
                                            <span class="label label-danger">Rejected</span>
                                        @endif
                                    @endif
                                    <a href="#" class="btn btn-xs btn-danger table-action-btn about_us_delete"
                                           data-content="{{$paperacc->id}}"><i
                                                    class="fa fa-trash-o"></i></a>

                                        <form id="about_us_delete{{$paperacc->id}}"
                                              action="{{route('admin.paper-access.destroy',$paperacc->id)}}"
                                              method="post" class="delete"
                                              data-content="{{$paperacc->id}}"
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
        $(document).on("click", ".about_us_delete", function (e) {
            var index = $(this).data('content');

            bootbox.confirm({
                message: "Do you want to remove this?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-vinndo btn-xs btn-danger'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-default btn-xs btn-success'
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