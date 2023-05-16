@extends('admin.layouts.app')

@section('title', 'Stripe Payment')

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
        @php($total = 0)
        <div class="col-xs-12">
            <div class="box box-info">
                <!-- /.box-header -->
                @foreach($stripes as $stripe)
                    @php($total += $stripe->amount / 100)
                @endforeach
                <div class="box-header">
                    {{-- <button class="btn btn-xs btn-info">Total Amount: {{$total}}</button> --}}
                    <a href="{{route('admin.showpayment')}}" class="btn btn-xs btn-info pull-right"><i class="fa fa-cc-paypal"></i> Paypal</a>
                </div>
                <div class="box-body" style="overflow-x: scroll !important;">
                    <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>User ID</th>
                            {{-- <th>Card Holder Name</th> --}}
                            <th>Paper ID</th>
                            <th>Payment ID</th>
                            {{-- <th>Transaction ID</th> --}}
                            {{-- <th>Payment Method</th> --}}
                            <th>Amount</th>
                            {{-- <th>Payment Type</th> --}}
                            {{-- <th>Card Type</th> --}}
                            {{-- <th>Finger Print</th> --}}
                            {{-- <th>Last 4</th> --}}
                            <th>Payment Date</th>
                            <th>Receipt</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stripes as $stripe)
                        @php($total += $stripe->amount / 100)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$stripe->user_id}}</td>
                                {{-- <td>{{$stripe->card_holder_name}}</td> --}}
                                <td>{{$stripe->paper_id}}</td>
                                <td>{{$stripe->payment_id}}</td>
                                {{-- <td>{{$stripe->transaction_id}}</td> --}}
                                {{-- <td>{{$stripe->payment_method}}</td> --}}
                                <td>{{$stripe->amount / 100}}</td>
                                {{-- <td>{{$stripe->pay_type}}</td> --}}
                                {{-- <td>{{$stripe->card_type}}</td> --}}
                                {{-- <td>{{$stripe->fingerprint}}</td> --}}
                                {{-- <td>{{$stripe->last4}}</td> --}}

                                <td>{{date('d M Y', strtotime($stripe->created_at))}}</td>
                                <td><a href="{{$stripe->receipt_url}}" target="_blank" class="btn btn-xs btn-info">View Receipt</a></td>
                                <td class="text-center">
                                    @if($stripe->publish == 0)
                                        <a href="#" class="btn btn-xs btn-success table-action-btn on_click"
                                           data-content="{{$stripe->id}}"><i class="fa fa-check-circle"></i> Publish Now</a>

                                        <form id="on_click{{$stripe->id}}"
                                              action="{{route('admin.spublish', $stripe->id)}}"
                                              method="post" class="delete"
                                              data-content="{{$stripe->id}}"
                                              style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @else
                                        <a href="#" class="btn btn-xs btn-danger table-action-btn on_click"
                                           data-content="{{$stripe->id}}"><i class="fa fa-times-circle"></i> Unpublish</a>

                                        <form id="on_click{{$stripe->id}}"
                                              action="{{route('admin.sunpublish', $stripe->id)}}"
                                              method="post" class="delete"
                                              data-content="{{$stripe->id}}"
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
    </script>
@endpush
