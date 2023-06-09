@extends('admin.layouts.app')

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.delivery-policy.index')}}">Delivery Policy</a></li>
@endsection

@section('title', 'Delivery Policy')

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
    <div class="col-md-12">
        <div class="well box box-primary" style="background: #f5f5f5 !important; border: 0px solid #e3e3e3 !important;">
            <div class="box-header with-border">
              <h3 class="box-title">Delivery policy Show</h3>
            </div>
            <div class="_container">
                <div class="well"style="border: 0px solid #e3e3e3 !important;">

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <p>{{ $delivery_policy->name}}</p>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <p>{{ $delivery_policy->email}}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Time</label>
                                    <p>{{ $delivery_policy->created_at->format('d M Y')}}</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Delivery Address</label>
                                    <p>{{ $delivery_policy->delivery_address}}</p>
                                </div>
                            </div>
                
                        </div>
                        <hr>

                    </div>
                    <div class="box-footer">
                       <a href="{{route('admin.indexweb')}}" class="btn btn-md btn-primary pull-right"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
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