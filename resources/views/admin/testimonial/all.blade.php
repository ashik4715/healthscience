@extends('admin.layouts.app')

@section('title', 'All Testimonial')

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
                <div class="box-body">
                    <a href="{{route('admin.testimonial.create')}}" class="pull-right btn btn-xs btn-primary"> <i
                                class="fa fa-plus"></i> Add New</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Institution</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($testimonials  as $testimonial)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td><img src="{{asset('images/testimonials/'.$testimonial->photo)}}" title="{{$testimonial->name}}" width="50"></td>
                                <td>{{$testimonial->name}}</td>
                                <td>{{$testimonial->designation}}</td>
                                <td>{{$testimonial->institution}}</td>
                                <td>
                                    @if($testimonial->status == 0)
                                        <span class="badge bg-red">Inactive</span>
                                        @else
                                        <span class="badge bg-green">Active</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.testimonial.edit', $testimonial->id)}}"
                                       class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>

                                    <a href="#" class="btn btn-xs btn-danger table-action-btn on_delete"
                                       data-content="{{$loop->index+1}}"><i
                                                class="fa fa-trash-o"></i></a>

                                    <form id="on_delete{{$loop->index+1}}"
                                          action="{{route('admin.testimonial.destroy', $testimonial->id)}}"
                                          method="post" class="delete"
                                          data-content="{{$testimonial->id}}"
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
        $(document).on("click", ".on_delete", function (e) {
            var index = $(this).data('content');

            bootbox.confirm({
                message: "Do you want to remove this?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn btn-xs btn-danger'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn btn-xs btn-success'
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