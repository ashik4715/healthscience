@extends('admin.layouts.app')

@section('title', 'Bank Payment')

@push('css')
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables-bs/css/dataTables.responsive.css')}}">
    <style>
        .tab-content {
            padding: 10px;
            border-left: 1px solid #DDD;
            border-bottom: 1px solid #DDD;
            border-right: 1px solid #DDD;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <!-- /.box-header -->
                <div class="box-header">
                    <a href="{{route('admin.stripepayment')}}" class="btn btn-xs btn-info pull-right"><i class="fa fa-cc-stripe"></i> Stripe</a>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Name</th>
                            <th>Paper ID</th>
                            <th>Email</th>
                            <th>Payment Date</th>
                            <th class="text-center">Receipt</th>
                            <th class="text-center">Payment Status</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payment as $pay)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$pay->name}}</td>
                                <td>{{$pay->paper_id}}</td>
                                <td>{{$pay->email}}</td>
                                <td>{{date('d M Y', strtotime($pay->created_at))}}</td>
                                <td class="text-center"><a href="{{asset('payagreementpaper/'.$pay->payment)}}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-eye"></i> View</a></td>

                                <td class="text-center">
                                    @if($pay->is_done == 0)
                                    <a href="#" class="btn btn-xs btn-success table-action-btn on_pay"
                                       data-content="{{$pay->id}}"><i class="fa fa-check-circle"></i> Payment Ok</a>

                                    <form id="on_pay{{$pay->id}}"
                                          action="{{route('admin.bankpaymentok', $pay->id)}}"
                                          method="post" class="delete"
                                          data-content="{{$pay->id}}"
                                          style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    @else
                                        <a href="#" class="btn btn-xs btn-danger table-action-btn on_pay"
                                           data-content="{{$loop->index+1}}"><i class="fa fa-times-circle"></i> Not Ok</a>

                                        <form id="on_pay{{$loop->index+1}}"
                                              action="{{route('admin.bankpaymentnotok', $pay->id)}}"
                                              method="post" class="delete"
                                              data-content="{{$pay->id}}"
                                              style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($pay->status == 0)
                                        <a href="#" class="btn btn-xs btn-success table-action-btn on_click"
                                           data-content="{{$pay->id}}"><i class="fa fa-check-circle"></i> Publish Now</a>

                                        <form id="on_click{{$pay->id}}"
                                              action="{{route('admin.bankpublish', $pay->submit_id)}}"
                                              method="post" class="delete"
                                              data-content="{{$pay->id}}"
                                              style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @else
                                        <a href="#" class="btn btn-xs btn-danger table-action-btn on_click"
                                           data-content="{{$loop->index+1}}"><i class="fa fa-times-circle"></i> Unpublish</a>

                                        <form id="on_click{{$loop->index+1}}"
                                              action="{{route('admin.bankunpublish', $pay->submit_id)}}"
                                              method="post" class="delete"
                                              data-content="{{$pay->id}}"
                                              style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
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
        <!-- /.col -->
    </div>

@endsection

@push('scripts')
    <script src="{{asset('admin/bower_components/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('js/bootbox.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
                "responsive": true,
                "bAutowidth": true,
            });
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            });
        });
    </script>

    <script>
        $(document).on("click", ".on_click", function (e) {
            var index = $(this).data('content');

            bootbox.confirm({
                message: "Are you sure?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn btn-xs btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn btn-xs btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $("#on_click" + index).submit();
                    }
                }
            });
        });

        $(document).on("click", ".on_pay", function (e) {
            var index = $(this).data('content');

            bootbox.confirm({
                message: "Are you sure?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn btn-xs btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn btn-xs btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $("#on_pay" + index).submit();
                    }
                }
            });
        });
    </script>
@endpush
